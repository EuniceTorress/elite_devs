<?php
include '../../modal/stocks/reserve-item.php';
?>

<div class="container-fluid" id="cart-cont">
  <div id="select-all-container">
    <input type="checkbox" id="select-all" onchange="toggleSelectAll(this.checked)">
    <label for="select-all">Select All</label>
  </div>

  <div id="total-items-container">
    <p>Total Items: <span id="total-items">0</span></p>
  </div>

  <div id="cart-container">
    <div id="loading-indicator" class="loading-indicator">Loading...</div>
    <div id="cart-items-available" class="cart-items-container"></div>
    <div id="cart-items-out-of-stock" class="cart-items-container"></div>
    <div id="empty-cart-message" class="empty-cart-message" style="display: none;">No items in cart</div>
  </div>

  <div id="cart-summary">
    <p>Total Amount: <span id="total-amount">₱ 0.00</span></p>
    <button id="reserve-now-button" onclick="showConfirmation()" disabled>Reserve Now</button>
  </div>
</div>

<script>

function formatPrice(price) {
    return '₱ ' + price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatQuantity(quantity) {
    if (quantity >= 1000) {
        return (quantity / 1000).toFixed(1) + 'K';
    }
    return quantity.toString();
}

  async function fetchCartItems() {
    const loadingIndicator = document.getElementById("loading-indicator");
    const emptyCartMessage = document.getElementById("empty-cart-message");

    loadingIndicator.classList.add("active");
    emptyCartMessage.style.display = "none"; 

    try {
      const response = await fetch('../../sql/fetch/stock-cart.php');
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const cartItems = await response.json();
      updateCart(cartItems);
    } catch (error) {
      console.error('Error fetching cart items:', error);
    } finally {
      loadingIndicator.classList.remove("active"); 
    }
  }

  function handleCheckboxChange() {
    updateTotal();
    validateQuantities();
    updateCheckoutButton();
    checkSelectAll();
}

function updateCheckoutButton() {
    const checkboxes = document.querySelectorAll(".checkbox");
    const checkoutButton = document.getElementById("reserve-now-button");
    const selectAllContainer = document.getElementById("select-all-container");

    const hasCheckedItems = Array.from(checkboxes).some(checkbox => checkbox.checked);

    selectAllContainer.style.display = checkboxes.length > 1 ? "block" : "none";

    checkoutButton.disabled = !hasCheckedItems;
}

function removeItem(id) {
    alert(`Removing item with ID: ${id}`);
    const itemDiv = document.querySelector(`.cart-item input[value='${id}']`).closest('.cart-item-card');

    fetch('../../sql/delete/stock-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id }), 
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json(); 
    })
    .then(data => {
        console.log('Response data:', data); 
        if (data && data.success) { 
            itemDiv.parentNode.removeChild(itemDiv);
            updateTotal();
            updateCheckoutButton();
            alert("Item removed successfully.");
        } else {
            const message = data.message || "Error: Unable to remove item.";
            alert(message);
        }
    })
    .catch(error => {
        console.error('Error removing item:', error);
        alert("An error occurred while removing the item.");
    });
}


  function updateTotal() {
    const checkboxes = document.querySelectorAll(".checkbox");
    const totalAmountElement = document.getElementById("total-amount");
    let totalAmount = 0;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            const quantityInput = document.getElementById(`quantity-${checkbox.value}`);
            const quantity = quantityInput ? parseInt(quantityInput.value) : 0;

            const priceElement = checkbox.closest('.cart-item').querySelector('p[style*="color: maroon"]');
            const price = priceElement ? parseFloat(priceElement.textContent.replace('₱', '')) : 0;

            totalAmount += price * quantity;
        }
    });

    totalAmountElement.textContent = `${formatPrice(totalAmount.toFixed(2))}`;
}

  function decreaseQuantity(id, sqty) {
    const quantityInput = document.getElementById(`quantity-${id}`);
    let quantity = parseInt(quantityInput.value);

    if (quantity > 1) {
        quantity--;
        quantityInput.value = quantity;
        updateTotal();
        updateItemQuantityOnServer(id, quantity, sqty);
    }
    validateQuantities();
  }


  function increaseQuantity(id, sqty) {
    const quantityInput = document.getElementById(`quantity-${id}`);
    let quantity = parseInt(quantityInput.value);
    const maxQuantity = parseInt(quantityInput.max);

    if (quantity < maxQuantity) {
        quantity++;
        quantityInput.value = quantity;
        updateTotal();
        updateItemQuantityOnServer(id, quantity, sqty);
    }
    validateQuantities();
  }

  function updateItemQuantityOnServer(itemId, quantity, maxQty) {
    console.log(`Updating item ${itemId} to quantity ${quantity}`);
    maxQty += 1; 
    if(maxQty > quantity){
      fetch('../../sql/update/stock-quantity.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ id: itemId, quantity: quantity }),
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log(`Successfully updated item ${itemId} to quantity ${quantity}`); 
          } else {
              console.log(`Error updating item ${itemId}. Please try again.`);
          }
      })
      .catch(error => {
          console.error('Error updating quantity:', error);
          console.log("An error occurred while updating the quantity.");
      });
    }else {
      alert('Quantity input cannot be greater than the avaiable stock');
    }
  }
  
  

  function validateQuantities() {
    const checkboxes = document.querySelectorAll(".checkbox:checked");
    let allValid = true;

    checkboxes.forEach((checkbox) => {
        const id = checkbox.value;
        const quantityInput = document.getElementById(`quantity-${id}`);
        const maxQuantity = parseInt(quantityInput.max);
        const errorContainer = document.getElementById(`error-${id}`);

        if (parseInt(quantityInput.value) > maxQuantity && maxQuantity != 0) {
            errorContainer.textContent = `Max available quantity is ${maxQuantity}.`;
            allValid = false;
        } else {
            errorContainer.textContent = "";
        }
    });
    updateTotal();
    const reserveNowButton = document.getElementById("reserve-now-button");
    reserveNowButton.disabled = !allValid || !document.querySelectorAll(".checkbox:checked").length;
}

function updateCart(cart) {
    const availableItemsContainer = document.getElementById("cart-items-available");
    const outOfStockItemsContainer = document.getElementById("cart-items-out-of-stock");
    const totalAmountElement = document.getElementById("total-amount");
    const emptyCartMessage = document.getElementById("empty-cart-message");
    
    availableItemsContainer.style.borderBottom = "none";
    availableItemsContainer.style.paddingBottom = "0";
    let totalAmount = 0;

    availableItemsContainer.innerHTML = "";
    outOfStockItemsContainer.innerHTML = "";

    if (cart.length === 0) {
        emptyCartMessage.style.display = "block";
        document.getElementById("reserve-now-button").disabled = true;
        return;
    } else {
        emptyCartMessage.style.display = "none";
    }

    let outOfStockCount = 0;

    cart.forEach((item) => {
        const itemTotal = parseFloat(item.price) * parseInt(item.qty);
        if (item.sqty > 0) {
            totalAmount += itemTotal;
        } else {
            outOfStockCount++;
        }

        const itemCard = document.createElement("div");
        itemCard.className = "cart-item-card";
        itemCard.innerHTML = `
            <div class="cart-item">
                ${item.sqty > 0 ? `<input type="checkbox" class="checkbox" value="${item.id}" checked onchange="handleCheckboxChange()">` : ''}
                <div class="image-container">
                    <img src="${item.media ? item.media : '../../src/img/no-image.jpg'}" alt="${item.title}">
                </div>
                <div class="details">
                    <h4>${item.title}</h4>
                    <p class="description">${item.desc ? item.desc : ''}</p>
                    <p id="uprice" style="color: maroon;">${formatPrice(parseFloat(item.price).toFixed(2))}</p>
                    <p class="availability" style="color: ${item.sqty > 5 ? 'green' : item.sqty > 0 ? 'orange' : 'red'};">
                        ${item.sqty > 5 ? 'In Stock' : item.sqty > 0 ? 'Low Stock' : 'Out of Stock'}: ${formatQuantity(item.sqty)}
                    </p>
                    <div class="quantity-container">
                        <span class="material-icons dec-qty" id="dec-qty-${item.id}" onclick="decreaseQuantity('${item.id}', ${item.sqty})" ${item.sqty === 0 ? "style='display: none;'" : ""}>remove</span>
                        <input type="number" class="qty-input" id="quantity-${item.id}" name="quantity" value="${formatQuantity(item.qty)}" min="1" max="${formatQuantity(item.sqty)}" 
                        oninput="updateItemQuantityOnServer('${item.id}', this.value, ${item.sqty}); validateQuantities();" ${item.sqty === 0 ? "disabled" : ""} />
                        <span class="material-icons inc-qty" id="inc-qty-${item.id}" onclick="increaseQuantity('${item.id}', ${item.sqty})" ${item.sqty === 0 ? "style='display: none;'" : ""}>add</span>
                        <p id="error-${item.id}" class="error-message"></p>
                    </div>
                </div>
                <button class="remove-btn" onclick="removeItem('${item.id}')">
                    <span class="material-icons">delete</span>
                </button>
            </div>
        `;
      if (item.sqty > 0) {
          availableItemsContainer.appendChild(itemCard);
      } else {
          outOfStockItemsContainer.appendChild(itemCard);
      }
    });

    if (outOfStockCount > 0) {
        const removeButton = document.createElement("button");
        availableItemsContainer.style.borderBottom = "1px solid rgba(128, 0, 0, 0.6)";
        availableItemsContainer.style.paddingBottom = "40px";
        removeButton.id = "remove-out-of-stock-btn";
        removeButton.textContent = outOfStockCount > 1 ? "Remove All" : "Remove";
        
        removeButton.onclick = () => {
            const confirmation = confirm("Are you sure you want to remove all out-of-stock items?");
            if (confirmation) {
                removeItemsFromServer();
            }
        };

        availableItemsContainer.appendChild(removeButton);
    }

    totalAmountElement.textContent = formatPrice(totalAmount.toFixed(2));
    updateCheckoutButton();
    checkSelectAll();
    validateQuantities();
}

async function removeItemsFromServer() {
    try {
        const response = await fetch('../../sql/delete/stock-cart-oos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);
        } else {
            console.error(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
    fetchCartItems();
}

function toggleSelectAll(checked) {
    const checkboxes = document.querySelectorAll(".checkbox");
    checkboxes.forEach(checkbox => {
        checkbox.checked = checked;
    });
    handleCheckboxChange();
}

  function checkSelectAll() {
    const checkboxes = document.querySelectorAll(".checkbox");
    const selectAllCheckbox = document.getElementById("select-all");

    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    selectAllCheckbox.checked = allChecked;
  }
  
  function showConfirmation() {
    const modal = document.getElementById("confirmation-modal");
    const modalContent = modal.querySelector(".modal-content");

    modal.classList.add("show");
    setTimeout(() => modalContent.classList.add("show"), 50);

    const totalItemsElement = document.getElementById("total-items");
    const totalAmountElement = document.getElementById("modal-total-amount");
    const selectedItemsList = document.getElementById("selected-items-list");

    const checkboxes = document.querySelectorAll(".checkbox:checked");
    const totalAmount = document.getElementById("total-amount").textContent;
    
    totalItemsElement.textContent = checkboxes.length;
    totalAmountElement.textContent = totalAmount;

    selectedItemsList.innerHTML = "";

    checkboxes.forEach((checkbox) => {
        const id = checkbox.value;
        const quantityInput = document.getElementById(`quantity-${id}`);
        const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

        const itemName = checkbox.closest(".cart-item").querySelector("h4").textContent;
        const priceElement = checkbox.closest(".cart-item").querySelector("p[style*='color: maroon']");
        const price = priceElement ? parseFloat(priceElement.textContent.replace('₱', '')) : 0;
        const itemTotalPrice = price * quantity;

        const itemElement = document.createElement("div");
        itemElement.classList.add("selected-item");
        itemElement.innerHTML = `
            <div class="item-name col-5">${itemName}</div>
            <div class="item-quantity col-2">${formatQuantity(quantity)}</div>
            <div class="item-price col-3">${formatPrice(price.toFixed(2))}</div>
            <div class="item-total col-2">${formatPrice(itemTotalPrice.toFixed(2))}</div>
        `;
        selectedItemsList.appendChild(itemElement);
    });
}

function closeModal() {
    const modal = document.getElementById("confirmation-modal");
    const modalContent = modal.querySelector(".modal-content");

    modalContent.classList.remove("show");
    setTimeout(() => modal.classList.remove("show"), 300); 
}

function confirmReservation() {
    closeModal();

    const selectedItems = [];
    const checkboxes = document.querySelectorAll(".checkbox:checked");

    checkboxes.forEach((checkbox) => {
        const id = checkbox.value;
        const quantityInput = document.getElementById(`quantity-${id}`);
        const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
        selectedItems.push({ id, quantity });
    });

    fetch('../../sql/insert/reserve-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ items: selectedItems })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Items reserved successfully!");
            fetchCartItems();
        } else {
            alert(data.message || "Error: Unable to reserve items.");
        }
    })
    .catch(error => {
        console.error('Error reserving items:', error);
        alert("An error occurred while reserving items.");
    });
}

  fetchCartItems();
</script>

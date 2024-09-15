<style>
    .cart-page {
        display: flex;
        padding: 20px;
        background-color: #f4f4f4;
        min-height: 100vh;
        position: relative;
    }

    .cart-content {
        flex: 4; 
        display: flex;
        flex-direction: column;
        align-items: justify;
        width: 100%; 
    }

    .review-list {
        position: fixed; 
        right: 0;
        top: 0;
        padding: 20px;
        border-left: 1px solid #ddd;
        background-color: white;
        width: 20%;
        height: 100vh;
        overflow-y: auto;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .cart-card {
        position: relative;
        display: flex;
        flex-direction: row;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 15px;
        width: 100%; 
        max-width: 80%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        align-items: center;
        box-sizing: border-box;
    }

    .cart-card input[type="checkbox"] {
        margin-right: 15px;
        margin-left: 0;
    }

    .cart-card img {
        width: 150px;
        height: auto;
        border-radius: 5px;
        max-width: 100%;
    }

    .cart-card-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1;
    }

    .cart-item-title {
        font-size: 1.2rem;
        margin: 0;
    }

    .size-selector {
        margin-top: 10px;
    }

    .size-selector select {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .cart-item-quantity {
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .cart-item-quantity input {
        width: 50px;
        padding: 5px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .cart-item-price {
        font-size: 1.1rem;
        color: #888;
        margin-top: 10px;
    }

    .delete-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 1.5rem;
        color: maroon;
        transition: color 0.3s ease;
    }

    .delete-icon:hover {
        color: #600000;
    }

    .review-list-footer {
        margin-top: auto;
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #ddd;
    }

    .review-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .review-item-title {
        font-size: 1rem;
    }

    .review-item-price {
        font-size: 1rem;
        color: #888;
    }

    .checkout-btn {
        background-color: #800000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .checkout-btn:hover {
        background-color: #600000;
    }
</style>
<div class="cart-page container-fluid">
    <div class="cart-content">
        <div class="cart-card">
            <input type="checkbox" class="review-checkbox" data-title="Product 1" data-price="19.99">
            <button class="delete-icon" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="cart-card-content">
                <div>
                    <div class="cart-item-title">Product 1</div>
                    <div class="size-selector">
                        <label for="size-select-1">Size:</label>
                        <select id="size-select-1">
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                        </select>
                    </div>
                    <div class="cart-item-price">$19.99</div>
                </div>
                <div class="cart-item-quantity">
                    <input type="number" value="1" min="1">
                </div>
            </div>
        </div>

        <div class="cart-card">
            <input type="checkbox" class="review-checkbox" data-title="Product 2" data-price="24.99">
            <button class="delete-icon" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>
            <img src="../img/item.jpg" alt="Product 2">
            <div class="cart-card-content">
                <div>
                    <div class="cart-item-title">Product 2</div>
                    <div class="cart-item-price">$24.99</div>
                </div>
                <div class="cart-item-quantity">
                    <input type="number" value="1" min="1">
                </div>
            </div>
        </div>
    </div>

    <div class="review-list" id="review-list">
        <div class="review-list-footer">
            <div class="review-item">
                <span class="review-item-title">Total</span>
                <span class="review-item-price" id="review-total">$44.98</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">Reserve Now</button>
        </div>
    </div>
</div>

<script>
    function removeItem(button) {
        const card = button.closest('.cart-card');
        card.remove();
        updateReviewList();
    }

    function checkout() {
        alert('Proceeding to checkout');
    }

    function updateReviewList() {
        const reviewList = document.getElementById('review-list');
        reviewList.querySelector('.review-list-footer').remove();

        let total = 0;
        const reviewItems = Array.from(document.querySelectorAll('.review-checkbox:checked')).map(checkbox => {
            const title = checkbox.dataset.title;
            const price = parseFloat(checkbox.dataset.price);
            total += price;

            return `
                <div class="review-item">
                    <span class="review-item-title">${title}</span>
                    <span class="review-item-price">$${price.toFixed(2)}</span>
                </div>
            `;
        }).join('');

        reviewList.innerHTML = reviewItems;

        const totalHTML = `
            <div class="review-list-footer">
                <div class="review-item">
                    <span class="review-item-title">Total</span>
                    <span class="review-item-price">$${total.toFixed(2)}</span>
                </div>
                <button class="checkout-btn" onclick="checkout()">Reserve Now</button>
            </div>
        `;
        reviewList.insertAdjacentHTML('beforeend', totalHTML);
    }

    document.querySelectorAll('.review-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateReviewList);
    });
</script>

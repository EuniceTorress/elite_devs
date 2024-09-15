<style>

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 10%;
        height: 100%;
        background-color: #333;
        color: white;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .sidebar h2 {
        color: #fff;
        text-align: center;
        font-size: 1.4rem;
        margin-bottom: 20px;
        padding-top: 20px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        margin: 10px 0;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        font-size: 0.8rem;
        display: block;
        padding: 10px;
        border-radius: 4px;
        transition: background-color 0.3s ease, padding-left 0.3s ease;
        position: relative;
    }

    .sidebar ul li a::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -15px;
        transform: translateY(-50%);
        border: 6px solid transparent;
        border-right-color: transparent;
        border-left-color: transparent;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar ul li a.active::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -15px;
        transform: translateY(-50%);
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 6px solid white; 
        opacity: 1;
    }

    .sidebar ul li a:hover {
        background-color: maroon;
        padding-left: 20px; 
    }

    .sidebar ul li a.active {
        background-color: maroon;
        padding-left: 20px; 
    }


    .main-content {
        margin-left: 10%; 
        padding: 20px;
        width: 90%;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 16px; 
        box-sizing: border-box;
    }

    .card {
        background-color: white;
        border: 1px solid #ddd;
        text-align: justify;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        border: 0.5px solid rgba(128, 5, 5, 0.2);
        transition: transform 0.6s ease, box-shadow 0.3s ease, border 0.2s ease;
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 5px 5px 0 0;
    }

    .card-content {
        padding: 5px 10px;
    }

    .card-title {
        font-size: 1rem;
        margin: 0;
    }

    .card-price {
        color: maroon;
        font-size: 0.8rem;
    }

    .card:hover {
        transform: translateY(-5px); 
        box-shadow: 0 8px 16px rgba(0,0,0,0.2); 
        border: 0.5px solid maroon;
        border-bottom: 4px solid maroon;
    }

    .modal {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 400px;
        text-align: center;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .modal-header h2 {
        margin: 0;
    }

    .close-btn {
        font-size: 1.5rem;
        cursor: pointer;
    }

    .dropdown {
        margin-bottom: 15px;
    }

    .dropdown select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .add-to-cart-btn {
        background-color: #800000;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background-color: #600000;
    }

    @media (max-width: 1200px) {
        .card-container {
            grid-template-columns: repeat(4, 1fr); 
        }
    }

    @media (max-width: 900px) {
        .card-container {
            grid-template-columns: repeat(3, 1fr); 
        }
    }

    @media (max-width: 600px) {
        .card-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }
    }

    @media (max-width: 400px) {
        .card-container {
            grid-template-columns: 1fr; 
        }
    }
</style>

<div class="sidebar">
    <h2>Categories</h2>
    <ul>
        <li><a href="#">All Products</a></li>
        <li><a href="#">Clothing</a></li>
        <li><a href="#">Accessories</a></li>
        <li><a href="#">Footwear</a></li>
        <li><a href="#">Sale Items</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="card-container" id="stocks-container">
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
        <div class="card" data-product='{"title":"Product 1","price":"$19.99","image":"../img/item.jpg"}'>
            <img src="../img/item.jpg" alt="Product 1">
            <div class="card-content">
                <div class="card-title">Product 1</div>
                <div class="card-price">$19.99</div>
            </div>
        </div>
    </div>

    <div class="modal" id="product-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Product Title</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <img id="modal-image" src="" alt="Product Image" style="width: 100%; height: auto;">
            <div class="modal-body">
                <div id="modal-price">Product Price</div>
                <div class="dropdown">
                    <select id="modal-size">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                    </select>
                </div>
                <button class="add-to-cart-btn" onclick="addToCart()">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.card');
    const modal = document.getElementById('product-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalPrice = document.getElementById('modal-price');
    const modalImage = document.getElementById('modal-image');
    const modalSize = document.getElementById('modal-size');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const product = JSON.parse(card.getAttribute('data-product'));
            modalTitle.textContent = product.title;
            modalPrice.textContent = product.price;
            modalImage.src = product.image;
            modal.style.display = 'flex';
        });
    });

    function closeModal() {
        modal.style.display = 'none';
    }

    function addToCart() {
        const selectedSize = modalSize.value;
        if (selectedSize) {
            alert(`Added ${modalTitle.textContent} (Size: ${selectedSize}) to the cart.`);
            closeModal();
        } else {
            alert('Please select a size.');
        }
    }
</script>

<style>
.product-comparison {
    height: 520px;
    width: 53%;
    padding: 10px 20px 20px 20px;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    border: 1px solid rgba(255, 204, 188, 0.7);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    background: transparent;
    transition: box-shadow 0.3s ease-in-out;
}

.search-container {
    margin-bottom: 15px;
    text-align: center;
    flex-shrink: 0;
}

.search-input {
    border-radius: 25px;
    padding: 0.5rem;
    caret-color: maroon;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    outline: none;
    box-shadow: none !important;
    font-size: 0.85rem;
    width: 100%;
    margin-top: 10px;
    border: 1px solid rgba(255, 204, 188, 0.8);
    background: rgba(255, 243, 224, 0.9);
    color: #5a5a5a;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-input:focus {
    border-color: maroon;
    box-shadow: 0 0 0 0.1rem rgba(128, 0, 0, 0.2);
}

.product-cards {
    overflow-y: auto;
    overflow-x: hidden;
    flex-grow: 1;
    height: 430px;
    padding: 10px;
}

.product-card {
    width: 100%;
    border-radius: 10px;
    background: linear-gradient(to bottom right, #fff3e0, #ffe0cc);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 204, 188, 0.7);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 15px;
    padding: 20px;
    cursor: pointer;
    display: flex;
    flex-direction: row;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.h-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
}

.product-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    transition: color 0.3s ease;
}

.product-title:hover {
    color: #5bc0de;
}

.product-image {
    width: 130px;
    height: 130px;
    border-radius: 10px;
    margin-right: 20px;
    border: 1px solid #dcdcdc;
    object-fit: cover;
}

.product-stats {
    margin-top: 15px;
    font-size: 14px;
    color: #6c757d;
    display: flex;
    width: 100%;
    flex-direction: column;
}

.progress-bar-container {
    width: 100%;
    height: 8px;
    background-color: #e9ecef;
    border-radius: 5px;
    margin: 5px 0;
}

.progress-bar {
    height: 100%;
    border-radius: 5px;
    transition: width 0.4s ease-out;
}

.in-stock-bar {
    background-color: #28a745;
}

.sold-bar {
    background-color: #dc3545;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<style>
.product-comparison {
    height: 520px;
    width: 53%;
    padding: 10px 20px 20px 20px;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    border: 1px solid rgba(255, 204, 188, 0.7);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    background: transparent;
    transition: box-shadow 0.3s ease-in-out;
}

.search-container {
    margin-bottom: 15px;
    text-align: center;
    flex-shrink: 0;
}

.search-input {
    border-radius: 25px;
    padding: 0.5rem;
    caret-color: maroon;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    outline: none;
    box-shadow: none !important;
    font-size: 0.85rem;
    width: 100%;
    margin-top: 10px;
    border: 1px solid rgba(255, 204, 188, 0.8);
    background: rgba(255, 243, 224, 0.9);
    color: #5a5a5a;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-input:focus {
    border-color: maroon;
    box-shadow: 0 0 0 0.1rem rgba(128, 0, 0, 0.2);
}

.product-cards {
    overflow-y: auto;
    overflow-x: hidden;
    flex-grow: 1;
    height: 430px;
    padding: 10px;
}

.product-card {
    width: 100%;
    border-radius: 10px;
    background: linear-gradient(to bottom right, #fff3e0, #ffe0cc);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 204, 188, 0.7);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 15px;
    padding: 20px;
    cursor: pointer;
    display: flex;
    flex-direction: row;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.h-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
}

.product-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    transition: color 0.3s ease;
}

.product-title:hover {
    color: #5bc0de;
}

.product-image {
    width: 130px;
    height: 130px;
    border-radius: 10px;
    margin-right: 20px;
    border: 1px solid #dcdcdc;
    object-fit: cover;
}

.product-stats {
    margin-top: 15px;
    font-size: 14px;
    color: #6c757d;
    display: flex;
    width: 100%;
    flex-direction: column;
}

.progress-bar-container {
    width: 100%;
    height: 8px;
    background-color: #e9ecef;
    border-radius: 5px;
    margin: 5px 0;
}

.progress-bar {
    height: 100%;
    border-radius: 5px;
    transition: width 0.4s ease-out;
}

.in-stock-bar {
    background-color: #28a745;
}

.sold-bar {
    background-color: #dc3545;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<section class="product-comparison">
    <div class="search-container">
        <input type="text" id="search" placeholder="Search Products..." class="search-input">
    </div>

    <div class="product-cards">
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search");
    const productCardsContainer = document.querySelector(".product-cards");
    const monthSelect = document.getElementById("month");
    const yearSelect = document.getElementById("year");

    function fetchProducts(month = "", year = "") {
        fetch(`../../sql/dashboard/c-products.php?month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error("Error fetching products:", data.error);
                    productCardsContainer.innerHTML = "<p>No products found.</p>";
                } else {
                    displayProducts(data);
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
                productCardsContainer.innerHTML = "<p>Failed to load products. Try again later.</p>";
            });
    }

    function displayProducts(products) {
    productCardsContainer.innerHTML = ""; 
    products.forEach(product => {
        const productCard = document.createElement("div");
        productCard.className = "product-card";
        productCard.setAttribute("data-title", product.name || "Unknown Product");

        const productImage = product.media ? 
            `<img src="${product.media}" alt="${product.name}" class="product-image">` : 
            `<img src="../../src/img/no-image.jpg" alt="Default Image" class="product-image">`;

        const inStockPercent = product.rqty ? (product.rqty / product.quantity) * 100 : 0;
        const soldPercent = product.total_sales ? (product.total_sales / product.quantity) * 100 : 0;

        productCard.innerHTML = `
            <div class="h-wrapper">
                ${productImage}
            </div>
            <div class="product-stats">
                <h5 class="product-title">${product.name}</h5>
                <div>In Stock: ${product.rqty}</div>
                <div class="progress-bar-container">
                    <div class="progress-bar in-stock-bar" style="width: ${inStockPercent}%;"></div>
                </div>
                <div>Sold: ${product.total_sales}</div>
                <div class="progress-bar-container">
                    <div class="progress-bar sold-bar" style="width: ${soldPercent}%;"></div>
                </div>
            </div>
        `;
        productCardsContainer.appendChild(productCard);
    });
}


    searchInput.addEventListener("input", function() {
        const query = searchInput.value.toLowerCase();
        const productCards = document.querySelectorAll(".product-card");
        productCards.forEach(card => {
            const title = card.getAttribute("data-title").toLowerCase();
            card.style.display = title.includes(query) ? "block" : "none";
        });
    });

    monthSelect.addEventListener("change", function() {
        const month = monthSelect.value;
        const year = yearSelect.value;
        fetchProducts(month, year);
    });

    yearSelect.addEventListener("change", function() {
        const month = monthSelect.value;
        const year = yearSelect.value;
        fetchProducts(month, year);
    });

    fetchProducts();
});

</script>

<style>
.product-container {
  display: flex;
  overflow-x: scroll;
  gap: 16px;
  padding: 16px 0;
  scroll-snap-type: x mandatory;
}

.product-item {
  flex-shrink: 0;
  width: 200px;
  text-align: center;
  scroll-snap-align: start; 
}

.product-item img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.product-item p {
  margin-top: 8px;
  font-size: 16px;
  color: #333;
}

    </style>
  <div class="product-container">
    <div class="product-item">
      <img src="https://via.placeholder.com/200x200" alt="Product 1">
      <p>Product 1</p>
    </div>
    <div class="product-item">
      <img src="https://via.placeholder.com/200x200" alt="Product 2">
      <p>Product 2</p>
    </div>
    <div class="product-item">
      <img src="https://via.placeholder.com/200x200" alt="Product 3">
      <p>Product 3</p>
    </div>
    <div class="product-item">
      <img src="https://via.placeholder.com/200x200" alt="Product 4">
      <p>Product 4</p>
    </div>
    <div class="product-item">
      <img src="https://via.placeholder.com/200x200" alt="Product 5">
      <p>Product 5</p>
    </div>
  </div>

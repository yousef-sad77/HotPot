<!-- Cart Content -->


<div class="container my-5">
  <h2 class="mb-4 text-center">Your Cart</h2>

  <!-- Cart Items -->
  <div class="row g-4">
    <div class="col-md-8">
      <ul class="list-group shadow">
        <!-- Example Item -->
        <li class="list-group-item">
          <div class="row text-center align-items-center">
            
            <!-- Left: Image -->
            <div class="col-md-6 d-flex justify-content-center">
              <img src="./assets/images/chorizo-mozarella-gnocchi-bake-cropped.jpg" class="rounded w-100" alt="Meal Image" />
            </div>
        
            <!-- Right: Food name + order counter -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
              <div class="food-name mb-2">
                <h5 class="mb-1">Grilled Chicken</h5>
                <small class="text-muted">Served with veggies</small>
              </div>
              <div class="order-counter d-flex align-items-center justify-content-center gap-2">
                <p class="mb-0 fw-semibold">$12.99</p>
                <input type="number" class="form-control form-control-sm w-auto" value="1" style="max-width: 70px;" />
                <button class="btn btn-sm btn-danger">Remove</button>
              </div>
            </div>
        
          </div>
        </li>
        <li class="list-group-item">
          <div class="row text-center align-items-center">
            
            <!-- Left: Image -->
            <div class="col-md-6 d-flex justify-content-center">
              <img src="./assets/images/chorizo-mozarella-gnocchi-bake-cropped.jpg" class="rounded w-100" alt="Meal Image" />
            </div>
        
            <!-- Right: Food name + order counter -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
              <div class="food-name mb-2">
                <h5 class="mb-1">Grilled Chicken</h5>
                <small class="text-muted">Served with veggies</small>
              </div>
              <div class="order-counter d-flex align-items-center justify-content-center gap-2">
                <p class="mb-0 fw-semibold">$12.99</p>
                <input type="number" class="form-control form-control-sm w-auto" value="1" style="max-width: 70px;" />
                <button class="btn btn-sm btn-danger">Remove</button>
              </div>
            </div>
        
          </div>
        </li>
        

        <!-- Repeat similar items -->
        <!-- ... -->
      </ul>
    </div>

    <!-- Cart Summary -->
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title">Order Summary</h5>
          <hr />
          <p class="d-flex justify-content-between mb-2">
            <span>Subtotal:</span>
            <span>$25.98</span>
          </p>
          <p class="d-flex justify-content-between mb-2">
            <span>Delivery:</span>
            <span>$3.00</span>
          </p>
          <p class="d-flex justify-content-between mb-2">
            <span>Tax:</span>
            <span>$2.60</span>
          </p>
          <hr />
          <h5 class="d-flex justify-content-between">
            <span>Total:</span>
            <span>$31.58</span>
          </h5>
          <button class="btn btn-success w-100 mt-3">Proceed to Checkout</button>
        </div>
      </div>
    </div>

  </div>
</div>
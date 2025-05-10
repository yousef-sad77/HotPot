
<?php
// Connect to your DB
require_once('./MVC/module/db_connect.php');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$uuid = isset($_GET['uuid']) ? $_GET['uuid'] : '';

if ($uuid) {
  $stmt = $conn->prepare("SELECT * FROM products WHERE uuid = ?");
  $stmt->bind_param("s", $uuid);
  $stmt->execute();
  $result = $stmt->get_result();
  $product = $result->fetch_assoc();
} else {
  die("Product not found.");
}
?>
<!-- Hero Background -->
<div class="position-relative text-white"
  style="background: url('<?php echo htmlspecialchars($product['image']); ?>') center/cover no-repeat; height: 60vh;">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.4);"></div>
  <div class="container h-100 d-flex flex-column justify-content-center align-items-start position-relative">
    <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($product['description']); ?></p>
  </div>
</div>


<!-- Product Details -->
<div class="container py-5">
  <div class="row">
    <!-- Left Column: Description -->
    <div class="col-md-7">
      <h2>About the Meal</h2>
      <p class="text-muted w-75">
        <?php echo nl2br(htmlspecialchars($product['long_description'])); ?>
      </p>

      <ul>
        <li>Includes side salad and drink</li>
        <li>Gluten-free option available</li>
        <li>Serves 1-2 people</li>
      </ul>
    </div>

    <!-- Right Column: Variations -->
    <div class="col-md-5">
      <h4>Choose a Variation</h4>
      <form>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="variation" id="standard" checked>
          <label class="form-check-label" for="standard">
            Standard - $<?php echo htmlspecialchars($product['price']); ?>
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="variation" id="extraVeg">
          <label class="form-check-label" for="extraVeg">
            With Extra Veggies - $<?php echo number_format($product['price'] + 5, 2); ?>
          </label>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" type="radio" name="variation" id="doubleChicken">
          <label class="form-check-label" for="doubleChicken">
            Double Chicken - $<?php echo number_format($product['price'] + 10, 2); ?>
          </label>
        </div>

        <button type="button" class="btn btn-primary w-100">Add to Cart</button>
      </form>
    </div>
  </div>
</div>
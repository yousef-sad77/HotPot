<?php
// var_dump($_SERVER['DOCUMENT_ROOT'] );
require_once './MVC/module/db_connect.php';
$sql = "SELECT uuid ,product_name, price, description, image FROM products";
$result = $conn->query($sql);
?>

<main>
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card border-0 w-auto">
                            <div class="card-header bg-light">
                                <?php echo htmlspecialchars($row['product_name']); ?>
                            </div>

                            <div class="image-container">
                                <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($row['product_name']); ?>" />
                            </div>

                            <div class="card-body bg-light rounded-bottom-3">
                                <p class="mb-0"><?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="card-title fw-bold"><?php echo $row['price']; ?>$</p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                                <a href="index.php?page=product&uuid=<?php echo urlencode($row['uuid']); ?>" class="btn btn-secondary">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
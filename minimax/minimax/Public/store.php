<div id="home" style="background-image: url('https://d33kuhj6eu7i5b.cloudfront.net/thumbnails/xxl/9116/9989/3254/bg-green.png'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-6 col-md-6 col-sm-offset-6 col-sm-6">
                <div class="container">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../src\products.php";
require "../src\config.php";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
try {
    require_once "../src/DBconnect.php";


    function getProducts($connection) {
        $stmt = $connection->query("SELECT * FROM Products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    $productsData = getProducts($connection);


    $products = [];
    foreach ($productsData as $productData) {
        $products[] = new Product($productData['idProducts'], $productData['productName'], $productData['price'], $productData['imgSRC']);
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][] = $product_id;

}

$pageTitle = "LOI Merchandise";
include "../templates/header.php"
?>
<br><br><br><br>



<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">

                        <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="<?php echo $product->getName(); ?>"/>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo $product->getName(); ?></h5>
                                $<?php echo number_format($product->getPrice(), 2); ?>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product->idProducts; ?>">
                                <div class="text-center"><button type="submit" name="add_to_cart" class="btn btn-outline-dark mt-auto">Add to cart</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/scripts.js"></script>
<?php include "../templates/footer.php"; ?>
</body>
</html>

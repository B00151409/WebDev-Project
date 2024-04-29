<?php
require_once 'config.php';
require_once 'DBconnect.php';

// Define a class for Product
class Product {
    // Properties
    public $idProducts;
    public $productName;
    public $price;
    public $imgSRC;

    // Constructor
    public function __construct($idProducts, $productName, $price, $imgSRC) {
        $this->idProducts = $idProducts;
        $this->productName = $productName;
        $this->price = $price;
        $this->imgSRC = $imgSRC;
    }

    // Getter method for image source
    public function getImage() {
        return $this->imgSRC;
    }

    // Getter method for product name
    public function getName() {
        return $this->productName;
    }

    // Getter method for product price
    public function getPrice() {
        return $this->price;
    }

    // Getter method for product ID
    public function getId() {
        return $this->idProducts;
    }
}

// Define a class for Product Database Operations
class ProductDatabase
{

    private $conn;

    // Constructor
    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    // Method to add a product
    public function addProduct($productName, $price, $imgSRC) {
        // Check if the product already exists
        $existingProduct = $this->getProductByName($productName);
        if ($existingProduct !== null) {
            // Product already exists, return false or handle the situation
            return false;
        }

        // Product doesn't exist, proceed to add
        $sql = "INSERT INTO products (productName, price, imgSRC) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productName, $price, $imgSRC]);

        return true;
    }

    // Method to get all products
    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $products = [];

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $product = new Product($row['idProducts'], $row['productName'], $row['price'], $row['imgSRC']); // Update column name
                $products[] = $product;
            }
        }

        return $products;
    }

    // Method to get a product by ID
    public function getProductById($idProducts)
    {
        $sql = "SELECT * FROM products WHERE idProducts = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idProducts]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $product = new Product($row['idProducts'], $row['productName'], $row['price'], $row['imgSRC']); // Update column name
            return $product;
        } else {
            return null; // Product not found
        }
    }

    // Method to get a product by name
    public function getProductByName($productName)
    {
        $sql = "SELECT * FROM products WHERE productName = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productName]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $product = new Product($row['idProducts'], $row['productName'], $row['price'], $row['imgSRC']); // Update column name
            return $product;
        } else {
            return null; // Product not found
        }
    }

}


$productDb = new ProductDatabase($connection);
// Define products to be added
$productsToAdd = [
    ["Drogheda Jersey", 50.00, "https://img.resized.co/balls_ie/eyJkYXRhIjoie1widXJsXCI6XCJodHRwczpcXFwvXFxcL21lZGlhLmJhbGxzLmllXFxcL3VwbG9hZHNcXFwvMjAyNFxcXC8wMlxcXC8xNTE4MDAxMVxcXC8yNzIwOTMwLmpwZ1wiLFwid2lkdGhcIjpcIjc2OFwiLFwiaGVpZ2h0XCI6XCI1MDBcIixcImRlZmF1bHRcIjpcImh0dHBzOlxcXC9cXFwvd3d3LmJhbGxzLmllXFxcL2ltYWdlc1xcXC9icmFuZC1pbWFnZS5qcGdcIixcIm9wdGlvbnNcIjp7XCJvdXRwdXRcIjpcIndlYnBcIixcInF1YWxpdHlcIjo5OX19IiwiaGFzaCI6IjU1YzBkZGM2OWM5OWYyNzg4NThjNDhlYzZiYTZlMDIwMjE1MDVjODUifQ==/the-definitive-ranking-of-every-league-of-ireland-home-kit-for-2024.jpg"],
    ["Starter Subscription", 5.00,"https://img.freepik.com/premium-vector/bronze-circle-plate-background-bronze-metal-round-medal-button-metallic-bright-element-vector-illustration_561158-1392.jpg"],
    ["Business Subscription", 10.00, "https://media.istockphoto.com/id/1384723951/vector/silver-stamp-isolated-on-white-background-luxury-seal-vector-design-element.jpg?s=612x612&w=0&k=20&c=ZS2k7XCY8qDSy-8E9l9kaS2DfkHlLHa2cyh8exqd8hA="],
    ["Advanced Subscription", 25.00,"https://media.istockphoto.com/id/1581618817/vector/3d-gold-award-badge-with-circle-frame-round-shiny-blank-medal-for-prize-luxury-emblem.jpg?s=612x612&w=0&k=20&c=VisRUjnijsnkbyxb6sAt7dFMx1HKkD2X_2yyG7kNLdA="],
];

// Add products to the database
foreach ($productsToAdd as $product) {
    $productName = $product[0];
    $price = $product[1];
    $imgSRC = $product[2];
    $productDb->addProduct($productName, $price, $imgSRC);
}

// Retrieve all products from the database
$products = $productDb->getAllProducts();

// Display products
foreach ($products as $product) {
}

?>

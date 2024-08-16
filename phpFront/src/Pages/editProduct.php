<?php
require_once "src/models/CRUD.php";
require_once "src/layout/header.php";

$CRUD = new CRUD();

$message = "";


$productId = intval($_GET["product"]) ? $_GET["product"] : $message = "Id must be a number";


$product = $CRUD->getProducts($_ENV["getOneURL"] . $productId);


if (is_string($product)) {
    header("Location: /products/manage");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["delete"])) {
        $CRUD->deleteProduct($_ENV["deleteURL"] . $productId);
        $message = "Product deleted";
        header("Location: /products/manage");

    } else {
        try {
            $updatedProduct = new stdClass();

            $updatedProduct->name = $_POST["name"];
            $updatedProduct->price = intval($_POST["price"]);
            $updatedProduct->stock = intval($_POST["stock"]);
            $updatedProduct->category = $_POST["category"] ?? $product->category;
            $updatedProduct->description = $_POST["description"];
            $updatedProduct->url = $_POST["image"];

            $response = $CRUD->postOrPutProduct($_ENV["putURL"] . $productId, $updatedProduct, false);


            $product = $CRUD->getProducts($_ENV["getOneURL"] . $productId);

            $message = $updatedProduct->name . " success fully updated.";

        } catch (Exception) {
            $message = "Error";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style/style.css">
    <title>Edit Product</title>
</head>

<body>
    <?php headerNav() ?>
    <main>

        <section class="edit__form__container">
            <form method="POST" class="edit__form__data">

                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" id="name" value="<?= $product->name ?>" required>

                <label for="price">Price</label>
                <input type="number" placeholder="Price" name="price" id="price" value="<?= $product->price ?>"
                    required>

                <label for="image">Image</label>
                <input type="text" placeholder="URL" name="image" id="image" value="<?= $product->url ?>">

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option selected hidden disabled value="<?= $product->category ?>">
                        <?= $product->category ?>
                    </option>
                    <option value="Laptop">Laptop</option>
                    <option value="Phone">Phone</option>
                    <option value="Computer">Computer</option>
                </select>

                <label for="stock">Stock</label>
                <input type="number" placeholder="Stock" name="stock" id="stock" value="<?= $product->stock ?>"
                    required>

                <label for="description">Description</label>
                <textarea placeholder="Description" name="description"
                    id="description"><?= $product->description ?></textarea>

                <input type="submit" name="submit" value="Update Product" class="updateButton">
            </form>
            <form method="POST" class="edit__form__delete">
                <input class="delete__product" type="submit" name="delete" id="delete" value="Delete">
            </form>

            <div>
                <?= $message ?>
            </div>
        </section>
    </main>
    <?php footerNav(); ?>
</body>

</html>
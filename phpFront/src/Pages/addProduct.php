<?php
require_once "src/models/CRUD.php";
require_once "src/layout/header.php";
$CRUD = new CRUD();

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $newProduct = new stdClass();

        $newProduct->id = 0;
        $newProduct->name = $_POST["name"];
        $newProduct->price = intval($_POST["price"]);
        $newProduct->stock = intval($_POST["stock"]);
        $newProduct->category = $_POST["category"];
        $newProduct->description = $_POST["description"];
        $newProduct->url = $_POST["image"] ?? "";

        $CRUD->postOrPutProduct($_ENV["postURL"], $newProduct);

        $message = $newProduct->name . " success fully added.";
    } catch (Exception) {
        $message = "Error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style/style.css">
    <title>Create Product</title>
</head>

<body>
    <?php
    headerNav()
        ?>
    <main>
        <section class="edit__form__container">
            <form method="POST" class="edit__form__data">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" id="name" required>

                <label for="price">Price</label>
                <input type="number" placeholder="Price" name="price" id="price">

                <label for="image">Image</label>
                <input type="text" placeholder="Image" name="image" id="image">

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="Laptop">Laptop</option>
                    <option value="Phone">Phone</option>
                    <option value="Computer">Computer</option>
                </select>


                <label for="stock">Stock</label>
                <input type="number" placeholder="Stock" name="stock" id="stock">

                <label for="description">Description</label>
                <textarea placeholder="Description" name="description" id="description"></textarea>

                <input type="submit" name="submit" value="Add Product" class="updateButton">
            </form>
            <h2>
                <?= $message ?>
            </h2>
        </section>
    </main>
    <?php footerNav(); ?>
</body>

</html>
<?php
require_once "src/models/CRUD.php";
require_once "src/models/SaveProducts.php";
require_once "src/layout/header.php";

$SaveProduct = new SaveProducts();
$CRUD = new CRUD();

$products = $CRUD->getProducts($_ENV["getURL"]);


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    switch ($_POST["saveData"]) {
        case "xml":
            $SaveProduct->xml($products);
            break;
        case "csv":
            $SaveProduct->csv($products);
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style/style.css">
    <title>Product Management</title>
</head>

<body>
    <?php
    headerNav();
    ?>

    <main class="manage_products__main">
        <section class="manage_products__headers">
            <div>
                <form method="GET">
                    <input type="text" placeholder="Search product name or id" name="search">
                    <input type="submit" value="Search">
                </form>
            </div>
            <article class="manage_products__save_as">
                <div>
                    <form method="POST">
                        <label for="saveData">Save as</label>
                        <select name="saveData" id="saveData">
                            <option value="xml">XML</option>
                            <option value="csv">CSV</option>
                        </select>
                        <input type="submit" value="Download" class="add__product__tag">

                    </form>
                </div>
                <div> <a href="/products/manage/add" class="add__product__tag">Add Product</a>

                </div>
            </article>

        </section>
        <section class="table__container">

            <table>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
                <?php
                foreach ($products as $product) {
                    ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td><img src="<?= $product->url ?>" alt=" "></td>
                        <td><?= $product->name ?></td>
                        <td><?= $product->category ?></td>
                        <td><?= $product->price ?> SEK</td>
                        <td><?= $product->stock ?> st</td>
                        <td> <a href="/products/manage/edit?product=<?= $product->id ?>" class="edit__product__tag">Edit</a>
                        </td>
                    </tr>
                <?php }
                ?>


            </table>
        </section>
    </main>

    <?php footerNav(); ?>
</body>

</html>
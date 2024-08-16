<?php
require_once "src/layout/header.php";
require_once "src/models/CRUD.php";
$CRUD = new CRUD();

$products = $CRUD->getProducts($_ENV["getURL"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style/style.css">
    <title>Products</title>
</head>

<body>
    <?php
    headerNav();
    ?>
    <main>


        <section class="products__container">


            <?php foreach ($products as $product) {
                ?>
                <article class="product__card">
                    <img src="<?= $product->url ?>">

                    <div>
                        <h2>
                            <?= $product->name ?>
                        </h2>

                        <span>
                            <?= $product->price ?>.-
                        </span>
                    </div>

                </article>

                <?php
            }


            ?>
        </section>
    </main>
    <?php footerNav(); ?>
</body>

</html>
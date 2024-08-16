<?php
class SaveProducts
{
    function csv($products)
    {

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename products.csv");

        $file = fopen("php://output", "w");

        fputcsv($file, [
            "id",
            "name",
            "price",
            "stock",
            "category",
            "description",
            "url"
        ]);

        foreach ($products as $product) {
            fputcsv($file, (array) $product);
        }
        fclose($file);
        exit;
    }
    function xml($products)
    {

        header("Content-type: text/xml");
        header("Content-Disposition: attachment; filename products.xml");

        $xml = new SimpleXMLElement("<productList/>");


        foreach ($products as $product) {
            $XMLChild = $xml->addChild("product");
            $XMLChild->addChild("id", $product->id);
            $XMLChild->addChild("name", $product->name);
            $XMLChild->addChild("url", $product->url);
            $XMLChild->addChild("price", $product->price);
            $XMLChild->addChild("stock", $product->stock);
            $XMLChild->addChild("category", $product->category);
            $XMLChild->addChild("description", $product->description);
        }

        echo $xml->asXML();
        exit;
    }
}

?>
import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import { writeFileSync } from "fs";
import { IProduct } from "./models/IProduct";

const data = require("../tmp/data.json");

dotenv.config();

let products: IProduct[] = data;

const app = express();
const port = process.env.PORT;

app.use(cors(), express.json());

app.get("/api/products", (req, res) => {
  res.send(JSON.stringify(data));
});

app.get("/api/product/:product_id", (req, res) => {
  const product_id = req.params.product_id;

  const productIndex = products.findIndex(
    (product) => product.id === parseInt(product_id)
  );
  if (productIndex === -1) {
    return res.json("Product did not exist with id " + product_id);
  } else {
    res.json(products[productIndex]);
  }
});

app.put("/api/update/:product_id", (req, res) => {
  const product_id = req.params.product_id;
  const updatedProduct = req.body;

  if (!updatedProduct) {
    return res.json("Obj product is required");
  }
  const productIndex = products.findIndex(
    (product) => product.id === parseInt(product_id)
  );
  if (productIndex === -1) {
    return res.json("Product did not exist");
  } else {
    products[productIndex] = { ...products[productIndex], ...updatedProduct };

    writeFileSync("./tmp/data.json", JSON.stringify(products, null, 2));

    res.json(products[productIndex]);
  }
});

app.post("/api/add/product", (req, res) => {
  const newProduct: IProduct = req.body;

  console.log(products.length);
  const newProductId =
    products.length === 0 ? 1 : products[products.length - 1].id + 1;

  const finalProduct = { ...newProduct, id: newProductId };

  console.log("new product", finalProduct);
  products = [...products, finalProduct];

  writeFileSync("./tmp/data.json", JSON.stringify(products, null, 2));

  res.send(finalProduct);
});

app.delete("/api/delete/:product_id", (req, res) => {
  const productId = req.params.product_id;

  const index = products.findIndex(
    (product) => product.id === parseInt(productId)
  );
  if (index !== -1) {
    products.splice(index, 1);

    writeFileSync("./tmp/data.json", JSON.stringify(products, null, 2));

    return res.json("Succeed to delete product with id " + productId);
  }

  res.json("Failed to delete item");
});

app.listen(port, () => {
  console.log("Server is running on port: " + port);
});
module.exports = app;

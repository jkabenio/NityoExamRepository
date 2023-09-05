<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Product</title>

    <link href="/css/app.css" rel="stylesheet">
  </head>
  <body>
  <h2 align="center"><b>Product Form</b></h2>
<div class="error"></div>
<form id="product-form" action="" enctype="multipart/form-data">
  <div class="container-md">
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Product Name</span>
          <input type="text" class="form-control" aria-label="productName" aria-describedby="basic-addon1" id="add_prod_name" name="prod_name" required minlength="4" maxlength="20">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon2">Unit</span>
          <input type="text" class="form-control" aria-label="Unit" aria-describedby="basic-addon2" id="add_unit" name="unit" required minlength="4" maxlength="20">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">Price</span>
          <input type="number" class="form-control" aria-label="Price" aria-describedby="basic-addon3" id="add_price" name="price" step="any" required minlength="1" maxlength="10">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon4">Expiration Date</span>
          <input type="date" class="form-control" aria-label="ExpirationDate" aria-describedby="basic-addon4" id="add_expiration_date" name="expiration_date" step="any" required>
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon5">Available Product</span>
          <input type="number" class="form-control" aria-label="AvailableProduct" aria-describedby="basic-addon5" id="add_available" name="available" required minlength="1" maxlength="10">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon6">Image</span>
          <input type="file" class="form-control" aria-label="ProductImage" aria-describedby="basic-addon6" id="add_image" name="image" required accept=".jpg, .jpeg, .png">
      </div>
      <div style="float: right">
          <a href="/" class="btn btn-primary">Show Product</a>
          <button class="btn btn-success" type="button" onclick="submitData('insertProduct');">Submit</button>
      </div>
    
  </div>
  
</form>
<?php require 'script.php'; ?>
  </body>
</html>

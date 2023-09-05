<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="/css/app.css" rel="stylesheet">
    <title>Edit User</title>
  </head>
  <body>
  <h2 align="center"><b>Edit Product</b></h2>
    <form autocomplete="off" action="" method="post">
      <?php
      require 'config.php';
      $id = $_GET["id"];
      $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $id"));
      ?>
      <div class="container-md">
      <input type="hidden" id="edit_id" name="id" value="<?php echo $rows['id']; ?>">

      <div class="input-group mb-3">
        
          <span class="input-group-text" id="basic-addon1">Product Name</span>
          <input type="text" class="form-control" aria-label="productName" aria-describedby="basic-addon1" id="edit_prod_name" name="prod_name" required minlength="4" maxlength="20" value="<?php echo $rows['prod_name']; ?>">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon2">Unit</span>
          <input type="text" class="form-control" aria-label="Unit" aria-describedby="basic-addon2" id="edit_unit" name="unit" required minlength="4" maxlength="20" value="<?php echo $rows['unit']; ?>">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">Price</span>
          <input type="number" class="form-control" aria-label="Price" aria-describedby="basic-addon3" id="edit_price" name="price" step="any" required minlength="1" maxlength="10" value="<?php echo $rows['price']; ?>">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon4">Expiration Date</span>
          <input type="date" class="form-control" aria-label="ExpirationDate" aria-describedby="basic-addon4" id="edit_expiration_date" name="expiration_date" step="any" required value="<?php echo $rows['expiration_date']; ?>">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon5">Available Product</span>
          <input type="number" class="form-control" aria-label="AvailableProduct" aria-describedby="basic-addon5" id="edit_available" name="available" required minlength="1" maxlength="10" value="<?php echo $rows['available']; ?>">
      </div>
      
      <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon6"></span>
          <input type="file" class="form-control" aria-label="ProductImage" aria-describedby="basic-addon6" id="edit_image" name="image" required accept=".jpg, .jpeg, .png" value="<?php echo $rows['image']; ?>">
      </div>
      <div style="float: right">
          <a href="/" class="btn btn-primary">Show Product</a>
          <button class="btn btn-success" type="button" onclick="submitEdit('editProduct');">Save Changes</button>
      </div>
    
  </div>
    </form>
    <br>
    <?php require 'script.php'; ?>
  </body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Product Management</title>
    <link href="/css/app.css" rel="stylesheet">
  </head>
  <body>
    <style>
    td{
        width:14.28%;
    }
    th{
        text-align: center;
    }
    .container-md{
        width: 100%;
    }
</style>
<div>
    <h1 align="center"> <b>Product List</b> </h1>
</div>
<div class="container-md">
    
    
    <div style="float: left; margin-bottom: 0.5rem">
    <br>
    <!-- <a href="adduser.php">Add User</a> -->
    <?php require 'script.php'; ?>
        <a href="/add-product" class="btn btn-primary">Create Product</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Unit</th>
                <th scope="col">Price</th>
                <th scope="col">Date of Expiry</th>
                <th scope="col">Available Inventory</th>
                <th scope="col">Image</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>

       
        <tbody id="product-list">
        <?php
          require 'config.php';
          $rows = mysqli_query($conn, "SELECT * FROM products");
          $i = 1;
        ?>
        <?php foreach($rows as $row) : ?>
        <tr id = <?php echo $row["id"]; ?>>
          <td><?php echo $i++; ?></td>
          <td><?php echo $row["prod_name"]; ?></td>
          <td><?php echo $row["unit"]; ?></td>
          <td><?php echo $row["price"]; ?></td>
          <td><?php echo date("F j, Y", strtotime($row["expiration_date"])); ?></td>
          <?php 
            $cost = $row["available"] * $row["price"];
          ?>
          <td>Quantity: <?php echo number_format($row["available"]) ?><br>Total Cost: <?php echo number_format($cost, 2) ?></td>

          <td><img src="<?php echo $row["image"]; ?>" alt="Product Image" width="50%" height="50%"></td>

          <td>
            <a class="btn btn-success update-product" href="edit-Product.php?id=<?php echo $row['id']; ?>">Edit</a>
          </td>
          <td><button type="button" class="btn btn-danger" onclick="deleteProduct(<?php echo $row['id']; ?>);">Delete</button></td>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

  </body>
</html>

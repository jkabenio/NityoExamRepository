<?php
require 'config.php';

if(isset($_POST["action"])){
  if($_POST["action"] == "insertProduct"){
    insertProduct();
  }
  else if($_POST["action"] == "editProduct"){
    editProduct();
  }
  else{
    deleteProduct();
  }
}

function insertProduct(){
  global $conn;

  $name = $_POST["prod_name"];
  $unit = $_POST["unit"];
  $price = $_POST["price"];
  $exp_date = $_POST["expiration_date"];
  $available = $_POST["available"];

  // Handle file upload
  $image = $_FILES["image"]["name"];  // Get the original file name
  $image_tmp = $_FILES["image"]["tmp_name"];  // Get the temporary file path

  // Define the target directory where you want to store the uploaded image
  $target_directory = "upload_images/";

  // Create a unique file name for the uploaded image to avoid overwriting
  $unique_image_name = uniqid() . "_" . $image;

  // Define the full path to the uploaded image
  $target_path = $target_directory . $unique_image_name;

  // Move the uploaded file to the specified directory
  if (move_uploaded_file($image_tmp, $target_path)) {
    // The file was successfully uploaded, now insert data into the database
    $query = "INSERT INTO products (prod_name, unit, price, expiration_date, available, image) VALUES ('$name', '$unit', '$price', '$exp_date', '$available', '$target_path')";
    
    if (mysqli_query($conn, $query)) {
      echo "Inserted Successfully";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  } else {
    echo "Failed to upload the file.";
  }
}


function editProduct() {
  global $conn;

  $id = $_POST["id"];
  $prod_name = $_POST["prod_name"];
  $unit = $_POST["unit"];
  $price = $_POST["price"];
  $exp_date = $_POST["expiration_date"];
  $available = $_POST["available"];

  // Check if a new image file has been uploaded
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    // Handle the uploaded image
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];

    // Define the target directory where you want to store the uploaded image
    $target_directory = "upload_images/";

    // Create a unique file name for the uploaded image to avoid overwriting
    $unique_image_name = uniqid() . "_" . $image_name;

    // Define the full path to the uploaded image
    $target_path = $target_directory . $unique_image_name;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($image_tmp, $target_path)) {
      // Update the product information in the database, including the image path, using prepared statements
      $query = "UPDATE products SET prod_name = ?, unit = ?, price = ?, expiration_date = ?, available = ?, image = ? WHERE id = ?";
      $stmt = mysqli_prepare($conn, $query);
      
      if ($stmt === false) {
        echo "Prepare failed: " . mysqli_error($conn);
        return;
      }

      // Bind parameters
      mysqli_stmt_bind_param($stmt, "ssdsssi", $prod_name, $unit, $price, $exp_date, $available, $target_path, $id);

      // Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        echo "Updated Successfully";
      } else {
        echo "Update failed: " . mysqli_error($conn);
      }

      mysqli_stmt_close($stmt);
    } else {
      echo "Failed to upload the image.";
    }
  } else {
    // Update the product information in the database without changing the image
    $query = "UPDATE products SET prod_name = ?, unit = ?, price = ?, expiration_date = ?, available = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt === false) {
      echo "Prepare failed: " . mysqli_error($conn);
      return;
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssdssi", $prod_name, $unit, $price, $exp_date, $available, $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
      echo "Updated Successfully";
    } else {
      echo "Update failed: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
  }
}



function getProductName($id) {
  global $conn;
  $query = "SELECT image FROM products WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $image);
    
    if (mysqli_stmt_fetch($stmt)) {
      mysqli_stmt_close($stmt);
      return $image;
    } else {
      mysqli_stmt_close($stmt);
      return null;
    }
  } else {
    echo "Failed to prepare the query.";
    return null;
  }
}


function deleteProduct() {
  global $conn;

  $id = $_POST["id"];

  // Get the image filename associated with the product
  $image = getProductName($id);

  if ($image !== null) {
    // Delete the image file from its storage location
    $imagePath = "" . $image;
    if (file_exists($imagePath)) {
      unlink($imagePath); // Delete the image file
    }
  }

  // Now, delete the product record from the database
  $query = "DELETE FROM `products` WHERE `id` = ?";
  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "Deleted Successfully";
  } else {
    echo "Failed to prepare the query.";
  }
}



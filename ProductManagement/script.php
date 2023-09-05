<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function submitData(action) {
    $(document).ready(function () {
      var data = new FormData();
      data.append("action", action);
      data.append("prod_name", $("#add_prod_name").val());
      data.append("unit", $("#add_unit").val());
      data.append("price", $("#add_price").val());
      data.append("expiration_date", $("#add_expiration_date").val());
      data.append("available", $("#add_available").val());
      // Append the selected file to the FormData object
      var imageInput = document.getElementById("add_image");
      if (imageInput.files.length > 0) {
        data.append("image", imageInput.files[0]);
      }

      $.ajax({
        url: 'function.php',
        type: 'post',
        processData: false, // Prevent jQuery from processing data
        contentType: false, // Prevent jQuery from setting content type
        data: data,
        success: function (response) {
          alert(response);
          if (response == "Inserted Successfully") {
            // Clear form fields on successful insertion
            $("#add_prod_name").val("");
            $("#add_unit").val("");
            $("#add_price").val("");
            $("#add_expiration_date").val("");
            $("#add_available").val("");
            $("#add_image").val("");
          }
        }
      });
    });
  }



  function submitEdit(action) {
        $(document).ready(function () {
          var data = new FormData();
          data.append("action", action);
          data.append("id", $("#edit_id").val());
          data.append("prod_name", $("#edit_prod_name").val());
          data.append("unit", $("#edit_unit").val());
          data.append("price", $("#edit_price").val());
          data.append("expiration_date", $("#edit_expiration_date").val());
          data.append("available", $("#edit_available").val());
          var imageInput = document.getElementById("edit_image");
          if (imageInput.files.length > 0) {
            data.append("image", imageInput.files[0]);
          }

          $.ajax({
            url: 'function.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
              alert(response);
              if (response == "Updated Successfully") {
                $("#"+action).css("display", "none");
              }
            }
          });
        });
      }




    function deleteProduct(id) {
      if (confirm("Are you sure you want to delete this product?")) {
        $(document).ready(function () {
      var data = {
        action: "delete",
        id: id,
      };

      $.ajax({
        url: 'function.php',
        type: 'post',
        data: data,
        success: function (response) {
          alert(response);
          if (response == "Deleted Successfully") {
            // Remove the deleted product row from the table
            $("#" + id).remove();
          }
        }
      });
    });
      }
   
  }
</script>
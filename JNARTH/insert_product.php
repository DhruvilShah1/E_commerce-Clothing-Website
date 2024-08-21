<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<main>
    <h2>INSERT PRODUCT</h2>
                <form  method="post" enctype="multipart/form-data" class="product-form">
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <?php
          include("connection.php");
          $query = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name']; ?></option>
        <?php
          }
          ?>
    </select>
</div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image:</label>
                        <input type="file" id="productImage" name="productImage" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Insert Product</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $productImage = $_FILES['productImage']['name'];
    $tmp_image = $_FILES['productImage']['tmp_name'];

    move_uploaded_file($tmp_image, "./image/$productImage");

    $query = "INSERT INTO `insert_product` (product_name , product_category , product_price , product_description , product_image) VALUES ('$productName','$category','$price','$description','$productImage')";
    $result =mysqli_query($conn, $query);

    if($result){
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Product Inserted',
            text: 'The product has been inserted successfully.',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin.php?insert_product';
            }
        });
      </script>";
} else {
echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error inserting the product.'
        });
      </script>";
}
    }

?>

</html>

<style>
 main h2{
    text-align:center;
 }
.product-form {
    width: 700px;
    margin: 30px 200px;
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.product-form .form-group {
    margin-bottom: 1rem;
}

.product-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.product-form input, .product-form textarea , .product-form select{
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.product-form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
}

.product-form button:hover {
    background-color: #0056b3;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<main>
    <h2>Add Category</h2>
    <form class="product-form" method="post">
        <div class="form-group">
            <label for="category">Category Name:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <button type="submit" name="submit">Add Category</button>
    </form>
</main>
<?php
include("connection.php");
if(isset($_POST["submit"])){
    $category = $_POST['category'];
    $query = "INSERT INTO `categories` (category_name) VALUES ('$category')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>
       
            Swal.fire({
                title: 'Success!',
                text: 'Operation completed successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
    
      </script>";

    }
}
?>
</body>
</html>
<style>
 
    main h2 {
    text-align: center;
}

.product-form {
    
    width: 700px;
    margin: 30px 230px; /* Center the form horizontally */
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.product-form .form-group {
    margin-bottom: 1rem;
}

.product-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.product-form input,
.product-form textarea,
.product-form select {
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
    /* Add hover color here */
    background-color: #0056b3; /* Example hover color */
}

</style>
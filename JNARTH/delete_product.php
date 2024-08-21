<?php
include("connection.php");

if(isset($_GET['i_id'])) {

    $item_id =$_GET['i_id'];

    $query = "DELETE FROM `insert_product` WHERE `i_id` = '$item_id'";
   
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: admin.php?view_product");
        exit();
    } else {
        echo "Error: Unable to delete item from the cart.";
    }
} else {
    header("Location: cart.php");
    exit();
}
?>

<?php

include("connection.php");

if(isset($_GET['c_id'])) {
   
    $item_id = $_GET['c_id'];
    

    $query = "DELETE FROM `add_to_cart` WHERE `c_id` = '$item_id'";
    $result = mysqli_query($conn, $query);

    if($result) {
   
        header("Location: cart.php");
        exit();
    } else {
    
        echo "Error: Unable to delete item from the cart.";
    }
} else {
 
    header("Location: cart.php");
    exit();
}
?>

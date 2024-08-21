<?php
include("connection.php");

if(isset($_GET['i_id'])) {

    $item_id = $_GET['i_id'];

    $query = "DELETE FROM `register` WHERE `r_id` = '$item_id'";
 
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: admin.php?view_user");
        exit();
    } else {
        echo "Error: Unable to delete user.";
    }
} else {
    header("Location: cart.php");
    exit();
}
?>
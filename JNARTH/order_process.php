<?php
include('connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $user_id = $_SESSION['user_id'];
    $payment_method = $_POST['payment_method'];

    function generateOrderID() {
        return 'SHAH' . mt_rand(100000, 999999); 
    }
    $orderID = generateOrderID();

    $query = "UPDATE add_to_cart SET c_status = 1 WHERE u_id = $user_id";
    $result = mysqli_query($conn, $query);

    $query = "SELECT * FROM add_to_cart WHERE u_id = $user_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_ids= $row['product_id'];

            $sql = "INSERT INTO orders (order_id, user_id, product_id, first_name, last_name, email, phone, address, city, state, zip, country , status , payment_status)
                    VALUES ('$orderID', $user_id, '$product_ids', '$first_name', '$last_name', '$email', '$phone', '$address', '$city', '$state', '$zip', '$country', 'pending', '$payment_method')";

            $result1 = mysqli_query($conn, $sql);
        }
        if ($result1) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE `orders` SET status = '$status' WHERE order_id = '$order_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Order status updated successfully.',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to update order status.',
                confirmButtonText: 'OK'
            });
        </script>";
    }
    
}

$query = "SELECT * FROM `orders`";
$result = mysqli_query($conn, $query);
?>
<section id="tables" class="section-p1">
    <h2>View Product</h2>
        <table width="100%">
            <thead>
                <tr>
                    <td>Order ID</td>
                    <td>NAME</td>
       
                    <td>Phone</td>
                    <td>City</td>
                    <td>Address</td>
                    <td>State</td>
                    <td>Zip Code</td>
                    <td>Status</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
            <?php
                include("connection.php");
                $query = "SELECT DISTINCT order_id, first_name, email, phone, city, address, state, zip  , status FROM orders";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>'.$row['order_id'] . '</td>';
                    echo '<td>' . $row['first_name'] . '</td>';
                    echo '<td>$' . $row['phone'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['state'] . '</td>';
                    echo '<td>' . $row['zip'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
           
                    echo '<td>';
                echo '<form class="status-update-form" method="post" action="">';
                echo '<input type="hidden" name="order_id" value="' . $row['order_id'] . '">';
                echo '<select name="status">';
                echo '<option value="Pending">Pending</option>';
                echo '<option value="Processing">Processing</option>';
                echo '<option value="outofdelivery">out of delivery</option>';
                echo '<option value="Delivered">Delivered</option>';


                echo '</select>';
                echo '<button type="submit" name="update_status">Update</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                }
                ?>
              </tbody>
</table>
</section>

</body>
</html>
<style>
 #tables table{
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        white-space: nowrap;
    }
    #tables h2{
        text-align:center;
    }
    #tables table img{
        width: 100px;
    }
    #tables table{
        overflow-x: auto;
    }
    #tables table td{
        text-align: center;
    }
    
    #tables table tbody td:nth-child(1){
font-size: larger;

    }
    #tables table td:nth-child(5) input{
        width: 70px;
        padding: 10px 5px 10px 15px;
    }
    
    #tables table thead{
       border: 1px solid #e2e9e1;
       border-left: none;
       border-right: none;
    }
    #tables table thead td{
        font-weight: 700;
        text-transform: uppercase;
        padding: 18px 0;
        font-size: 12px;
    }
    #tables table tbody tr td{
        padding-top: 15px;
    }
    
.update-btn,
.delete-btn {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-right: 5px;
    transition: background-color 0.3s ease;
}

.update-btn {
    background-color: #28a745;
    color: white;
}

.update-btn:hover {
    background-color: #218838;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}

.delete-btn:hover {
    background-color: #c82333;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="content">
            <header>
                <button id="toggle-sidebar">☰</button>
                <h1>Dashboard</h1>
                <div class="user-info">
                    <img src="https://th.bing.com/th/id/OIP.AUofah1Cl9oIIURpjh-flwAAAA?rs=1&pid=ImgDetMain" alt="User Avatar">
                    <span>Admin</span>
                </div>
            </header>
            <main>
                <section class="cards">
                    <div class="card">
                        <h3>Total Products</h3>
                        <?php
                        include("connection.php");
                        $query = "SELECT COUNT(*) as total_product FROM `insert_product`";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_product = $row['total_product'];
                            echo "<p>{$total_product}</p>";
                        } else {
                            echo "<p>Error fetching data</p>";
                        }
                        ?>
                    </div>
                    <div class="card">
                        <h3>Total Orders</h3>
                        <?php
                        include("connection.php");
                        $query = "SELECT COUNT(*) as total_users FROM `orders`";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_users = $row['total_users'];
                            echo "<p>{$total_users}</p>";
                        } else {
                            echo "<p>Error fetching data</p>";
                        }
                        ?>
                    </div>
                    <div class="card">
                        <h3>Total Users</h3>
                        <?php
                        include("connection.php");
                        $query = "SELECT COUNT(*) as total_users FROM `register`";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_users = $row['total_users'];
                            echo "<p>{$total_users}</p>";
                        } else {
                            echo "<p>Error fetching data</p>";
                        }
                        ?>
                    </div>
                    <?php
 include("connection.php");
 $query = "SELECT * FROM `add_to_cart`";
 $result = mysqli_query($conn, $query);
 $total_amount = 0;
 while ($row = mysqli_fetch_assoc($result)) {
    $total_users = $row["c_price"] * $row['c_quantity'];
    $total_amount += $total_users;
 }
                    ?>
                    <div class="card">
                        <h3>Total Amount in user's Cart</h3>
                        <p><?php echo $total_amount ?></p>
                    </div>

                    <div class="card">
                    <?php

include("connection.php");

$query = 'SELECT COUNT(*) AS total_categories FROM categories';
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_categories = $row['total_categories'];
} else {
    echo "Error: Unable to count categories.";
}

?>

                        <h3>Total Category</h3>
                        <p><?php echo  $total_categories  ?></p>
                    </div>
                </section>
                <section class="tables">
                    <h2>Recent Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
 include("connection.php");
 $query = "SELECT * FROM orders";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_array($result);
 $userid = $row['user_id'];
 $query = "SELECT * FROM add_to_cart WHERE u_id = '$userid' AND DATE(dates) = CURDATE()";
 $result = mysqli_query($conn, $query);

 if(mysqli_num_rows($result) > 0) {
   
     while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["u_id"];
 ?>

                            <tr>
                                <td><?php  echo $row["c_name"]    ?></td>
                                <td><?php  echo $row["c_quantity"]    ?></td>
                                <td><?php  echo $row["c_size"]    ?></td>
                                <td><?php  echo $row["c_price"]    ?></td>
                                <td><?php  echo $row["dates"]    ?></td>
                                <?php
                                $query1 = "SELECT r_name FROM `register` WHERE r_id = '$id'";
                                $result1 = mysqli_query($conn, $query1);
                                $row1 = mysqli_fetch_assoc($result1);
                                ?>
                                <td><?php echo $row1['r_name']  ?></td>
                                </tr>
                        
        <?php
 }
}else{
    ?>
  <td colspan="6" style="text-align:center; color:red">No Recent Order Today</td>
      <?php
    
}
        ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
</body>



</html>

<style>
     header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    
    #toggle-sidebar {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    main {
        padding: 1rem;
    }
    
    .cards {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .card {
        background-color: #17a2b8;
        color: #fff;
        padding: 1rem;
        border-radius: 8px;
        flex: 1 1 calc(25% - 1rem);
        text-align: center;
        min-width: 200px;
    }
    
    .card h3 {
        margin: 0 0 0.5rem 0;
    }
    
    .tables {
        margin-top: 2rem;
    }
    
    .tables table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .tables th, .tables td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
        text-align: left;
    }
    
    .tables th {
        background-color: #f8f9fa;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Admin</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="sidebar-menu">
            <li><a href="admin.php?dasboard">Dasboard</a></li>
            <li><a href="admin.php?add_category">ADD Category</a></li>
                <li><a href="admin.php?insert_product">Insert Product</a></li>
                <li><a href="admin.php?view_product">View Product</a></li>
                <li><a href="admin.php?view_user">Users</a></li>
                <li><a href="admin.php?contact_query">Contact Query</a></li>
                <li><a href="admin.php?order_details">Order Details</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
       
   
</body>
<script>
    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('open');
    });
    
</script>

<?php
if(isset($_GET['insert_product'])){
    include('insert_product.php');
  }
  if(isset($_GET['dasboard'])){
    include('dasboard.php');
  }
  if(isset($_GET['view_product'])){
    include('view_product.php');
  }
  if(isset($_GET['view_user'])){
    include('view_user.php');
  }
  if(isset($_GET['add_category'])){
    include('add_category.php');
  }
  if(isset($_GET['contact_query'])){
    include('contact_query.php');
  }
  if(isset($_GET['order_details'])){
    include('order_details.php');
  }
?>
</html>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    
    .container {
        display: flex;
        height: 100vh;
    }
    
    .sidebar {
        background-color: #343a40;
        color: #fff;
        width: 250px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    
    .sidebar-header {
        padding: 1rem;
        background-color: #3c4248;
        text-align: center;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
    }
    
    .sidebar-menu li {
        padding: 1rem;
        text-align: center;
    }
    
    .sidebar-menu li a {
        padding: 10px;
        color: #fff;
        text-decoration: none;
        display: block;
    }
    
    .sidebar-menu li a:hover {
        background-color: #495057;
    }
    
    .content {
        flex-grow: 1;
        padding: 1rem;
        background-color: #ffffff;
        overflow-y: auto;
    }
    
   
    
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }
    
        .sidebar.open {
            transform: translateX(0);
        }
    
        #toggle-sidebar {
            display: block;
        }
    
        .cards {
            flex-direction: column;
        }
    
        .card {
            min-width: 100%;
        }
    }
    
</style>
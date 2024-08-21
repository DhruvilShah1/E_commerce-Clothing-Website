<?php
session_start();
if(!isset($_SESSION['user_id'])) {
      
      echo "<script>
              alert('Please log in first to add items to your cart.');
              window.location.href = 'sign.php'; // Redirect to sign-in page
            </script>";
      exit(); 
  }else{
      $userID = $_SESSION['user_id'];
      $username = $_SESSION['user_name'];
  }

  ?><!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      .container {
        max-width: 1200px;
        margin: 20px auto;
        display: flex;
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
      }
      .info-section, .cart-section {
        padding: 20px;
        border-bottom: 1px solid #ddd; 
      }
      .info-section h2, .cart-section h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
      }
      .info-section form {
        max-width: 100%;
      }
      .info-section label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
      }
      .info-section input, .info-section textarea, .info-section select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box; 
      }
      #creditCardDetails{
        display: none;
      }
      #upiDetails {
            display: none;
        }
      .info-section button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }
      .info-section button:hover {
        background-color: #45a049;
      }
      .cart-section {
        border-left: 1px solid #ddd; 
      }
      .cart-section table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
      }
      .cart-section th, .cart-section td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
      }
      .summary{
        background-color: #f9f9f9;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }
      /* Loader CSS */
      #loader {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        width: 100px;
        height: 100px;
        background-color: #f3f3f3;
        border-radius: 50%;
        border: 10px solid #3498db;
        border-top: 10px solid #f3f3f3;
        border-bottom: 10px solid #f3f3f3;
        animation: spin 2s linear infinite;
        transform: translate(-50%, -50%);
        z-index: 9999; 
      }
  
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
 
    <div id="loader">
    </div>
  
    <div class="container">
      <div class="info-section">
        <h2>Personal Information</h2>
        <form id="orderForm">
          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" required>
          
          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" required>
          
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          
          <label for="phone">Phone:</label>
          <input type="tel" id="phone" name="phone">
  
          <label for="payment_method">Payment Method:</label>
          <select id="payment_method" name="payment_method" required>
              <option value="">Select Payment Method</option>
              <option value="credit_card">Credit/Debit Card</option>
              <option value="paypal">Google Pay</option>
              <option value="cash_on_delivery">Cash on Delivery</option>
          </select>

       

  
          <div class="info-section">
           <h2>Address Information</h2>
     
          <label for="address">Address:</label>
          <textarea id="address" name="address" rows="4" required></textarea>
          
          <label for="city">City:</label>
          <input type="text" id="city" name="city">
          
          <label for="state">State:</label>
          <input type="text" id="state" name="state">
          
          <label for="zip">ZIP Code:</label>
          <input type="text" id="zip" name="zip">
          
          <label for="country">Country:</label>
          <select id="country" name="country">
           <option value="INDIA">India</option>
            <option value="US">United States</option>
            <option value="CA">Canada</option>
            <option value="UK">United Kingdom</option>
            <option value="AU">Australia</option>
            <option value="NZ">New Zealand</option>
          </select>
  
    </div>
  
        
 
      </div>
  
      <div class="cart-section">
        <h2>Cart Summary</h2>
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $grand_total = 0;
              include('connection.php');
              $user_id = $_SESSION['user_id'];
              $query = "SELECT * FROM add_to_cart WHERE u_id = $user_id AND c_status = '0'";
  
              $result = mysqli_query($conn, $query);
  
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
              ?>
        
            <tr>
              <td><?php echo $row['c_name'] ?></td>
              <td><?php echo $row['c_price'] ?></td>
              <td><?php echo $row['c_quantity'] ?></td>
              <td><?php echo $subtotal = $row["c_price"] * $row["c_quantity"]; ?></td>
            </tr>
  
            <?php
            $grand_total+= $subtotal;
                  }
              } else {
                  echo "<tr><td colspan='4'><center>Your cart is empty!</center></td></tr>";
              }
            ?>
          </tbody>
        </table>
        <?php
          include('connection.php');
          $user_id = $_SESSION['user_id'];
          $query = "SELECT COUNT(*) AS item_count FROM add_to_cart WHERE u_id = $user_id AND c_status = '0'";
          $result = mysqli_query($conn, $query);
  
          if ($result) {
              $row = mysqli_fetch_assoc($result);
              $item_count = $row['item_count'];
          } else {
              $item_count = 0;
          }
        ?>
  
        <div class="summary">
          <h3>Order Summary</h3>
          <p>Total Items: <?php echo $item_count ?></p>
          <p>Total Amount: <?php echo $grand_total ?></p>

           <!-- Submit Button -->
           <div class="info-section">
          <?php
          include('connection.php');
          $user_id = $_SESSION['user_id'];
          $query = "SELECT * FROM add_to_cart WHERE u_id = $user_id AND c_status = '0'";
          $result = mysqli_query($conn, $query);
  
          if ($result && mysqli_num_rows($result) > 0) {
              echo '<button type="submit" name="submit_order">Place Order</button>';
          } else {
              echo '<h2>Cart is empty or all items are processed</h2>';
          }
          ?>
          </div>
        </form>
      </div>
        </div>
      </div>
    </div>
  
    <script>
$(document).ready(function() {
 
    $('#orderForm').on('submit', function(e) {
        e.preventDefault();
        $('#loader').show();

        setTimeout(function() {
            $.ajax({
                url: 'order_process.php',
                type: 'POST',
                data: $('#orderForm').serialize(),
                success: function(response) {
                    $('#loader').hide();
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order Placed Successfully!',
                            text: 'Your order has been placed successfully!'
                        }).then(() => {
                            window.location.href = 'index.php'; 
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to place your order. Please try again.'
                        });
                    }
                },
                error: function() {
                    $('#loader').hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to place your order. Please try again.'
                    });
                }
            });
        }, 1000); 
    });
});
</script>

  </body>
  </html>
  
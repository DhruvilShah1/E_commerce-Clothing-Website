

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<section id="navbar">
        <img src="https://logos.textgiraffe.com/logos/logo-name/Shah-designstyle-friday-m.png" >
       
        <ul id="ul">
          <i class="fa fa-cross"></i>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li class="dropdown">
  <a href="product_show.php">Product</a>
</li>

          <li><a href="contact.php">Contact</a></li>
          <?php 
          session_start();
      if(isset($_SESSION['user_id'])) {
          echo '<li><i class="fa fa-user-circle"></i><a href="#" onclick="printUserName()">'.$_SESSION['user_name'].'</a> </li>';
          echo '<li><a href="#" onclick="confirmLogout(event)">Logout</a></li>';
        
      } else {
          echo '<li><a href="sign.php">Login</a></li>';
      }
      ?>
<?php
include("connection.php");

if (isset($_SESSION['user_id'])) {
  $userID = $_SESSION['user_id'];
  $query = "SELECT COUNT(*) AS cart_count FROM add_to_cart WHERE u_id = '$userID' AND c_status = '0'";
  $result = mysqli_query($conn, $query);
  
  if ($result) {
      $row = mysqli_fetch_assoc($result);
      $cartCount = $row['cart_count'];
  } else {
      $cartCount = 0;
  }
} else {

  $cartCount = 0; 
}
?>

<li class="cart">
  <a href="cart.php"> <i class="fa fa-shopping-cart"></i></a>
  <sup class="cart-number"><?php echo $cartCount; ?></sup> 
</li>

<li><a href="#footers" id="down"><i class="fa fa-angle-down"></i></a></li>
          
       
        </ul>
        <i class="fa fa-bars bars" id="arrow"></i>
    </section>
    <section id="tables" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>REMOVE</td>
                    <td>IMAGE</td>
                    <td>PRODUCT</td>
                    <td>PRICE</td>
                 
                </tr>
            </thead>
            <tbody>
                <tr>
                  <?php
                  include("connection.php");
                
$grand_total = 0;
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
                $query = "SELECT * FROM `likes` WHERE u_id = '$userID'";
                $result = mysqli_query($conn, $query);
$subtotal = 0;
                while($row = mysqli_fetch_assoc($result)){
                  
                  
                  ?>
                  <tr>
                  <form method="post" action="">
                    <td>
                  <button type="submit" name="remove_from_wishlist">
            <i class="fa fa-times-circle"></i>
          </button>
          </td>
        <td><img src="image/<?php echo $row["c_image"]; ?>" alt="Error"></td>
        <td><?php echo $row["c_name"]; ?></td>
        <td>$<?php echo $row["c_price"]; ?></td>
<input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>"> 
                    </form>
  
              <?php
                }
              ?>
    </tr>

                
           </tbody>
        </table>
    </section>

    <?php
include 'connection.php'; 

if (isset($_POST['remove_from_wishlist'])) {
    $product_id = $_POST['product_id'];
    $userID = $_SESSION['user_id'];
    
    echo "<script>console.log('Product ID: $product_id, User ID: $userID');</script>";

    $query = "DELETE FROM `likes` WHERE product_id='$product_id' AND u_id='$userID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Removed',
                    text: 'The product has been removed from your wishlist.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href='whislist.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error removing the product from your wishlist.',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

    <a href="#about_banner" class="full-width-button">Back to Top</a>

<section id="footers">
  
  <div class="col support">
      <h2>Support</h2>
      <a href="">Product Support</a>
      <a href="">Community</a>
      <a href="">Product Support</a>
  </div>

  <div class=" col resource">
      <h2>Resource</h2>
      <a href="">WHOIS Search</a>
      <a href="">Wedmaik</a>
      <a href="">Site Map</a>
      <a href="">Redeem Code</a>
  </div>
  <div class="col about">
      <h2>About</h2>
        <a href="about.php">About Us</a>
        <a href="return_centre.php">Return Centre</a>
        <a href="">Privacy Policy</a>
        <a href="">Terms & Condition</a>
        <a href="">Contact Us</a>
   </div>
  

   <div class="col account">
      <h2>My Account</h2>
        <a href="sign.php">Sign In</a>
        <a href="cart.php">View Cart</a>
        <a href="whislist.php">My Whislist</a>
        <a href="cart.php">Track My Order</a>
        <a href="help.php">Help</a>
   </div>

  <div class="col shopping">
      <h2>Shopping</h2>
      <a href="">Find a Domain</a>
      <a href="">Product Catalog</a>
      <a href="">Reseller Programs</a>
  </div>

</section>

<section id="icons">
  <div class="sign">
      <input type="text" placeholder="Enter Your Email">
      <button>Sign In</button>
  </div>
  
</section>

   


</body>
<script>
        function confirmLogout(event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>
<script>
    
    const arrow = document.getElementById('arrow');
    const ul = document.getElementById('ul');
    const cross = document.getElementById('close');

    arrow.addEventListener('click',()=>{
        ul.classList.toggle('active');
    })
    cross.addEventListener('click',()=>{
        ul.classList.remove('active');
    })


</script>
</html>

<style>
  *{
        margin: 0;
        padding: 0;
    }
    .full-width-button {
    display: block;
    width: 100%;
    padding: 15px;
    background-color: black;
    color: white;
    text-align: center;
    text-decoration: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    box-sizing: border-box;
}

.full-width-button:hover {
    background-color: #0056b3;
}
    #navbar{
        display: flex;
        background: rgb(255, 244, 244);
        box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.06);
        padding: 10px 30px;
        justify-content: space-between;
        position: sticky;
        top: 0;
        left: 0;
    }
    #navbar img{
        width: 150px;
        height: 100px;
        margin-left: 50px;
        background-repeat: no-repeat;
    }
    #navbar ul{
      margin-top:40px;
      display: flex;
      gap: 27px;
      list-style: none;
    }
    .cart-number{
      background: #EE1C47;
      border-radius: 50%;
      padding: 2px 6px;
      position: absolute;
    }
 
    .bars , #cross{
      display: none;
    }
    #navbar ul a{
      font-size: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: 500;
      color: #333c56;
      text-decoration: none;
    }
    #navbar ul a:hover{
      color: cadetblue;
    }

#footers{
    display: flex;
    justify-content: space-around;
    width: 100%;
    background: rgb(171, 171, 171);
    padding-top: 20px;
  
}
#footers .col h2{
  margin-bottom: 10px;
}
#footers .col a{
display: flex;
text-decoration: none;
margin-bottom: 10px;
flex-direction: column;
color: aliceblue;
}
#footers .col a:hover{
color: cadetblue;
}

#icons{
display: flex;
justify-content: space-between;
background: rgb(171, 171, 171);
}

.sign{
    display: flex;
    margin: 10px 30px ;
    padding: 0;
    width: 100%;
}
.sign input{
    padding: 10px 50px 10px 18px;
 border: 1px solid silver;
}
.sign button{
    padding: 10px 30px 10px 30px;
    background: rgb(0, 6, 0);
    color: aliceblue;
}
#icons .symbol{
    display: flex;
    margin-right: 50px;

}
#icons .symbol i{
    position: relative;
    top: 20px;
    left: 10px;
    cursor: pointer;
    margin-right: 10px;
    font-size: 20px;
}
#icons .symbol i:hover{
    color: red;
} 

.section-p1{
    padding: 30px 50px;
}
    #tables table{
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
        
    }

    #tables table img{
        width: 70px;
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
    #coupon{
        display: flex;
        justify-content: space-between;
    }
    #coupon .applycoupon h2{
        margin-bottom: 20px;
        color: rgb(255, 139, 139);
    
    }
    #coupon .applycoupon input{
        border: 1px solid silver;
        padding: 10px 80px 10px 15px;
    
    }
    #coupon .applycoupon button{
        padding: 10px 20px 10px 20px;
        background: #088178;
        color: #cce7d0;
    }
    #coupon .carttotal{
        width: 50%;
        margin-bottom: 30px;
        border: 1px solid silver;
        padding: 30px;
    }
    #coupon .carttotal h3{
        margin-bottom: 10px;
    }
    
    #coupon .carttotal table{
       
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }
    
    #coupon .carttotal table td{
        width: 50%;
        border: 1pc solid rgb(75, 75, 75);
        padding: 10px;
        font-size: 15px;
    }
    
    #coupon .carttotal button{
        padding: 15px 25px 15px 25px;
        font-size: 15px;
        background: #088178;
        color: #e1e1e1;
    }
    #Quantity{
        width: 35px;
        padding:5px 0px 5px 5px;
    }
    .update-button {
    background-color: #4CAF50; 
    border: none; 
    color: white; 
    padding: 10px 20px; 
    text-align: center; 
    text-decoration: none; 
    display: inline-block;
    font-size: 16px; 
    margin: 4px 2px; 
    cursor: pointer; 
    border-radius: 12px; 
    transition: background-color 0.3s ease, transform 0.2s ease; 
}

.update-button:hover {
    background-color: #45a049; 
    transform: scale(1.05); 
}
    
  @media (max-width:870px) {
    #navbar{
      text-align: center;
      display: flex;
      flex-direction: column;
      background: wheat;
      padding: 10px 30px;
      position: relative;
      justify-content: space-between;
  }
  #navbar img{
    width: 200px;
    height: 100px;
    text-align: center;
  }
  #main-home {
    height: 71vh;
    background-image: url(anuskha.jpg);
    background-position: center;
    width: 100%;
    background-size: cover;
    display: grid;
    background-position: 70px;
    grid-template-columns: repeat(1, 1fr);
    align-items: center;
}
.main-text h1 {
  color: black;
  font-size: 44px;
  text-tranform: capitalize;
  line-height: 1.1;
  font-weight: 600;
  margin: 6px 0 10px;
}
.bars {
display: flex;
position: absolute;
text-align: center;
top: 50px;
justify-content: center;
float: right;
right: 50px;
font-size: 23px;
}
    #navbar ul{
      display: none;
      flex-direction: column;
      text-align: center;
      gap: 30px;
   
      list-style: none;
     
      left: 430px;
      float: left;
      transition: 0.3s ease;
    }
    #navbar ul.active{
      display: flex;
    }
    #footers{
      display: flex;
      justify-content: space-around;
      width: 100%;
      background: rgb(171, 171, 171);
      flex-direction: column;
      text-align: center;
    
  }
  #feature{
  display: flex;
}
#coupon {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    gap: 20px;
    text-align: center;
}
#coupon .carttotal {
    width: 95%;
    margin-bottom: 30px;
    border: 1px solid silver;
    padding: 30px;
}
   

  }
  @media (max-width:520px) {
    #main-home {
      height: 72vh;
      background-image: url(anuskha.jpg);
      background-position: center;
      width: 100%;
      background-size: cover;
      display: grid;
      background-position: -96px;
      grid-template-columns: repeat(1, 1fr);
      align-items: center;
  }
    .bars {
      display: flex;
     
    }
    #feature {
      display: flex;
      text-align: center;
      justify-content: center;
  }
  #who {
    margin: 10px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}
#who img {
    width: 100%;
    margin-left: 19px;
    margin-bottom: 15px;
}
}


  @media (max-width:450px) {
    #main-home .main-text {
      padding: 30px 15px;
  }
  #main-home {
    height: 57vh;
    background-image: url(anuskha.jpg);
    background-position: center;
    width: 100%;
    background-size: cover;
    display: grid;
    background-position: -96px;
    grid-template-columns: repeat(1, 1fr);
    align-items: center;
}
.main-text h1 {
  color: white;
  font-size: 23px;
  text-tranform: capitalize;
  line-height: 1.1;
  font-weight: 600;
  margin: 6px 0 10px;
}
.main-text p {
color: #ffffff;
font-size: 13px;
font-style: italic;
margin-bottom: 20px;
}
.main-btn {
display: inline-block;
color: #111;
text-decoration: none;
text-tranform: capitalize;
font-size: 16px;
font-weight: 600;
border: 2px solid #111;
padding: 5px 15px;
}
#feature {
      display: flex;
      text-align: center;
      justify-content: center;
  }
  #coupon .carttotal {
        width: 87%;
        margin-bottom: 30px;
        border: 1px solid silver;
        padding: 30px;
    }
    .update-button {
   
    padding: 10px 1px;
    
}
.section-p1 {
    padding: 30px 0px;
}
}

@media (max-width:380px) {

    #tables table img {
    width: 42px;
}
#Quantity {
    width: 35px;
    padding: 9px 0px 8px 0px;
}
#tables table thead td {
    font-weight: 700;
    text-transform: uppercase;
    padding: 18px 0;
    font-size: 9px;
}
#tables table tbody tr td {
    padding-top: 15px;
    font-size: 13px;
}
#coupon .carttotal {
        width: 84%;
        margin-bottom: 30px;
        border: 1px solid silver;
        padding: 30px;
    }
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
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

<section id="two_box" class="section-p1">
    <div class="return_box">
        <h2>Return Items You Ordered</h2>
        <p>You can return many items sold on Amazon.in. When you return an item, you may see different return options
        depending on the seller, item, or reason for return.
</p>
<a href="cart.php">VIEW ORDER</a>
    </div>

    <div class="return_box_2">
        <h2>Manage Returns</h2>
        <p>Print return labels and check the status of your recent returns</p>
        <a href="cart.php">VIEW YOUR ORDER</a>
    </div>

</section>
<section id="one_box">
        <div class="return_box_3">
            <h2>Gift Returns</h2>
            <p><span>Order number</span> e.g. 123-1234567-1234567</p>
            <form  method="post">
                <input type="text" name="orderNumber" placeholder="Order number (with dashes)" required>
                <button type="submit" name ="submit">Search</button>
            </form>
        </div>
    </section>

    <?php
include("connection.php");

if (isset($_POST['submit'])) {
    $orderNumber = $_POST['orderNumber'];
    $query = "SELECT status FROM orders WHERE order_id = '$orderNumber'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $status = $row['status'];
            echo "<script>alert('Order Status: $status');</script>";
        } else {
            echo "<script>alert('Order not found');</script>";
        }
    } else {
        echo "<script>alert('Error fetching order status');</script>";
    }
}
?>


<section id="question" >
    <h2>Frequently Asked Questions</h2>
    <div class="question_answer">
        <p>What can I return?</p>
        <span>You may request returns for most items you buy from Amazon.in, except those that are explicitly identified as not returnable. For details of time frame for requesting returns please refer to our returns policy.</span>
    </div>

    <div class="question_answer">
        <p>When will I get my refund?</p>
        <span>Refunds back to Credit Cards, Debit Cards, Net Banking or Bank Accounts (NEFT) are fully refunded within 3-5 days after we receive and process your return. Refunds in form of cheques can take 10-12 business days to arrive via post. Refund in the form of Gift Cards can take 1 business day.</span>
    </div>

    <div class="question_answer">
        <p>Does Amazon do replacements?</p>
        <span>Amazon offers free replacement for FBA orders including Kindle. Follow the steps in the Return Center to request a replacement for your FBA order.</span>
    </div>
</section>

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
  
      .section-p1{
        padding: 40px 80px;
    }
    .section-p2{
        padding: 40px 80px;
    }
   
   
    #two_box{
 display:flex;
 gap: 10px;


    }
    #one_box{
        padding: 12px 80px;
     
    }
    #one_box .return_box_3{
        padding:14px 18px;
        border:1px solid silver;
        box-shadow:10px 10px 15px rgba(0,0,0,0.1);
        line-height: 29px;

    }
    #one_box .return_box_3 p span{
        font-weight:900;
        font-size:18px;
        color:black;
    }
    #one_box .return_box_3 input{
        padding: 5px 80px 5px 7px;
        width: 200px;
        border-radius : 5px;
    }
    #one_box .return_box_3 button{
        padding: 5px 10px 5px 10px;
        background:#619b8a;
        color:#f0efeb;
        cursor: pointer;
    }
    #two_box .return_box{
        padding:14px 18px;
        border:1px solid silver;
        box-shadow:10px 10px 15px rgba(0,0,0,0.1);
        line-height: 29px;
    }
  
    #two_box .return_box a{
        text-decoration:none;
        float: right;
        color:green;
        font-size:14px;
    }
    #two_box .return_box a:hover{
        color:red;
    }
    #question{
        border:1px solid silver;
        display:flex;
        padding: 12px 50px 50px;
        flex-direction : column;
        margin: 0 50px 30px 80px;
        box-shadow:10px 10px 15px rgba(0,0,0,0.1);
        line-height: 29px;
       
    }
    #question p{
        font-weight:900;
        color:black;
        font-size:20px;
    }
    #question span{
        font-family: "Amazon Ember", Arial, sans-serif;
    }
    #two_box .return_box_2{
        padding:14px 18px;
        border:1px solid silver;
        box-shadow:10px 10px 15px rgba(0,0,0,0.1);
        line-height: 28px;
       
    }

    #two_box .return_box_2 a{
        text-decoration:none;
        float: right;
        color:green;
        font-size:14px;
    }
    #two_box .return_box_2 a:hover{
        color:red;
    }
   
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
      gap: 40px;
      list-style: none;
    }
    .cart-number{
      background: #EE1C47;
      border-radius: 50%;
      padding: 2px 6px;
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

@media (max-width:1200px) {
#two_box {
    display: flex;
    gap: 10px;
    flex-direction: column;
}
}
  
@media (max-width:900px) {
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
#question {
    border: 1px solid silver;
    display: flex;
    padding: 12px 25px 50px;
    flex-direction: column;
    margin: 0 79px 30px 80px;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1);
    line-height: 29px;
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


  @media (max-width:420px) {
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
  #one_box .return_box_3 input {
    padding: 5px 80px 5px 7px;
    width: 134px;
    border-radius: 5px;
}
}
@media (max-width:380px) {
#one_box .return_box_3 input {
    line-height: 10px;
    padding: 5px 80px 5px 7px;
    width: 88px;
    border-radius: 5px;
}
}

</style>
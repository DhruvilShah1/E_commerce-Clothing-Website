<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <title>title</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <section id="navbar">
        <img src="https://logos.textgiraffe.com/logos/logo-name/Shah-designstyle-friday-m.png" >
       
        <ul id="ul">
          <i class="fa fa-cross"></i>
          <li><a href="task-1.php">Home</a></li>
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

    <section id="main-home">
      <div class="main-text" class="section-p1">
          <h5>Summer Collection</h5>
          <h1>New Summer <br> Collection 2024</h1>
          <p>There's Nothing like Trend</p>

          <a href="product_show.php" class="main-btn">Shop Now</a>
      </div>
  </section>
    
  <section id="feature">
        <div class="fe-box">
            <img src="f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="f2.png" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="f4.png" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="f6.png" alt="">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <a href="#main-home" class="full-width-button">Back to Top</a>
  <section id="footers" class="section-p1">
  
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
          <a href="order_cart.php">Track My Order</a>
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
    
    $(document).ready(function(){
      $("#arrow").on('click',function(){
        $("#ul").toggleClass("active")
      })

});


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
    margin-top:10px;
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
    #main-home{
      width: 100%;
      height: 100vh;
      background-image: url("anuskha.jpg");
      background-position:center;
      background-position: 350px 1px;
      background-size:cover;
      display:grid;
      grid-template-columns:repeat(1,1fr);
      align-items:center;
  }
  #main-home  .main-text{
    padding: 30px 40px;
  }
  .main-text h5{
      color:#EE1C47;
      font-size:16px;
      text-transform:capitalize;
      font-weight:500;
  }
  .main-text h1{
      color:black;
      font-size:65px;
      text-tranform:capitalize;
      line-height:1.1;
      font-weight:600;
      margin: 6px 0 10px;
  }
  .main-text p{
      color:#333c56;
      font-size:20px;
      font-style:italic;
      margin-bottom:20px;
  }
  .main-btn{
  display:inline-block;
  color:#111;
  text-decoration:none;
  text-tranform:capitalize;
  font-size:16px;
  font-weight:600;
  border:2px solid #111;
  padding: 12px 25px;
  
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
.main-btn:hover {
  color: white;
    background-color: black; 
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
#feature {
    margin-top: 18px;
    /* padding: 30px 100px; */
    display: flex;
    width: 100%;
    flex-wrap: wrap;
    margin-left: 15px;
    gap: 20px;
}
#feature .fe-box{
    border: 1px solid silver;
    margin-right:50px;
    padding: 5px 15px 10px 15px;
}

#feature .fe-box h6{
    font-size:12px;
    text-align:center;
    padding : 10px 0 10px 0;
}
#feature .fe-box:nth-child(1) h6{
    background-color: orange;
}

#feature .fe-box:nth-child(2) h6{
    background-color: #a6ffa9;
}


#feature .fe-box:nth-child(3) h6{
    background-color: #8ffdff;
}


#feature .fe-box:nth-child(4) h6{
    background-color: #ff81c4;
}


#feature .fe-box:nth-child(5) h6{
    background-color: #ffd1a0;
}


#feature .fe-box:nth-child(6) h6{
    background-color: #ff9999;
}


  @media (max-width:1160px) {

  #main-home {
    width: 100%;
    height: 80vh;
    background-image: url(anuskha.jpg);
    background-position: center;
    background-position: 252px 1px;
    background-size: cover;
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    align-items: center;
}}

    @media (max-width:890px) {
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
        margin-left: 0px;
        text-align: center;
        justify-content: center;
    }
}

</style>
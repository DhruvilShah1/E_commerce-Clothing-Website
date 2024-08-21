<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>title</title>
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
 
    <div id="hello">
        <?php
include('connection.php');
if (isset($_SESSION['user_id'])) {
    echo '<h2>Hii  '.$_SESSION['user_name'].'. What can we help you With?</h2>';
} else {
    echo '<h2>Hii  Guest. What can we help you With?</h2>';
}

?>
       
        <hr>
    </div>

    <div class="text" class="section-p2">
       <h2> Some things you can do here</h2>
    </div>
    
    <section id="cards" class="section-p2">
        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/Box-t3.png">
        <span class="row">
            <h3>Your Orders</h3>
            <p>Track Packages</p>
            <p>Edit or cancel orders</p>
        </span>
        </div>


        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/returns-box-blue.png">
        <span class="row">
            <h3>Return and Refunds</h3>
            <p>Return or exchange items</p>
            <p>Print return mailing labels</p>
        </h3<>
        </div>
        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/manage-address.png">
        <span class="row">
            <h3>Manage Addresses</h3>
            <p>Update your addresses</p>
            <p>Add address, landmark details</p>
        </span>
        </div>
        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/Prime_clear-bg.png">
        <span class="row">
            <h3>Manage Prime</h3>
            <p>View your bemefits</p>
            <p>Membership details</p>
        </span>
        </div>
        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/Payments_clear-bg-t3.png">
        <span class="row">
            <h3>Payment Setting</h3>
            <p>Add or edit payment methods</p>
            <p>Change debit or credit card</p>
        </span>
        </div>
        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/IN-your-account.png">
        <span class="row">
            <h3>Account Settings</h3>
            <p>Change your email or password</p>
            <p>Update login information</p>
        </span>
        </div>

        <div class="box">
            <img src="https://m.media-amazon.com/images/G/31/x-locale/cs/help/images/gateway/family_device.png">
        <span class="row">
            <h3>Digital Service and Device Support</h3>
            <p>Find device help and support</p>
            <p>Troubleshoot device issue</p>
        </span>
        </div>

    </section>

  
    <div id="search_bottom" >
        <h2>Find more solutions   Type something like, "question about a charge"</h2>

        <div class="search">
            <i class="fa fa-search">
                <input type="text" placeholder="Search Here">
            </i>
           
        </div>
    </div>

      <div id="refernce" class="section-p2">
        <hr>
        <h2>Reference</h2>
        <iframe src="https://www.youtube.com/embed/JtBLAdkNAV8?si=-MVe7Vw1V8cNwhun" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe  src="https://www.youtube.com/embed/WbCAmPbyRfE?si=vbHRHKitynw5PUn9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

   
    <a href="#hello" class="full-width-button">Back to Top</a>

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
   
    #refernce h2{
        margin-top:20px;
        margin-bottom:10px;
        font-size: 40px;
      }

    #close{
        display: none;
    }

    #search_bottom {
        margin-top:-20px;
        padding: 10px 80px;
    }
    #search_bottom h2 {
        margin-top:20px;
        margin-bottom:10px;

    }
  #search_bottom  .search{
  padding: 10px;
    border: 1px solid silver;
  }
  #search_bottom  .search input{
    padding: 5px 150px 5px 10px;
    font-size: 15px;
   border: none;
 outline: none;
  }

   .section-p2{
    padding: 30px 80px;
   }
    
#cards{
    padding: 10px 80px;
    display: flex;
    flex-wrap: wrap;
 
}
#hello{
    padding: 10px 80px;
}

#hello h2{
    margin-bottom:10px;
}
.text{
    margin-top: -10px;
    padding: 10px 80px;
}
   #cards .box{
        display: flex;
        border: 1px solid silver;
        width: 290px;
       margin-right: 10px;
       margin-bottom: 20px;
       border-radius: 10px;
       box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.06);
       gap: 10px;
       cursor: pointer;
        padding: 5px 20px 5px 20px;
    }

    #cards .box:hover{
        box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.20);
    }
    #cards .box img{
        padding-top: 10px;
        height:60px;
    }
   

    #cards .box .row h2{
       margin-top: 20px;
       font-size: 20px;
    }
    #cards .box .row p {
    font-weight: 500;
    color: rgb(188, 188, 188);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin-top: 2px;
    font-size: 15px;
}

#refernce{
   text-align: center;
      }
iframe {

        width: 600px;
        height: 300px;
   
    }
@media (max-width:1200px) {
    #cards{
    padding: 10px 67px;
    display: flex;
    flex-wrap: wrap;
 
}
}


@media (max-width:850px) {
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
#cards {
        padding: 10px 17px;
        display: flex;
        flex-wrap: wrap;
    }
   

  }



  @media (max-width:670px) {
    #cards {
        padding: 10px 9px;
        display: flex;
        flex-wrap: wrap;
    }
  #cards .box {
    display: flex;
    border: 1px solid silver;
    width: 258px;

}
.section-p2 {
    padding: 30px 33px;
}
#search_bottom .search input {
    padding: 5px 50px 5px 10px;
    font-size: 15px;
    border: none;
    outline: none;
}
  }

  @media (max-width:570px) {
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
iframe {
        width: 419px;
        height: 285px;
    }
    #search_bottom .search input {
    padding: 5px 50px 5px 10px;
    font-size: 15px;
    border: none;
    outline: none;
}
}



  @media (max-width:435px) {
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
  #cards {
        padding: 10px 58px;
        display: flex;
        flex-wrap: wrap;
    }
    .section-p2 {
        padding: 30px 7px;
    }
    iframe {
        width: 393px;
        height: 285px;
    }
    #search_bottom .search input {
    padding: 5px 50px 5px 10px;
    font-size: 15px;
    border: none;
    outline: none;
}
}
@media (max-width: 390px) {
    #cards {
        padding: 10px 37px;
        display: flex;
        flex-wrap: wrap;
    }
    #search_bottom .search input {
    padding: 5px 70px 5px 10px;
    font-size: 15px;
    border: none;
    outline: none;
}
iframe {
        width: 354px;
        height: 285px;
    }
}



</style>
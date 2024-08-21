<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
    <div id="header">
        
        <img src="https://logos.textgiraffe.com/logos/logo-name/Shah-designstyle-friday-m.png" class="logo"> 
        <i class="fa fa-bars" id="arrow"></i>
        <ul id="ul">
            <span id="close">&#10062;</span>
            <li><a href="task-1.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li class="dropdown">
              <a href="product_show.php" >Product</a>
              
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
    $query = "SELECT COUNT(*) AS cart_count FROM add_to_cart WHERE u_id = '$userID'";
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
    <span class="cart-number"><?php echo $cartCount; ?></span> 
</li>

            <li><a href="#footers" id="down"><i class="fa fa-angle-down"></i></a></li>
            
          </ul>
          
          
    </div>

    <section id="product" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
        <?php
include("connection.php");

$query = "SELECT * FROM `insert_product` WHERE product_name = 'SHOE' OR product_name = 'shoe'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <div class="pro" >
    <a href="product_detail.php?id='. $row["i_id"] .'">
    <img src="image/' . $row["product_image"] . '" alt="' . $row["product_name"] . '" class="product-image">
    </a>
        <div class="bes">
            <span>'. $row["product_name"] .'</span>
            <h5> '. $row["product_description"] .' </h5>
            <div class="star">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <h4>$'. $row["product_price"] .'</h4>
        </div>
        <form method="post">
            <button type="submit" name="add_to_cart" class="carts">Add</button>
            <input type="hidden" name="product_id" value="'. $row["i_id"] .'">
            <input type="hidden" name="product_name" value="'. $row["product_name"] .'">
            <input type="hidden" name="product_price" value="'. $row["product_price"] .'">
            <input type="hidden" name="product_image"  value="'. $row["product_image"] .'">
        </form>
    </div>';
}

if(isset($_POST['add_to_cart'])){

    if(!isset($_SESSION['user_id'])) {
      
        echo "<script>
                alert('Please log in first to add items to your cart.');
                window.location.href = 'sign.php'; // Redirect to sign-in page
              </script>";
        exit(); 
    }else{
        $userID = $_SESSION['user_id'];
    }
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_discount=0;
    $product_quantity=1;
    $select = mysqli_query($conn,"SELECT * FROM `add_to_cart` WHERE product_id=' $product_id' AND u_id ='$userID'");
    if(mysqli_num_rows($select) > 0){
        echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Already in Cart',
                text: 'This product is already in your cart.',
                confirmButtonText: 'OK'
            });
          </script>";
    } else {
        $query = "INSERT INTO `add_to_cart` (c_name,c_image,c_quantity,c_price,c_discount,product_id,u_id) values ('$product_name','$product_image',$product_quantity,'$product_price','$product_discount',' $product_id ','$userID')";
        $result=mysqli_query($conn,$query);
        if ($result) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Product Added',
                text: 'The product has been added to your cart successfully!',
                confirmButtonText: 'OK'
            }).then(()=>{
                window.location.href='product_show.php';
            });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error adding the product to your cart.',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        }
    }
}
?>

          

            
</div>
    </section>
   

    
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
           <a href="">My Whislist</a>
           <a href="cart.php">Track My Order</a>
           <a href="help.html">Help</a>
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
     <div class="symbol">
         <h3>Follow Us</h3>
             <i class="fa fa-instagram"></i>
             <i class="fa fa-google"></i>
             <i class="fa fa-facebook"></i>
             <i class="fa fa-twitter"></i>
             <a href="#main-home" class="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
     </div>  
 </section>




  </body>
  <script>
    const bigimage = document.getElementById("mainimage");
    const smallimages = document.querySelectorAll(".small img");
    for (let i = 0; i < smallimages.length; i++) {
        smallimages[i].onclick = function() {
            bigimage.src = smallimages[i].src;
        };
    };
  </script>
   
<script>
    
    const arrow = document.getElementById('arrow');
    const ul = document.getElementById('ul');
    const cross = document.getElementById('close');

    arrow.addEventListener('click',()=>{
        ul.classList.add('active');
    })
    cross.addEventListener('click',()=>{
        ul.classList.remove('active');
    })
</script>

</html>
<style>
    body{
        margin: 0;
        width: 100%;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .dropdown {
        position: relative;
        display: inline-block;
      }
      .cart {
        position: relative;
    }
    .cart-number {
        position: absolute;
        top: -10px;
        right: -10px;
        background: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }
    
      .dropbtn {
        display: inline-block;
      }
      .section-p1{
        padding: 40px 80px;
    }
      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }
    
      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }
    
      .dropdown-content a:hover {
        background-color: #f1f1f1;
      }
    
      .dropdown:hover .dropdown-content {
        display: block;
      }
    
    #close{
        display: none;
    }
    #down{
        background: rgb(130, 130, 130);
        padding: 10px ;
    
        border-radius: 100px;
    }
  
    #header{
        display: flex;
        width: 100%;
        justify-content: space-between;
        background: rgb(255, 244, 244);
        box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.06);
        position: sticky;
        left: 0;
        top: 0;
    }
    #arrow{
        display: none;
    }
    
    .top{
        
        height: 40px;
        width: 40px;
        background: rgb(255, 255, 255);
        border-radius: 50%;
      
    }
    
    .top i{
    padding-bottom: 20px;
    }
    
    .logo{
        width: 100px;
        height: 100px;
        margin-left: 50px;
        background-repeat: no-repeat;
    
    }
    #header ul{
        margin-top: 40px;
        display: flex;
        margin-right: 100px;
        gap: 40px;
        list-style: none;
        font-size: 20px;
    }
    

    #header ul li a{
        text-decoration: none;
       color: black;
    }

    #header ul li a:hover{
        color: brown;
        
    }
    
    #footers{
        display: flex;
        justify-content: space-around;
        background: rgb(171, 171, 171);
      
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

    section-p1{
        padding: 40px 80px;
    }
    
    #product .pro{
        width: 23%;
        min-width: 250px;
        padding: 10px 12px;
        border: 1px solid #cce7d0;
        border-radius: 25px;
        cursor: pointer;
        box-shadow: 20px 20px 30px rgb(0, 0, 0,0.02);
        margin: 15px 0 ;
        position: relative;
    
    }
    #product .pro:hover{
        box-shadow: 20px 20px 30px rgb(0, 0, 0,0.06);
    }
    #product h2 , #product p{
        text-align: center;
    }
    #product .pro img{
        width: 100%;
        border-radius: 20px;
    }
    
    #product .pro .bes{
        text-align: start;
        padding: 10px 0;
    }
    
    #product .pro .bes span{
        text-align: center;
        color: #606063;
        font-size: 12px;
    }
    
    
    #product .pro h5{
        padding-top: 7px;
        color: #1a1a1a;
        font-size: 14px;
    }
    
    
    #product .pro .bes i{
        font-size: 15px;
        color: yellowgreen;
    }
    
    #product .pro .bes h4{
        padding-top: 7px;
        color:#088178;
        font-size: 22px;
        font-weight: 700;
    }
    
    #product .pro .carts{
     width: 40px;
     height: 40px;
     line-height: 10px;
     cursor: pointer;
        border-radius: 50%;
        background-color: #93ffa4;
        font-weight: 900;
        position: absolute;
        bottom: 50px;
        right: 20px;
    }
    
    #product .pro-container{
        display: flex;
       gap: 10px;
        justify-content: space-between;
        flex-wrap: wrap;
      
    }
    
  
   
    @media screen and (max-width:600px) {
    #header {
        height: 12vh;
        width: 456px;
    }
    #header ul{
        margin-top: 40px;
        display: none;
        flex-direction: column;
        margin-right: 100px;
        gap: 40px;
        width: 400px;
        padding: 20px 40px 20px 20px;
        height: 40vh;
        background: wheat;
        position: relative;
        top: 0px;
        list-style: none;
        z-index: 2;
        font-size: 20px;
        left: 300px;
        transition: 0.3s ease;
    }
    #header ul.active{
        display: flex;
        left: 100px;
    }
    #header ul #down{
        display: none;
    }
    #two_section {
        display: flex;
        height: 50vh;
        width: 193%;
        flex-direction: column;
        gap: 10px;
        margin: 10px 10px 10px 10px;
    }
   
    #footers{
        display: flex;
        justify-content: space-around;
        flex-direction: column;
        background: rgb(171, 171, 171);
        text-align: center;
        width: 456px;
    }
    footer .icons{
        font-size: 25px;
        text-align: center;
        margin-top: -10px;
        }
   
          #two_section .section1 h2{
            padding: 10px 10px 0px 2px;
        }
        #arrow{
            display: flex;
          color: rgb(0, 0, 0);
       position: fixed;
      left: 350px;
       top: 38px;
        font-size: 20px;
            cursor: pointer;
        }
        #close{
            display: flex;
            position: relative;
            bottom: 15px;
            right: 10px;
            font-size: 30px;
            cursor: pointer;
        }
        #icons{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            background: rgb(171, 171, 171);
           }
           #icons .symbol{
            position: relative;
            left: 130px;
           }

}

</style>
</style>

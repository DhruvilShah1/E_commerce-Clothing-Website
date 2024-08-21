<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>title</title>
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

   </div>
</section>
   
    <?php
include("connection.php");
$product_id = $_GET['id'];
$query = "SELECT * FROM `insert_product` WHERE i_id = '$product_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $product = mysqli_fetch_assoc($result);
?>   
    
 <section id="productdetail" class="section-p1">
    <div class="bigimage">
    <img src="./image/<?php echo $product['product_image']; ?>" id="mainimage" width="100%">
   
 
    <div class="smallimage_group">
        <div class="small">
            <img  src="./image/<?php echo $product['product_image']; ?>" id="smallimage" width="100%">
        </div>
        <div class="small">
            <img  src="./image/<?php echo $product['product_image']; ?>" id="smallimage" width="100%">
        </div>
        <div class="small">
            <img  src="./image/<?php echo $product['product_image']; ?>" id="smallimage" width="100%">
        </div>
        <div class="small">
            <img  src="./image/<?php echo $product['product_image']; ?>" id="smallimage" width="100%">
        </div>
    </div>
    </div>

    <div class="detail_section">
        <h6 onclick="window.location.href='task-1.php';"><?php echo $product['product_name']  ?> / Home</h6>
        <h4><?php echo $product['product_description']  ?></h4>
        <h2>$<?php echo $product['product_price']  ?></h2>
        <form method="post">
        <select name="size" id="size">
        <option value="">Select a Size</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select>

       <input type="number" id="quantity" value="1">
    
     
            <button type="submit" name="add_to_cart" class="carts">Add</button>
            <input type="hidden" name="product_id" value="<?php echo $product['i_id']  ?> ">
            <input type="hidden" name="product_name" value="<?php echo $product['product_name']  ?> ">
            <input type="hidden" name="product_price" value="<?php echo $product['product_price']  ?> ">
            <input type="hidden" name="product_image"  value="<?php echo $product['product_image']  ?> ">
        </form>

       <h4>Product Detail</h4>
       <span>Introducing our premium cotton t-shirt, crafted with meticulous attention to detail for ultimate comfort and style. Made from 100% organic cotton, this t-shirt offers a luxurious feel against the skin while also being environmentally friendly. Its lightweight and breathable fabric make it perfect for everyday wear, whether you're lounging at home or hitting the streets. The classic crew neckline and tailored fit ensure a flattering silhouette for all body types. With its versatile design, you can easily dress it up with a blazer or keep it casual with jeans for a laid-back look. Available in a range of vibrant colors and sizes, our t-shirt is a wardrobe staple that promises both quality and durability.

       </span>
    </div>
 </section>


<?php

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
    $selected_size = $_POST['size'];
    $total_amount = 0;
    $product_discount=0;
    $product_quantity=1;
    $select = mysqli_query($conn, "SELECT * FROM `add_to_cart` WHERE product_id=' $product_id' AND u_id ='$userID '");
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
        if (empty($selected_size)) {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Size is required!',
                    });
                  </script>";
        } else {
        $query = "INSERT INTO `add_to_cart` (c_name,c_image,c_quantity,c_size ,c_price,c_discount,product_id,u_id , c_status) values ('$product_name','$product_image',$product_quantity,'$selected_size','$product_price','$product_discount',' $product_id ','$userID' , 0)";
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
    }}
}
?>
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
    .section-p1{
        padding : 30px 80px;
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
    #productdetail{
        display: flex;
        
    }
    #productdetail .bigimage{
        width: 40%;
        margin-right: 50px;
    }
    #productdetail .smallimage_group{
        display: flex;
        justify-content: space-around;
    }
   
    #productdetail .smallimage_group .small{
        flex-basis: 24%;
        cursor: pointer;
    }
    #productdetail .detail_section{
        width: 50%;
        padding-left: 30px;
    }
    #productdetail .detail_section h6{
        font-size: 30px;
        margin-bottom: 20px;
    }
    
    #productdetail .detail_section h4{
        font-size: 20px;
        margin-bottom: 20px;
    }
    
    #productdetail .detail_section h2{
        font-size: 50px;
        margin-bottom: 20px;
    }
    
    #productdetail .detail_section select{
        display: block;
        padding: 5px 30px 5px 30px;
        margin-bottom: 10PX;
    }
    
    #productdetail .detail_section input{
        width: 40px;
        padding: 5px 3px 5px 0px;
    }
    #productdetail .detail_section button{
        background-color: #088178;
        color: #E3E6F3;
        margin-left: 20px;
        padding: 10px 30px 10px 30px;
        margin-bottom: 20px;
    }
    #productdetail .detail_section span{
        line-height: 25px;
        text-align: justify;
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

@media (max-width:830px) {
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
#productdetail {
    display: flex;
    flex-direction: column;
    text-align: center;
}
#productdetail .bigimage {
    width: 100%;
    margin-right: -1px;
}

#productdetail .detail_section {
    width: 100%;
    padding-left: -1px;
}
#productdetail .detail_section span {
    width: 100%;
    font-size: 19px;
    line-height: 30px;
    /* text-align: unset; */
}
#productdetail .detail_section input {
    width: 40px;
    padding: 5px 3px 5px 12px;
}
#productdetail .detail_section select {
    position: absolute;
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
}

  
    @media (max-width:600px) {
        body{
            width: 100%;
        }

        #productdetail{
            display: flex;
            flex-direction: column;
        }
        #productdetail .bigimage{
            width: 100%;
            margin-right: 50px;
            margin-bottom: 10px;
        }
        #productdetail .detail_section{
            margin-left: -21px;
            width: 110%;
            padding-left: 30px;
        }
        #productdetail .detail_section h6{
            font-size: 30px;
            margin-bottom: 20px;
        }
        
        #productdetail .detail_section h4{
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        #productdetail .detail_section h2{
            font-size: 50px;
            margin-bottom: 15px;
        }
        
    #productdetail .detail_section input{
        width: 100px;
        padding: 10px 5px 10px 50px;
    }
        #productdetail .detail_section button{
            background-color: #088178;
            color: #E3E6F3;
            margin-left: 20px;
            padding: 6px 10px 15px px;
            margin-bottom: 20px;
        }
        #productdetail .detail_section span{
            text-align: justify;
            font-size: 13px;
          
        }
        
    #productdetail .detail_section input{
        width: 40px;
        padding: 10px 5px 10px 10px;
    }
    
    }
   
 
    @media screen and (max-width:600px) {
        body{
            width: 100%;
           
        }
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
        width: 300px;
        padding: 20px 40px 20px 20px;
        height: 40vh;
        background: wheat;
        position: relative;
        top: 0px;
        list-style: none;
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
       top: 35px;
       left: 350px;
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

<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
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

    <section id="product" >
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
       
    </div>
 

    <div class="search-container">
    <label for="search">Search :</label>
    <input type="text" id="search" placeholder="Search products...">
   
</div>


        <div class="pro-container">
   <?php
   include("connection.php");

   
   
   $query = "SELECT * FROM `insert_product`";
   $result = mysqli_query($conn, $query);
   
   $output = "";
   if (mysqli_num_rows($result) > 0) {
       while ($row = mysqli_fetch_assoc($result)) {
           echo '
           <div class="pro">
               <a href="product_detail.php?id=' . $row["i_id"] . '">
                   <img src="image/' . $row["product_image"] . '" alt="' . $row["product_name"] . '" class="product-image">
               </a>
               <div class="bes">
                   <span>' . $row["product_name"] . '</span>
                   <h5>' . $row["product_description"] . '</h5>
                   <div class="star">
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                   </div>
                   <h4>$' . $row["product_price"] . '</h4>
               </div>
               <form method="post">
                   <button type="submit" name="add_to_cart" class="carts">Add</button>
                   <button type="submit" name="likes" class="heart-btn" aria-label="Add to Wishlist">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                <path d="M20.8 4.6c-1.4-1.4-3.6-1.4-5 0l-.8.8-.8-.8c-1.4-1.4-3.6-1.4-5 0s-1.4 3.6 0 5l5 5 5-5c1.4-1.4 1.4-3.6 0-5z"></path>
            </svg>
        </button>
                   <input type="hidden" name="product_id" value="' . $row["i_id"] . '">
                   <input type="hidden" name="product_name" value="' . $row["product_name"] . '">
                   <input type="hidden" name="product_price" value="' . $row["product_price"] . '">
                   <input type="hidden" name="product_image" value="' . $row["product_image"] . '">
               </form>
           </div>';
       }
   } else {
    echo ' <p class="nofound">Sorry, no results matched your search.</p>';
   }
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
                alert('Please log in first to add items to your cart.');
                window.location.href = 'sign.php'; // Redirect to sign-in page
              </script>";
        exit();
    } else {
        $userID = $_SESSION['user_id'];
    }

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $selected_size = "";
    $product_discount = 0;
    $product_quantity = 1;

    $select = mysqli_query($conn, "SELECT * FROM `add_to_cart` WHERE product_id='$product_id' AND u_id='$userID'");
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
            $query = "INSERT INTO `add_to_cart` (c_name, c_image, c_quantity, c_size, c_price, c_discount, product_id, u_id , dates) VALUES ('$product_name', '$product_image', $product_quantity, '$selected_size', '$product_price', '$product_discount', '$product_id', '$userID' , NOW())";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Added',
                            text: 'The product has been added to your cart successfully!',
                            confirmButtonText: 'OK'
                        }).then(() => {
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
    }}
?>
<?php
if (isset($_POST['likes'])) {
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
                alert('Please log in first to add items to your cart.');
                window.location.href = 'sign.php'; // Redirect to sign-in page
              </script>";
        exit();
    } else {
        $userID = $_SESSION['user_id'];
    }
    $select = mysqli_query($conn, "SELECT * FROM `likes` WHERE product_id='$product_id' AND u_id='$userID'");
    if (mysqli_num_rows($select) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'info',
            title: 'Already in Wishlist',
            text: 'This product is already in your wishlist.',
            confirmButtonText: 'OK'
        });
      </script>";
      
    } else {
        $query = "INSERT INTO `likes` (c_name, c_image, c_quantity, c_size, c_price, c_discount, product_id, u_id , dates ) VALUES ('$product_name', '$product_image', '0', '0', '$product_price', '0', '$product_id', '$userID' , NOW() )";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Wishlist Added',
                text: 'The product has been added to your wishlist successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href='product_show.php';
            });
          </script>";
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error adding the product to your wishlist.',
                confirmButtonText: 'OK'
            });
          </script>";
}
    
}
}

   ?>

          <script>
            $(document).ready(function(){
  $("#search").keyup(function(){
    var search_item = $(this).val();
    $.ajax({
        url : "search.php",
        type:"POST",
        data :{search:search_item},
        success : function(data){
            $(".pro-container").html(data)
        }
    })
   
})

            });


          </script>

            
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
        ul.classList.add('active');
    })
    cross.addEventListener('click',()=>{
        ul.classList.remove('active');
    })
</script>

</html>
<style> 
.heart-btn {
    position: absolute;
    right:20px;
    bottom: 425px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    outline: none;
}

.heart-btn svg {
    width: 30px;
    height: 30px;
    color: #ff6b6b;
    transition: color 0.3s ease;
}

.heart-btn:hover svg {
    color: #ff4757;
}
 .search-container {
        display: flex;
        align-items: center;
        justify-content: center; 
        margin-top: 20px;
        margin-bottom: 20px;
        text-align: center; 
    
    }

    .search-container label {
        font-family: Arial, sans-serif;
        font-size: 16px; 
        color: #333; 
        margin-right: 10px; 
        }

    .search-container input[type="text"] {
        width: 100%; 
        max-width: 400px; 
        padding: 10px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        font-size: 16px; 
        transition: border-color 0.3s ease; 
    }


    .search-container input[type="text"]::placeholder {
        color: #aaa; 
    }


    .search-container input[type="text"]:focus {
        border-color: #007bff; 
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2); 
        outline: none; 
    }
   
      .section-p1{
        padding: 40px 80px;
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
    #navbar{
        display: flex;
        background: rgb(255, 244, 244);
        box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.06);
        padding: 10px 30px;
        justify-content: space-between;
        z-index: 999;
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

    .container {
    display: flex;
    border: 1px solid #ccc;
    padding: 10px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    width: 98%;
    justify-content: space-between;
}

.search-bar, #category {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    flex: 1;
    margin-right: 10px;
}

.dropdown-menu {
    flex: 1;
}
.search-bar:focus, .dropdown-menu:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

.search-button {
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    background-color: #007bff;
    margin-right:20px;
    color: white;
    cursor: pointer;
}
  
    .section-p1{
        padding: 40px 80px;
    }   
    .section-p2{
        padding: 40px 80px;
    }   
     
     #search-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
}

#search-bar label {
    font-family: 'Roboto', sans-serif;
    font-size: 18px;
    margin-right: 10px;
    color: #333;
}

#search-bar input[type="text"] {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: 1px solid  #007BFF;
    border-radius: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
}

#search-bar input[type="text"]::placeholder {
    color: #aaa;
}

#search-bar input[type="text"]:focus {
    border-color: #007BFF;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    outline: none;
}

#search-bar input[type="text"]:hover {
    border-color: #0056b3;
}


    
    #product .pro{
        width: 23%;
        min-width: 250px;
        padding: 10px 12px;
        border: 1px solid #cce7d0;
        border-radius: 25px;
        cursor: pointer;
        box-shadow: 20px 20px 30px rgb(0, 0, 0,0.02);
        margin: 15px 50px ;
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
    #product h2, #product p {
   margin-top: 15px;
   text-align: center;
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
  
     
        flex-wrap: wrap;
    }
    
  .nofound {
    font-size: 20px;
    color: #ff0000; 
    text-align: center;
    margin-top: 20px;
    font-weight: bold;
    padding: 15px;
    border: 2px dashed #ff0000;
    background-color: #ffe6e6; 
    border-radius: 5px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 100px;
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
    #product h2, #product p {
   margin-top: 12px;
   text-align: center;
}

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
#product .pro-container {
        display: flex;
        flex-wrap: wrap;
        /* margin: 0; */
        padding: 10px 21px;
    } 

  }
  @media (max-width:790px) {
   
   #product h2, #product p {
   margin-top: 12px;
   text-align: center;
}
   .container {
   width: 97%;

}
 #product .pro {
   width: 23%;
   min-width: 250px;
   padding: 10px 12px;
   border: 1px solid #cce7d0;
   border-radius: 25px;
   cursor: pointer;
   box-shadow: 20px 20px 30px rgb(0, 0, 0, 0.02);
   margin: 15px 13px;
   position: relative;
}
 }

  @media (max-width:670px) {
   
    #product h2, #product p {
    margin-top: 12px;
    text-align: center;
}
    .container {
    width: 97%;

}
  #product .pro {
    width: 23%;
    min-width: 250px;
    padding: 10px 12px;
    border: 1px solid #cce7d0;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 20px 20px 30px rgb(0, 0, 0, 0.02);
    margin: 15px 13px;
    position: relative;
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

</style>

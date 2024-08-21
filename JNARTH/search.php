<?php
include("connection.php");

$search_value =  $_POST['search'];

$query = "SELECT * FROM `insert_product` WHERE product_name LIKE '%$search_value%'";
$result = mysqli_query($conn, $query);

$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
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
    $output =' <p class="nofound">Sorry, no results matched your search.</p>';
}

echo $output;

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
    if (mysqli_num_rows($select) > 0) {
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
    }
}

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
        $query = "INSERT INTO `likes` (c_name, c_image, c_quantity, c_size, c_price, c_discount, product_id, u_id , dates) VALUES ('$product_name', '$product_image', '0', '0', '$product_price', '0', '$product_id', '$userID' , NOW())";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

    <title>Register</title>
</head>

<body>
    
    <div class="container">
        <form  id="form" method="post">
            <h1>Register</h1>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" required>
                <div class="error"></div>
            </div>
            <button type="submit" name="submit">Register</button>
            <p>Sign In HERE <a href="sign.php">Sign</a></p>
        </a<>
    </div>
</div>
</body>
</html>
<?php
include("connection.php");

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    // Check if passwords match

    if (strlen($password) < 8)  {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Password must be at least 8 characters long.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
       
    } else if ($password !== $cpassword) { 
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Passwords do not match!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    } else {
        $checkEmailQuery = "SELECT * FROM `register` WHERE `r_email` = '$email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
    
        if(mysqli_num_rows($checkEmailResult) > 0){
            echo "<script>
            Swal.fire({
                title: 'Email Already Registered!',
                text: 'The email you entered is already registered.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel'
            }).then(() => {
                window.location.href = 'sign.php';
            });
            </script>";
        } else {
            $query = "INSERT INTO `register` (r_name, r_email, r_password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $query);
            if($result){
                echo "<script>
                Swal.fire({
                    title: 'Registration Successful!',
                    text: 'You have registered successfully.',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel'
                }).then(() => {
                    window.location.href = 'sign.php';
                });
                </script>";
            }
        }
    }
}
    ?>
    

<style>
    body {
        background-size: contain;
        background-attachment: fixed;
        margin: 0;
        font-family:'Courier New', Courier, monospace
    }

    #form {
        width: 400px;
        margin: 10vh auto 0 auto;
       background: whitesmoke;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        border-radius: 5px;
        padding: 30px;
    }

    h1 {
        text-align: center;
        color: #000000;
    }


    #form button {
        background-color: #160653;
        color: white;
        border: 1px solid #992020;
        border-radius: 5px;
        padding: 10px;
        margin: 20px 0px;
        cursor: pointer;
        font-size: 20px;
        width: 100%;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .input-group input {
        border-radius: 5px;
      
        margin-top: 5px;

        padding: 10px;
        border: 1px solid rgb(34, 193, 195);
    }

    .input-group input:focus {
        outline: 0;
    }

    .input-group .error {
        color: rgb(242, 18, 18);
        font-size: 16px;
        margin-top: 5px;
    }

    .input-group.success input {
        border-color: #0cc477;
    }

    .input-group.error input {
        border-color: rgb(206, 67, 67);
    }
</style>
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
        <form id="form" method="post">
            <h1>Sign Up Here</h1>
         
            <div class="input-group">
                <label for="email">Username Or Email</label>
                <input type="text" id="email" name="email" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="Password" name="password" required>
                <div class="error"></div>
            </div>
         
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
</div>
<?php

include("connection.php");
session_start(); 
if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $password= $_POST['password'];

    $query = "SELECT * FROM `register` WHERE r_email = '$email' && r_password ='$password'";
    $result = mysqli_query($conn, $query);

    if($result){
        if(mysqli_num_rows($result)> 0){
             $user = mysqli_fetch_assoc($result);
             $_SESSION['user_id'] = $user['r_id']; 
             $_SESSION['user_name'] = $user['r_name']; 

        echo "<script>
        Swal.fire({
            title: 'Login Successful!',
            text: 'You have Login successfully.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel'
        }).then(() => {
            window.location.href = 'index.php';
        });
        </script>";
    }else{
        echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Passwords do not match!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
      </script>";
    }
}
}
?>

</body>
</html>

<style>
    body {
        background-size: contain;
        background-attachment: fixed;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    #form {
        width: 400px;
        margin: 10vh auto 0 auto;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        border-radius: 5px;
        padding: 30px;
        background: rgb(215, 215, 215);
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
        font-size: 20px;
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
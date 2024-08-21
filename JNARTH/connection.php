<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jnath_ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn){
    echo "UNconnected";
}

?>
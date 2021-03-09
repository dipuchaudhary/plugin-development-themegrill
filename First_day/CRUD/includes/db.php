<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpcrud";

// create connection
$conn = mysqli_connect($servername,$username,$password,$dbname);

// check connection
if(!$conn){
    die("Error: ".mysqli_connect_error());
} 
// echo "Connection successfull";

?>
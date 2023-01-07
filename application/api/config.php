<?php 

$servername =   'localhost';
$username   =  'amsons_aman';
$password = 'Priyanka@1';
$database='amsons_amsons2';
$con=new mysqli($servername, $username, $password,$database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}else



?>
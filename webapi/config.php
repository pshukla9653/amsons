<?php 

$servername =   'localhost';
$username   =  'dukeinfo_amsons';
$password = 'vivek@1976';
$database='dukeinfo_amsons';
$con=new mysqli($servername, $username, $password,$database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}else



?>
<?php
$db_servername = "localhost"; 
$db_username = "mdr"; 
$db_password = "mdr123"; 
$db_database = "mdr_weblog"; 

$conn = new mysqli($db_servername, $db_username, $db_password, $db_database);

if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}

//echo "Connected successfully";
?>
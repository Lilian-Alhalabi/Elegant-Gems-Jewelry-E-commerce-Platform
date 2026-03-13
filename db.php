<?php
$host = "sql113.infinityfree.com";
$user = "if0_41376740";
$pass = "********"; 
$dbname = "if0_41376740_XXX"; 

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

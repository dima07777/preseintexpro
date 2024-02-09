<?php 
include 'conn.php'; 
session_start();

$name = $_POST['name']; 
$userId = $_SESSION['user']['id']; 


$sql = "INSERT INTO presentations (name, user_id) VALUES ('$name', '$userId')"; 

if ($conn->query($sql) === TRUE) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . $conn->error; 
} 

$conn->close(); 
?>

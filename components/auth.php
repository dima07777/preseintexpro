<?php 
include "conn.php"; 

session_start();

if (!isset($_SESSION['user']) or ($_SESSION['user']=="")) { 
    if (!isset($_POST['email']) or $_POST['email']=="") { 
        $_SESSION['error'] .= "Введите email"; 
    } else if (!isset($_POST['password']) or $_POST['password']=="") { 
        $_SESSION['error'] .= "Введите пароль"; 
    } else { 
        $email = $_POST['email']; 
        $pass = $_POST['password']; 
        $bool = false; 
        $result = $conn->query("SELECT * FROM users"); 
        while ($res = mysqli_fetch_array($result)) { 
            if ($pass == $res['password'] and $email == $res['email']) { 
                $bool = true; 
                $_SESSION['user'] = array(
                    'id' => $res['id'],
                    'name' => $res['name'],
                    'email' => $res['email'],
                    'phone' => $res['phone'],
                    'password' => $res['password']
                ); 
                $_SESSION['url'] = "Location: ../index.php";
            } 
        } 
        if ($bool == false) $_SESSION['error'] = "Неверный логин или пароль"; 
    } 
} 
header("Location: ../index.php");
?>

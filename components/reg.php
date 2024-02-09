<?php
    include "conn.php";
    if (isset($_SESSION['user']) and ($_SESSION['user']!="")) {
    } else {
        if (!isset($_POST['name']) or $_POST['name']=="") {
            $_SESSION['error'] .= "Не верно задано Имя";
        } else if (!isset($_POST['email']) or $_POST['email']=="") {
            $_SESSION['error'] .= "Не верно задан email";
        } else if (!isset($_POST['password']) or $_POST['password']=="") {
            $_SESSION['error'] .= "Не верно задан пароль";
        } else if (!isset($_POST['phone']) or $_POST['phone']=="") {
            $_SESSION['error'] .= "Не верно задан номер телефона";
        } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $phone = $_POST['phone'];
            if ( (strlen($name) < 4) or (strlen($name) > 50) ) {
                $_SESSION['error'] = "Имя не в допустимом диапозоне кол-ва символов (4-50)";
            } else if ( (strlen($email) < 5) or (strlen($email) > 50) ) {
                $_SESSION['error'] = "email в допустимом диапозоне кол-ва символов (5-50)";
            } else if ( (strlen($pass) < 5) or (strlen($pass) > 50) ) {
                $_SESSION['error'] = "Пароль не в допустимом диапозоне кол-ва символов (5-50)";
            } else { 
                $result = $conn -> query("SELECT * FROM `users`");
                $bool = true;
                while ($res = mysqli_fetch_array($result)) {
                    if ($phone == $res['phone']) {
                        $bool = false;
                        $_SESSION['error'] = "Этот телефон уже используется";
                    } else if ($email == $res['email']) {
                        $bool = false;
                        $_SESSION['error'] = "Этот email уже используется";
                    }
                }
                if ($bool == true) {
                    $conn -> query("INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`) 
                        VALUES (NULL, '$name', '$email', '$pass', '$phone')");
                    $_SESSION['url'] = "Location: ../index.php";
                }
            }
        }
    }
    header("Location: ../pages/registration.php");
?>
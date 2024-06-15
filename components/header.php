<?php
include "../components/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sub page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="main_menu">
        <a href="../index.php">
            <div class="logo">
            <img src="../img/logo.png" alt="">
            <h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
            </div>
        </a>
        <div class="main_menu_items">
                <!-- <a href="" class="main_menu_item">Предпросмотр</a> -->
                <!-- <a href="" class="main_menu_item">Показ</a> -->
            <?php 
                if (isset($_SESSION['user']) and ($_SESSION['user'])) {
                    echo "<a href='' class='main_menu_item'>Пользователь: {$_SESSION['user']}</a>
                    <a href='' class='main_menu_item'>Выход</a>";
                } else {
                    echo "<a href='registration.php' class='main_menu_item'>Регистрация</a>
                    <a href='authorization.php' class='main_menu_item'>Авторизация</a>";
                }
            ?>
        </div>
    </header>
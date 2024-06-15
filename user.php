<?php
session_start();
include "components/conn.php";
$current_page = "user.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
    <header class="main_menu">
        <a href="">
            <div class="logo">
                <img src="../img/logo.png" alt="">
                <h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
            </div>
        </a>
        <div class="main_menu_items">
           
            <?php 
               if (isset($_SESSION['user']) and isset($_SESSION['user']['name'])) { 
                echo "<a href='' class='main_menu_item'>Пользователь: {$_SESSION['user']['name']}</a> 
                <a href='components/exit.php' class='main_menu_item'>Выход</a>"; 
            }
            
                else {
                    echo "<a href='pages/registration.php' class='main_menu_item'>Регистрация</a>
                    <a href='pages/authorization.php' class='main_menu_item'>Авторизация</a>";
                }
            ?>
        </div>
    </header>
    <div class="shadow"></div>
    <main>
        
        <aside>
            <div class="navmenu">
                <a href="index.php" class="namenavmenu <?php if ($current_page === 'index.php') echo 'active'; ?>">Мои презентации</a>
                <a href="index.php" class="namenavmenu <?php if ($current_page === 'user.php') echo 'active'; ?>">Моя страница</a>
            </div>
        </aside>

    
        <article>
            <?php
                if (isset($_SESSION['error']) and $_SESSION['error']!='') {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
         
            <div class="rect2">
                <img src="img/rect22.png" alt="">
            </div>
            <div class="rect3">
                <img src="img/rect22.png" alt="">
            </div>
            
            <p style="margin-left: 4%; margin-top: 2%; font-size: 1.2vw; margin-bottom: 2%;"> <b>Мой профиль</b></p> 
            <hr style="width: 90%; margin-left: 4%">


            <div class="userint">
                    
                    <div class="leftmenuuser">
                        <div id="buttons">
                                <button id="btn-profile" class="username2" class="username">Профиль</button>
                                <button id="btn-security" class="username2">Пароли и безопасность</button>
                                <button id="btn-account" class="username2">Управление аккаунтом</button>
                                
                        </div>
                    </div>
                    <div id="content">
    <div id="profile">
        <div class="rightmenuuser" id="profile" >
            <div class="headuser" id="profile">
                <p  style="color:white; margin-left: 5%"> Профиль</p>    
            </div>

            <div class="menuuser" id="profile" >
                    <div class="imguserleft" id="profile">
                    <div class="imguser" id="profile">
                    <img src="img/bg2.png" alt="Фото пользователя">
                    </div>
                    <button class="workspace_button_user" id="">
                   Загрузить
                     </button>
                    </div>
                    <div class="infouser" id="profile">
                        <p class="name_user">Имя</p>
                        <input class="input_name_user" type="text" placeholder="   <?php echo $_SESSION['user']['name']?>">

                        <p class="name_user">Email</p>
                        <input class="input_name_user" type="text" placeholder="   <?php echo $_SESSION['user']['email']?>">
                 

                        <p class="name_user">Номер</p>
                        <input class="input_name_user" type="text" placeholder="   <?php echo $_SESSION['user']['phone']?>">

                    </div>
                    <button class="workspace_button_info" id="">
                            Обновить
                        </button>
            </div>
        </div> 
    </div>

    <div id="security" class="hidden2">
    <div class="rightmenuuser"  id="security" >
            <div class="headuser"  id="security">
                <p  style="color:white; margin-left: 5%"> Пароли и безопасность</p>    
            </div>

            <div class="menuuser" id="security" >
                    <div class="infouser"  id="security">
                        <p class="name_user">Ваш старый пароль:</p>
                        <input class="input_name_user" type="text" placeholder="    <?php echo $_SESSION['user']['password']?>"> 
                        <p class="name_user">Введите новый пароль</p>
                        <input class="input_name_user" type="text" placeholder="     *********">
                        <p class="name_user">Повторите пароль</p>
                        <input class="input_name_user" type="text" placeholder="     *********">
                    </div>
                    <button class="workspace_button_info" id="">
                            Обновить
                        </button>
            </div>
    </div>
</div>


    <div id="account" class="hidden2">
    <div class="rightmenuuser"  id="account" >
            <div class="headuser"  id="account">
                <p  style="color:white; margin-left: 5%"> Управление аккаунтом:</p>    
            </div>

            <div class="menuuser" id="account" >
                    <div class="infouser" id="account">
                        <p class="name_user">Желаете удалить аккаунт?</p>
                 
                    </div>
                    <button class="workspace_button_info_red" id="">
                            Удалить аккаунт
                        </button>
            </div>
    </div>
    </div>
  </div>
  <script>
    const buttons = document.querySelectorAll("#buttons button");
    const contentDivs = document.querySelectorAll("#content div");

    buttons.forEach((button) => {
      button.addEventListener("click", (e) => {
        buttons.forEach((btn) => btn.classList.remove("username"));
        button.classList.add("username");

        const divId = button.id.replace("btn-", "");
        contentDivs.forEach((div) => {
          if (div.id !== divId) {
            div.classList.add("hidden2");    
          } else {
            div.classList.remove("hidden2");
          }
        });
      });
    });
  </script>

                </div>
        </article>
    </main>
    <script src="js/getPresentation.js"></script>
    <script src="js/getPresentationFunc.js"></script>
</body>
</html>
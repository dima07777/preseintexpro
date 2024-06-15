<?php
include "components/conn.php";
$current_page = "index.php"; // Укажите здесь текущую страницу
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no">
        <title>WebSocket</title>
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="app.css"> -->
    </head>
    <body>
    <header class="main_menu">
        <a href="">
            <div class="logo">
                <img src="img/logo.png" alt="">
                <h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
            </div>
        </a>
        <div class="main_menu_items">
            <!-- <a href="" class="main_menu_item">Предпросмотр</a>
            <a href="" class="main_menu_item">Показ</a> -->
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
        <!-- боковое пространство слева -->
        <aside>
            <div class="navmenu">
                <a href="index.php" class="namenavmenu <?php if ($current_page === 'index.php') echo 'active'; ?>">Мои презентации</a>
                <a href="user.php" class="namenavmenu <?php if ($current_page === 'user.php') echo 'active'; ?>">Моя страница</a>
            </div>
        </aside>

        <!-- основное поле -->
        <article>
            <?php
                if (isset($_SESSION['error']) and $_SESSION['error']!='') {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
            <!-- <div class="rect1">
                <img src="img/rect1.png" alt="">
            </div> -->
            <div class="rect2">
                <img src="img/rect22.png" alt="">
            </div>
            <div class="rect3">
                <img src="img/rect22.png" alt="">
            </div>
            

            <div class="templates">
                <!-- <div class="option_template">
                    <select name="template" id="templates_point">
                        <option value="val1">Начать с шаблона</option>
                        <option value="val2">Пункт 2</option>
                        <option value="val3">Пункт 3</option>
                    </select>
                </div> -->
                <!-- шаблоны -->
               <p style="margin-left: 4%; font-size: 0.9vw;"> <b>Начать с шаблона ▼</b></p> 
                <div class="templates_gallery">


                <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center;">Browse all</p>
                    </div>

                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; ">Browse all</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; ">Browse all</p>
                    </div>

                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg1.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; ">100 Bad Ideas</p>
                    </div>

                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center;">Fill in the Blank</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; ">Team Time</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center;">Brainstorming</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="img/bg2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center;">Sales Meeting</p>
                    </div>



                </div>
            </div>

            <!-- рабочее пространство -->
            <div class="workspace">
                <div class="workspace_name">
                    <h2>Мои презентации</h2>
                </div>
                <hr>
                
                <div class="wrapper">
                    <div class="workspace_buttons">
                    <button class="workspace_button" id="addPresentationButton">
                        <img class="button_icon" src="img/add.png" alt="">
                        Создание презентации
                        </button>


                        <!-- <button class="workspace_button" >
                            <img class="button_icon" src="../img/import.png" alt=""> Import
                        </button>
                        <button class="workspace_button">
                            <img class="button_icon" src="../img/export.png" alt=""> Export
                        </button> -->


                    </div>
                    <!-- <button id="change-color-btn">цвет</button> -->
                    <div class="sort shadow_select">
                        <p style="font-size: 1vw">Сортировать:</p>
                        <select name="sort" id="presentations_point">
                            <option value="value1">Последнее обновление</option>
                            <option value="value2">Имени</option>
                        </select>
                    </div>
                </div>

                    <div class="sortname">
                        <p style="font-size: 0.8vw"><b style="font-size: 0.8vw">Создатель</b><p>
                        <p style="font-size: 0.8vw" > <b style="font-size: 0.8vw">Последнее обновление ▼</b><p>
                    </div>

                <div class="presentations" id="presentationsList">
                    <div class="wrapper_a">
                        <div class="presentations_point">
                            <p><b>Name</b></p>
                        </div>
                        <div class="wrapper_presentation">
                            <p>Last Update</p>
                            <p>Created</p>
                        </div>
                    </div>
        
                    
                </div>
            </div>
        </article>
   

            <form id="form">
             
            </form>
        </main>
        
        <button id="change-color-btn">цвет</button>
      
            <script src="app.js"></script>
            <script src="js/getPresentation.js"></script>
            <script src="js/getPresentationFunc.js"></script>
    </body>
</html>
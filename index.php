<?php
include "components/conn.php";
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
    <!-- основная шапка -->
    <header class="main_menu">
        <a href="">
            <div class="logo">
                <img src="../img/logo.png" alt="">
                <h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
            </div>
        </a>
        <div class="main_menu_items">
            <a href="" class="main_menu_item">Предпросмотр</a>
            <a href="" class="main_menu_item">Показ</a>
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
            <div class="person">
                <!-- <img class="person_logo" src="https://media.licdn.com/dms/image/D4E0BAQG-i2j7Q2WFIA/company-logo_200_200/0/1694593112031/img_logo?e=2147483647&v=beta&t=o1304VK0Zbh3CBA-8_LNYNZZCNrQjMIBS-nwKrAMzbY" alt="">
                <img class="person_logo" src="https://media.licdn.com/dms/image/D4E0BAQG-i2j7Q2WFIA/company-logo_200_200/0/1694593112031/img_logo?e=2147483647&v=beta&t=o1304VK0Zbh3CBA-8_LNYNZZCNrQjMIBS-nwKrAMzbY" alt="">
                <button class="add_person">
                    <img src="https://w7.pngwing.com/pngs/932/861/png-transparent-addition-plus-and-minus-signs-plus-miscellaneous-sign-electric-blue-thumbnail.png" alt="">
                </button>
            </div> -->

            <div class="function">
                <div class="workspace_choose">
                    <h4>Workspace</h4>
                    <h5>Personal</h5>
                </div>
                <div class="funci" id="presentationsList1">
                <div class="func">
                    <img class="function_logo" src="https://media.licdn.com/dms/image/D4E0BAQG-i2j7Q2WFIA/company-logo_200_200/0/1694593112031/img_logo?e=2147483647&v=beta&t=o1304VK0Zbh3CBA-8_LNYNZZCNrQjMIBS-nwKrAMzbY" alt="">
                    <p class="function_name">моя презентация</p>
                </div>
                <div class="func">
                    <img class="function_logo" src="https://media.licdn.com/dms/image/D4E0BAQG-i2j7Q2WFIA/company-logo_200_200/0/1694593112031/img_logo?e=2147483647&v=beta&t=o1304VK0Zbh3CBA-8_LNYNZZCNrQjMIBS-nwKrAMzbY" alt="">
                    <p class="function_name">my presentation</p>
                </div>
                </div>
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
            <div class="rect1">
                <img src="img/rect1.png" alt="">
            </div>
            <div class="rect2">
                <img src="img/rect2.png" alt="">
            </div>
            <div class="rect3">
                <img src="img/rect2.png" alt="">
            </div>
            

            <div class="templates">
                <div class="option_template">
                    <select name="template" id="templates_point">
                        <option value="val1">Начать с шаблона</option>
                        <option value="val2">Пункт 2</option>
                        <option value="val3">Пункт 3</option>
                    </select>
                </div>
                <!-- шаблоны -->
                <div class="templates_gallery">


                <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">Browse all</p>
                    </div>

                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg1.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">100 Bad Ideas</p>
                    </div>

                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">Fill in the Blank</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">Team Time</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg3.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">Brainstorming</p>
                    </div>


                    <div class="blank">
                    <div class="template_item">
                        <div class="template_img">
                            <a href="#">
                                <img src="../img/bg2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <p style="color: black; text-align: center; font-size: 1vw">Sales Meeting</p>
                    </div>



                </div>
            </div>

            <!-- рабочее пространство -->
            <div class="workspace">
                <div class="workspace_name">
                    <h2>WORKSPACE / PERSONAL</h2>
                </div>
                <hr>
                
                <div class="wrapper">
                    <div class="workspace_buttons">
                    <button class="workspace_button" id="addPresentationButton">
                        <img class="button_icon" src="../img/add.png" alt="">
                        Создать
                        </button>
                        <button class="workspace_button" >
                          <!-- <a href="pages/present_show.php"> -->
                            <img class="button_icon" src="../img/import.png" alt=""> Import
                        </button>
                        <button class="workspace_button">
                            <img class="button_icon" src="../img/export.png" alt=""> Export
                        </button>
                    </div>
                    <div class="sort shadow_select">
                        <p>Sort by </p>
                        <select name="sort" id="presentations_point">
                            <option value="value1">Recently uploaded</option>
                            <option value="value2">Recently</option>
                        </select>
                    </div>
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
    </main>
    <script src="js/getPresentation.js"></script>
    <script src="js/getPresentationFunc.js"></script>
</body>
</html>
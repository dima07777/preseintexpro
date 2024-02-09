<?php
include "../components/header.php";
if (isset($_SESSION['error']) and $_SESSION['error']!='') {
    echo "<div class='error'><p>{$_SESSION['error']}</p></div>";
    unset($_SESSION['error']);
}
$url ="";
?>

<main>
    <div class="shadow"></div>
    <div class="rect11">
        <img src="../img/rect1.png" alt="">
    </div>
    <div class="rect12">
        <img src="../img/rect2.png" alt="">
    </div>
    <div class="rect13">
        <img src="../img/rect2.png" alt="">
    </div>
    <div class="rect14">
        <img src="../img/rect3.png" alt="">
    </div>
    
    <div class="authorization_form">
        <h1>Авторизация</h1>
        <form action="../components/auth.php" method="post" class="form_auth">
            <div class="input_str">
                <img class="input_img" src="../img/mail_input.png" alt="">
                <input class="input_text input_auth" type="email" name="email" placeholder="email">
            </div>
            <div class="input_str">
                <img class="input_img" src="../img/pass_input.png" alt="">
                <input class="input_text input_auth" type="text" name="password" placeholder="Пароль">
            </div>
            <input class="form_button input_auth" type="submit" value="Войти">
        </form>
    </div>
</main>

<?php
    include "../components/footer.php";
    if (isset($_SESSION['user']) and $_SESSION['user']!='') {
        $url = "Location: ../index.php";
    } else if (isset($_SESSION['url']) and $_SESSION['url']!='') {
        unset($_SESSION['url']);
        $url = "Location: ../index.php";
    } else ($url = "registration.php");
    header("$url");
?>
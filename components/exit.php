<?php
    include "conn.php";
    unset($_SESSION['user']);
    header("Location: ../index.php");
?>
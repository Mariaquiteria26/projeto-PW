<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /PROJETO-PW/login/login.php');
    exit();
}
?>
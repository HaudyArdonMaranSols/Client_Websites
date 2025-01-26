<?php
    session_start();
    if($_SESSION['username'] == false) {
        header('location:login.php');
    }
?>
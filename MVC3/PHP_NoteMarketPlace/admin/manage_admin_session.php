<?php

    session_start();

    if(!isset($_SESSION['user_logged_in'])) { 
        header("location:admin_login.php");
        exit();
    } else if ($_SESSION['user_roleID'] == $memberUserRoleID) {
        header("location:../user/noAccessForAdmin.php");
        exit();
    }
?>
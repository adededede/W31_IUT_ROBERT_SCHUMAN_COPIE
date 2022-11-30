<?php
    session_start();
    session_destroy(); // ou unset($_SESSION['user']);
    header('Location: signin.php');

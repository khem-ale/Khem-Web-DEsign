<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); //logout gare paxi login page ma redirect gareko
exit();
?>
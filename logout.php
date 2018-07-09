<?php
require_once 'header.php';
session_start();
unset($_SESSION["email"]);
unset($_SESSION["uname"]);
unset($_SESSION["roll"]);
session_destroy();
redirect("login.php");
?>

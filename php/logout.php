<?php
session_start();
$_SESSION["user"] = NULL;
header("location: ../login_register.html");
?>
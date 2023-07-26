<?php 
include "config.php";
session_start();
session_destroy();
header("Location:../business_signup_login/");
?>
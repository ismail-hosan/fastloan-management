<?php 
include_once "admin/libs/Session.php";
Session::init();

Session::destroy();
header("Location: login.php");

 ?>
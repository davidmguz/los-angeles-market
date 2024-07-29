<?php
include_once "sesion.php";
session_destroy();
session_regenerate_id();
session_unset();
header("location:login.php");
?>
<?php
session_start();
unset($_SESSION["lunchbasket"]);
header("location: index.php")
?>
<?php
$servername="localhost";
$username="root";
$password="root";
$conn = new PDO("mysql:host=$servername",$username,$password);
$conn = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE DATABASE IF NOT EXISTS Lunches";
$conn->exec($sql);
$sql = "USE Lunches";
$conn->exec($sql);
echo("DB created successfuly<br>");
?>
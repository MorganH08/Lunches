<?php
$servername="localhost";
$username="root";
$password="root";
$dbname="Lunchesold";
try{
$conn = new PDO("mysql:host=$servername;$dbname=",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo("Connected successfully<br>");
}
catch(PDOException $e){
    echo("Connection failed: " . $e->getMessage());
}

?>
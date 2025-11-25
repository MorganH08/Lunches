<?php
    session_start();
    #print_r($_SESSION);
    if (isset($_SESSION["loggedinuser"])){
        echo("Hello ".$_SESSION["firstname"]);
    }else{
        echo("not logged in");
    }
?>
<!DOCTYPE HTML>
<html>
<head>          
    <title>Packed lunch ordering system</title>
</head>

<body>
    <h1>Main page</h1>
    <a href="users.php">Add user</a><br>
    <a href="addfood.php">Add food</a><br>
    <a href="food.php">Choose food</a><br>
    <a href="login.php">Login</a><br>
    <a href="logout.php">Logout</a><br>
</body>
</html>
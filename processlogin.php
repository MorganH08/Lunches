<?php
//header("location: food.php");
print_r($_POST);
array_map("htmlspecialchars",$_POST); //sanitises inputs so no html can be injected
include_once("connection.php");//import equivalent!

try
{
    $stmt=$conn->prepare("SELECT * from tblusers WHERE Username=:Username");
    $stmt->bindParam(":Username", $_POST["username"]);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0)
    {
        echo("Invalid username.");
    }
}

catch(PDOException $e)
{
    echo("error: " . $e->getMessage());
}



?>
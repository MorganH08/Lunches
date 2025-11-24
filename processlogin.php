<?php
session_start();
header("location: index.php");
print_r($_POST);
array_map("htmlspecialchars", $_POST);//sanitises inputs so no html can be injected
include_once("connection.php");//import equivalent!

try{
    $stmt=$conn->prepare("SELECT * from tblusers WHERE Username=:Username;");
    $stmt->bindParam(":Username", $_POST["username"]);
    $stmt->execute(); 

    if ($stmt->rowCount() == 0) {
        echo("Invalid username ."); 
    }else{
        #check password ok..
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            print_r($row);
            $hashed=$row["Password"];
            $attempt=$_POST["password"];

            if (password_verify($attempt,$hashed)){
                echo("password ok");
                $_SESSION["firstname"]=$row["Forename"]; // $_SESSION variables retain your data until the browser is closed/session ended
                $_SESSION["loggedinuser"]=$row["Username"];
                $_SESSION["admin"]=$row["Role"];
                $_SESSION["role"]=$row["Role"];
                
                if ($row["Role"]=="pupil"){
                    echo("Only admins can log into food.php");
                }
                else{
                    echo("Logged into food.php");
                    header("location: food.php"); //redirects to food.php
                }
            }else{
                echo("incorrect password");
            }
        }
    }
}
catch(PDOException $e)
{
    echo("error: " . $e->getMessage());
}



?>
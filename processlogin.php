<?php
session_start();
//header("location: food.php");
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
            if ($_POST["password"]==$row["Password"]){
                echo("password ok");
                $_SESSION["firstname"]=$row["Forename"];
                $_SESSION["loggedinuser"]=$row["Username"];
                $_SESSION["role"]=$row["Role"];
                
                if ($row["Role"]=="pupil"){
                    echo("Only admins can log into food.php")
                }
                else{
                    echo("Logged into food.php");
                    header("location: food.php"); //redirects to food.php
                    exit(); //stops script execution/unintended behavior
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
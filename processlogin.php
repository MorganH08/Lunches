<?php
session_start();//to allow session variables
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
                $_SESSION["firstname"]=$row["Forename"];//session variable - lasts until browser closed
                $_SESSION["loggedinuser"]=$row["UserID"];
                $_SESSION["admin"]=$row["Role"];

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
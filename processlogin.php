
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
                $_SESSION["firstname"]=$row["Uorename"];
                $_SESSION["loggedinuser"]=$row["Username"]
                
            }else{
                echo("incorrect password");
            }
            //echo($row["Name"]." ".$row["Description"]." ".$row["Price"]);
            echo("<br>");
        }
    }
}
catch(PDOException $e)
{
    echo("error: " . $e->getMessage());
}



?>

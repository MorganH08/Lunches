<?php
    session_start();
    #print_r($_SESSION);
    #NOTE RESTRICT ACCESS IF NOT LOGGED IN LATER
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

<?php
    session_start();
    include_once("connection.php");
    foreach ($_SESSION["lunchbasket"] as $item){
        echo($item["foodid"]);
       
        $fid=$item["foodid"];
        $stmt=$conn->prepare("SELECT * FROM tblfood WHERE FoodID=:fid");
        $stmt->bindParam(":fid",$fid);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            print_r($row);
            echo("<br>");
        }
        
    }
?>

<a href="checkout.php">Proceed to checkout</a>
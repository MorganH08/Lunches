<?php
    session_start();
    #print_r($_SESSION);
    #NOTE RESTRICT ACCESS IF NOT LOGGED IN LATER
    if (isset($_SESSION["loggedinuser"])){
        echo("Hello ".$_SESSION["firstname"]);
    }else{
        echo("not logged in");
    }


    session_start();
    include_once("connection.php");
    
    foreach ($_SESSION["lunchbasket"] as $item){
        #adds each item in the lunchbasket to the tblbasket table
        echo($item["foodid"]);
       
        $fid=$item["foodid"];
        $stmt=$conn->prepare("INSERT INTO tblbasket
        (OrderID,Quantity,FoodID)
        VALUES
        (:orderid,:qty,:foodid)
        ");
        $stmt->bindParam(":orderid", $lastorderid);
        $stmt->bindParam(":qty",$item["qty"]);
        $stmt->bindParam(":foodid", $item["foodid"]);
        #creates another order
        $stmt->execute();

        
    }

$stmt=$conn->prepare("UPDATE tblusers Balance=Balance-:totalcost WHERE UserID=:userid")

    $stmt->bindParam(":totalcostorderid", $_SESSION["totalcost"]);
    $stmt->bindParam(":userid",$_SESSION["loggedinuser"]);
    #creates another order
    $stmt->execute();
?>



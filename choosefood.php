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

<body>
    <h1>Orders page</h1>
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
    Select category 
    show foods in that category 
     <?php
        include_once("connection.php");
        $stmt=$conn->prepare("SELECT * FROM tblfood ORDER BY Category, Name");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo ('<form action="addtobasket.php" method="POST">');
            echo($row["Name"]." ".$row["Description"]." ".$row["Price"]);
            echo('<input type="hidden" name="foodid" value='.$row["FoodID"].'>');
            echo('Quantity:<input type="number" name="qty" min="1" max="5" value="1">');
            echo('<input type="submit" value="Add Food">');
            echo("<br></form>");
        }
    ?>
<a href="index.php">back to main page</a><br>
</body>
</html>
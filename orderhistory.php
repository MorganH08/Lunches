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
    <title>Packed lunch order history</title>
</head>

<body>
    <h1>Order history page</h1>
    <a href="index.php">Main page</a>
    <?php
        $stmt=$conn->prepare("SELECT * FROM tblorder WHERE userID=:userid ORDER BY Orderdate DESC");
        $stmt->bindParam(":userid",$_SESSION["loggedinuser"]);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            print_r($row["Orderdate"]);
            echo("<br>");
        }
    ?>
</body>
</html>
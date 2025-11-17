<!DOCTYPE HTML>
<html>
<head>          
    <title>PHP Info</title>
</head>

<body>
    <form action="addpupil.php" method="POST">
        Surname:<input type="text" name="surname"><br>
        Forename:<input type="text" name="forename"><br>
        Password:<input type="password" name="password"><br>
        Year:<input type="number" name="year"><br>
        Initial Balance :<input type="text" name="balance"><br>
        Role:<br>
        <input type="radio" name="role" value="pupil" checked> Pupil<br>
        <input type="radio" name="role" value="admin" > Adminstrator<br>
        <input type="submit" value="Add User">
    </form>
    <?php
        include_once("connection.php");
        $stmt=$conn->prepare("SELECT * FROM tblusers");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo($row["Forename"]." ".$row["Surname"]);
            echo("<br>");
        }
    ?>

</body>
</html>
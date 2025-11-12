<?php
print_r($_POST);
include_once("connection.php"); //import connection.php
$stmt = $conn->prepare("INSERT INTO tblusers (
UserID,
Username,
Surname,
Forename,
Password,
Year,
Balance
,Role)

VALUES
(NULL,
:Username,
:Surname,
:Forename,
:Password,
:Year,
:Balance,
:Role)
");
try{
$stmt->bindParam(":Surname",$_POST["surname"]);
$stmt->bindParam(":Forename",$_POST["forename"]);
$stmt->bindParam(":Password",$_POST["password"]);
$stmt->bindParam(":Year",$_POST["year"]);
$stmt->bindParam(":Balance",$_POST["balance"]);
$stmt->bindParam(":Role",$role);
$stmt->bindParam(":Username","bob");
$stmt->execute();
}
catch(PDOException $e){
    echo("Connection failed: " . $e->getMessage());
}
?>
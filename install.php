<?php
$servername="localhost";
$username="root";
$password="root";
$conn= new PDO("mysql:host=$servername",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="CREATE DATABASE IF NOT EXISTS Lunches";
$conn->exec($sql);
$sql="USE Lunches";
$conn->exec($sql);
echo("DB created successfully<br>");

// create users table
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblusers;
CREATE TABLE tblusers
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(20) NOT NULL,
Surname  VARCHAR(20) NOT NULL,
Forename  VARCHAR(20) NOT NULL,
Password  VARCHAR(200) NOT NULL,
Year INT(2) NOT NULL,
Balance DECIMAL (15,2) NOT NULL,
Role TINYINT(1)
);
");
$stmt->execute();
echo("tblusers created<br>");
//add in test bed of users

$hashedpassword=password_hash("password",PASSWORD_DEFAULT);
echo("$hashedpassword<br>");

$stmt=$conn->prepare("INSERT INTO tblusers 
(UserID,Username,Surname,Forename,Password,Year,Balance,Role)
VALUES
(NULL,'cunniffe.r','Cunniffe','Robert',:Password,13,10.00,1),
(NULL,'smith.b','Smith','Bob',:Password,12,100,0)
");

$stmt->bindParam(":Password", $hashedpassword);

$stmt->execute();

//tblfood
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblfood;
CREATE TABLE tblfood
(FoodID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL,
Description  VARCHAR(200) NOT NULL,
Category  VARCHAR(20) NOT NULL,
Price DECIMAL (15,2) NOT NULL
);
");

$stmt=$conn->prepare("INSERT INTO tblfood 
(Name,Description,Category,Price)
VALUES
('Coca cola','classic fizzy drink','Beverage',1.50),
('Pineapple','sweet tropical fruit','Fruit',4.00)
");
$stmt->execute();
echo("tblfood created<br>");

//tblorder
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblorder;
CREATE TABLE tblorder
(OrderID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Status VARCHAR(20) NOT NULL,
UserID  INT(4) NOT NULL,
OrderDate DATETIME
);
");
$stmt->execute();
echo("tblorder created<br>");

//tblbasket
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblbasket;
CREATE TABLE tblbasket
(OrderID INT(4) NOT NULL,
Quantity INT(2) DEFAULT 1,
FoodID  INT(4) NOT NULL,
PRIMARY KEY (OrderID, FoodID)
);
");
$stmt->execute();
echo("tblbasket created<br>");
?>


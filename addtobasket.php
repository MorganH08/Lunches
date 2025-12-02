<?php
session_start();
if(!isset($_SESSION["lunchbasket"]))
{
    $_session["lunchbasket"]=array(); #creates basket if not already made
}
$found=FALSE;
foreach ($_SESSION["lunchbasket"] as &$item)
{
    if ($item["lunchbox"]==$_POST["foodid"])
    $found=TRUE;
    $item[0]=$item[0]+$_POST["qty"];
}
array($_session["lunchbasket"],array("foodid"=> $_POST["foodid"],"qty"=> $_POST["qty"]));
print_r($_POST);
print_r($_session["lunchbasket"]);
?>
<a href="index.php">back to main page</a><br>
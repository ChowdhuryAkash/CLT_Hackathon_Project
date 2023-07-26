<?php 
session_start();
$id=$_SESSION['id'];
include "config.php";

$name=$_POST['name'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$account=$_POST['account'];
$ifsc=$_POST['ifsc'];

$sql="UPDATE users SET `name`='{$name}',`phone`='{$phone}',`password`='{$password}',`bank_acc`='{$account}',`ifsc`='{$ifsc}' WHERE id='{$id}'";
$result=mysqli_query($conn,$sql);
if($result){
    echo "updated";
}


?>
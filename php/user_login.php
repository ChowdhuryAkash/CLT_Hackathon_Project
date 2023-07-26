<?php 
include "config.php";
$phone=$_POST['phone'];
$password=$_POST['password'];

$sql="SELECT * FROM `users` WHERE `phone`='{$phone}' AND `password`='{$password}'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){
    echo "wrong_phone_password";
}
else{

    $sql1="SELECT * FROM `users` WHERE `phone`='{$phone}' AND `password`='{$password}' AND `rto`=''";
    $result1=mysqli_query($conn,$sql1);
    while($row=mysqli_fetch_assoc($result1)){
        $id=$row['id'];
        $name=$row['name'];
        session_start();
        $_SESSION['id']=$id;
        $_SESSION['name']=$name;
        echo "logged_in";
    }
    

}


?>
<?php 
include "config.php";
$rto=$_POST['rto'];
$password=$_POST['password'];

$sql="SELECT * FROM `users` WHERE `rto`='{$rto}' AND `password`='{$password}'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){
    echo "wrong_rto_password";
}
else{

    $sql1="SELECT * FROM `users` WHERE `rto`='{$rto}' AND `password`='{$password}'";
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
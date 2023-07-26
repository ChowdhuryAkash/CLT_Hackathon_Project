<?php 
include "config.php";
$name=$_POST['name'];
$phone=$_POST['phone'];
$password=$_POST['password'];
// $name="Akash";
// $phone="9547655052";
// $password="123456";



$sql="SELECT * FROM `users` WHERE `phone`='{$phone}'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    echo "phone_already_exist";
}
else{
    $sql1="INSERT INTO `users`(`name`,`acc_type`,`phone`,`password`,`status`,`acc_create_date`,`last_update_date`) VALUES('{$name}','1','{$phone}','{$password}','1','{$today}','{$today}')";
    $result1=mysqli_query($conn,$sql1);
    if($result1){
        
        $sql2="SELECT * FROM users WHERE `phone`='{$phone}'";
        $result2=mysqli_query($conn,$sql2);
        if($result2){
            while($row=mysqli_fetch_assoc($result2)){
                $id=$row['id'];
                $sql3="INSERT INTO balance(user_id,amount) VALUES ('{$id}','0')";
                $result3=mysqli_query($conn,$sql3);
                if($result3){
                    echo "success";
                }
                else{
                    echo 0;
                }
            }
        }
    }
}
?>
<?php  
session_start();
$id=$_SESSION['id'];

$amount=$_POST['amount'];
include "config.php";

$sql="SELECT * FROM `balance` WHERE `user_id`='{$id}'";
$result=mysqli_query($conn,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        $present_amount=$row['amount'];
        $final_amount=$present_amount+$amount;
            $sql1="UPDATE `balance` SET `amount`='{$final_amount}' WHERE `user_id`='{$id}'";
            $result1=mysqli_query($conn,$sql1);
            if($result1){

                $sql2="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$id}','{$amount}','1','1','{$today}','{$now}')";
                $result2=mysqli_query($conn,$sql2);
                if($result2){
                    $msg="Money added successfully to your wallet from UPI";

                    $sql3="INSERT INTO `notification`(`user_id`,`notification`,`status`) VALUES('{$id}','{$msg}','0')";
                    $result3=mysqli_query($conn,$sql3);
                    if($result3){
                        echo "fund_added";

                    }

                }



          

            }

    }
}







?>
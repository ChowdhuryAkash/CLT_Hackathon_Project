<?php 
session_start();
$id=$_SESSION['id'];
include "config.php";
$current_amount=0;
$amount=$_POST['amount'];

$sql="SELECT * FROM balance WHERE user_id='{$id}'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $current_amount=$row['amount'];

}
if($current_amount<$amount){
    echo "not_enough_money";
}
else{
    $next_amount=$current_amount-$amount;
    $sql1="UPDATE balance SET amount='{$next_amount}' WHERE user_id='{$id}'";
    $result1=mysqli_query($conn,$sql1);
    if($result1){
        $sql6="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$id}','{$amount}','0','5','{$today}','{$now}')";
                $result6=mysqli_query($conn,$sql6);
                if($result6){
                    echo "deducted";

                }
    }






}



?>
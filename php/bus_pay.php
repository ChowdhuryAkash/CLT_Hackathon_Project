<?php 
session_start();
$id=$_SESSION['id'];
include "config.php";


$amount=$_POST['amount'];
$rto=$_POST['rto'];
$rto_id=0;




$sql200="SELECT * FROM `users` WHERE rto='{$rto}'";
$result200=mysqli_query($conn,$sql200);
if(mysqli_num_rows($result200)>0){




$sql="SELECT * FROM `balance` WHERE user_id='{$id}'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $present_amount=$row['amount'];
    if($present_amount>=$amount){
        $next_amount=$present_amount-$amount;
        $sql1="UPDATE `balance` SET amount='{$next_amount}' WHERE user_id='{$id}'";
        $result1=mysqli_query($conn,$sql1);
        if($result1){

            $sql2="SELECT * FROM `users` WHERE rto='{$rto}'";
            $result2=mysqli_query($conn,$sql2);
            while($row2=mysqli_fetch_assoc($result2)){
                $rto_id=$row2['id'];


                   $sql3="SELECT * FROM `balance` WHERE user_id='{$rto_id}'";
                   $result3=mysqli_query($conn,$sql3);
                   while($row3=mysqli_fetch_assoc($result3)){
                    $present_business_balance=$row3['amount'];
                    $next_business_balance=$present_business_balance+$amount;
                    $sql4="UPDATE `balance` SET amount='{$next_business_balance}' WHERE user_id='{$rto_id}'";
                    $result4=mysqli_query($conn,$sql4);
                    if($result4){

                        // ===========================================

                        $sql5="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$id}','{$amount}','0','4','{$today}','{$now}')";
                        $result5=mysqli_query($conn,$sql5);
                        if($result5){
                            $sql50="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$rto_id}','{$amount}','1','4','{$today}','{$now}')";
                            $result50=mysqli_query($conn,$sql50);
                            if($result50){
                            $msg=$amount." sent to ".$rto;
        
                            $sql6="INSERT INTO `notification`(`user_id`,`notification`,`status`) VALUES('{$id}','{$msg}','0')";
                            $result6=mysqli_query($conn,$sql6);
                            if($result6){
                                
                                

                                // =======================================
                                $sql50="INSERT INTO `tickets`(`user_id`,`rto`,`amount`,`date`,`time`) VALUES('{$id}','{$rto}','{$amount}','{$today}','{$now}')";
                                $result50=mysqli_query($conn,$sql50);
                                if($result50){
                                    echo "done";
                                }

                                // ====================================
        
                            }
                        }
        
                        }









// ====================================================
                    }

                   }
                

            }


        }

    }
    else{
        echo "not_enough_money";
    }



    



}
}
else{
    echo "no_bus";
}









?>
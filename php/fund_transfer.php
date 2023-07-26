<?php 
session_start();
$id=$_SESSION['id'];
include "config.php";


$phone=$_POST['phone'];
$amount=$_POST['amount'];
$my_current_balance=0;
$his_current_balance=0;

$sql="SELECT * FROM balance WHERE user_id='{$id}'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $my_current_balance=$row['amount'];
}

$sql="SELECT * FROM users WHERE phone='{$phone}'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){




if($my_current_balance<$amount){
    echo "insufficient_money";
}
else{
    $my_next_balance=$my_current_balance-$amount;
    $sql2="UPDATE balance SET amount='{$my_next_balance}' WHERE user_id='{$id}'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
        // ==================================
        $sql3="SELECT * FROM users WHERE phone='{$phone}'";
        $result3=mysqli_query($conn,$sql3);
        while($row3=mysqli_fetch_assoc($result3)){
            $receiver_id=$row3['id'];
        }

        $sql4="SELECT * FROM balance WHERE user_id='{$receiver_id}'";
        $result4=mysqli_query($conn,$sql4);
        while($row4=mysqli_fetch_assoc($result4)){
            $his_current_balance=$row4['amount'];
            $his_next_balance=$his_current_balance+$amount;
        }
        $sql5="UPDATE balance SET amount='{$his_next_balance}' WHERE user_id='{$receiver_id}'";
        $result5=mysqli_query($conn,$sql5);
        if($result5){

            // ==========================
            $sql6="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$id}','{$amount}','0','3','{$today}','{$now}')";
                $result6=mysqli_query($conn,$sql6);
                if($result6){
                    $msg="Money Transferred successfully to ".$phone;

                    $sql3="INSERT INTO `notification`(`user_id`,`notification`,`status`) VALUES('{$id}','{$msg}','0')";
                    $result3=mysqli_query($conn,$sql3);
                    if($result3){

                        // ============================

                        $sql6="INSERT INTO `transactions`(`user_id`,`amount`,`come/go`,`type`,`date`,`time`) VALUES('{$receiver_id}','{$amount}','1','2','{$today}','{$now}')";
                        $result6=mysqli_query($conn,$sql6);
                        if($result6){
                            $msg="Money Received from other";

                            $sql3="INSERT INTO `notification`(`user_id`,`notification`,`status`) VALUES('{$receiver_id}','{$msg}','0')";
                            $result3=mysqli_query($conn,$sql3);
                            if($result3){

                                echo "transfer_success";
                                

                            }

                        }



                        // ===============================
                        

                    }

                }

            // =======================
            

        }





        // ========================================




    }




}




}
else{
    echo "receiver_wrong";
}
?>
<?php 
session_start();
if(!($_SESSION['id'])){
    header("Location:../business_signup_login/");
}
$id=$_SESSION['id'];
include "../php/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="business.css">
    <script src="https://kit.fontawesome.com/27a23aa3d4.js" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="business.js"></script>
</head>
<body>
    <h1 class="cut">X</h1>
    <div class="main">
        <div class="welcome ylw">Welcome Bhaskar!</div>
        <p class="balance">Wallet Balance</p>
        <?php $sql="SELECT * FROM balance WHERE user_id='{$id}'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $current_amount=$row['amount'];

}
?>
        <div class="balance_show ylw">₹ <?php echo $current_amount; ?></div>

        <p class="withdraw">- - -  withdraw - - -</p>
        <div class="withdraw_box">
        <?php 
        $sql10="SELECT * FROM users WHERE id='{$id}'";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
            <div class="block">
                <label for="">Account</label>
                <input type="text" class="ylw withdraw_account" value="<?php echo $row10['bank_acc']; ?>">

            </div>
            <div class="block">
                <label for="">IFSC</label>
                <input type="text" class="ylw withdraw_ifsc" value="<?php echo $row10['ifsc']; ?>">
                
            </div>
            <div class="block">
                <label for="">Amount</label>
                <input type="text" class="ylw withdraw_amount">
                
            </div>
            <?php } ?>
        </div>
        <div class="pay withdraw_btn">Pay</div>

        <div class="nav ylw">
            <ul>
                <li id="transaction_btn"><i class="fa-solid fa-ticket"></i></li>
                <?php 
                $today_collection=0;
                $sql="SELECT * FROM transactions WHERE `user_id`='{$id}' AND `date`='{$today}' AND `come/go`='1'";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $today_collection=$today_collection+$row['amount'];
                
                }
                ?>
                <li class=" "><p>Today's Collection : ₹ <?php echo $today_collection; ?></p></li>
                <li id="profile_btn"><i class="fa-solid fa-user"></i></li>
            </ul>
        </div>



    </div>




    <div class="trans">
        <p>- - - Your last transactions - - -</p>
        <div class="transactions">
            
            <?php 
        $sql10="SELECT * FROM transactions WHERE user_id='{$id}' ORDER BY `id` DESC";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
            <div class="tr">
                <h3 class="<?php if($row10['come/go']==1) echo "green"; else echo "red"; ?>"><?php echo $row10['amount']; ?></h3>
                <!-- <h5>9547655052</h5> -->
                <h5><?php echo $row10['date']; ?></h5>
                <h5><?php echo $row10['time']; ?></h5>
            </div>
            
<?php  } ?>
        
                
            </table>
        </div>




        


    </div>
    <?php 
        $sql10="SELECT * FROM users WHERE id='{$id}'";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
    <div class="profile">
        <div class="block">
            <label for="">RTO NO : </label>
            <input type="text" value="<?php echo $row10['rto'] ?>" readonly>
        </div>
        <div class="block">
            <label for="">Name : </label>
            <input type="text" value="<?php echo $row10['name'] ?>" class="business_name">
        </div>
        <div class="block">
            <label for="">Phone : </label>
            <input type="text" value="<?php echo $row10['phone'] ?>" class="business_phone">
        </div>
        <div class="block">
            <label for="">Pin : </label>
            <input type="text" value="<?php echo $row10['password'] ?>" class="business_password">
        </div>
        <div class="block">
            <label for="">Account : </label>
            <input type="text" value="<?php echo $row10['bank_acc'] ?>" class="business_bank">
        </div>
        <div class="block">
            <label for="">IFSC : </label>
            <input type="text" value="<?php echo $row10['ifsc'] ?>" class="business_ifsc">
        </div>
        <?php  } ?>
        <div class="update_btn ylw business_profile_update">update</div>
        <div class="block1">
            <a href="support.php" class="help">Get help</a>
            <a href="../php/business_logout.php" class="help">Log Out</a>
        </div>
    </div>
    
</body>
</html>
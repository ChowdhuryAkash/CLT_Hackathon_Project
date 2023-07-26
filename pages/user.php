<?php 
session_start();
$id=$_SESSION['id'];
if(!(isset($_SESSION['id']))){
    header("Location:../user_signup_login");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
    <script src="https://kit.fontawesome.com/27a23aa3d4.js" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="user.js"></script>
</head>
<body>
    <h1 class="cut">X</h1>
    <i class="fa-solid fa-comment" id="notification"></i>
    <span id="notification_number">3</span>
    <div class="main">
    <?php
        include "../php/config.php";
        $sql="SELECT * FROM users WHERE id='{$id}'";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $name=$row['name'];
        }
        
        ?>
        <div class="welcome ylw">
            <p><?php echo "Welcome ".$name; ?></p>

        </div>
        <?php
        $sql="SELECT * FROM balance WHERE user_id='{$id}'";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $balance=$row['amount'];
        }
        
        ?>


        <h4 class="balance">WALLET BALANCE : <span> ₹ <?php echo $balance; ?></span></h4>


        <div class="pay">
            <input type="text" class="pay_number bus_pay_rto" placeholder="Enter RTO Number">
            <input type="text" class="pay_amount bus_pay_amount" placeholder="amount">
            <button class="pay_btn ylw bus_pay_btn">Pay</button>
        </div>
        <p class="transfer_text">--- Fund transfer ---</p>

        <div class="pay">
            <input type="text" class="pay_number transfer_pay_number" placeholder="Enter Mobile Number">
            <input type="text" class="pay_amount transfer_pay_amount" placeholder="amount">
            <button class="pay_btn ylw transfer_pay_btn">Pay</button>
        </div>
    </div>
    <div class="nav ylw">
        <ul>
            <li id="ticket_btn"><i class="fa-solid fa-ticket"></i></li>
            <li class="plus ylw">+</li>
            <li id="profile_btn"><i class="fa-solid fa-user"></i></li>
        </ul>
    </div>


<!-- ===================Tickets================ -->
    <div class="tickets">
        <?php 
        $sql10="SELECT * FROM tickets WHERE user_id='{$id}'";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
            <div class="ticket ylw">
            <h5><?php echo $row10['rto'] ?></h5>
            <h3>₹<?php echo $row10['amount'] ?></h3>
            <br>
            <span class="time_1"><?php echo $row10['date'] ?></span>
            <span class="time_2"><?php echo $row10['time'] ?></span>

        </div>
            
        <?php
        }
        
        ?>

        

        

    </div>

    <!-- ===================/Tickets================ -->
<!-- ===================Add fund================ -->
    <div class="add_fund">
        <input type="text" class="fund_amount" placeholder="Enter amount">
        <select name="cars" id="cars" class="add_fund_mehod">
            <option value="volvo">Paytm</option>
            <option value="mercedes">Google Pay</option>
            <option value="saab">Phonepe</option>
          </select>
          <input type="text" class="fund_amount upi" placeholder="Enter UPI Number">
          <div class="fund_pay ylw">PAY</div>
        

    </div>

    <!-- ===================/Add fund================ -->
    <!-- ===================Profile================== -->
    <div class="profile">
    <?php 
        $sql10="SELECT * FROM users WHERE id='{$id}'";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
        <div class="block">
            <label for="">Name : </label>
            <input type="text" value="<?php echo $row10['name'] ?>" class="profile_name" readonly>
        </div>
        <div class="block">
            <label for="">Phone : </label>
            <input type="text" value="<?php echo $row10['phone'] ?>" class="profile_phone" readonly>
        </div>
        <div class="block">
            <label for="">Pin : </label>
            <input type="text" value="<?php echo $row10['password'] ?>" class="profile_password">
        </div>
        <div class="update_btn ylw profile_update_btn">update</div>
        <div class="block1">
            <a href="support.php" class="help">Get help</a>
            <a href="../php/logout.php" class="help">Log Out</a>
        </div>

        <?php } ?>
        <p>- - - Your last transactions - - -</p>
        <div class="transactions">

        <?php 
        $sql10="SELECT * FROM transactions WHERE user_id='{$id}' ORDER BY `date` DESC";
        $result10=mysqli_query($conn,$sql10);
        while($row10=mysqli_fetch_assoc($result10)){
        ?>
            <div class="tr">
                    <h3 class="<?php if($row10['come/go']=="1") echo "green"; else echo "red";?>"><?php echo $row10['amount']; ?></h3>
                    <h5><?php switch($row10['type']){
                        case 1:
                            echo "add money";
                            break;
                        case 2:
                            echo "Got from others";
                            break; 
                        case 3:
                            echo "Send to other";
                            break;
                        case 4:
                            echo "Pay at transport";
                            break;   
                    } ?></h5>
                    <h5><?php echo $row10['date']; ?></h5>
                    <h5><?php echo $row10['time']; ?></h5>
            </div>

            <?php } ?>

           
            

        
                
            
        </div>


    </div>


    <!-- ===================/Profile================== -->
</body>
</html>
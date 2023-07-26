$(document).ready(function(){
    $("#ticket_btn").click(function(){
      $(".tickets").css("display","block");
      $(".cut").css("display","block");
    });

   


      $(".plus").click(function(){
        $(".add_fund").css("display","block");
        $(".cut").css("display","block");
      });

      $("#profile_btn").click(function(){
        $(".profile").css("display","block");
        $(".cut").css("display","block");
      });







      $(".cut").click(function(){
        $(".tickets").css("display","none");
        $(".add_fund").css("display","none");
        $(".profile").css("display","none");
        $(".cut").css("display","none");
      });







// ===============================Fund add==========

 $(".fund_pay").click(function(){
    console.log("hii");

    var amount=$(".fund_amount").val();
    var upi=$(".upi").val();
    if(amount=="" || upi==""){
        alert("Please enter all the fields");
    }
else{
    $.ajax({
      url:"../php/add_fund.php",
      type:"post",
      data:{amount:amount},
      success:function(data){
          console.log(data);
          if(data.includes("fund_added")){
            alert("Money added successfully");
            location.reload();
          }
          

      }
  });

}



  });

  // ===========================/Fund add===========

  // ============================Bus pay================
$(".bus_pay_btn").click(function(){
  var rto=$(".bus_pay_rto").val();
  var amount=parseInt($(".bus_pay_amount").val());
  console.log(rto + amount);

  if(amount=="" || rto==""){
    alert("Please enter all the fields");
}
else{
  $.ajax({
    url:"../php/bus_pay.php",
    type:"post",
    data:{amount:amount,rto:rto},
    success:function(data){
        console.log(data);
        if(data.includes("no_bus")){
          alert("No vehicle registered with this RTO number");
          location.reload();
        }
        else if(data.includes("not_enough_money")){
          alert("You haven't enough balance in your wallet to proceed this transaction. Please add money and try further.");
          location.reload();
        }
        else if(data.includes("done")){
          alert("Money sent successfully");
          location.reload();
        }
        
        
        
        

    }
  });

}


})


  // ===========================/Bus pay=================

  // =================================Profile update======================
  $(".profile_update_btn").click(function(){
    var name=$(".profile_name").val();
    var password=$(".profile_password").val();
    console.log(name + password);
    $.ajax({
      url:"../php/user_profile_update.php",
      type:"post",
      data:{name:name,password:password},
      success:function(data){
        console.log(data);
        if(data.includes("done")){
          alert("Profile updated successfully");
          location.reload();
        }

      }

   })
});
// ================================/Profile update=============================
$(".transfer_pay_btn").click(function(){

  var phone=$(".transfer_pay_number").val();
  var amount=$(".transfer_pay_amount").val();
if(phone==""){
  alert("Please enter receiver phone number.")
  $(".transfer_pay_number").focus();
}
else if(amount==""){
  alert("Please enter amount.");
  $(".transfer_pay_amount").focus();

}
else{
  $.ajax({
    url:"../php/fund_transfer.php",
    type:"post",
    data:{phone:phone,amount:amount},
    success:function(data){
      console.log(data);
      if(data.includes("transfer_success")){
        alert("Money transferred successfully");
        location.reload();
        
      }
      else if(data.includes("insufficient_money")){
        alert("Insufficient money to send this amount.");
        location.reload();
      }
      else if(data.includes("receiver_wrong")){
        alert("No user found with this mobile number.");
        location.reload();
      }

    }

 })
}

})


  


































  });

 
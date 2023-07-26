$(document).ready(function(){
    $("#transaction_btn").click(function(){
      $(".trans").css("display","block");
      $(".profile").css("display","none");
      $(".cut").css("display","block");
    });
    $("#profile_btn").click(function(){
      $(".trans").css("display","none");
      $(".profile").css("display","block");
      $(".cut").css("display","block");
    });

   


      






      $(".cut").click(function(){
        $(".trans").css("display","none");
        $(".cut").css("display","none");
        $(".profile").css("display","none");
      });



// ========================profile update=====================
$(".business_profile_update").click(function(a){
  a.preventDefault();
  console.log("hii")

  var name=$(".business_name").val();
  var phone=$(".business_phone").val();
  var password=$(".business_password").val();
  var account=$(".business_bank").val();
  var ifsc=$(".business_ifsc").val();


  $.ajax({
    url:"../php/business_profile_update.php",
    type:"post",
    data:{name:name,phone:phone,password:password,account:account,ifsc:ifsc},
    success:function(data){
      console.log(data);
      if(data.includes("updated")){
        alert("Profile updated successfully.");
        location.reload();
      }
      

    }

 })
})

// =========================Withdraw=======================
$(".withdraw_btn").click(function(a){
  a.preventDefault();
  console.log("hiii");

  var amount=$(".withdraw_amount").val();
  if(amount==""){
    alert("please enter amount");
    $(".withdraw_amount").focus();
  }
  else{

  $.ajax({
    url:"../php/withdraw.php",
    type:"post",
    data:{amount:amount},
    success:function(data){
      console.log(data);
      if(data.includes("deducted")){
        alert("Money withdrawn successfully.");
        location.reload();
      }
      

    }

 })
}

})




  });
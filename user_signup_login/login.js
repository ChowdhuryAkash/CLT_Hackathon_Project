$(document).ready(function(){


    $("#login_btn").click(function(a){
        a.preventDefault();

        var phone=$(".login_phone").val();
        var password=$(".login_password").val();


        $.ajax({
            url:"../php/user_login.php",
            type:"post",
            data:{phone:phone,password:password},
            success:function(data){
                console.log(data);
                if(data.includes("wrong_phone_password")){
                    alert("Phone number or Email Id mismatched. Please enter right credentials.");
                    location.reload();
                }
                else if(data.includes("logged_in")){
                    location.href="../pages/user.php";
                }

                

                

            }
        });






    });
})
$(document).ready(function(){


    $("#signup_btn").click(function(a){
        a.preventDefault();

        var name=$(".signup_name").val().trim();
        var phone=$(".signup_phone").val().trim();
        var password=$(".signup_password").val().trim();

        if(name=="" || phone=="" || password==""){
            alert("Please Enter all credentials");

        }

else{
        $.ajax({
            url:"../php/user_signup.php",
            type:"post",
            data:{name:name,phone:phone,password:password},
            success:function(data){
                if(data=="success"){
                    var a=alert("Account created successfully...!");
                    location.reload();
                }
                else if(data=="phone_already_exist"){
                    a=alert("Phone number already registered, Give a new number.");
                    location.reload();
                }
                else{
                   a= alert("Something went wrong, Please try again.");
                   location.reload();
                }

                

                

            }
        });

    }






    });
})
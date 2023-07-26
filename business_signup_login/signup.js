$(document).ready(function(){


    $("#signup_btn").click(function(a){
        a.preventDefault();
        console.log("hii")

        var rto=$(".signup_rto").val().trim();
        var name=$(".signup_name").val().trim();
        var phone=$(".signup_phone").val().trim();
        var password=$(".signup_password").val().trim();

      

        if(rto=="" || name=="" || phone=="" || password==""){
            alert("Please Enter all credentials");

        }
        else{


        $.ajax({
            url:"../php/business_signup.php",
            type:"post",
            data:{rto:rto,name:name,phone:phone,password:password},
            success:function(data){
                console.log(data);
                if(data=="success"){
                    var a=alert("Account created successfully...!");
                    location.reload();
                }
                else if(data=="rto_already_exist"){
                    a=alert("This car is already registered, Give a new number.");
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
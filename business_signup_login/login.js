$(document).ready(function(){


    $("#login_btn").click(function(a){
        a.preventDefault();

        var rto=$(".login_rto").val();
        var password=$(".login_password").val();


        $.ajax({
            url:"../php/business_login.php",
            type:"post",
            data:{rto:rto,password:password},
            success:function(data){
                if(data.includes("wrong_rto_password")){
                    alert("RTO number or Email Id mismatched. Please enter right credentials.");
                    location.reload();
                }
                else if(data.includes("logged_in")){
                    location.href="../pages/business.php";
                }

                

                

            }
        });






    });
})
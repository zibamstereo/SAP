$(document).ready(function(){


$('.change').click(function(){
   $('form').animate({height: "toggle", opacity:"toggle"}, "slow");
});

});


  function dashboard()
  {
    window.location= "http://localhost/project/dashboard/" ;

  }


  function create_account()
  {
  	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  	var fn_fullname = $("#full_name").val();
  	var fn_address = $("#address").val();
  	var fn_phone = $("#phone").val();
  	var fn_email = $("#email").val();
  	var fn_password = $("#password").val();
  	var fn_cpassword = $("#cpassword").val();

  	if(fn_fullname == "")
  	{
  		$("#full_name").focus();
  	}
  	else if(fn_address == "")
  	{
  		$("#address").focus();
  	}
  	else if(fn_phone == "")
  	{
  		$("#phone").focus();
  	}
  	else if(fn_email == "")
  	{
  		$("#email").focus();
  	}
  	else if(reg.test(fn_email) == false)
  	{
  			$("#email").focus();
  	}
  	else if(fn_password == "")
  	{
  		$("#password").focus();
  	}

  	else if(fn_cpassword == "")
  	{
  			$("#cpassword").focus();
  	}

  	else if(fn_password != fn_cpassword)
  	{

  		$("#cpassword").focus();

  }
else{
  dashboard();
}
};


      function login_user()
      {
      	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

      	var fn_email = $("#email_login").val();
      	var fn_password = $("#password_login").val();


        if(fn_email == "")
      	{
      		$("#email_login").focus();
      	}
      	else if(reg.test(fn_email) == false)
      	{
      			$("#email_login").focus();
      	}
      	else if(fn_password == "")
      	{
      		$("#password_login").focus();
      	}

      	else
      	{

          dashboard();       
      	}

      		};

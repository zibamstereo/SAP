// Call app_path from config.js
var process_path = app_path + 'dashboard/users/process/';

	//login page redirection function after a successful registration
function login_page()
{window.location = app_path + 'login';}

function login()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: process_path + "login",
		data: $('#loginForm').serialize(),
		dataType: "json",
		success: function(msg){

			if(!(msg.status))
			{
				hideshow('msg',1);
				$('#msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
				var input = msg.txt2;
        $("#"+input).focus();
			}
			else location.replace(msg.txt);

			hideshow('loading',0);
		}
	});

}

function register()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: process_path + "register",
		data: $('#regForm').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//hide the form
				//$('#umscript').fadeOut('slow');

				//show the success message

					//hide registration form
				$('#regForm').fadeOut('100');

					//add success message
				$('#msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt);

					//redirect to login page after 8 seconds
        setTimeout(function(){ login_page(); }, 8000);

			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('msg',1);
				$('#msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
				var input = msg.txt2;
        $("#"+input).focus();
			}

			hideshow('loading',0);
		}
	});

}

function pass_recovery()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: process_path + "pass_recovery",
		data: $('#pass_recovery').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//hide the form
				//$('#umscript').fadeOut('slow');

				//show the success message
				$('#msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('msg',1);
				$('#msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('loading',0);
		}
	});

}


function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

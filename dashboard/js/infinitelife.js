// Call app_path from config.js
var admin_process_path = app_path + 'dashboard/admin/process/';
var user_process_path = app_path + 'dashboard/users/process/';


// ======================================= User Jquery Proceccing Sections=============================================
	//login page redirection function after a successful registration

function login_page()
{window.location = app_path + 'login';}


function login()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: user_process_path + "login",
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
		url: user_process_path + "register",
		data: $('#regForm').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{

				//hide registration form
				$('#regForm').fadeOut('100');

					//show the success message
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
		url: user_process_path + "pass_recovery",
		data: $('#pass_recovery').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{

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


function updatepass()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: 	user_process_path + "change_pass",
		data: $('#updatePass').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
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


function editprofile()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: 	user_process_path + "edit_profile",
		data: $('#editProfile').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
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


/**
 *  @Description:  Function that allows Users and Moderator delete their Profile Picture
*/
function del_photo(event,id) {
	event.preventDefault(); // Prevent from redirection very important
		$.ajax({
			type:"POST",
			url: 	user_process_path + "process_photo.php",
			data:{id:id,action:"delete"},
			dataType: "html",
			cache: false,
			async: true
		})
		.done(function(data, textStatus, xhr){
		console.log('data='+data); //to detect if there an error in the console
			if($.trim(data)=='success')
			{
				$('#del_photo').addClass('done').html("Photo Successfully Deleted.").fadeIn('slow').delay(2000).fadeOut();
				$('#real_photo').fadeOut(500).remove();
				$('#changed_photo').css('display', 'compact').fadeIn('slow');
			}
			else if($.trim(data) == 'fail')
			{
				$('#del_photo').addClass('error').html("An error occurred while trying to delete the photo.").fadeIn('slow').delay(2000).fadeOut();
			}
			else
			{
				$('#del_photo').addClass('error').html(data);
			}
		})
		.fail(function(xhr, textStatus, errorThrown){
			$('#del_photo').addClass('error').html("opps: " + textStatus + " : " + errorThrown).fadeIn('slow').delay(2000).fadeOut();
		});
}

// ======================================= User Jquery Proceccing Sections=============================================


// ======================================= Admin Jquery Proceccing Sections=============================================

function adminLogin()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: admin_process_path + "admin_login.php",
		data: $('#adminLogin').serialize(),
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



// ======================================= Admin Jquery Proceccing Sections=============================================


function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

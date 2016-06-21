// Call app_path from config.js
var admin_process_path = app_path + 'dashboard/admin/process/';
var user_process_path = app_path + 'dashboard/users/process/';


// ======================================= User Jquery Proceccing Sections=============================================
	//login page redirection function after a successful registration
/**
 * Jquery function for redirecting to login_page after registration
 */
function login_page()
{window.location = app_path + 'login';}

function effect_update()
{window.location = app_path + 'd';}

/**
 *  Jqeury function for login_page
 */
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

/**
 *  Jqeury function for register
 */
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

/**
 *  Jqeury function for password recovery
 */
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

/**
 *  Jqeury function for editing user profile by users
 */
function editUserForm()
{
	hideshow('acc_loading',1);

	$.ajax({
		type: "POST",
		url: 	user_process_path + "edit_profile",
		data: $('#editUserForm').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#acc_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
					//Refresh Page to show users updated profile content
				 window.setTimeout(function(){location.reload()},3000)

			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('acc_msg',1);
				$('#acc_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('acc_loading',0);
		}
	});

}

/**
 *  Jqeury function for modifying images from the user panel
 */
$(document).ready(function (e) {
	$("#user_image").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
      url: user_process_path + "process_photo",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	cache: false,
			processData:false,
			success: function(msg){

				if(parseInt(msg.status)==1)
				{
					//show the success message
					$('#pic_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
				}
				else if(parseInt(msg.status)==0)
				{
					hideshow('pic_msg',1);
					$('#pic_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
				}

				hideshow('pic_loading',0);
			}
	   });
	}));
});




/**
 *  Jqeury function for changing password from the user panel
 */
function changeUserPass()
{
	hideshow('pwd_loading',1);

	$.ajax({
		type: "POST",
		url: 	user_process_path + "change_pass",
		data: $('#changeUserPass').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#pwd_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('pwd_msg',1);
				$('#pwd_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('pwd_loading',0);
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

/**
 *  Jqeury function for editing user profile by Admin profile
 */
function editAdminForm()
{
	hideshow('acc_loading',1);

	$.ajax({
		type: "POST",
		url: 	admin_process_path + "admin_edit_profile",
		data: $('#editAdminForm').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#acc_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
					//Refresh form to show users their updated profile
				 window.setTimeout(function(){location.reload()},3000)
			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('acc_msg',1);
				$('#acc_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('acc_loading',0);
		}
	});

}

/**
 *  Jqeury function for modifying images from the user panel
 */
$(document).ready(function (e) {
	$("#admin_image").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
      url: admin_process_path + "admin_process_photo",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	cache: false,
			processData:false,
			success: function(msg){

				if(parseInt(msg.status)==1)
				{
					//show the success message
					$('#pic_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
				}
				else if(parseInt(msg.status)==0)
				{
					hideshow('pic_msg',1);
					$('#pic_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
				}

				hideshow('pic_loading',0);
			}
	   });
	}));
});




/**
 *  Jqeury function for changing password from the user panel
 */
function changeAdminPass()
{
	hideshow('pwd_loading',1);

	$.ajax({
		type: "POST",
		url: 	admin_process_path + "admin_change_pass",
		data: $('#changeAdminPass').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#pwd_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('pwd_msg',1);
				$('#pwd_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('pwd_loading',0);
		}
	});

}



/**
 *  Jqeury function for changing password from the user panel
 */
function config()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: 	admin_process_path + "configuration",
		data: $('#config').serialize(),
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

/* Function used in Admin configuration page to toggle between view and edit access control level */
function view_acl()
{
$(".update_acl").fadeOut(1000);
$(".update_acl").removeClass('show');
$(".update_acl").addClass('hide');
$(".view_acl").fadeIn(1100);
$(".view_acl").removeClass('hide');
$(".view_acl").addClass('show');
}

function edit_acl()
{
$(".view_acl").fadeOut(1000);
$(".view_acl").removeClass('show');
$(".view_acl").addClass('hide');
$(".update_acl").fadeIn(1100);
$(".update_acl").removeClass('hide');
$(".update_acl").addClass('show');
}

/* Function used in Admin configuration page to toggle between view and edit access control level */

// ======================================= Admin Jquery Proceccing Sections=============================================


function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

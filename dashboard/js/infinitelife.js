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

/*function effect_update()
{window.location = app_path + 'd';}*/

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
                                        //Refresh Page to show users updated profile content
                                        window.setTimeout(function(){location.reload()},3000)
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
                                //Refresh Page to show users updated profile content
				 window.setTimeout(function(){location.reload()},3000)
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
 *  Jqeury function for editing Admin profile by Admin
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
 *  Jqeury function for modifying Admin profile picture from the admin panel
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
                                        //Refresh Page to show users updated profile content
                                        window.setTimeout(function(){location.reload()},3000)
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
 *  Jqeury function for changing Admin password from the Admin panel
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
                                //Refresh Page to show users updated profile content
				 window.setTimeout(function(){location.reload()},3000)
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
 *  Jqeury function for editing user profile by Admin profile
 */
function adminEditUserProfile()
{
	hideshow('acc_loading',1);

	$.ajax({
		type: "POST",
		url: 	admin_process_path + "admin_edit_user_profile",
		data: $('#adminEditUserProfile').serialize(),
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
 *  Jqeury function for changing User password from the Admin panel
 */
function adminChangeUserPass()
{
	hideshow('pwd_loading',1);

	$.ajax({
		type: "POST",
		url:  admin_process_path + "admin_change_user_pass",
		data: $('#adminChangeUserPass').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#pwd_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
                                //Refresh Page to show users updated profile content
				 window.setTimeout(function(){location.reload()},3000)
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
 *  @Description:  Function Admin actions over the users
*/

	function admin_actions(event,id,action) {
	event.preventDefault(); // Prevent from redirection very important
			$.ajax({
			type:"POST",
			url: admin_process_path + "admin_actions",
			data:{id:id,action:action},
			dataType: "html",
			cache: false,
			async: true,
			beforeSend: function () {
				//$('#loading_'+id).show();
			}
		})
		.done(function(data, textStatus, xhr){
		console.log('data='+data); //to detect if there an error in the console
                    if($.trim(action)=='suspend'){
			if($.trim(data)=='success')
			{
                            $('#msg').removeClass('error').addClass('done').html("User Suspended Successfully.").hide().fadeIn(3000).fadeOut(3000);
                            $('#real_status_'+id).fadeOut(500).remove();
                            $('#changed_status_'+id).css('display', 'compact').fadeIn('slow').html("<em><span style='color:#DB7093;'>Suspended</span></em>");
                            $('#real_action_'+id).fadeOut(500).remove();
                            $('#changed_action_'+id).css('display', 'compact').fadeIn('slow').html("<a title='Unsuspend User' href='' onClick=\"admin_actions(event,"+id+",'unsuspend');\"><i class='fa fa-dot-circle-o'></i></a>");
			}
			else if($.trim(data) == 'unknown error')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured while attempting to suspend user. Please try again.").hide().fadeIn(3000).fadeOut(3000);
			}
			else if($.trim(data) == 'no user')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured selecting user to suspend.").hide().fadeIn(3000).fadeOut(3000);
			}
			else
			{
				$('#msg').removeClass('done').addClass('error').html(data);
			}
                    }

                    if($.trim(action)=='unsuspend'){
                        if($.trim(data)=='success')
			{
                            $('#msg').removeClass('error').addClass('done').html("User Unsuspended Successfully.").hide().fadeIn(3000).fadeOut(3000);
                            $('#real_status_'+id).fadeOut(500).remove();
                            $('#changed_status_'+id).css('display', 'compact').fadeIn('slow').html("<em><span style='color:#008040;'>Active</span></em>");
                            $('#real_action_'+id).fadeOut(500).remove();
                            $('#changed_action_'+id).css('display', 'compact').fadeIn('slow').html("<a title='Suspend User' href='' onClick=\"admin_actions(event,"+id+",'suspend');\"><i class='fa fa-ban'></i></a>");
			}
			else if($.trim(data) == 'unknown error')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured while attempting to unsuspend user. Please try again.").hide().fadeIn(3000).fadeOut(3000);
			}
			else if($.trim(data) == 'no user')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured selecting user to unsuspend.").hide().fadeIn(3000).fadeOut(3000);
			}
			else
			{
				$('#msg').removeClass('done').addClass('error').html(data);
			}
                    }
                    
                    if($.trim(action)=='confirm_user'){
			if($.trim(data)=='success')
			{
                            $('#msg').removeClass('error').addClass('done').html("User Confirmed Successfully.").hide().fadeIn(3000).fadeOut(3000);
                            $('#real_status_'+id).fadeOut(500).remove();
                            $('#changed_status_'+id).css('display', 'compact').fadeIn('slow').html("<em><span style='color:#008040;'>Active</span></em>");
                            $('#real_action_'+id).fadeOut(500).remove();
                            $('#changed_action_'+id).css('display', 'compact').fadeIn('slow').html("<a title='Suspend User' href='' onClick=\"admin_actions(event,"+id+",'suspend');\"><i class='fa fa-ban'></i></a>");
			}
			else if($.trim(data) == 'unknown error')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured while attempting to confirm user. Please try again.").hide().fadeIn(3000).fadeOut(3000);
			}
			else if($.trim(data) == 'user exist')
			{
				$('#msg').removeClass('done').addClass('error').html("User already activated.").hide().fadeIn(3000).fadeOut(3000);
			}
			else if($.trim(data) == 'no user')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured selecting user to confirm.").hide().fadeIn(3000).fadeOut(3000);
			}
			else
			{
				$('#msg').removeClass('done').addClass('error').html(data);
			}
                    }

                    if($.trim(action)=='delete'){
                        if($.trim(data)=='success')
			{
				$('.user_'+id).fadeOut(500).remove();
				$('#msg').removeClass('error').addClass('done').html("User Deleted Successfully.").hide().fadeIn(3000).fadeOut(3000);
                        }
			else if($.trim(data) == 'unknown error')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured while attempting to delete user. Please try again.").hide().fadeIn(3000).fadeOut(3000);
			}
			else if($.trim(data) == 'no user')
			{
				$('#msg').removeClass('done').addClass('error').html("An error occured selecting user to delete.").hide().fadeIn(3000).fadeOut(3000);
			}
			else
			{
				$('#msg').removeClass('done').addClass('error').html(data);
			}
                    }
		})
		.fail(function(xhr, textStatus, errorThrown){
			$('#msg').removeClass('done').addClass('error').html("opps: " + textStatus + " : " + errorThrown).hide().fadeIn(3000).fadeOut(3000);
		})
		.complete(function(){
			//$('#loading_'+id).hide();
		});
}
/**
 *  @Description:  Function Admin actions over the users
*/

/**
 *  Jqeury function for processing contact information
 */
function contactUs()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url:  admin_process_path + "contact_us",
		data: $('#contactUs').serialize(),
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
 *  Jqeury function for processing contact information
 */
function config()
{
	hideshow('loading',1);

	$.ajax({
		type: "POST",
		url:   admin_process_path + "configuration",
		data:  $('#config').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#config_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				hideshow('config_msg',1);
				$('#config_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			hideshow('loading',0);
		}
	});

}




/**
 *  Jqeury function for processing Access Control Level
 */
function processAcl()
{
	//hideshow('loading',1);

	$.ajax({
		type: "POST",
		url: 	admin_process_path + "process_acl",
		data: $('#processAcl').serialize(),
		dataType: "json",
		success: function(msg){

			if(parseInt(msg.status)==1)
			{
				//show the success message
				$('#acl_msg').removeClass('error').addClass('done').fadeIn('slow').html(msg.txt).delay(3000).fadeOut('slow');
                                //Refresh Page to show users updated profile content
				 window.setTimeout(function(){location.reload()},3000)
                        }
			else if(parseInt(msg.status)==0)
			{
				hideshow('acl_msg',1);
				$('#acl_msg').removeClass('done').addClass('error').fadeIn('slow').html(msg.txt);
			}

			//hideshow('loading',0);
		}
	});

}

/* Function used in Admin configuration page to toggle between view and edit access control level */
function view_acl()
{
$(".edit_acl").fadeOut(1000);
$(".edit_acl").removeClass('show');
$(".edit_acl").addClass('hide');
$(".view_acl").fadeIn(1100);
$(".view_acl").removeClass('hide');
$(".view_acl").addClass('show');
}

function edit_acl()
{
$(".view_acl").fadeOut(1000);
$(".view_acl").removeClass('show');
$(".view_acl").addClass('hide');
$(".edit_acl").fadeIn(1100);
$(".edit_acl").removeClass('hide');
$(".edit_acl").addClass('show');
}

/* Function used in Admin configuration page to toggle between view and edit access control level */

// ======================================= Admin Jquery Proceccing Sections=============================================


function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

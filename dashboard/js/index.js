/* Function used in profile to toggle between view and edit profile */
function activate_view()
{
$(".update_details").fadeOut(1000);
$(".update_details").removeClass('show');
$(".update_details").addClass('hide');
$(".view_details").fadeIn(1100);
$(".view_details").removeClass('hide');
$(".view_details").addClass('show');
}

function activate_edit()
{
$(".view_details").fadeOut(1000);
$(".view_details").removeClass('show');
$(".view_details").addClass('hide');
$(".update_details").fadeIn(1100);
$(".update_details").removeClass('hide');
$(".update_details").addClass('show');
}

/* Function used in profile to toggle between view and edit profile */
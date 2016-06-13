<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."header.php");
//require_once '../inc/header.php

?>


<body>


		<div class="container">
			<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>
			<div id="theSidebar" class="sidebar">

	<section  class="one-head ">

	<span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $utils->addImg('ajebo.png', 111, 50, 'Ajebo Market'); ?></span>
	<span style="width:auto;float:left;margin:0.7em 0 0 0.5em;"> <i class="fa fa-th"></i> SALES AGENT PLATFORM </span>



	</section>

				<button class="close-button"><i class="fa fa-close"></i></button>


	<div class"related">

		<div class="profile-pic ">

		</div>


		 </div>

<?php
// require vertical menu
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."vmenu.php");

?>

</div>


<div id="theGrid" class="main">

<section class="top">
<header class="top-bar">

<div id="user_welcome" class="animated slideDown">

<div class="icon">
<i class="fa fa-user"></i> <h2 class="top-bar__headline"> My Account </h2>

</div>
</div>


</header>
</section>

<section class="grid">


<div class="show view_details">


<div class="grid__info animated fadeInDown" id="view">

	<h2 class="title title--preview"><i class="fa fa-cogs"></i> View Profile</h2>

  <div class="form">
    <div id='msg'></div>
  <!-- This is registration form -->
    <form id="regForm" class="address-form" action="<?php echo USER_URL; ?>process/register" method="POST">
    <input type="text" id="full_name" name="full_name" placeholder="Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <textarea name="address" id="address" placeholder="Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <input type="text" id="phone" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
    <input type="text" id="dob" name="dob" placeholder="Date of Birth"/><span class="form-icon"> <i class="fa fa-calendar"> </i></span>
    <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span> <select name="gender">
    <option value="">Gender</option>
  <option value="male"> Male</option>
  <option value="female">Female</option>
  </select>


  <!-- Later things
   <input type="text" id="city" name="city" placeholder="City"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="state" name="state" placeholder="State"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="country" name="country" placeholder="Country"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
-->
    <!--<div class="button" name="register" onClick="create_account();"> Register</div>-->
          </form>
      <!-- This is registration form -->
    </div>
<a href="javascript:void(0);" onclick="activate_edit();" class="button"> <i class="fa fa-cogs"></i> Edit Profile </a>
</div>


<div class="grid__info animated fadeInDown">

     <h2 class="title title--preview"><i class="fa fa-cogs"></i> View Profile Pic</h2>

     <div class="form">
     <div id='msg'></div>



     </div>

  <br clear=all>
</div>


</div>


<!-- Hidden Update Form -->

<div class="hide update_details">

<div class="grid__info animated fadeInDown">

	<h2 class="title title--preview"><i class="fa fa-cogs"></i> Update Profile</h2>

  <div class="form">
    <div id='msg'></div>
  <!-- This is registration form -->
    <form id="regForm" class="address-form" action="<?php echo USER_URL; ?>process/register" method="POST">
    <input type="text" id="full_name" name="full_name" placeholder="Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <textarea name="address" id="address" placeholder="Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <input type="text" id="phone" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
    <input type="text" id="dob" name="dob" placeholder="Date of Birth"/><span class="form-icon"> <i class="fa fa-calendar"> </i></span>
    <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span> <select name="gender">
    <option value="">Gender</option>
  <option value="male"> Male</option>
  <option value="female">Female</option>
  </select>


  <!-- Later things
   <input type="text" id="city" name="city" placeholder="City"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="state" name="state" placeholder="State"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="country" name="country" placeholder="Country"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
-->

    <input class="button" type='submit' name="update-profile" value="Update Profile"> <?php echo $utils->addImg('loading.gif','','','loading..','','loading') ?>

      <!--<div class="button" name="register" onClick="create_account();"> Register</div>-->

      <br clear="all">
      <a href="javascript:void(0);" onclick="activate_view();" class="toggle"> <i class="fa fa-eye"></i> view Profile</a>

          </form>


    </div>

</div>


<div class="grid__info animated fadeInDown">

     <h2 class="title title--preview"><i class="fa fa-cogs"></i> Upload Profile Pic</h2>

     <div class="form">
     <div id='msg'></div>
   <!-- This is login form -->
       <form id="user_image" class="address-form" action="<?php echo USER_URL; ?>process/pass_recovery" method="POST">

   <input type="file" name="pic" accept="image/*">
       </br>
       <!--<button class="button" name="Login" onClick="login_user();"> LOGIN</button>-->
       <input class="button" type='submit' name="update-image" value="Upload Image"> <?php echo $utils->addImg('loading.gif','','','loading..','','loading') ?>

       </form>

       <!-- This is login form -->
     </div>

    <br clear=all>

    <h2 class="title title--preview"><i class="fa fa-cogs"></i> Update Password</h2>

    <div class="form">
    <div id='msg'></div>
  <!-- This is login form -->
      <form id="pass_recovery" class="address-form" action="<?php echo USER_URL; ?>process/pass_recovery" method="POST">

    <input type="password" id="old_password" name="old_password" placeholder="Current Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
    <input type="password" id="new_password" name="new_password" placeholder="New Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

      </br>
      <!--<button class="button" name="Login" onClick="login_user();"> LOGIN</button>-->
      <input class="button" type='submit' name="update-password" value="Update Password"> <?php echo $utils->addImg('loading.gif','','','loading..','','loading') ?>

    </form>

      <!-- This is login form -->
</div>
</div>

</div>

<?php

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."footer.php");

?>

<script type="text/javascript">//<![CDATA[
      Calendar.setup({
		 //The id of the target input form
        inputField : "f_date1",
		//The id of the target trigger either a button or am image, it must not be the same as the input id
        trigger    : "f_btn1",
		//This is used to auto hide the calendar when the date is picked
        onSelect   : function() { this.hide() },
		//This tell whether to show time on the calender or not, values= true/false default   is "false" and if true the time format is 12/24 default is 24
        showTime   : 12,
		//This tells the format of date to input into the form, check demo/multiplefields.html for examples
        dateFormat : "%A, %B %e, %Y",
		//This shows the first day of the week where 0=Sunday and 1=Monay and 6=Saturday i.e 0-6 default=1
		fdow : 0

      });
    //]]></script>

<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_header.php");
 $row = !empty($_POST) ? $_POST : $getuser[0];
 /**
  * Add Jscal for purpose of date of birth input
  */
  echo $adm->addFile("Js",LIB_URL."jscal/js/jscal2.js");
  echo $adm->addFile("Js",LIB_URL."jscal/js/lang/en.js");
  echo $adm->addFile("Css",LIB_URL."jscal/css/jscal2.css");
  echo $adm->addFile("C",LIB_URL."jscal/css/border-radius.css");
?>
<script type='text/javascript'>
    $(document).ready(function(){

      $('#editAdminForm').submit(function(e) {
        editAdminForm();
        e.preventDefault();
      });
    });

</script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#changeAdminPass').submit(function(e) {
			changeAdminPass();
			e.preventDefault();
		});
	});

</script>
<body>


		<div class="container">
			<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>
			<div id="theSidebar" class="sidebar">

	<section  class="one-head ">

	<span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><?php echo $adm->addImg('ajebo.png', 111, 50, 'Ajebo Market'); ?></span>
	<span style="width:auto;float:left;margin:0.7em 0 0 0.5em;"> <i class="fa fa-th"></i> SALES AGENT PLATFORM </span>



	</section>

				<button class="close-button"><i class="fa fa-close"></i></button>


<?php
// require vertical menu
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_vmenu.php");

?>

</div>


<div id="theGrid" class="main">

<section class="top">
<header class="top-bar">

<div id="user_welcome" class="animated slideDown">

<div class="icon">
<i class="fa fa-user"></i> <h2 class="top-bar__headline"> | Admin Account </h2>

</div>
</div>


</header>
</section>

<section class="grid">


<div class="show view_details">


<div class="grid__info animated fadeInDown" id="view">

  <span class="category">  <i class="fa fa-eye"></i> View Profile </span>

  <div class="form">
    <input type="text" disabled value="<?php echo !empty($row['full_name']) && !empty($row['title']) ? $row['title']." ".$row['full_name'] : 'NIL'; ?>"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <textarea disabled><?php echo !empty($row['address']) ? $row['address'] : 'NIL'; ?></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <input disabled type="text" value="<?php echo !empty($row['phone']) ? $row['phone'] : 'NIL'; ?>" /><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
    <input type="text" disabled value="<?php echo !empty($row['dob']) ? $row['dob'] : 'NIL'; ?>"/><span class="form-icon"> <i class="fa fa-calendar"> </i></span>
    <input type="text" disabled value="<?php echo !empty($row['gender']) ? $row['gender'] : 'NIL'; ?>"/><span class="form-icon"> <i class="fa fa-get-pocket"> </i></span>

    <a href="javascript:void(0);" onclick="activate_edit();" class="toggle"> <i class="fa fa-cogs"></i> Edit Profile </a>

    </div>
</div>


<div class="grid__info animated fadeInDown">

<span class="category">  <i class="fa fa-eye"></i> View Profile Pic </span>

     <div class="form">

<?php echo $img->displayProfilePicture($_SESSION['user_id'],130,130);?>

     </div>

  <br clear=all>
</div>


</div>


<!-- Hidden Update Form -->

<div class="hide update_details">

<div class="grid__info animated fadeInDown">

<span class="category">  <i class="fa fa-user"></i> Update Profile </span>

  <div class="form">
    <div id='acc_msg'></div>
  <!-- form for editing admin profile-->
    <form id="editAdminForm" class="address-form" action="<?php echo ADMIN_URL; ?>process/edit_profile" method="POST">
      <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span>
      <select name="title">
      <option value="<?php echo @$row['title']; ?>"><?php echo @$row['title']; ?></option>
    <option value="Mr"> Mr</option>
    <option value="Mrs">Mrs</option>
    <option value="Miss">Miss</option>
    </select>
    <input type="text" id="full_name" name="full_name" placeholder="Full Name" value="<?php echo @$row['full_name']; ?>" /><span class="form-icon"> <i class="fa fa-user"> </i></span>
    <textarea name="address" id="address" placeholder="Address"><?php echo @$row['address']; ?></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
    <input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo @$row['phone']; ?>" /><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
    <input type="text" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo @$row['dob']; ?>" /><span class="form-icon"> <i class="fa fa-calendar"> </i></span>
    <script type="text/javascript">
                      Calendar.setup({
                        inputField : "dob",
                        trigger    : "dob",
                        onSelect   : function() { this.hide() },
                        dateFormat : "%A, %B %e, %Y",
                        fdow : 0

                      });
              </script>
    <span class="form-icon"> <i class="fa fa-get-pocket"> </i></span>
    <select name="gender">
    <option value="<?php echo @$row['gender']; ?>"><?php echo @$row['gender']; ?></option>
  <option value="male"> Male</option>
  <option value="female">Female</option>
  </select>
  <!-- Later things
   <input type="text" id="city" name="city" placeholder="City"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="state" name="state" placeholder="State"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
    <input type="text" id="country" name="country" placeholder="Country"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
-->

    <input class="button" type='submit' name="update-profile" value="Update Profile"> <?php echo $adm->addImg('loading.gif','','','loading..','','loading') ?>

      <!--<div class="button" name="register" onClick="create_account();"> Register</div>-->

      <br clear="all">
      <a href="javascript:void(0);" onclick="activate_view();" class="toggle"> <i class="fa fa-eye"></i> view Profile</a>
          </form>


    </div>

</div>


<div class="grid__info animated fadeInDown">
  <?php if (empty($row['thumb_path'])):?>
<span class="category">  <i class="fa fa-image"></i> Upload Profile Pic </span>
  <?php else:?>
  <span class="category"> <i class="fa fa-image"></i> Update Profile Pic </span>
  <?php endif;?>
     <div class="form">
     <div id='pic_msg'></div>
  <!-- This is for for uploading image -->
       <form id="admin_image" class="address-form" enctype="multipart/form-data" action="<?php echo ADMIN_URL; ?>process/process_photo" method="POST">

          <input type="hidden" name="id" value="<?php echo $row['id'];?>" />
         <input type="file" name="picture" accept="image/*" id="file" size="30"/>
       </br>
       <?php if (empty($row['thumb_path'])):?>
         <input type="hidden" name="uploadphoto" value="1" />
       <input class="button" type="submit" name="upload-image" value="Upload Image">
       <?php echo $adm->addImg('loading.gif','','','loading..','','pic_loading') ?>
     <?php else:?>
       <input type="hidden" name="updatephoto" value="1" />
       <input class="button" type="submit" name="update-image" value="Update Image">
       <?php echo $adm->addImg('loading.gif','','','loading..','','pic_loading') ?>
     <?php endif;?>

       </form>

       <!-- This is for for uploading image -->
     </div>

    <br clear=all>

    <span class="category">  <i class="fa fa-cogs"></i> Update Password </span>

    <div class="form">
    <div id='pwd_msg'></div>
  <!-- This is change password form -->
      <form id="changeAdminPass" class="address-form" action="<?php echo ADMIN_URL; ?>process/change_pass" method="POST">

    <input type="password" id="oldpassword" name="oldpassword" placeholder="Current Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
    <input type="password" id="newpassword" name="newpassword" placeholder="New Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
    <input type="password" id="cnewpassword" name="cnewpassword" placeholder="Confirm New Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

      </br>
      <input class="button" type="submit" name="update-password" value="Update Password">
      <?php echo $adm->addImg('loading.gif','','','loading..','','pwd_loading') ?>

    </form>


        <!-- This is change password form -->
    </div>

</div>

</div>

<?php

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_footer.php");

?>

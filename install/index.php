<?php
include_once('installed.php');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Ajebo Market - Sales Agent Platform  : Installation </title>


         <link rel="shortcut icon" href="images/ajebo.ico">
         <link rel="stylesheet" href="css/style.css">
         <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
         <link rel="stylesheet" href="fonts/fonts.css">




  </head>

  <body>


    <div class="header">
  <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><img src="images/ajebo.png" alt="Ajebo Market" height="45px" width="90px"></span>
      <span style="width:auto;float:left;margin:0.8em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM  <span style="width:auto;color:#ee3d43; font-size:0.8em;" > <i class="fa  fa-chevron-right"></i>  INSTALLATION </span>
    </span>
       </div>


       <div class="wrapper">

         <div class="sap-wrapper">

       <div class="sap-wrapper-header">
        <i class="fa fa-cog"> </i> INSTALLATION | SETTINGS

       </div>


  <div class="form">

<form id="form1" name="form1" method="post" action="index.php">
<table border="0">
	  <tr>
    <td colspan='2'>
     <?php if (!empty($msg)):
			echo $msg;
			endif;		
		?>
    </td>
  </tr>
  <tr>
    <td width="31%">   <i class="fa fa-server" style="color:#ee3d43;"> </i> Host Server</td>
    <td>
      <label for="host"></label>
      <input type="text" placeholder="127.0.0.1 " name="host" id="host" />
    </td>
  </tr>
  <tr>
    <td>  <i class="fa fa-user" style="color:#ee3d43;"> </i> Host Username</td>
    <td><label for="user"></label>
      <input type="text" placeholder="root" name="user" id="user"/></td>
  </tr>
  <tr>
    <td>  <i class="fa fa-ellipsis-h" style="color:#ee3d43;"> </i> Host Password</td>
    <td><label for="pass"></label>
      <input type="password" placeholder="password" name="pass" id="pass" /></td>
  </tr>
  <tr>
    <td><i class="fa fa-database" style="color:#ee3d43;"> </i> Database Name</td>
    <td><label for="dbname"></label>
      <input type="text" placeholder="Database1" name="dbname" id="dbname" /></td>
  </tr>
  <tr>
    <td><i class="fa fa-folder" style="color:#ee3d43;"> </i> Project Name</td>
    <td><label for="app_folder"></label>
      <input type="text" placeholder="Project Folder Name" name="app_folder" id="app_folder" value= '<?php echo basename(dirname(dirname(__file__)));?>' /></td>
  </tr>
  <tr>
    <td>
  <label for="createdb"></label>
   <i class="fa fa-sliders" style="color:#ee3d43;"> </i> Manage Database <input type="checkbox" name="createdb" id="createdb" />
  </td>
  <td style="text-align:left; font-size:0.7em; padding-left:2%;">
<i class="fa fa-dot-circle-o"> </i> Check if you wish to create a New Database<br/>
<i class="fa fa-circle-o"> </i> Uncheck if you wish to reload an existing Database
</td>

  </tr>
  <tr>
    <td colspan="2">
      <button class="button" name="submit" id="submit"><i class="fa fa-chevron-circle-right"> </i> Install</button>
    </td>
    </tr>
</table>
</form>

</div>

</div>

</body>
</html>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Ajebo Market - Sales Agent Platform </title>


         <link rel="shortcut icon" href="images/ajebo.ico">
         <link rel="stylesheet" href="css/style.css">
         <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" href="fonts/fonts.css">




  </head>

  <body>

    <div class="header">
      <span style="width:auto;float:left;border: 1px solid rgba(0, 0, 0, 0.01);"><img src="images/ajebo.png" alt="Ajebo Market" height="45px" width="111px"></span>
      <span style="width:auto;float:left;margin:0.8em 0 0 1em;"><i class="fa fa-th"></i> SALES AGENT PLATFORM </span>
       </div>

<br>

<div class="wrapper">

  <div class="sap-wrapper">

<div class="sap-wrapper-header">
 <i class="fa fa-group"> </i> REGISTER | LOGIN

</div>

  <div class="form">

    <form class="search-form" action="index.php">

      <input type="text" id="email_login" name="email_login" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
      <input type="password" id="password_login" name="password_login" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

        </br>
        <div class="button" name="Login" onClick="login_user();"> LOGIN</div>
        <p class="message">Not Registered ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Register </span></p>


    </form>





    <form class="address-form" action="index.php">
  <input type="text" id="full_name" name="full_name" placeholder="Full Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
  <textarea name="address" id="address" placeholder="Address"></textarea><span class="form-icon"> <i class="fa fa-map"> </i></span>
  <input type="text" id="phone" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-tablet"> </i></span>
  <input type="text" id="email" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>
  <input type="password" id="password" name="password" placeholder="Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>
  <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"/><span class="form-icon"> <i class="fa fa-ellipsis-h"> </i></span>

      </br>
      <div class="button" name="register" onClick="create_account();"> Register</div>
      <p class="message">Already Registered ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Login </span></p>
    </form>
  </div>
</div>

</div>
    <script src='js/jquery.min.js'></script>
    <script src="js/index.js"></script>




  </body>
</html>

<?php
//MYSQL LOGIN INFO
if(isset($_POST['submit'])){
$localhost = $_POST['host']; //name of server. Usually localhost
$db = $_POST['dbname']; //database name.
$user = $_POST['user']; //database username.
$pass = $_POST['pass']; //database password.
$app_path = !empty($_POST['app_folder']) ? $_POST['app_folder']."/" : ""; //app folder.

if (empty($localhost)){
	$msg = "Enter your host server";
}elseif(empty($db)){
	$msg = "Enter your database name";
}elseif(empty($user)){
	$msg = "Enter your mysql username";
}else{
//DB CONNECTION
$dbconn =  new mysqli($localhost, $user , $pass);;

if (isset($_POST['createdb'])){
//DROP DATABASE IF EXIST
$sql= "DROP DATABASE IF EXISTS $db";
$dbconn->query($sql);

//CREATE DATABASE IF NOT EXIST
$sql= "CREATE DATABASE IF NOT EXISTS $db";
$dbconn->query($sql) or die('Unable to create database!');

}
 //SELECT DATABASE
$dbconn->select_db($db)or die('Unable to select database!');


//SQL FILE
$file = 'umdb.sql';

//UPLOAD SQL
if($fp = file_get_contents($file)) {
  $var_array = explode(';',$fp);
  foreach($var_array as $value) {
    $dbconn->query($value.';');
  }
}

//WRITE INTO THE CONFIG FILE
$iniConf ="[database]
host = ".$localhost."
user = ".$user."
pass = ".$pass."
dbname = ".$db."

[config]
app_folder = ".$app_path."
";

$jsConf = "var host = window.location.origin + '/';
var app_path = host + '".$app_path."';";

file_put_contents("../app/config/config.ini", $iniConf);
file_put_contents("../dashboard/js/config.js", $jsConf);

//DELETING THE INSTALL.TXT IN ORDER FOR THE INSTALL FOLDER TO BE DELETED
if (file_exists("../install.txt")) {
unlink("../install.txt");
}


//LOGIN INFO
$msg= '<p>Ajebo Market Sales Agent Platform has been installed!</p>
<p>The Admin Login Info is as follows<br />
Username: <strong>admin@test.com</strong><br />
Password: <strong>password</strong><br />
<br />
Go to <a href="../" target="_blank">Home Page</a> to login<br/>
Go to <a href="../admin/" target="_blank">Admin Area</a> to login<br/>';
}}
?>

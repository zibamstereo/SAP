<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_header.php");
/**
  * Add Datatbles to manage sales agents view
  */
  echo $adm->addFile("Css",LIB_URL."datatable/css/jquery.dataTables.min.css");
  echo $adm->addFile("Js",LIB_URL."datatable/js/jquery.dataTables.min.js");
?>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    var paginate = $('#manage_sales_agents').DataTable({
        "lengthMenu": [3,10, 25, 50, 100, 200],
        "processing": true
    });
    paginate.fnSort([1,'asc']);
} );


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
<i class="fa fa-dashboard"></i><h2 class="top-bar__headline"> | Manage Sales Agents</h2>
</div>
</div>


</header>
</section>

<section class="grid">


    <span class="grid__info animated fadeInDown" style="width:100% ">

    	<span class="category"> <i class="fa fa-info"></i>
            <table id="manage_sales_agents" class="display cell-border hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Full Name</th>
						<th>Email</th>
						<th>Phone No</th>
						<th>Address</th>
						<th>Start date</th>
						<th>User Status</th>
						<th>Online Status</th>
						<th>Admin Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Full Name</th>
						<th>Email</th>
						<th>Phone No</th>
						<th>Address</th>
						<th>Registration date</th>
						<th>User Status</th>
						<th>Online Status</th>
						<th>Admin Actions</th>
					</tr>
				</tfoot>
                                <tbody>
   <?php
                //Select all users and display paginated results
		$sql = "SELECT * FROM users WHERE level_access != 1";  
                // Fetch the array of the users selected
		$results = $adm->fetch($sql);
                foreach ($results as $res)
                {
	  ?>
            
					<tr>
						<td><?php echo $res['title']." ".$res['full_name'];?></td>
						<td><?php echo $res['email'];?></td>
						<td><?php echo $res['phone'];?></td>
						<td><?php echo $res['dob'];?></td>
						<td><?php echo $res['reg_date'];?></td>
						<td><?php echo $adm->adminShowUserActiveStatus($res['id']);?></td>
						<td><?php echo $adm->adminShowUserOnlineStatus($res['id']);?></td>
						<td><?php //echo $res['salary'];?></td>
					</tr>
         <?php
                }
        ?>
             </tbody>
            </table>
                
        </span>
    </span>


<?php
// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."admin_footer.php");

?>

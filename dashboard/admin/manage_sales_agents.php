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
   // paginate.fnSort([1,'asc']);
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
<i class="fa fa-dashboard"></i><h2 class="top-bar__headline"> Dashboard | Manage Sales Agents</h2>
</div>
</div>


</header>
</section>

<section class="grid">

    <span class="grid__info animated fadeInDown" style="width:100% ">


      <span>
            <!-- This table is meant for the action returned message -->
          <table width='100%' border='0'>
	  <tr>
		<td><div id='action'></div></td>
	  </tr>
	</table>
            <!-- This table is meant for the action returned message -->
            <table id="manage_sales_agents" class="display cell-border hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Full Name</th>
						<th>Email</th>
						<th>Phone No</th>
						<th>Address</th>
						<th>Registration Date</th>
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
						<th>Registration Date</th>
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
                    $id=$res['id'];
	  ?>

					<tr class='user_<?php echo $res['id'];?>'>
						<td><?php echo $res['title']." ".$res['full_name'];?></td>
						<td><?php echo $res['email'];?></td>
						<td><?php echo $res['phone'];?></td>
						<td><?php echo $res['dob'];?></td>
						<td><?php echo $res['reg_date'];?></td>
                                                <td> <div id='real_status_<?php echo $id;?>'><?php echo $adm->adminShowUserActiveStatus($id);?></div>
                                                <div style='display:none' id='changed_status_<?php echo $id;?>'></div>
                                                </td>
						<td><?php echo $adm->adminShowUserOnlineStatus($id);?></td>
                                                <td>
                                                  <a title='View User' href='<?php echo ADMIN_URL."edit_user_profile?id=$id";?>'><i class="fa fa-eye"></i></a>
                                                  <?php echo "<a title='Delete User' href='' onClick=\"admin_actions(event,".$id.",'delete');\"><i class='fa fa-times'></i></a>"; ?>
                                                  <div id='real_action_<?php echo $id;?>' class="sule">
                                                      <?php
	  if($res['active']==0){
	  echo "<a title='Confirm User' href='".APP_PATH."confirm_user_reg.php?activation_key=".$res['act_key']."&id=".$id."&level_access=".$res['level_access']."' target='_blank'><i class='fa fa-check-circle'></i></a>";
	  }
      elseif($res['active']==1){
	   echo "<a title='Suspend User' href='' onClick=\"admin_actions(event,".$id.",'suspend');\"><i class='fa fa-ban'></i></a>";
	   }
	  elseif($res['active']== 2){
	   echo "<a title='Unsuspend User' href='' onClick=\"admin_actions(event,".$id.",'unsuspend');\"><i class='fa fa-dot-circle-o'></i></a>";
	   }
           ?></div><div class='sule' style='display:none' id='changed_action_<?php echo $id;?>'></div>
                                                </td>
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

<?php
// directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);//we are dynamically recognising the seperator (/ or \) slash based on the system type if its windows linux or mac

// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."header.php");

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
<i class="fa fa-dashboard"></i><h2 class="top-bar__headline"> Dashboard | Welcome <?php echo $getuser[0]['full_name'];?> </h2>
</div>
</div>


</header>
</section>

<section class="grid">


<span class="grid__info animated fadeInDown">
	<h2 class="title title--preview"><i class="fa fa-database"></i> Block 1</h2>
	<span class="category"> <i class="fa fa-info"></i>
Block Data will come here
    </span>
</span>


<span class="grid__info animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 2</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>


<span class="grid__item animated fadeInDown">
	<h2 class="title title--preview"><i class="fa fa-database"></i> Block 3</h2>
	<span class="category"> <i class="fa fa-info"></i>
Block Data will come here
    </span>
</span>


<span class="grid__item animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 4</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>

<span class="grid__item animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 5</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>

<span class="grid__item animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 6</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>

<span class="grid__action animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 7</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>

<span class="grid__setting animated fadeInDown">
     <h2 class="title title--preview"><i class="fa fa-database"></i> Block 8</h2>

	 <span class="category"> <i class="fa fa-info"></i>
	 Block Data will come here
      </span>
</span>









<?php
// require header
 require_once (realpath(dirname(__FILE__).DS.'..'.DS).DS."inc".DS."footer.php");

?>

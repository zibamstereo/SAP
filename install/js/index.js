


  function install_db()
  {
    window.location= "http://localhost/sap/install/installed.php" ;

  }


  function create_project()
  {

  	var fn_host = $("#host").val();
  	var fn_user = $("#user").val();
    //var fn_password = $("#pass").val();
  	var fn_dbname = $("#dbname").val();
  	var fn_app_folder = $("#app_folder").val();



  	if(fn_host == "")
  	{
  		$("#host").focus();
  	}
  	else if(fn_user == "")
  	{
  		$("#user").focus();
  	}

//  	else if(fn_password == "")
//  	{
//  		$("#pass").focus();
//  	}
    else if(fn_dbname == "")
  	{
  		$("#dbname").focus();
  	}
  	else if(fn_app_folder == "")
  	{
  		$("#app_folder").focus();
  	}
  	else
  	{
     install_db();
   }
  		}

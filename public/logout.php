<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  $_SESSION["admin_id"]=null;
	  $_SESSION["password"]=null;
	  redirect_to("login.php");
	  ?>
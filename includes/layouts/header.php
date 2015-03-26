<?php require_once("../includes/sessions.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 
global $layout_context;
if(isset($layout_context)&&!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	} ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Widget Corp<?php echo $layout_context; ?></title>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
</head>

<body>
	<div id="header">
    
    	<h1 style="float:left">Widget Corp <?php echo $layout_context; ?></h1>
        <h5 style="float:right;margin-right:125px;margin-top:25px;"><?php if(!empty($layout_context)){ echo  "<a href=\"logout.php\" style=\"color:white;border-bottom=\"1px solid white;\"\" onclick=\"return confirm('".ucfirst($_SESSION["user_name"])." log_out : are you sure ?') \">log_out</a>";} ?></h5>
        <h3 style="float:right;margin-right:100px;margin-top:25px;"><?php if(!empty($layout_context)){ echo  "Admin: ".ucfirst($_SESSION["user_name"]);} ?></h3>
     </div>
     
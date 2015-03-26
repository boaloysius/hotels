<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/validation_functions.php");
	  if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	} 
	
	
	
	
	
	if(isset($_POST["submit"])){
	
								//Form validation
								$required=array("package_type","visible");
								$package_type=$_POST["package_type"];
								$visible=$_POST["visible"];
								$validate_presences=validate_presences($required);
								if(empty($errors))
								{	$maxlength=array("package_type" =>20);
									validate_max_lengths($maxlength);
								}
								global $errors;
								if(empty($errors)) {  $package_type=query_prep(html_prep($_POST["package_type"]));
										              $visible=(int)query_prep(html_prep($_POST["visible"]));
									    			  global $connection;
													  $query = "INSERT INTO package_types (";
										              $query .=" package_type,visible";
										              $query.=") VALUES (";
										              $query.="'{$package_type}',{$visible}";
										              $query.=")";
										              $result =mysqli_query($connection,$query);
										              if($result){ $_SESSION["message"]="package type created.";
																   redirect_to("manage_content.php");
																  }else{
																		die("failed session not made" );
																		$_SESSION["message"]="package type creation failed.".mysqli_connect_error();
			
																			}
													}
	
	  
								}
	 
//die ("{$hotel["id"]}");
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>w4</title>
<link href="stylesheets/style 1.css"
 rel="stylesheet" type="text/css" />
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 <script src="js/jquery.bxslider.js"></script>
 <link href="js/jquery.bxslider.css" rel="stylesheet" />
 
</head>
<script>$(document).ready(function(){
  $('.bxslider').bxSlider({auto:true,pager:false,controls:false,speed:5000,randomStart:true,pause:500,autoDirection:true,autoHover:true});
});
</script>
<body>
<div class="c">
<div class="h">
<div class="h1">
<img src="images/images/sdajh_03.png"  class="h11"/>
<div class="h12">
<h1 class="h121">+91-9000123456&nbsp;&nbsp;&nbsp;   |&nbsp;&nbsp;&nbsp;  info@visiblemunnar.in</h1>
<a href="https://www.google.co.in/" class="h122"></a>
<a href="https://www.google.co.in/" class="h123"></a>
<a href="https://www.google.co.in/" class="h124"></a>
<a href="https://www.google.co.in/" class="h125"></a>
</div><!--h12-->
</div>
<ul class="h2">
<li class="h21"><a href="https://www.google.co.in/" class="h211">HOME</a></li>
<li class="h21"><a href="https://www.google.co.in/" class="h211">ABOUT US</a></li>
<li class="h21"><a href="https://www.google.co.in/" class="h211">HOLYDAYS</a></li>
<li class="h21"><a href="https://www.google.co.in/" class="h211">SERVICES</a></li>
<li class="h21"><a href="https://www.google.co.in/" class="h211">NEWS</a></li>
<li class="h21"><a href="https://www.google.co.in/" class="h211">CONTACT US</a></li>
</ul>
</div>
<div class="bb">

<?php 
global $errors;
if(!empty($errors)){
		echo form_errors($errors);
	}
if(isset($_SESSION["message"])){
	echo $_SESSION["message"];
	}	
?>
<table style="margin:auto">
<form action="add_package_type.php" method="post">
         <tr><td><h1>Create Package_type</h1></td></tr>
         	<tr><td><p>Package Type :</p></td><td>
            	<input type="text"  name="package_type" value="<?php if(isset($_POST["package_type"])){echo html_prep($_POST["package_type"]);} ?>"/>
            </td></tr>
            
            
            <tr><td>Visible:</td>
            
            <td><input type="radio" name="visible" value="0"  <?php if(isset($_POST["visible"])&&$_POST["visible"]==0){echo " checked";} ?>/> NO
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if(isset($_POST["visible"])&&$_POST["visible"]==1){echo " checked";} ?> />Yes
            </td>
           
            <tr><td><input type="submit" name="submit" value="Create Package Type"/>
            </td></tr>
         </form>
</table>	
</div><!--ba-->
<div class="f">
<div class="f1">
<a href="https://www.google.co.in" class="f11">&nbsp;&nbsp;&nbsp;&nbsp;HOME &nbsp;&nbsp;&nbsp;&nbsp;|</a>
<a href="https://www.google.co.in" class="f11"> &nbsp;&nbsp;&nbsp;&nbsp;ABOUT US&nbsp;&nbsp;&nbsp;&nbsp;|</a>
<a href="https://www.google.co.in" class="f11"> &nbsp;&nbsp;&nbsp;&nbsp;HOLIDAYS&nbsp;&nbsp;&nbsp;&nbsp;|</a>
<a href="https://www.google.co.in" class="f11">&nbsp;&nbsp;&nbsp;&nbsp;SERVICES&nbsp;&nbsp;&nbsp;&nbsp;|</a>
<a href="https://www.google.co.in" class="f11"> &nbsp;&nbsp;&nbsp;&nbsp;NEWS&nbsp;&nbsp;&nbsp;&nbsp;|</a>
<a href="https://www.google.co.in" class="f11">&nbsp;&nbsp;&nbsp;&nbsp; CONTACT US&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
</div>
</div>
</body>
</html>

<?php require_once("../includes/db_connection.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/validation_functions.php");
	  require_once("../includes/sessions.php");
	  if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}

if(isset($_POST["submit"])) { 
$required_field=array("username","password");
validate_presences($required_field);


if(empty($errors)){
	
					$username=query_prep(html_prep($_POST["username"]));
					$password=$_POST["password"];
					//die("found admin");
					$found_admin=attempt_login($username,$password);
					
					//die($found_admin["user_name"]);
				
					if($found_admin){
									//Success
									//Mark usr as logged in
									$_SESSION["admin_id"]=$found_admin["id"];
									$_SESSION["username"]=$found_admin["username"];
									$_SESSION["message"]="Welcome Mr ".ucfirst($found_admin["username"]);
									redirect_to("manage_content.php");
					
									}else{
											//Failure
											
											$_SESSION["message"]="Username\Password not found";
											
								
											}
				
				
				
									}


				}
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
<div class="ba">
<div class="b1">
<a href="admin.php"><span><h1 class="admin">Admin</h1></span></a>

</div>

<div class="b4">



<h2 style="color:#F8BD55";>Admin Area</h2>
           
           	<ul>
            	<li><a href="manage_content.php"><span><h4 style="color:#D68217";>Manage Website Content</h4></span></a></li>
                <li><a href="add_admin.php"><span><h4 style="color:#D68217";>Mange Admin Users </h4></span></a></li>
                <li><a href="logout.php"><span><h4 style="color:#D68217";>Log_out</h4></span></a></li>
            </ul>




</div>

</div><!--ba-->

</div>
</body>
</html>

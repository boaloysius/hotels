<?php require_once("../includes/db_connection.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/validation_functions.php");
	  require_once("../includes/sessions.php");
if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}

if(isset($_POST["submit"])) { $required_field=array("username","password");
							  validate_presences($required_field);
							  if(empty($errors)){ $username=query_prep(html_prep($_POST["username"]));
												  $hashed_password=password_encrypt($_POST["password"]);
												  $query="INSERT INTO admins (";
												  $query.="username,password";
												  $query.=") VALUES (";	
												  $query.="'{$username}','{$hashed_password}'";
												  $query.=")";
												  $result=mysqli_query($connection,$query);
												  if($result && mysqli_affected_rows($connection)>=0){
													  $_SESSION["message"]="Admin created";
													  redirect_to("manage_content.php");
													  }else{	die( "{$query}");}	
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




<h2 style="color:#F8BD55";> +ADD Admin</h2>
             
           <?php  if(!empty($errors)){
										echo "<div class=\"message\">";
										foreach($errors as $reason=>$comment){
																				echo "<li>".htmlentities($comment)."</li><br/>";
																				}
										echo "</div>";
										}


				  if(isset($_SESSION["message"])){
											echo "<div class=\"message\">".$_SESSION["message"]."</div>";
											$_SESSION["message"]=null;
										}

									
							
							?>

             
				<form action="add_admin.php " method="post">             
       			<table>
                <tr>
                <td>Username:</td><td><input type="text" name="username" value="<?php if(isset($user_name)){echo htmlentities($user_name);} ?>"/></td>
                </tr>
				<tr>
                <td>Password</td><td><input type="password" name="password" value="" /></td>
                </tr>
                <tr><td><input type="submit" name="submit" value="Submit" /></td></tr>
                <tr><td><a href="admin.php">Cancel</a></td></tr>
                </table>
                
                </form>




</div>

</div><!--ba-->

</div>
</body>
</html>

<?php require_once("../includes/db_connection.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/sessions.php");
		if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}	 
	  if(isset($_GET["destination"])){
		  $destination_id=(int)$_GET["destination"];
		  $destination=find_destination_by_id_public($destination_id);
		  //$hotel=null;
		  }
		elseif(isset($_GET["hotel"]))
		{
			$hotel_id=(int)$_GET["hotel"];
			$destination=find_destination_by_hotel_id($hotel_id);
			$hotel=find_hotel_by_id($hotel_id);
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
<div class="ba">
<div class="b1">
<a href="admin.php"><span><h1 class="admin">Admin</h1></span></a>
<?php if(!empty($destination)){echo navigation_destinations($destination["id"]);}
		else{echo navigation_destinations();}
		
		?>
<?php if(!empty($destination)&&!empty($hotel)){echo navigation_hotels($destination["id"],$hotel["id"]);}
						

		
		
?>

</div>

<div class="b4">


<?php 
session_display();
if(!empty($hotel)){echo display_hotel_and_its_packages($hotel,$destination);
							echo navigation_packages($hotel["id"]);
							}
		?>

		

<?php if(!empty($destination)&&empty($hotel)){echo display_destination($destination);
												echo navigation_hotels($destination["id"],null);
}?>

</div>

</div><!--ba-->

</div>
</body>
</html>

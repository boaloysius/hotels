<?php require_once("../includes/db_connection.php");
	  require_once("../includes/functions.php");
	  if(isset($_GET["destination"])){
		  $destination_id=(int)$_GET["destination"];
		  $destination=find_destination_by_id_public($destination_id);
		  //$hotel=null;
		  }
		elseif(isset($_GET["hotel"]))
		{
			$hotel_id=(int)$_GET["hotel"];
			$destination=find_destination_by_hotel_id_public($hotel_id);
			$hotel=find_hotel_by_id_public($hotel_id);
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
<?php if(!empty($destination)){echo navigation_destinations_public($destination["id"]);}
		else{echo navigation_destinations_public();}
		
		?>
<?php if(isset($destination)){if(!empty($hotel)){echo navigation_hotels_public($destination["id"],$hotel["id"]);}
								else{echo navigation_hotels_public($destination["id"],null);}
}
		else{echo navigation_hotels_null();}
		
?>

</div>
<div class="b2">
<?php
$package_type_set=find_all_package_types_public();
$a_package=mysqli_fetch_assoc($package_type_set);
if(isset($_GET["package_type"])){
	$package_type=$_GET["package_type"];
	}
	else{
		$package_type=$a_package["id"];
		}
if(!isset($destination)){echo central_display_none_public1();
						 echo central_display_none_public2($package_type);
}
elseif(isset($destination) && !isset($hotel)){	echo central_display_selected_destination_none_hotel_public1($destination["id"]);
												echo central_display_selected_destination_none_hotel_public2($destination["id"],$package_type)
												;}
elseif(isset($hotel)){echo central_display_selected_hotel_public1($hotel["id"]);
												echo central_display_selected_hotel_public2($hotel["id"],$package_type)
												;}
?>



</div><!--b2-->
<div class="b3">
<div class="b31">
<h1 class="b311">Latest News</h1>
<p1 class="b312">Visible Munnar renders its services through Travel & Tourism.</p1>
<h1 class="b313">Sunday 01 Feb 2013</h1>
<p class="b314">We take immense privilege in 
introducing ourselves as an emerging Tourism Company with its operations based right in Cochin.With great pleasure, we are proud to inform you that we can to cater to all your Tourism needs and assistanc- </p>
<a href="https://www.google.co.in/" class="b315">Read More</a>
</div><!--b31-->

<?php if(isset($hotel)){echo navigation_packages_public($hotel["id"]);}
		else{echo navigation_packages_public_null();}?>
</div><!--b3-->
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

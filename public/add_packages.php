<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/validation_functions.php");
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
			$destination=find_destination_by_hotel_id_public($hotel_id);
			$hotel=find_hotel_by_id_public($hotel_id);
			}  
		elseif(isset($_GET["pack_type"]))
		{
			$pack_type_id=(int)$_GET["pack_type"];
			$destination=find_destination_by_hotel_id_public($hotel_id);
			$hotel=find_hotel_by_id_public($hotel_id);
			}  	
	  
	 // if(isset($_POST["submit"])){
	
	//die($_POST["destination"]."{$_POST["position"]}"."{$_POST["visible"]}");
	
	
	
	
	
	
	
	if(isset($_POST["submit"])){
	
								//Form validation
								$required=array("hotel_name","visible","position");
								$validate_presences=validate_presences($required);
								if($validate_presences)
								{	$maxlength=array("destination" =>20,"description" =>5000);
									validate_max_lengths($maxlength);
								}
								global $errors;
								if(empty($errors))
									{
										//Form Processing
										$dest_id=$destination["id"];
										$hotel_name=$_POST["hotel_name"];
										$hotel_name=htmlentities(html_prep($hotel_name));
										$position=(int)htmlentities($_POST["position"]);
										$visible=(int)$_POST["visible"];
										
										if(isset($_POST["short_description"])){
									
																		$short_description=htmlentities($_POST["short_description"]);
																		  }
																		else{ $short_description=null;
									
																			}
										
										if(isset($_POST["description"])){
									
																		$description=htmlentities($_POST["description"]);
																		  }
																		else{ $description=null;
									
																			}
										if(isset($_POST["image"])){
																	$image=htmlentities($_POST["image"]);
																   }
																		else{  $image=null;
																		    }
										if(isset($_POST["thumb_image"])){
																	$thumb_image=htmlentities($_POST["thumb_image"]);
																   }
																		else{  $thumb_image=null;
																		    }									
																			
									
	
	global $connection;
	$query = "INSERT INTO hotels (";
	$query .=" dest_id,name,position,visible,";
	if(isset($_POST["short_description"])){
		$query.="short_description,";
		}
	if(isset($_POST["description"])){
		$query.="description,";
		}	
	if(isset($_POST["thumb_image"])){
		$query.="thumb_image,";}	
	if(isset($_POST["image"])){
		$query.="image";}
	$query.=") VALUES (";
	$query.="'{$dest_id}','{$hotel_name}',{$position},{$visible}";
	if(isset($_POST["short_description"])){
										$query.=",'{$short_description}'";
										}
	if(isset($_POST["description"])){
										$query.=",'{$description}'";
										}									
	if(isset($_POST["thumb_image"])){
								$query.=",'{$thumb_image}'";
								}
	if(isset($_POST["image"])){
								$query.=",'{$image}'";
								}							
	$query.=")";
	$result =mysqli_query($connection,$query);
	if($result){
		
				$_SESSION["message"]="hotel ".$hotel["hotel_name"]." created.";
		
				redirect_to("manage_content.php?destination={$destination["id"]}");
				}else{
						die("failed session not made" );
						$_SESSION["message"]="hotel ".$hotel["hotel_name"]." creation failed.".mysqli_connect_error();
			
			//echo "Sorry";
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
if(!isset($_GET["destination"])){
	die("<h1 class=\"message\">Select a destination</h1>");
	}
global $errors;
if(!empty($errors)){
		echo form_errors($errors);
	}
if(isset($_SESSION["message"])){
	echo $_SESSION["message"];
	}	
?>
<table style="margin:auto">
<form action="add_hotel.php?destination=<?php echo $destination["id"];?>" method="post">
         <tr><td><h1>Add Hotel</h1></td></tr>
         	<tr><td><p>Hotel name:</p></td><td>
            	<input type="text"  name="hotel_name" value=""/>
            </td></tr>
            <tr><td>Destination</td><td><?php echo $destination["destination"]."({$destination["id"]})" ?></td></tr>
             <tr><td>Hotel</td><td><?php echo $hotel["name"]."({$hotel["id"]})" ?></td></tr>
              <tr><td>Package</td><td><?php echo $package_type["package_type"]."({$package_type["id"]})" ?></td></tr>
            <tr><td>Position:</td><td>
            	<select name="position">
                <?php
					$package_set = find_packages_by_hotel_id();
					$package_count=mysqli_num_rows($package_set);
					for($count=1;$count<=$package_count+1;$count++){
						echo"<option value=\"{$count}\">".(int)$count."</option>";
						}
				?>
                	
                </select></td></tr>
            
            <tr><td>Visible:</td>
            
            <td><input type="radio" name="visible" value="0" /> NO
            &nbsp;
            <input type="radio" name="visible" value="1" selected />Yes
            </td>
           <tr><td><p>Pack type</p></td><td>
            	<?php echo {} ?></td></tr>
             <tr><td><p>Thumb Image_link</p></td><td>
            	<input type="text"  name="thumb_image" value=""/>
            </td></tr>
            <tr><td><p>Image_link</p></td><td>
            	<input type="text"  name="image" value=""/>
            </td></tr>
            <tr><td><p>Description</p></td><td>
            	<textarea name="description" value="" rows="10" cols="60" style="width:494px;"></textarea>
            </td></tr>
             
            <tr><td><input type="submit" name="submit" value="Create Destination"/>
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

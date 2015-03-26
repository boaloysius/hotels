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
		if(isset($_GET["package_type"]))
		{
			$package_type_id=(int)$_GET["package_type"];
			$package_type=find_package_type_by_id($package_type_id);
			//die($package_type["package_type"]);
			}  	
		if(isset($_POST["submit"])){
			foreach($_POST as $field=>$value){
				${$field}=$value;
				}
		}
	  
	 // if(isset($_POST["submit"])){
	
	//die($_POST["destination"]."{$_POST["position"]}"."{$_POST["visible"]}");
	
	//if(isset($_POST["submit"])){
//		print_r($_POST);
//		die("");
//		}
	
	
	
	
	
	if(isset($_POST["submit"])){
								global $errors;
								//Form validation
								$required=array("hotel","package_type","position","visible","pack_duration","rate","pack_name");
								$validate_presences=validate_presences($required);
								if(empty($errors))
								{	$maxlength=array("pack_duration"=>6,"description" =>5000,"pack_name"=>15);
									validate_max_lengths($maxlength);
								}
								global $errors;
								if(empty($errors))
									{
										//Form Processing
										
										$destination["id"]=htmlentities(html_prep($destination["id"]));
										$hotel["id"]=htmlentities(html_prep($hotel["id"]));
										$package_type["id"]=htmlentities(html_prep($package_type["id"]));
										
										$position=(int)htmlentities($_POST["position"]);
										$visible=(int)$_POST["visible"];
										$pack_duration=htmlentities(html_prep($_POST["pack_duration"]));
										$pack_name=htmlentities(html_prep($_POST["pack_name"]));
										$rate=htmlentities(html_prep($_POST["rate"]));
									
										if(isset($_POST["pack_description"])){
									
																		$pack_description=htmlentities($_POST["pack_description"]);
																		  }
																		else{ $pack_description=null;
									
																			}
										if(isset($_POST["image"])){
																	$image=htmlentities($_POST["image"]);
																   }
																		else{  $image=null;
																		    }
									
	
	global $connection;
	$query = "INSERT INTO packages (";
	$query .=" dest_id,hotel_id,pack_type_id,position,visible,pack_type,pack_duration,rate,";
	if(isset($_POST["pack_description"])){
		$query.="pack_description";
		}
	$query.=") VALUES (";
	$query.="{$destination["id"]},{$hotel["id"]},{$package_type["id"]},{$position},{$visible},'{$pack_name}','{$pack_duration}',{$rate}";
	if(isset($_POST["pack_description"])){
										$query.=",'{$pack_description}'";
										}
	
	$query.=")";
	$result =mysqli_query($connection,$query);
	if($result){
		
				$_SESSION["message"]="package created.";
		
				redirect_to("manage_content.php?hotel={$hotel["id"]}");
				}else{
						die("failed session not made .{$query}" );
						$_SESSION["message"]="package creation failed.".mysqli_connect_error();
			
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
global $errors;
if(!empty($errors)){
		echo form_errors($errors);
	}
if(isset($_SESSION["message"])){
	echo $_SESSION["message"];
	}	
?>
<table style="margin:auto">
<form action="add_package.php?hotel=<?php echo $hotel["id"]; ?>&package_type=<?php  echo $package_type["id"] ?>" method="post">
         <tr><td><h1>Create Package Of Category <?php echo $package_type["package_type"];?></h1></td></tr>
         	<tr><td><p>Destination name:</p></td><td>
            	<?php echo $destination["destination"]; ?>
            </td></tr>
            <tr><td><p>Hotel name:</p></td><td>
            	<?php echo $hotel["name"]; ?>
            </td></tr>
            <tr><td><p>Package_type name:</p></td><td>
            	<?php echo $package_type["package_type"]; ?>
            </td></tr>
            <tr><td>Position:</td><td>
            	<select name="position">
                <?php
					$package_set = find_all_packages();
					$package_count=mysqli_num_rows($package_set);
					for($count=1;$count<=$package_count+1;$count++){
						echo"<option value=\"{$count}\"";
						if(isset($position)&&$position==$count)
						{echo " selected";}
						echo ">".(int)$count."</option>";
						}
				?>
                	
                </select></td></tr>
            
            <tr><td>Visible:</td>
            
            <td><input type="radio" name="visible" value="0" <?php if(isset($visible)&&$visible==0){echo "checked";}  ?>/> NO
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if(isset($visible)&&$visible==1){echo "checked";}  ?> />Yes
            </td>
            
            <tr><td><p>Package Duration</p></td><td>
            	<input type="text"  name="pack_duration" value="<?php if(isset($pack_duration)){echo $pack_duration;}  ?>"/>
            </td></tr>
            <tr><td><p>Package Name</p></td><td>
            	<input type="text"  name="pack_name" value="<?php if(isset($pack_name)){echo $pack_name;}  ?>"/>
            </td></tr>
            <tr><td><p>Rate</p></td><td>
            	<input type="text"  name="rate" value="<?php if(isset($rate)){echo $rate;}  ?>"/>
            </td></tr>
            <tr><td><p>Description</p></td><td>
						<textarea name="pack_description" value="" rows="10" cols="60" style="width:494px;"><?php if(isset($description)){echo $description;}  ?></textarea>            </td></tr>
            <tr><td><input type="submit" name="submit" value="Create Package"/>
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

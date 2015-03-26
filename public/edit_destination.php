<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  require_once("../includes/validation_functions.php");
	   if(isset($_GET["destination"])){
		  $destination_id=(int)$_GET["destination"];
		  $destination=find_destination_by_id($destination_id);
		  //$hotel=null;
		  }
		elseif(isset($_GET["hotel"]))
		{
			$hotel_id=(int)$_GET["hotel"];
			$destination=find_destination_by_hotel_id_public($hotel_id);
			$hotel=find_hotel_by_id_public($hotel_id);
			}  
	  
	 // if(isset($_POST["submit"])){
	
	//die($_POST["destination"]."{$_POST["position"]}"."{$_POST["visible"]}");
	
	
	
	
	
	
	
	if(isset($_POST["submit"])){
	
								//Form validation
								$required=array("destination","visible","position");
								$validate_presences=validate_presences($required);
									if(empty($errors)){	$maxlength=array("destination" =>25,"description" =>5000);
														validate_max_lengths($maxlength);
														}
									global $errors;
									if(empty($errors)){
														//Form Processing
														$id=$destination["id"];
														$destination=query_prep(html_prep($_POST["destination"]));
														$position=(int)query_prep(html_prep($_POST["position"]));
														$visible=(int)$_POST["visible"];
									
															if(isset($_POST["description"])){$description=query_prep(html_prep($_POST["description"]));
																		  						}else{ $description=null;
																										}
															if(isset($_POST["image"])){	$image=query_prep(html_prep($_POST["image"]));
																  						 }else{ $image=null;
																		   							 }
									
	
														global $connection;
														$query = "UPDATE destinations SET ";
														$query .="destination='{$destination}',position={$position},visible={$visible}";
	
															if($description){  $query.=",description='{$description}'";
																				}
															if($image){
																		$query.=",image='{$image}'";
																		}
												
														$query.=" WHERE id={$id}";
	
														$result =mysqli_query($connection,$query);
															if($result){  $_SESSION["message"]="destionation edited.";
																		   redirect_to("manage_content.php");
																			}else{
																					die("failed session not made" );
																					$_SESSION["message"]="destination editing failed.".mysqli_connect_error();
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
<form action="edit_destination.php?destination=<?php echo $destination["id"] ?>" method="post">
         <tr><td><h1>Edit Destination</h1></td></tr>
         	<tr><td><p>Destination name:</p></td><td>
            	<input type="text"  name="destination" 
                value="<?php if(isset($_POST["destination"])){ echo html_prep($_POST["destination"]);
								                          			}else{  echo $destination["destination"];
																			} ?>"/>
            </td></tr>
            <tr><td>Position:</td><td>
            	<select name="position">
                <?php
					$destination_set = find_all_destinations();
					$destination_count=mysqli_num_rows($destination_set);
					for($count=1;$count<=$destination_count+1;$count++){
						
						echo"<option value=\"{$count}\"";
						if(isset($_POST["position"])){
									 					if($count==$_POST["position"]){
																						 echo " selected";
																						
																						}
														}
						else{
								if($count==$destination["position"]){
																		echo " selected";
																		}
								}
						echo ">".(int)$count."</option>";
						}
				?>
                	
                </select></td></tr>
            
            <tr><td>Visible:</td>
            
            <td><input type="radio" name="visible" value="0" <?php if(isset($_POST["visible"])&&$_POST["visible"]==0){echo " checked";
																														}elseif($destination["visible"]==0			)
																												{	echo " checked";
																														} ?>/> NO
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if(isset($_POST["visible"])&&$_POST["visible"]==1){echo " checked";
																														}elseif($destination["visible"]==1			)
																												{	echo " checked";
																														} ?> />Yes
            </td></tr>
            <tr><td><p>Image_link</p></td><td>
            	<input type="text"  name="image" value="<?php if(isset($_POST["image"])){ echo html_prep($_POST["image"]);
								                          			}else{  if(isset($destination["image"])){ echo $destination["image"];
																												}
																			} ?>"/></td></tr>
                                                                            
            <tr><td><p>Description</p></td><td><textarea name="description"  rows="10" cols="60" style="width:494px;"><?php if(isset($_POST["description"])){ echo html_prep($_POST["description"]);
								                          			}else{  if(isset($destination["description"])){ echo $destination["description"];
																												}
																			} ?></textarea></td></tr>
            <tr><td><input type="submit" name="submit" value="Edit Destination"/>
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

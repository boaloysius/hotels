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
	  
	 // if(isset($_POST["submit"])){
	
	//die($_POST["destination"]."{$_POST["position"]}"."{$_POST["visible"]}");
	
	
	
	
	
	
	
	if(isset($_POST["submit"])){	$required=array("hotel_name","visible","position");
									$validate_presences=validate_presences($required);
									if(empty($errors)){ $maxlength=array("hotel_name" =>20,"description" =>5000,"short_description" =>250);
														 validate_max_lengths($maxlength);
														}
									global $errors;
									if(empty($errors)){ $hotel_id=query_prep(html_prep($hotel["id"]));
														$dest_id=query_prep(html_prep($destination["id"]));
														$hotel_name=query_prep(html_prep($_POST["hotel_name"]));
														$position=(int)query_prep(html_prep($_POST["position"]));
														$visible=(int)query_prep($_POST["visible"]);
										
														if(isset($_POST["short_description"])){ $short_description=query_prep(html_prep($_POST["short_description"]));
																	  							}else{ $short_description=null;
									
																										}
									
														if(isset($_POST["description"])){ $description=query_prep(html_prep($_POST["description"]));
																	 					  }else{ $description=null;
																						  		}
														if(isset($_POST["image"])){ $image=query_prep(html_prep($_POST["image"]));
															   						}else{  $image=null;
																	    					}
														if(isset($_POST["thumb_image"])){ $thumb_image=query_prep(html_prep($_POST["thumb_image"]));
															   								}else{  $thumb_image=null;
																								    }									
																		
										
														global $connection;
														$query = "UPDATE hotels SET ";
									  					$query .="name='{$hotel_name}',position={$position},visible={$visible}";
	
														if($description){ $query.=",description='{$description}'";
																				}
														if($short_description){$query.=",short_description='{$short_description}'";
																				}	
														if($image){$query.=",image='{$image}'";
																	}
														if($thumb_image){ $query.=",thumb_image='{$thumb_image}'";
																			}	
												
														$query.=" WHERE id={$hotel_id}";
	

														$result =mysqli_query($connection,$query);
														if($result){ $_SESSION["message"]="hotel ".$hotel["hotel_name"]." edited.";
																	 redirect_to("manage_content.php?hotel={$hotel["id"]}");
																	 }	else  { die("failed session not made <br/>{$query}" );
																				$_SESSION["message"]="hotel ".$hotel["hotel_name"]." creation failed.".mysqli_connect_error();
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
<div class="bb">

<?php 
if(!isset($_GET["hotel"])){
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
<form action="edit_hotel.php?hotel=<?php echo $hotel["id"];?>" method="post">
         <tr><td><h1>Edit Hotel</h1></td></tr>
         	<tr><td><p>Hotel name:</p></td><td>
            	<input type="text"  name="hotel_name" value="<?php echo $hotel["name"]?>"/>
            </td></tr>
            <tr><td>Destination</td><td><?php echo $destination["destination"]."({$destination["id"]})" ?></td></tr>
            <tr><td>Position:</td><td>
            	<select name="position">
                <?php
					$hotel_set = find_hotels_by_destination_id($destination["id"]);
					$hotel_count=mysqli_num_rows($hotel_set);
					for($count=1;$count<=$hotel_count;$count++){
						echo"<option value=\"{$count}\"";
						if($count==$hotel["position"]){
						echo " selected";
						}
						echo">".(int)$count."</option>";
						}
				?>
                	
                </select></td></tr>
            
             <tr><td>Visible:</td>
            
            <td><input type="radio" name="visible" value="0" <?php if(isset($_POST["visible"])&&$_POST["visible"]==0){echo " checked";
																														}elseif($hotel["visible"]==0			)
																												{	echo " checked";
																														} ?>/> NO
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if(isset($_POST["visible"])&&$_POST["visible"]==1){echo " checked";
																														}elseif($hotel["visible"]==1			)
																												{	echo " checked";
																														} ?> />Yes
            </td></tr>
           <tr><td><p>Short Description</p></td><td>
            	<textarea name="short_description" value="" rows="6" cols="30" 
                style="width:280px;"><?php if(isset($_POST["description"])){ echo html_prep($_POST["short_description"]);
								                          					}else{  if(isset($hotel["short_description"])){ echo $hotel["short_description"];
																												}
																			} ?></textarea>
            </td></tr>
             <tr><td><p>Thumb Image_link</p></td><td>
            	<input type="text"  name="thumb_image" value="<?php if(isset($_POST["thumb_image"])){ echo html_prep($_POST["thumb_image"]);
								                          			}else{  if(isset($hotel["thumb_image"])){ echo $hotel["thumb_image"];
																												}
																			} ?>"/>
            </td></tr>
            <tr><td><p>Image_link</p></td><td>
            	<input type="text"  name="image" value="<?php if(isset($_POST["image"])){ echo html_prep($_POST["image"]);
								                          			}else{  if(isset($hotel["image"])){ echo $hotel["image"];
																												}
																			} ?>"/>
            </td></tr>
            <tr><td><p>Description</p></td><td>
            	<textarea name="description" value="" rows="10" cols="60" 
                style="width:494px;"><?php if(isset($_POST["description"])){ echo html_prep($_POST["description"]);
								                          			}else{  if(isset($hotel["description"])){ echo $hotel["description"];
																												}
																			} ?></textarea>
            </td></tr>
             
            <tr><td><input type="submit" name="submit" value="Edit Hotel"/>
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

<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}
	  if(isset($_GET["hotel"])){ $hotel=find_hotel_by_id($_GET["hotel"]);
									   if(isset($hotel)){ $query="DELETE FROM hotels WHERE id={$hotel["id"]}";
									   							$result=mysqli_query($connection,$query);
																if($result){$_SESSION["message"]="Hotel {$hotel["name"]} deleted successfully";                                                  			redirect_to("manage_content.php");             
																			}else{$_SESSION["message"]="hotel {$hptel["name"]} deletetion failed";
																					redirect_to("manage_content.php");
																					}
																			
										   						 
								                              } else{ die ("Sorry cannot procede");}
	  }  else { die("sorry");
				}
?>	  
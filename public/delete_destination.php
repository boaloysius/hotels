<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}
	  if(isset($_GET["destination"])){ $destination=find_destination_by_id($_GET["destination"]);
									   if(isset($destination)){ $query="DELETE FROM destinations WHERE id={$destination["id"]}";
									   							$result=mysqli_query($connection,$query);
																if($result){$_SESSION["message"]="Destination {$destination["destination"]} deleted successfully";                                                  			redirect_to("manage_content.php");             
																			}else{$_SESSION["message"]="Destination {$destination["destination"]} deletetion failed";
																					redirect_to("manage_content.php");
																					}
																			
										   						 
								                              } else{ die ("Sorry cannot procede");}
	  }  else { die("sorry");
				}
?>	  
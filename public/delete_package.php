<?php require_once("../includes/db_connection.php");
	  require_once("../includes/sessions.php");
	  require_once("../includes/functions.php");
	  if(!isset($_SESSION["admin_id"])){
	redirect_to("login.php");
	}
	  if(isset($_GET["package"])){ $package=find_package_by_id($_GET["package"]);
									   if(isset($package)){ $query="DELETE FROM packages WHERE id={$package["id"]}";
									   							$result=mysqli_query($connection,$query);
																if($result){$_SESSION["message"]="Package {$package["package_type"]} deleted successfully";                                                  			redirect_to("manage_content.php?hotel={$package["hotel_id"]}");             
																			}else{$_SESSION["message"]="Package {$package["package_type"]} deletetion failed";
																					redirect_to("manage_content.php?hotel={$package["hotel_id"]}");
																					}
																			
										   						 
								                              } else{ die ("Sorry cannot procede");}
	  }  else { die("sorry");
				}
?>	  
<?php

require_once("db_connection.php");
function redirect_to($new_location){
		header("Location: " .$new_location);
		exit;
		}
// echo navigation_destinations_public();
function find_all_destinations_public(){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.="WHERE visible=1";
	$query.=" ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		return $result;
		}else{
			echo "Database query  for function find _all_destinations_public failed".$query;
			}
	
	}
	
//find_hotels_by_destination_id_public(2);	
	
	
function find_hotels_by_destination_id_public($destination_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM hotels ";
	$query.="WHERE visible=1 ";
	$query.="AND dest_id={$destination_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		return $result;
				}else{
			echo "Database query for function find_hotels_by_destination_id_public failed ".$query;
			}
	}	

function navigation_destinations_public($destination_id=null){
	$destination_set=find_all_destinations_public();
	$output="<ul class=\"b11\">";
	$output.="<h1 class=\"b111\">Destinations</h1>";
	while($destination=mysqli_fetch_assoc($destination_set)){
		$output.="<li class=\"b112 ";
		if($destination_id==$destination["id"]){
		$output.="b112_selected";	
			}
		$output.="\"><a href=\"index.php?destination=".url_prep($destination["id"])."\">".$destination["destination"]."</a></li>";
		}
	$output.="</ul>";
	$output.="<br/><hr>";
	return $output;
	}
	//navigation_hotels_public(2);
function navigation_hotels_public($destination_id=1,$hotel_id=null){
		
		$hotel_set=find_hotels_by_destination_id_public($destination_id);
		//die ( "{$destination_id}" );
		$output="<ul class=\"b12\">";
		$output.="<h1 class=\"b111\">Hotels</h1>";
	while($hotel=mysqli_fetch_assoc($hotel_set)){
		$output.="<li class=\"b112 ";
		if($hotel_id==$hotel["id"]){
		$output.="b112_selected";	
			}
		$output.="\"><a href=\"index.php?hotel=".url_prep($hotel["id"])."\">".$hotel["name"]."</a></li>";
		}
		$output.="<a href=\"https://www.google.co.in\" class=\"b13\">More...</a>";

	$output.="</ul>";
	return $output;
	}	
	// find_hotel_by_id_public();
function find_destination_by_id_public($destination_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.="WHERE visible=1 ";
	$query.="AND id={$destination_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		}else{
			echo "Database query  for function find_destination_by_id_public failed".$query;
			}
	
	}	
function find_destination_by_id($destination_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.="WHERE id={$destination_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		}else{
			echo "Database query  for function find_destination_by_id failed".$query;
			}
	
	}		
function find_package_type_by_id($package_type_id){
	
	//die($package_type_id);
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM package_types ";
	$query.="WHERE id={$package_type_id} ";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		}else{
			echo "Database query  for function find_package_type_by_id failed".$query;
			}
	
	}			
function find_hotel_by_id_public($hotel_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM hotels ";
	$query.="WHERE visible=1 ";
	$query.="AND id={$hotel_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		//echo "success";
		}else{
			echo "Database query  for function find_hotel_by_id_public failed".$query;
			}
	}	
function find_hotel_by_id($hotel_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM hotels ";
	$query.="WHERE id={$hotel_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		//echo "success";
		}else{
			echo "Database query  for function find_hotel_by_id_public failed".$query;
			}
	}		
	//$destination=find_destination_by_id_public(2);
	//global $connection;
	//if($destination){
		//echo $destination["destination"];}
	//else{
		//echo "sorryfor".mysqli_connect_error();
		//}
function find_destination_by_hotel_id_public($hotel_id=1){
	global $connection;
	$hotel=find_hotel_by_id_public($hotel_id);
	//die($hotel["name"]);
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.="WHERE visible=1 ";
	$query.="AND id=".$hotel["dest_id"]." ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		}else{
			die( "Database query  for function find_destination_by_hotel_id_public failed".$query);
			}
	
	}	
function find_destination_by_hotel_id($hotel_id=1){
	global $connection;
	$hotel=find_hotel_by_id_public($hotel_id);
	//die($hotel["name"]);
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.="WHERE id=".$hotel["dest_id"]." ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		$result=mysqli_fetch_assoc($result);
		return $result;
		}else{
			die( "Database query  for function find_destination_by_hotel_id_public failed".$query);
			}
	
	}	
	
function query_prep($word){
	global $connection;
	//die("{$word}");
	$word=mysqli_real_escape_string($connection,$word);
	
	return $word;
	
	}	
function html_prep($word){
	global $connection;
	$word=htmlentities($word);
	
	return $word;
	}
function url_prep($word){
	global $connection;
	$word=urlencode($word);
	return $word;
	}	
//echo navigation_packages_public(1);	
function navigation_packages_public($hotel_id=1){
	
	$package_type_set=find_all_package_types_public();
	$output="<div class=\"b32\">";
	while($package_type=mysqli_fetch_assoc($package_type_set)){
		//echo $package["package_type"]."<br/>";
		$output.="<ul class=\"b12 r1\">";
		$output.="<h1 class=\"b111 r11\">".$package_type["package_type"]."</h1>";
		$package_set=find_packages_by_package_type_id_and_hotel_id_public($package_type["id"],$hotel_id);
		while($package=mysqli_fetch_assoc($package_set)){
			$output.="<li class=\"b112 ri2\"><a href=\"package_display_public.php?package={$package["id"]}\">".$package["pack_type"]." ".$package["pack_duration"]." </a></li>";
			}
		$output.="</ul>";	
		}$output.="</div>";
		return $output;
	
	}	
function find_all_package_types_public(){
	global $connection;
	$query="SELECT * FROM package_types ";
	$query.="WHERE visible=1 ";
	$query.="ORDER BY id";
	$result=mysqli_query($connection,$query);
	if($result){
	return $result;}
	else{
		die("sorry  function find_all_package_types_public failed".$query);
		}
	}

function find_packages_by_package_type_id_and_hotel_id_public($package_type_id,$hotel_id){
	
	global $connection;
	$query="SELECT * FROM packages ";
	$query.="WHERE hotel_id=".$hotel_id." ";
	$query.="AND pack_type_id=".$package_type_id." ";
	$query.="AND visible=1";
	$result=mysqli_query($connection,$query);
	if($result){
	return $result;}
	else{
		die("sorry  function find_packages_by_package_type_id_and_hotel_id_public failed".$query);
		}
	}
function navigation_packages_public_null(){
	$package_type_set=find_all_package_types_public();
	$output="<div class=\"b32\">";
	while($package_type=mysqli_fetch_assoc($package_type_set)){
		//echo $package["package_type"]."<br/>";
		$output.="<ul class=\"b12 r1\">";
		$output.="<h1 class=\"b111 r11\">".$package_type["package_type"]."</h1>";
		$output.="</ul>";	
			}
		$output.="<h5 class=\"h211\">Select destination and hotel to view packages</h5>";
		$output.="</div>";
		return $output;
	}
function navigation_hotels_null(){
	$hotel_set=find_all_hotels_public();
	$output="<ul class=\"b12\">";
	$output.="<h1 class=\"b111\">Hotels</h1>";
	while($hotel=mysqli_fetch_assoc($hotel_set))
	{$output.="<li class=\"b112\"><a href=\"index.php?hotel={$hotel["id"]}\">".$hotel["name"]."</a></li>";
}	return $output;
	}		
function find_all_hotels_public(){
	global $connection;
	$query="SELECT * FROM hotels ";
	$query.="WHERE visible=1";
	$result=mysqli_query($connection,$query);
	if($result){return $result;}
	else{die("sorry  function find_all_hotels_public failed".$query);
		}
	}
//$package=find_selected_package_type_public(1);
//echo $package["package_type"];	
function find_selected_package_type_public($package_id){
			global $connection;
			$query="SELECT * FROM package_types ";
			$query.="WHERE visible=1 ";
			$query.="AND id={$package_id}";
			$result=mysqli_query($connection,$query);
			if($result){
				return mysqli_fetch_assoc($result);
				}else{
					die("error : function find_selected_package_type FAILED");
					}
			
	}		
	//central_display_none_public();
function central_display_none_public1(){
	$output="<h1 class=\"b21\">Welcome to Visible Munnar</h1>";
	$output.="<div class=\"b22\">";
		$output.="<div class=\"b22a\";>";
				$output.="<ul class=\"bxslider\">";
  				$output.="<li><img src=\"images/images/effsd_05.png\" class=\"b221\"; /></li>";
  				$output.="<li><img src=\"images/images/8.png\" class=\"b221\"/></li>";
  				$output.="<li><img src=\"images/images/1.png\" class=\"b221\"/></li>";
  				$output.="<li><img src=\"images/images/7.png\" class=\"b221\"/></li>";
				$output.="</ul>";
				$output.="</div>";
				$output.="<p class=\"b222\">Visible Munnar renders its services through Travel & Tourism.</p>";
				$output.="<h1 class=\"b223\">Travel & Tourism</h1>";
				$output.="<p class=\"b222\">";

				$output.="We take immense privilege in introducing ourselves as an emerging Tourism Company with its operations based right in Cochin - \"Gods Own Country\" - Kerala.<br/> 
With great pleasure, we are proud to inform you that we can to cater to all your Tourism needs and assistance, to each and every clients in a very personalised and professional manner than any other tour operators in our region."; 
 				$output.="</p>";
 				$output.="<a href=\"https://www.google.co.in/\" class=\"b224\">Read More</a>"; 
				$output.="</div>";
				return $output;}
function central_display_none_public2($package_type_id){				
				global $connection;
		$all_packages=find_all_package_types_public();
		$package_type=find_package_type_by_id_public($package_type_id);
		$top_three_packages=find_top_three_packages_by_package_type_id_public($package_type["id"]);
		$output="<div class=\"b23cover\">";
		$output.="<div class=\"b23\">";
		$output.="<div class=\"b231\">";
    	$output.="<h1 class=\"b2311\">Featured ".$package_type["package_type"]." in Kerala"."</h1>";
    	$output.="</div>";
    	$output.="<div class=\"b232\">";
    	while($a_package=mysqli_fetch_assoc($all_packages)){
				$output.="<a href=\"index.php?package_type={$a_package["id"]}\" class=\"b2321 ";
				if($package_type_id==$a_package["id"]){
					$output.="b2321_selected";
					}
				$output.="\"></a>";
			}
		$output.="</div>";
		$output.="</div>";
		if(isset($top_three_packages))
		{
			while($a_top_package=mysqli_fetch_assoc($top_three_packages)){
		$output.="<div class=\"b24\">";
		$hotel=find_hotel_by_package_id_public($a_top_package["id"]);
		$output.="<img src=\"".$hotel["thumb_image"]."\" class=\"b241\" />";
		$output.="<div class=\"b242\">";
		$output.="<h1 class=\"b2421\">".$a_top_package["pack_type"]." ".$a_top_package["pack_duration"]."</h1>";
		$output.="<div class=\"b2422cover\"><p class=\"b2422\">".nl2br($a_top_package["pack_description"])."</p></div>";
		$output.="<h1 class=\"b2423\">Rs.".$a_top_package["rate"]."</h1>";
		$output.="<a href=\"https://www.google.co.in/\" class=\"b2424\">View Details</a>";
		$output.="</div>";
		$output.="</div>";
		}
		
		}
		$output.="<a href=\"#\" class=\"b25\">VIEW MORE HOLIDAY PACKAGES</a>
</div>";
				return $output;
	}
	
function find_package_type_by_id_public($package_type_id){
		global $connection;
		$query="SELECT * FROM package_types WHERE visible=1 AND id=".$package_type_id;
		$result=mysqli_query($connection,$query);
		if($result){return mysqli_fetch_assoc($result);}
			else{die("function find_package_type_by_id failed ".$query);}
	}

function find_top_three_packages_by_package_type_id_public($package_type_id){
		global $connection;
		$query="SELECT * FROM packages ";
		$query.="WHERE pack_type_id=".$package_type_id." ";
		$query.="AND visible=1 ";
		$query.="ORDER BY position ";
		$query.="LIMIT 3";
		$result=mysqli_query($connection,$query);
		if($result){
			return $result;
			}else{
				//die("function find_top_three_packages_by_package_type_id Failed ".$query);
				echo "Sorry no such function exist";
				}
	}		
function find_package_by_package_id_public($package_id){
		
	global $connection;
	$query="SELECT * FROM packages ";
	$query.="WHERE id=".$package_id." ";
	$query.="AND visible=1";
	$result=mysqli_query($connection,$query);
	if($result){
	return mysqli_fetch_assoc($result);}
	else{
		die("sorry  function find_package_by_package_id_public failed".$query);
		}
	}
function find_hotel_by_hotel_id_public($hotel_id){
		global $connection;
	$query="SELECT * FROM hotels ";
	$query.="WHERE id=".$hotel_id." ";
	$query.="AND visible=1";
	$result=mysqli_query($connection,$query);
	if($result){
	return mysqli_fetch_assoc($result);}
	else{
		die("sorry  function find_hotel_by_hotel_id_public failed".$query);
		}
	}
function find_hotel_by_package_id_public($package_id){
		$package=find_package_by_package_id_public($package_id);
		$hotel=find_hotel_by_hotel_id_public($package["hotel_id"]);
		return $hotel;
	}	
function central_display_selected_destination_none_hotel_public1($destination_id){
	$destination=find_destination_by_id_public($destination_id);
	$output="<h1 class=\"b21\">".$destination["destination"]."</h1>";
	$output.="<div class=\"b22\">";
		$output.="<div class=\"b22a\";>";
				
  				$output.="<img src=\"".$destination["image"]."\" class=\"b221\"/>";
				
				$output.="</div>";
				
				$output.="<p class=\"b222\">";

				$output.=nl2br($destination["description"]); 
 				$output.="</p>";
 				$output.="<a href=\"https://www.google.co.in/\" class=\"b224\">Read More</a>"; 
				$output.="</div>";
				return $output;
	}
function central_display_selected_destination_none_hotel_public2($destination_id,$package_type_id){
	global $connection;
	$destination=find_destination_by_id_public($destination_id);
		$all_packages=find_all_package_types_public();
		$package_type=find_package_type_by_id_public($package_type_id);
		$top_three_packages=find_top_three_packages_by_package_type_id_and_destination_id_public($package_type["id"],$destination["id"]);
		$output="<div class=\"b23cover\">";
		$output.="<div class=\"b23\">";
		$output.="<div class=\"b231\">";
    	$output.="<h1 class=\"b2311\">Featured ".$package_type["package_type"]." at ".$destination["destination"]."</h1>";
    	$output.="</div>";
    	$output.="<div class=\"b232\">";
    	while($a_package=mysqli_fetch_assoc($all_packages)){
				$output.="<a href=\"index.php?package_type={$a_package["id"]}&destination={$destination["id"]}\" class=\"b2321 ";
				if($package_type_id==$a_package["id"]){
					$output.="b2321_selected";
					}
				$output.="\"></a>";
			}
		$output.="</div>";
		$output.="</div>";
		if(isset($top_three_packages))
		{
			while($a_top_package=mysqli_fetch_assoc($top_three_packages)){
		$output.="<div class=\"b24\">";
		$hotel=find_hotel_by_package_id_public($a_top_package["id"]);
		$output.="<img src=\"".$hotel["thumb_image"]."\" class=\"b241\" />";
		$output.="<div class=\"b242\">";
		$output.="<h1 class=\"b2421\">".$a_top_package["pack_type"]." ".$a_top_package["pack_duration"]."</h1>";
		$output.="<div class=\"b2422cover\"><p class=\"b2422\">".nl2br($a_top_package["pack_description"])."</p></div>";
		$output.="<h1 class=\"b2423\">Rs.".$a_top_package["rate"]."</h1>";
		$output.="<a href=\"https://www.google.co.in/\" class=\"b2424\">View Details</a>";
		$output.="</div>";
		$output.="</div>";
		}
		
		}
		$output.="<a href=\"#\" class=\"b25\">VIEW MORE HOLIDAY PACKAGES</a>
</div>";
				return $output;
	}

function find_top_three_packages_by_package_type_id_and_destination_id_public($package_type_id,$destination_id){
		global $connection;
		$query="SELECT * FROM packages ";
		$query.="WHERE pack_type_id=".$package_type_id." ";
		$query.="AND dest_id={$destination_id} ";
		$query.="AND visible=1 ";
		$query.="ORDER BY position ";
		$query.="LIMIT 3";
		$result=mysqli_query($connection,$query);
		if($result){
			return $result;
			}else{
				die("find_top_three_packages_by_package_type_id_and_destination_id_public Failed ".$query);
				
				}
	}	
function central_display_selected_hotel_public1($hotel_id){
	$hotel=find_hotel_by_id_public($hotel_id);
	$output="<h1 class=\"b21\">".$hotel["name"]."</h1>";
	$output.="<div class=\"b22\">";
		$output.="<div class=\"b22a\";>";
				
  				$output.="<img src=\"".$hotel["image"]."\" class=\"b221\"/>";
				
				$output.="</div>";
				
				$output.="<p class=\"b222\">";

				$output.=nl2br($hotel["description"]); 
 				$output.="</p>";
 				$output.="<a href=\"https://www.google.co.in/\" class=\"b224\">Read More</a>"; 
				$output.="</div>";
				return $output;
	}	
function central_display_selected_hotel_public2($hotel_id,$package_type_id){
	global $connection;
	$hotel=find_hotel_by_id_public($hotel_id);
		$all_packages=find_all_package_types_public();
		$package_type=find_package_type_by_id_public($package_type_id);
		$top_three_packages=find_top_three_packages_by_package_type_id_and_hotel_id_public($package_type["id"],$hotel["id"]);
		$output="<div class=\"b23cover\">";
		$output.="<div class=\"b23\">";
		$output.="<div class=\"b231\">";
    	$output.="<h1 class=\"b2311\">Featured ".$package_type["package_type"]." at ".$hotel["name"]."</h1>";
    	$output.="</div>";
    	$output.="<div class=\"b232\">";
    	while($a_package=mysqli_fetch_assoc($all_packages)){
				$output.="<a href=\"index.php?package_type={$a_package["id"]}&hotel={$hotel["id"]}\" class=\"b2321 ";
				if($package_type_id==$a_package["id"]){
					$output.="b2321_selected";
					}
				$output.="\"></a>";
			}
		$output.="</div>";
		$output.="</div>";
		if(isset($top_three_packages))
		{
			while($a_top_package=mysqli_fetch_assoc($top_three_packages)){
		$output.="<div class=\"b24\">";
		$hotel=find_hotel_by_package_id_public($a_top_package["id"]);
		$output.="<img src=\"".$hotel["thumb_image"]."\" class=\"b241\" />";
		$output.="<div class=\"b242\">";
		$output.="<h1 class=\"b2421\">".$a_top_package["pack_type"]." ".$a_top_package["pack_duration"]."</h1>";
		$output.="<div class=\"b2422cover\"><p class=\"b2422\">".nl2br($a_top_package["pack_description"])."</p></div>";
		$output.="<h1 class=\"b2423\">Rs.".$a_top_package["rate"]."</h1>";
		$output.="<a href=\"https://www.google.co.in/\" class=\"b2424\">View Details</a>";
		$output.="</div>";
		$output.="</div>";
		}
		
		}
		$output.="<a href=\"#\" class=\"b25\">VIEW MORE HOLIDAY PACKAGES</a>
</div>";
				return $output;
	}	
function find_top_three_packages_by_package_type_id_and_hotel_id_public($package_type_id,$hotel_id){
		global $connection;
		$query="SELECT * FROM packages ";
		$query.="WHERE pack_type_id=".$package_type_id." ";
		$query.="AND hotel_id={$hotel_id} ";
		$query.="AND visible=1 ";
		$query.="ORDER BY position ";
		$query.="LIMIT 3";
		$result=mysqli_query($connection,$query);
		if($result){
			return $result;
			}else{
				die("find_top_three_packages_by_package_type_id_and_destination_id_public Failed ".$query);
				
				}
	}	
function navigation_destinations($destination_id=null){
	$destination_set=find_all_destinations();
	$output="<ul class=\"b11\">";
	$output.="<h1 class=\"b111\">Destinations <span><a href=\"add_destination.php\" class=\"add\">add+</a></span></h1>";
	while($destination=mysqli_fetch_assoc($destination_set)){
		$output.="<li class=\"b112 ";
		if($destination_id==$destination["id"]){
		$output.="b112_selected";	
			}
		$output.="\"><a href=\"manage_content.php?destination=".url_prep($destination["id"])."\">".($destination["destination"])."</a></li>";
		}
	$output.="</ul>";
	//$output.="<br/><hr>";
	return $output;
	}		
function find_all_destinations(){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM destinations ";
	$query.=" ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		return $result;
		}else{
			echo "Database query  for function find _all_destinations_public failed".$query;
			}
	
	}	
function navigation_hotels($destination_id=1,$hotel_id=null){
		
		$hotel_set=find_hotels_by_destination_id($destination_id);
		//die ( "{$destination_id}" );
		$output="<br/><hr>";
		$output.="<ul class=\"b12\">";
		$output.="<h1 class=\"b111\">Hotels<span ><a href=\"add_hotel.php?destination={$destination_id}\" class=\"add\">add+</a></span></h1>";
	while($hotel=mysqli_fetch_assoc($hotel_set)){
		$output.="<li class=\"b112 ";
		if($hotel_id==$hotel["id"]){
		$output.="b112_selected";	
			}
		$output.="\"><a href=\"manage_content.php?hotel=".url_prep($hotel["id"])."\">".$hotel["name"]."</a></li>";
		}
		

	$output.="</ul>";
	return $output;
	}		

	
function find_hotels_by_destination_id($destination_id=1){
	global $connection;
	$query ="SELECT * " ;
	$query.="FROM hotels ";
	$query.="WHERE dest_id={$destination_id} ";
	$query.="ORDER BY position";
	$result=mysqli_query($connection,$query);
	if($result){
		return $result;
				}else{
			echo "Database query for function find_hotels_by_destination_id failed ".$query;
			}
	}	

function display_destination($destination){
	global $connection;
	$output="<br/><br/><div>";
	$output.="<table>";
	$output.="<tr><td><h5>Destination :</h6></td><td><h4>{$destination["destination"]}</h4></td></tr>";
	$output.="<tr><td><h5>Id</h5></td><td><h4>{$destination["id"]}</h4></td></tr>";
	$output.="<tr><td><h5>Position</h5></td><td><h4>{$destination["position"]}</h4></td></tr>";
	if($destination["visible"]==1){
			$output.="<tr><td><h5>Visible</h5></td><td><h5>Yes</h5></td></tr>";
		}else{
				$output.="<tr><td><h5>Visible</h5></td><td><h5>No</h5></td></tr>";
			}
	$output.="<tr><td><h5>Image</h5></td><td><img src=\"{$destination["image"]}\" class=\"big_image\"></img></td></tr>";
	$output.="<tr><td></td><td><h4>{$destination["image"]}</h4></td></tr>";
	$output.="<tr><td><h5>Description</h5></td><td><p class=\"b222\">{$destination["description"]}</p></td></tr>";
	$output.="<tr><td><a href=\"edit_destination.php?destination={$destination["id"]}\"  class=\"add\">Edit...</a></td>
	<td><a href=\"delete_destination.php?destination={$destination["id"]}\"  class=\"add\" onclick=\"return confirm('Are you sure')\" ;>Delete...</a></td>
	</tr>";
	$output.="</table></div>";
	$output.="<br/><br/><br/>";
	
	return $output;
	}
function display_hotel_and_its_packages($hotel,$destination){
	
	global $connection;
	$output="<br/><br/><div>";
	$output.="<table>";
	$output.="<tr><td><h5>Hotel :</h6></td><td><h4>{$hotel["name"]}</h4></td></tr>";
	$output.="<tr><td><h5>Id</h5></td><td><h4>{$hotel["id"]}</h4></td></tr>";
	$output.="<tr><td><h5>Destination :</h6></td><td><h4>{$destination["destination"]} ({$destination["id"]})</h4></td></tr>";
	$output.="<tr><td><h5>Position</h5></td><td><h4>{$hotel["position"]}</h4></td></tr>";
	if($hotel["visible"]==1){
			$output.="<tr><td><h5>Visible</h5></td><td><h5>Yes</h5></td></tr>";
		}else{
				$output.="<tr><td><h5>Visible</h5></td><td><h5>No</h5></td></tr>";
			}
	$output.="<tr><td><h5>thumb_mage</h5></td><td><img src=\"{$hotel["thumb_image"]}\"></img></td></tr>";
	$output.="<tr><td></td><td><h4>{$hotel["thumb_image"]}</h4></td></tr>";
	$output.="<tr><td><h5>Short description</h5></td><td><p class=\"b222\">{$hotel["short_description"]}</p></td></tr>";
	$output.="<tr><td><h5>Image</h5></td><td><img src=\"{$hotel["image"]}\" class=\"big_image\"></img></td></tr>";
	$output.="<tr><td></td><td><h4>{$hotel["image"]}</h4></td></tr>";
	
	$output.="<tr><td><h5>Description</h5></td><td><p class=\"b222\">{$hotel["description"]}</p></td></tr>";
$output.="<tr><td><a href=\"edit_hotel.php?hotel={$hotel["id"]}\" class=\"add\">Edit</a></td><td><a href=\"delete_hotel.php?hotel={$hotel["id"]}\" class=\"add\" onclick=\"return confirm('Are you sure')\" ;>Delete</a></td></tr>";	
	$output.="<tr><td><a href=\"add_package_type.php\"  class=\"add\">Add package type...</a></td>
				<td><a href=\"delete_package_type.php\"  class=\"add\" onclick=\"return confirm(\'Are you sure\')\" ;>Delete package type...</a></td>
	</tr>";
	$output.="</table></div>";
	$output.="<br/><br/><br/>";
	
	return $output;
	
	}
function navigation_packages($hotel_id=1){
	
	$package_type_set=find_all_package_types();
	$output="<div class=\"b32\">";
	while($package_type=mysqli_fetch_assoc($package_type_set)){
		//echo $package["package_type"]."<br/>";
		$output.="<ul class=\"b12 r1\">";
		$output.="<h1 class=\"b111 r11\">{$package_type["package_type"]}<span><a href=\"add_package.php?package_type={$package_type["id"]}&hotel={$hotel_id}\" class=\"add\">Add..</a></span></h1>";
		$package_set=find_packages_by_package_type_id_and_hotel_id($package_type["id"],$hotel_id);
		while($package=mysqli_fetch_assoc($package_set)){
			$output.="<li class=\"b112 ri2\"><a href=\"package_display.php?package={$package["id"]}\">".$package["pack_type"]." ".$package["pack_duration"]." </a></li>";
			}
		$output.="</ul>";	
		}$output.="</div>";
		return $output;
	
	}	
function find_all_package_types(){
	global $connection;
	$query="SELECT * FROM package_types ";
	$query.="ORDER BY id";
	$result=mysqli_query($connection,$query);
	if($result){
	return $result;}
	else{
		die("sorry  function find_all_package_types_public failed".$query);
		}
	}
function find_packages_by_package_type_id_and_hotel_id($package_type_id,$hotel_id){
	
	global $connection;
	$query="SELECT * FROM packages ";
	$query.="WHERE hotel_id=".$hotel_id." ";
	$query.="AND pack_type_id=".$package_type_id." ";
	$result=mysqli_query($connection,$query);
	if($result){
	return $result;}
	else{
		die("sorry  function find_packages_by_package_type_id_and_hotel_id_public failed".$query);
		}
	}
function find_package_by_package_id($package_id){
	
	global $connection;
	$query="SELECT * FROM packages ";
	$query.="WHERE id=".$package_id." ";
	$result=mysqli_query($connection,$query);
	if($result){
	return mysqli_fetch_assoc($result);}
	else{
		die("sorry  function find_package_by_package_id failed".$query);
		}
	}	
function display_package_public($package){
	$destination=find_destination_by_id_public($package["dest_id"]);
	$hotel=find_hotel_by_id_public($package["hotel_id"]);
	$output="<br/><br/><div>";
	$output.="<table>";
	$output.="<tr><td><h5>Id</h5></td><td><h4>{$package["id"]}</h4></td></tr>";
	$output.="<tr><td><h5>Package Name</h5></td><td><h4>{$package["pack_type"]}</h4></td></tr>";
	$output.="<tr><td><h5>Duration</h5></td><td><h4>{$package["pack_duration"]}</h4></td></tr>";
	$output.="<tr><td><h5>Rate</h5></td><td><h4>{$package["rate"]}</h4></td></tr>";
	$output.="<tr><td><h5>Position</h5></td><td><h4>{$package["position"]}</h4></td></tr>";
	$output.="<tr><td><h5>Hotel :</h5></td><td><h4>{$hotel["name"]}({$hotel["id"]})</h4></td></tr>";
	//$output.="<tr><td><h5>Hotel :</h5></td><td><h4>{$hotel["name"]}({$hotel["id"]})</h4></td></tr>";
	$output.="<tr><td><h5>Destination :</h5></td><td><h4>{$destination["destination"]}({$destination["id"]})</h4></td></tr>";
	$output.="<tr><td></td><td><img src=\"{$hotel["image"]}\" class=\"big_image\"/></td></tr>";
	//if($package["visible"]==1){
			//$output.="<tr><td><h5>Visible</h5></td><td><h5>Yes</h5></td></tr>";
		//}else{
				//$output.="<tr><td><h5>Visible</h5></td><td><h5>No</h5></td></tr>";
			//}
	$output.="<tr><td><h5>Description</h5></td><td><p class=\"b222\">{$package["pack_description"]}</p></td></tr>";
	
	$output.="</table></div>";
	$output.="<br/><br/><br/>";
	
	return $output;
	}	
	
function display_package($package){
	$destination=find_destination_by_id_public($package["dest_id"]);
	$hotel=find_hotel_by_id_public($package["hotel_id"]);
	$output="<br/><br/><div>";
	$output.="<table>";
	$output.="<tr><td><h5>Id</h5></td><td><h4>{$package["id"]}</h4></td></tr>";
	$output.="<tr><td><h5>Package Name</h5></td><td><h4>{$package["pack_type"]}</h4></td></tr>";
	$output.="<tr><td><h5>Duration</h5></td><td><h4>{$package["pack_duration"]}</h4></td></tr>";
	$output.="<tr><td><h5>Rate</h5></td><td><h4>{$package["rate"]}</h4></td></tr>";
	$output.="<tr><td><h5>Position</h5></td><td><h4>{$package["position"]}</h4></td></tr>";
	$output.="<tr><td><h5>Hotel :</h5></td><td><h4>{$hotel["name"]}({$hotel["id"]})</h4></td></tr>";
	$output.="<tr><td><h5>Destination :</h5></td><td><h4>{$destination["destination"]}({$destination["id"]})</h4></td></tr>";
	$output.="<tr><td></td><td><img src=\"{$hotel["image"]}\" class=\"big_image\"/></td></tr>";
	if($package["visible"]==1){
			$output.="<tr><td><h5>Visible</h5></td><td><h5>Yes</h5></td></tr>";
		}else{
				$output.="<tr><td><h5>Visible</h5></td><td><h5>No</h5></td></tr>";
			}
	$output.="<tr><td><h5>Description</h5></td><td><p class=\"b222\">{$package["pack_description"]}</p></td></tr>";
	$output.="<tr><td><a href=\"edit_package.php?package={$package["id"]}\" class=\"add\">Edit</a></td><td><a href=\"delete_package.php?package={$package["id"]}\" class=\"add\" onclick=\"return confirm ('Are you sure')\";>Delete</a></td></tr>";
	$output.="</table></div>";
	$output.="<br/><br/><br/>";
	
	return $output;
	}		
	
function find_package_by_id($package_id){
	global $connection;
	$query="SELECT * FROM packages ";
	$query.="WHERE visible=1 ";
	$query.="AND id={$package_id}";
	$result=mysqli_query($connection,$query);
	if($result){
		return mysqli_fetch_assoc($result);
		}
		else{
			echo "function find_package_by_id failed ".$query;
			}
	}	
function find_all_packages(){
	
	global $connection;
	$query="SELECT * FROM packages ";
	$result=mysqli_query($connection,$query);
	if($result){
	return $result;}
	else{
		die("sorry  function find_packages_by_package_type_id_and_hotel_id_public failed".$query);
		}
	}
	
function attempt_login($user_name,$password){
												$admin=find_admin_by_username($user_name);
												if($admin){   if( password_check($password,$admin["password"])){ return $admin;
																												} else { return false;
																														}
															} else { return false;
																	}										
											}




function password_check	($password,$existing_hash){
													$hash=crypt($password,$existing_hash);
													if($hash ===$existing_hash){
													return true;
			}
		else{
			return false;
			}	
		
		}


function password_encrypt($password){
										$hash_format="$2y$10$";//Tells PHP to use Blowfish with a "cost" of 10
										$salt_length=22;//Blowfish salts should be 22-characters or more
										$salt=generate_salt($salt_length);
										$format_and_salt =$hash_format . $salt;
										$hash=crypt($password,$format_and_salt);
										return $hash;
										
	}

function generate_salt($length){
	
	//Not 100% unique ,not 100% random, but good enough for a salt
		//MD5 returns 32 characters
		$unique_random_string=md5(uniqid(mt_rand(),true));
		//Valid characters for a salt are [a-zA-Z0-9./]
		$base64_string=base64_encode($unique_random_string);
		//But not '+' which is valid in base64 encoding
		$modified_base64_string=str_replace('+','.',$base64_string);
		//Truncate string to correct length
		$salt=substr($modified_base64_string,0,$length);
		
		return $salt;
	}
function find_admin_by_username($username){
	global $connection;
	$admin_id=query_prep($username);
	$query="SELECT * FROM admins WHERE username = '{$username}'";
	$admin_set=mysqli_query($connection,$query);
	confirm_query($admin_set);
	if($admin=mysqli_fetch_assoc($admin_set)){
		return $admin;
		//die("username found");
		}
		else{
			die("username not found");
			//return null;
			}
	return($admin_set);
	
	}	
function confirm_query($result_set){
		if(!$result_set){
		//die("Database query failed.");
		}
		}	
?>
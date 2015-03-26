<?php

$errors=array();
function fieldname_as_text($fieldname){
	$fieldname=str_replace("_"," ",$fieldname);
	$fieldname=ucfirst($fieldname);
	return $fieldname;
	
	}
function has_presence($value){
	return isset($value) && $value !=="";
	}
function validate_presences($required_fields){
	//expects an array
	global $errors;
	foreach($required_fields as $field){
		
										if(isset($_POST[$field])){
																	$value=trim($_POST[$field]);
																}
										elseif(isset($_GET[$field])){
																	$value=trim($_GET[$field]);
																}


																	else{
																		$value=null;
																		}
																		if(!has_presence($value))
																		{
																			$errors[$field]=fieldname_as_text($field)." : can't be blank";
			
																			//return false;
			
																		}
									}
			
										}	

function has_max_length($value,$max){
	return strlen($value) <= $max;
	}	
function validate_max_lengths($fields_with_max_lengths){
		global $errors;
		//Expect an assoc array
		foreach($fields_with_max_lengths as $field => $max){
			if(isset($_POST[$field]))
				{$value = trim($_POST[$field]);}
				elseif
					(isset($_GET[$field]))
						{$value = trim($_GET[$field]);}
			if(!has_max_length($value,$max)){
				$errors[$field]= fieldname_as_text($field)." : is too long";
				
				}
			}
	}		
function has_inclusion_in($value,$set){
	return in_array($value,$set);
	}	
	//$errors["boby"]="Aloshy";
//	echo form_errors($errors);
function form_errors($errors=array()){
	$output="";
	if(!empty($errors)){
		$output .="<div class=\"message\">";
		$output.="Please fix the following errors:";
		$output.="<ul >";
		foreach($errors as $errorname =>$error){
			$output .="<li >{$error}</li>";
			
			}
			$output.="</ul>";
			$output.="</div>";
		}
	return $output;
	}	
?>
<?php
session_start();

function session_display(){
	if(isset($_SESSION["message"])){
	echo "<div><h1 class=\"message\">{$_SESSION["message"]}</h1></div>";
	$_SESSION["message"]=null;
	}
	
	}

?>
<?php
//Create database connection
	define("DB_SERVER","your_server");
	define("DB_USER","your_username");
	define("DB_PASS","your_password");
	define("DB_NAME","your_database_name");
	$connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	//Test if conection succeded
	if(mysqli_connect_errno()){
		die("Database connection failed ".mysqli_connect_error(). " ( ".mysqli_connect_errno())." )";
	}else{
			//echo "SUCCESS";
			}
		
		

?>
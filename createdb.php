<?php
	//creates the db and the table to store messages
   try{
		$db = new PDO('sqlite:test.db');
		
		$sql ="
		  CREATE TABLE IF NOT EXISTS MESSAGES 
		  (ID INTEGER PRIMARY KEY AUTOINCREMENT,
		  USER TEXT NOT NULL,
		  MESSAGE TEXT NOT NULL,
		  TIME TIMESTAMP NOT NULL DEFAULT((julianday('now') - 2440587.5)*86400.0))";
		
		$ret = $db->exec($sql);
		echo "Database created successfully!";
   }
   catch(PDOException $e){
	    die('Failed to execute query:'. $e->getMessage());
   }

   $db=null;

?>


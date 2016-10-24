<?php
   try{
		$db = new PDO('sqlite:test.db');
		}
   catch(PDOException $e){
		die('Failed to connect:'. $e->getMessage());
		}
	//check to see if the ajax call was to update db
	
	if (isset($_POST['text'])){
		session_start();
		
		//if user has logged in use his name, else use "guest"
		$us='Guest';
		if (isset($_SESSION['username']))
			$us=$_SESSION['username'];
		session_write_close();
		$msg=$_POST['text'];
   
		$sql ="INSERT INTO MESSAGES (USER,MESSAGE) VALUES(?, ?)";
			
		try{
			$ret = $db->prepare($sql);
			$ret->execute([$us,$msg]);
		}
		catch(PDOException $e){
			console.log('Failed to update db:'. $e->getMessage());
		}
	}
	
	else{
		//the script will run for 20 seconds after the initial ajax call
		$time=time()+20;
		
		while(time()<$time){
			if ($_POST['time']){
				$prevtime=$_POST['time'];
			}
			else {
				$prevtime=0;
			}
			//query to see if there are new messages
			
			$sql ="SELECT TIME,USER,MESSAGE FROM MESSAGES WHERE TIME>? ORDER BY TIME ASC";
			
			try{
				$ret = $db->prepare($sql);
				$ret->execute([$prevtime]);
				
				$resarr = $ret->fetchAll(PDO::FETCH_ASSOC);
				
				//if there are no new messages in the db, sleep for half a second and then run loop again
				if (!$resarr)
					sleep(0.5);
				else{
					echo json_encode($resarr);
					break;
				}
			}
			catch(PDOException $e){
				console.log('Failed to get messages:'. $e->getMessage());
			}
		}
	}
   $db=null;

?>
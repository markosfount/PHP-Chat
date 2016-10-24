<?php
	session_start();
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Chat application</title>
		<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="chat.js" defer="true"></script>
		<link rel="stylesheet" type="text/css" href="./chat.css">
		
</head>

<div id="container">

	<div id='header'>
		<h2>Bunq Assignment: Simple Chat</h2>
	</div>
	
	<?php
	//check if a session is set, else prompt for user's name (user can write as guest as well)
		if (isset($_SESSION['username'])){
			echo "<a href='session.php'>Logout</a>";
			$usn=$_SESSION['username'];
			echo "<p>Welcome, $usn</p>";
		}
		else{
			echo "<p>Give your name or send a message as Guest.</p>";?>
			
			<div id='namebox'>
				<form action="session.php?$set=1" id="givename" method="post" onsubmit="if ($('#nametext')[0].value=='' || $('#nametext')[0].value.length>8) return false;">
					<input type='text' placeholder='Name' name='Givename' id='nametext'/>
					<input type='submit' name='submit_button' value='Submit' id='namesubmit'/>
				</form>
			</div>
	<?php	} 
	?>
	
    <div id="chat-wrap">
		<form id="message_form">
			<p>Your message: </p>
			<textarea id="writehere" maxlength = '100' ></textarea>
		</form>
	</div>
	
    <?//the area where messages are displayed is empty at first
	 //new messages are appended with JS ?>
	<div id="messages" >
		
	</div>

</div>
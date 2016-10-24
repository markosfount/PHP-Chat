<?php
	session_start();
	if ($_GET['$set']==1){
		$_SESSION['username']=htmlspecialchars($_POST['Givename']);
	header('Location:chat.php');
	}
	else{
		session_unset();
		header('Location:chat.php');
	}
?>
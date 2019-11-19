<?php
session_start();

if(empty($_POST['username'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Username is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['password'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Password is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else {
	$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
	$result = $conn->query("SELECT `znum`, `password_hash` from Users where `username` = '" . $_POST['username'] . "'");
	
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			if(password_verify($_POST['password'], $row['password_hash'])) {
				$_SESSION['znum'] = $row['znum'];
				header('Location:../dashboard.php');
				die();
			}
			else {
				if(!isset($_SESSION['alerts'])) {
					$_SESSION['alerts'] = array();
				}
				array_push($_SESSION['alerts'], array('danger', 'Invalid username/password.'));
				header('Location:' . $_SERVER['HTTP_REFERER']);
				die();
			}
		}
	} else {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('danger', 'Invalid username/password.'));
		header('Location:' . $_SERVER['HTTP_REFERER']);
		die();
	}
	$conn->close();
}
?> 
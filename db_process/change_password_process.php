<?php
session_start();

if(empty($_POST['currentPassword'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Current password is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['newPassword'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'New password is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['confirmNewPassword'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Confirm new password is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(strlen($_POST['newPassword']) < 8) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'New password must be at least 8 characters.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if($_POST['newPassword'] != $_POST['confirmNewPassword']) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'New passwords do not match.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else {
	$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
	$result = $conn->query("SELECT `password_hash` from Users where `znum` = '" . $_SESSION['znum'] . "'");
	
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			if(password_verify($_POST['currentPassword'], $row['password_hash'])) {
				
				$sql = "UPDATE Users SET password_hash = '" . password_hash($_POST['newPassword'], PASSWORD_DEFAULT) . "' WHERE znum = " . $_SESSION['znum'];
				
				if ($conn->query($sql) === TRUE) {
					if(!isset($_SESSION['alerts'])) {
						$_SESSION['alerts'] = array();
					}
					array_push($_SESSION['alerts'], array('success', 'Password has been changed successfully.'));
					header('Location:../dashboard.php');
					die();
				} else {
					if(!isset($_SESSION['alerts'])) {
						$_SESSION['alerts'] = array();
					}
					array_push($_SESSION['alerts'], array('danger', $conn->error));
					header('Location:' . $_SERVER['HTTP_REFERER']);
					die();
				}
			}
			else {
				if(!isset($_SESSION['alerts'])) {
					$_SESSION['alerts'] = array();
				}
				array_push($_SESSION['alerts'], array('danger', 'The current password entered is incorrect.'));
				header('Location:' . $_SERVER['HTTP_REFERER']);
				die();
			}
		}
	} else {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('danger', 'Unable to process request.'));
		header('Location:' . $_SERVER['HTTP_REFERER']);
		die();
	}
	$conn->close();
}
?> 
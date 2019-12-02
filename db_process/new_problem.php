<?php
require('../session_info.php');
error_reporting(E_ALL);
ini_set('display_errors',1);

if(empty($_POST['description'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Description is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else if(empty($_POST['location'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Location is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else {
	if(!empty($_FILES['uploadPhoto']['size'])){
		$uniq_id = uniqid();
		$file_name = $_FILES['uploadPhoto']['name'];
		$file_size = $_FILES['uploadPhoto']['size'];
		$file_tmp = $_FILES['uploadPhoto']['tmp_name'];
		$file_type = $_FILES['uploadPhoto']['type'];
		$explode = explode('.', $_FILES['uploadPhoto']['name']);
		$file_ext = strtolower(end($explode));

		$extensions = array('jpeg', 'jpg', 'png');

		if(!in_array($file_ext,$extensions)){
			if(!isset($_SESSION['alerts'])) {
				$_SESSION['alerts'] = array();
			}
			array_push($_SESSION['alerts'], array('danger', 'File extension not allowed. Please choose a JPEG or PNG file.'));
			header('Location:' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		if(move_uploaded_file($_FILES['uploadPhoto']['tmp_name'], '../photos/' . $uniq_id . '.' . $file_ext) === false) {
			die();
			if(!isset($_SESSION['alerts'])) {
				$_SESSION['alerts'] = array();
			}
			array_push($_SESSION['alerts'], array('danger', 'Unable to upload file: ' . basename($_FILES['uploadPhoto']['tmp_name']) . '.' . $file_ext . ' to ' . '../photos/' . $uniq_id . '.' . $file_ext));
			array_push($_SESSION['alerts'], array('danger', $_FILES['uploadPhoto']['error']));
			header('Location:' . $_SERVER['HTTP_REFERER']);
			die();
		}
	}
	
	$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
	$sql = "INSERT INTO Issues (reported_by, date_time_reported, title, location, type, description, priority, status, photo_file_name) VALUES ('" . $_SESSION['znum'] . "', NOW(), '" . $_POST['title'] . "', '" . $_POST['location'] . "', 1, '" . $_POST['description'] . "', " . $_POST['priority'] . ", 0, " . (isset($uniq_id) ? "'" . $uniq_id . '.' . $file_ext . "'" : "NULL") . ")";
	
	if ($conn->query($sql) === TRUE) {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('success', 'The problem has been reported successfully.'));
		header('Location:../view_problems.php');
		die();
	} else {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('danger', $conn->error));
		header('Location:' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	$conn->close();
}
?>
<?php
session_start();

if(empty($_POST['title'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Title is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['location'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Location is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['reportedBy'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Reported by person must be selected.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['priority'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Priority must be selected.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['status'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Status must be selected.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else {
	$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
	$sql = "UPDATE Issues SET title = '" . $_POST['title'] . "', location = '" . $_POST['location'] . "', reported_by = " . $_POST['reportedBy'] . ", priority = " . $_POST['priority'] . ", status = " . $_POST['status'] . " WHERE entry_id = " . $_POST['problemID'];
	if ($conn->query($sql) === TRUE) {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('success', 'Campus problem has been updated successfully.'));
		header('Location:../problem_detail.php?id=' . $_POST['problemID']);
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
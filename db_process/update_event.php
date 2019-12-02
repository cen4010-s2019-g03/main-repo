<?php
session_start();

if(empty($_POST['eventName'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event name is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['location'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event location is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['dateTime'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event date and time are required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
if(empty($_POST['hostedBy'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event host is required.'));
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
	$sql = "UPDATE Events SET event_name = '" . $_POST['eventName'] . "', event_location = '" . $_POST['location'] . "', created_by = " . $_POST['hostedBy'] . ", event_date = '" . date('Y-m-d', strtotime($_POST['dateTime'])) . "', event_time = '" . date('H:i:s', strtotime($_POST['dateTime'])) . "', event_status = " . $_POST['status'] . " WHERE event_id = " . $_POST['eventID'];
	if ($conn->query($sql) === TRUE) {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('success', 'Event has been updated successfully.'));
		header('Location:../event_detail.php?id=' . $_POST['eventID']);
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
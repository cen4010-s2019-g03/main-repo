<?php
session_start();

if(empty($_POST['date']) or empty($_POST['hour']) or empty($_POST['minute']) or empty($_POST['AM_PM'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event date and time are required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else if(empty($_POST['location'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event location is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else if(empty($_POST['title'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event title is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else if(empty($_POST['description'])) {
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'Event description is required.'));
	header('Location:' . $_SERVER['HTTP_REFERER']);
	die();
}
else {
	$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
	$sql = "INSERT INTO Events (event_name, event_date, event_time, event_location, created_by) VALUES ('" . $_POST['title'] . "', '" . $_POST['date'] . "', '" . date('H:i:s', strtotime($_POST['hour'] . ':' . $_POST['minute'] . $_POST['AM_PM'])) . "', '" . $_POST['location'] . "', '" . $_SESSION['znum'] . "')";
	
	if ($conn->query($sql) === TRUE) {
		if(!isset($_SESSION['alerts'])) {
			$_SESSION['alerts'] = array();
		}
		array_push($_SESSION['alerts'], array('success', 'The event has been added successfully.'));
		header('Location:../upcoming_events.php');
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
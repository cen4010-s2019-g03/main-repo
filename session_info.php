<?php
session_start();
if(!isset($_SESSION['znum'])){
	if(!isset($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	array_push($_SESSION['alerts'], array('danger', 'You must be logged in to continue.'));
	header('Location:https://lamp.cse.fau.edu/~cen4010fal19_g03/login.php');
	die();
}
?>
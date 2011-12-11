<?php
	include_once('init.php');
	unset($_SESSION['login_status']);
	header('location:index.php');
?>
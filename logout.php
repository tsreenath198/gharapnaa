<?php
	include("includes/config.php");
	/* include("includes/functions.php");
	include("includes/session.php"); */
	session_destroy();
	header("location:".ROOT);
?>
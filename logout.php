<?php 
	require('/include/functions.php');
	session_start();
	clearSessionCookies();
	header( 'Location: /' );
?>
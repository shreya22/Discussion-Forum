<?php
session_start();

require("config.php");

$db= mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $config_forum; ?></title>
	<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>
	<div id="header">
	<h1><?php echo $config_forum; ?></h1>
	[<a href="index.php">HOME</a>]
	<?php

	if(isset($_SESSION['USERNAME']) == TRUE)
	{
		echo "[<a href='logout.php'>logout</a>]";
	}
	else{
		echo "[<a href='login.php'>login</a>]";
		echo "[<a href='register.php'>register</a>]";
	}

	?>

	[<a href="newtopic.php">New Topic</a>]
	</div>
	<div id="main">
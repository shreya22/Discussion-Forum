<?php
session_start();
require('config.php');
require('functions.php');



$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_POST['submit'])){
	$sql= "select * from users where username= '".$_POST['username']."' and password = '".$_POST['password']."';";
	$result = mysql_query($sql);
	$numrows = mysql_num_rows($result);
	
	if($numrows == 1) {
	$row = mysql_fetch_assoc($result);
	if($row['active'] == 1) {
//	session_register("USERNAME");
//	session_register("USERID");

	$_SESSION['USERNAME'] = $row['username'];
	$_SESSION['USERID'] = $row['id'];
	
	switch($_GET['ref']) {
		case "newpost":
			if(isset($_GET['id']) == FALSE) {
			header("Location: " . $config_basedir .
			"/newtopic.php");
		}
		else {
			header("Location: " . $config_basedir .
			"/newtopic.php?id=" . $_GET['id']);
		}
		break;
		case "reply":
		if(isset($_GET['id']) == FALSE) {
		header("Location: " . $config_basedir .
		"/newtopic.php");
		}
		else {
		header("Location: " . $config_basedir .
		"/newtopic.php?id=" . $_GET['id']);
		}
		break;
		default:
		header("Location: " . $config_basedir);
		break;
	}
	}
		else {
require("header.php");
echo "This account is not verified yet. You were emailed a link
to verify the account. Please click on the link in the email to
continue.";
}

}
else {
header("Location: " . $config_basedir . "/login.php?error=1");
}
}

else {
require("header.php");
if(isset($_GET['error'])) {
echo "Incorrect login, please try again!";
}
?>

<form action="<?php echo pf_script_with_get($_SERVER['REQUEST_URI']); ?>"
method="post">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Login!"></td>
		</tr>
	</table>
</form>
Don't have an account? Go and <a href="register.php">Register</a>!

<?php
}
require("footer.php");
?>
<?php
session_start();
require("config.php");
require("functions.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

$forchecksql = "SELECT * FROM forums;";
$forcheckresult = mysql_query($forchecksql);
$forchecknumrows = mysql_num_rows($forcheckresult);
if($forchecknumrows == 0) {
header("Location: " . $config_basedir);
}

if(isset($_GET['id']) == TRUE) {
if(is_numeric($_GET['id']) == FALSE) {
$error = 1;
}
if($error == 1) {
header("Location: " . $config_basedir);
}
else {

$validforum = $_GET['id'];
}
}
else {
$validforum = 0;
}

if(isset($_SESSION['USERNAME']) == FALSE) {
header("Location: " . $config_basedir . "/login.php?ref=newpost&id="
. $validforum);

if($_POST['submit']) {
if($validforum == 0) {
$topicsql = "INSERT INTO topics(date, user_id, forum_id, subject)
VALUES(NOW()
, " . $_SESSION['USERID']
. ", " . $_POST['forum']
. ", '" . $_POST['subject']
. "');";
}
else {
$topicsql = "INSERT INTO
topics(date, user_id, forum_id, subject) VALUES(NOW()
, " . $_SESSION['USERID']
. ", " . $validforum
. ", '" . $_POST['subject']
. "');";
}

mysql_query($topicsql);
$topicid = mysql_insert_id();



<form action="<?php echo pf_script_with_get($SCRIPT_NAME); ?>"
method="post">
<table>
<?php

if($validforum == 0){

$forumsql= "SELECT * FROM forums ORDER BY name;";
$forumsresult = mysql_query($forumssql);
?>

	<tr>
	<td>Forum</td>
	<td>
	<select name="forum">
	<?php
		while($forumsrow = mysql_fetch_assoc($forumsresult)) {
		echo "<option value='" . $forumsrow['id'] . "'>" .
		$forumsrow['name'] . "</option>";
		}
	?>
	</select>
	</td>
	</tr>
<?php
}
?>

<tr>
<td>Subject</td>
<td><input type="text" name="subject"></td>
</tr>
<tr>
<td>Body</td>
<td><textarea name="body" rows="10" cols="50"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Post!"></td>
</tr>
</table>
</form>
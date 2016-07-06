<?php
	include("config.php");
	if(isset($_GET['id']) == TRUE) {
	$error= 0;
	if(is_numeric($_GET['id']) == FALSE) {
	$error = 1;
	}
	
	if($error == 1) {
	header("Location: " . $config_basedir);
	}
	else {
	$validtopic = $_GET['id'];
	}
	}
	else {
	header("Location: " . $config_basedir);
	}
	require("header.php");
	
	$topicsql= "select topics.subject, topics.forum_id, forums.name from topics, forums where topics.forum_id= forums.id and topics.id= ".$validtopic;
	$topicresult= mysql_query($topicsql);
	
	$topicrow = mysql_fetch_assoc($topicresult);
	
	//adding subject of topic...
	
	echo "<h2>".$topicrow['subject']."</h2>";
	
	echo "<a href='index.php'>" . $config_forum
	. " forums</a> -> <a href='viewforum.php?id="
	. $topicrow['forum_id'] . "'>" . $topicrow['name']
	. "</a><br /><br />";
	
	$threadsql= "select messages.*, users.username from messages, users where messages.user_id= users.id and messages.topic_id= ".$validtopic." order by messages.date;";
	$threadresult= mysql_query($threadsql);
	
	echo "<table>";
	while($threadrow= mysql_fetch_assoc($threadresult))
	{
		echo "<tr><td><strong>Posted by <i>".$threadrow['username']." </i> on ".date("D jS F Y g.iA", strtotime($threadrow['date']))." -<i>".$threadrow['subject']."</i></strong></td></tr>";
		echo "<tr><td>".$threadrow['body']."</td></tr>";
		echo "<tr></tr>";
		

	}
	
	echo "<tr><td>[<a href='reply.php?id=" . $validtopic .
	"'>reply</a>]</td></tr>";
	echo "</table>";
	
	echo "</table>";
	require("footer.php");
?>
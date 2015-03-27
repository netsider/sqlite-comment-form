<?php
	session_start();
	date_default_timezone_set("America/New_york");
	$ip = $_SERVER['REMOTE_ADDR'];
	$sid = session_id();
	echo '<br/>';
	$TABLE = 'Comments';
	$db = new PDO('sqlite:test.db');
if (isset($_POST['submit'])){
   $t_result = $db->query("SELECT TIME FROM $TABLE WHERE SessID = '$sid' ORDER BY Time DESC"); // Lists all the times for current SessionIDs
   $t_array = array();
   //echo 'Times:';
   foreach($t_result as $row)
    {
		// echo $row[0];
		// echo '<br/>';
		$realtime = $row[0];
		array_push($t_array, $realtime); // Creates array of different times current user posted
	}
	if(isset($posts)){
	$posts = count($t_array);
	if (count($t_array) != 0){
	$last_post = max($t_array);
	$time_since = Time() - $last_post;
	}
	}
	// Debugging Information
	//echo '<br/>';
	//echo '<pre>';
	//print_r($t_array);
	//echo '</pre>';
	//echo '$posts: ' . $posts;
	//echo '<br/>';

	//echo 'Time Since Last: ' . $time_since;
	//echo '<br/>';
	//echo 'NOW: ' . Time();
	if(isset($_POST['TITLE'])){
		$TITLE = $_POST['TITLE'];
	}
	if(isset($_POST['DATE'])){
		$DATE = $_POST['DATE'];
	}
	if(isset($_POST['TEXT'])){
		$TEXT = $_POST['TEXT'];
	}
	if (strlen($_POST['TEXT']) > 0 && strlen($_POST['TITLE']) > 0){ // Comment Text field AND title contains at least one character
		if(isset($_SESSION['id'])){
		}
		$dupe = $db->query("SELECT COUNT(*) FROM $TABLE WHERE Title = '$TITLE'"); // Looks for Duplicate Titles
		$dupe2 = $db->query("SELECT COUNT(*) FROM $TABLE WHERE TextData = '$TEXT'"); // Looks for Duplicate Text
		$posts_ip = $db->query("SELECT COUNT(*) FROM $TABLE WHERE IP = '$ip'"); // $ of Posts by IP
		$duplicates = $dupe->fetchColumn();
		$duplicates += $dupe2->fetchColumn();
		echo 'IP: ' . $posts_ip->fetchColumn();

		if ($duplicates == 0){
				$db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Title VARCHAR, TextData TEXT, Date VARCHAR)");    
				$db->exec("ALTER TABLE $TABLE ADD COLUMN SessID VARCHAR");
				$db->exec("ALTER TABLE $TABLE ADD COLUMN IP VARCHAR");
				$db->exec("ALTER TABLE $TABLE ADD COLUMN Time VARCHAR");
				$Timex = Time(); // Get PHP's version of the time (Otherwise it'll use the database's)
				$db->exec("INSERT INTO $TABLE (TextData, Title, Date, SessID, Time, IP) VALUES ('$TEXT', '$TITLE', '$DATE', '$sid', '$Timex', '$ip');");
		}else{
			echo "<br/><font color=red>Duplicate Data Exists.</font><br/>";
			echo '<br/>Duplicates (of this message): ' . $duplicates; //Echo duplicate data
			echo '<br/>';
		}
if ($res = $db->query("SELECT COUNT(*) FROM $TABLE WHERE SessID = '$sid' ORDER BY Time DESC")) //Counts total number of rows matching criteria
{
//echo '<br/>Total Rows:';
$num_rows = $res->fetchColumn();
//echo $num_rows;
//echo '<br/>';
}}
}else{ // (If submit has NOT been pressed)
	$TEXT = "";
	$TITLE = "";
	$DATE = "";
}
	$TABLE = "Comments";
?>
<html xml:lang="en" lang="en">
<head>
	<title>Simple PHP SQLite Blog</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
<style>
#blogpost
{
	border: 1px solid black;
	width: 50%;
}
table{
border: none;
}
</style>
<body><center>
<h2>The Most Simple PHP/SQLite Blog Ever</h2>
<form method="post">
<table border="1" width="25%" bordercolor="blue" padding=1>
	<tr>
		<td>Title:</td>
		<td><input type="text" name="TITLE" size="60"/></td>
	</tr>
	<tr>
		<td>Date</td>
		<td><input type="text" name="DATE" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align=center><textarea name="TEXT" rows="6" cols="60"></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align=center><input type="submit" name="submit" value="Add Record" /></td>
	</tr>
</table>
</form>
<?PHP
    $result = $db->query("SELECT * FROM $TABLE");
	if(!empty($result)){
    foreach($result as $row)
    {
	  print '<div id=blogpost><table width="100%" border=0>';
	  print '<tr><td colspan=4>Date: ' . $row['Date'] . '</td></tr>';
      print "<tr><td colspan=4>Title: " . $row['Title'] . "</td></tr>";
	  print "<tr><td colspan=4 align=center>".$row['TextData'];
	  if ($row['SessID'] == $sid){
			$id = $row['Id'];
			echo '<br/><button><font color=red>Delete</font></button>';
	  }
	  echo "</td></tr>";
	  print "</table></div><br/><br/>";
    }
    $db = NULL;
	}
	echo '</center>';
?>
</body>
</html>
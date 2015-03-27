<?php
	session_start();
	date_default_timezone_set("America/New_york");
	$sid = session_id();
	if(setcookie('RUSSID', $sid, time()+5000, 1, 1)){
	}else{
		echo 'Cookie Failed to Set!';
	}
	//echo Time();
	echo '<br/>';

	$TABLE = 'Comments';
	$db = new PDO('sqlite:test.db');
if (isset($_POST['submit'])){
	
	if(isset($_POST['TITLE'])){
		$TITLE = $_POST['TITLE'];
	}
	if(isset($_POST['DATE'])){
		$DATE = $_POST['DATE'];
	}
	if(isset($_POST['TEXT'])){
		$TEXT = $_POST['TEXT'];
	}
	if (strlen($_POST['TEXT']) >= 1){
		if(isset($_SESSION['posts'])){
		$_SESSION['posts'] = $_SESSION['posts'] + 1;
		}
		$db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Title VARCHAR, TextData TEXT, Date VARCHAR)");    
		$db->exec("ALTER TABLE $TABLE ADD COLUMN SessID VARCHAR");
		$db->exec("ALTER TABLE $TABLE ADD COLUMN Time VARCHAR");
		$db->exec("INSERT INTO $TABLE (Title, TextData, Date, SessID, Time) VALUES ('$TEXT', '$TITLE', '$DATE', '$sid', Time());");

		 $dup = $db->query("SELECT * FROM $TABLE WHERE Title = $TITLE");
		 
			
			// print_r($result);
			
			echo '<br/>';
			echo Time();
			

if ($res = $db->query("SELECT COUNT(*) FROM $TABLE WHERE SessID = '$sid' ORDER BY Time DESC"))
{
echo '<br/>';
$num_rows = $res->fetchColumn();
echo $num_rows;
echo '<br/>';
}

   $t_result = $db->query("SELECT TIME FROM $TABLE WHERE SessID = '$sid' ORDER BY Time DESC");
   foreach($t_result as $row)
    {
		echo $row[0];
		echo '<br/>';
	}
	}
}else{
	$TEXT = "";
	$TITLE = "";
	$DATE = "";
}
	$TABLE = "Comments";
		if (empty($_SESSION['posts'])){
	$_SESSION['posts'] = 1;
	}else{
	//echo '<br/>';
	//echo 'Amount of Posts: ' . $_SESSION['posts'];
	//echo '<br/>';
	}
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
    foreach($result as $row)
    {
	  print '<div id=blogpost><table width="100%" border=0>';
	  print '<tr><td colspan=4>Date: ' . $row['Date'] . '</td></tr>';
      print "<tr><td colspan=4>Title: " . $row['Title'] . "</td></tr>";
	  print "<tr><td colspan=4 align=center>".$row['TextData'];
	  if ($row['SessID'] == $sid){
			echo '<font color="red" size="8">Delete</font>';
			$id = $row['Id'];
			echo '<button>Delete</button>';
	  }
	  echo "</td></tr>";
	  print "</table></div><br/><br/>";
    }
    $db = NULL;
	echo '</center>';
	echo '<br/><br/>';
	echo '<pre>$GLOBALS: ';
	var_dump($GLOBALS);
	echo '</pre>';
?>
</body>
</html>
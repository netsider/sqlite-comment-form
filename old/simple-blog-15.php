<?php
	$TABLE = "Blog5";
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
	$db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Title VARCHAR, TextData TEXT, Date VARCHAR)");    
	$db->exec("INSERT INTO $TABLE (Title, TextData, Date) VALUES ('$TEXT', '$TITLE', '$DATE');");
}else{
	$TEXT = "QQQ2";
	$TITLE = "SSS1";
	$DATE = "11-20-2014";
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
<table border="1" width="25%" bordercolor="blue">
	<tr>
		<td>Title:</td>
		<td align=center><input type="text" name="TITLE" /></td>
	</tr>
	<tr>
		<td>Date</td>
		<td align=center><input type="text" name="DATE" /></td>
	</tr>
	<tr>
		<td>Text</td>
		<td align=center><textarea name="TEXT" rows="4" cols="50"></textarea></td>
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
	  print '<tr><td colspan=4 align=center>Date: ' . $row['Date'] . '</td></tr>';
      print "<tr><td colspan=4 align=center>Subject: " . $row['Title'] . "</td></tr>";
	  print "<tr><td colspan=4 align=center>".$row['TextData']."</td></tr>";
	  print "</table></div><br/><br/>";
    }
    $db = NULL;
?>
</body>
</html>
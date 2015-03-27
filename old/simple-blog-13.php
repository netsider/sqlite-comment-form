<?php
$TABLE = "Blog5";
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
}else{
	$TEXT = "QQQ2";
	$TITLE = "SSS1";
	$DATE = "11-20-2014";
}

  try
  {
    //open the database
    $db = new PDO('sqlite:test.db');
    //create the database
    //$db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    
    $db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Title VARCHAR, TextData TEXT, Date VARCHAR)");    
	//insert some data...
    //$db->exec("INSERT INTO $TABLE (Breed, Name, Age) VALUES ('$TEXT2', '$TITLE', 2);".
      //         "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .
        //       "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");
   //$db->exec("INSERT INTO $TABLE (Breed, Name, Age) VALUES ('$TEXT2', '$TITLE', 2);");
   $db->exec("INSERT INTO $TABLE (Title, TextData, Date) VALUES ('$TEXT', '$TITLE', '$DATE');");
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
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
    //output the data to a simple html table...
    
    //print "<tr><td>Id</td><td>Subject</td><td>Date</td><td>Text</td></tr>";
    $result = $db->query("SELECT * FROM $TABLE");
    foreach($result as $row)
    {
      //print "<tr><td>".$row['Id']."</td>";
	  print '<div id=blogpost><table width="100%" border=0>';
	  print '<tr><td colspan=4 align=center>Date: ' . $row['Date'] . '</td></tr>';
      print "<tr><td colspan=4 align=center>Subject: " . $row['Title'] . "</td></tr>";
     // print "<tr><td colspan=4 align=center>".$row['Date']."</td></tr>";
	  print "<tr><td colspan=4 align=center>".$row['TextData']."</td></tr>";
	     print "</table></div><br/><br/>";
    }
 
	 // close the database connection
    $db = NULL;
?>
</body>
</html>
<?php
$TABLE = "Blog2";
$TEXT2 = "AAA";
$TITLE = "BBB";
  try
  {
    //open the database
    $db = new PDO('sqlite:test.db');
    //create the database
    $db->exec("CREATE TABLE $TABLE (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    
	//insert some data...
    $db->exec("INSERT INTO $TABLE (Breed, Name, Age) VALUES ($TEXT2, $TITLE, 2);".
               "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .
               "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");

   
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
<body>
<?PHP

    //output the data to a simple html table...
    print "<table border=1>";
    print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
    $result = $db->query('SELECT * FROM Dogs');
    foreach($result as $row)
    {
      print "<tr><td>".$row['Id']."</td>";
      print "<td>".$row['Breed']."</td>";
      print "<td>".$row['Name']."</td>";
      print "<td>".$row['Age']."</td></tr>";
    }
    print "</table>";
	 // close the database connection
    $db = NULL;
?>
</body>
</html>
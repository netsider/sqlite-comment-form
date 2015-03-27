<?php
//putenv('TMP=C:/temp');

	
   class MyDB extends SQLite3 //Connect
   {
      function __construct()
      {
         $this->open('test.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully<br/>";
   }
      
$dir = 'sqlite:test.db';
$dbh  = new PDO($dir) or die("cannot open the database");
//$query =  "SELECT * from books";
//$query = $dbh->exec('CREATE TABLE foo (bar STRING)');
$q = @$db->query('CREATE TABLE IF NOT EXISTS rounds2 (id int, requests int, PRIMARY KEY (id))');
//$q = $db->query($query);
   if(!$q){
      echo $db->lastErrorMsg();
   } else {
      echo "Query Completed Successfully<br/>";
   }

if($db->close()){
	echo 'Database Closed Successfully<br/>';
}
?>
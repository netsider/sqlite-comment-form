<?php
putenv('TMP=C:/temp');

	
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
$q = @$db->query('CREATE TABLE IF NOT EXISTS rounds (id int, requests int, PRIMARY KEY (id))');
//$q = $db->query($query);
   if(!$q){
      echo $db->lastErrorMsg();
   } else {
      echo "Query Completed Successfully<br/>";
   }
// foreach($q as $row)
// {
    // while ($row = $query->fetch()){
    // print($row[0]."\n");
	// }
// }



// $result = $dbh->query('SELECT *	FROM books');
// var_dump($result->fetchArray());







   // Create Table
   // $sql =<<<EOF
      // CREATE TABLE COMPANY 
      // (ID INT PRIMARY KEY     NOT NULL,
      // NAME           TEXT    NOT NULL,
      // AGE            INT     NOT NULL,
      // ADDRESS        CHAR(50),
      // SALARY         REAL);
// EOF;

   // $ret = $db->exec($sql);
   // if(!$ret){
      // echo $db->lastErrorMsg();
   // } else {
      // echo "Table created successfully\n";
   // }
   // $db->close();
?>
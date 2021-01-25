<?php
$servername="localhost";
$username="root";
$password="";
$dbname="Opportunity_Management";

try{
	//create connection to servername
	$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	//set errormode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//create table
	$sql="CREATE TABLE Accounts(
		
    		Aid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   		accountname VARCHAR(50) NOT NULL UNIQUE,
   		address VARCHAR(255) NOT NULL,
    		created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
		
	)";

	//use exec()to execute
	$conn->exec($sql);
	echo "Table created successfully!";
}
catch(PDOException $e)
{echo $sql."<br>".$e->getMessage();}
//end connection
$conn=null;
?>
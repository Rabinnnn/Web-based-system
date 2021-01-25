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
	$sql="CREATE TABLE Opportunities(
		
    		Oid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		Opportunity VARCHAR(50) NOT NULL,
   		Amount VARCHAR(50) NOT NULL UNIQUE,
   		Stage VARCHAR(255) NOT NULL,
		Proposal VARCHAR(255) NOT NULL,
    		created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		Aid int,
		FOREIGN KEY (Aid) REFERENCES Accounts(Aid)
		
		
		

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
<?php
$servername="localhost";
$username="root";
$password="";

try{
	//create connection to server
	$conn=new PDO("mysql:host=$servername",$username,$password);
	
	//set PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	//create database
	$sql= "CREATE DATABASE Opportunity_Management";
	
	//use exec() because no results are returned
	$conn->exec($sql);
	echo "Database created successfully!<br>";
}
catch(PDOException $e)
	{echo $sql."<br>".$e->getMessage();}

//close connection
$conn=null;

?>
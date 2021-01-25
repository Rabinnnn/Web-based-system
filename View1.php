<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Opportunity_Management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  accountname, address, Opportunity, Amount, Stage, Proposal FROM Accounts, Opportunities";
 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr>  <th>ACCOUNT NAME</th><th>ADDRESS</th><th>OPPORTUNITY</th><th>AMOUNT</th><th>STAGE</th><th>PROPOSAL</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr> <td>".$row["accountname"]."</td><td> ".$row["address"]."</td> <td>".$row["Opportunity"]."</td><td>".$row["Amount"]."</td><td>".$row["Stage"]."</td><td>".$row["Proposal"]."</td></tr>";
    	
	}
	
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Fyrby23";
$dbname = "testschema1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Store the form variables into local php variables
$User = $_POST['user'];
$Password = $_POST['pw'];
$select = "SELECT * FROM Customers WHERE customerUsername='$User' && customerPassword='$Password'";
$rs = $conn->query($select);

if ($rs->num_rows > 0) {
	$row = $rs->fetch_assoc();

	if($row['accountType'] == 'admin'){

		$_SESSION["user_name"] = $row["customerUsername"];
		$_SESSION["user_type"] = $row['accountType'];
		$_SESSION["user_id"] = $row['customerID'];
		header('location:adminhome.php');

	}elseif($row['accountType'] == 'user'){

		$_SESSION["user_name"] = $row["customerUsername"];
		$_SESSION["user_type"] = $row['accountType'];
		$_SESSION["user_id"] = $row['customerID'];
		header("location:index.php");

	 }
	
}
else{
	echo ('incorrect email or password!');
 }

$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "Fyrby23";
$dbname = "testschema1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Store the form variables into local php variables
$Fname = $_POST['fname'];
$Lname = $_POST['lname'];
$Uname = $_POST['user'];
$Mail = $_POST['mail'];
$Address = $_POST['address'];
$Password = $_POST['password'];

$select = "SELECT * FROM Customers WHERE customerMail='$Mail' OR customerUsername='$Uname'";

$rs = $conn->query($select);

if ($rs->num_rows > 0){
	echo "user already exists!";
}
else{
	$insert = "INSERT INTO `Customers` (customerFirstName, customerLastName, customerMail, customerAddress, customerPassword, customerUsername)
	VALUES ('$Fname', '$Lname', '$Mail', '$Address', '$Password', '$Uname')";
	if($conn->query($insert) === TRUE){
		echo "New user created successfully";
	}
	else{
		echo "Error: " . $insert . "<br>" . $conn->error;
	}
}
$conn->close();
?>
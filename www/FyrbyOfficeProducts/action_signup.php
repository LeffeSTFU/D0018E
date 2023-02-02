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
$Mail = $_POST['mail'];
$Address = $_POST['address'];
$Password = $_POST['password'];
$sql = "INSERT INTO `Customers` (customerFirstName, customerLastName, customerMail,customerAddress,customerPassword)
VALUES ('$Fname', '$Lname', '$Mail', '$Address', '$Password')";

// insert in database 
if($conn->query($sql) === TRUE)
{
	echo "Contact Records Inserted";
}

?>
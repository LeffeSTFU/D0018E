<?php
$servername = "localhost";
$username = "root";
$password = "Fyrby23";
$dbname = "testschema1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$maxid = SELECT MIN(customerID) FROM Customers; 
$sql = "INSERT INTO Customers (customerName, customerMail,customerAddress,customerPassword)
VALUES ('John Doe', 'john@example.com','skomakargatan 1337','password')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
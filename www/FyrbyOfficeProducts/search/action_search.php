<?php

$search = $_POST['search'];

$servername = "localhost";
$username = "root";
$password = "Fyrby23";
$dbname = "testschema1";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ", $conn->connect_error);
}

$sql = "SELECT * FROM Products WHERE productName LIKE '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["productName"],"  ",$row["productCategory"],"  ",$row["productStock"],"<br>";
}
} else {
	echo "0 records";
}

$conn->close();

?>
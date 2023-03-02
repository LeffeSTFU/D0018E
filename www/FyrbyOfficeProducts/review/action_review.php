
<?php include("../Home/header.html"); ?>

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

$prod = $_POST['product'];
$rating = $_POST['rate'];
$comm = $_POST['comment'];
$usr = $_SESSION["user_id"];

$sql = "SELECT `productID` FROM `Products` WHERE `productName`='$prod' ;";
$result = $conn->query($sql);
$prodID = $result->fetch_assoc();

$select = "SELECT * FROM Reviews WHERE customerID = $usr AND productID = $prodID[productID] ;";
$rs = $conn->query($select);

if ($rs->num_rows > 0) {
	echo "you have already commented on this product!";
} else {
	$insert = "INSERT INTO `Reviews` (`productID`,`comment`,`customerID`,`stars`) 
	VALUES ('$prodID[productID]', '$comm', '$usr', '$rating');";
	if($conn->query($insert) === TRUE){
		header("location:reviewdisplay.php");
	}
	else {
		echo "Error: " . $insert . "<br>" . $conn->error;
	}
}
$conn->close(); 
?>
<?php echo file_get_contents("../Home/footer.html"); ?>

<?php 
session_start();
if($_SESSION['user_type']=='admin')
{   include("../Home/adminheader.html");

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
    $account = $_POST['accountEdit'];

    $select = "SELECT * FROM Customers WHERE (customerMail='$Mail' OR customerUsername='$Uname') AND customerID != '$account'";

    $rs = $conn->query($select);

    if ($rs->num_rows > 0){
    	echo "username already in use!";
    }
    else{
    	$update = "UPDATE `Customers` SET `customerFirstName` = '$_POST[fname]', `customerLastName` = '$_POST[lname]', `customerMail` = '$_POST[mail]', `customerAddress` = '$_POST[address]', `customerPassword` = '$_POST[password]', `customerUsername` = '$_POST[user]' WHERE `Customers`.`customerID` = '$account';";
    	if($conn->query($update) === TRUE){
    		header("location:admincustomerpage.php");
    	}
    	else{
    		echo "Error: " . $insert . "<br>" . $conn->error;
    	}
    }
    $conn->close();

    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
};  
?>

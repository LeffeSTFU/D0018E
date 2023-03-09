<?php 
session_start();
if($_SESSION['user_type']=='admin')
{   
    include("../Home/adminheader.html");
    $servername = "localhost";
    $username = "root";
    $password = "Fyrby23";
    $dbname = "testschema1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } ?>
    <fieldset>
        <legend>Create admin account</legend>
        <form name="create admin" method="post">
            <P>
            <label for="fname">First name:</label><br>
            <input type="text" required pattern=".*\S+.*" id="fname" name="fname" value=""><br>
            </P>
            <P>
            <label for="lname">Last name:</label><br>
            <input type="text" required pattern=".*\S+.*" id="lname" name="lname" value=""><br><br>
            </P>
            <P>
            <label for="user">Username:</label><br>
            <input type="text" required pattern=".*\S+.*" id="user" name="user" value=""><br><br>
            </P>
            <P>
            <label for="lname">Mail:</label><br>
            <input type="text" required pattern=".*\S+.*" id="mail" name="mail" value=""><br><br>
            </P>
            <p>
            <label for="lname">Address:</label><br>
            <input type="text" required pattern=".*\S+.*" id="address" name="address" value=""><br><br>
            </P>
            <P>
            <label for="lname">Password:</label><br>
            <input type="text" required pattern=".*\S+.*" id="password" name="password" value=""><br><br>
            </P>
            <input type="submit" name="Apply" id="Submit" value="Submit">
        </form> 
    </fieldset>    
    <?php
    if(isset($_POST['Apply']))
    {
        $Fname = $_POST['fname'];
        $Lname = $_POST['lname'];
        $Uname = $_POST['user'];
        $Mail = $_POST['mail'];
        $Address = $_POST['address'];
        $Password = $_POST['password'];
        $account = $_POST['accountEdit'];

        $checkifexist = "SELECT * FROM Customers WHERE (customerMail='$Mail' OR customerUsername='$Uname');";

        $rs = $conn->query($checkifexist);

        if ($rs->num_rows > 0) {
            echo "username or email already in use!";
        } else {
            $insert = "INSERT INTO `Customers` (customerFirstName, customerLastName, customerMail, customerAddress, customerPassword, customerUsername, accountType)
	        VALUES ('$Fname', '$Lname', '$Mail', '$Address', '$Password', '$Uname', 'admin');";
            if($conn->query($insert) === TRUE){
                header("location:admincustomerpage.php");
            }
            else{
                echo "Error: " . $insert . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    echo file_get_contents("../Home/footer.html");
}
else{
    echo ('you are not authorized to visit this page, try with another account');
};  
?>
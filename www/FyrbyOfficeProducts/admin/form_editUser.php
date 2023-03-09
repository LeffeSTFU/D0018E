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
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $account = $_POST['editUser'];


    $sql = "SELECT * FROM `Customers` WHERE customerID = $account;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc()  ?>
    <fieldset>
        <legend>Edit user:</legend>
        <form name="editform" method="post" action="action_editUser.php">
            <P>
            <label for="fname">First name:</label><br>
            <input type="text" required pattern=".*\S+.*" id="fname" name="fname" value="<?php echo $row['customerFirstName']; ?>"><br>
            </P>
            <P>
            <label for="lname">Last name:</label><br>
            <input type="text" required pattern=".*\S+.*" id="lname" name="lname" value="<?php echo $row['customerLastName']; ?>"><br><br>
            </P>
            <P>
            <label for="user">Username:</label><br>
            <input type="text" required pattern=".*\S+.*" id="user" name="user" value="<?php echo $row['customerUsername']; ?>"><br><br>
            </P>
            <P>
            <label for="lname">Mail:</label><br>
            <input type="text" required pattern=".*\S+.*" id="mail" name="mail" value="<?php echo $row['customerMail']; ?>"><br><br>
            </P>
            <p>
            <label for="lname">Address:</label><br>
            <input type="text" required pattern=".*\S+.*" id="address" name="address" value="<?php echo $row['customerAddress']; ?>"><br><br>
            </P>
            <P>
            <label for="lname">Password:</label><br>
            <input type="text" required pattern=".*\S+.*" id="password" name="password" value="<?php echo $row['customerPassword']; ?>"><br><br>
            </P>
            <button type="submit" name="accountEdit" value="<?php echo $account ?>">Submit</button>
        </form> 
    </fieldset>
        <?php
    } else {
        echo "0 results";
    }
    $conn->close();
    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
};  
?>
<?php
session_start();
if($_SESSION['user_type']=='admin'){
    include("../Home/adminheader.html");

    $servername = "localhost";
    $username = "root";
    $password = "Fyrby23";
    $dbname = "testschema1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $select = "SELECT * FROM `Customers` WHERE `accountType` != 'admin';";
    $rs = $conn->query($select); ?>
    
    <fieldset>
        <legend>Monitor specific User orders:</legend>
        <form name="reviewform" method="get" action="action_user_orders.php">
            <P>
            <label for="Username">Username</label><br>
            <select name="username" id="username">
                <?php foreach( $rs as $row ){
                    echo "<option>" . $row['customerUsername'] . "</option>";
                   }
                 ?> 
            </select>
            </P>
            <input type="submit" name="Submit" id="Submit" value="Submit">
        </form>
    </fieldset>

    <?php
    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
}; 
?>
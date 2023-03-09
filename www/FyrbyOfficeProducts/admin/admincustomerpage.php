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
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `Customers`;";
    $result = $conn->query($sql);

    if(!empty($_POST['deleteBtn'])){
        $delete_from_orders = "DELETE FROM `Orders` WHERE `Orders`.`customerID` = '$_POST[deleteBtn]';";
        $conn->query($delete_from_orders);
        $delete_from_reviews = "DELETE FROM `Reviews` WHERE `Reviews`.`customerID` = '$_POST[deleteBtn]';";
        $conn->query($delete_from_reviews);
        $delete_from_shoppingcart = "DELETE FROM `ShoppingCart` WHERE `ShoppingCart`.`customerID` = '$_POST[deleteBtn]';";
        $conn->query($delete_from_shoppingcart);
        $delete = "DELETE FROM `Customers` WHERE `Customers`.`customerID` = '$_POST[deleteBtn]';";
        $conn->query($delete);
        $conn->close();
        header("refresh:0");
    }

    if ($result->num_rows > 0) {
        ?>
    <h3>Admin accounts:</h3>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Last Name</th><th>Email</th><th>Address</th><th>Password</th><th>Login</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['accountType'] == "admin"){ ?>
            <tr>
                <td><?php echo $row['customerID']; ?></td><td><?php echo $row['customerFirstName']; ?></td>
                <td><?php echo $row['customerLastName']; ?></td><td><?php echo $row['customerMail']; ?></td>
                <td><?php echo $row['customerAddress']; ?></td><td><?php echo $row['customerPassword']; ?></td>
                <td><?php echo $row['customerUsername']; ?></td>
                <td>
                    <form method="post" action="form_editUser.php"><button type="submit" name="editUser" value="<?php echo $row['customerID']; ?>" class="editbtn">Edit</button></form>
                    <form method="post"><button type="submit" name="deleteBtn" value="<?php echo $row['customerID']; ?>">Delete</button></form>
                </td>
            </tr>
        <?php
            }
        } ?>
    </table>

    <form method="post" action="form_createAdmin.php">
        <button type="submit" name="adminBtn">Create Admin</button>
    </form>

    <?php mysqli_data_seek($result, 0) ?>
    <h3>Customer accounts:</h3>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Last Name</th><th>Email</th><th>Address</th><th>Password</th><th>Login</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['accountType'] == "user"){ 
                $delete = "DELETE FROM `Customers` WHERE `Customers`.`customerID` = '$row[customerID]';"; ?>
            <tr>
                <td><?php echo $row['customerID']; ?></td><td><?php echo $row['customerFirstName']; ?></td>
                <td><?php echo $row['customerLastName']; ?></td><td><?php echo $row['customerMail']; ?></td>
                <td><?php echo $row['customerAddress']; ?></td><td><?php echo $row['customerPassword']; ?></td>
                <td><?php echo $row['customerUsername']; ?></td>
                <td>
                    <form method="post" action="form_editUser.php"><button type="submit" name="editUser" value="<?php echo $row['customerID']; ?>" class="editbtn">Edit</button></form>
                    <form method="post"><button type="submit" name="deleteBtn" value="<?php echo $row['customerID']; ?>">Delete</button></form>
                </td>
            </tr>
        <?php
            }
        } ?>
    </table>
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

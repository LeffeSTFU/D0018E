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
        <legend>Monitor specifict Users orders:</legend>
        <form name="reviewform" method="post" action="action_user_orders.php">
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

    <H3>Username:   <?php echo $_POST['username']; ?></H3>
    <?php
    $currnetCustomerID = "SELECT `customerID` FROM `Customers` WHERE `customerUsername` =  '$_POST[username]';";
    $customerResult = $conn->query($currnetCustomerID);
    $customerid = mysqli_fetch_assoc($customerResult);
    $orders = "SELECT * FROM `Orders` WHERE `Orders`.`customerID` = '$customerid[customerID]';";
    $orders_result = $conn->query($orders);
    if ($orders_result->num_rows > 0){ 
        $oldOrderID = null; ?>
    <h4>Order ID: 1</h4>
    <table>
        <tr>
            <th>Product ID</th><th>Price at Order</th><th>Amount</th><th>Order Instance</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($orders_result)){ 
            $newOrderID = $row['orderID'];
            if ($oldOrderID == null || $newOrderID == $oldOrderID){ ?>
                <tr>
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['PriceAtOrder']; ?></td>
                    <td><?php echo $row['orderAmount']; ?></td><td><?php echo $row['orderInstance']; ?></td>
                </tr>
        <?php
                $oldOrderID = $newOrderID;
            }else{ 
                $oldOrderID = $newOrderID; ?>
            </table>
            <h4>Order ID: <?php echo $newOrderID; ?></h4>
            <table>
                <tr>
                    <th>Product ID</th><th>Price at Order</th><th>Amount</th><th>Order Instance</th>
                </tr>
                <tr>
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['PriceAtOrder']; ?></td>
                    <td><?php echo $row['orderAmount']; ?></td><td><?php echo $row['orderInstance']; ?></td>
                </tr>
            <?php 
            }
        } ?>
    </table>
    <?php 
    }else{
        echo "0 orders";
    }
    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
}; 
?>
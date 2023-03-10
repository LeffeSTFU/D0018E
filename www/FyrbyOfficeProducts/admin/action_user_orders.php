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

    if(!empty($_POST['delete_Order'])){
        $delete_parts = explode("_", $_POST['delete_Order']);
        $single_order = "SELECT * FROM `Orders` WHERE (`Orders`.`orderID` = '$delete_parts[0]') AND (`Orders`.`customerID` = '$delete_parts[1]');";
        $query_single_order = $conn->query($single_order);
        while($row = mysqli_fetch_assoc($query_single_order)){
            $amount = $row['orderAmount'];
            $prodID = $row['productID'];
            $update_stock = "UPDATE `Products` SET `Products`.`productStock` = `Products`.`productStock`+'$amount' WHERE `Products`.`productID`= '$prodID';";
            $conn->query($update_stock);
        }
        $delete_order = "DELETE FROM `Orders` WHERE (`Orders`.`orderID` = '$delete_parts[0]') AND (`Orders`.`customerID` = '$delete_parts[1]');";
        $conn->query($delete_order);
        $conn->close();
        header("Location: action_user_orders.php?username=$_GET[username]&Submit=Submit");
    } 

    if(!empty($_POST['apply'])){
        if ($_POST['amount'] < 0){
            $conn->close();
            header("Location: action_user_orders.php?username=$_GET[username]&Submit=Submit");
        }else{
            $edit_parts = explode("_", $_POST['apply']);
            $check_product_stock = "SELECT * FROM `Products` WHERE `Products`.`productID`= '$edit_parts[2]';";
            $stock = mysqli_fetch_assoc($conn->query($check_product_stock));
            $newStock = $stock['productStock'] + ($edit_parts[3] - $_POST['amount']);
            if ($newStock < 0){
                echo "No more stock for that product can't add more amount to order!";
                $conn->close();
                header("refresh:5;url=action_user_orders.php?username=$_GET[username]&Submit=Submit");
            }else{
                $update_stock = "UPDATE `Products` SET `Products`.`productStock` = '$newStock' WHERE `Products`.`productID`= '$edit_parts[2]';";
                $conn->query($update_stock);

                if ($_POST['amount'] == 0){
                    $apply_update = "DELETE FROM `Orders` WHERE (`Orders`.`orderID` = '$edit_parts[0]') AND (`Orders`.`customerID` = '$edit_parts[1]') AND (`Orders`.`productID` = '$edit_parts[2]');";
                }else{
                    $apply_update = "UPDATE `Orders` SET `Orders`.`orderAmount` = '$_POST[amount]' WHERE (`Orders`.`orderID` = '$edit_parts[0]') AND (`Orders`.`customerID` = '$edit_parts[1]') AND (`Orders`.`productID` = '$edit_parts[2]');";
                }
                $conn->query($apply_update);
                $conn->close();
                header("Location: action_user_orders.php?username=$_GET[username]&Submit=Submit");
            }
        }
    }

    if(!empty($_POST['remove'])){
        $edit_parts = explode("_", $_POST['remove']);
        $check_product_stock = "SELECT * FROM `Products` WHERE `Products`.`productID`= '$edit_parts[2]';";
        $stock = mysqli_fetch_assoc($conn->query($check_product_stock));
        $newStock = $stock['productStock'] + ($edit_parts[3]);

        $update_stock = "UPDATE `Products` SET `Products`.`productStock` = '$newStock' WHERE `Products`.`productID`= '$edit_parts[2]';";
        $conn->query($update_stock);

        $apply_update = "DELETE FROM `Orders` WHERE (`Orders`.`orderID` = '$edit_parts[0]') AND (`Orders`.`customerID` = '$edit_parts[1]') AND (`Orders`.`productID` = '$edit_parts[2]');";
        $conn->query($apply_update);

        $conn->close();
        header("Location: action_user_orders.php?username=$_GET[username]&Submit=Submit");
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

    <H3>Username:   <?php echo $_GET['username']; ?></H3>
    <?php
    $currnetCustomerID = "SELECT `customerID` FROM `Customers` WHERE `customerUsername` =  '$_GET[username]';";
    $customerResult = $conn->query($currnetCustomerID);
    $customerid = mysqli_fetch_assoc($customerResult);
    $orders = "SELECT * FROM `Orders` WHERE `Orders`.`customerID` = '$customerid[customerID]';";
    $orders_result = $conn->query($orders);
    if ($orders_result->num_rows > 0){ 
        $oldOrderID = null; ?>
    <h4>Order ID: 1</h4>
    <form method="post">
        <button name="delete_Order" value="<?php echo "1_".$customerid['customerID']; ?>"$>Delete Order</button>
    </form>
    <table>
        <tr>
            <th>Order Instance</th><th>Product ID</th><th>Price at Order</th><th>Amount</th><th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($orders_result)){ 
            $newOrderID = $row['orderID'];
            if ($oldOrderID == null || $newOrderID == $oldOrderID){ ?>
                <tr>
                    <form method="post">
                        <td><?php echo $row['orderInstance']; ?></td>
                        <td><?php echo $row['productID']; ?></td><td><?php echo $row['PriceAtOrder']; ?></td>
                        <td>
                            <input type="text" required pattern=".*\S+.*" name="amount" value="<?php echo $row['orderAmount']; ?>">
                        </td>
                        <td>
                            <button type="submit" name="apply" value="<?php echo $newOrderID."_".$customerid['customerID']."_".$row['productID']."_".$row['orderAmount']; ?>">Apply</button>
                        </td>
                    </form>
                    <td>
                        <form method="post">
                            <button type="submit" name="remove" value="<?php echo $newOrderID."_".$customerid['customerID']."_".$row['productID']."_".$row['orderAmount']; ?>">Remove</button>
                        </form>
                    </td>
                </tr>
        <?php
                $oldOrderID = $newOrderID;
            }else{ 
                $oldOrderID = $newOrderID; ?>
                </table>
                <h4>Order ID: <?php echo $newOrderID; ?></h4>
                <form method="post">
                    <button name="delete_Order" value="<?php echo $newOrderID."_".$customerid['customerID']; ?>">Delete Order</button>
                </form>
                <table>
                    <tr>
                        <th>Order Instance</th><th>Product ID</th><th>Price at Order</th><th>Amount</th><th>Action</th>
                    </tr>
                    <tr>
                        <form method="post">
                            <td><?php echo $row['orderInstance']; ?></td>
                            <td><?php echo $row['productID']; ?></td><td><?php echo $row['PriceAtOrder']; ?></td>
                            <td>
                                <input type="text" required pattern=".*\S+.*" name="amount" value="<?php echo $row['orderAmount']; ?>">
                            </td>
                            <td>
                                <button type="submit" name="apply" value="<?php echo $newOrderID."_".$customerid['customerID']."_".$row['productID']."_".$row['orderAmount']; ?>">Apply</button>
                            </td>
                        </form>
                        <td>
                            <form method="post">
                                <button type="submit" name="remove" value="<?php echo $newOrderID."_".$customerid['customerID']."_".$row['productID']."_".$row['orderAmount']; ?>">Remove</button>
                            </form>
                        </td>
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
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

    $sql = "SELECT * FROM `Products`;";
    $result = $conn->query($sql);

    if(isset($_POST['apply'])){
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $update = "UPDATE Products SET productStock = '$stock', productPrice = '$price' WHERE Products.productID = '$_POST[apply]';";
        $conn->query($update);
        $conn->close();
        header("refresh: 0");
    }

    if ($result->num_rows > 0) {
        ?>
    <h3>Desk Supplies:</h3>

    <form method="post" action="form_add_product.php">
        <button type="submit" name="addProduct" value="Desk Supplies">Add Product</button>
    </form>
    
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Stock</th><th>Price</th><th>Path to Image</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['productCategory'] == "Desk Supplies"){ ?>
            <tr>
                <form method="post">
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['productName']; ?></td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="stock" value="<?php echo $row['productStock']; ?>">
                    </td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="price" value="<?php echo $row['productPrice']; ?>">
                    </td>
                    <td><?php echo $row['imageFile']; ?></td>
                    <td>
                        <button type="submit" name="apply" value="<?php echo $row['productID']; ?>">Apply</button>
                    </td>
                </form>
            </tr>
        <?php
            }
        } ?>
    </table>

    <?php mysqli_data_seek($result, 0) ?>

    <h3>Computer Supplies:</h3>

    <form method="post" action="form_add_product.php">
        <button type="submit" name="addProduct" value="Computer Supplies">Add Product</button>
    </form>

    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Stock</th><th>Price</th><th>Path to Image</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['productCategory'] == "Computer Supplies"){ ?>
            <tr>
                <form method="post">
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['productName']; ?></td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="stock" value="<?php echo $row['productStock']; ?>">
                    </td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="price" value="<?php echo $row['productPrice']; ?>">
                    </td>
                    <td><?php echo $row['imageFile']; ?></td>
                    <td>
                        <button type="submit" name="apply" value="<?php echo $row['productID']; ?>">Apply</button>
                    </td>
                </form>
            </tr>
        <?php
            }
        } ?>
    </table>

    <?php mysqli_data_seek($result, 0) ?>

    <h3>Footwear:</h3>

    <form method="post" action="form_add_product.php">
        <button type="submit" name="addProduct" value="Footwear">Add Product</button>
    </form>

    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Stock</th><th>Price</th><th>Path to Image</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['productCategory'] == "Footwear"){ ?>
            <tr>
                <form method="post">
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['productName']; ?></td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="stock" value="<?php echo $row['productStock']; ?>">
                    </td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="price" value="<?php echo $row['productPrice']; ?>">
                    </td>
                    <td><?php echo $row['imageFile']; ?></td>
                    <td>
                        <button type="submit" name="apply" value="<?php echo $row['productID']; ?>">Apply</button>
                    </td>
                </form>
            </tr>
        <?php
            }
        } ?>
    </table>

    <?php mysqli_data_seek($result, 0) ?>

    <h3>Printing Supplies:</h3>

    <form method="post" action="form_add_product.php">
        <button type="submit" name="addProduct" value="Printing Supplies">Add Product</button>
    </form>

    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Stock</th><th>Price</th><th>Path to Image</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ 
            if ($row['productCategory'] == "Printing Supplies"){ ?>
            <tr>
                <form method="post">
                    <td><?php echo $row['productID']; ?></td><td><?php echo $row['productName']; ?></td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="stock" value="<?php echo $row['productStock']; ?>">
                    </td>
                    <td>
                        <input type="text" required pattern=".*\S+.*" name="price" value="<?php echo $row['productPrice']; ?>">
                    </td>
                    <td><?php echo $row['imageFile']; ?></td>
                    <td>
                        <button type="submit" name="apply" value="<?php echo $row['productID']; ?>">Apply</button>
                    </td>
                </form>
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

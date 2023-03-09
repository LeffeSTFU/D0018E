<?php 
session_start();
if($_SESSION['user_type']=='admin')
{   
    include("../Home/adminheader.html"); ?>
    <fieldset>
        <legend>Add a new Product:</legend>
        <form name="Add new product" method="post" enctype="multipart/form-data" action="../upload.php">
            <P>
            <label for="fname">product name:</label><br>
            <input type="text" required pattern=".*\S+.*" id="productname" name="productname" value=""><br>
            </P>
            <P>
            <label for="lname">Product stock:</label><br>
            <input type="text" required pattern=".*\S+.*" id="productstock" name="productstock" value=""><br><br>
            </P>
            <P>
            <label for="user">Product Price:</label><br>
            <input type="text" required pattern=".*\S+.*" id="productprice" name="productprice" value=""><br><br>
            </P>
            <P>
            <label for="user">Product Category:</label><br>
            <input type="text" required pattern=".*\S+.*" id="productcategory" name="productcategory" value="<?php echo $_POST['addProduct']; ?>"><br><br>
            </P>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Submit" name="submit">
        </form> 
    </fieldset>    
    <?php
    echo file_get_contents("../Home/footer.html");
}
else{
    echo ('you are not authorized to visit this page, try with another account');
};  
?>
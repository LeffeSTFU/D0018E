<?php
session_start();
if($_SESSION['user_type']=='admin')
{
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

$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $pName = $_POST['productname'];
    $pCat = $_POST['productcategory'];
    $pStock = $_POST['productstock'];
    $pPrice = $_POST['productprice'];
    echo $pName, $pCat;
    $checkifexist = "SELECT * FROM Products WHERE productName='$pName';";

    $rs = $conn->query($checkifexist);

    if ($rs->num_rows > 0) {
        echo "Product name already exist!";
    } else {
        $insert = "INSERT INTO `Products` (productName, productCategory, productStock, productPrice, imageFile)
      VALUES ('$pName', '$pCat', '$pStock', '$pPrice', '/$target_file');";
        if($conn->query($insert) === TRUE){
            header("location:admin/adminproductpage.php");
        }
        else{
            echo "Error: " . $insert . "<br>" . $conn->error;
        }
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
else{
    echo ('you are not authorized to visit this page, try with another account');
};
?>
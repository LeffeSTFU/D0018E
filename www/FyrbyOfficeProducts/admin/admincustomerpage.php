<?php
session_start();
if($_SESSION['user_type']=='admin'){
    include("../Home/adminheader.html");
    include("admincustomerpage.html");
    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
}; 
?>

<?php 
session_start();
if($_SESSION['user_type']=='admin')
{   include("../Home/adminheader.html");
    echo "My name is $_SESSION[user_name] and I´m an important $_SESSION[user_type]";
    echo file_get_contents("../Home/footer.html");}
else{
    echo ('you are not authorized to visit this page, try with another account');
};  
?>

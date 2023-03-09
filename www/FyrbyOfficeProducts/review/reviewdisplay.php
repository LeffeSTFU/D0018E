<?php 
session_start();
include("../Home/header.html");
include("reviewdisplay.html"); 
echo file_get_contents("../Home/footer.html"); 
?>
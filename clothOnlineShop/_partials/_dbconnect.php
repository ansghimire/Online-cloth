<?php

// tempdata database

$con_tempData = mysqli_connect('localhost','root', '', 'tempdata');

if(!$con_tempData){
	echo "connection failed";
}



//clothecom database

$con_clothEcom = mysqli_connect('localhost', 'root','','clothonlineshopping');

if(!$con_clothEcom){
	echo "connection failed 2";
}



?>
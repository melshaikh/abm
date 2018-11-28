<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$dbUser = "u763773276_mano";
//$dbPass = "sugood80";
//$dbDatabase = "u763773276_omr";
//$dbHost = "localhost";

//$dbUser = "scceunim_elshaik";
//$dbPass = '$ugood80';
//$dbDatabase = "scceunim_elshaikh";
//$dbHost = "localhost";

//    $dbUser = "root";
//    $dbPass = "123456";
//    $dbDatabase = "scce_omr";
//    $dbHost = "localhost";
//$db = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);


$db = mysqli_connect("localhost","root","","abm");
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
 
 
?>


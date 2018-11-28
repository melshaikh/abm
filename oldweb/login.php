<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'headl.inc.php';
if(isset($_POST['login']))
{
$pass = hash("sha512",$_POST['pass']);
$sql = "SELECT * FROM `omr_users` WHERE `email`= '".$_POST['name']."' AND `password` = '".$pass."' LIMIT 1";
$query = $db->query($sql);
if($query->num_rows > 0)
{
$sessionID = session_id();
$hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
$userData = $query->fetch_assoc();
$expires = time()+(60*60);
$ck = "SELECT `id` FROM `omr_active_users` WHERE `omr_active_users`.`user`= '".$userData['id']."' LIMIT 1";
$ck_r = $db->query($ck);
if($ck_r->num_rows < 1)
$new_sql = "INSERT INTO `omr_active_users`(`user`, `session_id`, `hash`, `expires`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."')";
else $new_sql = "UPDATE `omr_active_users` SET `"
        . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `omr_active_users`.`user` = ".$userData['id'];
$db->query($new_sql);
if(strcmp($userData['level'],'key') == 0) header("Location:keyinuser.php");
if(strcmp($userData['level'],'tusb') == 0) header("Location:tusb.php");
if(strcmp($userData['level'],'abm') == 0) header("Location:abmp.php");
if(strcmp($userData['level'],'zah') == 0) header("Location:zah.php");
//switch($userData['level']){
//    case 'tusb':header("Location:tusb.php");break;
//    case 'abm':header("Location:abmp.php");break;
//    case 'key':header("Location:keyinuser.php");break;
//    default:header("Location:index.php");
//}
}else {header("location:index.php");}}
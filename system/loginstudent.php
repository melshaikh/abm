<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'access/tols/heads.inc.php';
if(isset($_POST['login']))
{
$pass = hash("sha512",$_POST['pass']);
$sql = "SELECT * FROM `students` WHERE `ic`= '".$_POST['name']."' AND `pass` = '".$pass."' LIMIT 1";
if($query = $db->query($sql)){
if($query->num_rows > 0)
{
$sessionID = session_id();
$hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
$userData = $query->fetch_assoc();
$expires = time()+(60*60);
$ck = "SELECT `id` FROM `omr_active_students` WHERE `omr_active_students`.`user`= '".$userData['id']."' LIMIT 1";
$ck_r = $db->query($ck);
if($ck_r->num_rows < 1)
$new_sql = "INSERT INTO `omr_active_students`(`user`, `session_id`, `hash`, `expires`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."')";
else $new_sql = "UPDATE `omr_active_students` SET `"
        . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `omr_active_students`.`user` = ".$userData['id'];
if($db->query($new_sql))
{
    if(strcmp($userData['isfirst'],'yes') == 0)
    header("Location:access/std/resetpass.php");
    else header("Location:access/std/");
}
}else {header("location:../pelatih.php?error=Error: ID pengunna atau kata laluan#services");}
}else {header("location:../pelatih.php?error=Error: ID pengunna atau kata laluan#services");}}
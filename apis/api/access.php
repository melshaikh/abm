<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../headl.inc.php';
$user = NULL;
if(isset($_POST['icn']) AND isset($_POST['pass'])){    
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_POST['icn']."' AND `pass` = '".$_POST['pass']."'";
    $query = $db->query($sql);
    if($query->num_rows > 0){
        $us = $query->fetch_assoc();
    $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"address"=>$us['address'],
        "phone"=>$us['phone1'],"jstatus"=>$us['working_status'],"level"=>"student","isfirst"=>$us['isfirst']);
        $user[] = $stdinfo;
        $userx = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
        echo $userx;
    }
    else  
    {
        $sql = "SELECT * FROM `omr_users` WHERE `ic` = '".$_POST['icn']."'  AND `password` = '".$_POST['pass']."'";
        $query = $db->query($sql);
        if($query->num_rows > 0){
            $us = $query->fetch_assoc();
            $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"title"=>$us['u_name'],"level"=>$us['level'],"isfirst"=>$us['isfirst']);
            $user[] = $stdinfo;
            $userx = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
            echo $userx;
    }else echo "NULL";        
    } 
}elseif(isset ($_GET['icn']))
    {
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_GET['icn']."'";
    $query = $db->query($sql);
    if($query->num_rows > 0){
        $us = $query->fetch_assoc();
    $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"address"=>$us['address'],
        "phone"=>$us['phone1'],"jstatus"=>$us['working_status'],"level"=>"student");
        $user[] = $stdinfo;
        $userx = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
        echo $userx;
    }
    else  
    {
        $sql = "SELECT * FROM `omr_users` WHERE `ic` = '".$_GET['icn']."'";
        $query = $db->query($sql);
        if($query->num_rows > 0){
            $us = $query->fetch_assoc();
            $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"title"=>$us['u_name'],"level"=>$us['level']);
            $user[] = $stdinfo;
            $userx = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
            echo $userx;
    }else echo "NULL";        
    }
}else echo "NULL";
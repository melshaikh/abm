<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../headl.inc.php';
function setBidang($bidang,$sid){
    include '../config.php';
    $sql = NULL;
    if(strcmp($bidang,"BDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '1', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"BLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '1' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"BSDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '1',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"BSLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='1',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"SBDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='1',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"SBLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='1',`tb`='0',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"TB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='1',`ll`='0' WHERE `students`.`id` = ".$sid;
    if(strcmp($bidang,"LL")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='1' WHERE `students`.`id` = ".$sid;
    
    if($sql != NULL){
        if($db->query($sql))
            return 0;
        else return 1;
    }else        return 1;
    
    
    
}
if(isset($_POST['id'])){
    $address  = $_POST['address'];
    $status = $_POST['status'];
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_POST['id']."'";
    $querya = $db->query($sql);
    $ret = 0;
    if($querya->num_rows > 0)
    {
        while($tred = $querya->fetch_assoc()){
        $sql = "UPDATE `students` SET `address` = '".$address."', `working_status` = '".$status."' , `phone1` = '".$_POST['ph']."' "
                . ", `email` = '".$_POST['email']."', `kadhijau` = '".$_POST['kadhijau']."' WHERE `students`.`id` = ".$tred['id'];
        if($query = $db->query($sql))
        {
            $tanda = getTredAndAreaBySesiId($tred['sesi_id']);
            $ret = $ret + setBidang($_POST['bidang'], $tred['id']);
        }
        else            $ret = $ret.'NOT GOOD FOR '.$tred['name'].'['.$sql.']';
        $sqlx = "UPDATE `students` SET `last_login` = '".date('y-m-d')."' WHERE `students`.`id` = ".$tred['id'];
        if($db->query($sqlx))
            $ret = $ret + 0;
        else $ret = $ret + 1;
        }
        echo $ret;
    }else        echo 1;
    
}else    echo 1;

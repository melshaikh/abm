<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../headl.inc.php';
function getBidang($std)
{
    $x = 'LL';
    if($std['bdb'] == 1)
        $x = 'BDB';
    if($std['blb'] == 1)
        $x = 'BLB';
    if($std['bsdb'] == 1)
        $x = 'BSDB';
    if($std['bslb'] == 1)
        $x = 'BSLB';
    if($std['sbdb'] == 1)
        $x = 'SBDB';
    if($std['sblb'] == 1)
        $x = 'SBLB';
    if($std['tb'] == 1)
        $x = 'TB';
    if($std['ll'] == 1)
        $x = 'LL';
    return $x;
    
}
function getAreas($sic)
{
    include '../config.php';
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$sic."'";
    $query = $db->query($sql);
    $areas = "";
    if($query->num_rows > 0)
    {
        while ($ss = $query->fetch_assoc())
        {
            $areas = $areas.getTredAndAreaBySesiId($ss['sesi_id'])['tred_name']."\n ";
        }
    }
    return $areas;
}
if(isset($_POST['icn'])){
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_POST['icn']."'";
    $query = $db->query($sql);
    if($query->num_rows > 0)
    {
    $us = $query->fetch_assoc();
    $bidang = getBidang($us);
    $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"address"=>$us['address'],"bidang"=>$bidang,
        "phone"=>$us['phone1'],"jstatus"=>$us['working_status'],"acad"=>$us['akad'],"areas"=>getAreas($_POST['icn']),"kadhijau"=>$us['kadhijau'],"image"=>$us['image']);
    
    if(isset($_POST['search']))
    {
        $ssql = "SELECT * FROM `jobs` WHERE `status` <> 'close' AND (`name` LIKE '%".$_POST['search']."%' "
                . "OR `company` LIKE '%".$_POST['search']."%' OR `position` LIKE '%".$_POST['search']."%' "
                . "OR `detail` LIKE '%".$_POST['search']."%')";
        $squery = $db->query($ssql);
        $r = $squery;
        if($squery->num_rows < 1)
            $r = NULL;        
        
    } else {
        $r = getJobsForStudentByIC($_POST['icn']);
    }
    
    $joblist = NULL;
        if($r != NULL)
        while($j = $r->fetch_assoc())
        {
            //$jj = getJobsById($j['id']);
            if($j['date'] >= $us['last_login'])
                $isnew = 'yes';
            else $isnew = 'no';
            $stat = getJobStudentStat($j['id'],$_POST['icn']);
            if($stat == NULL)
                $tostat = 'NOT APPLIED';
            else $tostat = $stat['status'];
            $xj = array("jid"=>$j['id'],"name"=>$j['name'],"company"=>$j['company'],"detail"=>$j['detail'],"std_status"=>$tostat,"isnew"=>$isnew);
            $joblist[] = $xj;
        }
    $si = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
    $jl = json_encode($joblist,JSON_UNESCAPED_SLASHES);
    $sqlx = "UPDATE `students` SET `last_login` = '".date('y-m-d')."' WHERE `students`.`ic` = ".$us['ic'];
    $db->query($sqlx);
    echo ('{"studentinfo":'.$si.',"jobs":'.$jl.' }');
    }
    else        echo 'BAD';
}else    echo 'BAD';

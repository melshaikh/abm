<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../headl.inc.php';
if(isset($_POST['icn'])){
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_POST['icn']."'";
    $query = $db->query($sql);
    if($query->num_rows > 0)
    {
    $us = $query->fetch_assoc();
    $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"address"=>$us['address'],
        "phone"=>$us['phone1'],"jstatus"=>$us['working_status'],"level"=>"student");
    
    $r = getActiveJobList();
    $joblist = NULL;
    
        while($j = $r->fetch_assoc())
        {
            $jj = getJobsById($j['job_id']);
            if(strcmp($jj['status'],"open") == 0){
            $xj = array("jid"=>$jj['id'],"name"=>$jj['name'],"company"=>$jj['company'],"detail"=>$jj['detail']);
            $joblist[] = $xj;}
        }
    
    $si = json_encode($stdinfo,JSON_UNESCAPED_SLASHES);
    $jl = json_encode($joblist,JSON_UNESCAPED_SLASHES);
    echo ('{"studentinfo":'.$si.',"jobs":'.$jl.' }');
    }
    else{
        $sql = "SELECT * FROM `omr_users` WHERE `ic` = '".$_POST['icn']."' LIMIT 1";
        $query = $db->query($sql);
        if($query->num_rows > 0)
        {
            $us = $query->fetch_assoc();
            $stdinfo = array("id"=>$us['id'], "name"=>$us['name'], "ic"=>$us['ic'],"email"=>$us['email'],"title"=>$us['u_name'],"position"=>getPositionById($us['u_id'])['name']);
        }else echo 'BAD';
    }
}else    echo 'BAD';
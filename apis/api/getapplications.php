<?php
if(isset($_POST['icn'])){
    include '../config.php';
    include '../headl.inc.php';
    $sql = "SELECT a.* FROM `jobs` AS a INNER JOIN `jobtostudent` AS b "
            . "WHERE "
            . "b.student_ic = '".$_POST['icn']."' "
            . "AND a.id = b.job_id "
            . "AND b.notify <> 'no' ";
    $r = $db->query($sql);
    $us = getStudentByIC($_POST['icn']);
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
    $jl = json_encode($joblist,JSON_UNESCAPED_SLASHES);
    echo $jl;
}else    echo '[]';
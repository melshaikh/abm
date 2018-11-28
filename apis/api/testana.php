<?php

if(isset($_GET['y']) AND isset($_GET['a']))
{
    include '../headl.inc.php';
    
    $sql = "SELECT * FROM `students` WHERE 1";
    $res = $db->query($sql);
    $rr1 = 0;
    $rr2 = 0;
    while($s = $res->fetch_assoc())
    {
        $sum = $s['bdb'].$s['blb'].$s['bsdb'].$s['bslb'].$s['sblb'].$s['ll'].$s['sbdb'];
        if(strcmp($sum,'0000000') == 0)
        {
            $rr2++;
            $sss = "UPDATE `students` SET `tb` = '1' WHERE `id` = '".$s['id']."'";
            if($db->query($sss))
                $rr1++;
        }else{
            $sss = "UPDATE `students` SET `tb` = '0' WHERE `id` = '".$s['id']."'";
            $db->query($sss);            
            $rr1++;
        }
    }
    echo 'CHANGED = '.$rr1. "AND TO CHANGE=".$rr2;
    echo "AREA: ".getAreaByID($_GET['a'])['name']." for Year: ".$_GET['y']." :<br>".getStudentAnalysisByYearAndArea($_GET['y'],$_GET['a']);
}


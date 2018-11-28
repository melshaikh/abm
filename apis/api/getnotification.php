<?php
if(isset($_POST['last']) AND isset($_POST['icn']))
{
    include '../config.php';
    $sql = "SELECT a.*, b.company, b.name, a.status FROM `jobtostudent` AS a INNER JOIN `jobs` AS b "
            . "WHERE a.`student_ic` = '".$_POST['icn']."' AND a.notify = 'yes' AND a.job_id = b.id ORDER BY a.date DESC";
    $res = $db->query($sql);
    if($res->num_rows > 0)
    {
        $aduans = null;
        while($ad = $res->fetch_assoc()){
        $one = array("title"=>"e-GoJob Notification","cont"=>$ad['status'].' - '.$ad['name'].' at ['.$ad['company'].']',"cont_title"=>$ad['name']);
        $aduans[] = $one;
        $sq = "UPDATE `jobtostudent` SET `notify` = 'already' WHERE `id` = '".$ad['id']."'";
        $db->query($sq);
        
        }
        $si = json_encode($aduans,JSON_UNESCAPED_SLASHES);
        echo $si;
    }else        echo '[]';
    
}else        echo '[]';

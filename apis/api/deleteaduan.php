<?php

if(isset($_POST['icn']))
{
    include '../config.php';
    $sql = "DELETE FROM `aduan` WHERE `id` = ".$_POST['id'];
    if($db->query($sql))
    {
    $sql = "SELECT * FROM `aduan` WHERE `student_ic` = '".$_POST['icn']."' ORDER BY `date_in` DESC";
    $res = $db->query($sql);
    if($res->num_rows > 0)
    {
        $aduans = null;
        while($ad = $res->fetch_assoc()){
        $one = array("id"=>$ad['id'],"student_ic"=>$ad['student_ic'],"answerby"=>$ad['answerby'],"subject"=>$ad['subject'],"date_in"=>$ad['date_in'],
            "date_answer"=>$ad['date_answer'],"answer"=>$ad['answer']);
        $aduans[] = $one;
        
        }
        $si = json_encode($aduans,JSON_UNESCAPED_SLASHES);
        echo $si;
    }else        echo '[1]';
    }else        echo '[2]';
} else echo '[3]';
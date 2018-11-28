<?php

if(isset($_POST['icn']) AND isset($_POST['subject']))
{
    include '../config.php';
    
    $sql = "INSERT INTO `aduan` (`id`,`student_ic`,`date_in`,`subject`) VALUES (NULL,'".$_POST['icn']."','".date('y-m-d')."','".$_POST['subject']."')";
    if($db->query($sql)){
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
    }
    } else {
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
    }
    }
} else echo '[]';
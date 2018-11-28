<?php
if(isset($_GET['reg']))
{//move x from studenttemp to students
    include '../tols/headl.inc.php';
    $us = getUnregisteredStudentByID($_GET['sid']);
    if($us != NULL)
    {
        $rs = getStudentByRegID($us['id']);
        if($rs == NULL)
        {
            $sql = "INSERT INTO `students` (`id`, `ic`,`phone1`, `phone2`,`address`,`gender`,`akad`,`isfirst`,`pass`,`addby`,`reg_id`) "
                    . "VALUES (NULL,'".$us['ic']."','".$us['phone1']."','".$us['phone2']."','".$us['address']."'"
                    . ",'".$us['gender']."','".$us['akad']."','".$us['isfirst']."','".$us['pass']."','".$us['addby']."','".$us['id']."')";
        }else {
            $sql = "UPDATE `students` SET `ic` = '".$us['ic']."' ,`phone1` = '".$us['phone1']."', `phone2` = '".$us['phone2']."' ,`address` = '".$us['address']."' "
                    . ",`gender` = '".$us['gender']."',`akad` = '".$us['akad']."', `isfirst` = '".$us['isfirst']."',"
                    . " `pass`= '".$us['pass']."' ,`addby` = '".$us['addby']."' ,`reg_id` = '".$us['id']."'  WHERE `id` = '".$rs['id']."'";
        }
        if($db->query($sql))
        {
          $sql = "UPDATE `studentstemp` SET `isregistered` = '1' WHERE `id` = '".$us['id']."'";
          $db->query($sql);
          echo 'REG BERJAYA';
        }
        else echo 'REG ERROR: '.$sql;
    }else echo 'REG ERROR2';
}
if(isset($_GET['unreg']))
{
    include '../tols/headl.inc.php';
    $us = getUnregisteredStudentByID($_GET['sid']);
    if($us != NULL)
    {
        $rs = getStudentByRegID($us['id']);
        if($rs == NULL)
        {
            $sql = "UPDATE `studentstemp` SET `isregistered` = '0' WHERE `id` = '".$us['id']."'";
            if($db->query($sql))
               echo 'UNREG BERJAYA'; 
            else echo 'UNREG ERROR1';
        }else {
            $sql = "UPDATE `studentstemp` SET `isregistered` = '0' WHERE `id` = '".$us['id']."'";
            $db->query($sql);
            $sql = "DELETE FROM `students` WHERE `id` = '".$rs['id']."'";
            if($db->query($sql))
                echo 'UNREG BERJAYA';
            else echo 'UNREG ERROR2';
        } 
    }else echo 'UNREG ERROR3';

}

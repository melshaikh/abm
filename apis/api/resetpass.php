<?php
if(isset($_POST['newpass']) AND isset($_POST['icn']) AND isset($_POST['oldpass']))
{
    include '../config.php';
    $hashed = hash("sha512",$_POST['oldpass']);
    $sql = "SELECT * FROM `students` WHERE `pass` = '".$hashed."' AND `ic` = '".$_POST['icn']."'";
    $q = $db->query($sql);
    if($q->num_rows > 0)
    {
        $hashed = hash("sha512",$_POST['newpass']);
        $sql = "UPDATE `students` SET `pass` = '".$hashed."' , `isfirst` = 'no' WHERE `ic` = '".$_POST['icn']."'";
        if($db->query($sql))
            echo 'PASSWORD IS SUCCESSFULLY CHANGED';
        else echo 'UNABLE TO CHANGE THE PASSWORD PLEASE TRY AGAIN';
    } else echo 'No.kp and Password not match';
}else echo 'PASSWORD INCORRECT';

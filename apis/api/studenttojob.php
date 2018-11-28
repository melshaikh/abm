<?php
if(isset($_POST['dojob']))
{
    include '../config.php';
    if(strcmp($_POST['dojob'],'APPLY') == 0)
    {
        $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_POST['std_ic']."' AND `job_id` = '".$_POST['job_id']."'";
        $chk = $db->query($sql);
        if($chk->num_rows > 0)
        {
            $zid = $chk->fetch_assoc();
            $sqle = "UPDATE `jobtostudent` SET `status` = 'APPLIED' WHERE `id` = ".$zid['id'];
        }else 
        {
            $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`) VALUES (NULL, '".$_POST['job_id']."', '".$_POST['std_ic']."', 'APPLIED')";
        }
        if($db->query($sqle))
            echo 'JOB APPLIED SUCCESSFULLY';
        else echo 'ERROR...';
    }
    else if(strcmp($_POST['dojob'],'WITHDROW') == 0)
    {
        $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_POST['std_ic']."' AND `job_id` = '".$_POST['job_id']."'";
        $chk = $db->query($sql);
        if($chk->num_rows > 0)
        {
            $zid = $chk->fetch_assoc();
            $sqle = "UPDATE `jobtostudent` SET `status` = 'WITHDROWN' WHERE `id` = ".$zid['id'];
        }else 
        {
            $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`) VALUES (NULL, '".$_POST['job_id']."', '".$_POST['std_ic']."', 'WITHDROWN')";
        }
        if($db->query($sqle))
            echo 'JOB APPLIED SUCCESSFULLY';
        else echo 'ERROR...';
    }
    else if(strcmp($_POST['dojob'],'CONFIRMED') == 0)
    {
        $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_POST['std_ic']."' AND `job_id` = '".$_POST['job_id']."'";
        $chk = $db->query($sql);
        if($chk->num_rows > 0)
        {
            $zid = $chk->fetch_assoc();
            $sqle = "UPDATE `jobtostudent` SET `status` = 'CONFIRMED' WHERE `id` = ".$zid['id'];
        }else 
        {
            $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`) VALUES (NULL, '".$_POST['job_id']."', '".$_POST['std_ic']."', 'CONFIRMED')";
        }
        if($db->query($sqle))
            echo 'JOB APPLIED SUCCESSFULLY';
        else echo 'ERROR...';
    }
    else if(strcmp($_POST['dojob'],'REJECTED') == 0)
    {
        $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_POST['std_ic']."' AND `job_id` = '".$_POST['job_id']."'";
        $chk = $db->query($sql);
        if($chk->num_rows > 0)
        {
            $zid = $chk->fetch_assoc();
            $sqle = "UPDATE `jobtostudent` SET `status` = 'REJECTED' WHERE `id` = ".$zid['id'];
        }else 
        {
            $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`) VALUES (NULL, '".$_POST['job_id']."', '".$_POST['std_ic']."', 'REJECTED')";
        }
        if($db->query($sqle))
            echo 'JOB APPLIED SUCCESSFULLY';
        else echo 'ERROR...';
    }else echo 'ERROR...';
}if(isset($_GET['jobdoo']))
{
    include '../config.php';
    if(strcmp($_GET['jobact'],'ACCEPTED') == 0)
        {
            $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_GET['std_ic']."' AND `job_id` = '".$_GET['job_id']."'";
            if($chk = $db->query($sql))
            {
                    if($chk->num_rows > 0)
                    {
                        $zid = $chk->fetch_assoc();
                        $sqle = "UPDATE `jobtostudent` SET `status` = 'ACCEPTED' , `notify` = 'yes' WHERE `id` = ".$zid['id'];
                    }else 
                    {
                        $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`, `notify`) "
                                . "VALUES (NULL, '".$_GET['job_id']."', '".$_GET['std_ic']."', 'ACCEPTED', 'yes')";
                    }
            }else echo $sql;
            if($db->query($sqle))
                echo 'STUDENT APPLICATION IS ACCEPTED SUCCESSFULLY';
            else echo 'ERROR...';
        }else if(strcmp($_GET['jobact'],'REJECTED') == 0)
        {
            $sql = "SELECT * FROM `jobtostudent` WHERE `student_ic` = '".$_GET['std_ic']."' AND `job_id` = '".$_GET['job_id']."'";
            $chk = $db->query($sql);
            if($chk->num_rows > 0)
            {
                $zid = $chk->fetch_assoc();
                $sqle = "UPDATE `jobtostudent` SET `status` = 'REJECTED' , `notify` = 'yes' WHERE `id` = ".$zid['id'];
            }else 
            {
                $sqle = "INSERT INTO `jobtostudent` (`id`, `job_id`, `student_ic`, `status`, `notify`) "
                        . "VALUES (NULL, '".$_GET['job_id']."', '".$_GET['std_ic']."', 'REJECTED', 'yes')";
            }
            if($db->query($sqle))
                echo 'STUDENT APPLICATION IS REJECTED SUCCESSFULLY';
            else echo 'ERROR...';
}
}

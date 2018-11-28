<?php
if(isset($_GET['name']) AND isset($_GET['message'])){
    include 'apis/headl.inc.php';
    $sql = "SELECT * FROM `aduan` WHERE `type` = 'out' AND `name` = '".$_GET['name']."' AND `email` = '".$_GET['email']."' AND `subject` = '".$_GET['message']."'";
    if($re = $db->query($sql))
    {
        if($re->num_rows < 1)
        {
           $sql = "INSERT INTO `aduan` (`id`,`type`,`subject`,`name`,`email`,`phone`,`date_in`) "
                   . "VALUES(NULL,'out','".$_GET['message']."','".$_GET['name']."','".$_GET['email']."','".$_GET['phone']."','".date('Y-m-d')."')";
           if($db->query($sql))
               echo 'YOUR MESSAGE IS SUCCESSFULLY SENT';
           else echo 'YOU MESSAGE CAN NOT BE SENT AT THE MOMENT, PLEASE TRY AGAIN';
        }else echo 'THIS MESSAGE HAS BEEN SUBMITTED BEFORE';
    }else        echo 'YOU MESSAGE CAN NOT BE SENT AT THE MOMENT, PLEASE TRY AGAIN';
}else echo 'ERROR1';
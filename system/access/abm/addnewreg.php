<?php
if(isset($_GET['stdsave']))
        {
    include '../tols/headl.inc.php';
            $sql = "SELECT * FROM `studentstemp` WHERE `ic` = '".$_GET['icn']."' AND `reg_id` = '".$_SESSION['reg_id']."'";
            $ck = $db->query($sql);
            if($ck->num_rows < 1){
                $pass = hash("sha512",$_GET['icn']);
                $sss = getRegSessionByID($_SESSION['reg_id']);
                $sql = "INSERT INTO `studentstemp` (`id`, `name`,`ic`,`phone1`,`phone2`,`address`,`gender`,`akad`,`email`, `reg_id`"
                        . ", `isfirst`, `pass`, `addby`,`sesi_id`) "
                        . "VALUES (NULL, '".$_GET['name']."', '".$_GET['icn']."', '".$_GET['phone']."', '".$_GET['phone2']."'"
                        . ", '".$_GET['address']."', '".$_GET['gender']."', '".$_GET['akad']."', '".$_GET['email']."', '".$_SESSION['reg_id']."'"
                        . ", 'yes', '".$pass."', '".$_GET['stdsave']."', '".$sss['sesi_id']."')";
                if($db->query($sql))
                    echo 'MAKULUMAT PELATIH BERJAYA SIMPAN';
            }else echo 'MAKULUMAT PELATIH TIDAK BERJAYA SIMPAN1';
        }else echo 'MAKULUMAT PELATIH TIDAK BERJAYA SIMPAN';
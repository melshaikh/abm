<?php
if(isset($_GET['del'])){
    include '../tols/headl.inc.php';
    $x = '0';
    $y = 'BAD';
   $sql = "SELECT * FROM `reg_session` WHERE `id` = '".$_GET['del']."'";
   if($rr = $db->query($sql)){
           if($rr->num_rows > 0)
           {
               $sql = "DELETE FROM `reg_session` WHERE `id` = '".$_GET['del']."'";
                if($db->query($sql))
                    $y= 'GOOD';               
           }else echo 'ERROR2';
   }
    
    $sql="SELECT * FROM `studentstemp` WHERE `reg_id` = '".$_GET['del']."'";
                 if($rr = $db->query($sql)){
                    if($rr->num_rows > 0)
                    {
                        $x= $rr->num_rows;
                        $sql = "DELETE FROM `studentstemp` WHERE `reg_id` = '".$_GET['del']."'";
                        
                        if($db->query($sql))
                           $xz = 'GOOD';
                        
                        
                    }
                 }
    echo $x.' records deleted';
   
}else echo 'ERROR1';
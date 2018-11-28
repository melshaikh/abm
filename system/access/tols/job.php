<?php
include 'config.php';
    $sql = "SELECT * FROM `students` WHERE 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        while($std=$query->fetch_assoc())
        {
           $idd = substr($std['ic'],-1);
           $tes = (int) ((int)$idd % 2);
           if($tes === 1)
           {
               $sql = "UPDATE `students` SET `gender` = 'LELAKI' WHERE `id` = '".$std['id']."'";               
               $db->query($sql);
               //echo '<br>'.$std['name'].' IC:'.$std['ic'].' RES:'.$tes;
           } else {
               $sql = "UPDATE `students` SET `gender` = 'PERMPUAN' WHERE `id` = '".$std['id']."'";               
               $db->query($sql);
               echo '<br>'.$std['name'].' IC:'.$std['ic'].' RES:'.$tes;
           }
           
        }
        
        
         // return $query;
    }
    else
    {
        //return NULL;
    }

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'config.php';
$sql = "SELECT * FROM `students` WHERE 1";
$sts = $db->query($sql);
while($s = $sts->fetch_assoc())
{
    $r = preg_replace("/[^0-9,.]/", "", $s['ic']);
    $sq = "UPDATE `students` SET `ic` = '".$r."' WHERE `students`.`id` = ".$s['id'];
    $db->query($sq);
}
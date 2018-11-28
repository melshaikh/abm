<?php

include '../config.php';
$sql = "SELECT * FROM `students` WHERE `pass` = ''";
if($qr = $db->query($sql)){
$res = '';
while($s = $qr->fetch_assoc()){
$pass = hash("sha512",$s['ic']);
$sql = "UPDATE `students` SET `pass` = '".$pass."', `isfirst` = 'yes' WHERE `id` = '".$s['id']."'";
if($db->query($sql))
$res = $res . "<br> GOOD: ".$s['id']." - ".$s['name'];
else 
$res = $res . "<br>NOT GOOD: ".$s['id']." - ".$s['name'];
}
echo $res; } else echo $sql;
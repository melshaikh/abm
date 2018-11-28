<?php
include 'access/tols/heads.inc.php';
$sql = "DELETE FROM `omr_active_users` WHERE `omr_active_students`.`user` = ". isStudentLoggedIn()['id'];
                    if(mysqli_query($db, $sql)){header("Location:../index.php");}else header("Location:../index.php");
               
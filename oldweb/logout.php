<?php
include './headl.inc.php';
$sql = "DELETE FROM `omr_active_users` WHERE `omr_active_users`.`user` = ". getLecturer()['id'];
                    if(mysqli_query($db, $sql)){
                      header("Location:../index.php");    }
               
<?php
if(isset($_POST['changepass']))
{
    include 'system/access/tols/headl.inc.php';
    if(strcmp($_POST['pnew'],$_POST['pnew2']) == 0)
    {
        if(isLecturerLoggedIn()){
        $u = isLecturerLoggedIn();
        $op = hash("sha512",$_POST['pold']);
        if(strcmp($u['password'],$op) == 0)
        {
          $sql = "UPDATE `omr_users` SET `password` = '".hash("sha512",$_POST['pnew'])."' WHERE `id` = '".$u['id']."'";
          if($db->query($sql))
          {
              $sql = "DELETE FROM `omr_active_users` WHERE `omr_active_users`.`user` = ". getLecturer()['id'];
                    if(mysqli_query($db, $sql)){header("Location:../../../index.php?error=Kata Laluan Berjay di tukar#services");}else header("Location:../../../index.php?error=Kata Laluan Berjay di tukar#services");
              
          }else header("Location:changepass.php?error=ERROR");
        }else {header("Location:changepass.php?error=Kata Laluan lama tidak sama");}
        }else {header("Location:../../../index.php?error=Sila Log Masuk semula#services");}  
    }else header("Location:changepass.php?error=Kata Laluan baru tidak sama");
}

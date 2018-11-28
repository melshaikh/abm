<?php
if(isset($_POST['changepass']))
{
    include '../tols/heads.inc.php';
    if(strcmp($_POST['npass1'],$_POST['npass2']) == 0)
    {
        if(isStudentLoggedIn()){
        $u = isStudentLoggedIn();
        $op = hash("sha512",$_POST['opass']);
        if(strcmp($u['pass'],$op) == 0)
        {
          $sql = "UPDATE `students` SET `pass` = '".hash("sha512",$_POST['npass1'])."', `isfirst` = 'no' WHERE `ic` = '".$u['ic']."'";
          if($db->query($sql))
          {
              $sql = "DELETE FROM `omr_active_students` WHERE `omr_active_students`.`user` = ". getStudent()['id'];
                    if(mysqli_query($db, $sql)){header("Location:../../../pelatih.php?error=Kata Laluan Berjay di tukar1#services");}else header("Location:../../../pelatih.php?error=Kata Laluan Berjay di tukar2#services");
              
          }else header("Location:resetpass.php?error=ERROR");
        }else {header("Location:resetpass.php?error=Kata Laluan lama tidak sama");}
        }else {header("Location:../../../pelatih.php?error=Sila Log Masuk semula#services");}  
    }else header("Location:resetpass.php?error=Kata Laluan baru tidak sama");
}

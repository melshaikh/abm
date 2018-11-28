<?php
if(isset($_POST['dojob'])){
    //generate random password
    include '../config.php';
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$_POST['dojob']."'";
    $querya = $db->query($sql);
    if($querya->num_rows > 0)
    {
        $newpass = RandomString();
        $st = $querya->fetch_assoc();
        $oldpass = $st['pass'];
        $hashed = hash("sha512",$newpass);
        if(strcmp($st['email'],"") != 0){
        $sql = "UPDATE `students` SET `pass` = '".$hashed."' ,`isfirst` = 'yes' WHERE `ic` = '".$_POST['dojob']."'";
        if($db->query($sql)){
            //$to = 'melshaikh.ncs@gmail.com';
            if(sendemail ($st['email'],$newpass,$_POST['dojob']) == 1)
            echo 'An Email with new Password is Sent to your registered Email'.$newpass;
            else  {
                $sql = "UPDATE `students` SET `pass` = '".$oldpass."' WHERE `ic` = '".$_POST['dojob']."'";
                $db->query($sql);
                echo 'YOUR registered email is invalid';
            }
        } else        echo 'Dbase Error: '.$sql;
        }else  echo 'No email is found for No. KP:'.$st['ic'];
        
    }else        echo 'No. KP is not registered';
}else        echo 'No. KP is not registered';
function sendemail($to,$pass,$kp)
{
$subject = 'ABM Password Recovery';
$headers = "From: gmey92@gmail.com \r\n";
$headers .= "Reply-To: gmey92@gmail.com \r\n";
$headers .= "CC: gmey92@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $msg = "New Passwor: ".$pass."\n No.KP: ".$kp;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
if(@mail($to, $subject, $msg, $headers))
        return 1;
else    return 0;
}
function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 7; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
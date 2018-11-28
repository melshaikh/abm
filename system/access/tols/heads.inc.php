<?php session_start();
 define('ABM_COMANY_ID', 4);
include 'config.php';
        $lecturer = isStudentLoggedIn();
function isStudentLoggedIn()
{
    include 'config.php';
    $sessionID = session_id();//mysqli_real_escape_string();
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);//mysqli_real_escape_string();
    $sql = "SELECT * FROM `omr_active_students` WHERE `session_id` = '".$sessionID."' AND `hash` ='".$hash."' AND `expires` > ".time()." LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
        $expires = time()+(60*60);
        $sql = "UPDATE `omr_active_students` SET `expires` = '".$expires."' WHERE `omr_active_students`.`id` = ".$data['id'];
        $db->query($sql);
          return getUser($data['user'],'omr_users');
    }
    else
    {
        return false;
    }
}
function setBidangByShortAndIC($bidang,$sic){
    include 'config.php';
    $sql = NULL;
    if(strcmp($bidang,"BDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '1', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"BLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '1' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"BSDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '1',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"BSLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='1',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"SBDB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='1',`sblb`='0',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"SBLB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='1',`tb`='0',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"TB")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='1',`ll`='0' WHERE `students`.`ic` = ".$sic;
    if(strcmp($bidang,"LL")==0)
    $sql = "UPDATE `students` SET `bdb` = '0', `blb` = '0' , `bsdb` = '0',`bslb`='0',`sbdb`='0',`sblb`='0',`tb`='0',`ll`='1' WHERE `students`.`ic` = ".$sic;
    
    if($sql != NULL){
        if($db->query($sql))
            return "Kerja-Bidang Good";
        else return $sql;
    }else        return "Kerja-Bidang Not Good: ".$sql;
    
    
    
}
function getUserById($id)
{
    include 'config.php';
    $sql = "SELECT * FROM `students` WHERE `id` = ".$id;
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query->fetch_assoc();
    else return NULL;}else {
    return NULL;    
    }
}
function getUser($id,$table)
{
    include 'config.php';
    $sql = "SELECT * FROM `students` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();
    }
    else
    {
        return NULL;
    }
}
function getApplicationListByJobId($jid)
{
    include 'config.php';
    $sql = "SELECT a.* , j.job_id, j.student_ic, j.status, j.date FROM `students` AS a INNER JOIN `jobtostudent` AS j "
            . "WHERE j.job_id = '".$jid."' AND a.ic = j.student_ic GROUP BY a.ic ORDER BY j.date DESC ";
    if($query = $db->query($sql))
    {
        if($query->num_rows > 0)
            return $query;
        else  return NULL;
    }    
    else return NULL;
//    if($query = $db->query($sql))
//    {
//        $nr = $query->num_rows;
//       if($nr  > 0) return $query;
//       else return NULL; 
//    }else return $sql;
    
    
}

function getUserLevel()
{
    include 'config.php';
     $sql = "SELECT * FROM `levels` WHERE 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
}
function getUsersBySearch($t)
{
    include 'config.php';
     $sql = "SELECT * FROM `omr_users` WHERE `name` LIKE '%".$t."%'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
}
function getAduanByKata($ka)
{
   include 'config.php';
     $sql = "SELECT * FROM `aduan` WHERE `subject` LIKE '%".$ka."%' OR `answerby` LIKE '%".$ka."%' OR `answer` LIKE '%".$ka."%'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    }  
}
function getAduanByStudentIc($ic)
{
    include 'config.php';
     $sql = "SELECT * FROM `aduan` WHERE `student_ic` = '".$ic."' ORDER BY `date_in` DESC";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
}
function getAduanByid($ka)
{
   include 'config.php';
     $sql = "SELECT * FROM `aduan` WHERE `id` = '".$ka."' ";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();
    }
    else
    {
        return NULL;
    }  
}
function getStudentByIC($ic)
{
    include 'config.php';
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$ic."'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();
    }
    else
    {
        return NULL;
    } 
}
function getAduanByDate($sd,$ed)
{
    include 'config.php';
    $sql = "SELECT * FROM `aduan` WHERE `date_in` BETWEEN '".$sd."' AND '".$ed."' ORDER BY `date_in` DESC";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
}

function getLevelByUserId($id)
{
    include 'config.php';
    $u = getUserById($id);
     $sql = "SELECT * FROM `levels` WHERE `name` LIKE '%".$u['level']."%'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();
    }
    else
    {
        return NULL;
    } 
    
}
function getJobsByUserId($id,$nlike)
{
    include 'config.php';
    $us = getUserById($id);
    if(strcmp($us['level'],'abm') == 0)
    {
        $sql = "SELECT * FROM `jobs` WHERE `company_id` = '".$us['u_id']."' AND (`name` LIKE '%".$nlike."%' OR `company` LIKE '%".$nlike."%' OR `detail` LIKE '%".$nlike."%' OR `position` LIKE '%".$nlike."%') ORDER BY `sdate` DESC";
    }else
    {
         
        $sql = "SELECT * FROM `jobs` WHERE `company_id` = '".$us['u_id']."' AND `user_id` = '".$us['id']."' AND (`name` LIKE '%".$nlike."%' OR `company` LIKE '%".$nlike."%' OR `detail` LIKE '%".$nlike."%'  OR `position` LIKE '%".$nlike."%')  ORDER BY `sdate` DESC";
    }
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
    
}
function getComanyListByName($t){
    include 'config.php';
    if($t != NULL)
    $sql = "SELECT * FROM `company` WHERE `name` LIKE '%".$t."%' ORDER BY `name`";
    else $sql = "SELECT * FROM `company` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query;
    }
    else
    {
        return NULL;
    } 
}
function getCompanyByID($id)
{
    include 'config.php';
    $sql = "SELECT * FROM `company` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();
    }
    else
    {
        return NULL;
    }
}

function testconnect()
{
    return 'connection is good';
}
function getTredBYStudentID($id)
{
    include 'config.php';
    $sql = "SELECT a.id AS std_id , s.id AS sesi_id , s.tred_id , t.* FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t"
            . " WHERE a.id = '".$id."'  AND s.id = a.sesi_id AND t.id = s.tred_id";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();;
    }
    else
    {
        return NULL;
    }
}
function getBidangBYStudentID($id)
{
    include 'config.php';
    $sql = "SELECT a.id AS std_id , s.id AS sesi_id , s.tred_id , b.* FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `area` AS b"
            . " WHERE a.id = '".$id."'  AND s.id = a.sesi_id AND b.id = s.area_id";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();;
    }
    else
    {
        return NULL;
    }
}
function getJobStudentStat($jobid,$studentic)
{
    include 'config.php';
    $sql = "SELECT * FROM `jobtostudent` WHERE `job_id` = '".$jobid."' AND `student_ic` = '".$studentic."'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        
          return $query->fetch_assoc();;
    }
    else
    {
        return NULL;
    }
}
function getStudentAnalysisByYearAndArea($year,$area)
{
  include 'config.php';
    //$date = DateTime::createFromFormat("Y-m-d", $year);
    //$yx =  $date->format("Y");
    $start = $year.'-01-01';
    $ends = $year.'-12-31';    
    $bdb = 0;
    $blb = 0;
    $bsdb = 0;
    $bslb = 0;
    $sbdb = 0;
    $sblb = 0;
    $ll = 0;
    $tb = 0;
    
    $sql="SELECT * FROM `cohort` WHERE `area_id` = '".$area."' AND ((`sdate` BETWEEN '".$start."' AND '".$ends."') OR (`edate` BETWEEN '".$start."' AND '".$ends."') "
            . "OR (`sdate` <= '".$start."' AND `edate` >= '".$start."') OR (`sdate` >= '".$start."' AND `edate` >= '".$start."'))";
    $re = $db->query($sql);
    $sids=NULL;
    $nstd = 0;
    $nsesi = 0;
    if($re->num_rows > 0)
    {
        while($cc = $re->fetch_assoc()){
        $sql = "SELECT * FROM `students` WHERE `sesi_id` = '".$cc['id']."'";
        $slist = $db->query($sql);
        $nsesi = $slist->num_rows;
        
        if($slist->num_rows > 0)
        {
            while ($s = $slist->fetch_assoc())
            {
                    if($s['bdb'] == 1)
                        $bdb++;
                    if($s['blb'] == 1)
                        $blb++;
                    if($s['bsdb'] == 1)
                        $bsdb++;
                    if($s['bslb'] == 1)
                        $bslb++;
                    if($s['sbdb'] == 1)
                        $sbdb++;
                    if($s['sblb'] == 1)
                        $sblb++;
                    if($s['tb'] == 1)
                        $tb++;
                    if($s['ll'] == 1)
                        $ll++;
            }
        }
        $nstd = $nstd+$slist->num_rows;
        }
    } else  
    {
        $ret = '{"bidang":"'. getAreaByID($area)['name'].'","bdb":"'.$bdb.'","blb":"'.$blb.'","bsdb":"'.$bsdb.'","bslb":"'.$bslb.'",'
            . '"sbdb":"'.$sbdb.'","sblb":"'.$sblb.'","tb":"'.$tb.'","ll":"'.$ll.'","nsesi":"'.$nsesi.'","total":"'.$nstd.'"}';
    }
    
    $ret = '{"bidang":"'. getAreaByID($area)['name'].'","bdb":"'.$bdb.'","blb":"'.$blb.'","bsdb":"'.$bsdb.'","bslb":"'.$bslb.'",'
            . '"sbdb":"'.$sbdb.'","sblb":"'.$sblb.'","tb":"'.$tb.'","ll":"'.$ll.'","nsesi":"'.$nsesi.'","total":"'.$nstd.'"}';
    return $ret;
}
function getTredAndAreaBySesiId($id)
{
    include 'config.php';
    $sql = "SELECT A.name as `tred_name`, B.tred_id, B.area_id, C.name AS `area_name` "
            . "FROM `courses` AS A "
            . "INNER JOIN `cohort`AS B "
            . "INNER JOIN `area` AS C "
            . "WHERE B.`id` = '".$id."' AND A.id = B.tred_id AND C.id = B.area_id";
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query->fetch_assoc();
    else return 0;
}
function updateyears($d)
{
    include 'config.php';
    $date = DateTime::createFromFormat("Y-m-d", $d);
    $y =  $date->format("Y");
    $sql = "SELECT * FROM `years` WHERE `name` = '".$y."' LIMIT 1";
    $re = $db->query($sql);
    if($re->num_rows < 1)
    {
        $sql = "INSERT INTO `years` (`id`, `name`) VALUES (NULL, '".$y."')";
        $db->query($y);
    }
    
}

function getStudent()
{
    include 'config.php';
    $user = isStudentLoggedIn();
    if($user)
    {
        //$query = $db->query("SELECT * FROM `omr_users` WHERE `id`= '".$user['id']."'");
        return $user;
    }
 else {
       return false; 
    }
}
function getUserKeyCount($id)
{
    include 'config.php';
    $sql = "SELECT * FROM `students` WHERE `addby` = '".$id."'";
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query->num_rows;
    else return 0;
    
}

function getCompanyByUserId($id)
{
    include 'config.php';
    $sql = "SELECT b.* FROM `omr_users` AS a INNER JOIN `company` AS b ON a.`id` = b.`user_id` WHERE a.`id` = ".$id;
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query->fetch_assoc();
    else return NULL;}else {
    return NULL;    
    }
}
function getListofUsers()
{
   include 'config.php';
    $sql = "SELECT * FROM `omr_users` WHERE 1";
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query;
    else return NULL;}else {
    return NULL;    
    } 
}
function getYears()
{
   include 'config.php';
    $sql = "SELECT * FROM `years` WHERE 1 ORDER BY `name` DESC";
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query;
    else return NULL;}else {
    return NULL;    
    } 
}
function getYearsASE()
{
   include 'config.php';
    $sql = "SELECT * FROM `years` WHERE 1 ORDER BY `name` ASC";
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query;
    else return NULL;}else {
    return NULL;    
    } 
}
function getJobsList(){
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE 1";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getJobsForStudentByIC($ic)
{
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE `id` NOT IN (SELECT `job_id` FROM `jobtostudent` WHERE `student_ic` = '".$ic."') AND `closing_date` >= '".date('Y-m-d')."'";
    if($query = $db->query($sql))
    {
        if($query->num_rows > 0)
            return $query;
        else return NULL;
    }else return NULL;//->fetch_assoc();
}
function getJobsAppliedByStudentByIC($ic)
{
    require 'config.php';
    $sql = "SELECT a.*, j.position, j.company, j.sdate, j.closing_date FROM `jobtostudent` AS a INNER JOIN `jobs` AS j WHERE a.student_ic = '".$ic."' AND j.id = a.job_id "
            . "ORDER BY a.date DESC";
    if($query = $db->query($sql))
    {
        if($query->num_rows > 0)
            return $query;
        else return NULL;
    }else return NULL;//->fetch_assoc();
}
function getJobListByCompanyId($id)
{
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE `company_id`= '".$id."'";
    $query = $db->query($sql);
    $j = $query;
    return $j;//->fetch_assoc();
}
function getActiveJobList(){
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE `status` <> 'close'";
    $query = $db->query($sql);
    if($query->num_rows > 0)
    return $query;//->fetch_assoc();
    else return NULL;
}
function getJobsById($id){
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE `id`= '".$id."'";
    $query = $db->query($sql);
    $j = $query->fetch_assoc();
    return $j;//->fetch_assoc();
    
}
function getPositionById($id)
{
  require 'config.php';
    $sql = "SELECT * FROM `positions` WHERE `id`= '".$id."'";
    $query = $db->query($sql);
    $j = $query->fetch_assoc();
    return $j;//->fetch_assoc();  
}
function notify($sid,$jid)
{
    require 'config.php';
    $sql = "SELECT * FROM `student_jobs_notification` WHERE `student_id` = '".$sid."' AND `job_id` = '".$jid."'";
    $query = $db->query($sql);
    if($query->num_rows < 1){
      $ss = "INSERT INTO `student_jobs_notification` (`id`, `student_id`, `job_id`, `status`) VALUES (NULL, '".$sid."', '".$jid."', 'open')";  
      $query = $db->query($ss);
    }
}
function getSectionElements($section_id)
{
    require 'config.php';
    $sql = "SELECT * FROM `rms_section` WHERE `section_name` = '".$section_id."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getArea()
{
    require 'config.php';
    $sql = "SELECT * FROM `area` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getSesi()
{
    require 'config.php';
    $sql = "SELECT * FROM `cohort` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getNumberofComapany()
{
    require 'config.php';
    $sql = "SELECT * FROM `company` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    return $query->num_rows;//->fetch_assoc();
}
function getNumberofJobs()
{
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    return $query->num_rows;//->fetch_assoc();
}
function getStudentCountByYear($y)
{
   include 'config.php';
   $time = strtotime('1/1/'.$y);
    $das = date('Y-m-d',$time);
    $tt = strtotime('12/31/'.$y);
    $dae = date('Y-m-d',$tt);
   $sql = "SELECT a.*, s.id AS sesi_id FROM `students` AS a INNER JOIN `cohort` AS s "
           . "WHERE (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."')"
           . " AND a.sesi_id = s.id";
   if($query = $db->query($sql))
    return $query->num_rows;//->fetch_assoc();
   else return 0;
}
function getStudentCountByArea($y)
{
   include 'config.php';
   $aid = getAreaByID($y)['id'];
   $sql = "SELECT a.*, s.id AS sesi_id FROM `students` AS a INNER JOIN `cohort` AS s "
           . "WHERE s.area_id = '".$aid."'"
           . " AND a.sesi_id = s.id";
   if($query = $db->query($sql))
    return $query->num_rows;//->fetch_assoc();
   else return 0;
}
function getStudentCountByTred($y)
{
   include 'config.php';
   $aid = getCourseByID($y)['id'];
   $sql = "SELECT a.*, s.id AS sesi_id FROM `students` AS a INNER JOIN `cohort` AS s "
           . "WHERE s.tred_id = '".$aid."'"
           . " AND a.sesi_id = s.id";
   if($query = $db->query($sql))
    return $query->num_rows;//->fetch_assoc();
   else return 0;
}
function clean($string) {
   //$string = str_replace(' ', ' ', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.
}
function getStudentList2($y,$tred,$bidang)
{
    require 'config.php';
    if(strcmp($y, '-1') != 0)
    {
        $time = strtotime('1/1/'.$y);
        $das = date('Y-m-d',$time);
        $tt = strtotime('12/31/'.$y);
        $dae = date('Y-m-d',$tt);
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT * FROM `students` WHERE 1 ORDER BY `name`";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, b.id AS bidang_id, b.name AS bidang_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `area` AS b "
                . "WHERE "
                . " a.sesi_id = s.id AND b.id = s.area_id AND b.id = '".$bidang."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, t.id AS tred_id, t.name AS tred_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " a.sesi_id = s.id AND b.id = s.area_id AND t.id = '".$tred."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, t.id AS tred_id, t.name AS tred_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " a.sesi_id = s.id AND b.id = s.area_id AND t.id = '".$tred."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') == 0)
    {
       $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate  "
                . "FROM `students` AS a INNER JOIN `cohort` AS s "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') AND  a.sesi_id = s.id ORDER BY a.name"; 
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, b.id  AS bidang_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `area` AS b "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.area_id = '".$bidang."' ORDER BY a.name ";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, t.id  AS tred_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.tred_id = '".$tred."' ORDER BY a.name ";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, t.id  AS tred_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.tred_id = '".$tred."' ORDER BY a.name ";
    }
    
    $sql1 = "SELECT a.* ";
    $sql2 = '';
    $join = ' FROM `students` AS a ';
    $isAnded = FALSE;
    $isSesi = false;
    if(strcmp($sesi, '-1') != 0)
    {
        $isSesi = TRUE;
        $sql1 = $sql1.', s.id AS sesi_id, s.area_id, s.tred_id , s.sdate, s.edate';
        //$sql2 = $sql2." a.sesi_id = '".$sesi."' ";
        $sql2 = $sql2." a.sesi_id = '".$sesi."' AND s.id = '".$sesi."'";
        $join = $join." INNER JOIN `cohort` AS s ";
        $isAnded = TRUE;
    } 
    if(strcmp($tred, '-1') != 0)
    {
        if($isAnded)
        {
        $sql1 = $sql1.', t.id AS tred_id ';
        $join = $join." INNER JOIN `courses` AS t ";
        $sql2 = $sql2." AND s.tred_id = '".$tred."'";
        }
        else 
        {
            $sql1 = $sql1.', t.id As tred_id ';
            $sql2 = $sql2." s.tred_id = '".$tred."'";
            $join = $join." INNER JOIN `courses` AS t ";
            $isAnded = TRUE;
        }
    }
    if(strcmp($bidang, '-1') != 0)
    {
        if($isAnded)
        {
        $sql2 = $sql2." AND s.area_id = '".$bidang."'";
        $sql1 = $sql1.', b.id AS bidang_id ';
        $join = $join." INNER JOIN `courses` AS t ";
        }
        else {
            $sql2 = $sql2." s.area_id = '".$bidang."'";
            $sql1 = $sql1.', b.id AS tred_id ';
            $join = $join." INNER JOIN `area` AS b ";
            $isAnded = TRUE;
        }
    }
    if(strcmp($y, '-1') != 0)
    {
        $time = strtotime('1/1/'.$y);
        $das = date('Y-m-d',$time);
        $tt = strtotime('12/31/'.$y);
        $dae = date('Y-m-d',$tt);
            if($isSesi){
                if($isAnded)
                    {
                    
                    //$join = $join." INNER JOIN `cohort` AS s ";
                    $sql2 = $sql2." AND (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."')";
                    }
                else {                    
                    //$join = $join." INNER JOIN `cohort` AS s ";
                    //$sql1 = $sql1." a.sesi_id = '".$sesi."' AND s.id = '".$sesi."'";
                    $sql2 = $sql2." (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."')";
                    }
                } 
            else
                {
                    if($isAnded)
                    {
                    $sql1 = $sql1.', s.id AS sesi_id, s.area_id, s.tred_id , s.sdate, s.edate';
                    $join = $join." INNER JOIN `cohort` AS s ";
                    $sql2 = $sql2." AND (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') AND a.sesi_id = s.id ";
                    }
                else {
                    $sql1 = $sql1.', s.id AS sesi_id, s.area_id, s.tred_id , s.sdate, s.edate';
                    $join = $join." INNER JOIN `cohort` AS s ";
                    $sql2 = $sql2." ((s.sdate >= ".$das." AND s.sdate <= '".$dae."' ) OR (s.edate >= '".$das."' AND s.edate <= '".$dae."'))  AND a.sesi_id = s.id ";
                    $isAnded = TRUE;
                    }
                }
    }
    if(! $isAnded)
        $sql2 = $sql2." 1";
    $sql = $sql1.$join.' WHERE '.$sql2;
    //return $sql;
    
    if($res = $db->query($sql))
        return $res;
    else        echo $sql;
   //return $sql1.$join.' WHERE '.$sql2;
    
}
function getStudentList($y,$tred,$bidang)
{
    require 'config.php';
    if(strcmp($y, '-1') != 0)
    {
        $time = strtotime('1/1/'.$y);
        $das = date('Y-m-d',$time);
        $tt = strtotime('12/31/'.$y);
        $dae = date('Y-m-d',$tt);
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT * FROM `students` WHERE 1 ORDER BY `name`";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, b.id AS bidang_id, b.name AS bidang_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `area` AS b "
                . "WHERE "
                . " a.sesi_id = s.id AND b.id = s.area_id AND b.id = '".$bidang."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, t.id AS tred_id, t.name AS tred_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " a.sesi_id = s.id AND t.id = s.tred_id AND t.id = '".$tred."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.area_id, t.id AS tred_id, t.name AS tred_name "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " a.sesi_id = s.id AND t.id = s.tred_id AND t.id = '".$tred."' ORDER BY a.name";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') == 0)
    {
       $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate  "
                . "FROM `students` AS a INNER JOIN `cohort` AS s "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') AND  a.sesi_id = s.id ORDER BY a.name"; 
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') == 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, b.id  AS bidang_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `area` AS b "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.area_id = '".$bidang."' AND b.id = '".$bidang."' ORDER BY a.name ";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') == 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, t.id  AS tred_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.tred_id = '".$tred."'  AND t.id = '".$tred."' ORDER BY a.name ";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($tred,'-1') != 0 AND strcmp($bidang,'-1') != 0)
    {
        $sqlx = "SELECT a.* , s.id AS sesi_id, s.sdate, s.edate, t.id  AS tred_id "
                . "FROM `students` AS a INNER JOIN `cohort` AS s INNER JOIN `courses` AS t "
                . "WHERE "
                . " (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."') "
                . " AND  a.sesi_id = s.id AND s.tred_id = '".$tred."' AND t.id = '".$tred."' ORDER BY a.name ";
    }
    
    
    
    
    if($res = $db->query($sqlx))
        return $res;
    else        echo $sqlx;
   //return $sql1.$join.' WHERE '.$sql2;
    
}
function getCohortBYYear($y)
{
    require 'config.php';
    if(strcmp($y, '-1') != 0)
    {
        $time = strtotime('1/1/'.$y);
        $das = date('Y-m-d',$time);
        $tt = strtotime('12/31/'.$y);
        $dae = date('Y-m-d',$tt);
        $sql = "SELECT * FROM `cohort` WHERE (`sdate` BETWEEN '".$das."' AND '".$dae."' OR `edate` BETWEEN '".$das."' AND '".$dae."') ORDER BY `name` DESC ";
    }else
    {
        $sql = "SELECT * FROM `cohort` WHERE 1 ORDER BY ";
    }
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query;
    else return NULL;
    
    
}

function getStudentListByIC($ic)
{
    include 'config.php';
    $sql = "SELECT * FROM `students` WHERE `ic` = '".$ic."'";
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query;
    else return NULL;
}
function getAreaByYear($y)
{
    include 'config.php';
    if(strcmp($y,'-1') != 0){
    $time = strtotime('1/1/'.$y);
    $das = date('Y-m-d',$time);
    $tt = strtotime('12/31/'.$y);
    $dae = date('Y-m-d',$tt);
    $sql = "SELECT a.* , s.area_id , s.sdate , s.edate FROM `area` AS a INNER JOIN `cohort` AS s "
            . "WHERE (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."' ) "
            . "AND s.area_id = a.id GROUP BY a.id";
    }else{
        $sql = "SELECT * FROM `area` WHERE 1 ORDER BY `name`";
    }
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query;
    else return NULL;
}
function getTredByYearAndBidang($y,$b)
{
    include 'config.php';
    $time = strtotime('1/1/'.$y);
    $das = date('Y-m-d',$time);
    $tt = strtotime('12/31/'.$y);
    $dae = date('Y-m-d',$tt);
    if(strcmp($y,'-1') != 0 AND strcmp($b,'-1') != 0)
    {
    $sql = "SELECT * FROM `courses` WHERE 1 ORDER BY `name`";
    }
    if(strcmp($y,'-1') == 0 AND strcmp($b,'-1') != 0)
    {
    $sql = "SELECT * FROM `courses` WHERE `area` = '".$b."' ORDER BY `name`";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($b,'-1') == 0)
    {
    $sql = "SELECT t.* , s.area_id , s.sdate , s.edate FROM `courses` AS t INNER JOIN `cohort` AS s "
            . "WHERE (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."' ) "
            . "AND s.tred_id = t.id GROUP BY t.id";
    }
    if(strcmp($y,'-1') != 0 AND strcmp($b,'-1') != 0)
    {
    $sql = "SELECT t.* , s.area_id , s.sdate , s.edate FROM `courses` AS t INNER JOIN `cohort` AS s INNER JOIN `area` AS b "
            . "WHERE (s.sdate BETWEEN '".$das."' AND '".$dae."' OR s.edate BETWEEN '".$das."' AND '".$dae."' ) "
            . "AND s.tred_id = t.id AND t.area = b.id AND b.id = ".$b." GROUP BY t.id";
    }
    $query = $db->query($sql);
    if($query->num_rows > 0)
        return $query;
    else return NULL;
}
function getTredListByBidang($y)
{
    require 'config.php';
    if(strcmp($y,'-1') != 0){
    
    $sql = "SELECT a.*, s.name AS bidang_name FROM `courses` AS a INNER JOIN `area` AS s WHERE a.area = '".$y."' AND s.id = '".$y."' ORDER BY s.name ";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    }else
    {
    $sql = "SELECT a.*, s.id AS bid, s.name AS bidang_name FROM `courses` AS a INNER JOIN `area` AS s WHERE a.area = s.id ORDER BY s.name ";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    }
}
function getCourses()
{
    require 'config.php';
    $sql = "SELECT * FROM `courses` WHERE 1 ORDER BY `name`";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getStudentByID($id)
{
   require 'config.php';
    $sql = "SELECT * FROM `students` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc(); 
}
function getSesiBYStudentID($id)
{
    require 'config.php';
    $sql = "SELECT a.* FROM `cohort` AS a INNER JOIN `students` AS b WHERE b.id = '".$id."' AND b.sesi_id = a.id";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc(); 
}
function getSesiBYStudentIC($id)
{
    require 'config.php';
    $sql = "SELECT a.* FROM `cohort` AS a INNER JOIN `students` AS b WHERE b.ic = '".$id."' AND b.sesi_id = a.id";
    $query = $db->query($sql);
    return $query;//->fetch_assoc(); 
}
function getStudentListByCourse($id){
    require 'config.php';
    $sql = "SELECT * FROM `students` WHERE `course_id` = '".$id."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
}
function getStudentListByArea($id){
    require 'config.php';
    $sql = "SELECT * FROM `students` WHERE `sesi_id` = '".$id."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
}
function getCohortList($tosort)
{
    require 'config.php';
    $sql = "SELECT * FROM `cohort` WHERE 1 ORDER BY `".$tosort."` DESC";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
}
function getcohortbyid($id)
{
    require 'config.php';
    $sql = "SELECT * FROM `cohort` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc();
}
function getAreaByID($id)
{
  require 'config.php';
    $sql = "SELECT * FROM `area` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc();  
}
function getAreaByCourseId($id)
{
   require 'config.php';
    $sql = "SELECT * FROM `courses` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    $asss = $query->fetch_assoc();
    $areaid = $asss['area'];
    $sql = "SELECT * FROM `area` WHERE `id` = '".$areaid."'";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc();   
}
function getCourseByID($id)
{
  require 'config.php';
    $sql = "SELECT * FROM `courses` WHERE `id` = '".$id."'";
    $query = $db->query($sql);
    return $query->fetch_assoc();//->fetch_assoc();  
}
function getStudentExp($id)
{
    require 'config.php';
    $sql = "SELECT * FROM `students_exp` WHERE `student_id` = '".$id."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getSectionCriterias($section_name)
{
    require 'config.php';
    $sql = "SELECT * FROM `section_criterion` WHERE `name` = '".$section_name."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getCriterionKPI($criterion_name)
{
    require 'config.php';
    $sql = "SELECT * FROM `rms_section` WHERE `criteria_name` = '".$criterion_name."'";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getListbySectionName($sectionName)
{
    require 'config.php';
    $sql = "SELECT * FROM `rms_section` WHERE `section_name` = '".$sectionName."'";
    //mysqli_query($con,$sql);
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
}
function getListbySectionInfos()
{
    require 'config.php';
    $sql = "SELECT * FROM `section_criterion` WHERE 1 ORDER BY `name` ASC";
    //mysqli_query($con,$sql);
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
}
?>


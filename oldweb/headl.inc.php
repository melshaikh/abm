<?php session_start();
include 'config.php';
        $lecturer = isLecturerLoggedIn();
function isLecturerLoggedIn()
{
    include 'config.php';
    $sessionID = session_id();//mysqli_real_escape_string();
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);//mysqli_real_escape_string();
    $sql = "SELECT * FROM `omr_active_users` WHERE `session_id` = '".$sessionID."' AND `hash` ='".$hash."' AND `expires` > ".time()." LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
        $expires = time()+(60*60);
        $sql = "UPDATE `omr_active_users` SET `expires` = '".$expires."' WHERE `omr_active_users`.`id` = ".$data['id'];
        $db->query($sql);
          return $data['user'];
    }
    else
    {
        return false;
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
    
    $sql="SELECT * FROM `cohort` WHERE `area_id` = '".$area."' AND ((`sdate` BETWEEN '".$start."' AND '".$ends."' OR `edate` BETWEEN '".$start."' AND '".$ends."') "
            . "OR (`sdate` < '".$start."' AND `edate` > '".$ends."'))";
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
function getLecturer()
{
    include 'config.php';
    $user = isLecturerLoggedIn();
    if($user)
    {
        $query = $db->query("SELECT * FROM `omr_users` WHERE `id`= '".$user."'");
        return $query->fetch_assoc();
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
function getUserById($id)
{
    include 'config.php';
    $sql = "SELECT * FROM `omr_users` WHERE `id` = ".$id;
    if($query = $db->query($sql)){
    if($query->num_rows > 0)
    return $query->fetch_assoc();
    else return NULL;}else {
    return NULL;    
    }
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
function getJobsList(){
    require 'config.php';
    $sql = "SELECT * FROM `jobs` WHERE 1";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
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
    $sql = "SELECT * FROM `area` WHERE 1";
    $query = $db->query($sql);
    return $query;//->fetch_assoc();
    
}
function getCourses()
{
    require 'config.php';
    $sql = "SELECT * FROM `courses` WHERE 1 ORDER BY `name`";
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


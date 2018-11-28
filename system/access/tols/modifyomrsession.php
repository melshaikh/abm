<?php require 'head.inc.php';if(!isLoggedIn()){print('<a href="admin.php" >Please  login</a>');exit;}?>

<html>
<head>
    <title>OMR School Management</title>
    <link rel="stylesheet" type="text/css" href="css/page_layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
</head> 
<body>
<div id="site_wrapper">
    <header id="content-header">
        <!--<h1>MY HEADER SECTION</h1>-->
        
         <a href="index.php"><img id="logo" src="images/omr_logo.png" alt="" class="img-responsive logo"></a>
         <!--<h1>OMR SYSTEM FOR UNIMAP</h1>-->
        <ul class="menu1">
            <li><a id="tab" href="admin.php" >Admin</a></li>
            <li><a id="tab" href="manageomr.php" >List of Academic Sessions</a></li>
            <li><a id="tab" href="modifyomrsession.php" class="current">Add/Modify Session OMR Collection</a></li>
        </ul>
       
    </header><!-- END header -->
     
        <section class="container">
            <?php
            
            if(isset($_POST['deletesubject']))
            {
                $sql = "DELETE FROM `omr_subjectlist_".$_POST['sem_id']."` WHERE `id` = ".$_POST['sub_id'];
                if($db->query($sql))
                {
                    print($sub_name." has been changed");
                      $lin = "Location:modifyomrsession.php?sem_id=".$_POST['sem_id']."&school_id=".$_POST['school_id'];
                      header($lin);
                }
                else
                print($sql);
            }
            else if(isset($_POST['editsubject']))
            {
                $sub_name = $_POST['subject_name'];
                $sem_id = $_POST['sem_id'];
                $sub_id = $_POST['subject_id'];
                $lecturer = $_POST['lecturer'];
                $cos = $_POST['cos'];
                $lab= $_POST['lab'];
//                $programe = $_POST['programe'];
                  $sql = "UPDATE `omr_subjectlist_".$sem_id."` SET `lecturer` = '".$lecturer."'"
                          . ", `num_cos` = '".$cos.""
                          . "', `has_lab` = '".$lab.""
                          . "', `name` = '".$sub_name.""
//                          . "', `programe` = '".$programe."' "
                          . "WHERE `omr_subjectlist_".$sem_id."`.`id` = ".$sub_id."";
                  if($db->query($sql))
                  {
                      print($sub_name." has been changed");
                      $lin = "Location:modifyomrsession.php?sem_id=".$_POST['sem_id']."&school_id=".$_POST['school_id'];
                      header($lin); 
                      
                  }
                  else
                  print($sql);
            }
            else if(isset($_GET['act']))
            {
                if($_GET['act'] == 'edit')
                {
                    $qe = "SELECT * FROM `omr_subjectlist_".$_GET['sem_id']."` WHERE `id` = ".$_GET['subject_id']." LIMIT 1";
                    if($ss = $db->query($qe))
                    {
                    $r=  $ss->fetch_assoc();
                    $sub_name = $r['name'];
                    echo'<form action="modifyomrsession.php" method="post">'; 
                    echo '<table class="rwd-table">';
                    echo '<tr> <td>Subject name</td>';//subject name row
                    echo '<td><input type = "text" name = " subject_name" value = "'.$sub_name.'" /></td>';
                    echo '<tr> <td>Lecturer Name</td>';//lecturer name row
                    echo'<td><input type="text" name="lecturer" value = "'.$r['lecturer'].'"/></td> </tr>';
                    echo '<tr> <td>Has Lab</td>';//has lab row
                    echo'<td><Select name="lab">'
                    . '<option value=0>NO</option>'
                    . '<option value=1>YES</option></Select></td>';
                    echo'</tr>';
//                    echo '<tr> <td>Programe</td>';//programe row
//                            echo'<td><Select name="programe">'
//                            . '<option value="RK20">RK20</option>'
//                            . '<option value="RK53">RK53</option>'
//                            . '<option value="RK93">RK93</option></Select></td>';
//                    echo'</tr>';
                    echo '<tr> <td>Number of COs</td>';
                            echo'<td><Select name="cos">'
                            . '<option value=1>1</option>'
                            . '<option value=2>2</option>'
                            . '<option value=3>3</option>'
                            . '<option value=4>4</option>'
                            . '<option value=5>5</option></Select></td>';
                    echo'</tr></table>';
                    echo'<input type = "hidden" name = "sem_id" value = "'.$_GET['sem_id'].'" />';
                    echo'<input type = "hidden" name = "school_id" value = "'.$_GET['school_id'].'" />';
                    echo'<input type = "hidden" name = "subject_id" value = "'.$_GET['subject_id'].'" />';
                    echo '<button type="submit" name="editsubject" id="edit_subject">Submit Cahnges</button></br>';
                    echo'</form>';



                    }  
                            
                }
                if($_GET['act'] == 'delete')
                {
                    $sql ="SELECT * FROM `omr_subjectlist_".$_GET['sem_id']."` WHERE `id` = ".$_GET['subject_id']." LIMIT 1";
                    if($res = $db->query($sql))
                    {
                        $r=  $res->fetch_assoc();
                        print('Are you sure you wont to delete: <br>');
                                print('Subject Name:'.$r['name']);
                                print("<br> Lecturer Name: ".$r['lecturer']);
//                                print("<br> Programe: ".$r['programe']);
                        print('<br><form name = "modifyomrsession.php" action = "modifyomrsession.php" method = "POST">');
                        print('<input type = "hidden" name = "sem_id" value = "'.$_GET['sem_id'].'" />');
                        print('<input type = "hidden" name = "school_id" value = "'.$r['school_id'].'" />');
                        print('<input type = "hidden" name = "sub_id" value = "'.$_GET['subject_id'].'" />');

                        print('<input type = "submit" value = "YES DELETE" name = "deletesubject" />');
                        print('<input type = "submit" value = "NO GO BACK" name = "sessionIsSelected" />');
                        print('</form>');
                    }
                }
            }
            else if(isset($_POST['addnewsubject']))
            {
                $sql = "SELECT * FROM `omr_subjects` WHERE `id` =".$_POST['subject_id']." LIMIT 1";
                $sub = $db->query($sql);
                $sub_r = $sub->fetch_assoc();

                $sub_name = $sub_r['code']." ".$sub_r['name'];
                $cos = $sub_r['num_cos'];
                $lab = $sub_r['lab'];
                $school_id =$sub_r['school_id'];
                $subject_table_name = "omr_subjectlist_".$_POST['sem_id'];
                $lecturer_name = $_POST['lecturer_name'];
//                $programe = $_POST['programe'];
                $sql = "INSERT INTO `omr_subjectlist_".$_POST['sem_id']."` (`id`, `name`, `sem_id`, `lecturer`, `num_cos`, `has_lab`, `school_id`) "
                        . "VALUES (NULL, '".$sub_name."', '".$_POST['sem_id']."', '".$lecturer_name."', '".$cos."', '".$lab."', '".$school_id."')";
                if( $db->query($sql))
                {
                    $lin = "Location:modifyomrsession.php?sem_id=".$_POST['sem_id']."&school_id=".$school_id;
                    header($lin);  
                }else{
                    print($sql);
                }
            }
            else if(isset($_POST['sessionIsSelected']) OR ( isset($_GET['sem_id']) AND isset($_GET['school_id']))AND (!isset($_GET['act'])))
            {
                
                if(isset($_POST['sessionIsSelected']) OR isset ($_POST['backtosession']) )
                {
                    $sem_id = $_POST['sem_id'];
                    $school_id = $_POST['school_id'];
                }
                else {
                    $sem_id = $_GET['sem_id'];
                    $school_id = $_GET['school_id'];
                }
                    
                $q="SELECT * FROM `omr_sems` WHERE `id` = ".$sem_id." LIMIT 1";
                $rq=  $db->query($q);
                $f = $rq->fetch_assoc();
                $sem_name = $f['name'];
                //Add new subject form
                echo'<h1>Add new subjects for Academic session:'.$sem_name.'</h1>';
                echo'<table class="rwd-table">';                      
                echo'<thead><tr><th>Subject </th><th>Lecturer</th></tr></thead><tbody>';
                $slq = "SELECT * FROM `omr_subjects` WHERE `school_id`=".$school_id;
                $sss = $db->query($slq);
                echo'<form action = "modifyomrsession.php" method = "POST">';
                echo'<tr><td id="longer"><select name = "subject_id">';
                    while($s_list = $sss->fetch_assoc())
                    {
                        echo'<option value="'.$s_list['id'].'">'.$s_list['code'].' '.$s_list['name'].'</option>';
                    }
                echo'</select></td><td>';
                echo'<input type = "text" name = "lecturer_name" value = "" />';
                echo'</td>';
//                echo'<td>
//                <select name = "programe" size = "1">
//                <option value="RK20">RK20</option>
//                <option value="RK53">RK53</option>
//                <option value="RK93">RK93</option>
//                </select>
//                </td>';
                echo'</tr>';
                echo'</tbody></table>';
                echo'<input type = "hidden" name = "sem_id" value = "'.$sem_id.'" />';
                echo'<input type = "hidden" name = "school_id" value = "'.$school_id.'" />';
                echo'<input type = "submit" value = "Add subject" name = "addnewsubject" />';
                echo'</form>';
                    
                // List of Subjects table
                if(isset($_GET['sem_id']))
                $qry = "SELECT * FROM `omr_subjectlist_".$sem_id."` WHERE `school_id`=".$school_id." ORDER BY `id` DESC";
                else {
                $qry = "SELECT * FROM `omr_subjectlist_".$sem_id."` WHERE `school_id`=".$school_id." ORDER BY `name` ASC";
                }
                $res = $db->query($qry);
                echo'<h1>List of Existing subjects for Academic session:'.$sem_name.'</h1>';
                echo '<table class="rwd-table">';
                echo "<tr> <th>Subject Name</th> <th>Lecturer</th> <th>Has Lab</th> <th>Number of COs</th></tr>";
                while($r = $res->fetch_assoc(  )) {

                        // echo out the contents of each row into a table
                    if($r['has_lab'] == 0)
                    {
                        $has_lab = "NO";
                    }
                    else {
                        $has_lab = "YES";
                    }
                        echo "<tr>";
                        echo '<td>' . $r['name'] . '</td>';
                        echo '<td>' . $r['lecturer'] . '</td>';
                        echo '<td>' . $has_lab . '</td>';
//                        echo '<td>' . $r['programe'] . '</td>';
                        echo '<td>' . $r['num_cos'] . '</td>';
                        echo '<td><a href="modifyomrsession.php?subject_id=' . $r['id'] . '&sem_id='.$r['sem_id'].'&act=edit&school_id='.$school_id.'">Edit</a></td>';
                        echo '<td><a href="modifyomrsession.php?subject_id=' . $r['id'] . '&sem_id='.$r['sem_id'].'&act=delete&school_id='.$school_id.'">Delete</a></td>';
                        echo "</tr>"; 
                }
                echo "</table>";

            
                    
            }
            elseif(isset($_POST['selectschool']))
            {//academic session not selected yet
            
            $sql="SELECT * FROM `omr_sems` WHERE 1";
            $result_sem_list = $db->query($sql);
            $program_id= $_POST['program_id'];
            $sql1 = "SELECT * FROM `omr_schools` WHERE `program_id` = ".$program_id;
            $result_program_list = $db->query($sql1);
            echo'<form action="modifyomrsession.php" method="post">'; 
            echo '<table class="rwd-table">';
                echo '<tr> <td>Select Academic Session</td>';
                        echo'<td><select name="sem_id">';
                        while($row = $result_sem_list->fetch_assoc())
                        {
                            echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                        echo'</select></td>';
                echo'</tr>';
                echo '<tr> <td>Select Program</td>';
                        echo'<td><select name="school_id">';
                        while($row = $result_program_list->fetch_assoc())
                        {
                            echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }

                           echo'</select></td>';
                echo'</tr>';
                echo'</table>';
                echo '<p class="submit"><input type="submit" name="sessionIsSelected" value="Submit"style="margin-left: 45%;"></p>';
            echo'</form>';
              
            }
            
                    
            else {
            $sql="SELECT * FROM `omr_program` WHERE 1";
            $result_school_list = $db->query($sql);

            echo'<form action="modifyomrsession.php" method="post">'; 
            echo '<table class="rwd-table">';
                echo '<tr> <td>Select School</td>';
                        echo'<td><select name="program_id">';
                        while($row = $result_school_list->fetch_assoc())
                        {
                            echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                        echo'</select></td>';
                echo'</tr>';
                echo'</table>';
                echo '<p class="submit"><input type="submit" name="selectschool" value="Submit"></p>';
            echo'</form>';
            }
            ?>
        </section>
     
    
     
    <footer id="foot"style="background-color: #083156; color:white">
                <p>@Copyright School of Computer and Communication Engineering</p>
    </footer>
</div><!-- END site_wrapper -->
</body>
</html>




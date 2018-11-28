<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
  	// echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
	//including the database connection file
        //include '../headl.inc.php';
      	include_once("../config.php");
  	  	
  	//$_FILES['image']['name']   give original name from parameter where 'image' == parametername eg. city.jpg
  	//$_FILES['image']['tmp_name']  temporary system generated name
  
//        $originalImgName= 'cv_'.$_POST['icn'].'.pdf';
//        $tempName= $_FILES['profileimage']['tmp_name'];
//        $folder="../../user_files/";
//        $url = $originalImgName; //update path as per your directory structure 
//        
//        if(move_uploaded_file($tempName,$folder.$originalImgName)){
//                //$query = "INSERT INTO upload_image_video (pathToFile) VALUES ('$url')";
//                $query = "UPDATE `students` SET `cv_file` = '".$url."' WHERE `ic` = ".$_POST['icn'];
//                //$query = "UPDATE `students` SET `image` = ''";
//                if($db->query($query)){
//                    echo 'OK';
//                    //echo json_encode(array( "status" => "true","message" => "Successfully file added!" , "data" => $tempName) );
//                }else{
//                	echo json_encode(array( "status" => "false","message" => "Failed!") );
//                }
//        	//echo "moved to ".$url;
//        }else{
//        	echo json_encode(array( "status" => "false","message" => "Failed!") );
//        }
        ////starts here
        include_once("../config.php");
  	  	
  	//$_FILES['image']['name']   give original name from parameter where 'image' == parametername eg. city.jpg
  	//$_FILES['image']['tmp_name']  temporary system generated name
  
        $originalImgName= 'cv_'.$_POST['icn'].'.pdf';
        $tempName= $_FILES['profileimage']['tmp_name'];
        $folder="../../user_files/";
        $url = $originalImgName; //update path as per your directory structure
        //starts here 
        $target_dir = "../../user_files/cv_";
            
            $uploadOk = 1;
            $already = 1;
            $target_file = $target_dir . basename($_FILES["profileimage"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $thefile = 'pimage_'. $_POST['icn'].'.'.$imageFileType;
            $target_file = $target_dir . $_POST['icn'].'.'.$imageFileType;
            $error = '';
            // Check if image file is a actual image or fake image
            if(!empty($_FILES["profileimage"]["tmp_name"])) {
                $check = getimagesize($_FILES["profileimage"]["tmp_name"]);
                
             
            // Check if file already exists
            if (file_exists($target_file)) {
               // $error = $error . "Sorry, file already exists.";
                $already = 0;
            }
            // Check file size
            if ($_FILES["profileimage"]["size"] > 5000000) {
                $error = $error . "Sorry, your file is too large.";
                $uploadOk = 0;
                $error = $error.' FILE SIZE IS MORE THAN 5 MB';
            }
            // Allow certain file formats
            if($imageFileType != "pdf") {
                $error = $error . " - Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error = "Sorry, your file was not uploaded for: ".$error ;
                echo $error ;
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
                    //$sql = "UPDATE `students` SET `image` = '".$thefile."' WHERE `ic` = '".$_POST['icn']."'";
                    $sql = "UPDATE `students` SET `cv_file` = '".$url."' WHERE `ic` = ".$_POST['icn'];
                    $db->query($sql);
                    $error = "OK";
                } else {
                    $error = $error . "Sorry, there was an error uploading your file.";
                }
                echo $error;
            }
            }else{
                echo 'ERROR 0';
                //return;
            }
        
        
        
        //ends here
        
//        if(move_uploaded_file($tempName,$folder.$originalImgName)){
//                //$query = "INSERT INTO upload_image_video (pathToFile) VALUES ('$url')";
//                $query = "UPDATE `students` SET `image` = '".$url."' WHERE `ic` = ".$_POST['icn'];
//                //$query = "UPDATE `students` SET `image` = ''";
//                if($db->query($query)){
//                
//                	 echo json_encode(array( "status" => "true","message" => "Successfully file added!" , "data" => $tempName) );
//                }else{
//                	echo json_encode(array( "status" => "false","message" => "Failed!") );
//                }
//        	//echo "moved to ".$url;
//        }else{
//        	echo json_encode(array( "status" => "false","message" => "Failed!") );
//        }
  }else echo json_encode(array( "status" => "false","message" => "No Image File!") );

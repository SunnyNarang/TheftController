<?php
 include "conn.php";
    $email = $_POST['email'];
	//	$email = "ram";
	$email=filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$device_id = "";
	$device_id = $_POST['device_id'];
	//$password = "q";
	//$password =md5($password);
	if(!empty($email) && !empty($password)){
                
            
            $query = "SELECT * FROM `login` WHERE `username`= '".$email."'";
        
		$result = mysqli_query($conn,$query) or die(mysql_error());
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //var_dump($query);
               //var_dump($rows);
        
                $userid=$rows['id'];
                $id_type=$rows['id_type'];
                $email2 = $rows['email'];
               $name = $rows['name'];
               $phone = $rows['phone'];
                $codecheck=$rows['active'];
                //var_dump($codecheck);
                if($email==$rows['username'] && $password==$rows['password'])
                {

                if($codecheck==0)
                        {
                            $minfo = array("success"=>'notactive');
                            $jsondata = json_encode($minfo);
                        }
                        else{
                            
                            if($device_id!=""&&$device_id==$rows['device_id']){
                            
                                $minfo = array("name"=>$name,"phone"=>$phone,"success"=>'true', "message"=>'Log in successfully',"id"=>$userid,"id_type"=>$id_type,"email"=>$email2);
                                $jsondata = json_encode($minfo);
                            }
                            
                            else{
                                $minfo = array("success"=>'notactive');
                                $jsondata = json_encode($minfo);
                                
                                $stmt3 = $conn->prepare('select * from otp where email = ?');
                                $stmt3->bind_param('s',$email);
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();
                                if ($result3->num_rows >0){}else {
                                     $otp = mt_rand(100000, 999999);
        
                                $query2 = "DELETE FROM `otp` where `email` = '".$email."'";
                                $resultinsert2 = mysqli_query($conn,$query2);
        
                                $query2 = "INSERT INTO `otp` (email,otp) VALUES('".$email."','".$otp."')";
                                $resultinsert2 = mysqli_query($conn,$query2);
                                $mailto= $email; 
                        
                                $subject = "DisasterMaster Verification Code";
                        
                                $from="info@disastermaster.website";
                                
                                $message_body = "Hello User, your verification code is ".$otp;
                        
                                $nice = mail($mailto,$subject,$message_body,"From:".$from);
                                }
                                
                                /*
                               
                                
                                */
                            }
                            
                            
                            
                        }
            
            /*else
            {
                if(!empty($codecheck)){
                    
                
             $minfo = array("success"=>'notactive', "message"=>'Account verification is pending. Please confirm your email.',"userid"=>$userid);
      $jsondata = json_encode($minfo);
                    } 
            }*/
            
                
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                }else
                {
                if($email==$rows['username']){
                    $minfo = array("success"=>'false', "message"=>'Invalid email or password');
      $jsondata = json_encode($minfo); 
        }else
        {
        $minfo = array("success"=>'false', "message"=>'Account does not exist. Please signup');
      $jsondata = json_encode($minfo); 
        }
                }
	}else
        {
            
             $minfo = array("success"=>'false', "message"=>'Empty field either username or password');
             $jsondata = json_encode($minfo);
            
        }
 print_r($jsondata);
$conn->close();
?>
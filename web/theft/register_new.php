<?php


include 'conn.php';

        $uid = uniqid(rand());
		$email= $_POST['email'];
		$name= $_POST['name'];
		$email=filter_var($email, FILTER_SANITIZE_EMAIL);		
		$number= $_POST['number']; 
		$password= $_POST['password'];
		$adhaar= $_POST['adhaar'];
		$address= $_POST['address'];
	 
	    
	    
		$idtype="0";
	
		$sqla="SELECT `username` FROM `login` WHERE username='".$email."'";
         
          $checka= mysqli_query($conn, $sqla);
          $resultchecka= mysqli_fetch_array($checka,MYSQLI_BOTH);
         
    
         
          
          if(!empty($resultchecka)){
                    	    $minfo = array("success"=>'false', "message"=>'username already exists!');
                            $jsondata = json_encode($minfo);
                            print_r($jsondata);
                            exit();
    
          }
	

		
		
///////////////////////////////////////////////////////////////	
	
	if(!empty($password) && !empty($email) && !empty($number)){
                        if (strlen($password) <= '5') 
                        {
                                         $minfo = array("success"=>'false', "message"=>'Your password must contain at least 6 characters!');
                                         $jsondata = json_encode($minfo);
                                        print_r($jsondata);
                                        exit();
                            
                        }
             
                            
                          $sql="SELECT `email` FROM `login` WHERE `email`='".$email."'";
                         
                          $check= mysqli_query($conn, $sql);
                          $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
                          //$userid=$resultcheck['uid'];
         
    
         
          
          if(!$resultcheck){
              
              
                                             $query = "INSERT INTO `login` (username,email,phone,id_type,password,name,active,device_id,adhaar,address) VALUES('".$email."','".$email."','".$number."','".$idtype."','".$password."','".$name."',1,'1','".$adhaar."','".$address."')";
                                            $resultinsert = mysqli_query($conn,$query);
                                            
                                            
                                            $otp = mt_rand(100000, 999999);
                                $query2 = "INSERT INTO `otp` (email,otp) VALUES('".$email."','".$otp."')";
                                            $resultinsert2 = mysqli_query($conn,$query2);
                                            
                                        $mailto= $email; 
                                
                                        $subject = "DisasterMaster Verification Code";
                                
                                        $from="info@disastermaster.website";
                                        
                                        $message_body = "Hello ".$name.", your verification code is ".$otp;
                                
                                        $nice = mail($mailto,$subject,$message_body,"From:".$from);
                                            
                                            
                                      $minfo = array("success"=>'true', "message"=>'Registration successfully',"userid"=>$uid);
                                      $jsondata = json_encode($minfo);   
                                }
                                      
                         else{
                            			$lastid = "SELECT `uid` FROM `login` WHERE `email`='".$email."'";
                                       //var_dump($query);
                                        $check= mysqli_query($conn, $lastid);
                                        $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
                                     
                                   $minfo = array("success"=>'false', "message"=>'E-Mail already exist. Please Signin',"userid"=>$resultcheck[0]);
                                  $jsondata = json_encode($minfo); 
                            
                            	}
	 
	    
	            }     
	
	else
                 {
                        //echo 'QUERY FAILED';
                         $minfo = array("success"=>'false', "message"=>'Empty field not allowed');
                        $jsondata = json_encode($minfo);
            
                 } 
                     print_r($jsondata);
                     $conn->close();

?>
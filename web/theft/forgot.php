<?php

 include "conn.php";
$username = $_POST["email"];

$stmt = $conn->prepare("select * from login where username = ?");
$stmt->bind_param('s',$username);
if($stmt->execute()){
    
$result = $stmt->get_result();
 if ($result->num_rows > 0){ 
 $r=$result->fetch_assoc();
 $password=$r['password'];
 $name=$r['name'];
    
        $mailto= $username; 

        $subject = "Forgot password";

        $from="info@disastermaster.website";
        
        $message_body = "Hello ".$name.", your password is".$password;

        $nice = mail($mailto,$subject,$message_body,"From:".$from);

        if($nice){
            echo "1";
        }else{
    
         echo "0";

}
}
else{
    echo "10";
}


}


mysql_close($conn);


?>
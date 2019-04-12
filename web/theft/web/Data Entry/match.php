<?php 
 
 include "conn.php";


 $sellerid = "174";
 $productid = "2";
 $compname="1";
 $material="1";
 $weight="1";
 $size="1";
 $karat="23";
 $stone="PEARL";
 $price="20";


 $stmt = $conn->prepare("SELECT *FROM ring");


$stmt->execute();
$result = $stmt->get_result();
 while($temp=$result->fetch_assoc())
 {
     
 $i = 0;
 
 if($temp['compname'] == $compname){
 $i++;
 }if($temp['material'] == $material){
 $i++;
 }if($temp['weight'] == $weight){
 $i++;
 }if($temp['size'] == $size){
 $i++;
 } if($temp['karat'] == $karat){
 $i++;
 } if($temp['stone'] == $stone){
 $i++;
 } if($temp['price'] == $price){
 $i++;
 
 }
	
			
 
 if($i >= 4){
 //array_push($property, $temp);
  
 $stmt2=$conn->prepare("INSERT INTO `sus_ring` (`buy_id`,`stolen_id`,`seller_id`) VALUES(?,?,?)"); 
 $stmt2->bind_param('sss',$productid,$temp['id'],$sellerid);
 if($stmt2->execute()){
 
 $stmt3=$conn->prepare("UPDATE login SET  `sus` =  `sus` +1 WHERE  `id` =?"); 
 $stmt3->bind_param('s',$sellerid);
 $stmt3->execute();
 }
 }
 }
  
  ?>


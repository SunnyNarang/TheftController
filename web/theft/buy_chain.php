<?php
error_reporting(0);
 include "conn.php";
$seller = $_POST["seller"];
$company = $_POST["company"];
$weight = $_POST["weight"];
$material = $_POST["material"];
$size = $_POST["size"];
$karat = $_POST["karat"];
$price = $_POST["price"];
$buyer = $_POST["buyer"];
$other1 = $_POST["other1"];
$other2 = $_POST["other2"];
$image = $_POST["image"];

 if($image!=''){ 
$image_name = $buyer.date("Y-m-d-h-i-sa").'.jpg';
file_put_contents('img/'.$image_name, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image)));
   }
   else{
    $image_name = "";
   }
$stmt = $conn->prepare("INSERT INTO `theft`.`chain_buy` (`image`,`other1`,`other2`,`id`, `seller`, 
`company`, `weight`, `material`, `size`, `karat`, `price`,`buyer`) VALUES (?,?, ?,NULL, ?,?,?,?,?,?,?,?);");
$stmt->bind_param('sssssssssss',$image_name,$other1,$other2,$seller,$company,$weight,$material,$size,$karat,$price,$buyer);
if($stmt->execute()){
         echo "1";
        }else{
         echo "0";
}



$productid =mysqli_insert_id($conn);
$stmt2 = $conn->prepare("SELECT * FROM chain");


$stmt2->execute();
$result = $stmt2->get_result();
 while($temp=$result->fetch_assoc())
 {
     
 $i = 0;
 
 if($temp['compname'] == $company){
 $i++;
 }if($temp['material'] == $material){
 $i++;
 }if($temp['weight'] == $weight){
 $i++;
 }if($temp['size'] == $size){
 $i++;
 } if($temp['karat'] == $karat){
 $i++;
 }  if($temp['price'] == $price){
 $i++;
 
 }
	
			
 
 if($i >= 4){
 //array_push($property, $temp);
  
 $stmt4=$conn->prepare("INSERT INTO `chain_sus` (`buy_id`,`stolen_id`,`seller_id`) VALUES(?,?,?)"); 
 $stmt4->bind_param('sss',$productid,$temp['id'],$seller);
 if($stmt4->execute()){
 
 $stmt3=$conn->prepare("UPDATE login SET  `sus` =  `sus` +1 WHERE  `id` =?"); 
 $stmt3->bind_param('s',$seller);
 $stmt3->execute();
 }
 }
 }


mysql_close($conn);


?>
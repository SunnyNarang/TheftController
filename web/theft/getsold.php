<?php


 include("conn.php");

$username = $_POST['username'];


$stmt2 = $conn->prepare("SELECT bangle_buy.image, (select login.name from login where login.id = bangle_buy.buyer) 
as seller_name,bangle_buy.id as buy_id,bangle_buy.company as comp, bangle_buy.price
FROM bangle_buy inner JOIN login ON bangle_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Bangle-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
 
 $stmt2 = $conn->prepare("SELECT  car_buy.image,(select login.name from login where login.id = car_buy.buyer)
 as seller_name,car_buy.id as buy_id,car_buy.company as comp, car_buy.price
FROM car_buy inner JOIN login ON car_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Car-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
  $stmt2 = $conn->prepare("SELECT  chain_buy.image,(select login.name from login where login.id = chain_buy.buyer) 
  as seller_name,chain_buy.id as buy_id,chain_buy.company as comp, chain_buy.price
FROM chain_buy inner JOIN login ON chain_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Chain-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
 
   $stmt2 = $conn->prepare("SELECT earring_buy.image, (select login.name from login where login.id = earring_buy.buyer)
   as seller_name,earring_buy.id as buy_id,earring_buy.company as comp, earring_buy.price
FROM earring_buy inner JOIN login ON earring_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Earring-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
    $stmt2 = $conn->prepare("SELECT necklace_buy.image, (select login.name from login where login.id = necklace_buy.buyer)
    as seller_name,necklace_buy.id as buy_id,necklace_buy.company as comp, necklace_buy.price
FROM necklace_buy inner JOIN login ON necklace_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Necklace-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
    $stmt2 = $conn->prepare("SELECT  phone_buy.image,(select login.name from login where login.id = phone_buy.buyer) 
    as seller_name,phone_buy.id as buy_id,phone_buy.company as comp, phone_buy.price
FROM phone_buy inner JOIN login ON phone_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Phone-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
    $stmt2 = $conn->prepare("SELECT  purse_buy.image,(select login.name from login where login.id = purse_buy.buyer)
    as seller_name,purse_buy.id as buy_id,purse_buy.company as comp, purse_buy.price
FROM purse_buy inner JOIN login ON purse_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Purse-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
    $stmt2 = $conn->prepare("SELECT  ring_buy.image,(select login.name from login where login.id = ring_buy.buyer) 
    as seller_name,ring_buy.id as buy_id,ring_buy.company as comp, ring_buy.price
FROM ring_buy inner JOIN login ON ring_buy.seller = login.id
WHERE login.id =?");
$stmt2->bind_param('s',$username);

$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
 while($r2=$result2->fetch_assoc())
 {
    $r2['buy_id'] = 'Ring-'.$r2['buy_id'];
  $res[] = $r2;
 }
 }
 

	echo json_encode($res)


?>

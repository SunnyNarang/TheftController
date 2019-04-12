<?php
include("./conn.php");
error_reporting(0);
 $id=$_GET['id'];
$id=htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
$count = 1;
?>


<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<style>
 ul {
    width: 100%;
    display: table;
    table-layout: fixed; /* optional, for equal spacing */
    border-collapse: collapse;
    margin:0px;
}
li {
    display: table-cell;
    text-align: center;
    border: 1px solid black;
    vertical-align: middle;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-container">

<h2>Suspicious Items</h2>

<?php
$stmt2 = $conn->prepare("SELECT bangle.compname, bangle.material, bangle.weight, bangle.size, bangle.karat, bangle.stone, bangle.price, bangle_buy.company AS compname1, bangle_buy.material AS material1, bangle_buy.weight AS weight1, bangle_buy.size AS size1, bangle_buy.karat AS karat1, bangle_buy.stone AS stone1, bangle_buy.price AS price1
FROM bangle_sus
INNER JOIN bangle ON bangle.id = bangle_sus.stolen_id
INNER JOIN bangle_buy ON bangle_buy.id = bangle_sus.buy_id
WHERE bangle_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Bangles:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Material</li>
  <li>Weight</li>
  <li>Size</li>
  <li>Karat</li>
  <li>Stone</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['compname'];?></li>
  <li><?php echo $temp['material'];?></li>
  <li><?php echo $temp['weight'];?></li>
  <li><?php echo $temp['size'];?></li>
  <li><?php echo $temp['karat'];?></li>
  <li><?php echo $temp['stone'];?></li>
  <li><?php echo $temp['price'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['compname1'];?></li>
  <li><?php echo $temp['material1'];?></li>
  <li><?php echo $temp['weight1'];?></li>
  <li><?php echo $temp['size1'];?></li>
  <li><?php echo $temp['karat1'];?></li>
  <li><?php echo $temp['stone1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>

<?php
$stmt2 = $conn->prepare("SELECT chain.compname, chain.material, chain.weight, chain.size, chain.karat, chain.price, chain_buy.company AS compname1, chain_buy.material AS material1, chain_buy.weight AS weight1, chain_buy.size AS size1, chain_buy.karat AS karat1, chain_buy.price AS price1
FROM chain_sus
INNER JOIN chain ON chain.id = chain_sus.stolen_id
INNER JOIN chain_buy ON chain_buy.id = chain_sus.buy_id
WHERE chain_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Chains:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Material</li>
  <li>Weight</li>
  <li>Size</li>
  <li>Karat</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['compname'];?></li>
  <li><?php echo $temp['material'];?></li>
  <li><?php echo $temp['weight'];?></li>
  <li><?php echo $temp['size'];?></li>
  <li><?php echo $temp['karat'];?></li>
  <li><?php echo $temp['price'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['compname1'];?></li>
  <li><?php echo $temp['material1'];?></li>
  <li><?php echo $temp['weight1'];?></li>
  <li><?php echo $temp['size1'];?></li>
  <li><?php echo $temp['karat1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>


<?php
$stmt2 = $conn->prepare("SELECT earring.compname, earring.material, earring.weight, earring.size, earring.karat, earring.price, earring_buy.company AS compname1, earring_buy.material AS material1, earring_buy.weight AS weight1, earring_buy.size AS size1, earring_buy.karat AS karat1,  earring_buy.price AS price1
FROM earring_sus
INNER JOIN earring ON earring.id = earring_sus.stolen_id
INNER JOIN earring_buy ON earring_buy.id = earring_sus.buy_id
WHERE earring_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Earrings:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Material</li>
  <li>Weight</li>
  <li>Size</li>
  <li>Karat</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['compname'];?></li>
  <li><?php echo $temp['material'];?></li>
  <li><?php echo $temp['weight'];?></li>
  <li><?php echo $temp['size'];?></li>
  <li><?php echo $temp['karat'];?></li>
  <li><?php echo $temp['price'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['compname1'];?></li>
  <li><?php echo $temp['material1'];?></li>
  <li><?php echo $temp['weight1'];?></li>
  <li><?php echo $temp['size1'];?></li>
  <li><?php echo $temp['karat1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>
<?php
$stmt2 = $conn->prepare("SELECT necklace.compname, necklace.material, necklace.weight, necklace.size, necklace.karat, necklace.price, necklace_buy.company AS compname1, necklace_buy.material AS material1, necklace_buy.weight AS weight1, necklace_buy.size AS size1, necklace_buy.karat AS karat1,  necklace_buy.price AS price1
FROM necklace_sus
INNER JOIN necklace ON necklace.id = necklace_sus.stolen_id
INNER JOIN necklace_buy ON necklace_buy.id = necklace_sus.buy_id
WHERE necklace_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Necklaces:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Material</li>
  <li>Weight</li>
  <li>Size</li>
  <li>Karat</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['compname'];?></li>
  <li><?php echo $temp['material'];?></li>
  <li><?php echo $temp['weight'];?></li>
  <li><?php echo $temp['size'];?></li>
  <li><?php echo $temp['karat'];?></li>
  <li><?php echo $temp['price'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['compname1'];?></li>
  <li><?php echo $temp['material1'];?></li>
  <li><?php echo $temp['weight1'];?></li>
  <li><?php echo $temp['size1'];?></li>
  <li><?php echo $temp['karat1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>


<?php
$stmt2 = $conn->prepare("SELECT ring.compname, ring.material, ring.weight, ring.size, ring.karat, ring.stone, ring.price, ring_buy.company AS compname1, ring_buy.material AS material1, ring_buy.weight AS weight1, ring_buy.diameter AS size1, ring_buy.karat AS karat1, ring_buy.stone AS stone1, ring_buy.price AS price1
FROM ring_sus
INNER JOIN ring ON ring.id = ring_sus.stolen_id
INNER JOIN ring_buy ON ring_buy.id = ring_sus.buy_id
WHERE ring_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Rings:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Material</li>
  <li>Weight</li>
  <li>Size</li>
  <li>Karat</li>
  <li>Stone</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['compname'];?></li>
  <li><?php echo $temp['material'];?></li>
  <li><?php echo $temp['weight'];?></li>
  <li><?php echo $temp['size'];?></li>
  <li><?php echo $temp['karat'];?></li>
  <li><?php echo $temp['stone'];?></li>
  <li><?php echo $temp['price'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['compname1'];?></li>
  <li><?php echo $temp['material1'];?></li>
  <li><?php echo $temp['weight1'];?></li>
  <li><?php echo $temp['size1'];?></li>
  <li><?php echo $temp['karat1'];?></li>
  <li><?php echo $temp['stone1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>
<?php
$stmt2 = $conn->prepare("SELECT car.brand, car.model, car.color, car.price, car.number, car.time AS YEAR, car.km, car_buy.company AS brand1, car_buy.model AS model1, car_buy.color AS color1, car_buy.year AS year1, car_buy.distance AS km1, car_buy.number AS number1, car_buy.price AS price1
FROM car_sus
INNER JOIN car ON car.id = car_sus.stolen_id
INNER JOIN car_buy ON car_buy.id = car_sus.buy_id
WHERE car_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Cars:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Brand</li>
  <li>Model</li>
  <li>Color</li>
  <li>Price</li>
  <li>Number</li>
  <li>Year</li>
  <li>KM</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['brand'];?></li>
  <li><?php echo $temp['model'];?></li>
  <li><?php echo $temp['color'];?></li>
  <li><?php echo $temp['price'];?></li>
  <li><?php echo $temp['number'];?></li>
  <li><?php echo $temp['year'];?></li>
  <li><?php echo $temp['km'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['brand1'];?></li>
  <li><?php echo $temp['model1'];?></li>
  <li><?php echo $temp['color1'];?></li>
  <li><?php echo $temp['price1'];?></li>
  <li><?php echo $temp['number1'];?></li>
  <li><?php echo $temp['year1'];?></li>
  <li><?php echo $temp['km1'];?></li>
</ul>
    <?php
 }
 }
?>

<?php
$stmt2 = $conn->prepare("SELECT phone.brand, phone.model, phone.imei, phone.color, phone.price, 
phone_buy.company AS brand1, phone_buy.model AS model1, phone_buy.imei AS imei1, phone_buy.color AS color1,phone_buy.price AS price1
FROM phone_sus
INNER JOIN phone ON phone.id = phone_sus.stolen_id
INNER JOIN phone_buy ON phone_buy.id = phone_sus.buy_id
WHERE phone_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>Phones:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Model</li>
  <li>IMEI</li>
  <li>Color</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['brand1'];?></li>
  <li><?php echo $temp['model1'];?></li>
  <li><?php echo $temp['imei'];?></li>
  <li><?php echo $temp['color1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['brand1'];?></li>
  <li><?php echo $temp['model1'];?></li>
  <li><?php echo $temp['imei1'];?></li>
  <li><?php echo $temp['color1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>

<?php
$stmt2 = $conn->prepare("SELECT purse.brand, purse.model, purse.material, purse.color, purse.price, 
purse_buy.company AS brand1, purse_buy.article AS model1, purse_buy.material AS material1, purse_buy.color AS color1,purse_buy.price AS price1
FROM purse_sus
INNER JOIN purse ON purse.id = purse_sus.stolen_id
INNER JOIN purse_buy ON purse_buy.id = purse_sus.buy_id
WHERE purse_sus.seller_id =?");
	$stmt2->bind_param("s", $id);
$stmt2->execute();
$result = $stmt2->get_result();
if ($result->num_rows > 0) {
 ?>
 <h3>purses:</h3>
 
 <?php
 while($temp=$result->fetch_assoc())
 {
  ?>
 <br>
 <ul>
  <li></li>
  <li>Company</li>
  <li>Model</li>
  <li>IMEI</li>
  <li>Color</li>
  <li>Price</li>
</ul>
 <ul>
  <li>Stolen Item</li>
  <li><?php echo $temp['brand1'];?></li>
  <li><?php echo $temp['model1'];?></li>
  <li><?php echo $temp['imei'];?></li>
  <li><?php echo $temp['color1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>

 <ul>
  <li>Sold Item</li>
  <li><?php echo $temp['brand1'];?></li>
  <li><?php echo $temp['model1'];?></li>
  <li><?php echo $temp['imei1'];?></li>
  <li><?php echo $temp['color1'];?></li>
  <li><?php echo $temp['price1'];?></li>
</ul>
    <?php
 }
 }
?>






</li>
</body>
</html>

<?php  include "conn.php";?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 95%;
  margin:10px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}

#overlay {
  position: fixed;
  display: none;
  width: 95%;
  height: 90%;
  top: 5%;
  left: 2.5%;
  right: 2.5%;
  bottom: 5%;
  background-color: rgba(0,0,0,0.8);
  z-index: 2;
  cursor: pointer;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}

</style>
</head>
<body>

<div id="overlay" onclick="off()">
  <div id="text">Overlay Text</div>
</div>

<h2>List of suspicious seller</h2>

<?php 
$stmt2 = $conn->prepare("SELECT id,name,email,phone,sus,address,adhaar FROM login where sus > 4  order by sus desc limit 0,20");


$stmt2->execute();
$result = $stmt2->get_result();
 while($temp=$result->fetch_assoc())
 {
 
 ?>

<div class="card">
  <div class="container">
    <h4><b>Name: <?php echo $temp['name'];?></b></h4> 
    <p>Email: <?php echo $temp['email'];?></p>
    <p>Phone: <?php echo $temp['phone'];?></p>
    <p>Adhaar Number: <?php echo $temp['adhaar'];?></p>
    <p>Address: <?php echo $temp['address'];?></p>
    <p>Number of times suspicious: <?php echo $temp['sus'];?></p>
    <a href="showdata.php?id=<?php echo $temp['id'];?>"><p>Click to get Details</p></a>
  </div>
</div>

<?php }?>


</body>

<script>
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}
</script>
</html> 
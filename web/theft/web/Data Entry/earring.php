<html>
    <head>
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web|Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.css" />
		<link rel="stylesheet" href="jwellery.css">
		<style>
		::-webkit-scrollbar {
		width: 4px;
	}
	::-webkit-scrollbar-track {
	}
	::-webkit-scrollbar-thumb {

		background: rgba(0,0,0,0.1); ;
	}
	::-webkit-scrollbar-thumb:window-inactive {
		background: rgba(0,0,0,0.2); 
	}
	</style>
</head>
<body>

<form action="earring.php" method="post" enctype="multipart/form-data">
<ul class="form-style-1">
    <li><label><span>Company Name</span></label><input type="text" name="field1" class="field-long" placeholder="Tanishq,Kalyan,etc." required /> </li>
    <li>
        <label><span>Material</span></label>
        <input type="text" name="field2" class="field-long" placeholder="Gold,silver,etc."/>
    </li>
    <li>
        <label><span>Weight</span></label>
        <input type="text" name="field3" class="field-long" placeholder="2.5gm to 10gm,etc."/>
    </li>
	<li>
        <label><span>size</span></label>
        <input type="text" name="field4" class="field-long" placeholder="6,7,8,etc."/>
    </li>
	<li>
        <label><span>Karat</span></label>
        <input type="text" name="field5" class="field-long" placeholder="20 karat,etc."/>
    </li>
	<!--<li>
        <label><span>Stone if any</span></label>
        <input type="text" name="field6" class="field-long" placeholder="Pearl,Sapphire,etc."/>
    </li>-->
	<li>
        <label><span>Price</span></label>
        <input type="text" name="field7" class="field-long" placeholder="5k,10k,etc."/>
    </li>
    <li>
        <label><span>Other Features 1</span></label>
        <input type="text" name="field8" class="field-long" placeholder="Any spot."/>
    </li>
    <li>
        <label><span>Other Features 2</span></label>
        <input type="text" name="field9" class="field-long" placeholder="Characterstics"/>
    </li>
	<li>
		<label><span>Image</span></label>
		<input name="input-image" type="file" class="field-divided" />
	</li>
	<br>
	<div style="text-align: center">
    <li>
        <input type="submit" value="Submit" />
    </li>
	</div>
</ul>
</form>
<?php
include("./conn.php");
error_reporting(0);
if($_POST['field1']){
    $field1=$_POST['field1'];
    $field1=htmlspecialchars($field1, ENT_QUOTES, 'UTF-8');
    $field2=$_POST['field2'];
    $field2=htmlspecialchars($field2, ENT_QUOTES, 'UTF-8');
    $field3=$_POST['field3'];
    $field3=htmlspecialchars($field3, ENT_QUOTES, 'UTF-8');
    $field4=$_POST['field4'];
    $field4=htmlspecialchars($field4, ENT_QUOTES, 'UTF-8');
    $field5=$_POST['field5'];
    $field5=htmlspecialchars($field5, ENT_QUOTES, 'UTF-8');
    $field6=$_POST['field6'];
    $field6=htmlspecialchars($field6, ENT_QUOTES, 'UTF-8');
    $field7=$_POST['field7'];
    $field7=htmlspecialchars($field7, ENT_QUOTES, 'UTF-8');
    $field8=$_POST['field8'];
    $field8=htmlspecialchars($field8, ENT_QUOTES, 'UTF-8');
    $field9=$_POST['field9'];
    $field9=htmlspecialchars($field9, ENT_QUOTES, 'UTF-8');
    	$p_c_name = uniqid('uploaded-', true);
		$sourcePath = $_FILES['input-image']['name'];
			$ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
				if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
				//die ('File is not an image');
				$final_name="";
			
				    
				}
			else{
				$sourcePath = $_FILES['input-image']['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "./image/".$p_c_name.".".$ext; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				$final_name=$p_c_name.".".$ext;}
$stmtq = $conn->prepare('INSERT INTO `earring` (`compname`, `material`, `weight`, `size`, `karat`, `stone`, `price`, `image`,`other1`,`other2`)  values(?,?,?,?,?,?,?,?,?,?)');
			$stmtq->bind_param("ssssssssss", $field1,$field2,$field3,$field4,$field5,$field6,$field7,$final_name,$field8,$field9);
			if($stmtq->execute()){
			echo "<p style='color:green'>Added Successfully !</p>";
			}
}
?>
</body>
</html>
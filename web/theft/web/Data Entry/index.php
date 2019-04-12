<?php
include('secure.php');
?>
<?php
include("./conn.php");

?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Police Verification</title>
		<meta name="author" content="Shwet" />
		<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.css" />
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web|Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<style>
			.dropbtn {
			  background-color: DodgerBlue;
			  min-width: 500px;
			  color: white;
			  padding: 16px;
			  font-size: 16px;
			  border: none;
			  cursor: pointer;
			}

			.dropdown {
			  position: relative;
			  display: inline-block;			
			}

			.dropdown-content {
			  display: none;
			  position: absolute;
			  background-color: #f9f9f9;
			  min-width: 500px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.dropdown-content a {
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			}

			.dropdown-content a:hover {background-color: #f1f1f1}

			.dropdown:hover .dropdown-content {
			  display: block;
			}

			.dropdown:hover .dropbtn {
			  background-color: DodgerBlue;
			}
			
			.dropdown1 {
			  position: relative;
			  display: inline-block;			
			}

			.dropdown-content1 {
			  display: none;
			  position: absolute;
			  background-color: #f9f9f9;
			  min-width: 300px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.dropdown-content1 a1 {
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			}

			.dropdown-content1 a:hover {background-color: #f1f1f1}

			.dropdown1:hover .dropdown-content1 {
			  display: block;
			}
			
		</style>
</head>

<body>
<div style="text-align: center">
	
	
		
	<div class="dropdown">
	  <button class="dropbtn" onclick="location.href='index.php'">Stolen Category</button>
	  <div class="dropdown-content">
	  <div class="dropdown1">
	  <a style="color: DodgerBlue">Jewellery
				  <div class="dropdown-content1">
				  <a onclick="setURL('ring.php')" style="color: DodgerBlue">Ring</a>
				  <a onclick="setURL('chain.php')" style="color: DodgerBlue">Chain</a>
				  <a onclick="setURL('earring.php')" style="color: DodgerBlue">Ear-Ring</a>
				  <a onclick="setURL('bangle.php')" style="color: DodgerBlue">Bangle</a>
				  <a onclick="setURL('necklace.php')" style="color: DodgerBlue">Necklace</a>
				  </div>
				</div>	  
	  </a>
	  <a onclick="setURL('mobile.php')" style="color: DodgerBlue">Mobile</a>
	  <a onclick="setURL('bag.php')" style="color: DodgerBlue">Bag</a>
	  <a onclick="setURL('vehicle.php')" style="color: DodgerBlue">Vehicle</a><!--
	  <a onclick="setURL('others.php')" style="color: DodgerBlue">Other</a>-->
	  </div>
	</div>
</div>

<div style="overflow-x: hidden;overflow-y: scroll;height:91%;border-bottom: 4px solid #3a285c;">
	<iframe id="iframe" src="demo.php" name="this_one" style="width: 100%;height: 100%;border:none"></iframe>
</div>

<script>
function setURL(url){
    document.getElementById('iframe').src = url;
}
function reload_b(){
    $('#iframe').attr('src', $('#iframe').attr('src'));
}
</script>
</body>
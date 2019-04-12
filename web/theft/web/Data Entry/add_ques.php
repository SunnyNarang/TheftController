<?php
include('secure.php');
?>
<html>
    <head>
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web|Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.css" />
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
<?php
include("../conn.php");
		?>
<h1 style="font-family:titillium web;padding: 10px;color: #5a5a5a;font-weight: 700;margin-bottom: 0;font-size: 25px;">Add a Question</h1>
<hr style="margin-top: 0;border-color: rgba(0, 0, 0, 0.2);">
<form action="add_ques.php" method="post">
	   <select name="cat_name" style="padding: 8px 10px;margin: 10px;" id="cat_name" required>
   	<option value="">Please select a Course</option>
<?php
$stmtp = $conn->prepare('SELECT id,name FROM category');
$stmtp->execute();
$resultp = $stmtp->get_result();
if ($resultp->num_rows > 0) {
    while($rowp = $resultp->fetch_assoc()) {
		$scat_id=$rowp['id'];
		$scat_name=$rowp['name'];
?>	<option value="<?php echo $scat_id; ?>"><?php echo $scat_name; ?></option>
<?php }} ?>
   	</select>
   	<select name="topic_name" style="display:block;padding: 8px 10px;margin: 10px;" id="topic_name" required onchange="this.form.submit()"><option value="">Please select a Book</option></select>
    
</form>
<hr style="margin-top: 0;border-color: rgba(0, 0, 0, 0.2);">
<?php
if($_POST['topic_name']){
    $topic_name=$_POST['topic_name'];
    
$stmtq = $conn->prepare('SELECT * from exam where topic_id = ?');
			$stmtq->bind_param("s", $topic_name);
			$stmtq->execute();
$resultq = $stmtq->get_result();
if ($resultq->num_rows > 0) {
    while($rowq = $resultq->fetch_assoc()) {
		$sexam_id=$rowq['id'];
        $sexam_name=$rowq['exam_name']; 
        $sexam_status=$rowq['status'];
?>
<a href="add_ques.php?exam_id=<?php echo $sexam_id; ?>#end" style="margin:10px;cursor:pointer;display:inline-block;padding:10px 15px;background:<?php if($sexam_status==1) echo "#2b8a36"; ?><?php if($sexam_status==0) echo "#fd3d3d"; ?>;text-decoration: none;color: initial;">
<span style="margin-left:5px;text-transform:uppercase;vertical-align:middle;font-family:titillium web;font-size:14px"><?php echo $sexam_name; ?></span></a>
<?php }}} ?>
<?php
if($_GET['exam_id']){
    $exam_id=$_GET['exam_id'];
if($_POST['ad_qu']){
    $ad_qu=$_POST['ad_qu'];
    $ad_qu=htmlspecialchars($ad_qu, ENT_QUOTES, 'UTF-8');
    $ad_a=$_POST['ad_a'];
    $ad_a=htmlspecialchars($ad_a, ENT_QUOTES, 'UTF-8');
    $ad_b=$_POST['ad_b'];
    $ad_b=htmlspecialchars($ad_b, ENT_QUOTES, 'UTF-8');
    $ad_c=$_POST['ad_c'];
    $ad_c=htmlspecialchars($ad_c, ENT_QUOTES, 'UTF-8');
    $ad_d=$_POST['ad_d'];
    $ad_d=htmlspecialchars($ad_d, ENT_QUOTES, 'UTF-8');
    $ad_ans=$_POST['ad_ans'];
    $ad_ans=htmlspecialchars($ad_ans, ENT_QUOTES, 'UTF-8');
    $ad_level="1";
    if(!is_uploaded_file($_FILES['admit_image']['tmp_name'])) {
    		$stm = $conn->prepare('INSERT INTO `question` set `question`=?, `option_a`=?, `option_b`=?, `option_c`=?, `option_d`=?, `answer`=?, `level`=?, `exam_id`=?');
			$stm->bind_param("ssssssss", $ad_qu, $ad_a, $ad_b, $ad_c, $ad_d, $ad_ans, $ad_level, $exam_id);
			if($stm->execute()){
			echo "<p style='color:green'>Added Successfully !</p>";
			}
}
    else{	$sourcePath = $_FILES['admit_image']['name'];
			$ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
				if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
				die ('File is not an image');
			}
			$new_name=rand();
			$new_name_n=$ad_level.$new_name;
				$sourcePath = $_FILES['admit_image']['tmp_name'];
			$targetPath = "../images/".$new_name_n.".".$ext; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				$final_name=$new_name_n.".".$ext;
	$stm = $conn->prepare('INSERT INTO `question` set `question`=?, `option_a`=?, `option_b`=?, `option_c`=?, `option_d`=?, `answer`=?, `level`=?, `exam_id`=?, `ques_image`=?');
			$stm->bind_param("sssssssss", $ad_qu, $ad_a, $ad_b, $ad_c, $ad_d, $ad_ans, $ad_level, $exam_id, $final_name);
			if($stm->execute()){
			echo "<p style='color:green'>Added Successfully !</p>";
			}
    }

}  
    $stmtqaa = $conn->prepare('SELECT category.name,
       category.icon,
       topic.topic_name,
       exam.exam_name,  exam.dur, exam.level
 FROM exam
 INNER JOIN topic ON exam.topic_id = topic.id
 INNER JOIN category ON topic.category_id = category.id
where exam.id= ?');
			$stmtqaa->bind_param("s", $exam_id);
			$stmtqaa->execute();
$resultqaa = $stmtqaa->get_result();
 while($rowqaa = $resultqaa->fetch_assoc()) {
		$exam_namee=$rowqaa['name'];
        $exam_icone=$rowqaa['icon']; 
        $exam_t_namee=$rowqaa['topic_name'];
        $exam_e_namee=$rowqaa['exam_name'];
        $exam_e_dur=$rowqaa['dur'];
        $exam_e_level=$rowqaa['level'];
 }
 ?>
 <div style="font-family:titillium web;text-align:center;margin:10px">
 	<span style="display: block;font-size: 25px;font-weight: 800;text-transform: uppercase;"><?php echo $exam_e_namee; ?></span>
 	<span style="font-size: 20px;font-weight: 800;vertical-align: middle"><img style="width: 55px;vertical-align: middle;" src="../images/<?php echo $exam_icone; ?>"><?php echo $exam_namee; ?> - <?php echo $exam_t_namee; ?> [  <span id="total_marks"></span> Marks ] [ <?php echo $exam_e_dur; ?> min ]</span>
 	
 </div>
 <?php
$stmtqa = $conn->prepare('SELECT * from question where exam_id = ?');
			$stmtqa->bind_param("s", $exam_id);
			$stmtqa->execute();
$resultqa = $stmtqa->get_result();
if ($resultqa->num_rows > 0) {
	$i=1;
    while($rowqa = $resultqa->fetch_assoc()) {
		$q_id=$rowqa['id'];
        $q_full=$rowqa['question']; 
        $q_a=$rowqa['option_a'];  
        $q_b=$rowqa['option_b'];  
        $q_c=$rowqa['option_c'];  
        $q_d=$rowqa['option_d'];  
        $q_answer=$rowqa['answer'];
        $q_level=$rowqa['level'];
        $q_ima=$rowqa['ques_image'];
    $stmtz = $conn->prepare('SELECT mark from level where id = ?');
	$stmtz->bind_param("s", $exam_e_level);
	$stmtz->execute();
    $resultz = $stmtz->get_result();
    if ($resultz->num_rows > 0) {
         while($rowz = $resultz->fetch_assoc()) {
		$q_mark=$rowz['mark'];
		$totla[]=$rowz['mark'];
         }}    
?>
<div id="shit_<?php echo $q_id; ?>" style="margin:20px;font-family:titillium web;font-size:14px">
	<span style="display:block"><?php echo $i; ?>. <?php echo $q_full; ?><div style="float:right">
	    <span  style='font-size: 10px;margin-left: 5px;font-family:titillium web;font-size:14px'>( <?php echo $q_mark; ?> marks )</span>
	<a href='add_ques.php?edit_id=<?php echo $q_id; ?>' class='fa fa-pencil' style='font-size: 10px;border-radius: 100%;color:inherit;cursor:pointer;background: green;padding: 7px;margin-left: 10px;'></a><i class='fa fa-close' style='font-size: 10px;border-radius: 100%;background: red;color:inherit;padding: 7px;cursor:pointer;margin-left: 5px;' onclick=del('<?php echo $q_id; ?>')></i></div></span>
	<img src="../images/<?php echo $q_ima; ?>" style="display:<?php if($q_ima=="none") echo "none"; else echo "inline-block";?>;width:200px">
<span style="display:block">a) <?php echo $q_a; ?><i class="fa fa-check" style="background: #066306;color: #fff;border-radius: 100%;font-size: 9px;padding: 3px;margin-left: 10px;display:<?php if($q_answer==1) echo "inline-block"; else echo "none";?>"></i></span>
<span style="display:block">b) <?php echo $q_b; ?><i class="fa fa-check" style="background: #066306;color: #fff;border-radius: 100%;font-size: 9px;padding: 3px;margin-left: 10px;display:<?php if($q_answer==2) echo "inline-block"; else echo "none";?>"></i></span>
<span style="display:block">c) <?php echo $q_c; ?><i class="fa fa-check" style="background: #066306;color: #fff;border-radius: 100%;font-size: 9px;padding: 3px;margin-left: 10px;display:<?php if($q_answer==3) echo "inline-block"; else echo "none";?>"></i></span>
<span style="display:block">d) <?php echo $q_d; ?><i class="fa fa-check" style="background: #066306;color: #fff;border-radius: 100%;font-size: 9px;padding: 3px;margin-left: 10px;display:<?php if($q_answer==4) echo "inline-block"; else echo "none";?>"></i></span>

</div>
<?php $i++; }} ?>
<input id="totla" type="hidden" value="<?php echo array_sum($totla); ?>">
<form action="add_ques.php?exam_id=<?php echo $exam_id; ?>" method="post" enctype="multipart/form-data" style="font-family: titillium web;font-size: 14px;margin:20px">
     <span style="font-family: Titillium Web;font-size: 14px;display:inline-block"><?php echo $i; ?>. </span>
     <Textarea id="txt" name="ad_qu" style="vertical-align:middle;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width:90%" placeholder="Enter the question" required></textarea><br>
     <input name="admit_image" type="file" style="margin:10px;display: block;font-family: Titillium Web;font-size: 16px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;">
    <span style="font-family: Titillium Web;font-size: 14px;display:inline-block">a)</span>
    <input name="ad_a" style="margin-top:5px;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the option" required><br>
    <span style="font-family: Titillium Web;font-size: 14px;display:inline-block">b)</span>
    <input name="ad_b" style="display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the option" required><br>
    <span style="font-family: Titillium Web;font-size: 14px;display:inline-block">c)</span>
    <input name="ad_c" style="display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the option" required><br>
    <span style="font-family: Titillium Web;font-size: 14px;display:inline-block">d)</span>
    <input name="ad_d" style="display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the option" required><br>
   <span style="margin-top:5px;font-family: Titillium Web;font-size: 14px;display:inline-block">Answer:</span>
   <select name="ad_ans" style="margin-top:5px;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);" placeholder="Enter the description" required>
        <option value="1">a</option>
        <option value="2">b</option>
        <option value="3">c</option>
        <option value="4">d</option>
    </select><br>
<!--    <span style="margin-top:5px;font-family: Titillium Web;font-size: 14px;display:inline-block">Difficulty:</span>
    <input name='ad_level' type="radio" value="1" checked>Easy
    <input name='ad_level' type="radio" value="2">Medium
    <input name='ad_level' type="radio" value="3">Hard
    <input name='ad_level' type="radio" value="4">Very Hard -->
    <input class="ripple" type="submit" style="margin-top:5px;display: block;font-family: Titillium Web;font-size: 14px;padding: 4px;color: rgba(0,0,0,0.8);width: 250px;">
</form>   
<?php 

} ?>
<div id="end"></div>
<?php
if($_GET['edit_id']){
    $edit_id=$_GET['edit_id'];
    $edit_id=htmlspecialchars($edit_id, ENT_QUOTES, 'UTF-8');
$stmtpq = $conn->prepare('SELECT * FROM question where id=?');
$stmtpq->bind_param("s", $edit_id);
$stmtpq->execute();
$resultpq = $stmtpq->get_result();
if ($resultpq->num_rows > 0) {
    while($rowpq = $resultpq->fetch_assoc()) {
		$qu_id=$rowpq['id'];
		$qu_qu=$rowpq['question'];
		$qu_a=$rowpq['option_a'];
		$qu_b=$rowpq['option_b'];
		$qu_c=$rowpq['option_c'];
		$qu_d=$rowpq['option_d'];
		$qu_ans=$rowpq['answer'];
		$qu_level=$rowpq['level'];
?>
<form action="add_ques.php" method="post" enctype="multipart/form-data" style="font-family: titillium web;font-size: 14px;">
    <input name="qu_id" style="margin:10px;display: block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;display:none" placeholder="Enter the title" required value="<?php echo $qu_id; ?>" readonly>
     <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">Ques:</span><textarea name="qu_qu" style="vertical-align:middle;margin:5px;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width:90%" placeholder="Enter the title" required value=""><?php echo $qu_qu; ?></textarea><br>
    <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">a)</span><input name="qu_a" style="margin:5px;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the description" required value="<?php echo $qu_a; ?>"><br>
    <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">b)</span><input name="qu_b" style="margin:5px;display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the description" required value="<?php echo $qu_b; ?>"><br>
    <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">c)</span><input name="qu_c" style="margin:5px;display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the description" required value="<?php echo $qu_c; ?>"><br>
    <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">d)</span><input name="qu_d" style="margin:5px;display:  inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);width: 250px;" placeholder="Enter the description" required value="<?php echo $qu_d; ?>"><br>
   <span style="font-family: Titillium Web;font-size: 14px;margin:5px;display:inline-block">Answer:</span>
   <select name="qu_ans" style="margin:5px;display: inline-block;border: none;border-bottom: 2px solid rgba(0,0,0,0.2);font-family: Titillium Web;font-size: 14px;padding: 4px;outline: none;color: rgba(0,0,0,0.8);" placeholder="Enter the description" required>
        <option value="1" <?php if($qu_ans==1) echo "selected"; ?>>a</option>
        <option value="2" <?php if($qu_ans==2) echo "selected"; ?>>b</option>
        <option value="3" <?php if($qu_ans==3) echo "selected"; ?>>c</option>
        <option value="4" <?php if($qu_ans==4) echo "selected"; ?>>d</option>
    </select><br>
 <!--   <span style="font-family: Titillium Web;font-size: 14px;margin:10px;display:inline-block">Difficulty:</span>
    <input name='qu_level' type="radio" value="1" <?php// if($qu_level==1) echo "checked"; ?>>Easy
    <input name='qu_level' type="radio" value="2" <?php //if($qu_level==2) echo "checked"; ?>>Medium
    <input name='qu_level' type="radio" value="3" <?php //if($qu_level==3) echo "checked"; ?>>Hard
    <input name='qu_level' type="radio" value="4" <?php //if($qu_level==4) echo "checked"; ?>>Very Hard
-->    <input class="ripple" type="submit" style="margin:10px;display: block;font-family: Titillium Web;font-size: 14px;padding: 4px;color: rgba(0,0,0,0.8);width: 250px;"> 
</form>   
<?php }}} ?>
<?php
if($_POST['qu_qu']){
    $qu_qu=$_POST['qu_qu'];
    $qu_qu=htmlspecialchars($qu_qu, ENT_QUOTES, 'UTF-8');
    $qu_a=$_POST['qu_a'];
    $qu_a=htmlspecialchars($qu_a, ENT_QUOTES, 'UTF-8');
    $qu_b=$_POST['qu_b'];
    $qu_b=htmlspecialchars($qu_b, ENT_QUOTES, 'UTF-8');
    $qu_c=$_POST['qu_c'];
    $qu_c=htmlspecialchars($qu_c, ENT_QUOTES, 'UTF-8');
    $qu_d=$_POST['qu_d'];
    $qu_d=htmlspecialchars($qu_d, ENT_QUOTES, 'UTF-8');
    $qu_ans=$_POST['qu_ans'];
    $qu_ans=htmlspecialchars($qu_ans, ENT_QUOTES, 'UTF-8');
    $qu_id=$_POST['qu_id'];
    $qu_id=htmlspecialchars($qu_id, ENT_QUOTES, 'UTF-8');
    $qu_level="1";
	$stmtqp = $conn->prepare('UPDATE `question` set `question`=?, `option_a`=?, `option_b`=?, `option_c`=?, `option_d`=?, `answer`=?, `level`=? where `id`=?');
			$stmtqp->bind_param("ssssssss", $qu_qu, $qu_a, $qu_b, $qu_c, $qu_d, $qu_ans, $qu_level, $qu_id);
			if($stmtqp->execute()){
			echo "<p style='color:green'>Edited Successfully !</p>";
			}
}    
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#cat_name").change(function() {
			$('#topic_name').html('<i class="fa fa-spinner fa-spin"></i>');
		$.get('support_exam.php?id=' + $(this).val(), function(data) {
			$("#topic_name").html(data);
		});	
    });
      $('#total_marks').html($('#totla').val());
});
function del(class_id) {
if(class_id != null  && class_id != undefined  && class_id !== "" ){
	var r = confirm("Delete this Question ?");
    if (r == true) {    
		$.ajax({
		type:'POST',
		url: 'del_ques.php',
		data:{class_id:class_id},
		success: function(data){
			$('#shit_'+class_id).css('display', 'none');
		},
		error:function (){}
		});
}}
}

</script>
<script Type="text/javascript">
Window.onload=function(){document.getelementbyid('sendbutton2').value='notice Me?';}
</script>
<script>
    $(function ()
    {
        $('#txt').keyup(function (e){
            if(e.keyCode == 13){
                var curr = getCaret(this);
                var val = $(this).val();
                var end = val.length;

                $(this).val( val.substr(0, curr) + '<br>' + val.substr(curr, end));
            }

        })
    });

    function getCaret(el) { 
        if (el.selectionStart) { 
            return el.selectionStart; 
        }
        else if (document.selection) { 
            el.focus(); 

            var r = document.selection.createRange(); 
            if (r == null) { 
                return 0; 
            } 

            var re = el.createTextRange(), 
            rc = re.duplicate(); 
            re.moveToBookmark(r.getBookmark()); 
            rc.setEndPoint('EndToStart', re); 

            return rc.text.length; 
        }  
        return 0; 
    }

</script>

</body>
</html>
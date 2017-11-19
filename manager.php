<?php 
error_reporting(0);
session_start();

if(!isset($_SESSION["login"]) || !isset($_SESSION["access_level"])) 
  { 
    echo ('<script> window.open("cms.php", "_self"); </script>'); 
  } 
if ( $_SESSION["login"] !== 1 || $_SESSION["access_level"]!==0) 
{ 
  echo ('<script> window.open("cms.php", "_self"); </script>'); 
} 

if(isset($_POST['logout']))
	{
		unset($_POST['logout']);
		echo ('<script> window.open("cms.php", "_self"); </script>');
	}
include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);


?>

<!-- For User details export-->
<?php 
if(isset($_POST['expDB1']))
{
// Fetch Record from Database
error_reporting(0);
$output = "";
$sql = mysqli_query($conn,"select concat('INNO-', userid) as `INNOVISION ID`, uname as `NAME`, uemail as `EMAIL ADDRESS`, univerName as `UNIVERSITY/COLLEGE NAME`, contact as `CONTACT DETAILS`, gender as `GENDER` from userdetails");
$torow = mysqli_num_rows($sql);
$columns_total = mysqli_num_fields($sql);


// Get The Field Name

while ($fieldinfo=mysqli_fetch_field($sql))
    {
        $heading = $fieldinfo->name;
        $output .= '"'.$heading.'",';
    }
    $output .="\n";

// Get Records from the table


$resA = mysqli_fetch_all($sql,MYSQLI_NUM);
for($j=0;$j<$torow;$j++)
{
	for($k=0;$k<$columns_total;$k++)
	{
		$output .='"'.$resA[$j][$k].'",';
	}
	$output .="\n";
}

// Download the file
$filename = 'db_export_INNOVISION_USER_DETAILS_'.date('Y-m-d').'.csv';
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

mysqli_free_result($sql);
echo $output;
exit;

}
?>

<!-- For Event registration details export-->
<?php 
if(isset($_POST['expDB2']))
{
// Fetch Record from Database
error_reporting(0);
$output = "";
$viewQ = "create view temdetails AS SELECT userreg.userID AS `UID` , cms_events.title AS `NAME OF EVENT` FROM userreg INNER JOIN cms_events ON cms_events.eid=userreg.eid";
$viewQuery = mysqli_query($conn,$viewQ);

$sql = mysqli_query($conn,"select CONCAT('INNO-',userdetails.userid) as `INNOVISION ID`, userdetails.uname as `NAME OF USER`, userdetails.uemail as `EMAIL ADDRESS`, userdetails.univerName as `COLLEGE NAME`, temdetails.`NAME OF EVENT` as `NAME OF EVENT` FROM userdetails,temdetails WHERE userdetails.userid=temdetails.UID");
$torow = mysqli_num_rows($sql);
$columns_total = mysqli_num_fields($sql);


// Get The Field Name

while ($fieldinfo=mysqli_fetch_field($sql))
    {
        $heading = $fieldinfo->name;
        $output .= '"'.$heading.'",';
    }
    $output .="\n";

// Get Records from the table


$resA = mysqli_fetch_all($sql,MYSQLI_NUM);
for($j=0;$j<$torow;$j++)
{
	for($k=0;$k<$columns_total;$k++)
	{
		$output .='"'.$resA[$j][$k].'",';
	}
	$output .="\n";
}

// Download the file
$filename = 'db_export_INNOVISION_EVENT_REGISTRATION_DETAILS_'.date('Y-m-d').'.csv';
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
$viewDrop = mysqli_query($conn,"DROP VIEW temdetails");
mysqli_free_result($sql);
echo $output;
exit;

}
?>



<?php
//This code snippet is  for Handling new Event Entries
if(isset($_POST['mem_submit']) && ($_SERVER["REQUEST_METHOD"]==="POST"))
{
	
			$qMemAdd = "insert into cms_member (email,userid,password,name,access_level) values ('".mysqli_real_escape_string($conn,$_POST['mem_email'])."','".mysqli_real_escape_string($conn,$_POST['mem_uname'])."','".mysqli_real_escape_string($conn,$_POST['mem_pwd'])."','".mysqli_real_escape_string($conn,$_POST['mem_name'])."',1)";
			$rMemAdd = mysqli_query($conn,$qMemAdd);
			if($rMemAdd)
			{
				echo ('
						<script>
						alert("New Editor Added.");
						</script>');
			}
			else{
				
				echo ('
						<script>
						alert("Editor addition failed :-(");
						</script>');
			}
			
			unset($_POST['mem_submit']);

}
?>

<?php 
//This code snippet to delete any existing editor


if(isset($_POST['del_mem']) && isset($_SESSION['mid_edit']))
{
	
	$qDelete = mysqli_query($conn,"delete from cms_member where mid =".$_SESSION['mid_edit']);
	session_unset($_SESSION['mid_edit']);
	unset($_POST['del_mem']);
	unset($_POST['mid_sel_edit']);
}



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>EDITOR MANAGEMENT</title>
<link rel="shortcut icon" type="image/png" href="icon.png">
<style type="text/css">
body {
	background-color: rgba(164,241,204,0.98);
	margin-top: 0px;
	padding-top: 13px;
}
.header {
	background-color: rgba(15,227,204,1.00);
	display: marker;
	position: fixed;
	visibility: visible;
	z-index: 1000;
	filter: BlendTrans(Duration=5);
	-webkit-transition: all 1s ease-out 0.005s;
	-o-transition: all 1s ease-out 0.005s;
	transition: all 1s ease-out 0.005s;
	text-align: center;
	float: none;
	left: 0px;
	text-shadow: 7px 2px 0px rgba(187,200,247,1.00);
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 48px;
	padding-bottom: 58px;
	text-decoration: underline;
	text-indent: 0px;
	border-radius: 12px;
	color: rgba(8,122,49,1.00);
	font-family: Impact, Haettenschweiler, "Franklin Gothic Bold", "Arial Black", sans-serif;
	font-weight: normal;
	font-size: xx-large;
	right: 0px;
	cursor: alias;
	margin-top: -13px;
}
.Main{
	margin-top: 144px;
	margin-left: 15px;
	margin-right: 15px;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
}
</style>
</head>

<body>
<header class="header">NIT ROURKELA FEST CONTENT MANAGEMENT SYSTEM</header>
<link rel="shortcut icon" type="image/png" href="icon.png"> 
<div class="Main">

<!--Modal Creation-->
<!-- Trigger/Open The Modal -->
<button id="myBtn">Add New Editor</button>
<form action="manager.php" method="POST">
<input type="submit" name="logout" value="Log Out" style="float:right; font-size:x-large; ">
</form>
<p><small><em>Donot refresh page after adding a editor. That will cause duplicacy in data</em></small></p>

<form action="manager.php" method="POST">
<input type="submit" name="expDB1" value="EXPORT USER DETAILS" style="float:right; font-size:x-large; ">
</form>

<form action="manager.php" method="POST">
<input type="submit" name="expDB2" value="EXPORT USER REGISTRATION DETAILS" style="float:right; font-size:x-large; ">
</form>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <!-- User Defined Content -->
    <br>
    <h3>Add New Editor Details Here</h3>
    <br>
    <form action="manager.php" method="POST" enctype="multipart/form-data">
    	<p>Enter the Name of the Editor</p>
    	<br>
    	<input type="text" name="mem_name">
    	<br>
    	<p>Enter the Email of the Editor</p>
    	<br>
    	<input type="text" name="mem_email">
    	<br>
    	<p>Enter the User Name of the Editor</p>
    	<br>
    	<input type="text" name="mem_uname" >
    	<br>
    	<p>Enter the Password of the Editor</p>
    	<br>
    	<input type="text" name="mem_pwd" >
    	<br>
    	<input type="submit" name="mem_submit" value="Submit Details" style="float:right;">
    	<br>
    	<br>
    </form>

  </div>

</div>

<hr>
<h2>Manage existing Editors with their Editor ID</h2>
<form autocomplete="off" action="manager.php" method="POST">
	<p>Select ID of Editor</p>
    	<input list="memid" name="mem_edit_id">
    	<datalist id="memid">
    		<?php 
    			$memEditQuery = mysqli_query($conn,"select mid from cms_member where access_level=1");
				$memEditRes = mysqli_fetch_all($memEditQuery,MYSQLI_NUM);

    			for($j=0;$j<mysqli_num_rows($memEditQuery);$j++)
    			{
    				echo('<option value="'.$memEditRes[$j][0].'">');
    			}
    		?>
    	</datalist>
    <input type="submit" name="mid_sel_edit" value="Select ID">
</form>
<hr>
<?php 

if(isset($_POST['cancelEdit']))
{
	session_unset($_SESSION['mid_edit']);
	unset($_POST['mid_sel_edit']);
}


if(isset($_POST['mid_sel_edit']))
{
	$_SESSION['mid_edit'] = $_POST['mem_edit_id'];
	$editQ = mysqli_query($conn,"select * from cms_member where mid = ".$_POST['mem_edit_id']);
	$editR = mysqli_fetch_all($editQ,MYSQLI_NUM);
	echo ('
			<br>
			<form action="manager.php" method="POST">
				<input type="submit" name="cancelEdit" value="Cancel Edition">
			</form>
			<br>
			<form action="manager.php" method="POST">
			<input type="submit" name="del_mem" value="Remove this Editor">
			</form>
			<br>
    <h3>Edit Editor Details Here</h3>
    <br>
    <form action="manager.php" method="POST" enctype="multipart/form-data">
    	<p>Edit Name of the Editor</p>
    	<br>
    	<input type="text" name="edit_name" value="'.$editR[0][4].'">
    	<br>
    	<p>Edit Email of the Editor</p>
    	<br>
    	<input type="text" name="edit_email" value="'.$editR[0][1].'">
    	<br>
    	<p>Edit Username of Editor</p>
    	<br>
    	<input type="text" name="edit_uname" value="'.$editR[0][2].'">
    	<br>
    	<p>Edit Password of Editor</p>
    	<br>
    	<input type="text" name="edit_pwd" value="'.$editR[0][3].'">
    	<br>
    	<input type="submit" name="mem_edit_sub" value="Save Details" style="float:right;">
    	<br>
    	<br>
    </form>


		');
}



if(isset($_POST['mem_edit_sub']) && isset($_SESSION['mid_edit']))
{
	$qEdit = mysqli_query($conn,"update cms_member set email='".mysqli_real_escape_string($conn,$_POST['edit_email'])."' where mid = ".$_SESSION['mid_edit']);
	$qEdit = mysqli_query($conn,"update cms_member set userid='".mysqli_real_escape_string($conn,$_POST['edit_uname'])."' where mid = ".$_SESSION['mid_edit']);
	$qEdit = mysqli_query($conn,"update cms_member set password='".mysqli_real_escape_string($conn,$_POST['edit_pwd'])."' where mid = ".$_SESSION['mid_edit']);
	$qEdit = mysqli_query($conn,"update cms_member set name='".mysqli_real_escape_string($conn,$_POST['edit_name'])."' where mid = ".$_SESSION['mid_edit']);
	
unset($_POST['mid_sel_edit']);
session_unset($_SESSION['mid_edit']);
unset($_POST['mem_edit_sub']);
}



?>
<hr>
<!-- contents of the page that show events-->
<h2>Editors present in the Database and Website</h2>



<?php 

$memQuery = mysqli_query($conn,"select * from cms_member where access_level=1");
$memRes = mysqli_fetch_all($memQuery,MYSQLI_NUM);

for($k=0;$k<mysqli_num_rows($memQuery);$k++)
{
	echo('
		<h3>'.$memRes[$k][4].'</h3>
<h4>Editor ID in database : <bold>'.$memRes[$k][0].'</bold></h4>
<h4>Ediotr Email</h4>
<p>'.$memRes[$k][1].'</p>
<h4>Username</h4>
<p>'.$memRes[$k][2].'</p>
<h4>Password</h4>
<p>'.$memRes[$k][3].'</p>
<br>
<br>

		');
}

?>


</div>
</body>
</html>

<?php 
mysqli_close($conn);
?>




<script type="text/javascript">
// Get the modal
var modal = document.getElementById('myModal');
var catmodal = document.getElementById('catModal');

// Get the button that opens the modal
var eventAddbtn = document.getElementById("myBtn");
var catBtn = document.getElementById("catBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var catspan = document.getElementsByClassName("close")[1];

// When the user clicks on the button, open the modal 
eventAddbtn.onclick = function() {

    modal.style.display = "block";
}

catBtn.onclick = function() {
	catmodal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    
}

catspan.onclick = function() {
	catmodal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        
    }

    if (event.target == catmodal){
    	catmodal.style.display = "none";
    }
}

</script>
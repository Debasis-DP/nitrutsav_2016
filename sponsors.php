<?php 
//error_reporting(0);
ini_set('display_errors', 1);
session_start();

if(!isset($_SESSION["login"]))  
  {  
    echo ('<script> window.open("cms.php", "_self"); </script>');  
  }  
if ( $_SESSION["login"] !== 1 )  
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
$categories_list = array();
$q = mysqli_query($conn,"select name from cms_sponsor_cat");
$r = mysqli_fetch_all($q,MYSQLI_NUM);
for($i=0;$i<mysqli_num_rows($q);$i++)
{
	$categories_list[] = $r[$i][0];
}



?>

<?php
//This code snippet is  for Handling new Event Entries
if(isset($_POST['sponsor_submit']) && ($_SERVER["REQUEST_METHOD"]==="POST"))
{
	
			$up = 0;
			$img_path = '';
			$qSponsorAdd = "insert into cms_sponsor (name,description,category) values ('".mysqli_real_escape_string($conn,$_POST['sponsor_name'])."','".mysqli_real_escape_string($conn,$_POST['sponsor_description'])."','".mysqli_real_escape_string($conn,$_POST['sponsor_cat'])."')";
			$rSponsorAdd = mysqli_query($conn,$qSponsorAdd);
			if(is_uploaded_file($_FILES["sponsor_image"]["tmp_name"]) && $rSponsorAdd)
			{
					
				if(pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION)==="gif"||pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION)==="jpg"||pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION)==="jpeg"||pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION)==="png"||pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION)==="bmp")
				{
					

					$id_que = mysqli_query($conn,"select sid from cms_sponsor");
					$id_res = mysqli_fetch_all($id_que,MYSQLI_NUM);
					
					$ext = pathinfo($_FILES["sponsor_image"]["name"],PATHINFO_EXTENSION);
					$file_path_name = "images/sponsor/sid_".($id_res[mysqli_num_rows($id_que)-1][0]).('.').$ext;
					

					if(move_uploaded_file($_FILES["sponsor_image"]["tmp_name"], $file_path_name))
					{
						
						$img_path = $file_path_name;
						$qImageAdd = "update cms_sponsor set logo_path='".mysqli_real_escape_string($conn,$img_path)."' where sid='".$id_res[mysqli_num_rows($id_que)-1][0]."'";
						$rImageAdd = mysqli_query($conn,$qImageAdd);
						
					}
					else
					{
						echo ('
						<script>
						alert("Image uploading failed!");
						</script>');
					}
				}
				else
				{
					
					echo ('
						<script>
						alert("Wrong Image file type");
						</script>');
				}
			}
			else{
				
				echo ('
						<script>
						alert("Image Not Set OR Upload failed :-(");
						</script>');
			}
			
			unset($_POST['sponsor_submit']);

}
?>

<?php 
//This code snippet to delete any existing Categories
if(isset($_POST["delSub"]))
{
	
	if(!empty($_POST["del"]))
	{
		
		foreach ($_POST["del"] as $sel) {
			
			$delque = mysqli_query($conn,"delete from cms_sponsor_cat where cid = ".$sel);

		}

	}
	else
	{
		echo('
			<script>
			alert("Nothing selected to delete! ");
			</script>');
	}

	echo "<meta http-equiv='refresh' content='0'>";
}



if(isset($_POST['catSub']))
{
	if($_POST['catAddNewText'] !== '')
	{
		$catAddQ = "insert into cms_sponsor_cat (name) values('".mysqli_real_escape_string($conn,$_POST['catAddNewText'])."')";
		$catRunQ = mysqli_query($conn,$catAddQ);
		unset($_POST['catSub']);
		
	}
	else
	{
		echo('
			<script>
			alert("Blank Category! ");
			</script>');
		unset($_POST['catSub']);
	}
	echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST['del_sponsor']) && isset($_SESSION['sid_edit']))
{
	$qDelPath = mysqli_query($conn,"select logo_path from cms_sponsor where sid =".$_SESSION['sid_edit']);
	$rDelPath = mysqli_fetch_all($qDelPath,MYSQLI_NUM);
	$delPath = $rDelPath[0][0];
	unlink($delPath);
	$qDelete = mysqli_query($conn,"delete from cms_sponsor where sid =".$_SESSION['sid_edit']);
	session_unset($_SESSION['sid_edit']);
	unset($_POST['del_sponsor']);
	unset($_POST['sid_sel_edit']);
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SPONSORS MANAGEMENT</title>
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
<div class="Main">

<!--Modal Creation-->
<!-- Trigger/Open The Modal -->
<button id="myBtn">Add New Sposnor</button>
<button id="catBtn" style="float:center;">Manage Sponsor Categories of Fest</button>
<form action="sponsors.php" method="POST">
<input type="submit" name="logout" value="Log Out" style="float:right; font-size:x-large; ">
</form>
<p><small><em>Donot refresh page after adding a sponsor. That will cause duplicacy in data</em></small></p>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <!-- User Defined Content -->
    <br>
    <h3>Add New Sponsor Details Here</h3>
    <br>
    <form action="sponsors.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    	<p>Enter the Name of the Sponsor</p>
    	<br>
    	<input type="text" name="sponsor_name">
    	<br>
    	<p>Enter the Description the Sponsor</p>
    	<br>
    	<input type="text" name="sponsor_description" >
    	<br>
    	<p>Select category of sponsor</p>
    	<input list="categories" name="sponsor_cat">
    	<datalist id="categories">
    		<?php 
    		
    			for($j=0;$j<count($categories_list);$j++)
    			{
    				echo('<option value="'.$categories_list[$j].'">');
    			}
    		?>
    	</datalist>
    	<p>Select Image of the Sponsor </p>
    	<input type="file" name="sponsor_image">
    	<br>
    	<br>
    	<input type="submit" name="sponsor_submit" value="Submit Details" style="float:right;">
    	<br>
    	<br>
    </form>

  </div>

</div>
<!-- Modal -->

<div id="catModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <!-- User Defined Content -->
    <br>
    <h4>Categories Already Present</h4>
    <br>
    <form action="sponsors.php" method="POST">
    	<?php 
    		$catQuery = mysqli_query($conn,"select * from cms_sponsor_cat");
    		$catRes = mysqli_fetch_all($catQuery,MYSQLI_NUM);
    		for($i=0;$i<mysqli_num_rows($catQuery);$i++)
    		{
    			echo('<p><input type="checkbox" name="del[]" value="'.$catRes[$i][0].'"/> '.$catRes[$i][1].'</p>');
    		}
    	?> 
    	<br>
    	<input type="submit" name="delSub" value="Delete Selected Categories">   	
    </form>
    <br>
    <form action="sponsors.php" method="POST">
    	<p> Add New Category <input type="text" name="catAddNewText"></p>
    	<input type="submit" name="catSub" value="Add Category">
    </form>
  </div>

</div>
<!-- Modal -->
<hr>
<h2>Manage existing Sponsors with their Sponsor ID</h2>
<form autocomplete="off" action="sponsors.php" method="POST">
	<p>Select ID of Fest Member</p>
    	<input list="sponsorid" name="sponsor_edit_id">
    	<datalist id="sponsorid">
    		<?php 
    			$sponEditQuery = mysqli_query($conn,"select sid from cms_sponsor");
				$sponEditRes = mysqli_fetch_all($sponEditQuery,MYSQLI_NUM);

    			for($j=0;$j<mysqli_num_rows($sponEditQuery);$j++)
    			{
    				echo('<option value="'.$sponEditRes[$j][0].'">');
    			}
    		?>
    	</datalist>
    <input type="submit" name="sid_sel_edit" value="Select ID">
</form>
<hr>
<?php 

if(isset($_POST['cancelEdit']))
{
	session_unset($_SESSION['sid_edit']);
	unset($_POST['sid_sel_edit']);
}


if(isset($_POST['sid_sel_edit']))
{
	$_SESSION['sid_edit'] = $_POST['sponsor_edit_id'];
	$editQ = mysqli_query($conn,"select * from cms_sponsor where sid = ".$_POST['sponsor_edit_id']);
	$editR = mysqli_fetch_all($editQ,MYSQLI_NUM);
	$catList = '';
	for($j=0;$j<count($categories_list);$j++)
    			{
    				$catList=$catList.'<option value="'.$categories_list[$j].'">';
    			}

	echo ('
			<br>
			<form action="sponsors.php" method="POST">
				<input type="submit" name="cancelEdit" value="Cancel Edition">
			</form>
			<br>
			<form action="sponsors.php" method="POST">
			<input type="submit" name="del_sponsor" value="Remove this Sponsor">
			</form>
			<br>
    <h3>Edit Sponsor Details Here</h3>
    <br>
    <form action="sponsors.php" method="POST" enctype="multipart/form-data">
    	<p>Edit Name of the Sponsor</p>
    	<br>
    	<input type="text" name="edit_name" value="'.$editR[0][1].'">
    	<br>
    	<p>Edit Description of Sponsor</p>
    	<br>
    	<input type="text" name="edit_description" value="'.$editR[0][2].'">
    	<br>
    	<p>Select category of Sponsor</p>
    	<input list="categories" name="edit_cat" value="'.$editR[0][4].'">
    	<datalist id="categories">
    		'.$catList.'
    	</datalist>
    	<p>Select Image of the Sponsor </p>
    	<img src="'.$editR[0][3].'" width="100px" height="100px">
    	<input type="file" name="edit_image">
    	<br>
    	<br>
    	<input type="submit" name="sponsor_edit_sub" value="Save Details" style="float:right;">
    	<br>
    	<br>
    </form>


		');
}


if(isset($_POST['sponsor_edit_sub']) && isset($_SESSION['sid_edit']))
{
	$qEdit = mysqli_query($conn,"update cms_sponsor set name='".mysqli_real_escape_string($conn,$_POST['edit_name'])."' where sid = ".$_SESSION['sid_edit']);
	$qEdit = mysqli_query($conn,"update cms_sponsor set description='".mysqli_real_escape_string($conn,$_POST['edit_description'])."' where sid = ".$_SESSION['sid_edit']);
	$qEdit = mysqli_query($conn,"update cms_sponsor set category='".mysqli_real_escape_string($conn,$_POST['edit_cat'])."' where sid = ".$_SESSION['sid_edit']);
	$qEdit = mysqli_query($conn,"select logo_path from cms_sponsor where sid =".$_SESSION['sid_edit']);
	$rEdit = mysqli_fetch_all($qEdit,MYSQLI_NUM);
	$path_edit = $rEdit[0][0];

	if(is_uploaded_file($_FILES["edit_image"]["tmp_name"]) && $qEdit)
			{
					
				if(pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION)==="gif"||pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION)==="jpg"||pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION)==="jpeg"||pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION)==="png"||pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION)==="bmp")
				{
					
					$ext = pathinfo($_FILES["edit_image"]["name"],PATHINFO_EXTENSION);
					if (pathinfo($path_edit,PATHINFO_EXTENSION)==$ext)
					{
						if(unlink($path_edit))
						{
							if(move_uploaded_file($_FILES["edit_image"]["tmp_name"], $path_edit))
							{
								echo ('
								<script>
								alert("Image Saving Done!");
								</script>');			
							}
							else
							{
								echo ('
								<script>
								alert("Image Saving failed!");
								</script>');
							}
						}
						else
						{
							echo ('
								<script>
								alert("Image Saving failed!");
								</script>');
						}
					}		
					else
					{
						echo ('
						<script>
						alert("Wrong Image file type");
						</script>');
					}
					
				}
				else
				{
					
					echo ('
						<script>
						alert("Wrong Image file type");
						</script>');
				}
			}
			else{
				
				echo ('
						<script>
						alert("Saving Image failed OR image not changed.");
						</script>');
			}

unset($_POST['sid_sel_edit']);
session_unset($_SESSION['sid_edit']);
unset($_POST['sponsor_edit_sub']);
}



?>
<hr>
<!-- contents of the page that show events-->
<h2>Sponsors present in the Database and Website</h2>



<?php 

$sponQuery = mysqli_query($conn,"select * from cms_sponsor");
$sponRes = mysqli_fetch_all($sponQuery,MYSQLI_NUM);

for($k=0;$k<mysqli_num_rows($sponQuery);$k++)
{
	echo('
		<h3>'.$sponRes[$k][1].'</h3>
<h4>Sponsor ID in database : <bold>'.$sponRes[$k][0].'</bold></h4>
<img src="'.$sponRes[$k][3].'" height="100px" width="100px">
<h4>Description</h4>
<p>'.$sponRes[$k][2].'</p>
<h4>Category</h4>
<p>'.$sponRes[$k][4].'</p>
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
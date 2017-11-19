<?php
session_start();
include('db_detail.php');
error_reporting(0);
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name) or die('Could not connect to server.' );
if(isset($_SESSION["USERID"]))
{
$detQ = mysqli_query($conn,"select * from userdetails where userid=".$_SESSION["USERID"]);
$detR = mysqli_fetch_all($detQ,MYSQLI_NUM);
$id = 'NITR-NU-'.$detR[0][0];

$eve = mysqli_query($conn, "select eid from userreg where userID=".$_SESSION["USERID"]);

$ever = mysqli_fetch_all($eve,MYSQLI_NUM);

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="shortcut icon" href="profile1.png">
	 <link href="css/style.css" rel="stylesheet">
	 <link href="css/custom.css" rel="stylesheet">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div style="padding-top:50px;"></div>  
<center><div><button class="btn btn-danger btn-lg" onclick="myFunction()">Print this page</button></div><br/></center>
<div class="col-sm-2"></div>  
	<div class="col-sm-8"> 
	
 <table class="table table-bordered">
  <thead>
  <tr>
      <th colspan="5"> <center> <img src="profile2.png" alt="NIT ROURKELA"  id="nit" width="80"/>
      <img src="profile1.png" alt="INNOVISION 2016" id="inno" width="80"/></center></th>
    </tr>
  <tr>
      <th colspan="5"> <center><h2><?php echo $id; ?></h2></center></th>
    </tr>
	<tr>
      <th colspan="2">Name : <?php echo $detR[0][1] ?></th>
      <th colspan="3">College/University : <?php echo $detR[0][3] ?></th>
    </tr>
	<tr>
      <th colspan="2">Email: <?php echo $detR[0][2] ?></th>
      <th colspan="2">Contact : <?php echo $detR[0][5] ?></th>
      <th>Gender : <?php echo $detR[0][6] ?></th>
    </tr>
    <tr>
      <th>#</th>
      <th>Event Name</th>
      <th>Date</th>
      <th>Time</th>
	  <th>Venue</th>
    </tr>
  </thead>
  <tbody>
   	<?php 
if (mysqli_num_rows($eve)>0)
{
		for($i=0;$i<mysqli_num_rows($eve);$i++) {
			$eveData = mysqli_query($conn, "select title,date,time,venue from cms_events where eid=".$ever[$i][0]);
			$eveDatar = mysqli_fetch_all($eveData,MYSQLI_NUM);
			echo "<td>".$i."</td>";
			echo "<td>".$eveDatar[0][0]."</td>";
			echo "<td>".$eveDatar[0][1]."</td>";
			echo "<td>".$eveDatar[0][2]."</td>";
			echo "<td>".$eveDatar[0][3]."</td>";
												} 
}
else 
{
	echo '<td colspan="5" style="text-align:center;font-size:1.5em;">You have not registered in any of the events.<br/>Take a printout after registering.</td>';

}
?> 

	   </tbody>
	   <tbody>
			<td colspan="5">
			 <div>
      <h3>Note</h3>
      Participants outside NITR would have to pay a registration fees of Rs 500,in which accommodation is included, which would be provided in the in-campus hostel.The registration money includes passes to all events, exhibitions, pro-shows and workshops. Food will  be arranged in the hostel itself for which the participants have to pay for each meal.<br>
				<h3>RULES</h3>
				<ol>
				<li> Any one found damaging the institute property will be removed from the campus and his/her belongings will be seized , untill the penalty fee is deposited.</li>
				<li> Under no circumstances registration fee will be refunded.</li>
				<li> Smoking and Drinking is strictly prohibited.</li>
				</ol>
      
      </div>
			</td>
	   </tbody>
	  </table> 
</div>
<script>
function myFunction() {
    window.print();
}
</script>

  </body>
</html>
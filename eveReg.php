<?php 
session_start();
error_reporting(0);

include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
$a = "insert into userreg (userID,eid) values(".$_POST['userid'].",".$_POST['EID'].")";
$q = mysqli_query($conn, $a);
if($q)
{
	echo '1';
}
else
{
	echo $a;
}
?>
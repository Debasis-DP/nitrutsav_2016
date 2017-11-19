<?php
session_start();
include('db_detail.php');
error_reporting(0);
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name) or die('Could not connect to server.' );
if(isset($_SESSION["USERID"]))
{
$detQ = mysqli_query($conn,"select * from userdetails where userid=".$_SESSION["USERID"]);
$detR = mysqli_fetch_all($detQ,MYSQLI_NUM);
$id = 'INNO-'.$detR[0][0].'-'.strtoupper(substr($detR[0][1],0,3));

}



?>

<!DOCTYPE html>

<style type="text/css">
body{
  font-family: Arial;
}
#nit{
  padding-right: 1%;
  border-right: 2px solid #383838;
  position: absolute;
  top: 10%;
  left: 43%;
}
#inno{
  position: absolute;
  top: 10%;
  left: 50%;
}
#name{
  position: absolute;
  top: 45%;
  left: 25%;
  font-size: 150%;
  list-style: none;
}
#resource{
  position: absolute;
  list-style: none;
  top: 45%;
  left: 55%;
  font-size: 150%;
}
#id{
  
  font-weight: bold;
}
#text{
  position: absolute;
  top: 25%;
  width: 99%;
  text-align: center;
  font-size: 200%;
  letter-spacing: 10px;
}
</style>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css" media="screen" title="no title" charset="utf-8">
    <link rel="shortcut icon" href="profile1.png">
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <img src="profile2.png" alt=""  id="nit" width="80"/>
    <img src="profile1.png" alt="" id="inno" width="80"/>
    <div id="text">
      INNOVISION-2016 <br> NIT Rourkela
    </div>
    <ul id="name">
      <li>Innovision ID</li>
      <li>Name</li>
      <li>University / College</li>
      <li>Email-ID</li>
    </ul>
    <ul id="resource">
      <li id="id"><?php echo $id; ?></li>
      <li><?php echo $detR[0][1] ?></li>
      <li><?php echo $detR[0][3] ?></li>
      <li><?php echo $detR[0][2] ?></li>
    </ul>
    
    <button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
  </body>
</html>

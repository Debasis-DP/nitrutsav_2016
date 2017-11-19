<?php 
session_start();
error_reporting(0);
//$_SESSION["USERID"] = '';
include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Nitrutsav 2017</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="http://nitrutsa.nitrkl.ac.in" name="author">
	<link rel="shortcut icon" href="profile1.png">
	<!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	 <link href="css/custom.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="modal/css/default.css" />
	<link rel="stylesheet" type="text/css" href="modal/css/component.css" />
	<script src="modal/js/modernizr.custom.js"></script>
  <link rel="stylesheet" href="login/css/normalize.min.css">
	<link rel="stylesheet" href="login/css/style.css">
		  <script src="checks/alert_epreuve/dist/sweetalert.min.js"></script> 
  <link rel="stylesheet" type="text/css" href="checks/alert_epreuve/dist/sweetalert.css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>



<body style="overflow:;background:url(img/bg.jpg) no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">




<?php 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(isset($_POST["regBut"]))
  {
  	$genP = '';
  	if($_POST["genIP"]=='')
  	{
  		$genP ='Male';
  	}
  	else
  	{
  		$genP = $_POST["genIP"];
  	}
      $regQ = "insert into userdetails (uname,uemail,univerName,pass,contact,gender) values('".$_POST["nameIP"]."','".$_POST["emailIP"]."','".$_POST["collIP"]."','".$_POST["pwdIP"]."','".$_POST["conIP"]."','".$genP."')";
      $regQUERY = mysqli_query($conn,$regQ);
      if($regQUERY)
      {
        echo ('
              <script>
              
              swal({   
                                           title: "You have successfully registred at NITRUTSAV 2017", 
                                           text: "",  
                                           type: "success",
                                           confirmButtonText: "OK",
                                           }, 
                                           function(isConfirm){  
                                            if (isConfirm) {    
                                             
                                             history.go(-2);
                                              } else {    
                                                history.go(-2);
                                               } 
                                               });

              </script>

          ');
      }
      else
      {
        echo ('
              <script>
              swal("Oops!", "You must have already registred", "error");
              </script>
          ');
      }
  }
  unset($_POST["regBut"]);

  if(isset($_POST["logBut"]))
  {
      $logQ = "select userid from userdetails where uemail = '".$_POST["emLP"]."' AND pass = '".$_POST["pwLP"]."' ";
      $logQuery = mysqli_query($conn,$logQ);
      $logR = mysqli_fetch_all($logQuery,MYSQLI_NUM);
      if(mysqli_num_rows($logQuery)==1)
      {
          $_SESSION["USERID"]  = $logR[0][0];
          echo ('
              <script>
              
              	swal({   
                                           title: "You have successfully logged in at NITRUTSAV 2017", 
                                           text: "",  
                                           type: "success",
                                           confirmButtonText: "OK",
                                           }, 
                                           function(isConfirm){  
                                            if (isConfirm) {    
                                             history.go(-2);
                                              } else {    
                                                history.go(-2);
                                               } 
                                               });

              </script>

          ');
      }
      else
      {
        $_SESSION["USERID"]  = '';
        echo ('
              <script>
              swal("Oops!", "Your credentials don\'t match", "error");
              </script>
          ');
      }
  }
}
?>






    <div class="home-page" id="wrapper">
        <!-- start header -->

       <?php
	   include 'menu.php';
	   ?>   

	   
	    <div style="padding:30px;"></div>
	     <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up</h1>
          
          <form action="signin" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Full Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="nameIP"/>
            </div>
        
            <div class="field-wrap">
              <label>
                Contact Number<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" title="Enter valid Indian Number" name="conIP"/>
            </div>
          </div>

          	<div class="top-row">
          	<div class="field-wrap" style="margin:0;">
          	<input type="radio" name="genIP" value="Male" checked style="height:1em; width: 1em;margin-left:4em;"><p style="margin-top:-1.2em;margin-left:7em;">Male</p>
          	</div>
          	<div class="field-wrap" style="margin:0;">
          	<input type="radio" name="genIP" value="Female" checked style="height:1em; width: 1em;margin-left:4em;"><p style="margin-top:-1.2em;margin-left:7em;">Female</p>
          	</div>
		</div>


          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="emailIP"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter valid Email ID" />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="pwdIP"/>
          </div>

          <div class="field-wrap">
            <label>
              University/College Name<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name="collIP"/>
          </div>
          
          <button type="submit" class="button button-block" name="regBut"/>Register</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="signin" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="emLP" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="pwLP"/>
          </div>
          
          <button class="button button-block" name="logBut" />Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
	   
	   
	   
	   
	   
	   
	   
	   
	    <div style="padding:30px;"></div>  <div style="padding:30px;"></div> 
    <?php
	include 'footer.php';
	?>
		
    </div><a class="scrollup fa fa-angle-up active" href="#"></a> <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src='login/js/jquery.min.js'></script>

    <script src="login/js/index.js"></script>
    <script src="js/jquery.js"></script> <script src="js/jquery.easing.1.3.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/jquery.fancybox.pack.js"></script> <script src="js/jquery.fancybox-media.js"></script> <script src="js/portfolio/jquery.quicksand.js"></script> <script src="js/portfolio/setting.js"></script> <script src="js/jquery.flexslider.js"></script> <script src="js/animate.js"></script> <script src="js/custom.js"></script> <script src="js/owl.carousel.js"></script>
</body>
</html>
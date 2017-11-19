<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Nitrutsav 2017</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="http://nitrutsav.nitrkl.ac.in" name="abhijeet">
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
<link href="nu/css/css.css" rel="stylesheet" />
<link href="css/animate.css" rel="stylesheet" />

<link href="nu/css/custom.css" rel="stylesheet"/>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="nu/js/js.js" type="text/javascript"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body style="overflow:hidden;>
    <div class="home-page" id="wrapper">

    <?php
    if(isset($_GET["q"]))
    {
        if($_GET["q"]=="logout")
        {
            unset($_SESSION['USERID']);
        }
    }
    ?>
        <!-- start header -->

       <?php
	   include 'menu.php';
	   ?>    
<img id="top1" src="assets/center curtain.png" alt="top">
<img id="top2" src="assets/center curtain.png" alt="top">
<img id="top4" src="assets/center curtain.png" alt="top">
<img id="top3" src="assets/center curtain.png" alt="top">
<div class="leftcurtain" >
<img id="lft" src="nu/assets/curtainLeft.jpg" alt="curtain">
</div>
<div class="rightcurtain">
<img id="rgt" src="nu/assets/curtainRight.jpg" alt="curtain">
</div>
<div class="leftcurtain1">
<img id="lft1" src="nu/assets/curtainLeft.jpg" alt="curtain">
</div>
<div class="rightcurtain1">
<img id="rgt1" src="nu/assets/curtainRight.jpg" alt="curtain">
</div>


<div class="stage" style="background:url(img/bg.jpg) no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
<img id="bstage" src="nu/assets/stage2.jpg">
<!--<img id="stage1" src="assets/stagefloor.png">
<img id="seats" src="assets/seats.png">-->
	<img id="st" class="nu_image wow animated tada" src="img/mainimage.png" alt="top">  
	
</div>

<center><center>
                            <?php 
                                if(isset($_SESSION["USERID"]))
                                {
                                    $name='Dear';
                                    $qr=mysqli_query($conn,"select uname from userdetails where userid=".$_SESSION["USERID"]);
                                    $q = mysqli_fetch_all($qr,MYSQLI_NUM);
                                    $name = $q[0][0];

                                    if($name!=''){
                                    echo('
                                          

                                            <div class="button-reg wow animated tada"><a href="profile" target="blank"><button>Hi '.$name.' !</button></a></div>

                                        ');}
                                    else
                                    {
                                        echo('
										
                                        
										<div class="button-reg wow animated tada"><a href="signin"><button>Register Now</button></a></div>

                                        ');
                                    }
                                }
                                else
                                {
                                    echo('
									
                                       <div class="button-reg wow animated tada"><a href="signin"><button>Register Now</button></a></div>

                                        ');
                                }
                            
                            ?>



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
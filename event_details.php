<?php 

session_start();
include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

$dataq = mysqli_query($conn,"select * from cms_events where eid=".$_GET['eid']);
$datar = mysqli_fetch_all($dataq,MYSQLI_NUM);

$eid = $_GET['eid'];
$uid = 'ABC';
if(isset($_SESSION['USERID'])){
	if($_SESSION['USERID']=='')
	{
		$uid = 'ABC';
	}
	else
	{
		$uid = $_SESSION['USERID'];	
	}
	
}


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Event Details</title>
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
		<link rel="stylesheet" type="text/css" href="tab/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabstyles.css" />
		
  <script src="checks/alert_epreuve/dist/sweetalert.min.js"></script> 
  <link rel="stylesheet" type="text/css" href="checks/alert_epreuve/dist/sweetalert.css">

</head>

<body style="overflow:;background:url(img/bg.jpg) no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;;">
    <div class="home-page" id="wrapper">
        <!-- start header -->

       <?php
	   include 'menu.php';
	   ?>    <div style="padding:50px;"></div>
		<div class="aligncenter">
                            <h2 class="aligncenter" style="color:#FFF;"><?php echo(nl2br($datar[0][1])); ?></h2>	
                        </div> 
	   <!-- Event Image <?php //echo('<img src="'.$datar[0][1]).'"/>'; ?>-->
	   <section>

				<div class="tabs tabs-style-linebox event-content">
					<nav>
						<ul>
							<li><a href="#section-linebox-1"><span>Description</span></a></li>
							<li><a href="#section-linebox-2"><span>Rules</span></a></li>
							<li><a href="#section-linebox-3"><span>Dat</span></a></li>
							<li><a href="#section-linebox-4"><span>Coordinators</span></a></li>
							<li><a href="#section-linebox-5"><span>Register</span></a></li>
						</ul>
					</nav>
					<div class="event-content" style="overflow-y:scroll;">
					<div class="content-wrap">
						<section id="section-linebox-1"><?php echo(nl2br($datar[0][2])); ?></section>
						<section id="section-linebox-2"><p><?php echo(nl2br($datar[0][3])); echo('<br><hr><br>'); echo(nl2br($datar[0][4])); ?></p></section>
						<section id="section-linebox-3"><p><?php echo('Date : '.$datar[0][5]); echo('<br><hr><br>'); echo('Time : '.$datar[0][7]); echo('<br><hr><br>'); echo('Venue : '.$datar[0][6]);?></p></section>
						<section id="section-linebox-4"><p><?php echo(nl2br($datar[0][10])); ?></p></section>
						<section id="section-linebox-5"><br><br><br><br><center id="reg">
						<?php $chq = mysqli_query($conn, "select userID from userreg where userID=".$uid." and eid =".$eid); 
						if(mysqli_num_rows($chq)==0){echo('<button onclick="registerEvent()">REGISTER</button>');}
						else{echo('<h3 style="color:#FFF;">You have already registred for the event</h3>');} ?>
						</center></section>
					</div><!-- /content -->
					</div>
				</div><!-- /tabs -->
			</section>
	   <div style="padding:50px;"></div><div style="padding:50px;"></div>
	   
	   
	   
    <?php
	include 'footer.php';
	?>
	


    </div><a class="scrollup fa fa-angle-up active" href="#"></a> <!-- javascript
    ================================================== -->
    
    <script type="text/javascript">
    	function registerEvent(){
    //var csrftoken = getCookie('csrftoken');

    var d = <?php echo("'".$uid)."'"; ?>;
    if(d=='ABC'){
    	swal({   
                                           title: "Oops! You have to log in before registering in the Event", 
                                           text: "",  
                                           type: "warning",
                                           confirmButtonText: "OK",
                                           }, 
                                           function(isConfirm){  
                                            if (isConfirm) {    
                                             window.open("signin","_self"); 
                                              } else {    
                                                window.open("signin","_self");
                                               } 
                                               });
    }
    else
    {
    	var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange=function(){

    if(ajaxObj.readyState==4 && ajaxObj.status==200){
        responseResult = ajaxObj.responseText;
        if(responseResult=='1')
        {
          swal("Cool!", "You are registred for the event", "success");
          document.getElementById("section-linebox-5").innerHTML = '<h3 style="color:#FFF;">You have already registred for the event</h3>';
        }
        else{
        	swal("Oops!", "Registration failed :-(", "error");

        }
    }
  }
  ajaxObj.open("POST", "eveReg.php",true);
  //ajaxObj.setRequestHeader("X-CSRFToken", csrftoken); //Required for django cross site request protection forgery
  ajaxObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //Reuired for POST method
  //ajaxObj.setRequestHeader("X-Requested-with", "XMLHttpRequest"); //Required for django to understand if ajax method
  ajaxObj.send(<?php echo "'userid=".$uid."&EID=".$eid."'"; ?>);
  


  }
    }
    </script>


    <!-- Placed at the end of the document so the pages load faster -->
	 <script src="tab/js/cbpFWTabs.js"></script><script src="tab/js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
    <script src="js/jquery.js"></script> <script src="js/jquery.easing.1.3.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/jquery.fancybox.pack.js"></script> <script src="js/jquery.fancybox-media.js"></script> <script src="js/portfolio/jquery.quicksand.js"></script> <script src="js/portfolio/setting.js"></script> <script src="js/jquery.flexslider.js"></script> <script src="js/animate.js"></script> <script src="js/custom.js"></script> <script src="js/owl.carousel.js"></script>
</body>
</html>
<?php 
session_start();
include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

$dataq = mysqli_query($conn,"select * from cms_events");
$datar = mysqli_fetch_all($dataq,MYSQLI_NUM);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Nitrutsav Events</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="abhijeet" content="http://nitrutsav.nitrkl.ac.in" />
<link rel="shortcut icon" href="profile1.png">
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
 <link href="css/custom.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="modal/css/default.css" />
 <link rel="stylesheet" type="text/css" href="modal/css/component.css" />
 		<link rel="stylesheet" type="text/css" href="css/set1.css" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>

	<?php
	include 'menu.php';
	?>
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 ">
				<div class="aligncenter">
                            <h2 class="aligncenter">Events</h2></div>
			</div>
		</div>
	</div>
	</section>
	<section id="content"  style="background:url(img/events_bg.jpg) no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="portfolio-categ filter">
					<li class="all active"><a href="#">All</a></li>
					<li class="competitions"><a href="#" title="">Competitions</a></li>
					<li class="workshops"><a href="#" title="">Workshops</a></li>
					<li class="guests"><a href="#" title="">Guest Lectures</a></li>
				</ul>
				<div class="clearfix">
				</div>
				<div class="row wow animated bounceInUp">
					<section id="projects">
					<ul id="thumbs" class="portfolio">
					
					
					
					<?php 
						for($i=0;$i<mysqli_num_rows($dataq);$i++){

							echo('

									<li class="item-thumbs design col-sm-3" data-id="id-'.$i.'" data-type="'.$datar[$i][9].'">
						<!-- Fancybox - Gallery Enabled - Title - Full Image -->
						
						
						<div class="grid">
					<figure class="effect-sarah">
						<img src="'.$datar[$i][8].'" alt="Image from Event"/>
						<figcaption>
							<h2><span>'.$datar[$i][1].'</span></h2>
							<p>Read More</p>
							<a href="event_details.php?eid='.$datar[$i][0].'">View more</a>
						</figcaption>			
					</figure>
					
				</div>
						
						
						</li>
						

								');

						}
					?>
					
					
					
						<!-- Item Project and Filter Name -->
						<!--
						
						<li class="item-thumbs design col-sm-3" data-id="id-0" data-type="competitions">
						
						
						
						<div class="grid">
					<figure class="effect-sarah">
						<img src="img/220.jpg" alt="img13"/>
						<figcaption>
							<h2>Free <span>Sarah</span></h2>
							<p>Read More</p>
							<a href="event_details.php">View more</a>
						</figcaption>			
					</figure>
					
				</div>
						
						
						</li>
						-->						
						
					</ul>
					</section>
				</div>
			</div>
		</div>
	</div><div style="padding:50px;"></div><div style="padding:200px;"></div>
	</section> 
	<?php
	include 'footer.php';
	?>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
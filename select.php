
<?php 

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


	if ( $_SESSION["access_level"] === 0) {
		

		echo('<!DOCTYPE html>
<html>
<head>
	<title>SELECT TASK</title>
	<link rel="shortcut icon" type="image/png" href="icon.png">
</head>
<body>
<form action="select.php" method="POST">
<input type="submit" name="logout" value="Log Out" style="float:right; font-size:x-large;">
</form>
</body>
</html>');
		
		echo('<a href="manager.php"><img src="editors.jpg" onmouseover="this.src=\'editors_alt.png\'" onmouseout="this.src=\'editors.jpg\'" alt="Editors Management System" style="width:380px; height:280px; float:left; margin-left:200px; margin-top:30px;"></a>');
		echo('<a href="event.php"><img src="events.jpg" onmouseover="this.src=\'events_alt.png\'" onmouseout="this.src=\'events.jpg\'" alt="Events Management System" style="width:380px; height:280px; float:right; margin-right:160px; margin-top:30px;"></a>');
		echo('<br><br>');
		echo('<a href="team.php"><img src="teams.jpg" onmouseover="this.src=\'teams_alt.png\'" onmouseout="this.src=\'teams.jpg\'" alt="Teams Management System" style="width:380px; height:280px; float:left; margin-left:200px; padding-top:20px;"></a>');
		echo('<a href="sponsors.php"><img src="sponsors.jpg" onmouseover="this.src=\'sponsors_alt.png\'" onmouseout="this.src=\'sponsors.jpg\'" alt="Sponsors Management System" style="width:380px; height:280px; float:right; margin-right:260px; padding-top:20px;"></a>');
		echo('<style type="text/css"> body{background-color:rgba(46, 12, 5, 0.5);} </style>' );
	}

	else if ( $_SESSION["access_level"] === 1 ) {

		
		echo('<!DOCTYPE html>
<html>
<head>
	<title>SELECT TASK</title>
	<link rel="shortcut icon" type="image/png" href="icon.png">
</head>
<body>
<form action="select.php" method="POST">
<input type="submit" name="logout" value="Log Out" style="float:right; font-size:x-large;">
</form>
</body>
</html>');

		echo('<style type="text/css"> body{background-color:rgba(46, 12, 5, 0.5);} </style>' );
		echo('<a href="event.php"><img src="events.jpg" onmouseover="this.src=\'events_alt.png\'" onmouseout="this.src=\'events.jpg\'" alt="Events Management System" style="width:380px; height:280px; float:left; margin-top:200px; margin-left:50px; "></a>');
		echo('<a href="team.php"><img src="teams.jpg" onmouseover="this.src=\'teams_alt.png\'" onmouseout="this.src=\'teams.jpg\'" alt="Teams Management System" style="width:380px; height:280px; float:left; margin-top:200px; margin-left: 50px; "></a>');
		echo('<a href="sponsors.php"><img src="sponsors.jpg" onmouseover="this.src=\'sponsors_alt.png\'" onmouseout="this.src=\'sponsors.jpg\'" alt="Sponsors Management System" style="width:380px; height:280px; float:right; margin-top:165px; margin-right:50px; "></a>');
	}

?>

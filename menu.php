<?php 

error_reporting(0);
session_start();
include('db_detail.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
?>

<header>
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target=
                        ".navbar-collapse" data-toggle="collapse" type=
                        "button"><span class="icon-bar"></span> <span class=
                        "icon-bar"></span> <span class=
                        "icon-bar"></span></button> <a class="navbar-brand"
                        href="index" style="
    margin-top: 10px;
"><img alt="logo" src=
                        "img/nu_black.png" style="width:35px;height:35px;"></a>
                    </div>

                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
						<li>
										<a style="padding-top: 8px;" href="about_us">About Us</a>
										</li>
                           <!-- <li>
                                <a style="padding-top: 8px;" href="events" style=":hover{color:#FFF;};">EVENTS</a>
                            </li>-->
							<li>
                                <a style="padding-top: 8px;" href="proshows">PRO-SHOWS</a>
                            </li>
							<li>
										<a style="padding-top: 8px;" href="social_cause">Social Cause</a>
										</li>
							
							<!--<li>
                                <a href="gallery" style=":hover{color:#FFF;};padding-top: 8px;">GALLERY</a>
                            </li>-->
							<!--
							<li style="padding-top: 8px;">
                                <a href="previous_sponsors" style="padding-top: 8px;">PREVIOUS SPONSORS</a>
                            </li>-->
							
							
										
                            <?php 
                                if(isset($_SESSION["USERID"]))
                                {
                                    $name='Dear';
                                    $qr=mysqli_query($conn,"select uname from userdetails where userid=".$_SESSION["USERID"]);
                                    $q = mysqli_fetch_all($qr,MYSQLI_NUM);
                                    $name = $q[0][0];

                                    if($name!=''){
                                    echo('
                                          <li>
                                              <a href="profile" target="_blank"  style="padding-top: 8px;"> Hi '.$name.' !</a> 
                                            </li>

                                            <li>
                                            <a href="index.php?q=logout"  style="padding-top: 8px;">LOGOUT</a>
                                            </li>

                                        ');}
                                    else
                                    {
                                        echo('
										
                                        
										<li>>
										<a href="signin"  style="padding-top: 8px;">LOGIN</a>
										</li>

                                        ');
                                    }
                                }
                                else
                                {
                                    echo('
									
                                        <li>
                                <a href="signin"  style="padding-top: 8px;">LOGIN</a>
                            </li>

                                        ');
                                }
                            
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header><!-- end header -->
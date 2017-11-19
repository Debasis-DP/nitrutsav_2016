<?php session_start(); 
include('db_detail.php');?> 
 
<?php  
 
  error_reporting(0); 
   
  $pgre = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL']==='max-age=0'; 
   
  if($pgre) { 
 
    session_unset($_SESSION["submitCHK"]); 
        session_unset($_SESSION["submitCHKmsg"]); 
        session_unset($_SESSION["nameCHK"]); 
        session_unset($_SESSION["pswdCHK"]); 
        session_unset($_SESSION["nameCHKmsg"]); 
        session_unset($_SESSION["pswdCHKmsg"]); 
    } 
?> 
 
<!DOCTYPE html> 
 
<html lang="en-US"> 
 
<head> 
 
  <title>Log In</title> 
  <link rel="shortcut icon" type="image/png" href="icon.png">
 
</head> 
 
<body style="color:white; background-color:rgb(46, 12, 5); "> 
 
  <h1 style="text-align:center; font-size:xx-large; padding-top:50px;"> <strong>NIT Rourkela Tech-fest Content Management System</strong></h1> 
  <h4> Maintained and Developed by - Monik Raj Behera | Sudha Priyadarshini </h4>
 
  <img src="login_img.png" width="400px" height="300px" style="margin-top:120px; float:left; margin-left:200px;"> 
 
  <form action="cms.php" method="POST" style="margin-right:200px; margin-top:150px; float:right; font:Verdana"> 
 
    <p><?php if(isset($_SESSION["submitCHK"])){ if($_SESSION["submitCHK"]==0){echo $_SESSION["submitCHKmsg"];}} ?></p><br> 
     
    <pre>Username : <input type="text" name="username"><p><?php if(isset($_SESSION["nameCHK"])){ if($_SESSION["nameCHK"]==1){echo $_SESSION["nameCHKmsg"];}} ?></p></pre><br> 
    <pre>Password : <input type="password" name="password"><p><?php if(isset($_SESSION["pswdCHK"])){ if($_SESSION["pswdCHK"]==1){echo $_SESSION["pswdCHKmsg"];}} ?></p></pre><br> 
    <pre>           <button type="submit">Log In</button></pre> 
  </form> 
 
</body> 
 
</html> 
 
<?php 

  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
     
      if (empty($_POST["username"])) { 
 
          if (empty($_POST["username"])) { 
 
              $_SESSION["nameCHKmsg"] = "Username is required."; 
              $_SESSION["nameCHK"] = 1; 
         
              echo(' <script> window.open("cms.php","_self"); </script>'); 
 
          } else { 
         
              $_SESSION["nameCHK"] = 0; 
         
            } 
 
          if (empty($_POST["password"])) { 
 
              $_SESSION["pswdCHKmsg"] = "Password is required."; 
              $_SESSION["pswdCHK"] = 1; 
       
              echo(' <script> window.open("cms.php","_self"); </script>'); 
       
            } else { 
       
              $_SESSION["pswdCHK"] = 0; 
       
            } 
       
      } else {

        $conn = mysqli_connect( $db_host,$db_user,$db_pwd,$db_name) or die('Could not connect to server.' ); 
          
          $sql = "select * from cms_member where userid = '".$_POST["username"]."' AND password = '".$_POST["password"]."'"; 
          $loginResult = mysqli_query($conn, $sql); 
          $loginResultArray = mysqli_fetch_all($loginResult,MYSQLI_NUM);       
 
          if (!empty($loginResultArray)) { 
             
            $_SESSION["login"] = 1; 
              $_SESSION["access_level"] = (int)$loginResultArray[0][5]; 
              echo (' <script> window.open("select.php","_self"); </script> '); 
       
          } else { 
        
            $_SESSION["submitCHK"] = 0; 
              $_SESSION["login"] = 0; 
              $_SESSION["submitCHKmsg"] = "Invalid username or password. Try again!!"; 
           
              echo (' <script> window.open("cms.php","_self"); </script> '); 
 
          } 
 
          mysqli_close($conn); 
 
      } 
   
    }   
 
?>
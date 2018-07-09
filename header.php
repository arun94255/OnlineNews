<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
ob_start();
session_start();
function err($eno, $emsg){    
}
set_error_handler("err");
require_once 'include/const.php';
require_once 'include/db.php';
require_once 'include/my_mail.php';
require_once 'include/myfunc.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title>Online News</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="scripts/jquery.jcarousel.setup.js"></script>
	<link rel="stylesheet" href="scripts/valid/css/screen.css">
        <script src="scripts/valid/lib/jquery.js"></script>
	<script src="scripts/valid/dist/jquery.validate.js"></script>
<style>
    table tbody td, table{
        border: 0;
    }
</style>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <p>Tel: xxxxx xxxxxxxxxx | Mail: info@onlinenews.com</p>
    <ul>
      <?php
      if  (is_login()){
          echo "
 <div id='topnav2'>
        <ul>
       <li>Welcome $_SESSION[uname]</li>
       <li class='last'><a href='#'>Action</a>
            <ul>
              <li><a href='logout.php'>Logout</a></li>
              <li><a href='change_pass.php'>Change Password</a></li>
            </ul>
      </li>
          </ul>
</div>
";

          }
      else {    
      ?>  
      <li class="last"><a href="login.php">Login</a></li>
      <?php
      }
      ?>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div style="background-image: url('images/demo/banner.jpg');" id="header">
      <div  class="fl_left">
      <h1><a href="index.php">Online News</a></h1>
      <p>Always ahead....</p>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="topnav">
    <ul>
        <li <?php if($page=="home") echo "class='active'"?>><a href="index.php">Home</a></li>
      <li><a href="#">Category</a>
        <ul>
            <?php
                    $r = run_sql("select * from cate");
                       echo "<li><a href='index.php'>All</a></li>";
                    while($row = mysql_fetch_array($r)){
                        echo "<li><a href='index.php?cate=$row[cate]'>$row[cate]</a></li>";
                    }
            
            ?>
        </ul>
      </li>
      <?php
      if(is_admin()){
       $act ="";
       if($page=="admin") 
           $act = "class='active'";
       echo "<li ><a href='reg.php'>Register Journalist</a></li>";
       echo "<li $act><a href='admin.php'>Admin</a></li>";   
      }
      if(is_login()){
       $act ="";
       if($page=="article") 
           $act = "class='active'";
       echo "<li $act><a href='secure.php'>Your Articles</a></li>";   
      }
      ?>
      <li <?php if($page=="about") echo "class='active'"?>><a href="about_us.php">About Us</a></li>
      <li <?php if($page=="contact") echo "class='active'"?> class="last"><a href="contact_us.php">Contact Us</a></li>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="featured_slide">
    <div id="featured_content">
      <ul>
        <?php
$whr = " where status = 'approved' ";
 $r = run_sql("select * from news $whr order by id desc limit 10 ");
 while($row = mysql_fetch_array($r)){
     if(file_exists("upload/$row[id].jpg")){
     echo "<li><a href='news_det.php?id=$row[id]'><img class='imgl' style='width:150px;height:130px;' src='upload/$row[id].jpg' alt='' /></a></li>";         
     }
 }        
        ?>
        <li><a href="#"><img src="images/demo/150x130.gif" alt="" /></a></li>
      </ul>
    </div>
    <a href="javascript:void(0);" id="featured-item-prev"><img src="images/prev.png" alt="" /></a> <a href="javascript:void(0);" id="featured-item-next"><img src="images/next.png" alt="" /></a> </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="container">
     <div id="content"> 
         
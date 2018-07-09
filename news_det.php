<?php require_once 'header.php';?>
<div style="" id ="anim1">
        <script>
            $(document).ready( function(){
                $("#anim1").slideUp(0, null);
                $("#anim1").slideDown(3000, null);
                /*
                $st = true;
                       $("h1").animate({
                        fontSize: 30
                    }, 1000 );
                    */
            });          
        </script>
<?php
 $r = run_sql("select * from news where id = $_REQUEST[id]");
if($row = mysql_fetch_array($r)){
  $cd = substr($row[cr_dare], 0, 10);   
  echo "<h1>$row[sub]</h1>";
  echo "<p><img alt='' src='upload/$row[id].jpg' style='float: left; margin: 0px 15px 15px 0px; width=200px; height:200px;'>$row[news]</p>";
  echo "
  <hr>
  <p>
  Created By : $row[email]
  </br>Created Date : $cd
  </br>Category : $row[cate]
  </p>";
  echo "<p>";
  $del_link = "";
  $ap_link = "";
  $rej_link = "";
  $ed_link = "";
  if(is_admin() || ($_SESSION["email"]==$row["email"] && $row["status"]!='approved')){
      $del_link = "<a href='news_del.php?id=$row[id]'>Delete</a>";
  }
  if(is_admin()){
      if($row["status"]!="approved"){
          $ap_link = "<a href='news_apr.php?id=$row[id]'>Approve</a>";
      }
       $rej_link =  "<a href='news_rej.php?id=$row[id]'>Reject</a>";
  }
  if($_SESSION["email"]==$row["email"] && $row["status"]!='approved'){    
      $ed_link = "<a href='news_up.php?id=$row[id]'>Edit</a>";
  }
  echo "<p>$ap_link $rej_link $del_link $ed_link</p>";
  if(is_admin()){
      if($row["type"]!='breaking'){
       echo  "<p><a href='news_brk.php?id=$row[id]&type=breaking'>Make Breaking News</a></p>";          
      }
      else {
       echo  "<p><a href='news_brk.php?id=$row[id]&type='>Remove From Breaking News</a></p>";                    
      }
  }
}
?>
</div>
<?php require_once 'footer.php';?>
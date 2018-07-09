<?php $page="article";?>
<?php require_once 'header.php';?>
<?php
 check_login();
 echo "<h4><a href='news_add.php'>Submit a article</a></h4>";
 $whr = " where email = '$_SESSION[email]' ";
 $r = run_sql("select * from news $whr order by id desc ");
 echo "<h1>News</h1>
      <table>
          <tr><th>Created Date</th><th>Category</th><th>Title</th><th>Status</th></tr>";
 while($row = mysql_fetch_array($r)){
  $cd = substr($row[cr_dare], 0, 10);   
 $title = put_elipses($row["sub"], 40); 
  echo "<tr>
  <td style='width:20%;'>$cd</td>
  <td  style='width:20%;'>$row[cate]</td>
  <td  style='width:50%;'><a href='news_det.php?id=$row[id]'>$title</a></td>
  <td  style='width:20%;'>$row[status]</td>  
  </tr>
  ";

 }
echo "</table>";
 ?>
<?php require_once 'footer.php';?>
<?php $page="admin"?>
<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
 check_admin();
 $whr = " where status = 'new' ";
 $r = run_sql("select * from news $whr order by id ");
 echo "<h1>News</h1>
      <table>
          <tr><th>Created Date</th><th>Category</th><th>Title</th></tr>";
 while($row = mysql_fetch_array($r)){
  $cd = substr($row[cr_dare], 0, 10);   
   $title = put_elipses($row["sub"], 40); 
  echo "<tr>
  <td style='width:20%;'>$cd</td>
  <td  style='width:20%;'>$row[cate]</td>
  <td  style='width:60%;'><a href='news_det.php?id=$row[id]'>$title</a></td></tr>";
 }
echo "      </table>";
 ?>
<?php require_once 'footer.php';?>
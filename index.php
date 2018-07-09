<?php $page="home"?>
<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
 $whr_cat ="";
 if(empty ($_REQUEST["cate"])==false){
 $whr_cat =" and cate = '$_REQUEST[cate]' ";     
 }
 $whr = " where status = 'approved' $whr_cat ";
 $r = run_sql("select * from news $whr order by id desc");
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
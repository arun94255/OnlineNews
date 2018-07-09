<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
$r = run_sql("select * from news where id = $_REQUEST[id]");
$o_row = mysql_fetch_array($r);
if(is_login()==false || $_SESSION["email"]!=$o_row["email"]){
    redirect("index.php");
}
if(isset($_POST["title"])){
$err="";
if(!check_cambo($_POST["cate"])){
    $err = "Category is req!"; 
}    
else if(!check_required($_POST["title"])){
    $err = "Title is required!";     
}
else if(!check_required ($_POST["news"])){
    $err = "News is required!";     
}
else if(check_image("at1")!=""){
    $err = check_image("at1");     
}
else { 
    $query= "UPDATE `news` set 
    `sub` = '$_POST[title]', 
    `news` = '$_POST[news]', 
    `status` = 'new', 
    `cate` = '$_POST[cate]' 
    where id = $_REQUEST[id];";
run_sql($query);
$lid = $_REQUEST[id];
if(isset($_FILES["at1"]) && empty($_FILES["at1"]["name"])!=true){
    move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/$lid.jpg");
}
redirect("secure.php");
}
}
?>
<h1>Update News</h1>
<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Category</td>
            <td>
                <select name="cate" style="width: 140px">
                    <option>Select</option>
                    <?php
                    $r = run_sql("select * from cate");
                    while($row = mysql_fetch_array($r)){
                        $sel="";
                        if($o_row["cate"]==$row[cate])
                        {
                           $sel=" selected='selected'"; 
                        }
                        echo "<option $sel>$row[cate]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Old Image</td>
            <td>
  <?php 
  echo "<img alt='' src='upload/$_REQUEST[id].jpg' style='width=200px; height:200px;'>";
  ?>
                <input type="file"  name="at1"/>
            </td>
        </tr>
        <tr>
            <td>Title</td>
            <td><input style="width: 450px;" type="text" name="title" value="<?php echo "$o_row[sub]";?>"/></td>
        </tr>
        <tr>
            <td>News</td>
            <td>
                <textarea name="news" rows="20" cols="54"><?php echo "$o_row[news]";?></textarea>                
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Submit"/></td>
            <td><input type="reset"/></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red;"><?php echo $err?></td>
        </tr>
    </table>
</form>
<?php require_once 'footer.php';?>

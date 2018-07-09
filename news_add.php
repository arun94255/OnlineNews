<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php

check_login();
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
    $query= "INSERT INTO  `news` (`email`, `sub`, 
    `news`, `cr_dare`, `status`, `cate`) 
    VALUES ('$_SESSION[email]', '$_POST[title]', '$_POST[news]', 
    '$today', 'approved', '$_POST[cate]');";
run_sql($query);
$lid = mysql_insert_id();
if(isset($_FILES["at1"]) && empty($_FILES["at1"]["name"])!=true){
    move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/$lid.jpg");
}
redirect("secure.php");
}
}
?>
<h1>Submit News</h1>
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
                        if($_REQUEST["cate"]==$row[cate])
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
            <td>Image</td>
            <td><input type="file" name="at1" value="<?php echo "$_FILE[at1]";?>"/></td>
        </tr>
        <tr>
            <td>Title</td>
            <td><input placeholder="Title" style="width: 450px;" type="text" name="title" value="<?php echo "$_POST[title]";?>"/></td>
        </tr>
        <tr>
            <td>News</td>
            <td>
                <textarea placeholder="News" name="news" rows="20" cols="54"><?php echo "$_POST[news]";?></textarea>                
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

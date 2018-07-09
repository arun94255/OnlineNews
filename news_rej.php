<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
check_admin();
if(isset($_POST["comment"])){
$err="";
if(!check_required ($_POST["comment"])){
    $err = "Comment is required!";     
}
else { 
    $query= "UPDATE `news` set 
    `status` = 'rejected' 
    where id = $_REQUEST[id];";
run_sql($query);
$r = run_sql("select * from news where id = $_REQUEST[id]");
$o_row = mysql_fetch_array($r);
$link = $base_url . "news_up.php?id=$_REQUEST[id]";
mail_it($o_row["email"], "Your article '$o_row[sub]' has been rejected!", "Comment is : $_REQUEST[comment] </n> Link is : $link", null);
redirect("admin.php");
}
}
?>
<h1>Reject News</h1>
<form method="post" />
    <table>
        <tr>
            <td>Comment</td>
            <td>
                <textarea name="comment" rows="5" cols="50"><?php echo "$_REQUEST[comment]";?></textarea>                
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

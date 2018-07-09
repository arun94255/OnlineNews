<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
if(isset($_POST["email"])){
$err="";
if(!check_required($_POST["email"])){
    $err = "E Mail is required!";     
}
else if(!check_email ($_POST["email"])){
    $err = "E Mail is incorrect!";     
}
else if(!is_exist($_POST["email"])){
    $err = "E Mail is not reg!";     
}
else if(!check_cambo ($_POST["sec_q"])){
    $err = "Seq q is required!";     
}
else if(!check_required($_POST["sec_a"])){
    $err = "Sec a is required!";     
}
else { 
     $query= "select * from  `app_users` 
     where `email` = '$_POST[email]'
     and sec_q = '$_POST[sec_q]' and sec_a = '$_POST[sec_a]' ;";
     $r=run_sql($query);
     if($row= mysql_fetch_array($r)){
         $pass = $row["pass"];
         mail_it($_POST["email"], "Password!!", "Your pass is $pass", null);
        redirect("login.php?msg=2");
     }
     else {
         $err="Incorrect info!";
     }
}
}
?>
<h1>Forget Password</h1>
<form method="post">
    <table>
        <tr>
            <td>EMail</td>
            <td><input type="text" name="email" value="<?php echo "$_POST[email]";?>"/></td>
        </tr>
        <tr>
            <td>Security Question</td>
            <td>
                <select name="sec_q" style="width: 140px">
                    <option>Select</option>
                    <?php
                    $r = run_sql("select * from sec_q");
                    while($row = mysql_fetch_array($r)){
                        $sel="";
                        if($_REQUEST["sec_q"]==$row[que])
                        {
                           $sel=" selected='selected'"; 
                        }
                        echo "<option $sel>$row[que]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Security Ans</td>
            <td><input type="text" name="sec_a" value="<?php echo "$_POST[sec_a]";?>"/></td>
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
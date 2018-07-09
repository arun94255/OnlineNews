<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
check_login();
if(isset($_POST["opass"])){
$err="";
if(!check_required($_POST["opass"])){
    $err = "Old password is req!"; 
}    
else if(!check_required($_POST["npass"])){
    $err = "New Password is required!";     
}
else if($_POST["opass"]==$_POST["npass"]){
    $err = "Password is same as old password!";     
}
else if(check_password ($_POST["npass"])!=""){
    $err = check_password ($_POST["npass"]);     
}
else if(!check_required($_POST["cpass"])){
    $err = "C Password is required!";     
}
else if($_POST["npass"]!=$_POST["cpass"]){
    $err = "Password does not match!";     
}
else { 
    $query= "update  `app_users` set 
    pass = '$_POST[npass]' 
    where pass = '$_POST[opass]' 
    and email = '$_SESSION[email]'";
    $r = run_sql($query);
if(mysql_affected_rows()>0){
redirect("login.php?msg=3");    
}
else {
    $err = "Old password is incorrect!!";
}
}
}
?>
<h1>Change Password</h1>
<form method="post">
    <table>
        <tr>
            <td>Old Password</td>
            <td><input type="password" name="opass"/></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input type="password" name="npass"/></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="cpass"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Change Password!"/></td>
            <td><input type="reset"/></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red;"><?php echo $err?></td>
        </tr>
    </table>
</form>
<?php require_once 'footer.php';?>
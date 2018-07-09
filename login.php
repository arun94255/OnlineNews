<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
<?php
$msg = "";
if(isset($_REQUEST["msg"])){
    if($_REQUEST["msg"]==1)
        $msg = "Your registration was successfull!";
    else if($_REQUEST["msg"]==2)
        $msg = "Your password has been sent!";
    else if($_REQUEST["msg"]==3)
        $msg = "Your password has been changed!!";
}
if(isset($_POST["email"])){
$err="";
if(!check_required($_POST["email"])){
    $err = "E Mail is required!";     
}
else if(!check_required($_POST["pass"])){
    $err = "Password is required!";     
}
else { 
    $email = sanatize($_POST["email"]);
    $pass = sanatize($_POST["pass"]);
     $query= "select * from  `app_users` 
     where `email` = '$email'
     and pass = '$pass' ;";
     $r=run_sql($query);
     if($row= mysql_fetch_array($r)){
         session_start();
         $_SESSION["uname"] = $row["uname"];
         $_SESSION["email"] = $row["email"];
         $_SESSION["roll"] = $row["roll"];
         if(is_admin()){
            redirect("admin.php");                          
         }
         else {
            redirect("secure.php");             
         }
     }
     else {
         $err="Incorrect info!";
     }
}
}
?>
<h4 style="color: red;"><?php echo "$msg";?></h4>
<h1>Login</h1>
<form method="post">
    <table>
        <tr>
            <td>EMail</td>
            <td><input type="text" name="email" value="<?php echo "$_POST[email]";?>"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Login"/></td>
            <td><a href="forget.php">Forget Password</a></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red;"><?php echo $err ?></td>
        </tr>
    </table>
</form>
<?php require_once 'footer.php';?>
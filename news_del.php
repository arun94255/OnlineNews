<?php require_once 'header.php';?>
<?php
check_login();
if(is_admin()){
$query = "delete from news   
    where id = $_REQUEST[id];
";    
}
else {
$query = "delete from news   
    where id = $_REQUEST[id] 
    and email = '$_SESSION[email]' 
    and status = 'new' ;
";        
}
$r=run_sql($query);
unlink("upload/$_REQUEST[id].jpg");
if(is_admin()){
redirect("admin.php");    
}
else {
redirect("secure.php");        
}
?>
<?php require_once 'footer.php';?>

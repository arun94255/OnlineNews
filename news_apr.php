
<?php require_once 'header.php';?>
<?php
check_admin();
$query = "update news set  
    status= 'approved'
    where id = $_REQUEST[id];
";
$r=run_sql($query);
redirect("admin.php");
?>
<?php require_once 'footer.php';?>

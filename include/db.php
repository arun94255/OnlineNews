<?php
require_once 'const.php';
function run_sql($query){
    global $dbname;
    mysql_connect(DB_SERVER, DB_USER, DB_PASS) 
            or die("Could not connect ". mysql_error());
    mysql_select_db($dbname);
    $r=mysql_query($query);
    if(!$r){
        die("DB error while running $query". mysql_error());
    }
    return $r;
}
function sanatize($v){
    return filter_var($v, FILTER_SANITIZE_MAGIC_QUOTES);
}

?>

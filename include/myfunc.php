<?php
function put_elipses($str, $noc){
    if(strlen($str)>$noc){
        $str = substr($str, 0, $noc-3). "...";
    }
    return $str;
}
$today = date("Y-m-d");
function redirect($loc){
    header("location:$loc");
}
function check_login(){
    if(!is_login()){
        redirect("login.php");
    }
}

function is_login(){
    if(isset($_SESSION["email"])){
        return true;
    }
    else {
        return false;
    }
}
function check_admin(){
    if(!is_admin()){
        redirect("login.php");
    }
}
function is_admin(){
    if(is_login() && isset($_SESSION["roll"]) && $_SESSION["roll"]=="admin"){
        return true;
    }
    else {
        return false;
    }
}

function is_author($email){
    if(is_login() && $_SESSION["email"] == $email){
        return true;
    }
    else {
        return false;
    }
}


function is_exist($email){
    $is_exist = false;
    $query = "select * from app_users 
            where email = '$email' ";
    $r = run_sql($query);
    if(mysql_num_rows($r)>0){
        $is_exist=true;
    }   
    return $is_exist;
}
?>

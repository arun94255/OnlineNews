<?php
function check_required($v) {
return !empty($v);
}
function check_cambo($v) {
return !(empty($v) || $v=='Select');
}
function check_email( $email ){
    return filter_var( $email, FILTER_VALIDATE_EMAIL );
}

function check_phone_no( $pn ){
    return preg_match('/^0?[0-9]{10}$/', $pn) || empty ($pn);
}

function check_numeric($v) {
   return is_numeric($v);
}

function check_integer($v) {
   return filter_var($v, FILTER_VALIDATE_INT);
}


function check_date($date_str) {
$date = DateTime::createFromFormat('d/m/Y', $date_str);
if($date==NULL || $date_str != date_format($date, 'd/m/Y'))
{
return false;
}
else {
    return true;
}
}


function check_password($pwd) {
    $err="";
    if (strlen($pwd) < 8) {
        $err = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
       $err = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $err = "Password must include at least one letter!";
    }     
    return $err;
}
function check_image($name){
    $img_err= "";
    if(isset($_FILES[$name]) && empty($_FILES[$name]["name"])!=true){
        if( $_FILES[$name]["size"]/(1024*1024)>=10){
            $img_err = "File is too big max(10 MB allowed!)";
        }
        $ext =end(split("\\.", $_FILES[$name]["name"])); 
        $allowed = Array("jpg", "png", "bmp", "jpeg");
         if(in_array($ext, $allowed)==false){
            $img_err = "File type is not allowed!";             
         }        
    }
    return $img_err;
}
?>

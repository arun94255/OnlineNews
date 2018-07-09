<?php
require_once 'include/const.php';
require_once 'include/db.php';
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or exit(mysql_error());
echo "<br>Connected";
$query= "drop SCHEMA if exists $dbname;";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>DB dropped!!";
$query= "CREATE SCHEMA $dbname;";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>DB Created!!";
mysql_select_db($dbname);
$query= "CREATE  TABLE  `app_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL ,
  `uname` VARCHAR(45) NULL ,
  `pass` VARCHAR(45) NULL ,
  `sec_q` VARCHAR(45) NULL ,
  `sec_a` VARCHAR(45) NULL ,
  `roll` VARCHAR(45) NULL ,
  `pn` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) );
";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>Table Created!!";
$query= "INSERT INTO  `app_users` (`email`, `uname`, 
    `pass`, `sec_q`, `sec_a`, `roll`, `pn`, `status`) 
    VALUES ('admin', 'admin', 'admin', 'admin', 
    'admin', 'admin', 'admin', 'approved');";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>row inserted!!";

$query= "CREATE  TABLE  `sec_q` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `que` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`));
";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>Table Created!!";

$r = mysql_query("INSERT INTO  `sec_q` (`que`) values ('What is ur birth place?')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `sec_q` (`que`) values ('What is ur mothers maidan name?')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `sec_q` (`que`) values ('What is ur favourite food?')", $con) or exit(mysql_error());

$query= "CREATE  TABLE  `cate` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cate` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`));
";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>Table Created!!";

$r = mysql_query("INSERT INTO  `cate` (`cate`) values ('Sports')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `cate` (`cate`) values ('Politics')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `cate` (`cate`) values ('Bollywood')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `cate` (`cate`) values ('World')", $con) or exit(mysql_error());
$r = mysql_query("INSERT INTO  `cate` (`cate`) values ('Other')", $con) or exit(mysql_error());

$query= "CREATE  TABLE  `news` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `sub` TEXT NULL ,
  `news` LONGTEXT NULL ,
  `email` VARCHAR(100) NULL ,
  `cr_dare` DATETIME NULL ,
  `status` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  `cate` VARCHAR(45) NULL ,
  `comment` TEXT NULL ,
  PRIMARY KEY (`id`) );
";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "<br>Table Created!!";
?>

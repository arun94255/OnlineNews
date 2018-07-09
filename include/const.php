<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
$dbname= "onlinenews_db";

define("EM_HOST", "smtp.gmail.com");
define("EM_PORT", 587);
define("EM_FROM", "ec.smtp.test2@gmail.com");
define("EM_FROM_NAME", "Online News Admin");
define("EM_PASS", 'anandgupta');
define("EM_SECURITY", 'tls');

date_default_timezone_set("asia/kolkata");
$today= date("Y-m-d");
$base_url = "http://localhost/OnlineNews/";

?>

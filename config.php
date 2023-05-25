<?php 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'id19792800_intellitrackomain'); 
define('DB_PASSWORD', 'AhA=?Z-V}/hl(j2y'); 
define('DB_NAME', 'id19792800_intellitracko');

date_default_timezone_set('Asia/Kolkata');

// Connect with the database 
$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
 
// Display error if failed to connect 
if (!$db) {
		die("Could not connect: " . mysql_error());
		}
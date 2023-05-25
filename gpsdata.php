<?php 

require 'config.php';

$lat = $_GET['lat'];
$lng = $_GET['lng'];
$speed = $_GET['speed'];

echo $lat;
echo "<br>";
echo $lng;
echo "<br>";
echo "$speed";


$sql = "INSERT INTO tbl_gps(lat,lng,Speed) 
	VALUES('".$lat."','".$lng."','".$speed."')";

if($db->query($sql) === FALSE)
	{ echo "Error: " . $sql . "<br>" . $db->error; }

echo "<br>";
echo $db->insert_id;

<?php
include("config.php");

$con=$db;
 $tableName="tbl_gps";
// $columns= ['id', 'lat','lng','Date','TimeStamp','Speed'];
//$fetchData = fetch_data($db, $tableName, $columns);

$lastrow = mysqli_query($con,"SELECT * FROM $tableName"." ORDER BY id DESC LIMIT 1");
// if (!$lastrow) {
// 	die("Could not connect: " . mysqli_error($db));
// 	}
$get_last_row = mysqli_fetch_array($lastrow);

$lati=$get_last_row['lat'];
$long=$get_last_row['lng'];

$data = [$long,$lati];

echo json_encode($data);
?>
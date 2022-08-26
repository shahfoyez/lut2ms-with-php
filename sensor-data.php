<?php 
 
include "config/config.php";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $id = $latitude = $longitude = $dat = $tim = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $id = test_input($_POST["id"]);
        $latitude = test_input($_POST["latitude"]);
        $longitude = test_input($_POST["longitude"]);
        $dat = test_input($_POST["date"]);
        $tim = test_input($_POST["time"]);
        
        $sql ="UPDATE `tbl_location` SET `id`='" . $id . "',`latitude`='" . $latitude . "',`longitude`='" . $longitude . "',`date`= '" . $dat . "',`time`='" . $tim . "' WHERE id='" . $id . "'";
       // $sql = "INSERT INTO tbl_location (id, latitude, longitude, date, time)
        //VALUES ('" . $id . "', '" . $latitude . "', '" . $longitude . "', '" . $dat . "', '" . $tim . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        $conn->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

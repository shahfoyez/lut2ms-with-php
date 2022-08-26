<?php 
 
 include "../config/config.php"; 
  
 if($_SERVER['REQUEST_METHOD']=='GET'){
		
	$route  = $_GET['route'];
 
 $stmt = $conn->prepare("SELECT id, latitude, longitude FROM tbl_location where route ='".$route."'AND avail = true");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id, $latitude, $longitude);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
	$temp = array();
	$temp['id'] = $id; 
	$temp['latitude'] = $latitude; 
	$temp['longitude'] = $longitude; 
	array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);
}

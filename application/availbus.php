<?php 
 
 include "../config/config.php"; 
  
 if($_SERVER['REQUEST_METHOD']=='GET'){
		
$rrr  = $_GET['route'];
 
 //creating a query
 $stmt = $conn->prepare("SELECT rbusNo, route, busid, seats, driverid, time, date FROM tbl_bussend where route =".$rrr);
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($rbusNo, $route, $busid, $seats, $driverid, $tim, $dat);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['rbusNo'] = $rbusNo;
 $temp['route'] = $route;  
 $temp['busid'] = $busid; 
 $temp['seats'] = $seats; 
 $temp['driverid'] = $driverid;
 $temp['tim'] = $tim;
 $temp['dat'] = $dat;   
 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);
}



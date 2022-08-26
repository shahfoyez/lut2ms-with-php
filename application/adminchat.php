<?php   

include "../config/config.php"; 
  $response = array();  
  if(isset($_GET['apicall'])){  
  switch($_GET['apicall']){  
  case 'get':  
    if(isTheseParametersAvailable(array('sid'))){  
    $sid = $_POST['sid'];   
   //$sid = "1812020128";
     $stmt = $conn->prepare("SELECT chat, created_at, status, images FROM tbl_adminchat where studentid =".$sid." ORDER BY created_at ASC");
     $stmt->execute();
     $stmt->bind_result($chat, $created_at, $status, $image);
     $products = array(); 
     while($stmt->fetch()){
		 $temp = array();
		 $temp['chat'] = $chat; 
		 $temp['created_at'] = $created_at; 
		 $temp['image'] = $image; 
		 if($status==0){
			$temp['status'] = false; 
		 }
		 else{
			$temp['status'] = true; 
		 }
		 array_push($products, $temp);
		 }
	echo json_encode($products);
   
}  
else{  
   $response['error'] = true;   
   $response['message'] = 'required parameters are not available';   
}  
break;   
case 'send':  
 if(isTheseParametersAvailable(array('sid', 'message','dtime','image'))){  
    $sid = $_POST['sid'];  
    $message = $_POST['message'];   
    $dtime =   $_POST['dtime'];
   $image =   $_POST['image'];
   
   
   //$sid = "1812020128";  
   // $message = "ABC";   
   // $dtime = "2022-07-04 12:12:39.000000";
   //$image =   "/ss";
 
    
    if(!($image=="null")){
		$stmt = $conn->prepare("INSERT INTO tbl_adminchat (studentid,chat,created_at,images) VALUES (?, ?, ?, ?)");  
		$stmt->bind_param("isss", $sid, $message, $dtime, $image);    
	}else{
		$stmt = $conn->prepare("INSERT INTO tbl_adminchat (studentid,chat,created_at) VALUES (?, ?, ?)");  
		$stmt->bind_param("iss", $sid, $message, $dtime);  
	}
    
    $stmt->execute();  
    $stmt->store_result();  
    if($stmt->num_rows > 0){  
    $response['error'] = false;   
    $response['message'] = 'successfull';   
echo json_encode($response);  
 }  
else{  
   $response['error'] = true;   
	$response['message'] = $stmt;
echo json_encode($response);  
 }  
}  
break;   
default:   
 $response['error'] = true;   
 $response['message'] = 'Invalid Operation Called';  
}  
}  
else{  
 $response['error'] = true;   
 $response['message'] = 'Invalid API Call';  
}    
echo json_encode($response);  
function isTheseParametersAvailable($params){  
foreach($params as $param){  
 if(!isset($_POST[$param])){  
     return false;   
  }  
}  
return true;   
}  
 

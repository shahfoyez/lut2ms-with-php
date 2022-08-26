<?php   
 include "../config/config.php"; 
  $response = array();  
  if(isset($_GET['apicall'])){  
  switch($_GET['apicall']){  
  case 'signup':  
    if(isTheseParametersAvailable(array('sid','name','email','pass','phone','section','dob','dept', 'batch'))){  
    $name = $_POST['name'];   
    $email = $_POST['email'];   
    $pass = $_POST['pass'];  
    $sid = $_POST['sid'];   
    $phone = $_POST['phone'];   
    $section = $_POST['section'];   
    $dob = $_POST['dob'];   
    $dept = $_POST['dept'];   
    $batch = $_POST['batch'];   
   
    $stmt = $conn->prepare("SELECT studentID FROM tbl_student WHERE studentID = ?");  
    $stmt->bind_param("i", $sid);  
    $stmt->execute();  
    $stmt->store_result();  
   
    if($stmt->num_rows > 0){  
        $response['error'] = true;  
        $response['message'] = 'User already registered';  
        $stmt->close();  
    }  
    else{  
        $stmt = $conn->prepare("INSERT INTO tbl_student (studentName, email, pass, studentID, phone, section, dob, dept, batch) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");  
        $stmt->bind_param("sssisssss", $name, $email, $pass, $sid, $phone, $section, $dob, $dept, $batch);  
   
        if($stmt->execute()){  
            $stmt = $conn->prepare("SELECT studentName, email, pass, studentID, phone, section, dob, dept, route, batch FROM tbl_student WHERE studentID = ?");   
            $stmt->bind_param("i",$sid);  
            $stmt->execute();  
            $stmt->bind_result($name, $email, $pass, $sid, $phone, $section, $dob, $dept, $route, $batch);  
            $stmt->fetch();  
   
            $user = array(  
            'sid'=>$sid,
            'name'=>$name,   
            'email'=>$email, 
            'phone'=>$phone,  
            'section'=>$section,  
            'dob'=>$dob,  
            'dept'=>$dept,  
            'route'=>$route,  
            'batch'=>$batch,   
            'pass'=>$pass  
            );  
   
            $stmt->close();  
   
            $response['error'] = false;   
            $response['message'] = 'User registered successfully';   
            $response['user'] = $user;   
        }  
    }  
   
}  
else{  
    $response['error'] = true;   
    $response['message'] = 'required parameters are not available';   
}  
break;   
case 'login':  
  if(isTheseParametersAvailable(array('sid', 'pass'))){  
    $sid = $_POST['sid'];  
    $pass = $_POST['pass'];   
   
    $stmt = $conn->prepare("SELECT studentName, email, pass, studentID, phone, section, dob, dept, route, batch FROM tbl_student WHERE studentID = ? AND pass = ?");  
    $stmt->bind_param("is",$sid, $pass);  
    $stmt->execute();  
    $stmt->store_result();  
    if($stmt->num_rows > 0){  
    $stmt->bind_result($name, $email, $pass, $sid, $phone, $section, $dob, $dept, $route, $batch);  
    $stmt->fetch();  
    $user = array(  
    'sid'=>$sid,   
    'name'=>$name,   
    'email'=>$email,  
    'phone'=>$phone,  
    'section'=>$section,  
    'dob'=>$dob,  
    'dept'=>$dept,  
    'route'=>$route,  
    'batch'=>$batch,   
    'pass'=>$pass  
    );  
   
    $response['error'] = false;   
    $response['message'] = 'Login successfull';   
    $response['user'] = $user;   
 }  
 else{  
    $response['error'] = false;   
    $response['message'] = 'Invalid username or password';  
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
 

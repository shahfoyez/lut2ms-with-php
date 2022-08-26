<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Driver.php';
?>
<?php
    $driver=new Driver();
    $format=new Format();
    $userid=Session::get('id');
    $role=Session::get('role');
    if($role!='StudentAdmin' && ($role!='Admin' && $userid!='1001')){ 
          echo "<script>window.location='dashboard.php';</script>";   
    }
?>
<?php
    if(!isset($_GET['editid']) || $_GET['editid']==NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='driverlist.php'</script>";
    }else{
        $editid= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['editid']);
    }
    //  if($_SERVER['REQUEST_METHOD']=='POST'){
    //     $driverEdit=$driver->adminChat($_POST, $_FILES, $editid);
    // }
?>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $conn = mysqli_connect("localhost", 
      "root", "", "LUT2MS");
        $text=$_POST["text"];
			if($text==""){
      }
			else{
				$query="INSERT into tbl_adminchat(chat,studentID,status,created_at) 
						values('$text', '$editid','1',current_timestamp())";
				$addMessage = mysqli_query($conn, $query);;
				if($addMessage){
					return "<span class='success'>Message Added Successfully.</span>";

				}
				else {
					return "<span class='error'>Message Not Added!</span>";
				}
			}
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chat Section</h2>
        <div class="block">
        <?php
            if(isset($messageAdd)){
                echo  $messageAdd;
            }
        ?>     
        <div >
         <div>
              <ul id="message" style="padding: 0% 20% 0% 10%; min-height: 100px; overflow: hidden;">
                <?php
                    $getDriverData=$driver->getAllchat($editid);
                    if($getDriverData){
                        while($value=$getDriverData->fetch_assoc()){
                 ?> 
<div class="time"><p><?php //echo $format->formatDates($value['created_at']);?></p></div>
        
        <?php if($value['status']==0){?>
        <div class="matt-line"><p><?php echo $value['chat'];?></p></div>
        
        <?php }else{ ?>
        <li class="first"><?php echo $value['chat'];}?></li>
        

                <?php }} ?> 
      </ul>
         </div>
      <div>
    <form action="" method="POST" style="padding: 2% 0% 10% 10%;"> 
      <input type="text" name='text' placeholder="Type something">
      <input id="button" class='btn' type="submit" name="submit" Value="SEND" />
    </form>
         </div>
         </div>
         </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });

</script>
<?php include 'inc/footer.php';?>
<style>
.time{
  text-align: center;
  min-height: 0%;
  color: #666;
  letter-spacing: 1.2px;
  word-spacing: 2px;
} 
.matt-line{
  max-width: 50%;
  min-height: 0%;
  min-width: 0%;
  display: inline-block;
  position: relative;
  margin: 0% 0 3% 0;
  animation: scaler 150ms ease-out;
}

.matt-line p:after {
  content: "";
  display: block;
  position: absolute;
  left: -10px;
  top: 0;
  width: 0;
  border-width: 10px 10px 0;
  border-style: solid;
  border-color: #444 transparent;
}

.matt-line p{
  background-color: #444;
  color: #fff;
  padding: 10px;
  border-radius: 10px;
  word-wrap: break-word;
  font-weight: 500;
}


#message li{
  background-color: #e5eaec;
  color: #222;
  font-size: .85em;
  border-radius: 10px;
  position: relative;
  padding: 10px;
  margin: 10px;
  max-width: 70%;
  min-width: 10%;  
  float: right;
  word-wrap: break-word;
  clear: both;
  animation: scaler 150ms ease-out;
  font-weight: 500;
}

#message .first:after{
  content: "";
  display: block;
  position: absolute;
  right: -10px;
  top: 0;
  width: 0;
  border-width: 10px 10px 0;
  border-style: solid;
  border-color: #e5eaec transparent;
}

input{
  width: 62%;
  font-size: 1.2em;
  box-sizing: border-box;
  padding: 12px 20px;
  margin: 8px 0;
}

input:focus, button:focus{
  outline: 0;
}

#button{
  background-color: #222;
  color: #fff;
  padding: 10px 10px 10px 10px;
  width: 20%;
  height: 100%;
  border: none;
  cursor: pointer;
  letter-spacing: 1.2px;
}
.scroll{
  position: absolute;
  bottom: 0;
}




@keyframes scaler{
  0%{transform: scale(0)}
  100%{transform: scale(1)}
}
</style>




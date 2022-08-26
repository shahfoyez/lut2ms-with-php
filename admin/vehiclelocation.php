<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<script type="text/JavaScript">
function timedRefresh(timeoutPeriod) {
setTimeout("location.reload(true);",timeoutPeriod);
}
</script>
<?php
    $bus=new Bus();
    $userid=Session::get('id');
    $role=Session::get('role');
     
?>
<?php
	if(isset($_GET['busid']) && $_GET['busid']!=NULL && ($role=='BusAdmin' || $userid=='1001')){
		$delid=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['busid']);//filtering
		 $delbus=$bus->delBusbyId($delid);	 
	}
?>
<?php
  $bus=new Bus();
  date_default_timezone_set("Asia/Dhaka");
  $time=date("H:i:s");
  $date=date("Y/m/d");
  $availUpdate=$bus->updateAvailableBus($time,$date);
?>
<style>
   .btn:hover{
        background-color: #1acc1a;
    }
    span .btn:hover{
        background-color: #ff462e;
    }
    .odd,.gradeX td{
    	text-align: center;
    }
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Bus List</h2>
                <?php
                	if(isset($delbus)){
                		echo $delbus;
                	}
                ?>
							
							
				<a class='btn' style="margin-top: 5px;"href="busedit.php?busid=>">View All Location</a>

			
				<body onload="JavaScript:timedRefresh(10000);">
                <div class="block">     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width='2%'>SL</th>
							<th width='5%'>Bus ID</th>
							<th width='8%'>Longitude</th>
							<th width='8%'>Latitude</th>
							<th width='2%'>Route</th>
							<th width='8%'>Date</th>
							<th width='8%'>Time</th>
							<th width='2%'>Availablity</th>
							<th id="demo" width='15%'>Action</th>
						</tr>
					</thead>
					<tbody>
					<script>
						setInterval(displayHello, 1000);
						$bus=new Bus();
						function displayHello() {
							$getBus =  $bus->vechileLocationList();
							document.getElementById("demo").innerHTML += "Hello";
						}
					</script>
					<?php 
						$i=0;
					 
						$getBus =  $bus->vechileLocationList();
						if($getBus){
							while($result=$getBus->fetch_assoc()){	
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['id'];?></td>
							<td><?php echo $result['longitude'];?></td>
							<td><?php echo $result['latitude'];?></td>
							<td><?php echo $result['route'];?></td>
							<td><?php echo $result['date'];?></td>
							<td><?php echo $result['time'];?></td>
							<td><?php echo $result['avail'];?></td>
						<?php
                        if($role=='BusAdmin' || $userid=='1001'){?>
							<td>
								<a class='btn' href="busedit.php?busid=<?php echo $result['id'];?>">View Location</a>
							</td>
						<?php }else{ ?>
						   <td style="text-align:center;">
						       <a class='btn' style="background-color: #ef4545">Resticted</a>
						   </td>
						<?php }?>
						</tr>
					<?php } }
					else{
						echo "<span class='error'>Buses info Not Found<span>";
					}?>

					</tbody>

				</table>
				 
               </div>
				<!-- </body> -->
               
            </div>
              
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>


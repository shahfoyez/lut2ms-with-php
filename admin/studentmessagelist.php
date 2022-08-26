<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $format=new Format();
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
                <div class="block">     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width='2%'>SL</th>
							<th width='5%'>id</th>
							<th width='14%'>Student ID</th>
							<th width='40%'>Number Plate</th>
							<th width='20%'>Date Time</th>
							<th width='15%'>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=0;
						$getBus=$bus->singleMessageList();
						if($getBus){
							while($result=$getBus->fetch_assoc()){	
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['id'];?></td>
							<td><?php echo $result['studentID'];?></td>
							<td><?php echo $result['chat'];?></td>
							<td><?php echo $format->formatDate($result['created_at']);?></td>
						<?php
                        if($role=='BusAdmin' || $userid=='1001'){?>
							<td>
								<a style="width: 45px; text-align:center;" class='btn' href="studentmessage.php?editid=<?php echo $result['studentID'];?>">View</a> 
                               
								<span><a class='btn' onclick="return confirm('Are you sure to confirm?')" href="?busid=<?php echo $result['busid'];?>">Delete</a></span>
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


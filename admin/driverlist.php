<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $driver=new Driver();
    $format=new Format();
    $userid=Session::get('id');
    $role=Session::get('role');
?>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['filter'])){
            $filter='1';
        }
		// if(isset($_POST['aplyfilter'])){
             
        //     $allStudentListFilter=$student->allStudentListFilter($_POST);
        //     if($allStudentListFilter=='5'){
        //         $filList='0';
        //         $filter='1';//prevent redirrect to allstudents.php for empty input.
        //     }else{
        //         $filList='1';
        //     }
        // }else
		if(isset($_POST['all'])){
             echo "<script>window.location='driverlist.php'</script>";
        }
    }
?>
<?php
    if(isset($_GET['delid']) && $_GET['delid']!=NULL ){
    //filtering
    $delid=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delid']); 
     
     $delDriver=$driver->delFromAllDriById($delid); 
  }
?>
<style>
    .btn{margin-top: 6px; font-size:16px; font-color: white;}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>All Drivers</h2>
    <?php
        //if(!isset($filter)){
    ?>
        <!-- <form action="" method="post">
            <input class='btn' type="submit" name="filter" Value="Filter Students"/>
        </form> -->
        <div class="block">
            <!--delete message-->
            <?php 
                if(isset($delDriver) && !isset($_POST['filter'])){
                  echo $delDriver;
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data"> 
            <?php
                if(!isset($filter) || (isset($filList) && $filList=='1')){
            ?>
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width='1%'>SL</th>
                            <th width='2%'>DriverID</th>
                            <th width='13%'>Driver Name</th>
                            <th width='14%'>Liesence</th>
                            <th width='8%'>Phone</th>
                            <th width='8%'>DOB</th>
                            <th width='4%'>Age</th>
                            <th width='4%'>Img</th>
                            <th width='10%'>Current Address</th>
                           <th width='16%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            if(!isset($filList)){
                                $alDriver=$driver->driverList();
                            }elseif(isset($filList) && $filList =='1'){
                                $alDriver= $allDriverListFilter;
                            }
                            if($alDriver){
                                    while($result=$alDriver->fetch_assoc()){
                                        $i++;     
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i;?></td>
                            <td style='text-align: center;'><?php echo $result['id'];?></td>
                            <td><?php echo $format->textShorten($result['driverName'], '15');?></td>
                            <td><?php echo $result['liesence'];?></td>
                            <td><?php echo $result['phone'];?></td>
                            <td><?php echo $result['dob'];?></td>
                            <td style='text-align: center;'><?php echo $result['age'];?></td>
                            <td ><img style="height: 40px; width: 55px;" src="<?php echo $result['img'];?>"/></td>
                            <td><?php echo $format->textShorten($result['current_address'], '15');?></td>
                        <?php
                            if($role=='StudentAdmin' || $role=='Admin' || $userid=='1001'){?>
                            <td>
                                <a style="width: 45px; text-align:center;" class='btn' href="driveredit.php?editid=<?php echo $result['id'];?>">Edit</a> 
                                <a style="width: 45px; text-align:center;" class='btn' onclick="return confirm('Are you sure?')" href="?delid=<?php echo $result['id'];?>">Delete</a>
                            </td>
                        <?php }else{ ?>
                           <td style="text-align:center;">
                               <a class='btn' style="background-color: #ef4545">Resticted</a>
                           </td>
                        <?php }?>
                        </tr>
                    <?php } }?>
                    </tbody>
                </table>
            <?php } elseif((isset($filter) && $filter=='1') || (isset($filList) && $filList=='0')){ ?>
            <!--consider this div='block copyblock' bellow the class='block' div-->
            <div class="block copyblock">
            <!--pressed filter but empty-->
            <?php
              if(isset($filList) && $filList=='0'){
                echo "<span class='error'>Can not filter Data!</span>";
              }
            ?> 
                <table class="form">   
                    <tr>
                        <tr>            
                        <td>
                            <label>Student Name</label>
                        </td>
                        <td><input type='text' name="name" placeholder="Student Name"></td>
                    </tr>
                    <tr>           
                        <td>
                            <label>Student ID</label>
                        </td>
                        <td><input type='text' name="id" placeholder="Student ID"></td>
                    </tr>
                    <tr>
                        <td>
                            <label>Depertment</label>
                        </td>
                        <td>
                            <select id="select" name="dept">
                                <option value="">Depertment</option>
                                <option value="English">English</option>
                                <option value="IS">Islamic Studies</option>
                                <option value="CSE">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="BBA">BBA</option>
                                <option value="ARC">Architecture</option>
                                <option value="Civil">Civil Engineering</option>
                                <option value="Bangla">Bangla</option>
                                <option value="Others">Others</option>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Semester</label>
                        </td>
                        <td>
                        <select id="select" name="semester">
                            <option value="">Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                    </tr>           

                    <tr>
                        <td>
                            <label>Section</label>
                        </td>
                        <td><select id="select" name="section">
                            <option value="">Section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                        </select></td>
                    </tr>  
                    <tr>            
                        <td>
                            <label>Hometown</label>
                        </td>
                        <td><input type='text' name="hometown" placeholder="Hometown"></td>
                    </tr>
                    <tr>              
                        <td>
                            <label>Current Address</label>
                        </td>
                        <td><input type='text' name="cur_add" placeholder="Current Address"></td>
                    </tr>
                   
                    <tr>
                        <td></td>
                        <td>
                            <input class='btn' type="submit" name="aplyfilter" Value="Apply Filter" />
                            <input class='btn' type="submit" name="all" Value="Cancel" />
                        </td>
                    </tr>
                </table>
            </div>
            <?php } ?>
            </form>
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



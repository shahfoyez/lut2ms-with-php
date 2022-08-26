<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Driver.php';
?>
<?php
    $driver=new Driver();
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
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $driverEdit=$driver->driverEdit($_POST, $_FILES, $editid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Driver Info</h2>
        <div class="block"> 
        <div class="block copyblock"> 
        <?php
            if(isset($driverEdit)){
                echo  $driverEdit;
            }
        ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php
                    $getDriverData=$driver->getAllDriverById($editid);
                    if($getDriverData){
                        while($value=$getDriverData->fetch_assoc()){
                 ?> 
                <tr>
                    <td>
                        <label>Driver ID</label>
                    </td>
                    <td>
                        <input style="background-color: #bbc4ca7a;" readonly="readonly" type="text" name='driverid'class='medium' value="<?php echo $value['id']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Driver Name</label>
                    </td>
                    <td>
                        <input type="text" name='driverName' class='medium' value="<?php echo $value['driverName']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Liesence</label>
                    </td>
                    <td>
                        <input type="text" name='liesence' class='medium' value="<?php echo $value['liesence']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" name='phone' class='medium' value="<?php echo $value['phone']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>DOB</label>
                    </td>
                    <td>
                        <input type="date" name='dob' class='medium' value="<?php echo $value['dob']?>"/>
                    </td>
                </tr>
     
                <tr>
                    <td>
                        <label>Age</label>
                    </td>
                    <td>
                        <input type="number" name='age' class='medium' value="<?php echo $value['age']?>"/>
                    </td>
                </tr>
     
                 <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                         <img src="<?php echo $value['img'];?>" style="height:35px; width: 50px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input name='image' class='medium' type="file" />
                    </td>
                </tr>>
                </tr>
                <tr>
                    <td>
                        <label>Current Address</label>
                    </td>
                    <td>
                        <input type="text" name='curaddress' class='medium' value="<?php echo $value['current_address']?>"/>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input class='btn' type="submit" name="submit" class='medium' Value="Update" />
                    </td>
                </tr>
                <?php }} ?> 
            </table>
            </form>
         </div>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>



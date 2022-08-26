<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
     
?>
<?php
    $driver=new Driver();
?>
<?php
    $admin=new Admin();
    $userid=Session::get('id');
    $role=Session::get('role');
    if($role!='Admin' && $userid!='1001'){ 
          echo "<script>window.location='dashboard.php';</script>";   
    }
?>
<?php
    //if(isset($_POST['submit'])){}
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $addDriver=$driver->driverAdd($_POST,$_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Driver</h2>
        <div class="block"> 
        <div class="block copyblock"> 
        <?php
            if(isset($addDriver)){
                echo  $addDriver;
            }
        ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <tr>
                    <td>
                        <label>Driver ID:</label>
                    </td>
                   <td> <input type="text" name="driverid" placeholder="Driver ID" class='medium'/> </td>
                </tr>
                <tr>
                    <td>
                        <label>Driver Name:</label>
                    </td>
                    <td>
                        <input type="text" name="driverName" placeholder="Driver Name" class='medium'/> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Liesence:</label>
                    </td>
                    <td>
                        <input type="text" name="liesence" placeholder="Liesence" class='medium'/> 
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Age:</label>
                    </td>
                   <td> <input type="text" name="age" placeholder="Age" class='medium'/> </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Phone:</label>
                    </td>
                   <td><input type="text" name="phone" placeholder="Phone" class='medium'/>  </td>
                </tr>
				<tr>
                    <td>
                        <label>DOB:</label>
                    </td>
                    <td><input type="date" name="dob" placeholder="DOB" class='medium'/> </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image:</label>
                    </td>
                    <td>
                        <input name='image' type="file" class='medium'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Current Address:</label>
                    </td>
                    <td>
                       <input type="text" name="curaddress" placeholder="Current Address" class='medium'/> 
                   </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input class='btn' type="submit" name="submit" Value="Add Driver" class='medium'/>
                    </td>
                </tr>
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

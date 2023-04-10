<?php
 
  include ("../inc/dbConnect.php");
  include ("../inc/commonfunction.php");

?>
<script>
function winprint(){
	window.print();
	window.history.back();
	window.close();
}
window.onload = function() { window.print(); }
</script> 
<style type="text/css">

.style10{ border-top: solid 1px; border-top-color:#999;}
.style1{font-weight:bold; text-align:right;font-family: Arial;font-size: 12px; color:#666;}
.style2{font-weight:normal;font-family: Arial;font-size: 12px; color:#666;}
.style3{color:#F00;}
.style4{font-weight:normal;font-family: Arial;font-size: 10px; color:#666;}
.style5 {
font-family: Arial;
font-weight: bold;
font-size: 14px;
 color:#666;
}
.style11{ border-bottom: solid 1px; border-bottom-color:#999;}

.style6 {
font-family: Arial;
font-weight: bold;
font-size: 18px;
 color:#666;
}
.style7{font-weight:bold; text-align:left;font-family: Arial;font-size: 12px; color:#666;}

.style23 {font-family: Arial; font-size:12px; color:#666;}


.style44 {
font-family: Arial;
font-weight: bold;
font-size: 14px;
color:#333;
}
</style>

<?php  
?>

<table width="850px" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td height="24" colspan="5" align="center" class="style6"><?php echo "Royal Furniture"; ?></td></tr>
    <tr><td height="27" colspan="5" align="center" class="style2"><?php echo "Attendance List"; ?></td></tr>
    <tr>
        <td height="27" width="283px" align="center">
            Form Date :- <?php if($_GET['from_date']==""){echo "All"; }else{ echo $_GET['from_date'];} ?> 
        </td>
        <td height="27" width="283px" align="center">
            To Date :- <?php if($_GET['to_date']==""){echo "All"; } else{ echo $_GET['to_date'];} ?>  
        </td>
        <td height="27" width="284px" align="center">
            Staff Name:- <?php if($_GET['staffcreation_id']==""){echo "All"; } else{ echo get_staff_name($_GET['staffcreation_id']);} ?>  
        </td>
    </tr>
    <tr><td colspan="5">
        <table border="1" width="100%"  align="center" cellpadding="0" cellspacing="0" >
            <thead>
                <tr>
                    <th width="25px" height="34" align="center"  >S.No</th>
                    <th width="180px" align="center">Staff Name</th>
                    <th width="100px" align="center">Attendance Type</th>
                    <th width="100px" align="center">Entry Date</th>
                    <th width="80px" align="center">Entry Time</th>
                    <th width="100px" align="center">Attendance Image</th>
                    <!-- <th width="50" align="center">Location</th> -->
                    <th width="265px" align="center">Description</th>
                </tr>
            </thead>
    <?php 
        $roll_id=1;
        $query="";
        if($_GET['from_date']=="" && $_GET['to_date']=="" && $_GET['staffcreation_id']=="" ) {
            $query = "AND entry_date='".$cr_dt."'";
        } else if($_GET['from_date']!="" && $_GET['to_date']!="" && $_GET['staffcreation_id']==""  ){
            $query = "AND entry_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'  ";
        } else{
            $query = "AND entry_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."' AND staffcreation_id='".$_GET['staffcreation_id']."' ";
        }
        $select_attendance = $pdo_conn->prepare("SELECT * FROM attendance_entry  WHERE delete_status ='0' $query ORDER BY attendance_entry_id DESC");
        $select_attendance->execute();
        $result = $select_attendance->fetchAll();
        $roll_id=1;
    ?>
    <tbody>                     
    <?php 
    foreach($result as $value){ 
        $staff_longitude=$value['staff_longitude'];
        $staff_latitude=$value['staff_latitude'];
    ?>
        <tr>
            <td><?php echo $roll_id;?></td>
    <?php
        $select_staff_name=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id='".$value['staffcreation_id']."' ");
        $select_staff_name->execute();
        $staff_name = $select_staff_name->fetchAll();
    ?>         
            <td><?php echo $staff_name[0]['staff_name'];?></td>
            <td><?php echo $value['attendance_type'];?></td>
            <td><?php echo date("d-m-Y",strtotime($value['entry_date']));?></td>
            <td><?php echo $value['entry_time'];?></td>
            <td><?php if($value['attendance_images']!='') { ?>
                    <a href="javascript:pdf_view('<?php echo $image_path."attendance_images/".$value[attendance_images]; ?>');" title="View Material" ><img  src="<?php echo $image_path."attendance_images/".$value['attendance_images']; ?>" style="height:60px; width:60px;"></a>
                <?php } else {  ?>
                    <img  src="../images/images.jpg"  style="height:60px; width:60px;"  > 
                <?php } ?>
            </td>
            <!-- <td><?php if(($staff_longitude!='')&&($staff_latitude!='')) {?>
                <div align="center">
                  <a onclick="print_google_map('attendanceentry/map.php?staff_latitude=<?php echo $staff_latitude; ?>&staff_longitude=<?php echo $staff_longitude; ?>');" target="new"><img src="images/map.png" height="30" width="30"></a>
                </div><?php }?>
            </td> -->
            <td><?php echo $value['attendance_desc'];?></td>
        </tr>
    <?php 
        $roll_id++;
        } ?>
        </tbody>
    </td></tr>
</table>
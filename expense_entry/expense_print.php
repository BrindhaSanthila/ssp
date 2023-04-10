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
    <tr><td height="27" colspan="5" align="center" class="style2"><?php echo "Expense List"; ?></td></tr>
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
                    <th width="25px" height="34" align="center">S.No</th>
                    <th width="160px" align="center">Staff Name</th>
                    <th width="120px" align="center">Expense Type</th>
                    <th width="100px" align="center">Entry Date</th>
                    <th width="80px" align="center">Expense Amount</th>
                    <th width="80px" align="center">Starting Kilometre</th>
                    <th width="80px" align="center">Ending Kilometre</th>
                    <th width="80px" align="center">Total Kilometre</th>
                    <th width="60px" align="center">Image 1</th>
                    <th width="60px" align="center">Image 2</th>
                    <!-- <th>Starting Location</th>
                    <th>Ending Location</th> -->
                </tr>
            </thead>
    <?php 
        $roll_id=1;
        $query="";
        if($_GET['from_date']=="" && $_GET['to_date']=="" && $_GET['staffcreation_id']=="") {
            $query = "AND expense_date='".$cr_dt."'";
        } else if($_GET['from_date']!="" && $_GET['to_date']!="" && $_GET['staffcreation_id']=="") {
            $query = "AND expense_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'  ";
        } else{
            $query = "AND expense_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."' AND staff_name='".$_GET['staffcreation_id']."' ";
        }
        $select_attendance = $pdo_conn->prepare("SELECT * FROM expense_entry  WHERE delete_status ='0' $query ORDER BY expense_entry_id DESC");
        $select_attendance->execute();
        $result = $select_attendance->fetchAll();
        $roll_id=1;
        $total_km=0;
        $total_amount=0;
    ?>
    <tbody>                     
    <?php 
    foreach($result as $value){ 
        $s_longitude=$value['s_longitudes'];
        $s_latitude=$value['s_latitudes'];
        $e_longitude=$value['e_longitudes'];
        $e_latitude=$value['e_latitudes'];
    ?>
        <tr>
            <td><?php echo $roll_id;?></td> 
            <td><?php echo get_staff_name($value['staff_name']);?></td>
            <td><?php echo get_expense_type($value['expense_type']);?></td>
            <td><?php echo date("d-m-Y",strtotime($value['expense_date']));?></td>
            <td><?php echo number_format($value['expense_amount'],2); ?></td>
            <td><?php echo $value['s_kilo_meter']; ?></td>
            <td><?php echo $value['e_kilo_meter']; ?></td>
            <td><?php echo $value['t_kilo_meter']; ?></td>
            <td><a href="javascript:pdf_view('<?php echo $image_path."expense_images/".$value[expense_image]; ?>');" title="View Material" ><img <?php if($value['expense_image']!='') { ?> src="<?php echo $image_path."expense_images/".$value['expense_image']; ?>" <?php } else { ?>  src="../images/images.jpg"  <?php }  ?> style="height:60px; width:60px;"  ></a></td>
            <td><?php  if($value['expense_image1']!='') {?><a href="javascript:pdf_view('<?php echo $image_path."expense_images/".$value[expense_image1]; ?>');" title="View Material" ><img  src="<?php echo $image_path."expense_images/".$value['expense_image1']; ?>" style="height:60px; width:60px;"  ></a><?php } else {  ?><img  src="../images/images.jpg"  style="height:60px; width:60px;"  > <?php } ?></td>
            <!-- <td><?php if(($s_longitude!='')&&($s_latitude!='')) {?>
                <div align="center">
                  <a onclick="print_google_map('expense_entry/map.php?latitude=<?php echo $s_latitude; ?>&longitude=<?php echo $s_longitude; ?>');" target="new">
                  <img src="images/map.png" height="30" width="30">
                  </a>
                </div>
            <?php }?>
            </td>
              <td><?php if(($e_longitude!='')&&($e_latitude!='')) {?>
                  <div align="center">
                  <a onclick="print_google_map('expense_entry/map.php?latitude=<?php echo $e_latitude; ?>&longitude=<?php echo $e_longitude; ?>');" target="new">
                  <img src="images/map.png" height="30" width="30">
                  </a></div><?php }?>
              </td> -->
        </tr>
    <?php 
    $roll_id++;
    $total_km+= $value['t_kilo_meter'];
    $total_amount+=$value['expense_amount'];  
    }  ?>
    </tbody>
    </table>
    </td></tr>
    <tr>
        <!-- <td height="27" colspan="3" align="right" class="style2"></td> -->
        <td height="27" colspan="5" align="right" class="style6"><label>Total kilometer : <?php  echo $total_km; ?></label></td>
    </tr>
    <tr>
        <!-- <td height="27" colspan="3" align="right" class="style2"></td> -->
        <td height="27" colspan="5" align="right" class="style6"><label>Total Amount : <?php  echo $total_amount; ?></label></td>
    </tr>
</table>    
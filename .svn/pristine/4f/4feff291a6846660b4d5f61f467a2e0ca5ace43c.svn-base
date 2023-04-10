<?php
 
  include ('../inc/dbConnect.php');
  include ('../inc/commonfunction.php');

?>
<?PHP 
$cr_dt=date("Y-m-d");
$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
$customer_id=$_GET["customer_id"];
///echo $value["Customer_name"];
$staffcreation_id=$_GET["staffcreation_id"];
//$cr_dt=date("Y-m-d");

$cr_dt=date("Y-m-d");

if($_GET['from_date']=="" && $_GET['to_date']=="" ){
    $query = "  date='".$cr_dt."'";
}
else{
$query = "  date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
}
if($_GET['customer_id']!='')
{
    $query.=" customer_id='".$_GET['customer_id']."'";
}
if($_GET['staffcreation_id']!='')
{
    $query.=" and usercreation_id='".$_GET['staffcreation_id']."'";
} 
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
.style12{font-weight:bold; text-align:center;font-family: Arial;font-size: 12px; color:#666;}
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
    <tr>
        <td height="24" colspan="5" align="center" class="style6"><?php echo "Royal Furniture"; ?></td>
    </tr>
    <tr>
        <td height="27" colspan="5" align="center" class="style6"><?php echo " Quotation Approval List"; ?></td>
    </tr>
   
      </table>
      <table width="850px" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        <td    ><?php echo "From_date :".date("d-m-Y",strtotime($_GET['from_date'])) ?></td> 
            <td     ><?php echo "To_date :".date("d-m-Y",strtotime($_GET['to_date'])) ?></td>
    
    </tr>

     <tr>
        <td  ><?php if($_GET["customer_id"]==""){echo "Customer_name : All" ;} else{echo "Customer_name :". get_customer_name($_GET["customer_id"]);}?></td>
    
        <td><?php if($_GET["staffcreation_id"]==""){echo "Executive_name: All"; }else{echo "Executive_name:".get_staff_name($_GET["staffcreation_id"]);}?></td>
   
      
    </tr>
    </table>
    
    <tr>
        <td>
            <table border="1" width="850px"  align="center" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th width="43" height="34" align="center" >S.No</th>
                        <th width="50"  scope="col">  Quotation No</th>
                        <th width="50"  scope="col">  Confirm No</th>
                        <th width="168" align="center"   > Customer Name </th>
                        <th width="168" align="center"   > Executive Name </th>
                         <th width="168" align="center"   > Total Amount </th>

                       <!--  <th width="153" align="right" class="style10 style11 style7 right" scope="col"><div align="right">Paid Amount</div></th>
                        <th width="144" align="right" class="style10 style11 style7 right" scope="col"><div align="right">Pending Amount</div></th> -->
                    </tr>
                </thead>
				<?php 
						$pdo_enquiry = $pdo_conn->prepare("SELECT * FROM quotation where confirm_status='Approved' and  $query  group by enquiry_id   ORDER BY quotation_id DESC");
                        $pdo_enquiry->execute();
                        $pdoenquiry = $pdo_enquiry->fetchAll();
               
                        foreach($pdoenquiry as $value){
                        $order=$pdo_conn->prepare("SELECT * FROM  order_confirm WHERE quotation_number='$value[quotation_number]' and enquiry_id='$value[enquiry_id]'");
                          $order->execute();
                          $order_no = $order->fetch(); 
                           ?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
							
							<td><?php echo $value['quotation_number'];?></td>
                           <td><?php echo $order_no['confirm_number']; ?></td>
                       
						    <td><?php echo get_customer_name($value['customer_id']);?></td>

							<td><?php echo get_staff_name($value['usercreation_id']);?></td>

							<td><?php echo $value['amount']; ?></td>
						 
					 


							 
						</tr>


<?php $roll_id++; } ?>
                
           
        </td>
    </tr>
</table>
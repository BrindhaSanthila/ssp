<?php 
include('../inc/dbConnect.php');
//include('../inc/commonfunction.php');

?>
<table width="90%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="4%" height="35" align="left" class="">&nbsp;<strong>#</strong></td>

    <td width="36%" class="">&nbsp;<strong>Files</strong></td>
        
    
  </tr>
  <?php
  $sno=1;

    $pdf_view = $pdo_conn->prepare("SELECT * FROM enquiry_pdf  WHERE  quotation_number='".$_POST['quotation_number']."' ");
         $pdf_view->execute();
         $pdfview = $pdf_view->fetchAll();
         
         if(count($pdfview)!=0)
         {
         foreach ($pdfview as  $value) {
          $file_name=$value['quotation_pdf'];
         
  ?>
  <tr >
    <td height="43" class=" ">&nbsp;<?php echo $sno; ?></td>
  
    
    
	 <td class=" "><a href="upload/quotation/<?php echo $file_name; ?>" target="_blank"><img src="images/pdf.png" style="height:60px; width:60px;"></a></td>
 
     
        
  </tr>
  <?php }  } 
  else
  {  	?>
  	 <tr ><td width="36%" >  	 	<?php echo "No files"; ?>  	 	</td>  	 </tr>
  	 <?php }?>
</table>

<script>
function image_list_sales(url)
	{
	onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
	}
	
function pdf_view(url)
	{
	onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
	}
</script>
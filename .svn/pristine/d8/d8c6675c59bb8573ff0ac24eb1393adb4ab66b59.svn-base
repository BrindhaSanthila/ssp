<?php 
include('../inc/dbConnect.php');
//include('../inc/commonfunction.php');

?>
<table width="90%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="4%" height="35" align="left" class="">&nbsp;<strong>#</strong></td>
    <td width="36%" class="">&nbsp;<strong>File Name</strong></td>
    <td width="36%" class="">&nbsp;<strong>Files</strong></td>
    <td width="36%" class="">&nbsp;<strong>Update Image</strong></td>
        
    
  </tr>
  <?php
  $sno=1;


    $pdf_view = $pdo_conn->prepare("SELECT * FROM enquiry_pdf  WHERE  enquiry_id='".$_POST['enquiry_id']."' ");
         $pdf_view->execute();
         $pdfview = $pdf_view->fetchAll();
         
         if(count($pdfview)!=0)
         {
         foreach ($pdfview as  $value) {
          $file_name=$value['pdf'];
           $file_name1=$value['pdf1'];
         
  ?>
  <tr >
    <td height="43" class=" ">&nbsp;<?php echo $sno; ?></td>
    <td height="43" class=" ">&nbsp;<?php echo $file_name; ?></td>
    
    
   <td class=" "><a href="upload/enquiry/<?php echo $file_name; ?>" target="_blank"><img src="images/pdf.png" style="height:60px; width:60px;"></a></td>
   <td class=" "><input type="file" name="image<?php echo $sno ?>" id="image<?php echo $sno ?>"  class="form-control">
     </td>
        
  </tr>
<?php }
if($file_name1!='')
{
?>
    <tr >
    <td height="43" class=" ">&nbsp;<?php echo '2'; ?></td>
    <td height="43" class=" ">&nbsp;<?php echo $file_name1; ?></td>
    <td class=" "><a href="upload/enquiry/<?php echo $file_name1; ?>" target="_blank"><img src="images/pdf.png" style="height:60px; width:60px;"></a></td>
    <td class=" "><input type="file" name="image2" id="image2"  class="form-control">
     </td>
       
  </tr>

  <?php
  }
    if($file_name1=='')
         {
             ?>
             <input type="file" name="image2" id="image2"  class="form-control">
              <input type='hidden' id='check_img' name='check_img' value='1'>
             <?php
         }
           
         } 
  else
  {   ?>
     <tr ><td width="36%" >     <?php echo "No files"; ?>     </td>    </tr>
     <?php }?>
</table>

<script>

/*    $('#image1').change(function() {
       var filename = $('#image1').val().split('\\').pop();
  
        var lastIndex = filename.lastIndexOf("\\");   
    
    });
*/
function image_list_sales(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
  
function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
</script>
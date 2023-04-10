<?php
error_reporting(0);
  ob_start();
session_start();

require("../model/config.inc.php"); 
require("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

$print_password = $_GET['print_password'];
  $acad_yr=$_GET['acad_yr'];
  $standard=$_GET['standard'];
  $section=$_GET['section'];
$student_id=$_GET['student_id'];
$academic_year=$_GET['academic_year'];
$year_values=explode('-',$acad_yr);
$scad_yr=$year_values[0];
$year=$year_values[1];
$from_month=$_GET['from_month'];
$file_url='live_students/student_hall_ticket_print.php';
$exam_type=$_GET['exam_name'];
if($print_password=="")
{
  echo "<script>window.location.href='../include/print_password.php?standard=$standard&acad_yr=$acad_yr&academic_year=$academic_year&section=$section&student_id=$student_id&exam_type=$exam_type&file_url=$file_url'</script>";
}
    
 
$query='';
   if($standard!='')
   {
    $query.= '  and standard_id="'.$standard.'"';
   }
   if($section!='')
   {
     $query.= '  and section_id="'.$section.'"';
   }
   if($student_id!='')
   {
    $query.= '  and student_id="'.$student_id.'"';
   }
   if($acad_yr!='')
   {
     $query.= ' and academic_year_id="'.$acad_yr.'"';
   }
 


function standard($stnd){
  
   $sql_user="select * from  standard_creation where id='$stnd' ";
  $rs_user=mysql_query($sql_user);
  while($rsdata_user=mysql_fetch_object($rs_user))
  { 
  $standard=$rsdata_user->standard;
    
  }
  return $standard;
  
  }
function exam_type($exam_type1)
{
  $exam_get = mysql_fetch_array(mysql_query("select * from  exam where id='$exam_type1' "));
  
  return $exam_get['exam_name'];
}
  function subject($subject)
{
  $exam_get = mysql_fetch_array(mysql_query("select subject from  subject  where subj_id='$subject' "));
  
  return $exam_get['subject'];
}
 
 $exam_type=$_GET['exam_type'];
 $exam_name=exam_type($exam_type);
//echo "SELECT * FROM live_table where    delete_status!='1' $query order by student_id ASC";
    
 $sql = "SELECT * FROM live_table where    delete_status!='1' $query   order by student_id  ASC";
 // $student_details = mysql_fetch_array(mysql_query("select * from   live_table where student_id='18' and academic_year='$_GET[academic_year]'"));

  // print_r($student_details);

 $rows = $db->fetch_all_array($sql);

 foreach($rows as $student_details) 
 {
 $student_id = $student_details['student_id'];
 $student_name = $student_details['student_name'];
 $standard = standard($student_details['standard_id']);

 
      $sec=mysql_fetch_array(mysql_query("select section from section_creation where id='$student_details[section_id]'"));
      $section=$sec['section'];
//echo "select admission_no,student_photo from  student_creation  where student_id=' $student_id' ";
      $admission = mysql_fetch_array(mysql_query("select admission_no,student_photo from  student_creation  where student_id=' $student_id' "));
  
    $admission_no=$admission['admission_no'];
 $student_photo=$student_details['student_photo'];

     $sql = "SELECT * FROM exam_time_table where  exam_name='$exam_type' and standard='$_GET[standard]' and section='$_GET[section]' and delete_status!='1' order by date ASC";
 

 $rows = $db->fetch_all_array($sql);
 $exam_count=count($rows);
 
 ?>
<div class="hole_border">
 

<table style="border-bottom: 1px solid #cccc;">
  
  <tr >
      <td width="20%"></td> 
      <td width="20%"></td>     
      <td> <img src="../image/logonew11.png" style="margin-bottom: -14px;margin-left: -22px;"><P class="logo-tex">KSC PUBLIC SCHOOL</P> </td>
    <td width="20%"></td> 
    <td width="20%"></td> 
  </tr>
  <tr>
      <td width="20%"></td> 
      <td width="20%"></td> 
      <td style="text-align: center;font-weight: 600;font-size: 10px;">Affiliated to CBSE, New Delhi. Affiliation No. 1931087<br>Montessori and CBSE Stream Anthiyur<br>HALL TICKET - MARCH 2020</td>  
     <td width="20%"></td> 
      <td width="20%"></td> 
  </tr>
  
</table>
  
  
  
  <!--<center>
 <label><strong> Affiluated to CBSE, New Delhi. Affiliation No. 1931087 </strong></label>  <br>

 <label>  <strong> Montessori and CBSE Stream  </strong> </label> <label><strong>Anthiyur</strong></label><br>
     <label><strong>HALL TICKRT - MARCH 2020</strong></label> <br>
 </center>
  <hr>---->
<div class="" style="height: 182px;">
<table style="width: 100%;margin-bottom: 18px;" >    
  <tr >
    <td width="60%" class="student-detail">
      <table >
        <tr>

          <td style="height: 33px;"><label>Name : <?php echo  $student_details['student_name']; ?> </label></td>
        </tr >
        <tr>
          <td style="height: 33px;"><label>Grade : <?php echo standard($student_details['standard_id']); ?> </label></td>
          <td style="height: 33px;"><label>Section : <?php echo $section; ?></label></td>
        </tr>
          <tr>
            <td style="height: 33px;"><label>Admission  No : <?php echo $admission_no; ?> </label></td>
          </tr>
          <tr><td style="height: 33px;"><label>Exam  :  <?php echo   $exam_name ?></label></td></tr>
        
      </table>
    </td>
   
  
    <td   >
      <table   >
        <tr>
          <td>
            <?php 
              //$student_photo_split=explode('/', $student_photo);
              
            if($student_photo!='') { 

              ?>
             <img src="../<?php echo $student_photo; ?>" height="100" width="100"  /  style="margin-right: 67px;margin-top: -50px;">
           <?php }  else { ?>
            <img src="../image/student.png" height="100" width="100"   / style="margin-right: 67px;margin-top: -50px;">
          <?php } ?>
           <!-- / <input type="text" name="" class="photo"> -->
          </td>
        </tr>
      </table>
    </td>

  
    <td width="100%" >
      <?php if($exam_count=='4') { ?>
  <table  border="1" style="border-collapse: collapse;margin-left: -61px;border: 1px solid black; " >
     
    <tr  >
      <td style="width: 28%; text-align: center;">Date</td>
      <td style="width: 39%; text-align: center;">Subject</td>
      <td colspan="2" style="width: 20%; text-align: center;">Sign</td>

      

    </tr>
     <?php 
 foreach($rows as $record) 
 {  ?>
    <tr>
    
      <td style="width: 98px;text-align: center;"><?php echo date('d-m-Y',strtotime($record['date'])); ?></td>
      <td style="width: 141px;text-align: center;height: 33px;"><?php echo subject($record['subject']); ?></td>
      <td style="width: 100px;"> </td>

    </tr>
    <?php } ?>
  </table>
<?php } else{ ?>
<table  border="1" style="border-collapse: collapse;margin-left: -61px; border: 1px solid black; " >
     
    <tr  >
      <td style="width: 28%; text-align: center;">Date</td>
      <td style="width: 39%; text-align: center;">Subject</td>
      <td colspan="2" style="width: 20%; text-align: center;">Sign</td>

    </tr>
     <?php 
 foreach($rows as $record) 
 {  ?>
    <tr>
    
      <td style="width: 98px;text-align: center;"><?php echo date('d-m-Y',strtotime($record['date'])); ?></td>
      <td style="width: 200px;text-align: center;height: 30px;"><?php echo subject($record['subject']); ?></td>
      <td> </td>

    </tr>
    <?php } ?>
  </table>
<?php } ?>
  </td>
 </tr>
</table>
</div>
<table width="100%" style="margin-top: 15px;">
<tr style="text-align:center;"> 
      
    <td width="0%"></td>
      <td width="20%">Principal's sign</td>
      <td width="58%">Student's sign </td>
      <td width="55%">Class Teacher's sign</td>
    <td width="20%"></td>
   

    </tr>
 </table>
</div>
<?php } ?>


<style type="text/css">
  
  .photo
  {
    width: 100px;
     height: 120px;
margin-top: -70px;
border: 2px solid black; }

.hole_border
{
  border: 1px solid black;
  margin-bottom: 35px;
  height: 312px;
  margin-top: 25px;
}

.label
{
   margin-left: 90px;
}
.title_font
{
  font-size: 13px;
}
.hall_ticket_font
{
  font-size: 15px;
}
td.student-detail {
    vertical-align: baseline;
}
.logo-tex{
	font-size: 23px;
    margin-top: -20px;
    padding-left: 26px;
    color: #34416a;
    font-weight: 600;
}
</style>
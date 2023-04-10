<header class="main-header">
<!-- Logo -->

<a href="index.php" class="logo"> 
<!-- mini logo for sidebar mini 50x50 pixels --> 
<b class="logo-mini">  <span class="dark-logo"><img src="images/logo-dark.png" alt="logo"></span> </b> 
<!-- logo for regular state and mobile devices --> 
<span class="logo-lg"> <img src="images/user.png" class="rounded-circle" alt="User Image" width="50px" height="50px"> <img src="images/logo-dark-text.png" alt="logo" class="dark-logo"> </span> </a> 
<!-- Header Navbar -->
<nav class="navbar navbar-static-top"> 
  <!-- Sidebar toggle button--> 

  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <i class="fa fa-bars" aria-hidden="true"></i><span class="sr-only">Toggle navigation</span> </a>
  <div class="navbar-custom-menu">

    <ul class="nav navbar-nav">
	<!--<li style="padding-top: 13px;padding-right:10px;"><span class="username"  align="right" ><?php echo $_SESSION['full_name'];?>
	<img src="images/head_logo.png" style="margin-top: -16px;height: 68px;">
	</span></li>-->
     <li>
        <form class="app-search" style="display: none;">
          <input type="text" class="form-control" placeholder="Search &amp; enter">
          <a class="srh-btn"><i class="ti-close"></i></a>
        </form>
      </li>
      
	  <ul class="head_ul">
       			
			<li><a href="index.php" class="link" data-toggle="tooltip" title="" data-original-title="Dashboard" style="padding-right: 32px;"><i class="ion ion-home color_div bg_color1"></i>&nbsp;&nbsp;</a></li>
			 <li> <a href="#" data-toggle="control-sidebar" class="link"title=" " data-original-title="Setting" style="padding-right: 28px;"><i class="fa fa-gear color_div bg_color3"></i></a> </li>
			<li><a href="#" onclick="logout()" class="link" data-toggle="tooltip" title="" data-original-title="Logout" style="padding-right: 28px;">&nbsp;&nbsp;<i class="ion ion-power color_div bg_color2"></i></a></li>
		</ul>	
			
     
    </ul>
  </div>
</nav>

</header>
<aside class="control-sidebar control-sidebar-dark"> 
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>      
    <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cog fa-spin"></i></a></li> 
    
    <?php  if($_SESSION['user_roll'] ==1)
    { ?>
    <li class="nav-item"><a href="#control-sidebar-spinner-tab" data-toggle="tab"><i class="fa fa-spinner"></i></a></li>      
    <?php } ?>
  </ul>
  <!-- Tab panes -->


  <div class="tab-content"> 
    <!-- Home tab content -->
    <div class="tab-pane <?php echo $spinner; ?>" id="control-sidebar-spinner-tab">
      <ul class="control-sidebar-menu">
	
        <li> 
         <a href="index.php?file=userroll/list"> <i class="menu-icon fa fa-user-circle-o bg1 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">User Roll</h4>
           </div>
          </a> 
        </li>
         
        <li> 
         <a href="index.php?file=usercreation/list"> <i class="menu-icon fa fa-user-plus bg2 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">User Creation</h4>
           </div>
          </a> 
        </li>
         
        <li> 
         <a href="index.php?file=userrights/list"> <i class="menu-icon fa fa-users bg3 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">User Rights</h4>
           </div>
          </a> 
        </li>
          
      </ul>
     
    </div>
    <div class="tab-pane" id="control-sidebar-home-tab">
      <ul class="control-sidebar-menu">
    
        <li> 
          <a href="index.php?file=state/list"> <i class="menu-icon fa fa-area-chart bg4 "></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">State Creation </h4>
           </div>
          </a> 
        </li>
        
        <li> 
          <a href="index.php?file=district/list"> <i class="menu-icon fa fa-flag bg5 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">District Creation</h4>
           </div>
          </a> 
        </li>
       
        <li> 
         <a href="index.php?file=city/list"> <i class="menu-icon fa fa-building-o bg6 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">City Creation</h4>
           </div>
          </a> 
        </li>
          <li> 
         <a href="index.php?file=religion/list"> <i class=" menu-icon fa fa-venus-double bg7 "></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Religion</h4>
           </div>
          </a> 
        </li>
         <li> 
         <a href="index.php?file=sms/list"> <i class=" menu-icon fa fa-venus-double bg7 "></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">SMS</h4>
           </div>
          </a> 
        </li>
      </ul> 
       
    </div>
    
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    
    <div class="tab-pane <?php echo $settings; ?>" id="control-sidebar-settings-tab">
      <ul class="control-sidebar-menu">
         
		<li> 
         <a href="index.php?file=expensetype/list"> <i class="menu-icon fa fa-money bg8 "></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Expense</h4>
           </div>
          </a> 
        </li>

		<li> 
         <a href="index.php?file=special_days/list"> <i class="menu-icon fa fa-stack-overflow bg9 "></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Special Days</h4>
           </div>
          </a> 
        </li>
        <li> 
         <a href="index.php?file=category/list"> <i class=" menu-icon fa fa-list-alt bg11" aria-hidden="true"></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Category</h4>
           </div>
          </a> 
        </li>
		
		<li> 
         <a href="index.php?file=subcategory/list"> <i class=" menu-icon  fa fa-list bg12" aria-hidden="true"></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">SubCategory</h4>
           </div>
          </a> 
        </li>

        <li> 
         <a href="index.php?file=itemcreation/list"><i class="menu-icon fa fa-bar-chart bg13"></i> 
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Item Creation</h4>
           </div>
          </a> 
        </li>

       <!--  <li> 
         <a href="index.php?file=ratefixing/list"> <i class=" menu-icon fa fa-rupee bg14"></i>
           <div class="menu-info">
             <h4 class="control-sidebar-subheading">Rate Fixing</h4>
           </div>
          </a> 
        </li> -->

      </ul>
    </div> 
  </div>
   
</aside>
<style>
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: 19px;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}



</style>
<?php $page_url = (explode('/', current_url()));?>	
<?php 

$usr_type = loginUser();
    

 ?>
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				
				<li class="start <?php if(in_array('home',$page_url)){ echo 'active open';}?>">
					<a href="<?php echo base_url('/admin/home');?>">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<!--span class="arrow "></span-->
					</a>
					<!--ul class="sub-menu">
						<li>
							<a href="index.html">
							<i class="icon-bar-chart"></i>
							Default Dashboard</a>
						</li>
						<li>
							<a href="index_2.html">
							<i class="icon-bulb"></i>
							New Dashboard #1</a>
						</li>
						<li>
							<a href="index_3.html">
							<i class="icon-graph"></i>
							New Dashboard #2</a>
						</li>
					</ul-->
					
				</li>
				<?php 
				/*
				
				if($usr_type =='super')
					{ ?>
				
				<li class="<?php if(in_array('adminUser',$page_url) || in_array('types',$page_url)){ echo 'active open';}?>">
					<a href="JavaScript:void(0);">
					
					<span class="title">Admin Management</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if(in_array('adminUser',$page_url) && !in_array('add',$page_url)){ echo 'active';}?>">
							<a href="<?php echo base_url('/admin/adminUser/');?>">
							<i class="icon-user"></i>
							Admin List</a>
						</li>
						
						<li class="<?php if(in_array('adminUser',$page_url) && in_array('add',$page_url)){ echo 'active';}?>">
							<a href="<?php echo base_url('/admin/adminUser/add');?>">
							<i class="icon-user-following"></i>
							<span class="badge badge-success badge-roundless">new</span>
							Add Admin User</a>
						</li>
						
						<li>
							<a href="<?php echo base_url('/admin/types/');?>">
							
							Users Types List</a>
						</li>
						<li>
							<a href="<?php echo base_url('/admin/types/add');?>">
							<i class="icon-plus"></i>
							Add User Type </a>
						</li>

					</ul>
				</li>
				
					<?php }
					*/
					?>
				<!-- END ANGULARJS LINK -->
				<!--li class="heading">
					<h3 class="uppercase">Features</h3>
				</li-->
				
				<?php /* ?>
				<li class="<?php if(in_array('pages',$page_url)){ echo 'active open';}?>">
					<a href="javascript:void(0);">
					<i class="icon-docs"></i>
					<span class="title">Content Management</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?php echo base_url('/admin/pages/');?>">
								<i class="icon-paper-plane"></i>
								Pages List
								
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('/admin/pages/add');?>">
							<span class="badge badge-success badge-roundless">new</span>
							Add Page</a>
						</li>
						<li>
							<a href="<?php echo base_url('/admin/banner/');?>">
							<span class="badge badge-danger"></span>Banners List</a>
						</li>
						<li>
							<a href="<?php echo base_url('/admin/banner/add');?>">
							<span class="badge badge-success badge-roundless">new</span>New Banner</a>
						</li>
						
						<li>
							<a href="<?php echo base_url('/admin/frequently/');?>">
							<i class="icon-question"></i>
							FAQ</a>
						</li>
						
					</ul>
				</li>	
					
<?php */ ?>

<?php if($usr_type =='super')
					{ ?>
				<li class="<?php if(in_array('company',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">Company Management</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">

				<li class="<?php if(in_array('company',$page_url)){ 
				if(!in_array('add',$page_url)){ echo 'active open';}}
				
				?>" >							
				<a href="<?php echo base_url('/admin/company/');?>">								
				<i class="icon-paper-plane"></i>								
				Company List															
				</a>						
				</li>						
				<li class="<?php if(in_array('add',$page_url)){ echo 'active open';}?>">							
				<a href="<?php echo base_url('/admin/company/add');?>">		
				Add Company</a>						
				</li>
									
				</ul>				
				</li>


			<li class="<?php if(in_array('product',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">Product Management</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">	
			
				<li class="<?php if(in_array('product',$page_url)){ 
				if(!in_array('add',$page_url)){ echo 'active open';}}
				
				?>">							
				<a href="<?php echo base_url('/admin/product/');?>">								
				<i class="icon-paper-plane"></i>								
				Product List															
				</a>						
				</li>
				
				
				<li class="<?php if(in_array('add',$page_url)){ echo 'active open';}?>">							
				<a href="<?php echo base_url('/admin/product/add');?>">	Add Product</a>						
				</li>
								
				</ul>				
				</li>	
<?php
 } 
 ?>				
		
<?php 
if($usr_type =='admin')
					{ 
				?>
				<li class="<?php if(in_array('company',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">Company Profile</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">
                 <li>							
				<a href="<?php echo base_url('/admin/company/');?>">								
				<i class="icon-paper-plane"></i>								
				View company Details															
				</a>						
				</li>
				
				
				<li>							
				<a href="<?php echo base_url('/admin/company/mainproduct');?>">							
											
				Manage main product</a>						
				</li>
	</ul>				
				</li>
				
				
				<li class="<?php if(in_array('product',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">Product Management</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">
                 <li>							
				<a href="<?php echo base_url('/admin/product/');?>">								
				<i class="icon-paper-plane"></i>								
				Product List															
				</a>						
				</li>
				
				
				<li>							
				<a href="<?php echo base_url('/admin/product/add');?>">							
											
				Add product</a>						
				</li>
	</ul>				
				</li>
				
				

<li class="<?php if(in_array('enduser',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">End User Management</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">	
			
				<li>							
				<a href="<?php echo base_url('/admin/enduser/');?>">								
				<i class="icon-paper-plane"></i>								
				End User List															
				</a>						
				</li>
				
				
				<li>							
				<a href="<?php echo base_url('/admin/enduser/add');?>">							
											
				Add User</a>						
				</li>
				
				<li>							
				<a href="<?php echo base_url('/admin/company/records');?>">								
				<i class="icon-paper-plane"></i>								
				View Records															
				</a>						
				</li>
							
				</ul>				
				</li>	
<?php 
} 
?>	



<?php if($usr_type =='enduser')
					{ 
				   
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;
if ($status != 'close')
{
?>
				<li class="<?php if(in_array('enduser',$page_url)){ echo 'active open';}?>">					
				<a href="javascript:void(0);">					
				<i class="icon-docs"></i>					
				<span class="title">Entry Management</span>					
				<span class="selected"></span>					
				<span class="arrow open"></span>					
				</a>					
				<ul class="sub-menu">

			   <li>							
				<a href="<?php echo base_url('/admin/enduser/drops');?>">							
											
				Drops Entry</a>						
				</li>
				
				<li>							
				<a href="<?php echo base_url('/admin/enduser/payouts');?>">							
											
				Payouts Entry</a>						
				</li>
				
			    <li>							
				<a href="<?php echo base_url('/admin/enduser/gasoline_received_form');?>">							
											
				Gasoline Received Entry</a>						
				</li>

                <li>							
				<a href="<?php echo base_url('/admin/enduser/store_sales');?>">							
											
				Store sales Entry</a>						
				</li>				
				
                <li>							
				<a href="<?php echo base_url('/admin/enduser/Last3records');?>">							
											
				View Last 3 records</a>						
				</li>
				
			
				 <li>							
				<a href="<?php echo base_url('/admin/enduser/pricechange');?>">							
											
				Change Price</a>						
				</li>
		      
				</ul>				
				</li>	
<?php 
} 
	}

?>



	
		
<?php if($usr_type =='super')
					{ ?>
				<li class="<?php if(in_array('settings',$page_url)){ echo 'active open';}?>">
					<a href="javascript:void(0);">
					<i class="icon-docs"></i>
					<span class="title">Settings</span>
					<span class="selected"></span>
					<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if(in_array('settings',$page_url) && in_array('edit',$page_url)){ echo 'active';}?>">
							<a href="<?php echo base_url('/admin/settings/edit');?>">
								<i class="fa fa-user"></i>
								Profile Edit
							</a>
						</li>
					<!--
						<li class="<?php if(in_array('settings',$page_url) && in_array('contact',$page_url)){ echo 'active';}?>">
							<a href="<?php echo base_url('/admin/settings/contact');?>">
							Contact Setting</a>
						</li>
						-->
					</ul>
				</li>
					<?php }?>
				<li>
					<a href="<?php echo base_url('/admin/login/logout');?>">
					<i class="icon-key"></i> Log Out
					</a>
				</li>
				<!--li>
					<a href="javascript:;">
					<i class="icon-envelope-open"></i>
					<span class="title">Email Templates</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="email_newsletter.html">
							Responsive Newsletter<br>
							Email Template</a>
						</li>
						<li>
							<a href="email_system.html">
							Responsive System<br>
							Email Template</a>
						</li>
					</ul>
				</li-->
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	
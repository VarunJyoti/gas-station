<?php $page_url = (explode('/', current_url()));?>	
<?php 

$usr_type = loginUser();
    

 ?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
 
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url('/admin/home');?>" class="site_title"><?php echo $get_settings->website_title;?></a>
        </div>
 
        <div class="profile"><!--img_2 -->
		
            <div class="profile_pic">
			&nbsp;
                <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
            </div>
			<br/>
			<!--
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php  $user = unserialize($this->session->userdata('admin')); echo $user['email']; ?></h2>
            </div>
			-->
        </div>
 
        <br>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
 
            <div class="menu_section">
                <h3>&nbsp;</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/home');?>">Dashboard</a></li>
                           
                        </ul>
                    </li>
					<?php if($usr_type =='super')
					{ 
				?>
				
				
                    <li><a><i class="fa fa-edit"></i> Company Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/');?>">Company List</a></li>
                            <li><a href="<?php echo base_url('/admin/company/add');?>">Add Company</a></li>
                            
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> Product Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/product/');?>">Product List</a></li>
                            <li><a href="<?php echo base_url('/admin/product/add');?>">Add Product</a></li>
                            
                        </ul>
                    </li>
					<?php
					}
					?>
					
					
					<?php 
if($usr_type =='admin')
					{ 
				?>
                    <li><a><i class="fa fa-home"></i> Company Profile <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/');?>">View Company Details</a></li>
                            <li><a href="<?php echo base_url('/admin/company/mainproduct');?>">Manage main product</a></li>
                            
                        </ul>
                    </li>
					
					
                    <li><a><i class="fa fa-desktop"></i> Product Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/product/');?>">Product List</a></li>
                            <li><a href="<?php echo base_url('/admin/product/add');?>">Add Product</a></li>
                            
                        </ul>
                    </li>
					
					<li><a><i class="fa fa-users"></i> End User Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/enduser/');?>">End User List</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/add');?>">Add User</a></li>
                            
                        </ul>
                    </li>
					
					<li><a><i class="fa fa-table"></i> Reports <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/sales_reports');?>">Sales report</a></li>
                            <li><a href="<?php echo base_url('/admin/company/purchased_reports');?>">Purchased Report</a></li>
                            <li><a href="<?php echo base_url('/admin/company/expense_reports');?>">Expense Report</a></li>
							<li><a href="<?php echo base_url('/admin/company/inventory_reports');?>">MIR</a></li>
							<li><a href="<?php echo base_url('/admin/company/creditcard_reports');?>">C.Card Report</a></li>
							<li><a href="<?php echo base_url('/admin/company/creditaccount_reports');?>">C.Account Report</a></li>
							<li><a href="<?php echo base_url('/admin/company/profit_loss_reports');?>">P/L Report</a></li>
                            
                        </ul>
                    </li>
					
					
					<li><a><i class="fa fa-credit-card"></i> C.Card Reconciliation <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/creditcardreconcilitaion');?>">C.Card Reconciliation</a></li>
                           
                        </ul>
                    </li>
					
					
					<li><a><i class="fa fa-user"></i> Credit Customer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/add_credit_customer');?>">Add/View Customer</a></li>
							<li><a href="<?php echo base_url('/admin/company/paymentreceived');?>">Payment Received</a></li>
                           
                        </ul>
                    </li>
					
					
					<li><a><i class="fa fa-bar-chart-o"></i>Expenses Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/add_expcat');?>">Manage Main Cat.</a></li>
							<li><a href="<?php echo base_url('/admin/company/add_expsubcat');?>">Manage Sub Cat.</a></li>
							<li><a href="<?php echo base_url('/admin/company/add_expenses');?>">Add Expenses</a></li>
                           
                        </ul>
                    </li>
					
					
					<li><a><i class="fa fa-bar-chart-o"></i>Purchased<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/company/add_purchased');?>">Add</a></li>
							
                           
                        </ul>
                    </li>
					
					
					<?php 
					}
					?>
					
                </ul>
            </div>
			
			<?php if($usr_type =='enduser')
					{ 
				   
    $statusss = $this->admin_login_model->CheckEnduser();
    $status = $statusss->status;
   if ($status != 'close')
   {
?>
			
            <div class="menu_section">
                
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Entry Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/enduser/drops');?>">Drops Entry</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/payouts');?>">Payouts Entry</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/ccard');?>">Credit Card Entry</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/creditamount_entry');?>">Credit Amount Entry</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/gasoline_received_form');?>">Gasoline Received Entry</a></li>
                            <li><a href="<?php echo base_url('/admin/enduser/store_sales');?>">Store sales Entry</a></li>
                            
 
                        </ul>
                    </li>
					
					<li><a><i class="fa fa-dollar"></i>Change Price<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/enduser/pricechange');?>">Change Price</a></li>
                       </ul>
                    </li>
					
                    <li><a><i class="fa fa-windows"></i>View Records <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('/admin/enduser/Last3records');?>">Last 3 Daily</a></li>
                       </ul>
                    </li>
                    
                </ul>
            </div>
 <?php
 
 } 
	}
 
 ?>
        </div>
 
        
 <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a href="<?php echo base_url('/admin/login/logout');?>" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php  $user = unserialize($this->session->userdata('admin')); echo $user['email']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url('/admin/settings/edit');?>"> Profile</a></li>
					<!--
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
					-->
                    <li><a href="<?php echo base_url('/admin/login/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
         <!--
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
				-->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

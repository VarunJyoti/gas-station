
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Dashboard</h3>
				
                  <div class="input-group">
	<form class="navbar-form" role="search" action="<?php echo base_url('admin/company');?>" method = "get">
				<div class="input-group">
					<input type="text"  class="form-control" placeholder="Search" name="q" value="<?php echo $_GET['q'];?>" size="13px; ">
					<div class="input-group-btn">
						<button class="btn btn-default " type="submit" value = "Search"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
	</div>
				
			 <?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('error') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">×</button>
		<?php echo $this->session->flashdata('success') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('info')) { ?>
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('info') ;?>
	</div>
	<?php } ?>
	
	
	
	
              </div>
			  

              <div class="title_right">
                <h3>&nbsp;</h3>
				
                  <div class="input-groups">
                    
			
			
			<form class="navbar-form"  action="<?php echo base_url('admin/company');?>" method="GET">
				<input type='hidden' name='q' value='<?php echo $_GET['q'];?>'/>
				<select  class="form-control"  name="select_val" id="select_val" onchange="this.form.submit()">
					<option value=''>Filter By Status</option>
					<!--option value="">None</option-->
					<option value="1">Active</option>
					<option value='2'>Disabled</option>
					
				</select>

			</form>
			
			 </div>
				 
                
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Company Management<small>Company List</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                <table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.</th>
				<th data-class="Title">Name</th>
				<th data-hide="Heading,tablet">Email</th>
				<th data-hide="Date">Address</th>
				<th>Pin</th>
				<th>Contact</th>
				<th>Username</th>
				<th>Status</th>
				<th colspan="3">Action</th>
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
		
			<!-- Table row -->
			 <?php
				
				if(!empty($company)){
					$s_no =1;
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($company as $comp)
					{
						
						$strtotime = $comp->createtime;
						$date = date('d M Y',$strtotime);
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$comp->name}</td>";
						echo " <td>{$comp->email}</td>";
						echo " <td>{$comp->address}</td>";
						echo " <td>{$comp->pin}</td>";
						echo " <td>{$comp->contact}</td>";
						echo " <td>{$comp->username}</td>";
						echo " <td>{$comp->printStatus()}</td>";
						
						?>
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/company/edit/{$comp->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php echo $comp->email;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button>
						</td>
					<?php
						$s_no++;
					}
				}else{
					echo ' <tr class="gradeX">';
					echo " <td>No record found</td>";
					echo "</tr>";
				}
				
			 ?>    
			
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
	<!-- // Table END --><?php echo $this->pagination->create_links();?>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

	<script>
	function page_delete(email){
			var r = confirm("Are you sure you want to delete the record?");
			if (r == true) {
			location.href = '<?php echo base_url("admin/company/delete");?>/'+email;
			} else {
				return false;
			}
			
	}
		
	</script>	
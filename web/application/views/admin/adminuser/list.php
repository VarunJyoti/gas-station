<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
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
	
	
	
	
	<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Admin List  <small></small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Admin Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Admin List</a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<a href="<?php echo base_url(); ?>admin/company/add" class="btn btn-fit-height grey-salt dropdown-toggle"><i class='fa fa-plus'></i> Add Company</a>
					</div>
				</div>
			</div>
	
	
	
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red-intense">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Admin List  ( Showing <?php echo (($start) + 1)." - ".($start+count($sbadmin))." of ".$total_sbadmin;?> )
				</div>
				
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_6">
				<thead>
				<tr>
					<th>Sr.</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Company Name</th>
					<th>Created Date</th>
					<th>Status</th>
					<th style='text-align: center;'>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				if(!empty($sbadmin)){
					$s_no =$start+1;
					foreach($sbadmin as $row)
					{
						
						
					    $strtotime = $row->created_dated;
						$date = date('d F Y',strtotime($strtotime));
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$row->first_name}</td>";
						echo " <td>{$row->last_name}</td>";
						echo " <td>{$row->email}</td>";                       
						echo " <td>{$row->c_id}</td>";
						//echo " <td>{$this->types_model->get_types($row->type)}</td>";
						echo " <td>{$date}</td>";
						echo " <td>{$row->printStatus()}</td>";
						?>
						<td class="center">
						<a href='<?php echo  base_url("admin/adminUser/sub_edit/{$row->id}");?>'><i class='fa fa-edit'></i> Edit </a>
						<a onclick='Subadmin_delete("<?php echo $row->id;?>")'><i class='fa fa-trash'></i> Delete</a>
						</td>
					<?php
						$s_no++;
					}
				}else{
					echo ' <tr>';
					echo " <td colspan='8'>No Users found</td>";
					echo "</tr>";
				}	
			 ?>    
				</tbody>
			</table>
			
			<?php  echo $this->pagination->create_links();  ?>
			
		<!-- // Table END -->
		</div>
	</div>		
	</div>	
</div>		
	
	
	<script>
	
	function Subadmin_delete(id){
		var r = confirm("Are you sure you want to delete the user?");
		if (r == true) {
			location.href = '<?php echo base_url('/admin/adminUser/delete');?>/'+id;
		} else {
			return false;
		}
		
	}
	</script>	




<!-- BEGIN CONTENT -->
<?php $user_type = loginUser();?>
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
			Product List  <small></small>
			</h3>
			<div class="page-bar">
			<div style="float:left;">
			<form class="navbar-form" role="search" action="<?php echo base_url('admin/product');?>" method = "get">
				<div class="input-group">
					<input type="text"  class="form-control" placeholder="Search" name="q" value="<?php echo $_GET['q'];?>" size="15px; ">
					<div class="input-group-btn">
						<button class="btn btn-default " type="submit" value = "Search"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			</div>
			<div style="float:left;">
			<form class="navbar-form"  action="<?php echo base_url('admin/product');?>" method="GET">
				<input type='hidden' name='q' value='<?php echo $_GET['q'];?>'/>
				<select  class="form-control"  name="select_val" id="select_val" onchange="this.form.submit()">
					<option value=''>Filter By Status</option>
					<!--option value="">None</option-->
					<option value="1">Active</option>
					<option value='2'>Disabled</option>
					
				</select>
			</form>
			</div>
	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
		 
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.</th>
				<th data-class="Title">Product Name</th>
				
				<!--th data-hide="Date">Product Price</th-->
				<th data-hide="Date">Product</th>
				<th>Status</th>
				<th colspan="3">Action</th>
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			 <?php
				
				if(!empty($product)){
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($product as $pro)
					{
						
						$strtotime = $pro->createtime;
						$date = date('d M Y',$strtotime);
						if($pro->status==1){
							$status='Active';
						}else{
							$status='Disabled';
						}
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->p_name}</td>";
						
						//echo " <td>&dollar;{$pro->p_price}</td>";
						
						$path =FCPATH."/uploads/product/".$pro->p_image;
						 if($pro->p_image){
						if(file_exists($path))
						{
						echo " <td><img src='".base_url()."uploads/product/{$pro->p_image}' height='50px' weight='50px'></td>";	
						 }
							else{
							echo " <td><img src='".base_url()."uploads/product/default-product.jpg' height='50px' weight='50px'></td>";	
							}
						}
						else{
						echo " <td><img src='".base_url()."uploads/product/default-product.jpg' height='50px' weight='50px'></td>";	
						}
						
						echo " <td>{$status}</td>";

						
						?>
						<?php 
						if($user_type=='admin')
						{
						?>
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/product/editStoreProduct/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php echo $pro->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button> 
						<?php 
						}
						else{
						?>
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/product/edit/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php echo $pro->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button>
						<?php 
						}
						?>
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
	<script>
	function page_delete(id){
			var r = confirm("Are you sure you want to delete the record?");
			if (r == true) {
			location.href = '<?php echo base_url("admin/product/delete");?>/'+id;
			} else {
				return false;
			}
			
	}
		
	</script>	
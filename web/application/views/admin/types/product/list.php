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
			Product List  <small></small>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
		
	<h5 class="text-uppercase strong separator bottom margin-none">List</h5>
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.</th>
				<th data-class="Title">Product Name</th>
				<th data-hide="Heading,tablet">Product Category</th>
				<th data-hide="Date">Product Price</th>
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
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($product as $pro)
					{
						
						$strtotime = $pro->createtime;
						$date = date('d M Y',$strtotime);
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->p_name}</td>";
						echo " <td>{$pro->p_cat}</td>";
						echo " <td>{$pro->p_price}</td>";
						$path =FCPATH."/uploads/product/".$pro->p_image;
						
						if(file_exists($path))
						{
						echo " <td><img src='".base_url()."uploads/product/{$pro->p_image}' height='50px' weight='50px'></td>";	
						}
						else{
						echo " <td><img src='".base_url()."uploads/product/default-product.jpg' height='50px' weight='50px'></td>";	
						}
						
						echo " <td>{$pro->printStatus()}</td>";
						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/product/edit/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php echo $pro->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button>
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
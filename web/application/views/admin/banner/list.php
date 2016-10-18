<h1>Banner List</h1>
<div class="innerLR">
	<?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $this->session->flashdata('error') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Success!</strong> <?php echo $this->session->flashdata('success') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('info')) { ?>
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Success ! </strong> <?php echo $this->session->flashdata('info') ;?>
	</div>
	<?php } ?>
	<h5 class="text-uppercase strong separator bottom margin-none">List</h5>
	<div class="widget-title">
	<span class="icon">
			
		</span> 	
		<h5>Banner List  ( Showing <?php echo (($page) + 1)." - ".($page+count($banner_data))." of ".$totalrow;?> Records) </h5>
	</div>
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>S.no.</th>
				<th>Name</th>
				<th>Heading</th>
				<th>Display</th>
				<th style='text-align: center;'>Action</th>
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>	
                                     
		<?php  
		if($banner_data){
			$s_no =$page +1;
			foreach($banner_data as $banner)
			{
				echo ' <tr class="gradeX">';
				echo " <td>{$s_no}</td>";
				echo " <td>{$banner->name}</td>";
				echo " <td>{$banner->heading}</td>";
				echo " <td>{$banner->printStatus()}</td>";
				//echo " <td class=\"center\"><a href=\"".site_url("admin/banner/view/{$banner->id}")."\">View </a></td>";
				?>
				<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/banner/edit/{$banner->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
				<button onclick='banner_delete("<?php echo $banner->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button>
				</td>
				<?php
				
				$s_no++;
			}
		   

		} else {
			echo "<tr><td colspan=\"5\">No Banner Found</td></tr>";
		}
			?>
		<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>  
	<?php echo $this->pagination->create_links();  ?>
</div>
<script>
function banner_delete(id){
		var r = confirm("Do u want to Delete This Banner");
		if (r == true) {
			location.href = '<?php echo base_url("admin/banner/delete");?>/'+id;
		} else {
			return false;
		}
}
</script>

        

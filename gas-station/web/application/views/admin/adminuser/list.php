 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Dashboard</h3>
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
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<!--
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
				  -->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Management <small>User List</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <p class="text-muted font-13 m-b-30">
                     Admin List  ( Showing <?php echo (($start) + 1)." - ".($start+count($sbadmin))." of ".$total_sbadmin;?> )
                    </p>
            
			
			
				<table id="datatable" class="table table-striped table-bordered">
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
          </div>
        </div>
        <!-- /page content -->
































	
	
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




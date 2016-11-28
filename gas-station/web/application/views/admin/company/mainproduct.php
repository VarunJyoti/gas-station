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
                    <h2>Company<small>Main Product Management</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.</th>
				<th data-class="Title">Product Name</th>
				
				<th data-hide="Heading,tablet">Old Price</th>
				<th data-hide="Heading,tablet">Price</th>
				
			
				
				<th colspan="3">Action</th>
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
		
			<!-- Table row -->
			 <?php
				
				if(!empty($page1)){
					$s_no =1;
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					//print_r($page1 );die;
					foreach($page1 as $page)
					{	
						 $price=$this->product_model->getProductPriceByID($page->id)->price;
						if($price==''){
							$price='00.00';
						}
						$s_price= $this->product_model->getProductPriceByID($page->id)->s_price;
						if($s_price==''){
							$s_price='00.00';
						}
						$old_price= $this->product_model->getProductPriceByID($page->id)->old_price;
						if($old_price==''){
							$old_price='00.00';
						}
						$strtotime = $comp->createtime;
						$date = date('d M Y',$strtotime);
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$page->p_name}</td>";
						echo " <td>{$old_price}</td>";
						echo " <td>{$s_price}</td>";
						
						
						
						
						
						?>
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/company/editprice/{$page->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						
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
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->



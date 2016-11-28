<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.4'; 

 
?>
<style>
html, body {
    padding-top: 20px;
}

[data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Credit Customer</h3>
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
                    <h2>Payment Received<small></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/company/SaveAmountReceived');?>" id="edit_page" method="post" autocomplete="off">
		
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Date:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="text" readonly required="required" class="form-control"  id="datepicker" name="date"   required="required" value="<?php echo date('Y-m-d');?>" placeholder="Received Date">
		 
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Customer Name:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <select name="name" class="form-control" required="required">
		  <option value="" selected="selected">SELECT CUSTOMER NAME</option>
		  <?php
		  if($credit_customers)
		  {
			  foreach($credit_customers as $row)
			  {
		  ?>
		  <option value="<?php echo $row->name;?>"><?php echo ucfirst($row->name);?></option>
		  <?php
		     }
		  }
		  ?>
		  <select>
		 
		 
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Amount Received:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input class="form-control" id="amount" name="amount" type="number" value="" required="required"/>
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Mode of Receiving:</label>
		  <div class="col-md-4">
		  <select name="mode" class="form-control" required="required">
		  <option value="" selected="selected">SELECT MODE OF RECEIVING</option>
		  <option value="cheque">Cheque</option>
		  <option value="cash">Cash</option>
		  <option value="others">Others</option>
		  </select>
		 
		  </div>
		  </div>
		  <!--
		  <div class="form-group">
		  <label class="control-label col-md-3">Description:</label>
		  <div class="col-md-4">
		   <?php 

										$CKEditor->config['width'] = '@@screen.width * 0.4';                           

											

										$CKEditor->editor("_p_desc", "<p></p>"); 

									?> 
		  </div>
		  </div>
		  -->
		  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Add</button>
						
					</div>
					</div>
				</div>	
		  
		
		
		
		</div>
		
		
		

	</form>
	<div>&nbsp;</div>
	<div>
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.No</th>
				<th data-class="Title">Name</th>
				<th data-hide="Heading,tablet">Amount</th>
				<th data-hide="Heading,tablet">Mode</th>
				<th data-hide="Heading,tablet">Date</th>
				
				<th data-hide="Heading,tablet">Action</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			
			
			 <?php
				//$total = $this->daily_shift_model->getSumDropsReceived()->Drops_total;
				if(!empty($ReceivedAmount)){
					
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($ReceivedAmount as $pro)
					{
						//$drops_total+=count($pro->amount);
						//$strtotime = $pro->createtime;
						//$date = date('d M Y',$strtotime);
						
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->name}</td>";
						echo " <td>{$pro->amount}</td>";
						echo " <td>{$pro->mode}</td>";
						
						
						echo " <td>{$pro->date}</td>";
						
						

						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/company/edit_receivedamount/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
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
	<!-- // Table END -->
	</div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
   


	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){  

$('#datepicker').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: 'picker_2',
		  
		  
        })



    // Form Validation
    $("#edit_page").validate({
        rules: {
            name: "required",
			amount: "required",
			
		        },
			
		
        messages: {
            name: "Please Enter  Name",
            amount: "Please Enter  Amount",
            
      
        },   
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('error');
            $(element).parents('.form-group').addClass('success');
        }
    });


});



	function page_delete(id){
			var r = confirm("Are you sure you want to delete the record?");
			if (r == true) {
			location.href = '<?php echo base_url("admin/company/DeleteReceivedAmount");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
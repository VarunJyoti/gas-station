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
                    <h2>Product Management<small>Add Product</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/company/SaveExpenses');?>" id="edit_page" method="post" autocomplete="off">
		
		<div class="form-body">
		
		
		
		<div class="form-group">
		  <label class="control-label col-md-3">Main Cat.:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <select name= "cat_name" id="cat_name" class="form-control">
		  <option value="" selected="selected">SELECT MAIN CATEGORY</option>
		  <?php
		  foreach($MainCat as $row)
					{
		  ?>
		  
		   <option value="<?php echo $row->cat_name?>"><?php echo ucfirst($row->cat_name)?></option>
		  <?php
					}
		  ?>
		  </select>
		  
		 
		  </div>
		  </div>
		  
		
		
		
		<div class="form-group">
		  <label class="control-label col-md-3"> Sub Cat. Name:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <select name= "subcat_name" id="subcat_name" class="form-control" required="required">
		  
		  </select>
		 
		  </div>
		  </div>
		
		
		<div class="form-group">
		  <label class="control-label col-md-3">Expense:<span class="required">* </span></label>
		  <div class="col-md-4">
		   <input type="number"   required="required" class="form-control" id="exp_amount" name="exp_amount" value="" placeholder="Expense Amount">
		 
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Date:<span class="required">* </span></label>
		  <div class="col-md-4">
		   <input type="text" readonly   required="required" class="form-control" id="datepicker" name="exp_date" value="<?php echo date('Y-m-d');?>" placeholder="Date">
		 
		  </div>
		  </div>
		  
		  
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
				<th data-class="Title">Expenses</th>
				<th data-class="Title">Name</th>
				<th data-class="Title">Date</th>
				
				<th data-hide="Heading,tablet">Action</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			
			
			 <?php
				
				if(!empty($expenses)){
					
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($expenses as $pro)
					{
						
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->exp_amount}</td>";
						echo " <td>{$pro->exp_subcat}</td>";
						echo " <td>{$pro->date}</td>";
						
						

						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php //echo  base_url("admin/company/add_expsubcat/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php //echo $pro->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button> 
						
						
						
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


 $('#cat_name').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        $.ajax({
            url: '<?php echo base_url("admin/company/getallExpSubCat");?>',
            type: "POST",
            data: "categoryId="+categoryId,
            success: function (response) {
                console.log(response);
                $("#subcat_name").html(response);
            },
        });
    }); 

	$('#datepicker').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: 'picker_2',
		  
		  
        })

    // Form Validation
    $("#edit_page").validate({
        rules: {
            cat_name: "required",
			
		        },
			
		
        messages: {
            name: "Please Enter  Name",
           
      
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
			location.href = '<?php echo base_url("admin/company/DeleteExpSubCat");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
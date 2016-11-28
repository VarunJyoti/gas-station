 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>C.Card Reconciliation</h3>
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
                    <h2>C.Card Reconciliation<small></small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <div id="content" style="width:100%;">
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%">
	
		<!-- Table heading -->
		
			<tr>
				<td>Sr.</td>
				<td>Card Name</td>
				
				<td>Amount Due</td>
				<td>Date Time</td>
				<td>Pending</td>
				<td>Received Date</td>
				<td>Received Amount</td>
				 
				
			
				
				<td>Action</td>
			</tr>
		
		<!-- // Table heading END -->
		
		<!-- Table body -->
		
		
			<!-- Table row -->
			 <?php
				
				if(!empty($ccardRow)){
					$s_no =1;
				foreach ($ccardRow as $row)
              {
						
						?>
						<form class="form-horizontal" action="<?php echo base_url('admin/enduser/saveccard');?>" id="edit_page" method="post" autocomplete="off">
						<input type="hidden" name="id" value="<?php echo $row->id; ?>">
						<input type="hidden" name="amount" value="<?php echo $row->amount; ?>">
						<input type="hidden" name="cc_type" value="<?php echo $row->cc_type; ?>">
						<input type="hidden" name="shift" value="<?php echo $row->shift; ?>">
						<input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>">
						<input type="hidden" name="c_id" value="<?php echo $row->c_id; ?>">
						<input type="hidden" name="daily_no" value="<?php echo $row->daily_no; ?>">
						<input type="hidden" name="created_date" value="<?php echo $row->created_date; ?>">
						<input type="hidden" name="modified_date" value="<?php echo $row->modified_date; ?>">
						<input type="hidden" name="date" value="<?php echo $row->date; ?>">
						<input type="hidden" name="pending" value="<?php echo $row->pending; ?>">
						
						<tr>
						<td><?php echo $s_no;?></td><td><?php echo $row->cc_type; ?></td><td><?php echo $row->amount; ?></td><td><?php echo $row->created_date; ?></td><td><?php echo $row->pending; ?></td><td><input type="text" readonly required="required" class="form-control"  id="datepicker<?php echo $row->id;?>" name="received_date" max=""  required="required" value="<?php echo date('Y-m-d');?>" placeholder="Received Date"></td><td><input type="text"  required="required" class="form-control"   name="received_amount" max=""   value="" placeholder="Received Amount"></td><td class="center"><button type="submit" name='save_page' value='Save' class="btn btn-primary"><i></i>Save</button>
						
						</td>
						</tr>
						</form>
					<?php
						
					$s_no++;
						
					}
					
				}
				
				else{
					echo ' <tr class="gradeX">';
					echo " <td>No record found</td>";
					echo "</tr>";
				}
				
			 ?>    
			
			<!-- // Table row END -->
			
			
		
		<!-- // Table body END -->
		
	</table>
	<!-- // Table END -->
	</div>   


<?php
	if(!empty($ccardRow))
	{
		?>
	<input type="button" class="btn btn-success" id="btn" value="save PDF"/> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-success" onclick='return Print();' value="PRINT"/>
	<?php
	}
	?>
	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

	
	
<script type="text/javascript">

$(document).ready(function(){
	
	
	<?php
	
	foreach ($ccardRow as $row)
              {
				
	echo "$('#datepicker".$row->id."').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: 'picker_4',
		  
		  
        })"."\n";
		
		
		
			  }
			  
	?>
			
var doc = new jsPDF();
var specialElementHandlers = {
'#editor': function (element, renderer) {
return true;
}
};	
$('#btn').click(function () {
doc.fromHTML($('#content').html(), 15, 15, {
'width': 170,
'elementHandlers': specialElementHandlers
});
doc.save('purchased_reports.pdf');
});

		
		
});




function Print()
{
	window.print();
}

 

</script>


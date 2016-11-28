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
.ts
{
width:30%;	
}
</style>

 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Reports</h3>
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
                    <h2>Sales Reports<small></small></h2>
                    
                    <div class="clearfix"></div>
					
					<div style="float:right;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/sales_reports');?>" method="GET">
  <tr>
  
   <td> 
	   <input type="text" readonly required="required" class="form-control" id="datepicker" name="from_date" max=""  required="required" value="<?php if($this->input->get("from_date")){echo $this->input->get("from_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date">
	   </td>
    <td> 
	 <input type="text" readonly required="required" class="form-control" id="datepicker1" name="to_date" max=""  required="required" value="<?php if($this->input->get("to_date")){echo $this->input->get("to_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date"> 
 </td>
 <td>
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  {  
     if($this->input->get("pid") == 'all')
	 {
	  ?>
	 <option value="<?php echo $this->input->get("pid");?>" selected>All</option>  
	 
 <?php 
	 }
	 else
	 {
		?>
		<option value="all" selected="all">All</option>
		<option value="<?php echo $this->input->get("pid");?>" selected><?php echo ucfirst($this->gasolinereceived_model->getProductName($this->input->get("pid")));?></option> 
		
<?php		
	 }
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all" selected="all">All</option>
 <?php } ?>
 
  <?php 
  foreach($pid1 as $pid)
  {
	  
  ?>
  <option value="<?php echo $pid?>"><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>
  
  <td>
  
 
   <input type="submit" class="form-control" name="find" value="SEARCH">
  
  </td>
  </tr>
</form>
</div>
					
                  </div>
				  <div id="content">
                  <div class="x_content">
                 <div id="content" style="width:100%;">
	<?php 
	if($sale)
	{
		//print_r($sale);
	?>
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
<tr><td>Date</td>

	<?php 
	
 
 
   
 
 foreach ($sale as $row)
   {
   
	?>
	
	<td><?php  echo ucfirst($row['pname']) ; ?></td>
	<?php 
		}
		?>
	
 
	
	
	</tr>
	<?php 
	foreach ($dateWiseRow as $row)
    {
	if(count(array_filter($row['sale'])) != 0)
	{
		?>
		<tr>
		
		<td><?php echo $row['date'];?></td>
		
		<?php 
		foreach ($row['sale'] as $sales)
    {
		
		?>
		
	<td><b><?php if($sales == '') {echo '0';} else{echo $this->daily_shift_model->NumberFormat($sales); }   ?></b></td>
	
	<?php 
	}
   
	?>
	</tr>
	<?php 
	}
   }
	?> 
	<tr>
	<td><b>Total</b></td>
	<?php 
	foreach ($sale as $row3)
   {
   
	?>
	
	<td><b><?php  echo $this->daily_shift_model->NumberFormat($row3['sale']) ; ?></b></td>
	<?php 
		}
		?>
	</tr>
	
	
	
	
	

	
						
	
	</table>
	<?php 
	}
	
	else
	{
	echo "Records Not Found!";	
		
	}
	
	?>
	<br/>

	<!-- // Table END -->
	</div>
	<?php
	if($sale)
	{
		?>
	<input type="button" class="btn btn-success" id="btn" value="save PDF"/> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-success" onclick='return Print();' value="PRINT"/>
	<?php
	}
	?>                    
                  </div>
				  </div>
				  <div id="editor"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->




	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.min.css" />
   <!-- <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!--
	<link href="<?php echo base_url(); ?>assets/datepicker/jquery-ui.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/datepicker/external/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/datepicker/jquery-ui.js"></script>
	-->
	  
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

	
	
	
	
<script type="text/javascript">

$(document).ready(function(){
 $('#datepicker').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: "picker_4",
		  
		  
        })
		
	$('#datepicker1').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: "picker_4",
		  
		  
        })
		
		
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
doc.save('sales_reports.pdf');
});

		
		
});




function Print()
{
	window.print();
}

 

</script>
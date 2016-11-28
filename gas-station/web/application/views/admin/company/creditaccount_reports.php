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
                    <h2>Credit Account Reports<small></small></h2>

                    <div class="clearfix"></div>
					
					<div style="float:right;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/creditaccount_reports');?>" method="GET">
  <tr>
  
   <td> 
   <select name= "month" class="form-control">
   <?php 
  
   if($this->input->get("month"))
   {
	   for ($m=1; $m<=12; $m++) {
	   ?>
	   <option value="<?php echo $m;?>"<?php if($m ==$this->input->get("month")){echo 'selected="selected"';}?>><?php echo date('M', mktime(0,0,0,$m)); ?></option><?php PHP_EOL;?>
	   
	<?php 
	   }	
   }
   else
   {
	    $mnth = date('m');
	  for ($m=1; $m<=12; $m++) {
	   ?>
	   <option value="<?php echo $m;?>"<?php if($m ==$mnth){echo 'selected="selected"';}?>><?php echo date('M', mktime(0,0,0,$m)); ?></option><?php PHP_EOL;?>
	 <?php 
	  }	 
   }
  ?>
   
   </select>
	   <!--<input type="text" readonly required="required" class="form-control" id="datepicker" name="from_date" max=""  required="required" value="<?php if($this->input->get("from_date")){echo $this->input->get("from_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date">-->
	   </td>
    <td> 
	<select name= "year" class="form-control">
   
  
  <?php 
  
    if($this->input->get("year"))
   {
   $year=date('Y');
   for ($m=2006; $m<=$year; $m++) {  
?>   
        <option value="<?php echo $m;?>" <?php if($m == $this->input->get("year")){echo 'selected="selected"';}?>><?php echo $m;?></option><?php PHP_EOL; ?>
<?php 
		}
   }
   else
   {
	   $year=date('Y');
   for ($m=2006; $m<=$year; $m++) { 
	?> 
	<option value="<?php echo $m;?>" <?php if($m == $year){echo 'selected="selected"';}?>><?php echo $m;?></option><?php PHP_EOL; ?>
   <?php
      }
   }
   
   ?>
   
   </select>
	
	<!-- <input type="text" readonly required="required" class="form-control" id="datepicker1" name="to_date" max=""  required="required" value="<?php if($this->input->get("to_date")){echo $this->input->get("to_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date"> -->
 </td>
 <td>
  <select name="customer_name" class="form-control" required="required">
   <option value="">CUSTOMER NAME</option>
   
	<!--<option value="all" <?php if ($this->input->get("customer_name") == 'all'){echo 'selected="selected"'; }?>>All</option>-->
 
   <?php
  foreach($credit_customers as $CustName)
  {
  ?>
   <option value="<?php echo $CustName->name;?>"<?php if($this->input->get("customer_name")) {if($this->input->get("customer_name") == $CustName->name ){echo 'selected = "selected"';}}?>><?php echo ucfirst($CustName->name);?></option>
  <?php
  }
  ?>
 
		  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>


					
                  </div>
                  <div class="x_content">
                 
				 <div id="content" style="width:100%;">
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
	

<tr><td colspan="6"><center><b><?php if($this->input->get("customer_name")){echo ucfirst($this->input->get("customer_name"));} ?></b></center></td></tr>
<tr><td>Date</td><td>Sale</td><td>Total</td><td>Recd.</td><td>Balance</td><td>Mode</td></tr>
<?php 

if(!empty($dateWiseRow))
{
	
	
foreach ($dateWiseRow as $row)
    {  
	  
     
if($row['credit'] OR $row['ReceivedAmount']  != 0)
	{
		
?>
<tr><td><?php echo $row['date'];?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['credit']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['total_credit']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['ReceivedAmount']);?></td><td><?php echo $balance =$this->daily_shift_model->NumberFormat(($row['total_credit']-$row['ReceivedAmount']));?></td><td><?php echo ucfirst($row['mode']);?></td></tr>


<?php
	}
	
	
	
	 }
}

else
	{
	echo "Records Not Found!";	
		
	}
?>
</table>
<!--
<td>


<table class="footable table table-striped table-bordered table-white table-primary" width="100%">

<tr><td colspan="7">&nbsp;</td></tr>
<tr><td>

<table class="footable table table-striped table-bordered table-white table-primary" width="50%">
<tr><td>Credit Cards</td></tr>
<tr><td>Due Amount</td></tr>
<tr><td>Amount Received</td></tr>
<tr><td>Balance</td></tr>
</table>
</td></tr>
</table>
</td>

-->

<?php 
/*
?>
<td>
<table class="footable table table-striped table-bordered table-white table-primary" width="100%">


<tr> 
<?php
     
  foreach ($row['row1'] as $row1)
    {
	
?>

<tr><td><?php echo $row1->pending_amount; ?></td><td><?php echo $row1->received_amount; ?></td><td><?php echo $row1->balance_amount; ?></td><td><?php echo $row1->balance_amount; ?></td></tr>

</table></td>  
<?php
	}
?>
</tr>

</table>
</td>



</tr>
<?php 
	}
	}
?>
</table>
	
	
	<?php 
	/*
	}
	
	else
	{
	echo "Records Not Found!";	
		
	}
	*/
	?>
	<br/>

	<!-- // Table END -->
	</div>
	<?php
	if(!empty($dateWiseRow))
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
doc.save('c.Account_reports.pdf');
});

		
		
});




function Print()
{
	window.print();
}

 

</script>


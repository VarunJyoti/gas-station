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
                <h3>Profit/Loss Reports</h3>
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
                    <h2><small>SEARCH BY</small></h2>
                    <div class="clearfix"></div>
					<div>
					<?php
					$report_type = '';
					if($this->input->get('report_type'))
					{
						$report_type = $this->input->get('report_type');
					}
					?>
        <input type="radio" name="tab" value="igotnone" onclick="show1();" <?php if($report_type == 'daily'){echo 'checked = "checked"';}?> />
            Daily
        <input type="radio" name="tab" value="igottwo" onclick="show2();" <?php if($report_type == 'monthly'){echo 'checked = "checked"';}?> />
         Monthly
		 <input type="radio" name="tab" value="igottwo" onclick="show3();" <?php if($report_type == 'fromDate_toDate'){echo 'checked = "checked"';}?> />
         From Date - To Date
		 <input type="radio" name="tab" value="igottwo" onclick="show4();" <?php if($report_type == 'mid_monthly'){echo 'checked = "checked"';}?> />
         Mid Monthly
		 <input type="radio" name="tab" value="igottwo" onclick="show5();" <?php if($report_type == 'yearly'){echo 'checked = "checked"';}?> />
         Yearly

    </div>
					<div class="clearfix"></div>
					
	<!-------- div1 Starts -------->
					
	<div id="div1" style="float:right; display:none;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/profit_loss_reports');?>" method="GET">
  <tr>
   <input type="hidden" name="report_type" value="daily">
  <td>
   <input type="text" readonly required="required" class="form-control" id="datepicker" name="daily_date" max=""  required="required" value="<?php if($this->input->get("daily_date")){echo $this->input->get("daily_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date">
  </td>
   
 <td>
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  { 
  $pidd = $this->input->get("pid");
    ?>
	 <option value="all"<?php if($pidd == 'all'){echo'selected="selected"';}?>>All</option>  
 <?php 
  
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all">All</option> 
 <?php } ?>
  <?php 
  foreach($pid1 as $pid)
  {
  ?>
  <option value="<?php echo $pid?>" <?php if($this->input->get("pid")){if($this->input->get("pid") == $pid){echo 'selected="selected"';}}?>><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>
<!---------div1 Ends----------->

<!-------- div2 Starts ------->

<div id="div2" style="float:right; display:none;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/profit_loss_reports');?>" method="GET">
  <tr>
   <input type="hidden" name="report_type" value="monthly">
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
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  { 
  $pidd = $this->input->get("pid");
    ?>
	 <option value="all"<?php if($pidd == 'all'){echo'selected="selected"';}?>>All</option>  
 <?php 
  
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all">All</option> 
 <?php } ?>
  <?php 
  foreach($pid1 as $pid)
  {
  ?>
  <option value="<?php echo $pid?>" <?php if($this->input->get("pid")){if($this->input->get("pid") == $pid){echo 'selected="selected"';}}?>><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>
<!------------ div2 Ends ---------->


<!------------- div3 Starts ------------->

<div id="div3" style="float:right; display:none;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/profit_loss_reports');?>" method="GET">
  <tr>
   <input type="hidden" name="report_type" value="fromDate_toDate">
  <td> 
   <input type="text" readonly required="required" class="form-control" id="datepicker2" name="from_date" max=""  required="required" value="<?php if($this->input->get("daily_date")){echo $this->input->get("daily_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date">
 </td>
 
 <td> 
   <input type="text" readonly required="required" class="form-control" id="datepicker1" name="to_date" max=""  required="required" value="<?php if($this->input->get("daily_date")){echo $this->input->get("daily_date");} else{echo date('Y-m-d');}  ?>" placeholder="Date">
 </td>
 
 <td>
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  { 
  $pidd = $this->input->get("pid");
    ?>
	 <option value="all"<?php if($pidd == 'all'){echo'selected="selected"';}?>>All</option>  
 <?php 
  
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all">All</option> 
 <?php } ?>
  <?php 
  foreach($pid1 as $pid)
  {
  ?>
  <option value="<?php echo $pid?>" <?php if($this->input->get("pid")){if($this->input->get("pid") == $pid){echo 'selected="selected"';}}?>><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>
<!-------- div3 ---------->


<!----------- div4 starts -------->

<div id="div4" style="float:right; display:none;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/profit_loss_reports');?>" method="GET">
  <tr>
   <input type="hidden" name="report_type" value="mid_monthly">
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
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  { 
  $pidd = $this->input->get("pid");
    ?>
	 <option value="all"<?php if($pidd == 'all'){echo'selected="selected"';}?>>All</option>  
 <?php 
  
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all">All</option> 
 <?php } ?>
  <?php 
  foreach($pid1 as $pid)
  {
  ?>
  <option value="<?php echo $pid?>" <?php if($this->input->get("pid")){if($this->input->get("pid") == $pid){echo 'selected="selected"';}}?>><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>
<!-------- div4 ------->


<!----------- div5 starts -------->

<div id="div5" style="float:right; display:none;">
     <form class="navbar-form"  action="<?php echo base_url('admin/company/profit_loss_reports');?>" method="GET">
  <tr>
  
   <input type="hidden" name="report_type" value="yearly">
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
  <select name="pid" required="required" class="form-control">
  <?php 
  if($this->input->get("pid"))
  { 
  $pidd = $this->input->get("pid");
    ?>
	 <option value="all"<?php if($pidd == 'all'){echo'selected="selected"';}?>>All</option>  
 <?php 
  
 }
 else{
  ?>
  
  <option value="" selected="selected">SELECT PRODUCT</option>
  <option value="all">All</option> 
 <?php } ?>
  <?php 
  foreach($pid1 as $pid)
  {
  ?>
  <option value="<?php echo $pid?>" <?php if($this->input->get("pid")){if($this->input->get("pid") == $pid){echo 'selected="selected"';}}?>><?php echo ucfirst($this->gasolinereceived_model->getProductName($pid));?></option>
  <?php }?>
  </select>
  </td>

  <td>
   <input type="submit" class="form-control" name="find" value="SEARCH">
  </td>
  
  </tr>
</form>
</div>
<!-------- div5 ------->

	
                  </div>
                  <div class="x_content">
                 
				 <div id="content" style="width:100%;">
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
	

        <tr><td colspan="8"><center><b><?php if($this->input->get("pid")){if($this->input->get("pid") == 'all'){echo 'All';} else {echo ucfirst($this->gasolinereceived_model->getProductName(ucfirst($this->input->get("pid"))));} }?></b></center></td></tr>
        <tr><td>Date</td><td>Opening</td><td>Purchase</td><td>Sale</td><td>Sale</td><td>Closing </td><td>Expenses</td><td>Profit/Loss</td></tr>
        <tr><td></td><td>Amount</td><td>Amount</td><td>Daily (Amount)</td><td>Upto Date (Amount)</td><td>Amount </td><td>Daily (Amount)</td><td>Daily</td></tr>
        <?php 

        if(!empty($dateWiseRow))
        {
	
	
             foreach ($dateWiseRow as $row)
            {  
	  
     
                if($row['open'] OR $row['purchased'] OR $row['sale'] OR $row['closing']  != 0)
	            {
		
                     ?>
                      <tr><td><?php echo $row['date'];?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['open']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['purchased']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['sale']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['UpToDateSale']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['closing']);?></td><td><?php echo $this->daily_shift_model->NumberFormat($row['TotaExpenses']);?></td><td><?php $amount = ($row['UpToDateSale']+$row['closing']); $amounts = ($row['purchased']+$row['open']+$row['TotaExpenses']); $amountss = ($amount - $amounts); echo $this->daily_shift_model->NumberFormat($amountss);?></td></tr>


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
		
		
		$('#datepicker2').daterangepicker({
	 
	
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
doc.save('P/L_reports.pdf');
});

		
		
});




function Print()
{
	window.print();
}

 

</script>


<script type="text/javascript">
function show1(){
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  
  document.getElementById('div1').style.display = 'block';
}
function show2(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  
  document.getElementById('div2').style.display = 'block';
}
function show3(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  
  document.getElementById('div3').style.display = 'block';
}
function show4(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div5').style.display ='none';
 
  document.getElementById('div4').style.display = 'block';
}
function show5(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display = 'block';
}
</script>


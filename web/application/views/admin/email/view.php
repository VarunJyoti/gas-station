<h1>City </h1>
<ul class="breadcrumb">
		<li>City Management</li>
		<li><a href="<?php echo base_url('/admin/city');?>" class="glyphicons dashboard"> List</a></li>
		<li class="divider"><i class="icon-caret-right"></i></li>
		<li>View City</li>
</ul>
<div class="innerLR">
	<div class="span8">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-file"></i>
			</span>
			<h5><?php	echo $city->name;?></h5>
		</div>
		<div class="widget-content nopadding">
			<ul class="recent-posts" style='list-style:none;'>
				<li>
					<?php if(!empty($city->image)){?>
					<div>
						<img style="" alt="User" src="<?php echo site_url("main/thumbs?image={$city->show_thumb()}&h=150&w=220");?>" />
					</div>
					<?php }?>
					<div class="banner-name">
						<p> City Name : <span><?php echo $city->name;?>  </span></p>
						<p> Title: <span><?php echo $city->title;?>  </span></p>
						
						<br/>
						<a href="<?php echo site_url("admin/city/edit/{$city->id}");?>" class="btn btn-primary btn-mini">Edit</a>
					</div>
				</li>
			   
			</ul>
		</div>
	</div>
					 
</div>

</div>
                
     
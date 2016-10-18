<h1>Banner </h1>
	<ul class="breadcrumb">
		<li>Banner Management</li>
		<li><a href="<?php echo base_url('/admin/banner');?>" class="glyphicons dashboard"> List</a></li>
		<li class="divider"><i class="icon-caret-right"></i></li>
		<li>View Banner</li>
</ul>
<div class="innerLR">
	<div class="span8">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-file"></i>
			</span>
			<h5><?php echo $banner->name;?></h5>
		</div>
		<div class="widget-content nopadding">
			<ul class="recent-posts" style='list-style:none;'>
				<li>
					<div >
						<img style="" alt="User" src="<?php echo site_url("main/thumbs?image={$banner->show_thumb()}&h=150&w=220");?>" />
					</div>
					<div class="banner-name">
						<p> Banner Name : <span><?php echo $banner->name;?>  </span></p>
						<p> Banner Heading: <span><?php echo $banner->heading;?>  </span></p>
						<p> Description : <span><?php echo $banner->description;?> </span> </p>
						<p> Order : <span><?php echo $banner->order;?> </span> </p>                                           
					   
						<br/>
						<a href="<?php echo site_url("admin/banner/edit/{$banner->id}");?>" class="btn btn-primary btn-mini">Edit</a>
					</div>
				</li>
			   
			</ul>
		</div>
	</div>
					 
</div>

</div>
                
     
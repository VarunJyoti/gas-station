<?php $page_url = (explode('/', current_url()));$usr_type = loginUser();?>
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Dashboard</h3>
			 
          <?php 
			if($this->session->flashdata('success')) {
				echo $this->session->flashdata('success');
			}
			?>
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
                    <h2>Admin Dashboard<small>Home</small></h2>
					
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
	
	
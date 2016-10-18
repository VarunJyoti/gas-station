<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/***********
Developed by
	Bijender Antil
Ajax Pagination 
**************/

class Admin_pagination{
   
	
	################ pagination function #########################################
	public function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
	{
		$pagination = '';
		
		if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
			$pagination .= '<div class="pagination pagination-small pull-right" style="margin: 0;"><ul class="pagination list-inline">';
			
			$right_links    = $current_page + 3; 
			$previous       = $current_page - 3; //previous link 
			$next           = $current_page + 1; //next link
			$first_link     = true; //boolean var to decide our first link
			
			if($current_page > 1){
				$previous_link = ($previous==0)?1:$previous;
				$pagination .= '<li class="first"><a href="#" data-page="1" title="First"><span>&laquo;</span></a></li>'; //first link
				$pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous"><span>Prev</span></a></li>'; //previous link
					for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
						if($i > 0){
							$pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'"><span>'.$i.'</span></a></li>';
						}
					}   
				$first_link = false; //set first link to false
			}
			
			if($first_link){ //if current active page is first link
				$pagination .= '<li class="first active"><span>'.$current_page.'</span></li>';
			}elseif($current_page == $total_pages){ //if it's the last active link
				$pagination .= '<li class="last active"><span>'.$current_page.'</span></li>';
			}else{ //regular current link
				$pagination .= '<li class="active"><span>'.$current_page.'</span></li>';
			}
					
			for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
				if($i<=$total_pages){
					$pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'"><span>'.$i.'</span></a></li>';
				}
			}
			if($current_page < $total_pages){ 
					$next_link = ($i > $total_pages)? $total_pages : $i;
					$pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next"><span aria-hidden="true">Next</span></a></li>'; //next link
					$pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last"><span>&raquo;</span></a></li>'; //last link
			}
			
			$pagination .= '</ul></nav>'; 
		}
		
		return $pagination; //return pagination links
	}
}
/* End of file admin_pagination.php */
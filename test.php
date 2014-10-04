<?php

class QuicksandView {
	
	public function deleteQuicksandCategory() {
				global $wpdb;
						// Function to delete quicksand category
				$name = $_REQUEST['name'];
				delete_option($name);	
				$response = "Option Deleted";
				header("Content-Type: application/json");
				echo json_encode($response);		
				exit();
}
	public function render() {
		// Count crashes on large unlimited values
        $count = 100;
		for ($i = 1; $i <= $count; $i++) {
			   $quicksand_categories[] = get_option('quicksand_category' . $i); 
		}
	   array_push($quicksand_categories, 0);             
?>
        <div class="options-container">
                <ul id="filterOptions">
                    <?php $cat_descriptions = array(); ?>
                    <?php if (get_option('listall') == 'yes') { ?>
                    <li><a href="#" class="all">All</a></li>   
                    <?php } ?>

                        <?php foreach ($quicksand_categories as $catID) {
                                if ($catID == 0) { } else { $filter_category = get_cat_name($catID); 
                                ?>
                    <li><a href="#" class="<?php echo $catID; ?>"><?php echo $filter_category; ?></a></li>
                    <?php $cat_descriptions[$catID] = category_description($catID); ?>
                 <?php } } ?>   
                </ul>
                </div>
                <?php if (get_option('descriptions') == 'yes') { ?> 
                <div class="descriptions">
                        <?php foreach ($cat_descriptions as $key => $val) { ?>
                                <h3 class='category-description' cat-id='<?php echo $key . "'"; if ($key != 7) {?> style = 'display:none;'<?php } ?> >
                                    <?php echo $cat_descriptions[$key]; ?>
                                </h3>
                        <?php } ?>
                </div>
			<?php } ?>					
				<?php
				// style options
					$imageheight = get_option('quicksandheight');
					$imagewidth = get_option('quicksandwidth');
					$itemheight = get_option('itemheight');
					$itemwidth = get_option('itemwidth');
					echo '<style>';
					if (!empty($imageheight)) {						
						echo '.item img { height:' . $imageheight . 'px;}';
					}
					if (!empty($imagewidth)) {						
						echo '.item img { width: ' . $imagewidth . 'px}';
					}
					if (!empty($itemheight)) {						
						echo 'ul.ourHolder li.item { height:' . $itemheight . 'px;}';
					}
					if (!empty($itemwidth)) {						
						echo 'ul.ourHolder li.item { width: ' . $itemwidth . 'px}';
					}					
					echo '</style>';
					?>
             <ul class="ourHolder">         
				<?php                                                     
                    $args = array(
                                    'posts_per_page' => '-1',
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'category__in' => $quicksand_categories 
                                    );                     
                    $query = new WP_Query( $args );      										
                    foreach ($query->posts as $item) {						
                        $categories = wp_get_post_categories($item->ID);
						?>
                        <li id="item" class="item" data-id="id-<?php echo $item->ID ?>" data-type="<?php foreach ($categories as $c) { echo $c . ' ';}?>" >
                        <?php  if (get_option('featured') == 'yes') { ?>
                           <a href="<?php echo get_permalink($item->ID); ?>">					
                        <?php  echo get_the_post_thumbnail($item->ID);  ?></a>
                        <?php } ?>
                           <br />
                        <?php if(get_option('titles') == 'yes') { ?>
                            <a href="<?php echo get_permalink($item->ID); ?>">
                        <?php echo get_the_title($item->ID); ?>
                            </a>
                            <?php } ?>
                        </li>                                          
                    <?php  }  ?>
             </ul>
			<?php            
			}					
			// Admin views with methods						
			// Update Filter Options
			public function update_options($name,$option) {        
				if (isset($option)) {
					update_option($name, $option);
				}
				else {
				}				
			}
			// Process Form Selection
			public function quicksand_form_process() {
				   $postVariables = array();
				   foreach ($_POST as $key => $value) {
					   $optionArray = array ('name' => $key, 'value' => $value); 
					   if ($key == 'Submit') {

					   } else {
					   $postVariables[] = $optionArray;
					   }
				   }
				   //Run Update on Post Array
				   foreach ($postVariables as $runOption) {
//					   if ($runOption['value'] == 'Empty') {
//						   delete_option($runOption['name']);
//					   } else {
						   $this->update_options($runOption['name'], $runOption['value']);
//						  }
					}
			}
			
			public function renderAdmin() {
						$this->quicksand_form_process();		
			?>
				<div class="wrap">  
					<h2> Quicksand jQuery Post Filter </h2>  
					<form name="quicksand_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">          
						<div class="category-selector">
							<div class="category-selector-header">
								<h3>Filter Categories</h3>
							</div>
							<?php $this->categorySelector(); ?>
						</div>
						<?php
							 $descriptions = get_option('descriptions');
							 $listall = get_option('listall');
							 $featured = get_option('featured');
							 $titles = get_option('titles');
							 $height = get_option('quicksandheight');
							 $width = get_option('quicksandwidth');
							 $itemheight = get_option('itemheight');
							 $itemwidth = get_option('itemwidth');							 
						?>
						<div class="options-selector">
							<div class="options-selector-header">
								<h3>Plugin Options</h3>
							</div>
								<p>
									<input type="hidden" name="descriptions" value="no"/>
									<?php _e("Category Descriptions: ");?> <input type="checkbox" name="descriptions" value="yes" <?php if ($descriptions == 'yes') { echo 'checked="checked"'; } else {};?> />
								</p>
								<p>
									<input type="hidden" name="listall" value="no"/>
									<?php _e("List All Tab?:"); ?> <input type="checkbox" name="listall" value="yes" <?php if ($listall == 'yes') { echo 'checked="checked"';} else {} ?> />
								</p>
								<p>
									<input type="hidden" name="featured" value="no"/>
									<?php _e("Use Post Featured Image:"); ?> <input type="checkbox" name="featured" value="yes" <?php if ($featured == 'yes') { echo 'checked="checked"';} else {} ?> />
								</p>
								<p>
									<input type="hidden" name="titles" value="no"/>
									<?php _e("Show Post Titles:"); ?> <input type="checkbox" name="titles" value="yes" <?php if ($titles== 'yes') { echo 'checked="checked"';} else {} ?>/>
								</p>
								<h3>Leave the below values empty if you are setting these sizes through your own CSS files</h3>
								<p>
									<?php _e("Filter Item Height"); ?> <input type="text" name="itemheight" value="<?php if (!empty($itemheight)){echo $itemheight;}?>"/>
								</p>
								<p>
									<?php _e("Filter Item Width"); ?> <input type="text" name="itemwidth" value="<?php if (!empty($itemwidth)){echo $itemwidth;}?>"/>
								</p>								
								<p>									
									<?php _e("Post Thumbnail Height"); ?> <input type="text" name="quicksandheight" value="<?php if (!empty($height)){echo $height;}?>"/>
								</p>		
								<p>									
									<?php _e("Post Thumbnail Width"); ?> <input type="text" name="quicksandwidth" value="<?php if (!empty($width)){echo $width;}?>"/>
								</p>									
						</div>
						<p class="submit">  
							<input type="submit" class="quicksand-submit" name="Submit" value="<?php _e('Update Options', 'quicksand_trdom' ) ?>" />  
						</p>         
					</form>
				</div>
		<?php
			}
			
			public function categorySelector() {
						$categorySelect = get_categories();
						$all_options = wp_load_alloptions();        
					  ?>        
							  <script>
									  jQuery(function() {
											  var quicksandDiv = jQuery('#add_categories');

											 // var i = parseInt(jQuery('#category-label').parent().attr('id')) + 1;

										   var arr = [];

										   jQuery("#add_categories p").each(function() {
											   var value = parseInt(jQuery(this).attr('id'));
											   arr.push(value);
										   })

										   var largest = Math.max.apply(null,arr);                    
										   var i = largest + 1;

											  jQuery('#addCategory').live('click', function() {
													  jQuery('<p id="' + i + '"><label for="category"><select id="quicksand_category' + i +  '" name="quicksand_category' + i +'"><?php foreach ($categorySelect as $c) { echo '<option value="' . $c->cat_ID . '"' .  '>' . $c->cat_name . '</option>'; }?><option value="Empty">Empty</option></select></label> </p>').appendTo(quicksandDiv);
													  i++;
													  return false;
											  });
											  
									  });       
							  </script>
							  <div id="message">
								  
							  </div>
									  <div id="add_categories">
									  <p id="0">&nbsp</p>
					  <?php   

						  // Get Current Added Categories
									$count = 0;
									foreach ($all_options as $name => $key) {
												 $shortname = mb_substr($name, 0, 18);
												  if ($shortname == "quicksand_category") {    
													$count++;
												 ?>
							  		      <script>
										  jQuery(document).ready(function() {
											 jQuery("#remove<?php echo $name;?>").click(function() {
												var name = "<?php echo $name;?>";
												var cat = "p#<?php echo substr($name, -1);?>";
												var removelink = "#remove<?php echo $name;?>";
									
												jQuery.ajax
												({
													type: 'POST',
													url: ajaxurl,
													dataType: 'json',
													data: {
														action : 'quicksanddelete',
														name : name},
													success: function(data){
														jQuery(cat).remove();
														jQuery('#message').html(data);
														jQuery(removelink).remove();
													}
												});																								
											});
										  });
										  </script>		  
							  <p id="<?php echo substr($name, -1); ?>">
								  <label for="category">
									  <select id="<?php echo $name;?>" name="<?php echo $name;?>">											
										   <?php foreach ($categorySelect as $c) { 
											   echo '<option value="' . $c->cat_ID . '"';
												  if ($key == $c->cat_ID) {
														  echo ' selected';
													  }
												  echo '>' . $c->cat_name . '</option>'; }

												  ?>									 
									  </select>
								  </label>
					              <div class="remove-link" id="remove<?php echo $name;?>">Remove</div>
							  </p>
					  <?php
												  } else {
												  }
										  } ?>
									  </div> 
							  <h3><a href="#" id="addCategory" class="add-category">New Filter</a></h3>
					  <?php        
							  }				
}	 
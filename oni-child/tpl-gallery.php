<?php 
/* Template Name: Gallery */
get_header();
?>

<style type="text/css">
	form {
		display: initial !important;
	}
	.col-md-4 {
		/*position: relative;*/
		margin-bottom: 26px;
	}
	.inner-div {
		width: 100%;
		color: white;
		position: relative;
	}
	.inner-div:after {
		content:'';
		position: absolute;
		left:0;
		top:0;
	    background-color: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
	    url('images/background.jpg');
	    width: 100%;
	    height: 20px;
	}
	.inner-div a,
	.inner-div a img {
		width: 100%;
    	display: inline-block;
	}
	.port-meta {
		position: absolute;
		left:0;
		top:100%;
		margin-top:-30px;
		padding-left:30px;
		-moz-transform:translate(0, -100%);
		-o-transform:translate(0, -100%);
		-ms-transform:translate(0, -100%);
		-webkit-transform:translate(0, -100%);
		transform:translate(0, -100%);
	}
	.port-meta.down {
		position: relative;
	    margin: 0;
	    transform: inherit;
	    background: #f2f2f2;
	    padding: 20px;
	}
	.port-meta.down a {
		font-size: 16px;
		color:#222;
	}
	.port-meta.down span {
		font-size: 12px;
		color:#222;
	}
	.port-meta a {
		font-size: 14px;
    	text-transform: uppercase;
		color:#fff;
		display:inline-block;
		width:100%;
	}
	.port-meta span {
		display: inline-block;
		width:100%;
		text-transform: uppercase;
	    font-size: 14px;
	    color: #dadada;
	}
	.pagination {
		display: block;
		text-align: center;
	}
	.pagination a,
	.pagination span {
		width: 30px;
	    height: 30px;
	    background: #007bff;
	    display: inline-block;
	    font-size: 14px;
	    text-align: center;
	    line-height: 30px;
	    margin: 0 3px;
	    color:#fff;
	}
	.pagination a {
		background: #f2f2f2;
		color:#222;
	}
	.slideshow {
		display: inline-block;
		width:100%;
		padding: 10px 0;
		text-align: center;
	}
	.slide-btn {
		display: inline-block;
		height: 45px;
		line-height: 23px;
		text-align: center;
		font-size: 10px;
		text-transform: uppercase;
	    letter-spacing: 2px;
	    border: 1px solid rgba(30,115,190, 0.1);
	    font-family: Noto Sans;
    	font-weight: 700;
    	color: #9da1a5;
		padding: 10px 30px;
	}
	.myfilter {
		display: inline-block;
		width:100%;
		text-align: center;
	}
	.myfilter li {
		display: inline-block;
    	margin-right: 20px;
	}
</style>

<script>
	jQuery(function() {
	    jQuery('#submit-state').change(function() {
	        this.form.submit();
	    });
		jQuery('#submit-size').change(function() {
	        this.form.submit();
	    });
	});
</script>

<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>

<div class="container mb-5">
		
			<ul class="myfilter">
				<li>
					<form method="get" action="https://www.americasbestidea.com.dream.website/gallery">
						<input type="hidden" name="filter" value="state">
						<?php
						$terms = get_terms( 'portfolio_category', array(
								    'hide_empty' => false,
								) );
						if ( !empty($terms) && count($terms)>0 ) {
						?>
						<select name="state" id="submit-state" style="font-family: Noto Sans; font-size:12px;font-weight: 700;color: #9da1a5;letter-spacing: 2px;"> 
							<option value="211">State</option>
							<?php 
								foreach( $terms as $term ) { 
									$filter = (isset($_GET) && $_GET['state']!='') ? $_GET['state'] : '';
									$selected = '';
									if ( $filter ==  $term->term_id ) {
										$selected = 'selected=selected';
									}
							?>
							
							<?php if($term->name != 'State'){ ?>
								<option <?php echo $selected; ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php }} ?>
						</select>
						<?php } ?>
					</form>
				</li>
				<li>
					<form method="get" id="form-filter">
						<input type="hidden" name="filter" value="aplhabetic">
						<button type="submit" class="">Alphabetic</button>
					</form>
				</li>
				
				<li>
					<form method="get">
						<input type="hidden" name="filter" value="size">
						
						<select name="sortsize" id="submit-size" style="font-family: Noto Sans; font-size:11px; font-weight: 700;color: #9da1a5;letter-spacing: 2px;">
							<option>SIZE</option>
							<option value="b" <?php echo ($_GET['sortsize'] == "b")?"selected=selected":"" ?> >Big to small</option>
							<option value="s" <?php echo ($_GET['sortsize'] == "s")?"selected=selected":"" ?> >Small to big</option>
						</select>
						<!-- <button type="submit" class="">Size</button> -->
					</form>
				</li>
				<li>
					<form method="get">
						<input type="hidden" name="filter" value="chronology">
						<button type="submit"class="">Chronology</button>
					</form>
				</li>
				<li>
					<div class="slideshow">
						<a target="_blank" href="https://www.americasbestidea.com.dream.website/slide-show/" title="" class="slide-btn">Slide Show</a>
					</div>	
				</li>
			</ul>
		
	

	<div class="row">
	<?php
		$filter = @$_GET['filter'];
		$filter = strtolower($filter);
		
		if($filter == 'aplhabetic') {
			$args = array(
		        'post_type'      => 'portfolio',
		        'orderby' => 'title',
    			'order'   => 'ASC',
    			'posts_per_page' => 9,
  				'paged' => $paged
		    );
	    	$query = new WP_Query( $args );
	    	while ( $query->have_posts() ) : $query->the_post();
	    		$state = wp_get_post_terms(get_the_ID(), 'portfolio_category');
				$park_name = wp_get_post_terms(get_the_ID(), 'chronology1');
	    ?>
	    	<div class="col-md-4">
				<div class="inner-div">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('320x150'); ?></a>
					<div class="port-meta down">
						<a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
						<span>
							<?php 
								$str_arr = [];
								foreach($state as $value){
									if($value->name != "State"){
										array_push($str_arr, $value->name);
										//echo $value->name.",   "; 
									}										
								}		
								echo implode(',   ',$str_arr);							
							?>
						</span>
					</div>
				</div>
			</div>
	    <?php
        	endwhile; wp_reset_postdata();
		}
		elseif ( $filter == 'state' ) {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$state = ( isset($_GET) && $_GET['state'] != '' ) ? $_GET['state'] : ''; 
			$args = array(
		        'post_type' => 'portfolio',
		        'orderby' => 'title',
		        'pagination' => true,
    			'order'   => 'ASC',
    			'posts_per_page' => 9,
  				'paged' => $paged,
    			'tax_query' => array(
		            array(
		                'taxonomy' => 'portfolio_category',
		                'field' => 'term_id',
		                'terms' => $state,
		            )
		        )
		    );
			$query = new WP_Query( $args );
		   	while ( $query->have_posts() ) : $query->the_post();
		   		$state = wp_get_post_terms(get_the_ID(), 'portfolio_category');
    			$park_name = wp_get_post_terms(get_the_ID(), 'chronology1');
			?>
				<div class="col-md-4">
					<div class="inner-div">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('320x150'); ?></a>
						<div class="port-meta down">
							<a href="<?php the_permalink(); ?>" title=""><?php the_title() ?></a>
							<span>
								<?php 
									$str_arr = [];
									foreach($state as $value){
										if($value->name != "State"){
											array_push($str_arr, $value->name);
											//echo $value->name.",   "; 
										}										
									}		
									echo implode(',   ',$str_arr);							
								?>
							</span>
						</div>
					</div>
				</div>
			<?php
			endwhile; wp_reset_postdata();
		}	
		elseif ( $filter == 'size' ) {
			    $sortsize = ( isset($_GET) && $_GET['sortsize'] != '' ) ? $_GET['sortsize'] : ''; 
				if($sortsize == "s"){
					$args = array(
						'post_type'      => 'portfolio',
						'posts_per_page' => -1,
						'meta_key' => 'park_size',
						'orderby' => 'meta_value_num',
						'order' => 'ASC'
					);
				}
				else{
					$args = array(
						'post_type'      => 'portfolio',
						'posts_per_page' => -1,
						'meta_key' => 'park_size',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					);
				}
				
			    $query = new WP_Query( $args );
			    while ( $query->have_posts() ) : $query->the_post();
		    		$state = wp_get_post_terms(get_the_ID(), 'portfolio_category');
			    	$park_name = wp_get_post_terms(get_the_ID(), 'chronology1');
			    	$size = wp_get_post_terms(get_the_ID(), 'size');
		?>
				<div class="col-md-4">
					<div class="inner-div">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('320x150'); ?></a>
						<div class="port-meta down">
							<a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
							<span><?php echo $size[0]->name; ?></span>
						</div>
					</div>
				</div>
		<?php
			endwhile; wp_reset_postdata();
		}
		elseif ( $filter == 'chronology' ) {
			$args = array(
				'taxonomy' => 'chronology1',
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => true,
			);
			$terms = get_terms($args);
			if ( !empty($terms) && count($terms) > 0 ) {
				foreach ($terms as $term) {
					$args = array(
				        'post_type'      => 'portfolio',
				        'posts_per_page' => 9,
				        'orderby' => 'title',
		    			'order'   => 'ASC',
		    			'tax_query' => array(
				            array(
				                'taxonomy' => 'chronology1',
				                'field' => 'term_id',
				                'terms' => $term->term_id,
				            )
				        )
				    );
			    	$query = new WP_Query( $args );
			    	while ( $query->have_posts() ) : $query->the_post();
			    		$state = wp_get_post_terms(get_the_ID(), 'portfolio_category');
			    		$chronology = wp_get_post_terms(get_the_ID(), 'chronology1');
		?>
				<div class="col-md-4">
					<div class="inner-div">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('320x150'); ?></a>
						<div class="port-meta down">
							<a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
							<span><?php echo $chronology[0]->name; ?></span>
						</div>
					</div>
				</div>
		<?php
					endwhile; wp_reset_postdata();
				} 
			}	
		}
		else {
			$args = array(
		        'post_type'      => 'portfolio',
		        'posts_per_page' => 9,
  				'paged' => $paged
    		);
    		$query = new WP_Query( $args );
			    while ( $query->have_posts() ) : $query->the_post();
			    	$state = wp_get_post_terms(get_the_ID(), 'portfolio_category');
			?>
			<div class="col-md-4">
				<div class="inner-div">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('320x150'); ?></a>
					<div class="port-meta down">
						<a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
						<span>
							<?php 
								$str_arr = [];
								foreach($state as $value){
									if($value->name != "State"){
										array_push($str_arr, $value->name);
										//echo $value->name.",   "; 
									}										
								}		
								echo implode(',   ',$str_arr);							
							?>
						</span>
					</div>
				</div>
			</div>
			<?php
			    endwhile; wp_reset_postdata();
			}
			?>
			<div class="col-md-12">
				<div class="pagination">
				    <?php 
				        echo paginate_links( array(
				            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				            'total'        => $query->max_num_pages,
				            'current'      => max( 1, get_query_var( 'paged' ) ),
				            'format'       => '?paged=%#%',
				            'show_all'     => true,
				            'type'         => 'plain',
				            'end_size'     => 2,
				            'mid_size'     => 1,
				            'prev_next'    => false,
				            'prev_text'    => false,
				            'next_text'    => false,
				            'add_args'     => false,
				            'add_fragment' => '',
				        ) );
				    ?>
				</div>
			</div>
		
	</div>
</div>


<?php 
get_footer();
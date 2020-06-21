<?php
	if ( !post_password_required() ) {
		get_header();
		the_post();
		?>

		<?php
		$page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no';
		$portfolio_title_conditional = ((gt3_option('portfolio_title_conditional') == '1' || gt3_option('portfolio_title_conditional') == true)) ? 'yes' : 'no';

		if ($page_title_conditional == 'yes' && $portfolio_title_conditional == 'no') {
            $page_title_conditional = 'no';
        }
        $id = gt3_get_queried_object_id();
        if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
            $page_sub_title = rwmb_meta('mb_page_sub_title');
            $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional');
            if ($mb_page_title_conditional == 'no') {
            	$page_title_conditional = 'no';
            }

			$mb_portfolio_title_conditional = rwmb_meta('mb_portfolio_title_conditional');
			if ($mb_portfolio_title_conditional == 'no') {
				$portfolio_title_conditional = 'no';
			}
        }

		$layout = gt3_option('portfolio_single_sidebar_layout');
		$sidebar = gt3_option('portfolio_single_sidebar_def');
		if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
			$mb_layout = rwmb_meta('mb_page_sidebar_layout');
			if (!empty($mb_layout) && $mb_layout != 'default') {
				$layout = $mb_layout;
				$sidebar = rwmb_meta('mb_page_sidebar_def');
			}
		}
		$column = 12;
		if ( ($layout == 'left' || $layout == 'right') && is_active_sidebar( $sidebar )  ) {
			$column = 8;
		}else{
			$sidebar = '';
		}
		if ($sidebar == '') {
		    $layout = 'none';
		}
		$row_class = 'sidebar_'.esc_attr($layout);
		?>

		<div class="container container-<?php echo esc_attr($row_class); ?>">
			<div class="row <?php echo esc_attr($row_class); ?>">
				<div class="content-container span<?php echo (int)$column; ?>">
					<section id='main_content'>

						
                        <?php
						if ( has_post_thumbnail() ) { ?>
							<div class="portfolio_featured_image">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>
						<?php } ?>

						<div class="custom_portfolio_section">
						
							<?php if(get_field('p_description_1')) { ?>
								<div class="description description_1">
									<div class="inner"><?php echo get_field('p_description_1') ?></div>
								</div>
							<?php } ?>
							<?php if(get_field('p_description_2')) { ?>
								<div class="description description_2">
									<div class="inner"><?php echo get_field('p_description_2') ?></div>
								</div>
							<?php } ?>

								<div class="description description_3">
									<div class="inner">
									
<div class="texanomies_list">

	<div class="item">
		
		<div>
			<?php 
			$terms2 = wp_get_post_terms( $post->ID, 'portfolio_category'); 
			if($terms2){
				echo '<b>States: </b>';
			}
			foreach($terms2 as $term) {
				if($term->name != "State"){
					echo '   <span>' . $term->name . '</a>';
				}
				 
			} 
			?>
		</div>
	</div>
	<div class="item">
		<div>
			<?php 
			$terms2 = wp_get_post_terms( $post->ID, 'size'); 
			if($terms2){
					echo '<b>Size: </b>';
			}
			foreach($terms2 as $term) {
				echo '<span>' . $term->name . '</span>'; 
			} 
			?>
		</div>
	</div>
	<div class="item">								
		
		<div class="chronology chronology_1">
		<?php 
		$terms2 = wp_get_post_terms( $post->ID, 'chronology1'); 
		if($terms2){
			echo '<b>Chronology: </b>';
		}
		foreach($terms2 as $term) {
			echo $term->name; 
		} 
		?>
		</div>
		
<?php if(get_field('p_chronology_2')) { ?>
   <div class="chronology chronology_2">
      <div class="inner_c"><?php echo get_field('p_chronology_2') ?></div>
   </div>
<?php } ?>

<?php if(get_field('p_chronology_3')) { ?>
   <div class="chronology chronology_3">
      <div class="inner_c"><?php echo get_field('p_chronology_3') ?></div>
   </div>
<?php } ?>

<?php if(get_field('p_chronology_4')) { ?>
   <div class="chronology chronology_4">
      <div class="inner_c"><?php echo get_field('p_chronology_4') ?></div>
   </div>
<?php } ?>

<?php if(get_field('p_chronology_5')) { ?>
   <div class="chronology chronology_5">
      <div class="inner_c"><?php echo get_field('p_chronology_5') ?></div>
   </div>
<?php } ?>

<?php if(get_field('p_chronology_6')) { ?>
   <div class="chronology chronology_6">
      <div class="inner_c"><?php echo get_field('p_chronology_6') ?></div>
   </div>
<?php } ?>
		
		
		
	</div>
</div>


									
									</div>
								</div>
						 </div>
	
						
						
						<?php
							if ($page_title_conditional == 'no' && $portfolio_title_conditional != 'no') {
								echo "<div class='container'><h1 class='portfolio_title_content'>";
									echo esc_html(get_the_title());
								echo "</h1></div>";
							}
							
							the_content(esc_html__('Read more!', 'oni'));
							wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'oni') . ': ', 'after' => '</div>'));
							if (gt3_option("page_comments") == "1") { ?>
								<div class="clear"></div>
								<?php comments_template(); ?>
							<?php } ?>
							<div style="text-align:center; margin-bottom: 30px; ">
						<?php 
						if ( get_field('gallery_button_name') != '' ) {

                                    echo '<a class="gallery-custom-btn" href="'. get_field('gallery_button_link') .'">'. get_field('gallery_button_name') .'</a>';
                                    }
                        ?>
                    </div>
                    
					</section>
				</div>
				<?php
					if ($layout == 'left' || $layout == 'right') {
						echo '<div class="sidebar-container span'.(12 - (int)$column).'">';
						if (is_active_sidebar( $sidebar )) {
							echo "<aside class='sidebar'>";
							dynamic_sidebar( $sidebar );
							echo "</aside>";
						}
						echo "</div>";
					}
				?>
			</div>

		</div>
		<?php
		// prev next links
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		if (($prev_post || $next_post)) { ?>
			<div class="single_prev_next_posts">
				<div class="container">
					<?php
					if (!empty($prev_post)) {
						previous_post_link('<div class="fleft">%link</div>', '<span class="gt3_post_navi" data-title="' . esc_attr($prev_post->post_title) . '">' . esc_html__('Prev', 'oni') . '</span>');
					}
					echo '<a href="'. esc_js("javascript:history.back()") .'" class="port_back2grid"><span class="port_back2grid_box1"></span><span class="port_back2grid_box2"></span><span class="port_back2grid_box3"></span><span class="port_back2grid_box4"></span></a>';
					if (!empty($next_post)) {
						next_post_link('<div class="fright">%link</div>', '<span class="gt3_post_navi" data-title="' . esc_attr($next_post->post_title) . '">' . esc_html__('Next', 'oni') . '</span>');
					}
					?>
				</div>
			</div>
		<?php }
		get_footer();
	} else {
		get_header();
		?>
		<div class="pp_block">
			<div class="container_vertical_wrapper">
				<div class="container a-center pp_container">
					<h1><?php echo esc_html__('Password Protected', 'oni'); ?></h1>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<?php
		get_footer();
	} ?>
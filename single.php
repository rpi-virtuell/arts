<?php get_header(); ?>

<div id="content-area">
	<div class="container clearfix">
		<div id="main-area">
		
			
			<?php
			$category_query_args = get_the_category(get_the_ID());
//								var_dump(get_the_category( get_the_ID() ));
			$catID = $category_query_args[0]->cat_ID;
//								$category_query = new WP_Query('cat='.$catID);
			$args = array(
				'post_type' => 'project',
				'cat' => $catID,
				'posts_per_page' => (int) et_get_option('vertex_home_projects_num', 8),
			);
			$et_projects_query = new WP_Query(apply_filters('et_home_projects_query_args', $args));
			$projectlink = '';
			if ($et_projects_query->have_posts()) :
				while ($et_projects_query->have_posts()) : $et_projects_query->the_post();
				 $projectlink .= '<h3 class="title"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
				endwhile;
			endif;
			?>

			<?php while (have_posts()) : the_post(); ?>
				<?php if (et_get_option('vertex_integration_single_bottom') <> '' && et_get_option('vertex_integrate_singlebottom_enable') == 'on') echo(et_get_option('vertex_integration_single_bottom')); ?>

				<article class="entry clearfix">
					
					<div class="single-thumbnail">
						<div class="single-thumbnail-title">
							<h1><?php the_title() ?></h1>
						</div>
						<?php
						$thumb = '';
						$width = (int) apply_filters('et_single_project_image_width', 9999);
						$height = (int) apply_filters('et_single_project_image_height', 9999);
						$classtext = 'et-main-project-thumb';
						$titletext = get_the_title();
						$thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'SingleProject');
						$thumb = $thumbnail["thumb"];

						?>
						<a href="<?php echo $thumb;?>" class="fancybox thumbnail-button"><?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?></a>
						<?php
						echo '<br/><hr style="border:0;border-top: 1px solid #ddd">Zu finden in den Ausstellungen:</span><br/>';
						echo $projectlink;
						wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'Vertex'), 'after' => '</div>'));
						
						if (et_get_option('vertex_468_enable') == 'on') {
							if (et_get_option('vertex_468_adsense') <> '')
								echo( et_get_option('vertex_468_adsense') );
							else {
								?>
								<a href="<?php echo esc_url(et_get_option('vertex_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('vertex_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
								<?php
							}
						}
						?>
					</div>
					
					<div class="single-content">
					<?php
						the_content();
					?>
					<?php if (et_get_option('vertex_integration_single_bottom') <> '' && et_get_option('vertex_integrate_singlebottom_enable') == 'on') echo(et_get_option('vertex_integration_single_bottom')); ?>

					<?php
					if (comments_open() && 'on' == et_get_option('vertex_show_postcomments', 'on'))
						comments_template('', true);
					?>	
					</div>
					
				</article> <!-- .entry -->

				
			<?php endwhile; ?>
			<div class="single-sidebar">
				<?php get_sidebar(); ?>
			</div>	
		</div> <!-- #main-area -->
		
	</div> <!-- .container -->
	
</div> <!-- #content-area -->


<?php get_footer(); ?>
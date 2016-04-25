<?php
/*
  Template Name: Ausstellungen
 */
?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize(get_post_meta(get_the_ID(), 'et_ptemplate_settings', true));

$fullwidth = isset($et_ptemplate_settings['et_fullwidthpage']) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;

$et_ptemplate_blogstyle = isset($et_ptemplate_settings['et_ptemplate_blogstyle']) ? (bool) $et_ptemplate_settings['et_ptemplate_blogstyle'] : false;

$et_ptemplate_showthumb = isset($et_ptemplate_settings['et_ptemplate_showthumb']) ? (bool) $et_ptemplate_settings['et_ptemplate_showthumb'] : false;

$blog_cats = isset($et_ptemplate_settings['et_ptemplate_blogcats']) ? (array) array_map('intval', $et_ptemplate_settings['et_ptemplate_blogcats']) : array();
$et_ptemplate_blog_perpage = isset($et_ptemplate_settings['et_ptemplate_blog_perpage']) ? (int) $et_ptemplate_settings['et_ptemplate_blog_perpage'] : 10;
?>
<?php get_header(); ?>

<div id="content-area">
	<div class="container clearfix<?php if ($fullwidth) echo ' fullwidth'; ?>">
		<div id="main-area">

			<?php while (have_posts()) : the_post(); ?>

				<article class="entry clearfix">
					<?php
					the_content();

					wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'Vertex'), 'after' => '</div>'));
					?>

					<div id="et_pt_blog" class="responsive clearfix">
						<?php
						$cat_query = '';
						if (!empty($blog_cats))
							$cat_query = '&cat=' . implode(",", $blog_cats);
						else
							echo '<!-- blog category is not selected -->';
						?>
						<?php
						$et_paged = get_query_var('paged') ? get_query_var('paged') : 1;
						?>
	<?php query_posts("posts_per_page=$et_ptemplate_blog_perpage&" . $cat_query.'&paged='.$et_paged.'&post_type=project'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<div class="et_pt_blogentry clearfix">
									<h2 class="et_pt_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

									<!--<p class="et_pt_blogmeta"><?php esc_html_e('Posted', 'Vertex'); ?> <?php esc_html_e('by', 'Vertex'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on', 'Vertex'); ?> <?php the_time(get_option('vertex_date_format')) ?> <?php esc_html_e('in', 'Vertex'); ?> <?php the_category(', ') ?> | <?php comments_popup_link(esc_html__('0 comments', 'Vertex'), esc_html__('1 comment', 'Vertex'), '% ' . esc_html__('comments', 'Vertex')); ?></p>-->
									<hr/>
									<?php
									$thumb = '';
									$width = 184;
									$height = 184;
									$classtext = '';
									$titletext = get_the_title();

									$thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext);
									$thumb = $thumbnail["thumb"];
									?>

									<?php if ($thumb <> '' && !$et_ptemplate_showthumb) { ?>
										<div class="et_pt_thumb alignleft">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
											<a href="<?php the_permalink(); ?>"><span class="overlay"></span></a>
										</div> <!-- end .thumb -->
									<?php }; ?>

									<?php if (!$et_ptemplate_blogstyle) { ?>
										<p><?php truncate_post(550); ?></p>
										<a href="<?php the_permalink(); ?>" class="readmore"><span><?php esc_html_e('read more', 'Vertex'); ?></span></a>
									<?php } else { ?>
										<?php
										global $more;
										$more = 0;
										?>
										<?php the_content(); ?>
									<?php } ?>
								</div> <!-- end .et_pt_blogentry -->

								<?php endwhile; ?>
							<div class="page-nav clearfix">
							<?php if (function_exists('wp_pagenavi')) {
								wp_pagenavi();
							} else {
								?>
			<?php get_template_part('includes/navigation'); ?>
		<?php } ?>
							</div> <!-- end .entry -->
				<?php else : ?>
		<?php get_template_part('includes/no-results'); ?>
	<?php endif;
	wp_reset_query(); ?>
					</div> <!-- end #et_pt_blog -->

				</article> <!-- .entry -->

<?php endwhile; ?>

		</div> <!-- #main-area -->

<?php if (!$fullwidth) get_sidebar(); ?>
	</div> <!-- .container -->
</div> <!-- #content-area -->

<?php get_footer(); ?>
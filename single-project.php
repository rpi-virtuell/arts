<?php
if (isset($wp_query->query_vars['format']) && $wp_query->query_vars['format'] == 'slideshow'):
	
	while (have_posts()) : the_post();
		$custom_media_url = get_post_meta(get_the_ID(), 'custom_media_url', true);
		
	
		if( empty($custom_media_url) ){
			
			$thumbnail = get_the_post_thumbnail( get_the_id() );
			preg_match('# src="([^"]*)"#', $thumbnail, $match);
			$custom_media_url = $match[1];
		}
		
		
	?>
	<html><head>
		
		<meta charset="utf-8">

		<title><?php the_Title(); ?></title>

		<link rel="stylesheet" href="/wp-content/themes/arts/revealjs/css/reveal.css">
				
		<style>
		body {
			background-color:black;
			color:white;
			font-family: "Arial" !important;
		}
		.header{
			position:absolute;
			top: 21px;
			left: 12px;
			transform:rotate(90deg);
			transform-origin:left;
			z-index:10000;
			
		}
		
		div.back {
			border-left: 10px solid transparent;
			border-right: 10px solid transparent;
			border-top: 20px solid #ffc800;
			height: 0;
			margin-left: 2px;
			margin-top: 4px;
			position: absolute;
			width: 0;
			z-index:10000;
		}
		
		.license{
			color:#aaa;
		}
		a{
			color:#fff;
			text-decoration:none;
		}
		a:hover{
			text-decoration:underline;
		}
		.slides{
			/*top:48% !important;			*/
		}
		.reveal .controls div {
			opacity:.3;
		}
		
		.reveal .controls div.navigate-left{
			border-right-color: #666666 !important;
		}
		.reveal .controls div.navigate-right{
			border-left-color: #666666 !important;
		}
		.reveal .controls div.navigate-up{
			border-bottom-color: #666666 !important;
		}
		.reveal .controls div.navigate-down{
			border-top-color: #666666 !important;
		}
		
		.mysection{
			height:100% !important;
			
		}
		
		.title {
			background-color: red;
			display: inline-flex;
			float: left;
			width: 400px;
			opacity:.9;
			margin-top: 14% !important;
			
		}
		
		h1{
			text-align:left;
			margin:20px 20px 20px 30px !important;
			font-size: 30px  !important;
			
		}
		h1 a{
			color:white;
		}
		a h2{
			text-align:left;
			margin-bottom:10px !important;
			font-size: 30px  !important;
			color:#bbb;
		}
		.content a{
			color:green;
		}
		.content a:hover{
			color:red;
		}
		
		.content {
			display:inline-flex !important;
			float: right;
			width: 30%;
			height:95% !important;
			opacity:.9 !important;
			margin-right:0px !important;
		}
		.inner-content {
			overflow-y: auto;
			overflow-x: hidden;
			margin:auto auto 0!important;
			background-color:#fff;
			height:50%;
			border-top: 20px solid #fff !important;
			border-bottom: 20px solid #fff !important;
		}
		.content-area {
			text-align:left;
			color:black;
			font-size: 13px !important;
			line-height: 1.3 !important;
			padding:0 20px !important;
		}
		strong {
			font-weight:bold !important;
		}
		
		.hinfuehrungsTitel{
			text-align:left;
			margin-bottom:10px !important;
			font-size: 24px  !important;
			color:#999;
			font-weight:100 !important;
		}
		
		</style>
	</head>
	<body>
		
	
		<a href="<?php echo get_permalink();?>"><div class="back"></div></a>
		<div class="header">
			<a href="<?php echo get_permalink();?>">
				<?php the_Title();?> &bull; 
			</a>
			<span class="license">
				Mit freundllicher Unterstützung der 
				<a href="/">Artothek</a> in rpi-virtuell
			</span>
		</div>
		<div class="reveal">
			<div class="slides">
			<section class="mysection" style="background:url(<?php echo $custom_media_url; ?>) no-repeat center;background-size:contain ; border:0px dashed #999;">
				<section class="mysection" data-transition="zoom">
					<div class="title"  style="background-color:#000; opacity:1">
						<h1>
							<a href="<?php echo get_permalink(); ?>"><?php the_title();?></a>
						</h1>
					</div>
					<div class="content fragment fade-in">
						<div class="inner-content">
							<div class="content-area">
								<?php the_Content(); ?>
							</div>
						</div>
					</div>
				</section>
						
			</section>
					
		<?php
		$category_query_args = get_the_category(get_the_ID());
		$catID = $category_query_args[0]->cat_ID;
		$category_query = new WP_Query(array('cat' => $catID, 'posts_per_page' => -1));
		$content_array = array();
		if ($category_query->have_posts()) : 
			while ($category_query->have_posts()): 
				$category_query->the_post();
				$titletext = get_the_title();
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				
				$checkcontent =  strip_tags($content);
				$checkcontent =  trim($checkcontent);
				$has_content = empty($checkcontent)? false: true; 
				
				$thumbnail = get_the_post_thumbnail( get_the_id());
				$exists = preg_match('# src="([^"]*)"#', $thumbnail, $match);
				if($exists){
					$url = $match[1];
				}else{
					$url = '';
				}
				$slide = '
					<section class="mysection" style="background:url('.$url.') no-repeat center;background-size:contain ; border:0px dashed #999;	">
						<section class="mysection" >
						</section>
						<section class="mysection" data-transition="zoom">
							<div class="title">
								<h1>
									<a href="'.get_permalink().'" target="_blank">'.get_the_Title().'</a>
								</h1>
							</div>';
							if( $has_content ){
								$slide .= '
								<div class="content fragment fade-in">
									<div class="inner-content">
										<div class="content-area">'.$content.'</div>
									</div>
								</div>';
							}
							$slide .= '
						</section>
					</section>';
				$content_array[] = $slide;
			endwhile;
		endif;
	endwhile; 
	echo implode ("\n",$content_array);
	?>
			</div>
		</div>
		<script src="/wp-content/themes/arts/revealjs/js/reveal.js"></script>

			<script>

				// Full list of configuration options available at:
				// https://github.com/hakimel/reveal.js#configuration
				Reveal.initialize({
					margin: 0.0,
					transition: 'slide', // none/fade/slide/convex/concave/zoom
					transitionSpeed:"slow",
					history:true,
					backgroundTransition:true,
					mouseWheel:false,
					minScale:1.1
				});

		</script>
	</body></html>
	<?php
	die();
endif;

?>
<?php get_header(); ?>

<div id="content-area">
	<div class="container clearfix fullwidth">
		<div id="main-area">
			
			<?php
			$viewerlink = false;
			while (have_posts()) : the_post();
				?>
				<div class="ausstellungstitelzeile">
					
						
					<div class="artothek-ausstellung-beitragsbild strut-show">
							<?php
								$slideshowlink = '<a href="'.get_permalink() .'format/slideshow" target="_self" title="Diashow"><div class="play">&nbsp;</div></a>';
							//	echo $slideshowlink;
							?>
						
					</div>
					
					<div class="ausstellungstitel">
						<?php the_title(); ?>
					</div>
					
				</div>
				<div id="loader">Bilder der Ausstellung werden geladen ... Das kann etwas dauern.</div>
				<?php

				$authorInfo = get_post_meta(get_the_ID(), 'author-information', true);
				$authorInfo = apply_filters('the_content', $authorInfo);
				$authorInfo = str_replace(']]>', ']]&gt;', $authorInfo);


				$categories = get_the_terms(get_the_ID(), 'project_category');

				if (!$categories)
					$categories = array();

				$categories = array_values($categories);

				foreach (array_keys($categories) as $key) {
					_make_cat_compat($categories[$key]);
				}

				

				wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'Vertex'), 'after' => '</div>'));
				?>
				<!--</article>  .entry -->
				
				<div id="projects-vertical-scrollbar">
					<div id="author-info">
						<div>
							<?php echo $slideshowlink; ?>
							<div style="font-size:2.22rem; margin:20px 0 0 10px;padding-top:30px;" class="strut-show">
								<a href="<?php echo get_permalink() .'format/slideshow'; ?>">
									Vollbild Diashow
								</a>
							</div>
						</div>
						<div style="clear:both; width;auto"></div>
						<hr>
						<?php 
							the_content();
							echo $authorInfo;
						?>
						
					</div>
					<div id="info-link">
						<div>
							<div class="fold-open"></div><div class="fold-closed"></div><a id="toggleinfo">Einführende Informationen</a>
						</div>
					</div>
					
					<ul id="horiz_container_outer">
						<li id="horiz_container_inner">
							<ul id="horiz_container">
								<?php 
								$category_query_args = get_the_category(get_the_ID());
								$catID = $category_query_args[0]->cat_ID;
								$category_query = new WP_Query(array('cat' => $catID, 'posts_per_page' => -1));
								$content_array = array();
								if ($category_query->have_posts()) : 
									while ($category_query->have_posts()) 
										: $category_query->the_post();
										get_template_part('includes/artothek-template');
										$content = apply_filters( 'the_content', get_the_content() );
										$content = str_replace( ']]>', ']]&gt;', $content );
										$content_array[] = '
											<div id="info'.get_the_ID().'" style="display:none" class="artothek-ausstellung-item-data">
												<div class="artothek-ausstellung-item-modal">
													<div class="infoheader">
														<div class="close" style="float:right">x</div>
														<h3>'.get_the_Title().'</h3>
														<hr>
													</div>
													<div class="infocontent">
														<a class="fancybox" href="">
														'.get_the_post_thumbnail().'</a>
														'.$content.'<br><br>
														<hr>Permalink: <a href="'.get_permalink().'">'.get_permalink().'</a><br><br>
													</div>
												</div>
											</div>
										';
									endwhile;
								endif;
								?>
							</ul>
							<div style="width:100%; clear:both; height:1px;"></div>
						</li>		
					</ul>	
				</div>
				
			<?php endwhile; ?>
		</div> <!-- #main-area -->
	</div> <!-- .container -->
<?php echo implode("\n",$content_array);?>
</div> <!-- #content-area -->
<div class="iconlicense"><a href=http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">ICON CC BY 3.0</a><a href="http://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a></div>
<?php get_footer(); ?>

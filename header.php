<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php elegant_titles(); ?></title>
		<?php elegant_description(); ?>
		<?php elegant_keywords(); ?>
		<?php elegant_canonical(); ?>

		<?php do_action('et_head_meta'); ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php $template_directory_uri = get_template_directory_uri(); ?>
		<!--[if lt IE 9]>
		<script src="<?php echo esc_url($template_directory_uri . '/js/html5.js"'); ?>" type="text/javascript"></script>
		<![endif]-->

		<script type="text/javascript">
			document.documentElement.className = 'js';


		</script>

		<?php wp_head(); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/js/demo_style.css" />
		<link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great|Artifika|Chelsea+Market|Goudy+Bookletter+1911' rel='stylesheet' type='text/css'>
		<script>

			/*touchscreen detection*/
			function is_touch_device() {
				return false;
				return ( 'ontouchstart' in window // works on most browsers 
					|| (navigator.MaxTouchPoints > 0)
					|| (navigator.msMaxTouchPoints > 0) );
			};
			/*operating system detection*/
			function getOs(){
				
				var OSName="Unknown OS";
				if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
				else if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
				else if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
				else if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

				console.log('Betriebssystem: '+OSName);

				return OSName;
			}
			function is_Mac(){
				if(getOs() == "MacOS")
					return true;
				return false;
			}


			/* set Position of many ELements in relationship with the  Client Window height */
			setHeight = function() {
				
				
				var height = jQuery(window).height();
				var width = jQuery(window).width();
				var content_height = height - jQuery('#top-menu').height() 
											- jQuery('#main-footer').height() 
											- jQuery('#wpadminbar').height() - 70;
				
				
				var maxSize = 450;
				var iconSize = height / 10 + 10;
				var m;
				
				jQuery('.artothek-ausstellung-item-modal').css({ 'width': (width-80)+'px','height': (height-150)+'px' }) ;
				jQuery('.artothek-ausstellung-item-modal div.infoheader').css({ 'width': (width-80)+'px' }) ;
				
				if(is_touch_device()){
					content_height = width - (width * 5/100);
					if(content_height>height) content_height=height;
				}
				
				if( height < width ){ //landscape

					
				
					m=(height/width*20)+5;
					
					if( height/width < 5/9 ){
						m += 10;													
					}
					if( height/width < 4/9 ){
						m += 10;													
					} 
					
					maxSize = content_height - ((content_height * m/100)-10);
					
					
					
				}else{
					maxSize = width - 45;
				}
				
				
				jQuery('.artothek-ausstellung-item-content').attr('style', 'height:' + maxSize + 'px;' + 'width:' + maxSize + 'px;' + 'line-height:' + (content_height - 0) + 'px;margin-right:');
				jQuery('.artothek-ausstellung-item-content img').attr('style', 'max-height:' + maxSize + 'px;' + 'max-width:' + maxSize + 'px;');
				jQuery('.artothek-ausstellung').attr('style', 'font-size:' + (iconSize) + '%;');
				
				if(is_touch_device() ||  height > width ){
				
					jQuery('#projects-vertical-scrollbar').attr('style', 'max-width:1100px; margin:0 auto; display:block;opacity:1;');
					
					
				}else{
					
					jQuery('#projects-vertical-scrollbar').attr('style', 'min-height:' + content_height + 'px;');
					jQuery('#horiz_container_outer').attr('style', 'height:' + content_height + 'px;');
					jQuery('#toggleinfo').css({'margin-left':(Math.round(content_height/25)*-1)+ 'px','width':(content_height-(content_height/5))+'px'} );
							
				
					jQuery('#author-info').attr('style', 'height:' + (content_height-20)+ 'px;');
					jQuery('#projects-vertical-scrollbar').show().animate({'opacity':1},1500);
					jQuery( '#toggleinfo').show();
				}
				
				
			}

			/* SETUP Horizontal Scrolling, Clickevents and Fancybox */
			jQuery(document).ready(function() {
				var height = jQuery(window).height();
				var width = jQuery(window).width();
				if( height < width ){
					
					jQuery( '#horiz_container_outer').mousewheel(function(e, delta) {
						
						var trac = 	40;
						
						if(is_Mac()){
							trac = 	2;
						}
						
						this.scrollLeft -= (delta * trac);
						e.preventDefault();
						this.scrollTop = 0;
					});
				}
				
				if(is_touch_device() ){
					
					jQuery( '.artothek-ausstellung-beitragsbild').remove();
					jQuery( '#horiz_container').removeAttr("style");
					jQuery('#horiz_container li').removeAttr("style");
					jQuery('#author-info').removeAttr("style");
					jQuery('#projects-vertical-scrollbar').removeAttr("style");
					jQuery('#horiz_container_outer').removeAttr("style");
				
				
					
				}else{
				
					
					
					function openInfo(){
						
							jQuery( '#author-info').animate({'margin-left':'0px'},1000,'swing',function(){
									jQuery('#info-link .fold-closed').hide();
									jQuery('#info-link .fold-open').show();
							 });
							// jQuery('#toggleinfo').css({'color':'darkblue', 'background-color':'#B2D5EA'});					
							 jQuery('.fold-open').css({'boder-color':'#B2D5EA'});
					}
						
					function closeInfo(){
							jQuery( '#author-info').animate({'margin-left':'-560px'},1000,'swing',function(){
									jQuery('#info-link .fold-open').hide();
									jQuery('#info-link .fold-closed').show();
							 });
							 jQuery('.fold-open').css({'boder-color':'#ddd'});					
					}
					
					jQuery( '#info-link a').toggle(closeInfo,openInfo);
					jQuery( '.fold-closed').click(openInfo);
					jQuery( '.fold-open').click(closeInfo);
					
					
				}
				
				jQuery( '.artothek-icon').click(function(e){
					
					jQuery('#info'+this.rel).easyModal();
					
					return false;
					
				});
				
				jQuery( '.infocontent a.fancybox').each(function(i,o){
					if(jQuery(o).children().length>0)
						o.href=jQuery(o).children()[0].src;
				});
				
			});

			/* LOADING FIRST TIME */
			jQuery(window).load(function() {
				setHeight();
				jQuery('#loader').remove();
				jQuery(window).resize(function() {
					setHeight();
				});
			});	
			

		</script>
	</head>
	<body <?php body_class(); ?>>
		<header id="main-header">
			<div id="top-menu">
				<div class="container clearfix">

					<?php
					/* COLORED HEADER */
					$colors = array(
						'#fcff00',
						'#00ff48',
						'#ff0000',
						'#6fafff',
						'#ffae00',
						'#ff00de',
						'#00f0ff',
						'#b55100',
						'#ffffff',
					);
					
					
					$site_name = get_bloginfo('name', 'Ars Sacre');
					
					if($site_name != 'Artothek') shuffle ($colors);
					
					
					$letters = str_split($site_name);
					$site_name = '';$i=0;
					foreach($letters as $l){
						
						$site_name .= '<span style="color:'.
							$colors[$i].
							'">'.$l.'</span>';
						
						$i++;if($i>8) $i =0;
					}
					
                   
					if ('on' === et_get_option('vertex_use_site_name', 'on')) {
						$site_logo = $site_name;
					} else {
						$logo = ( $user_logo = et_get_option('vertex_logo') ) && '' != $user_logo ? $user_logo : $template_directory_uri . '/images/logo.png';

						$site_logo = sprintf('<img src="%s" alt="%s" />', esc_attr($logo), esc_attr($site_name)
						);
					}
					?>
					<div id="et-logo">
						
						<?php
						printf('<a href="%s">%s</a>', esc_url(home_url('/')), $site_logo
						);
						?>
						
					</div>
					<nav>
						<?php
						$menuClass = 'nav';
						if ('on' == et_get_option('vertex_disable_toptier'))
							$menuClass .= ' et_disable_top_tier';
						$primaryNav = '';

						$primaryNav = wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false));

						if ('' == $primaryNav) :
							?>
							
							<ul class="<?php echo esc_attr($menuClass); ?>">
								<?php wp_page_menu( array( 'show_home' => 'Startseite', 'sort_column' => 'menu_order' ) ); ?>
							</ul>
							<?php
						else :
							echo( $primaryNav );
						endif;
						?>
					</nav>

					<?php do_action('et_header_top'); ?>
				</div> <!-- .container -->
			</div> <!-- #top-menu -->

			<!--		<div id="top-area" class="et-animation">
						<div class="container clearfix">
			
			<?php
			$heading = $tagline = '';

			if (is_home()) {
				$heading = sprintf('<a href="%s">%s</a>', esc_url(home_url('/')), $site_logo
				);
				$tagline = get_bloginfo('description');
			} elseif (is_tag()) {
				$heading = esc_html__('Posts Tagged &quot;', 'Vertex') . single_tag_title('', false) . '&quot;';
			} elseif (is_day()) {
				$heading = esc_html__('Posts made in', 'Vertex') . ' ' . get_the_time('F jS, Y');
			} elseif (is_month()) {
				$heading = esc_html__('Posts made in', 'Vertex') . ' ' . get_the_time('F, Y');
			} elseif (is_year()) {
				$heading = esc_html__('Posts made in', 'Vertex') . ' ' . get_the_time('Y');
			} elseif (is_search()) {
				$heading = esc_html__('Search results for', 'Vertex') . ' ' . get_search_query();
			} elseif (is_category()) {
				$heading = single_cat_title('', false);
				$tagline = category_description();
			} elseif (is_author()) {
				global $wp_query;
				$curauth = $wp_query->get_queried_object();
				$heading = esc_html__('Posts by ', 'Vertex') . $curauth->nickname;
			} elseif (is_page() || is_single()) {
				$heading = get_the_title();
				if (is_page()) {
					$tagline = get_post_meta(get_the_ID(), 'Description', true) ? get_post_meta(get_the_ID(), 'Description', true) : '';
				} else {
					the_post();
					ob_start();
					et_vertex_post_meta();
					$tagline = ob_get_clean();
					rewind_posts();
				}
			} elseif (is_tax()) {
				$heading = single_term_title('', false);
				$tagline = term_description();
			} elseif (is_post_type_archive()) {
				$heading = post_type_archive_title('', false);
			}
			?>
			<?php if ('' !== $heading) : ?>
																												<h1<?php if (!is_home()) echo ' class="title"'; ?>><?php echo $heading; ?></h1>
			<?php endif; ?>
			
			<?php if ('' !== $tagline) : ?>
																												<p class="tagline"><?php echo $tagline; ?></p>
			<?php endif; ?>
			
							<br />
			
			<?php if (is_home()) et_vertex_action_button(); ?>
						</div>  .container 
					</div>  #top-area -->
		</header> <!-- #main-header -->
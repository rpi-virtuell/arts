<?php

define('VIEWER_META_BOX_ID', 'dia-show');
define('VIEWER_MEDIA_META_KEY', 'custom_media_url');


/**** THEME SETUP ****/
function setup_artothektheme(){

	function create_page($new_page_title,$new_slug='',$new_page_content='',$new_page_template = ''){
		$page_check = get_page_by_title($new_page_title) ;
		$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_name' => 	$new_slug,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'page_template' => $new_page_template,
		);
		if(!isset($page_check->ID)){
			if(!empty($new_slug)) {
				$page_check = get_page_by_path($new_slug);
				if(isset($page_check->ID)){
					return null;
				}
			}
			return wp_insert_post($new_page); //new ID
		}
		return null;
	}
	function manipulate_page_menu_items($items) {
		
		$items = preg_replace( '#(<li[^>]*><a href="'.home_url( '/' ).'editor/">[^<]*<\/a><\/li>)#' , '' ,$items);
		$items = preg_replace( '#(<li[^>]*><a href="'.home_url( '/' ).'iframe/">[^<]*<\/a><\/li>)#' , '' ,$items);
		$items = preg_replace( '#(<li[^>]*><a href="'.home_url( '/' ).'">[^<]*<\/a><\/li>)#' , '<li class="home"><a href="' . home_url( '/' ) . '">Startseite</a></li>' ,$items);
		return $items;
	}
	add_filter( 'wp_page_menu', 'manipulate_page_menu_items' );
	
	function manipulate_nav_menu_items($items) {
		
		$items = preg_replace( '#(<li[^>]*><a href="'.home_url( '/' ).'editor/">[^<]*<\/a><\/li>)#' , '' ,$items);
		$items = preg_replace( '#(<li[^>]*><a href="'.home_url( '/' ).'iframe/">[^<]*<\/a><\/li>)#' , '' ,$items);
				
		$newlink = '<li class="home"><a href="' . home_url( '/' ) . '">Startseite</a></li>';
		return $newlink . $items;
		
	}
	add_filter( 'wp_nav_menu_items', 'manipulate_nav_menu_items' );
	
	if (isset($_GET['activated']) && is_admin()){
		create_page('Ausstellungen','uebersicht','<!-- diese Seite wurde beim Setup des Themes erzeugt -->','page-projects.php');
		
		
		$et_vertex = 'a:87:{s:11:"vertex_logo";s:0:"";s:14:"vertex_favicon";s:0:"";s:22:"vertex_header_bg_image";s:0:"";s:17:"vertex_grab_image";s:5:"false";s:20:"vertex_use_site_name";s:2:"on";s:17:"vertex_blog_style";s:5:"false";s:25:"vertex_action_button_text";s:0:"";s:24:"vertex_action_button_url";s:0:"";s:19:"vertex_catnum_posts";i:6;s:23:"vertex_archivenum_posts";i:5;s:22:"vertex_searchnum_posts";i:5;s:19:"vertex_tagnum_posts";i:5;s:18:"vertex_date_format";s:5:"d.m.Y";s:18:"vertex_use_excerpt";s:5:"false";s:28:"vertex_responsive_shortcodes";s:2:"on";s:35:"vertex_gf_enable_all_character_sets";s:5:"false";s:27:"vertex_animations_on_scroll";s:2:"on";s:17:"vertex_custom_css";s:0:"";s:20:"vertex_show_projects";s:2:"on";s:24:"vertex_show_testimonials";s:5:"false";s:16:"vertex_show_team";s:5:"false";s:26:"vertex_home_projects_title";s:13:"Ausstellungen";s:32:"vertex_home_projects_description";s:21:"Zur Ansicht anklicken";s:26:"vertex_home_featured_title";s:0:"";s:32:"vertex_home_featured_description";s:0:"";s:30:"vertex_home_testimonials_title";s:0:"";s:36:"vertex_home_testimonials_description";s:0:"";s:22:"vertex_home_team_title";s:0:"";s:28:"vertex_home_team_description";s:0:"";s:24:"vertex_home_projects_num";i:12;s:21:"vertex_homepage_posts";i:12;s:15:"vertex_featured";s:5:"false";s:19:"vertex_featured_num";i:3;s:21:"vertex_feat_posts_cat";i:1;s:16:"vertex_use_pages";s:5:"false";s:18:"vertex_slider_auto";s:5:"false";s:23:"vertex_slider_autospeed";i:7000;s:23:"vertex_enable_dropdowns";s:2:"on";s:16:"vertex_home_link";s:2:"on";s:17:"vertex_sort_pages";s:10:"post_title";s:17:"vertex_order_page";s:3:"asc";s:24:"vertex_tiers_shown_pages";i:3;s:34:"vertex_enable_dropdowns_categories";s:2:"on";s:23:"vertex_categories_empty";s:2:"on";s:29:"vertex_tiers_shown_categories";i:3;s:15:"vertex_sort_cat";s:4:"name";s:16:"vertex_order_cat";s:3:"asc";s:22:"vertex_disable_toptier";s:5:"false";s:16:"vertex_postinfo2";a:3:{i:0;s:6:"author";i:1;s:4:"date";i:2;s:8:"comments";}s:24:"vertex_show_postcomments";s:2:"on";s:25:"vertex_show_pagescomments";s:5:"false";s:16:"vertex_postinfo1";a:2:{i:0;s:6:"author";i:1;s:4:"date";}s:27:"vertex_show_avatar_on_posts";s:2:"on";s:21:"vertex_seo_home_title";s:5:"false";s:27:"vertex_seo_home_description";s:5:"false";s:24:"vertex_seo_home_keywords";s:5:"false";s:25:"vertex_seo_home_canonical";s:5:"false";s:25:"vertex_seo_home_titletext";s:0:"";s:31:"vertex_seo_home_descriptiontext";s:0:"";s:28:"vertex_seo_home_keywordstext";s:0:"";s:20:"vertex_seo_home_type";s:27:"BlogName | Blog description";s:24:"vertex_seo_home_separate";s:3:" | ";s:23:"vertex_seo_single_title";s:5:"false";s:29:"vertex_seo_single_description";s:5:"false";s:26:"vertex_seo_single_keywords";s:5:"false";s:27:"vertex_seo_single_canonical";s:5:"false";s:29:"vertex_seo_single_field_title";s:9:"seo_title";s:35:"vertex_seo_single_field_description";s:15:"seo_description";s:32:"vertex_seo_single_field_keywords";s:12:"seo_keywords";s:22:"vertex_seo_single_type";s:21:"Post title | BlogName";s:26:"vertex_seo_single_separate";s:3:" | ";s:26:"vertex_seo_index_canonical";s:5:"false";s:28:"vertex_seo_index_description";s:5:"false";s:21:"vertex_seo_index_type";s:24:"Category name | BlogName";s:25:"vertex_seo_index_separate";s:3:" | ";s:30:"vertex_integrate_header_enable";s:2:"on";s:28:"vertex_integrate_body_enable";s:2:"on";s:33:"vertex_integrate_singletop_enable";s:2:"on";s:36:"vertex_integrate_singlebottom_enable";s:2:"on";s:23:"vertex_integration_head";s:0:"";s:23:"vertex_integration_body";s:0:"";s:29:"vertex_integration_single_top";s:0:"";s:32:"vertex_integration_single_bottom";s:0:"";s:17:"vertex_468_enable";s:5:"false";s:16:"vertex_468_image";s:0:"";s:14:"vertex_468_url";s:0:"";s:18:"vertex_468_adsense";s:0:"";}';
		update_option( 'et_vertex', unserialize($et_vertex) );
		$et_vertex_trans = 'O:8:"stdClass":1:{s:12:"last_checked";i:1426414871;}';
		update_option( '_site_transient_et_update_themes', unserialize($et_vertex_trans) );
		$trans='O:8:"stdClass":4:{s:12:"last_checked";i:1426414870;s:7:"checked";a:5:{s:6:"Vertex";s:3:"1.7";s:4:"arts";s:5:"1.0.0";s:13:"twentyfifteen";s:3:"1.0";s:14:"twentyfourteen";s:3:"1.3";s:14:"twentythirteen";s:3:"1.4";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}';
		update_option( '_site_transient_update_themes', unserialize($trans) );
		
	}
	
			
	add_filter( 'rewrite_rules_array','my_insert_rewrite_rules' );
	add_filter( 'query_vars','my_insert_query_vars' );
	add_action( 'wp_loaded','my_flush_rules' );
	// flush_rules() if our rules are not yet included
	function my_flush_rules(){
		$rules = get_option( 'rewrite_rules' );

		if ( ! isset( $rules['project/([^/]*)/format/([^/]*)/?$'] ) ) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
	}

	// Adding a new rule for alternative template e.g. ~/format/slideshow
	function my_insert_rewrite_rules( $rules ){
		$newrules = array();
		$newrules['project/([^/]*)/format/([^/]*)/?$'] = 'index.php?pagename=project&project=$matches[1]&format=$matches[2]';
		return $newrules + $rules;
	}

	// Adding the format to the allowed queryvars so that WP can recognize it
	function my_insert_query_vars( $vars ){
		array_push($vars, 'format');
		return $vars;
	}
	
	
	/* clean backend *****************************/

	//remove unnecessary templates from Vertex
	function artothek_remove_page_templates( $templates ) {
		
		unset( $templates['page-gallery.php'] );
		unset( $templates['page-template-portfolio.php'] );
		unset( $templates['page-template-team.php'] );
		unset( $templates['page-contact.php'] );
		unset( $templates['page-blog.php'] );
		unset( $templates['page-full.php'] );
		unset( $templates['page-search.php'] );
		unset( $templates['page-sitemap.php'] );
		unset( $templates['page-login.php'] );
						
		
		
		return $templates;
	}
	add_filter( 'theme_page_templates', 'artothek_remove_page_templates' );

	//remove unnecessary metaboxes from Vertex	
	function artothek_remove_meta_box(){
		remove_meta_box( 'et_ptemplate_meta' ,'page', 'side');
		remove_meta_box( 'et_ptemplate_meta' ,'post', 'normal');
		remove_meta_box( 'et_settings_meta_box' ,'project', 'normal');
		remove_meta_box( 'et_settings_meta_box' ,'page', 'normal');
		remove_meta_box( 'et_settings_meta_box' ,'post', 'normal');
		
	}
	add_action( 'do_meta_boxes', 'artothek_remove_meta_box' ,999);

	//remove_filter('site_transient_update_themes', 'et_add_themes_to_update_notification', 999);
	// remove specific theme from WordPress Core Updates
	add_filter('site_transient_update_themes', 'ndt_remove_theme_from_transient_update_themes', 1);

	function ndt_remove_theme_from_transient_update_themes( $transient ) {

		if ( is_object( $transient ) && isset( $transient->checked ) && isset( $transient->response ) ) {

			$checked = $transient->checked;
			$response = $transient->response;

					// replace nictitate slug by your theme slug
			if ( isset( $checked['Vertex'] ) ) {
				unset( $checked['Vertex'] );
				$transient->checked = $checked;
			}

			if ( isset( $response['Vertex'] ) ) {
				unset( $response['Vertex'] );
				$transient->response = $response;
			}

			return $transient;

		}

		return $transient;

	}
	
	function adjust_the_wp_menu() {
	  $page = remove_submenu_page( 'themes.php', 'core_functions.php' );
	  // $page[0] is the menu title
	  // $page[1] is the minimum level or capability required
	  // $page[2] is the URL to the item's file
	}
	add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
	
	function my_child_theme_setup() {
		load_child_theme_textdomain('Vertex', get_stylesheet_directory() . '/lang');
	}
	add_action('after_setup_theme', 'my_child_theme_setup');
	
	add_theme_support('post-thumbnails');
	
	
}

setup_artothektheme();


//add scripts to admin head section
function enqueue_additional_scripts() {

	global $typenow;
	if ($typenow == 'project') {
		wp_register_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"');
		wp_enqueue_script('jquery-ui');
		
		wp_enqueue_media();
		// Registers and enqueues the required javascript.
		wp_register_script('meta-box-image', get_stylesheet_directory_uri() . '/js/meta-box-image.js', array('jquery'));
		wp_localize_script('meta-box-image', 'meta_image', array(
			'title' => __('meta-imageUpload an Image', 'prfx-textdomain'),
			'button' => __('Use this image', 'prfx-textdomain'),
				)
		);
		wp_enqueue_script('meta-box-image');
		
	}
}
add_action('admin_enqueue_scripts', 'enqueue_additional_scripts');


//add scripts to the head section
function artothek_include_scripts(){
		wp_register_script('jquery-ui', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '1.0', true);
		wp_register_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"');
		wp_enqueue_script('jquery-ui');
		
		wp_dequeue_script( 'vertex-custom-script', get_template_directory_uri() . '/js/custom.js' );
		
		wp_register_script('arscustom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('arscustom');
		
		wp_register_script('modal', get_stylesheet_directory_uri() . '/js/jquery.easyModal.js');
		wp_enqueue_script('modal');

}
add_action('wp_enqueue_scripts', 'artothek_include_scripts',99);


//register custom post_type project for Ausstellungen
function register_postype_project(){
	
	global $wp_post_types;
	
	if(! function_exists('unregister_post_type')){
		function unregister_post_type( $post_type ) {
			global $wp_post_types;
			if ( isset( $wp_post_types[ $post_type ] ) ) {
				unset( $wp_post_types[ $post_type ] );
				return true;
			}
			return false;
		}
			
	}
	
	unregister_post_type('team-member');
	unregister_post_type('testimonial');
	unregister_post_type('project');
	
	$labels = array(
		'name' => _x('Ausstellungen', 'project type general name', 'Vertex'),
		'singular_name' => _x('Ausstellung', 'project type singular name', 'Vertex'),
		'add_new' => _x('Anlegen', 'project item', 'Vertex'),
		'add_new_item' => __('Ausstellung anlegen', 'Vertex'),
		'edit_item' => __('Ausstellung editieren', 'Vertex'),
		'new_item' => __('Neue Ausstellung', 'Vertex'),
		'all_items' => __('Alle Ausstellungen', 'Vertex'),
		'view_item' => __('Ausstellung ansehen', 'Vertex'),
		'search_items' => __('In Ausstellungen suchen', 'Vertex'),
		'not_found' => __('Nothing found', 'Vertex'),
		'not_found_in_trash' => __('Nothing found in Trash', 'Vertex'),
		'menu_name' => __('Ausstellungen', 'Vertex'),
		'parent_item_colon' => '',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'can_export' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => apply_filters('et_project_posttype_rewrite_args', array(
			'feeds' => true,
			'slug' => 'project',
			'with_front' => false,
		)),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 3,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
	);

	//Korrektur der Namen
	register_post_type('project', apply_filters('et_project_posttype_args', $args));

	register_taxonomy_for_object_type('category', 'project');
	register_taxonomy('project_category', array());
	
}
add_action('init', 'register_postype_project', 99);

/*
 * Initialisieren der Metabox
 */

function register_artothek_meta_box() {


	add_meta_box(VIEWER_META_BOX_ID, __('Diashow', 'artothek'), 'render_artothek_meta_box', 'project', 'side');
}

add_action('admin_init', 'register_artothek_meta_box');



if (!function_exists('artothek_resize_image')) {

	function artothek_resize_image($thumb, $new_width, $new_height, $crop) {
		if (is_ssl())
			$thumb = preg_replace('#^http://#', 'https://', $thumb);
		$info = pathinfo($thumb);
		$ext = $info['extension'];
		$name = wp_basename($thumb, ".$ext");
		$is_jpeg = false;
		$site_uri = apply_filters('artothek_resize_image_site_uri', site_url());
		$site_dir = apply_filters('artothek_resize_image_site_dir', ABSPATH);

		// If multisite, not the main site, WordPress version < 3.5 or ms-files rewriting is enabled ( not the fresh WordPress installation, updated from the 3.4 version )
		if (is_multisite() && !is_main_site() && (!function_exists('wp_get_mime_types') || get_site_option('ms_files_rewriting') )) {
			//Get main site url on multisite installation

			switch_to_blog(1);
			$site_uri = site_url();
			restore_current_blog();
		}

		if ('jpeg' == $ext) {
			$ext = 'jpg';
			$name = preg_replace('#.jpeg$#', '', $name);
			$is_jpeg = true;
		}

		$suffix = "{$new_width}x{$new_height}";

		$destination_dir = '' != get_option('artothek_images_temp_folder') ? 
			preg_replace('#\/\/#', '/', get_option('artothek_images_temp_folder')) : null;

		$matches = apply_filters('artothek_resize_image_site_dir', array(), $site_dir);
		if (!empty($matches)) {
			preg_match('#' . $matches[1] . '$#', $site_uri, $site_uri_matches);
			if (!empty($site_uri_matches)) {
				$site_uri = str_replace($matches[1], '', $site_uri);
				$site_uri = preg_replace('#/$#', '', $site_uri);
				$site_dir = str_replace($matches[1], '', $site_dir);
				$site_dir = preg_replace('#\\\/$#', '', $site_dir);
			}
		}

		#get local name for use in file_exists() and get_imagesize() functions
		$localfile = str_replace(apply_filters('artothek_resize_image_localfile', $site_uri, $site_dir, et_multisite_thumbnail($thumb)), $site_dir, et_multisite_thumbnail($thumb));

		$add_to_suffix = '';
		if (file_exists($localfile))
			$add_to_suffix = filesize($localfile) . '_';

		#prepend image filesize to be able to use images with the same filename
		$suffix = $add_to_suffix . $suffix;
		$destfilename_attributes = '-' . $suffix . '.' . $ext;

		$checkfilename = ( '' != $destination_dir && null !== $destination_dir ) ? path_join($destination_dir, $name) : path_join(dirname($localfile), $name);
		$checkfilename .= $destfilename_attributes;

		if ($is_jpeg)
			$checkfilename = preg_replace('#.jpeg$#', '.jpg', $checkfilename);

		$uploads_dir = wp_upload_dir();
		$uploads_dir['basedir'] = preg_replace('#\/\/#', '/', $uploads_dir['basedir']);

		if (null !== $destination_dir && '' != $destination_dir && apply_filters('artothek_enable_uploads_detection', true)) {
			$site_dir = trailingslashit(preg_replace('#\/\/#', '/', $uploads_dir['basedir']));
			$site_uri = trailingslashit($uploads_dir['baseurl']);
		}

		#check if we have an image with specified width and height

		if (file_exists($checkfilename))
			return str_replace($site_dir, trailingslashit($site_uri), $checkfilename);

		$size = @getimagesize($localfile);
		if (!$size)
			return new WP_Error('invalid_image_path', __('Image doesn\'t exist'), $thumb);
		list($orig_width, $orig_height, $orig_type) = $size;

		#check if we're resizing the image to smaller dimensions
		if ($orig_width > $new_width || $orig_height > $new_height) {
			if ($orig_width < $new_width || $orig_height < $new_height) {
				#don't resize image if new dimensions > than its original ones
				if ($orig_width < $new_width)
					$new_width = $orig_width;
				if ($orig_height < $new_height)
					$new_height = $orig_height;

				#regenerate suffix and appended attributes in case we changed new width or new height dimensions
				$suffix = "{$add_to_suffix}{$new_width}x{$new_height}";
				$destfilename_attributes = '-' . $suffix . '.' . $ext;

				$checkfilename = ( '' != $destination_dir && null !== $destination_dir ) ? path_join($destination_dir, $name) : path_join(dirname($localfile), $name);
				$checkfilename .= $destfilename_attributes;

				#check if we have an image with new calculated width and height parameters
				if (file_exists($checkfilename))
					return str_replace($site_dir, trailingslashit($site_uri), $checkfilename);
			}

			#we didn't find the image in cache, resizing is done here
			if (!function_exists('wp_get_image_editor')) {
				// compatibility with versions of WordPress prior to 3.5.
				$result = image_resize($localfile, $new_width, $new_height, $crop, $suffix, $destination_dir);
			} else {
				$et_image_editor = wp_get_image_editor($localfile);

				if (!is_wp_error($et_image_editor)) {
					$et_image_editor->resize($new_width, $new_height, $crop);

					// generate correct file name/path
					$et_new_image_name = $et_image_editor->generate_filename($suffix, $destination_dir);

					do_action('artothek_resize_image_before_save', $et_image_editor, $et_new_image_name);

					$et_image_editor->save($et_new_image_name);

					// assign new image path
					$result = $et_new_image_name;
				} else {
					// assign a WP_ERROR ( WP_Image_Editor instance wasn't created properly )
					$result = $et_image_editor;
				}
			}

			if (!is_wp_error($result)) {
				// transform local image path into URI

				if ($is_jpeg)
					$thumb = preg_replace('#.jpeg$#', '.jpg', $thumb);

				$site_dir = str_replace('\\', '/', $site_dir);
				$result = str_replace('\\', '/', $result);
				$result = str_replace('//', '/', $result);
				$result = str_replace($site_dir, trailingslashit($site_uri), $result);
			}

			#returns resized image path or WP_Error ( if something went wrong during resizing )
			return $result;
		}

		#returns unmodified image, for example in case if the user is trying to resize 800x600px to 1920x1080px image
		return $thumb;
	}

}



/*
 * Render artothek meta box
 */


if (!function_exists('render_artothek_meta_box')) :

	function render_artothek_meta_box() {
		global $post;
		
		$postId = $post->ID;
		
		?>
		<style>
			.artothek-metabox{
				display: inline-table;
				width: 100%;
			}
	
			.artothek-metabox label{
					display: block;
					float: left;
					width: 200px;
			}
			.artothek-metabox input, .artothek-metabox input.button{
					display: block;
					width: 250px;
			}
			.artothek-metabox strut-preview{
					display: block;
					width: 250px;
					border: 1px solid #eee;
			}
			
		
		</style>
		<p class="artothek-metabox">
			Normalerweise wird als erstes Bild in der Diashow das Beitragsbild angezeigt. Alternativ kannst du hier ein anderes Bild wählen (zum Beispiel Ausstellungsposter).<br><hr>
			
			<label for="meta-image" class="prfx-row-title"><?php _e('Pfad', 'artothek') ?></label>
			<input type="text" name="<?= VIEWER_MEDIA_META_KEY ?>" id="<?= VIEWER_MEDIA_META_KEY ?>" value="<?php echo get_post_meta($post->ID, VIEWER_MEDIA_META_KEY, true); ?>" />
			<input type="button" id="meta-image-button" class="button" value="<?php _e('Bild wählen', 'prfx-textdomain') ?>" />
			<div class="strut-preview">
				<?php if (get_post_meta($post->ID, VIEWER_MEDIA_META_KEY, true) ): ?>
				<img id="custom_media_image" src="<?php echo get_post_meta($post->ID, VIEWER_MEDIA_META_KEY, true); ?>" width="100%"/>
				<?php endif ;?>
			</div>
			
		
		</p>
		<?php
		
	}

endif;


function save_artothek_meta($post_id) {

	// Checks for input and saves if needed
	if (isset($_POST['custom_media_url']))
		update_post_meta($post_id, 'custom_media_url', $_POST['custom_media_url']);
}
add_action('save_post', 'save_artothek_meta', 0);

<?php
/**
 * Theme Functions
 *
 * This file is used by WordPress to initialize the theme.
 * Thematic is designed to be used as a theme framework and this file should not be modified.
 * You should use a Child Theme to make your customizations. A sample child theme is provided
 * as an example in root directory of this theme. You can move it into the wp-content/themes to
 * enable activation of the child theme. <br>
 *
 * Reference:  {@link http://codex.wordpress.org/Child_Themes Codex: Child Themes}
 * 
 * @package Datse Multimedia Base 
 * @subpackage ThemeInit
 */


/**
 * Registers action hook: thematic_init 
 * 
 * @since Thematic 1.0
 */
function thematic_init() {
	do_action('thematic_init');
}


/**
 * thematic_theme_setup & childtheme_override_theme_setup
 *
 * Override: childtheme_override_theme_setup
 *
 * @since Thematic 1.0
 */
if ( function_exists('childtheme_override_theme_setup') ) {
	/**
	 * @ignore
	 */
	function thematic_theme_setup() {
		childtheme_override_theme_setup();
	}
} else {
	/**
	 * thematic_theme_setup
	 *
	 * @todo review for impact of deprecations on child themes & fix comment blocks?
	 * @since Thematic 1.0?
	 */
	function thematic_theme_setup() {
		global $content_width;

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 *
		 * Used to set the width of images and content. Should be equal to the width the theme
		 * is designed for, generally via the style.css stylesheet.
		 *
		 * @since Thematic 1.0
		 */
		if ( !isset($content_width) )
			$content_width = 540;
   
		// Legacy feed links handling - @to be removed eventually
		// If you add theme support for thematic_legacy_feedlinks, thematic_show_rss() and thematic_show_commentsrss() are used instead of add_theme_support( 'automatic-feed-links' )
		if ( defined( 'THEMATIC_COMPATIBLE_FEEDLINKS' ) ) add_theme_support( 'thematic_legacy_feedlinks' );

		// Legacy comments handling for pages, archives and links
		// If you add_theme_support for thematic_legacy_comment_handling, Thematic will only show comments on pages with a key/value of "comments"
		if ( defined( 'THEMATIC_COMPATIBLE_COMMENT_HANDLING' ) ) add_theme_support( 'thematic_legacy_comment_handling' );

		// Legacy body class handling - @to be removed eventually
		// If you add theme support for thematic_legacy_body_class, Thematic will use thematic_body_class instead of body_class()
		if ( defined( 'THEMATIC_COMPATIBLE_BODY_CLASS' ) ) add_theme_support( 'thematic_legacy_body_class' );

		// Legacy post class handling - @to be removed eventually
		// If you add theme support for thematic_legacy_post_class, Thematic will use thematic_body_class instead of post_class()
		if ( defined( 'THEMATIC_COMPATIBLE_POST_CLASS' ) ) add_theme_support( 'thematic_legacy_post_class' );

		// Legacy post class handling - @to be removed eventually
		// If you add theme support for thematic_legacy_post_class, Thematic will use it's legacy comment form
		if ( defined( 'THEMATIC_COMPATIBLE_COMMENT_FORM' ) ) add_theme_support( 'thematic_legacy_comment_form' );

		// Check for MultiSite
		define( 'THEMATIC_MB', is_multisite()  );

		// Create the feedlinks
		if ( ! current_theme_supports( 'thematic_legacy_feedlinks' ) )
 			add_theme_support( 'automatic-feed-links' );
 
		if ( apply_filters( 'thematic_post_thumbs', true ) )
			add_theme_support( 'post-thumbnails' );
 
		add_theme_support( 'thematic_superfish' );

		// Add support for the title-tag
		add_theme_support( 'title-tag' );

		// Path constants
		define( 'THEMATIC_LIB',  get_template_directory() .  '/library' );

		// Create Theme Options Page
		require_once ( THEMATIC_LIB . '/extensions/theme-options.php' );
		
		// Load legacy functions
		require_once ( THEMATIC_LIB . '/legacy/deprecated.php' );

		// Load widgets
		require_once ( THEMATIC_LIB . '/extensions/widgets.php' );

		// Add Custom Header Support
		$defaults = array(
			'default-image'          => get_template_directory_uri() . '/images/header.jpg',
			'width'                  => 940,
			'height'                 => 200,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => true,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $defaults );

		$header_images = array (
			'header' => array (
				'url' => get_template_directory_uri() . '/images/header.jpg',
				'thumbnail_url' => get_template_directory_uri() . '/images/header-thumb.jpg',
				'description' => 'header',
			),
			'header1' => array (
                                'url' => get_template_directory_uri() . '/images/header1.jpg',
                                'thumbnail_url' => get_template_directory_uri() . '/images/header1-thumb.jpg',
                                'description' => 'header4',
                        ),
			'header2' => array (
                                'url' => get_template_directory_uri() . '/images/header2.jpg',
                                'thumbnail_url' => get_template_directory_uri() . '/images/header2-thumb.jpg',
                                'description' => 'header2',
                        ),
			'header3' => array (
                                'url' => get_template_directory_uri() . '/images/header3.jpg',
                                'thumbnail_url' => get_template_directory_uri() . '/images/header3-thumb.jpg',
                                'description' => 'header3',
                        ),
		);
		register_default_headers( $header_images );

		// Load custom header extensions
		require_once ( THEMATIC_LIB . '/extensions/header-extensions.php' );

		// Load custom content filters
		require_once ( THEMATIC_LIB . '/extensions/content-extensions.php' );

		// Load custom Comments filters
		require_once ( THEMATIC_LIB . '/extensions/comments-extensions.php' );

		// Load custom discussion filters
		require_once ( THEMATIC_LIB . '/extensions/discussion-extensions.php' );

		// Load custom Widgets
		require_once ( THEMATIC_LIB . '/extensions/widgets-extensions.php' );

		// Load the Comments Template functions and callbacks
		require_once ( THEMATIC_LIB . '/extensions/discussion.php' );

		// Load custom sidebar hooks
		require_once ( THEMATIC_LIB . '/extensions/sidebar-extensions.php' );

		// Load custom footer hooks
		require_once ( THEMATIC_LIB . '/extensions/footer-extensions.php' );

		// Add Dynamic Contextual Semantic Classes
		require_once ( THEMATIC_LIB . '/extensions/dynamic-classes.php' );

		// Need a little help from our helper functions
		require_once ( THEMATIC_LIB . '/extensions/helpers.php' );

		// Load shortcodes
		require_once ( THEMATIC_LIB . '/extensions/shortcodes.php' );

		// Adds filters for the description/meta content in archive templates
		add_filter( 'archive_meta', 'wptexturize' );
		add_filter( 'archive_meta', 'convert_smilies' );
		add_filter( 'archive_meta', 'convert_chars' );
		add_filter( 'archive_meta', 'wpautop' );

		// Remove the WordPress Generator - via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
		function thematic_remove_generators() {
 			return '';
 		}
 		if ( apply_filters( 'thematic_hide_generators', true ) )
 			add_filter( 'the_generator', 'thematic_remove_generators' );
 
		// Translate, if applicable
		load_theme_textdomain( 'datse-multimedia-base', THEMATIC_LIB . '/languages' );

		$locale = get_locale();
		$locale_file = THEMATIC_LIB . "/languages/$locale.php";
		if ( is_readable($locale_file) )
			require_once ($locale_file);
	}
}

add_action('after_setup_theme', 'thematic_theme_setup', 10);


/**
 * Registers action hook: thematic_child_init
 * 
 * @since Thematic 1.0
 */
function thematic_child_init() {
	do_action('thematic_child_init');
}

add_action('after_setup_theme', 'thematic_child_init', 20);


if ( function_exists('childtheme_override_init_navmenu') )  {
	/**
	 * @ignore
	 */
	 function thematic_init_navmenu() {
    	childtheme_override_init_navmenu();
    }
} else {
	/**
	 * Register primary nav menu
	 * 
	 * Override: childtheme_override_init_navmenu
	 * Filter: thematic_primary_menu_id
	 * Filter: thematic_primary_menu_name
	 */
    function thematic_init_navmenu() {
		register_nav_menu( apply_filters('thematic_primary_menu_id', 'primary-menu'), apply_filters('thematic_primary_menu_name', __( 'Primary Menu', 'datse-multimedia-base' ) ) );
	}
}
add_action('init', 'thematic_init_navmenu');

/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('event_row_actions', 'rd_duplicate_post_link', 10, 2);

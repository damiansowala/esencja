<?php
	add_filter('acf/settings/show_admin', '__return_false');
	/* ========================================================================================================================
	Custome Class
	======================================================================================================================== */
	 class BsWp {
    	public static function print_a( $a ) {
    		print( '<pre>' );
    		print_r( $a, true );
    		print( '</pre>' );
    	}
    	public static function get_template_parts( $parts = array() ) {
    		foreach( $parts as $part ) {
    			get_template_part( $part );
    		};
    	}
    	public static function get_page_id_from_path( $path ) {
    		$page = get_page_by_path( $path );
    		if( $page ) {
    			return $page->ID;
    		} else {
    			return null;
    		};
    	}
    	public static function add_slug_to_body_class( $classes ) {
    		global $post;
    		if( is_home() ) {			
    			$key = array_search( 'blog', $classes );
    			if($key > -1) {
    				unset( $classes[$key] );
    			};
    		} elseif( is_page() ) {
    			$classes[] = sanitize_html_class( $post->post_name );
    		} elseif(is_singular()) {
    			$classes[] = sanitize_html_class( $post->post_name );
    		};
    		return $classes;
    	}
    	public static function get_category_id( $cat_name ){
    		$term = get_term_by( 'name', $cat_name, 'category' );
    		return $term->term_id;
    	}
	}
	/* ========================================================================================================================
	Required external files
	======================================================================================================================== */
	class bs4Navwalker extends Walker_Nav_Menu
	{
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"dropdown-menu\">\n";
		}
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</div>\n";
		}
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names .= ' nav-item';
			if (in_array('menu-item-has-children', $classes)) {
				$class_names .= ' dropdown';
			}
			if (in_array('current-menu-item', $classes)) {
				$class_names .= ' active';
			}
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			if ($depth === 0) {
				$output .= $indent . '<li' . $id . $class_names .'>';
			}
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			if ($depth === 0) {
				$atts['class'] = 'nav-link';
			}
			if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
				$atts['class']       .= ' dropdown-toggle';
				$atts['data-toggle']  = 'dropdown';
			}
			if ($depth > 0) {
				$atts['class'] = 'dropdown-item';
			}
			if (in_array('current-menu-item', $item->classes)) {
				$atts['class'] .= ' active';
			}
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if (isset($args->has_children) && $depth === 0) {
				$output .= "</li>\n";
			}
		}
	}
	/* ========================================================================================================================
	Required external files
	======================================================================================================================== */
	/* ========================================================================================================================
	Add html 5 support to wordpress elements
	======================================================================================================================== */
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	/* ========================================================================================================================
	Theme specific settings
	======================================================================================================================== */
	add_theme_support('post-thumbnails');
	//add_image_size( 'name', width, height, crop true|false );
	register_nav_menus(array('top_menu' => 'Top Menu'));
	/* ========================================================================================================================
	Actions and Filters
	======================================================================================================================== */
	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );
	add_filter( 'body_class', array( 'BsWp', 'add_slug_to_body_class' ) );
	/* ========================================================================================================================
	Custom Post Types - include custom post types and taxonomies here e.g.
	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	======================================================================================================================== */
	/* ========================================================================================================================
	Scripts
	======================================================================================================================== */
	function bootstrap_script_init() {
		wp_register_script( 'bs-bundle', get_template_directory_uri().'/js/bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), '4.3.1', true );
		wp_enqueue_script( 'bs-bundle' );
		wp_register_script( 'bootstrap-js', get_template_directory_uri().'/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
		wp_enqueue_script( 'bootstrap-js' );
		wp_register_script( 'lightbox-js', get_template_directory_uri().'/js/lightbox.min.js', array( 'jquery' ), '2.11.1', true );
		wp_enqueue_script( 'lightbox-js' );
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ), '0.0.1', true );
		wp_enqueue_script( 'site' );
		wp_register_style( 'bootstrap-css', get_stylesheet_directory_uri().'/css/bootstrap/bootstrap.min.css', '', array(), 'screen' );
		wp_enqueue_style( 'bootstrap-css' );
		wp_register_style( 'lightbox-css', get_stylesheet_directory_uri().'/css/lightbox.min.css', '', array(), 'screen' );
		wp_enqueue_style( 'lightbox-css' );
		wp_register_style( 'fontawesome-css', get_stylesheet_directory_uri().'/css/fontawesome/all.min.css', '', array(), 'screen' );
		wp_enqueue_style( 'fontawesome-css' );
		wp_register_style( 'animate-css', get_stylesheet_directory_uri().'/css/animate.min.css', '', array(), 'screen' );
		wp_enqueue_style( 'animate-css' );
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', array(), 'screen' );
		wp_enqueue_style( 'screen' );
	}
	/* ========================================================================================================================
	Security & cleanup wp admin
	======================================================================================================================== */
	//remove wp version
	function theme_remove_version() {
	return '';
	}
	add_filter('the_generator', 'theme_remove_version');
	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;
		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}
	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);
	// Remove default Dashboard widgets
	function disable_default_dashboard_widgets() {
		//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
		remove_meta_box('dashboard_activity', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');
	remove_action('welcome_panel', 'wp_welcome_panel');
	/* ========================================================================================================================
	Custom login
	======================================================================================================================== */
	// Add custom css
	function my_custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css" />';
	}
	add_action('login_head', 'my_custom_login');
	// Link the logo to the home of our website
	function my_login_logo_url() {
		return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );
	// Change the title text 
	function my_login_logo_url_title() {
		return 'project name';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );
	/* ========================================================================================================================
	Comments
	======================================================================================================================== */
	function gt_get_post_view() {
		$count = get_post_meta( get_the_ID(), 'post_views_count', true );
		if($count == 1){
			return "$count wyświetlenie";
		} elseif($count >= 2){
			return "$count wyświetlenia";
		} elseif($count >= 5){
			return "$count wyświetleń";
		}

		return "$count views";
	}
	function gt_set_post_view() {
		$key = 'post_views_count';
		$post_id = get_the_ID();
		$count = (int) get_post_meta( $post_id, $key, true );
		$count++;
		update_post_meta( $post_id, $key, $count );
	}
	function gt_posts_column_views( $columns ) {
		$columns['post_views'] = 'Views';
		return $columns;
	}
	function gt_posts_custom_column_views( $column ) {
		if ( $column === 'post_views') {
			echo gt_get_post_view();
		}
	}
	add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
	add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );
	/* ========================================================================================================================
	Comments
	======================================================================================================================== */


	function bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
	if ( $comment->comment_approved == '1' ): ?>
<li class="media">
    <span class="media-body">
        <span class="media-heading">
            <h4><?php comment_author_link() ?></h4>
            <p> <a href="<?php comment_author_email() ?>"><?php comment_author_email() ?></a></p>
            <p> <a href="<?php comment_author_url() ?>"><?php comment_author_url() ?></a></p>
        </span>
        <div class="media-content">
            <?php comment_text() ?>
        </div>
    </span>
    <?php endif;
			}
	function isy_get_the_archive_title() {
		if ( is_category() ) {
			$title = __( 'Category Archives: ', 'isy' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
		} elseif ( is_tag() ) {
			$title = __( 'Tag Archives: ', 'isy' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
		} elseif ( is_author() ) {
			$title = __( 'Author Archives: ', 'isy' ) . '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
		} elseif ( is_year() ) {
			$title = __( 'Yearly Archives: ', 'isy' ) . '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'isy' ) ) . '</span>';
		} elseif ( is_month() ) {
			$title = __( 'Monthly Archives: ', 'isy' ) . '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'isy' ) ) . '</span>';
		} elseif ( is_day() ) {
			$title = __( 'Daily Archives: ', 'isy' ) . '<span class="page-description">' . get_the_date() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = __( 'Post Type Archives: ', 'isy' ) . '<span class="page-description">' . post_type_archive_title( '', false ) . '</span>';
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: %s: Taxonomy singular name */
			$title = sprintf( esc_html__( '%s Archives:', 'isy' ), $tax->labels->singular_name );
		} else {
			$title = __( 'Archives:', 'isy' );
		}
		return $title;
	}
	add_filter( 'get_the_archive_title', 'isy_get_the_archive_title' );
	/* ========================================================================================================================
	Display Logo Theme
	======================================================================================================================== */
	function logo(){
		$custom_logo_id = get_theme_mod( 'custom_logo' );
    	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
            echo '<img class="img-fluid" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
        } else {
            echo '<h1 class="header">'. get_bloginfo( 'name' ) .'</h1>';
        }
	}
	function themename_custom_logo_setup() {
		$defaults = array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
	/* ========================================================================================================================
	Custome Post Type
	======================================================================================================================== */
	function createRealizationsPostType() {
		register_post_type('realizacje',
			array(
				'labels' => array(
					'name' => esc_attr__('Projekty i realizacje'),
					'singular_name' => esc_attr__('Projekty i realizacje'),
					'add_new' => esc_attr__('Dodaj'),
					'add_new_item'   => esc_attr__('Dodaj')
				),
				'public' => true,
				'has_archive' => false,
				'rewrite' => array('slug' => 'realizacje'),
				'supports' => array('title', 'thumbnail', 'revisions'),
			)
		);
	}
	add_action('init', 'createRealizationsPostType');
	/* ========================================================================================================================
	GET post function
	======================================================================================================================== */
	function getPostBlog() {
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 3
		);
		return  $args;
	}
	function getAllPostBlog() {
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
		);
		return  $args;
	}
	function getLastPostBlog() {
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 5
		);
		return  $args;
	}
	function getRealizations() {
		$args = array(
			'post_type' => 'realizacje',
			'post_status' => 'publish',
			'posts_per_page' => 4
		);
		return  $args;
	}
	function getFullRealizations() {
		$args = array(
			'post_type' => 'realizacje',
			'post_status' => 'publish',
			'posts_per_page' => -1
		);
		return  $args;
	}
	function getCategory(){
		$args = array(
			'orderby'    => 'name',
			'show_count' => true,
			'title_li'     => '',
			'hierarchical' => 1,
			'exclude'    => array( 10 )
		);
		return  $args;
	}
	/* ========================================================================================================================
	Custome Functions
	======================================================================================================================== */
	function gallery(){
		$galeria_images = get_field( 'galeria', 'option' );
		if ( $galeria_images ) : 
		foreach ( $galeria_images as $galeria_image ) :
			echo '<div class="col-6 col-md-4 col-lg-2 p-1">';
				echo '<a class="zoom column" href="'.$galeria_image['url'].'" data-lightbox="roadtrip">';
					echo '<div>';
						echo '<figure><img src="'.$galeria_image['sizes']['medium'].'" alt="'.$galeria_image['alt'].'" /></figure>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		endforeach;
		endif;
	}
	function pagination_bar() {
		global $wp_query;
		$total_pages = $wp_query->max_num_pages;
		if ($total_pages > 1){
			$current_page = max(1, get_query_var('paged'));
			echo paginate_links(array(
				'base' => get_pagenum_link(1) . '%_%',
				'format' => '/page/%#%',
				'current' => $current_page,
				'total' => $total_pages,
				'prev_text'    => __('<'),
            	'next_text'    => __('>'),
			));
		}
	}
	function commentsNumber(){
	$num_comments = get_comments_number(); 
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __('Brak komentarzy');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Komentarze');
			} else {
				$comments = __('1 Komentarz');
			}
			echo $write_comments = $comments;
		}
	}
    function blockImgLeft($img){
 	 if ( $img ) { ?>
    <?php $header = get_sub_field( 'header' ); ?>
    <div class="col-12 col-md-5">
        <a href="<?php the_sub_field( 'przekierowanie_po_kliknieciu' ); ?>">
            <div class="row m-0">
                <div class="col-6 p-0">
                    <div class="img-hover-zoom">
                        <img src="<?php echo $img['sizes']['thumbnail']; ?>" alt="<?php echo $img['alt']; ?>" />
                    </div>
                </div>
                <div class="col-6">
                    <?php if ( have_rows( 'lista_punktowana' ) ) : ?>
                    <h2 class="h6"><?php echo $header; ?></h2>
                    <ul>
                        <?php while ( have_rows( 'lista_punktowana' ) ) : the_row(); ?>
                        <li>
                            <p>- <?php the_sub_field( 'informacja' ); ?></p>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php else : ?>
                    <h2 class="h6 text-center"><?php echo $header; ?></h2>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    </div>
    <?php }   }
    function blockImgRight($img){
 	 if ( $img ) { ?>
    <?php $header = get_sub_field( 'header' ); ?>
    <div class="col-12 col-md-5">
        <a href="<?php the_sub_field( 'przekierowanie_po_kliknieciu' ); ?>">
            <div class="row m-0">
                <div class="col-6">
                    <?php if ( have_rows( 'lista_punktowana' ) ) : ?>
                    <h2 class="h6"><?php echo $header; ?></h2>
                    <ul>
                        <?php while ( have_rows( 'lista_punktowana' ) ) : the_row(); ?>
                        <li>
                            <p>- <?php the_sub_field( 'informacja' ); ?></p>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php else : ?>
                    <h2 class="h6 text-center"><?php echo $header; ?></h2>
                    <?php endif; ?>
                </div>
                <div class="col-6 p-0">
                    <div class="img-hover-zoom">
                        <img src="<?php echo $img['sizes']['thumbnail']; ?>" alt="<?php echo $img['alt']; ?>" />
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php }   }
	function socialMedia(){ ?>
    <div class="social-media">
        <a href="<?php the_field( 'facebook', 16 ); ?>"> <i class="fab fa-facebook-f"></i></a>
        <a href="<?php the_field( 'instagram', 16 ); ?>"> <i class="fab fa-instagram"></i></a>
    </div>
    <?php }
	function galleryLink(){
		if(get_field( 'gallery_link' )):
			the_field( 'gallery_link' );
		else :
			echo get_permalink();
		endif;
	}
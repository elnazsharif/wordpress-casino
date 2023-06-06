<?php 
function casino_theme_support(){
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

}
add_action( 'after_setup_theme', 'casino_theme_support' );

// Register style.
function casino_register_styles() {
	
	wp_enqueue_style( 'casino_register_styles',get_template_directory_uri(). "/style.css", array(),'1.0','all' );
  
}

// Register script.
add_action( 'wp_enqueue_scripts', 'casino_register_styles' );
function enqueue_lazyload_script() {
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.min.js', array(), '1.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_lazyload_script' );
  
// Enable fmenu
function casino_menus() {
	$location =array(
		'primary'=>"main menu",
		'top'=>"top menu",

	);
register_nav_menus($location);

}

add_action( 'init', 'casino_menus' );


// Display lazy loaded featured image on single posts
function display_featured_image() {
    if (has_post_thumbnail()) {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
        ?>
        <img class="lazyload featured-image" data-src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title(); ?>" loading="lazy">
        <?php
    }
}


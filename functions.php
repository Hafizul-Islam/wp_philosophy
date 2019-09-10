<?php
require_once(get_theme_file_path( "inc/tgm.php" ));
require_once(get_theme_file_path( "lib/attachment.php" ));
if( site_url()=="http://localhost/wordpress"){
	define("VERSION", time());
}else{
	define("VERSION", wp_get_theme()->get("Version"));
}
function philosophy_theme_setup(){
	load_theme_textdomain( "philosophy");
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5',array('search-form','comment-list') );
	add_theme_support( "post-formats",array('image','gallery','quote','audio','video','link') );
	add_editor_style( "/assets/css/editor-style.css" );

	register_nav_menu( 'topmenu', __("Top menu","philosophy") );
	register_nav_menus( array(
		'footer-left', __("Footer Left Menu","philosophy"),
		'footer-middle', __("Footer Middle Menu","philosophy"), 
		'footer-right', __("Footer Right Menu","philosophy")

	));

	add_image_size( 'philosophy-home-squre',400,400,true);

}
add_action( 'after_setup_theme','philosophy_theme_setup');

function philosophy_assets(){
	wp_enqueue_style( 'fontawsomemin-css',get_theme_file_uri('/assets/font-awesome/css/font-awesome.min.css'),null,"1.0" );
	wp_enqueue_style( 'fontawesome-css',get_theme_file_uri('/assets/font-awesome/css/font-awesome.css'),null,"1.0" );
	wp_enqueue_style( 'base-css',get_theme_file_uri('/assets/css/base.css'),null,"1.0" );
	wp_enqueue_style( 'vendor-css',get_theme_file_uri('/assets/css/vendor.css'),null,"1.0" );
	wp_enqueue_style( 'main-css',get_theme_file_uri('/assets/css/main.css'),null,"1.0" );
	wp_enqueue_style( 'philosophy-css', get_stylesheet_uri(),null,VERSION);

	wp_enqueue_script('modernizer-js', get_theme_file_uri( "assets/js/modernizr.js" ),null,"1.0");
	wp_enqueue_script('pace-js', get_theme_file_uri( "assets/js/pace.js" ),null,"1.0");
	wp_enqueue_script('plugin-js', get_theme_file_uri( "assets/js/plugins.js" ),array("jquery"),"1.0",true);
	wp_enqueue_script('main-js', get_theme_file_uri( "assets/js/main.js" ),array("jquery"),"1.0",true);
}
 
add_action( 'wp_enqueue_scripts' ,'philosophy_assets');


function philosophy_pagination(){
	global $wp_query;
	$links = paginate_links(array(
		'current' => max(1,get_query_var( 'paged')),
		'total'   => $wp_query->max_num_pages,
		'type'    => 'list',
		'mid_size'     =>3,
	)); 

	$links = str_replace("page-numbers", "pgn__num", $links);
	$links = str_replace("<ul class='pgn__num'>", "<ul>", $links);
	$links = str_replace("prev pgn__num", "pgn__prev", $links);
	$links = str_replace("next pgn__num", "pgn__next", $links);


	echo $links;
}

function philosophy_init_widgets() {
    $about_us = array(
        'name'          => __( 'About page', 'philosophy' ),
        'id'            => 'about-us',
        'description'   => __( 'about page us', 'philosophy' ),
        'before_widget' => '<div id="%1$s"class="col-block %2$s" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    );
    $maps = array(
    	'name'          => __( 'contrct page map selected', 'philosophy' ),
    	'id'            => 'contract-maps',
    	'description'   => __( 'contract page map area', 'philosophy' ),
    	'class'         => '',
    	'before_widget' => '<div id="%1" class=" %2">',
    	'after_widget'  => '</div>',
    	'before_title'  => '',
    	'after_title'   => '',
    );
    $contract_info = array(
        'name'          => __( 'contract  page', 'philosophy' ),
        'id'            => 'contract-info',
        'description'   => __( 'Contract page info area', 'philosophy' ),
        'before_widget' => '<div id="%1$s"class="col-block %2$s" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    );
    $about_philosophy = array(
        'name'          => __( 'contact page about philosophy ', 'philosophy' ),
        'id'            => 'about-philosophy',
        'description'   => __( 'Contract page about philosophy', 'philosophy' ),
        'before_widget' => '<div id="%1$s"class="%2$s" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h3">',
        'after_title'   => '</h3>',
    );
    $footer_right = array(
        'name'          => __( 'footer right about philosophy ', 'philosophy' ),
        'id'            => 'footer-right',
        'description'   => __( 'Contract page about philosophy', 'philosophy' ),
        'before_widget' => '<div id="%1$s"class="%2$s" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h4">',
        'after_title'   => '</h4>',
    );
    $footer_bottom = array(
        'name'          => __( 'footer Bottom about philosophy ', 'philosophy' ),
        'id'            => 'footer-Bottom',
        'description'   => __( 'Contract page about philosophy', 'philosophy' ),
        'before_widget' => '<div id="%1$s"class="%2$s" >',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    );
    register_sidebar($about_philosophy);
    register_sidebar( $about_us );
    register_sidebar( $maps );
    register_sidebar( $contract_info );
    register_sidebar( $footer_right );
    register_sidebar( $footer_bottom );

    
}
add_action( 'widgets_init', 'philosophy_init_widgets' );

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
        </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
            </a><?php 
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>

        <?php comment_text(); ?>

        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

remove_action( 'term_description', 'wpautop' );
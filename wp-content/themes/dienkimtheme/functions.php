<?php
require_once get_template_directory() . '/inc/customizer.php';
global $customizerGlobal;
$customizerGlobal = new CustomizerControl();
add_filter( 'nav_menu_link_attributes', 'wp_nav_menu_link', 10, 3 );
function wp_nav_menu_link( $atts, $item, $args ) {	
	if(in_array("current-menu-item", $item->classes)){
		$class = 'active'; 
    	$atts['class'] = $class;    
	}
    return $atts;
}
add_action('init', 'zendvn_theme_register_menus');
function zendvn_theme_register_menus(){
	register_nav_menus(
		array(						
			'main-menu' 			=> __('Main menu'),
			'mobile-menu' 			=> __('Mobile menu'),
			'dropdown-menu' 		=> __('Dropdownmenu'),
			'rau-sach-menu' 		=> __('Rau sạch'),			
			'support-menu' 			=> __('Hỗ trợ'),		
			'direction-menu' 			=> __('Hướng dẫn'),		
			'policy-menu' 			=> __('Chính sách'),		
			'about-us-menu' 			=> __('Tại sao chọn chúng tôi'),		
			'category-article-menu' => __('Danh mục bài viết'),	
			'category-product-menu' => __('Danh mục sản phẩm'),			
			'bottom-menu' => __('Bottom menu'),	
			'top-menu' => __('Top menu'),			
		)
	);
}
add_action('after_setup_theme', 'zendvn_theme_support');
function zendvn_theme_support(){
	add_theme_support( 'post-formats', array('aside','image','gallery','video','audio') );
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	
	
}
add_action('widgets_init', 'zendvn_theme_widgets_init');
function zendvn_theme_widgets_init(){	
	$themeName="dienkimtheme";	
	register_sidebar(array(
		'name'          => __( 'SlideShow', $themeName ),
		'id'            => 'slideshow-widget',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'RightColWidget', $themeName ),
		'id'            => 'right-col-widget',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
		'after_widget'  => '</div>'				
	));
}
add_action("wp_enqueue_scripts",function(){
	wp_deregister_script("jquery");
	wp_deregister_script("jquery-migrate");
});
add_action('wp_enqueue_scripts', 'zendvn_theme_register_js');
function zendvn_theme_register_js(){	
	wp_register_script('vjquery', get_template_directory_uri() . '/js/jquery-3.2.1.js',array(),"1.0",false);
	wp_enqueue_script('vjquery');
	wp_register_script('bootstrap_min', get_template_directory_uri() . '/js/bootstrap.js',array(),"1.0",false);
	wp_enqueue_script('bootstrap_min');
	
	/* begin ddsmoothmenu */
	wp_register_script('ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js',array(),"1.0",false);
	wp_enqueue_script('ddsmoothmenu');
	/* end ddsmoothmenu */
	wp_register_script('jquery_fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js',array(),"1.0",false);
	wp_enqueue_script('jquery_fancybox');
	wp_register_script('jquery_fancybox_buttons', get_template_directory_uri() . '/js/jquery.fancybox-buttons.js',array(),"1.0",false);
	wp_enqueue_script('jquery_fancybox_buttons');
	wp_register_script('jquery_fancybox_thumbs', get_template_directory_uri() . '/js/jquery.fancybox-thumbs.js',array(),"1.0",false);
	wp_enqueue_script('jquery_fancybox_thumbs');
	wp_register_script('jquery_fancybox_media', get_template_directory_uri() . '/js/jquery.fancybox-media.js',array(),"1.0",false);
	wp_enqueue_script('jquery_fancybox_media');		
	/* begin slick slider */
	wp_register_script('slick_min', get_template_directory_uri() . '/slick/slick.min.js',array(),"1.0",false);
	wp_enqueue_script('slick_min');
	/* end slick slider */
	/* begin owlslider */
	wp_register_script('owl_carousel', get_template_directory_uri() . '/js/owl.carousel.min.js',array(),"1.0",false);
	wp_enqueue_script('owl_carousel');
	/* end owlslider */
	/* begin simplyscroll */
	wp_register_script('jquery_simplyscroll', get_template_directory_uri() . '/js/jquery.simplyscroll.min.js',array(),"1.0",false);
	wp_enqueue_script('jquery_simplyscroll');
	/* end simplyscroll */
	/* begin bxslider */
	wp_register_script('jquery_bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js',array(),"1.0",false);
	wp_enqueue_script('jquery_bxslider');
	/* end bxslider */
	/* begin elevatezoom */
	wp_register_script('jquery_elevatezoom', get_template_directory_uri() . '/js/jquery.elevatezoom-3.0.8.min.js',array(),"1.0",false);
	wp_enqueue_script('jquery_elevatezoom');
	/* end elevatezoom */	
	wp_register_script('custom', get_template_directory_uri() . '/js/custom.js',array(),"1.0",false);
	wp_enqueue_script('custom');			
}
add_action('wp_footer', 'footer_script_code');
add_action('wp_head', 'header_script_code');
function header_script_code(){
	$strScript='<script type="text/javascript" language="javascript">
        ddsmoothmenu.init({
            mainmenuid: "smoothmainmenu", 
            orientation: "h", 
            classname: "ddsmoothmenu",
            contentsource: "markup" 
        });  
        jQuery(document).ready(function(){
jQuery(".slick-slideshow").slick({
	dots: false,
	autoplay:true,
	arrows:false,
	adaptiveHeight:true
});  
		});     
    </script>';
    echo $strScript;
}
function footer_script_code(){
	$strScript= '<script type=\'text/javascript\'>
	var wpexLocalize = {
		"mobileMenuOpen" : "Browse Categories",
		"mobileMenuClosed" : "Close navigation",
		"homeSlideshow" : "false",
		"homeSlideshowSpeed" : "7000",
		"UsernamePlaceholder" : "Username",
		"PasswordPlaceholder" : "Password",
		"enableFitvids" : "true"
	};	
	</script>
	';
	echo $strScript;
}
add_action('wp_enqueue_scripts', 'zendvn_theme_register_style');
function zendvn_theme_register_style(){
	global $wp_styles;	
	wp_register_style('font_awesome_min', get_template_directory_uri() . '/css/font-awesome.css',array(),'1.0','all');
	wp_enqueue_style('font_awesome_min');
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css',array(),'1.0','all');
	wp_enqueue_style('bootstrap');	
	/* begin ddsmoothmenu */
	wp_register_style('ddsmoothmenu', get_template_directory_uri() . '/css/ddsmoothmenu.css',array(),'1.0','all');
	wp_enqueue_style('ddsmoothmenu');
	/* end ddsmoothmenu */
	wp_register_style('jquery_fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css',array(),'1.0','all');
	wp_enqueue_style('jquery_fancybox');
	wp_register_style('jquery_fancybox_buttons', get_template_directory_uri() . '/css/jquery.fancybox-buttons.css',array(),'1.0','all');
	wp_enqueue_style('jquery_fancybox_buttons');
	wp_register_style('jquery_fancybox_thumbs', get_template_directory_uri() . '/css/jquery.fancybox-thumbs.css',array(),'1.0','all');
	wp_enqueue_style('jquery_fancybox_thumbs');
	wp_register_style('hover', get_template_directory_uri() . '/css/hover.css',array(),'1.0','all');
	wp_enqueue_style('hover');
	wp_register_style('pagination',get_template_directory_uri() . '/css/pagination.css',array(),'1.0','all');
	wp_enqueue_style('pagination');
	/* begin slick slider */
	wp_register_style('slick', get_template_directory_uri() . '/slick/slick.css',array(),'1.0','all');
	wp_enqueue_style('slick');
	wp_register_style('slick_theme', get_template_directory_uri() . '/slick/slick-theme.css',array(),'1.0','all');
	wp_enqueue_style('slick_theme');
	/* end slick slider */
	/* begin owlslider */
	wp_register_style('owl_carousel', get_template_directory_uri() . '/css/owl.carousel.css',array(),'1.0','all');
	wp_enqueue_style('owl_carousel');
	/* end owlslider */
	/* css simplyscroll */
	wp_register_style('simplyscroll', get_template_directory_uri() . '/css/jquery.simplyscroll.css',array(),'1.0','all');
	wp_enqueue_style('simplyscroll');
	/* end simplyscroll */
	/* css simplyscroll */
	wp_register_style('jquery_bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css',array(),'1.0','all');
	wp_enqueue_style('jquery_bxslider');
	/* end simplyscroll */
	/*begin dropdownmenu*/
	wp_register_style('dropdownmenu',get_template_directory_uri() . '/css/dropdownmenu.css',array(),'1.0','all');
	wp_enqueue_style('dropdownmenu');
	/*end dropdownmenu*/
	/*begin tab*/
	wp_register_style('tab',get_template_directory_uri() . '/css/tab.css',array(),'1.0','all');
	wp_enqueue_style('tab');
	/*end tab*/
	/*begin menu-horizontal-right*/
	wp_register_style('menuhorizontalright',get_template_directory_uri() . '/css/menu-horizontal-right.css',array(),'1.0','all');
	wp_enqueue_style('menuhorizontalright');
	/*end menu-horizontal-right*/
	wp_register_style('template',get_template_directory_uri() . '/css/template.css',array(),'1.0','all');
	wp_enqueue_style('template');	
	wp_register_style('custom',get_template_directory_uri() . '/css/custom.css',array(),'1.0','all');
	wp_enqueue_style('custom');	
}
function loadSlideShow($attrs){
	
	ob_start();        	
	extract(
		shortcode_atts(
			array(
				'category' => '',			
			), 
			$attrs
		)
	);	
	$args = array(  		
		'category_name' => 	$category,
        'posts_per_page' =>999, 
        'order'   => 'DESC', 
        'post_type' => 'post'
    );
	$query = new WP_Query($args);		
	if($query->have_posts()){		
		echo '<div class="slick-slideshow">';
		while ($query->have_posts()) {
			$query->the_post();		
							$post_id=$query->post->ID;							
							$permalink=get_the_permalink($post_id);
							$title=get_the_title($post_id);
							$excerpt=substr(get_the_excerpt( $post_id ), 0,200).'...';			
							$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));			
			?>			
  <div><img src="<?php echo $featureImg; ?>" /></div>  
			<?php						
		}
		echo '</div>';
		wp_reset_postdata();  
		
	}
}
add_shortcode('load_slideshow', 'loadSlideShow');

















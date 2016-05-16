<?php

// include jQuery
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

// Add commas after thousands in numbers
function th($string) {
  $sep = number_format($string, 0, '', ',');
  return $sep;
}

// add category nicenames in body and post class
function template_class($classes) {
    global $post;
    $classes[] = 'template-'.$post->post_name;
    return $classes;
}
add_filter('post_class', 'template_class');

// Add image size for Featured Sales page
add_image_size('sales', 200, 90, true);

// Add admin scripts
add_action('admin_head', 'br_admin_css');
function br_admin_css() {
	$template_url = get_bloginfo('template_url');
	echo '<link rel="stylesheet" href="'.$template_url.'/css/admin-style.css" />';
}

// Remove some stuff from head
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');


// Dashboard widget
function br_dashboard_widgets() {
    wp_add_dashboard_widget ( 'br_dashboard_right_now', 'B&R Website Admin', 'br_dashboard_right_now' );
} 
add_action('wp_dashboard_setup', 'br_dashboard_widgets' );
function br_dashboard_right_now() {
    global $wp_registered_sidebars;

    echo '<div class="clearfix">';
    echo "\n\t".'<div class="table table_content">';
    
    echo '<p class="sub">Add or remove Featured Sales on the left. Before or after uploading images, be sure to <strong>crop images to 400px wide by 200px high.</strong></p>';

    echo '<p>Change hours, phone, and other info on the Contact page and copy on the Services page on the left.</p>';

    echo '<p>If you have questions or need website support, email <a href="mailto:scott.p.donaldson@gmail.com">scott.p.donaldson@gmail.com</a>.</p>';

    echo "\n\t".'</div></div><!-- .clearfix -->';
}

// Remove a few admin pages
add_action( 'admin_menu', 'my_remove_menus', 999 );
function my_remove_menus() {
	remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit.php?post_type=page' );
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'upload.php' );
    remove_menu_page( 'profile.php' );
	remove_menu_page( 'link-manager.php' );
    remove_menu_page( 'tools.php' );
	remove_submenu_page( 'edit.php', 'edit-tags.php' );
}

// New admin menu
function register_custom_menu_page() {
    add_menu_page('Featured Sales', 'Featured Sales', 'editor', 'post.php?post=305&action=edit', '', content_url('themes/br/images/icon-car.png'), 6);
    add_menu_page('Contact', 'Contact', 'editor', 'post.php?post=303&action=edit', '', content_url('themes/br/images/icon-phone.png'), 7);
    add_menu_page('Services', 'Services', 'editor', 'post.php?post=304&action=edit', '', content_url('themes/br/images/icon-clipboard.png'), 8);
}
add_action('admin_menu', 'register_custom_menu_page');

// Admin footer
add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'Site developed by <a href="http://parsleyandsprouts.com" target="_blank">Parsley &amp Sprouts</a>.';
    return $text;
}
add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = '&copy '.date('Y').'.';
    return $text;
}

// Custom login screen
function my_login_head() {
    echo "<link rel='stylesheet' href='".get_bloginfo('template_url')."/login-style.css' type='text/css'>";
}
add_action('login_head', 'my_login_head');

function loginpage_custom_link() {
    return 'http://www.bandrautotrucksalvage.com';
}
add_filter('login_headerurl','loginpage_custom_link');

function change_title_on_logo() {
    return 'B and R Auto and Truck Salvage';
}
add_filter('login_headertitle', 'change_title_on_logo');

?>
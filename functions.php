<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );


// Change Login styles
/*Change Login Logo*/
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/artomultiplo-login-logo.svg);
        height:60px;
        width:60px;
        background-size: 60px 60px;
        background-repeat: no-repeat;
        padding-bottom: 0px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/*Change admin logo link to homepage*/
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/*Change login logo title*/
function my_login_logo_url_title() {
    return 'Artomultiplo - Admin Login';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/*Enqueuing an stylesheet only for login*/
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/login-styles.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


/* Hide the "description" title in single-product page
*  Uncomment the filter bellow if you need this
*/

function remove_product_description_heading() {
	return '';
}
//add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );


// Turn off Ship to a different address checkbox in cart
// from https://metorik.com/blog/change-woocommerce-ship-to-a-different-address-default	

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

/*Remove downloads from my_account page, Just uncomment the filter if you need this*/
/*https://rudrastyh.com/woocommerce/my-account-menu.html*/

// add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
 
    unset( $menu_links['downloads'] ); // Addresses
    return $menu_links;
 
}

/*Move category description after loop*/

add_action('woocommerce_archive_description', 'custom_archive_description', 2 );
function custom_archive_description(){
    if( is_product_category() ) :
        remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        add_action( 'woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 5 );
    endif;
}

/* Hide flat rate if free shipping is available
*  From: https://businessbloomer.com/woocommerce-hide-shipping-options-free-shipping-available/
*/

add_filter( 'woocommerce_package_rates', 'artomultiplo_unset_shipping_when_free_is_available_in_zone', 10, 2 );
   
function artomultiplo_unset_shipping_when_free_is_available_in_zone( $rates, $package ) {
      
/* Only unset rates if free_shipping is available */

if ( isset( $rates['free_shipping:2'] ) ) {
     unset( $rates['flat_rate:1'] );
}     
     
return $rates;
  
}

/*Login Logo and Admin Menu Logo*/
/*Add a logo in admin left menu*/

add_action('admin_menu', 'artomultiplo_admin_menu_logo');

function artomultiplo_admin_menu_logo() {
    global $menu;
    $url = '#';
    $menu[0] = array( __('Artomultiplo'), 'read', $url, 'am-client-site-logo', 'am-client-site-logo');
}

/*Admin Stylesheet*/

add_action('admin_head', 'artomultiplo_admin_style');

function artomultiplo_admin_style() {
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/admin_style.css" type="text/css" media="all" />';
}
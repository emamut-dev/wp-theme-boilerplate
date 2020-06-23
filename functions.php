<?php
require_once dirname( __FILE__ ) . '/helpers/TGM-Plugin-Activation-2.6.1/class-tgm-plugin-activation.php';

require_once dirname( __FILE__ ) . '/helpers/required-plugins.php';
// require_once dirname( __FILE__ ) . '/helpers/rest_custom_endpoints.php';

add_theme_support( 'post-thumbnails' );

function emamut_setup()
{
  load_theme_textdomain( 'emamut' );
}
add_action( 'after_setup_theme', 'emamut_setup' );

function add_theme_scripts()
{
  wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', array (), 1.1, true);
  wp_enqueue_script('popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array (), 1.1, true);
  wp_enqueue_script('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array (), 1.1, true);

  wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.2.0/css/all.css', array(), '1.1', 'all');

  wp_enqueue_script('vue', '//cdn.jsdelivr.net/npm/vue/dist/vue.js', array (), 1.1, true);
  wp_enqueue_script('axios', '//cdn.jsdelivr.net/npm/axios/dist/axios.min.js', array (), 1.1, true);

  wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');

  // wp_enqueue_script('app.js', get_template_directory_uri() . '/src/js/app.js', array (), 1.1, true);
  wp_enqueue_script('helpers.js', get_template_directory_uri() . '/src/js/helpers.js', array (), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

register_nav_menus( array(
  'primary' => __( 'Primary Menu', 'emamut' ),
) );

function register_navwalker(){
	require_once get_template_directory() . '/helpers/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function config_custom_logo() {
  add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme' , 'config_custom_logo' );

function theme_get_custom_logo() {
  if ( has_custom_logo() ) {
    $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );

    echo '<img class="img-fluid" id="logo" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
  }
  else
    echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
}

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
  echo "<script type=\"text/javascript\">
          let siteURL = '" . get_site_url() . "',
          themePath = '" . get_template_directory_uri() ."'
        </script>";
}
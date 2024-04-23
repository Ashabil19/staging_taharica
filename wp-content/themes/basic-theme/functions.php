<?php

add_filter('show_admin_bar', '__return_false');


// Enqueuing
function load_css()
{

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], 1, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', [], 1, 'all');
    wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');

function load_js()
{
    wp_enqueue_script('jquery');

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], 1, true);
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');


// Nav Menus
register_nav_menus( array(
    'top-menu' => __( 'Top Menu', 'theme' ),
    'footer-menu' => __( 'Footer Menu', 'theme' ),
) );

// Theme Support
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );

// Image Sizes
add_image_size('small', 600, 600, false);


// custom Count View
function count_post_views() {
    if (is_single()) {
        global $post;
        $views = get_post_meta($post->ID, 'post_views', true);
        $views = $views ? $views : 0;
        $views++;
        update_post_meta($post->ID, 'post_views', $views);
    }
}
add_action('wp_head', 'count_post_views');



// functions.php file in your WordPress theme
// belum fix
function custom_shortcode_function($atts) {
    // Get the current site URL
    $site_url = site_url();

    // Extract the path from the provided link
    $path = isset($atts['path']) ? $atts['path'] : '';

    // Construct the final URL
    $full_url = $site_url . $path;

    // Return the URL
    return $full_url;
}
add_shortcode('custom_link', 'custom_shortcode_function');


// Menambahkan filter untuk membatasi kategori berdasarkan peran pengguna
function custom_restrict_categories_for_role($args) {
    // Cek apakah pengguna sudah login
    if (is_user_logged_in()) {
        // Dapatkan peran pengguna saat ini
        $current_user = wp_get_current_user();
        $user_role = $current_user->roles[0]; // Ambil peran pertama (prioritas tertinggi)

        // Batasi kategori yang ditampilkan berdasarkan peran pengguna
        switch ($user_role) {
            case 'it':
                $args['include'] = 'it'; // Ganti dengan slug kategori IT Anda
                break;
            case 'engineering':
                $args['include'] = 'engineering'; // Ganti dengan slug kategori Engineering Anda
                break;
            case 'sales':
                $args['include'] = 'sales'; // Ganti dengan slug kategori Sales Anda
                break;
            case 'hr':
                $args['include'] = 'hr'; // Ganti dengan slug kategori HR Anda
                break;
        }
    }
    return $args;
}
add_filter('wp_dropdown_categories', 'custom_restrict_categories_for_role', 10, 1);




add_filter( 'astra_comment_form_all_post_type_support', '__return_true' );































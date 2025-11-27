<?php
/**
 * Beam AI Clone Theme Functions
 *
 * @package Beam_AI_Clone
 * @version 1.0.0
 */

// Salir si se accede directamente
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuración del tema
 */
function beam_ai_setup() {
    // Soporte para título del sitio
    add_theme_support('title-tag');

    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');

    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Registrar menús de navegación
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'beam-ai-clone'),
        'footer' => __('Menú Footer', 'beam-ai-clone'),
    ));

    // Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Soporte para editor de bloques
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'beam_ai_setup');

/**
 * Cargar estilos y scripts
 */
function beam_ai_enqueue_assets() {
    // Versión para cacheo
    $theme_version = wp_get_theme()->get('Version');

    // Estilos principales del tema
    wp_enqueue_style('beam-ai-style', get_stylesheet_uri(), array(), $theme_version);

    // Estilos modernos SaaS (incluidos por defecto)
    wp_enqueue_style('beam-ai-modern-saas', get_template_directory_uri() . '/assets/css/modern-saas.css', array('beam-ai-style'), $theme_version);

    // Estilos del sitio original (se cargarán cuando copies los archivos)
    $main_css = get_template_directory() . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style('beam-ai-main', get_template_directory_uri() . '/assets/css/main.css', array('beam-ai-modern-saas'), $theme_version);
    }

    $custom_css = get_template_directory() . '/assets/css/custom.css';
    if (file_exists($custom_css)) {
        wp_enqueue_style('beam-ai-custom', get_template_directory_uri() . '/assets/css/custom.css', array('beam-ai-modern-saas'), $theme_version);
    }

    // JavaScript: jQuery (WordPress lo incluye)
    // Sistema de animaciones moderno
    wp_enqueue_script('beam-ai-animations', get_template_directory_uri() . '/assets/js/animations.js', array('jquery'), $theme_version, true);

    // JavaScript del sitio original (se cargará cuando copies los archivos)
    $main_js = get_template_directory() . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script('beam-ai-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'beam-ai-animations'), $theme_version, true);
    }

    // Scripts adicionales personalizados
    wp_enqueue_script('beam-ai-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery', 'beam-ai-animations'), $theme_version, true);

    // Pasar datos a JavaScript
    wp_localize_script('beam-ai-animations', 'beamAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('beam_ajax_nonce'),
        'themeUrl' => get_template_directory_uri(),
        'homeUrl' => home_url('/'),
    ));

    // Google Fonts - Inter (tipografía moderna)
    wp_enqueue_style('beam-ai-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'beam_ai_enqueue_assets');

/**
 * Registrar áreas de widgets
 */
function beam_ai_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'beam-ai-clone'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets para el sidebar principal', 'beam-ai-clone'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'beam-ai-clone'),
        'id'            => 'footer-1',
        'description'   => __('Widgets para el footer', 'beam-ai-clone'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'beam_ai_widgets_init');

/**
 * Tamaños de imagen personalizados
 */
add_image_size('beam-hero', 1920, 1080, true);
add_image_size('beam-feature', 800, 600, true);
add_image_size('beam-thumbnail', 400, 300, true);

/**
 * Función helper para obtener URL de assets
 */
function beam_ai_asset_url($path) {
    return get_template_directory_uri() . '/assets/' . ltrim($path, '/');
}

/**
 * Shortcode para incluir secciones del sitio original
 */
function beam_ai_section_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name' => '',
        'class' => '',
    ), $atts);

    if (empty($atts['name'])) {
        return '';
    }

    ob_start();

    $template_file = get_template_directory() . '/templates/sections/' . sanitize_file_name($atts['name']) . '.php';

    if (file_exists($template_file)) {
        include $template_file;
    }

    return ob_get_clean();
}
add_shortcode('beam_section', 'beam_ai_section_shortcode');

/**
 * Permitir SVG en Media Library
 */
function beam_ai_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'beam_ai_mime_types');

/**
 * Limpiar wp_head de elementos innecesarios
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Custom Post Types (si necesitas agregar tipos de contenido personalizados)
 */
function beam_ai_custom_post_types() {
    // Ejemplo: Testimonials
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonios', 'beam-ai-clone'),
            'singular_name' => __('Testimonio', 'beam-ai-clone'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));

    // Ejemplo: Features/Características
    register_post_type('feature', array(
        'labels' => array(
            'name' => __('Características', 'beam-ai-clone'),
            'singular_name' => __('Característica', 'beam-ai-clone'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_rest' => true,
    ));
}
add_action('init', 'beam_ai_custom_post_types');

/**
 * Agregar clases personalizadas al body
 */
function beam_ai_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (is_front_page()) {
        $classes[] = 'home-page';
    }

    return $classes;
}
add_filter('body_class', 'beam_ai_body_classes');

/**
 * Customizer - Opciones de personalización
 */
function beam_ai_customize_register($wp_customize) {
    // Sección de configuración general
    $wp_customize->add_section('beam_ai_general', array(
        'title' => __('Configuración Beam AI', 'beam-ai-clone'),
        'priority' => 30,
    ));

    // CTA Button Text
    $wp_customize->add_setting('beam_ai_cta_text', array(
        'default' => 'Comenzar ahora',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('beam_ai_cta_text', array(
        'label' => __('Texto del botón CTA', 'beam-ai-clone'),
        'section' => 'beam_ai_general',
        'type' => 'text',
    ));

    // CTA Button URL
    $wp_customize->add_setting('beam_ai_cta_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('beam_ai_cta_url', array(
        'label' => __('URL del botón CTA', 'beam-ai-clone'),
        'section' => 'beam_ai_general',
        'type' => 'url',
    ));
}
add_action('customize_register', 'beam_ai_customize_register');

/**
 * Incluir archivos adicionales
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';

// Si usas ACF (Advanced Custom Fields)
if (file_exists(get_template_directory() . '/inc/acf-fields.php')) {
    require_once get_template_directory() . '/inc/acf-fields.php';
}

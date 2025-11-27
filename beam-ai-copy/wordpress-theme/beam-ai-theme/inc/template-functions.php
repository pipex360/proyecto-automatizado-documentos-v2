<?php
/**
 * Funciones adicionales del template
 *
 * @package Beam_AI_Clone
 */

/**
 * Agrega preload para recursos críticos
 */
function beam_ai_preload_assets() {
    // Preload de fuentes
    $fonts = array(
        // Agrega aquí las fuentes que uses del sitio original
        // 'fonts/custom-font.woff2' => 'font/woff2',
    );

    foreach ($fonts as $font => $type) {
        echo '<link rel="preload" href="' . beam_ai_asset_url($font) . '" as="font" type="' . $type . '" crossorigin>';
    }
}
add_action('wp_head', 'beam_ai_preload_assets', 1);

/**
 * Desactiva emojis de WordPress si no los necesitas
 */
function beam_ai_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'beam_ai_disable_emojis');

/**
 * Mejora la seguridad removiendo la versión de WordPress
 */
function beam_ai_remove_version() {
    return '';
}
add_filter('the_generator', 'beam_ai_remove_version');

/**
 * Lazy loading para iframes
 */
function beam_ai_iframe_loading_attr($iframe) {
    if (false !== strpos($iframe, 'loading=')) {
        return $iframe;
    }

    return str_replace('<iframe', '<iframe loading="lazy"', $iframe);
}
add_filter('oembed_result', 'beam_ai_iframe_loading_attr');

/**
 * Optimiza las consultas de búsqueda
 */
function beam_ai_search_query($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post', 'page'));
        $query->set('posts_per_page', 10);
    }
    return $query;
}
add_filter('pre_get_posts', 'beam_ai_search_query');

<?php
/**
 * Template Tags personalizados
 *
 * @package Beam_AI_Clone
 */

if (!function_exists('beam_ai_posted_on')) :
    /**
     * Muestra información de fecha de publicación
     */
    function beam_ai_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if (!function_exists('beam_ai_posted_by')) :
    /**
     * Muestra información del autor
     */
    function beam_ai_posted_by() {
        echo '<span class="byline">';
        echo '<span class="author vcard">';
        echo '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">';
        echo esc_html(get_the_author());
        echo '</a>';
        echo '</span>';
        echo '</span>';
    }
endif;

if (!function_exists('beam_ai_get_svg')) :
    /**
     * Obtiene un SVG desde la carpeta assets
     *
     * @param string $icon Nombre del icono
     * @param array $args Argumentos adicionales
     * @return string HTML del SVG
     */
    function beam_ai_get_svg($icon, $args = array()) {
        $defaults = array(
            'class' => '',
            'width' => 24,
            'height' => 24,
        );

        $args = wp_parse_args($args, $defaults);

        $svg_file = get_template_directory() . '/assets/images/icons/' . $icon . '.svg';

        if (file_exists($svg_file)) {
            $svg_content = file_get_contents($svg_file);

            // Agregar clases y atributos
            if (!empty($args['class'])) {
                $svg_content = str_replace('<svg', '<svg class="' . esc_attr($args['class']) . '"', $svg_content);
            }

            return $svg_content;
        }

        return '';
    }
endif;

if (!function_exists('beam_ai_the_svg')) :
    /**
     * Muestra un SVG
     */
    function beam_ai_the_svg($icon, $args = array()) {
        echo beam_ai_get_svg($icon, $args);
    }
endif;

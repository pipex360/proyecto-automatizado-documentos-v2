<?php
/**
 * Template principal
 *
 * @package Beam_AI_Clone
 */

get_header();
?>

<main id="main-content" class="site-main">

    <?php if (have_posts()) : ?>

        <div class="container">
            <div class="content-area">

                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="entry-header">
                            <?php
                            if (is_singular()) :
                                the_title('<h1 class="entry-title">', '</h1>');
                            else :
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
                            endif;
                            ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            if (is_singular()) :
                                the_content();
                            else :
                                the_excerpt();
                            endif;

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Páginas:', 'beam-ai-clone'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if (!is_singular()) : ?>
                            <footer class="entry-footer">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more">
                                    <?php _e('Leer más', 'beam-ai-clone'); ?> →
                                </a>
                            </footer>
                        <?php endif; ?>

                    </article>

                <?php endwhile; ?>

                <?php
                // Paginación
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← Anterior', 'beam-ai-clone'),
                    'next_text' => __('Siguiente →', 'beam-ai-clone'),
                ));
                ?>

            </div>
        </div>

    <?php else : ?>

        <div class="container">
            <div class="no-results">
                <h1><?php _e('No se encontró nada', 'beam-ai-clone'); ?></h1>
                <p><?php _e('Lo sentimos, no pudimos encontrar lo que buscas.', 'beam-ai-clone'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>

    <?php endif; ?>

</main>

<?php
get_sidebar();
get_footer();

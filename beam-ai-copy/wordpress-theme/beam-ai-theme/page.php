<?php
/**
 * Template para páginas individuales
 *
 * @package Beam_AI_Clone
 */

get_header();
?>

<main id="main-content" class="site-main page-template">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if (has_post_thumbnail() && !is_front_page()) : ?>
                <div class="page-hero">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="page-content-wrapper">

                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Páginas:', 'beam-ai-clone'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                </div>
            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php
get_footer();

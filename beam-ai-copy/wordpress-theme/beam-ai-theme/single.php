<?php
/**
 * Template para posts individuales
 *
 * @package Beam_AI_Clone
 */

get_header();
?>

<main id="main-content" class="site-main single-post">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="post-content-wrapper">

                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                        <div class="entry-meta">
                            <?php
                            beam_ai_posted_on();
                            beam_ai_posted_by();
                            ?>
                        </div>
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

                    <footer class="entry-footer">
                        <?php
                        $categories_list = get_the_category_list(', ');
                        if ($categories_list) {
                            echo '<span class="cat-links">' . __('Categorías: ', 'beam-ai-clone') . $categories_list . '</span>';
                        }

                        $tags_list = get_the_tag_list('', ', ');
                        if ($tags_list) {
                            echo '<span class="tags-links">' . __('Etiquetas: ', 'beam-ai-clone') . $tags_list . '</span>';
                        }
                        ?>
                    </footer>

                </div>
            </div>

        </article>

        <?php
        // Navegación entre posts
        the_post_navigation(array(
            'prev_text' => '<span class="nav-subtitle">' . __('Anterior:', 'beam-ai-clone') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . __('Siguiente:', 'beam-ai-clone') . '</span> <span class="nav-title">%title</span>',
        ));

        // Comentarios
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>

</main>

<?php
get_sidebar();
get_footer();

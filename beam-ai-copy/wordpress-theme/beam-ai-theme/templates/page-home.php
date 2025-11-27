<?php
/**
 * Template Name: Página de Inicio - Beam AI
 * Template para la página principal que replica beam.ai/es
 *
 * @package Beam_AI_Clone
 */

get_header();
?>

<main id="main-content" class="site-main home-template">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <!-- Aquí irá el contenido del hero copiado del sitio original -->
                    <?php the_content(); ?>
                </div>
            </div>
        </section>

        <!-- Sección de Features/Características -->
        <section class="features-section">
            <div class="container">
                <div class="features-grid">
                    <?php
                    // Query para mostrar features si usas Custom Post Type
                    $features = new WP_Query(array(
                        'post_type' => 'feature',
                        'posts_per_page' => 6,
                    ));

                    if ($features->have_posts()) :
                        while ($features->have_posts()) : $features->the_post();
                            ?>
                            <div class="feature-item">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="feature-icon">
                                        <?php the_post_thumbnail('beam-thumbnail'); ?>
                                    </div>
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <div class="feature-content">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <!-- Sección de Testimonios -->
        <section class="testimonials-section">
            <div class="container">
                <h2 class="section-title"><?php _e('Testimonios', 'beam-ai-clone'); ?></h2>
                <div class="testimonials-grid">
                    <?php
                    $testimonials = new WP_Query(array(
                        'post_type' => 'testimonial',
                        'posts_per_page' => 3,
                    ));

                    if ($testimonials->have_posts()) :
                        while ($testimonials->have_posts()) : $testimonials->the_post();
                            ?>
                            <div class="testimonial-item">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="testimonial-avatar">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="testimonial-content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="testimonial-author">
                                    <strong><?php the_title(); ?></strong>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2><?php _e('¿Listo para comenzar?', 'beam-ai-clone'); ?></h2>
                    <p><?php _e('Únete a miles de usuarios que ya están utilizando nuestra plataforma', 'beam-ai-clone'); ?></p>
                    <?php
                    $cta_url = get_theme_mod('beam_ai_cta_url', '#');
                    $cta_text = get_theme_mod('beam_ai_cta_text', 'Comenzar ahora');
                    ?>
                    <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary btn-large">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>

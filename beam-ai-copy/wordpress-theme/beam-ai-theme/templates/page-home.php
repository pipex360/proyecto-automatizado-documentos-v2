<?php
/**
 * Template Name: Página de Inicio - Beam AI Completa
 * Template funcional con todas las secciones de un sitio SaaS moderno
 *
 * @package Beam_AI_Clone
 */

get_header();
?>

<main id="main-content" class="site-main home-template">

    <!-- Hero Section con animaciones -->
    <section class="hero-section" data-aos="fade-up">
        <div class="container">
            <div class="hero-content">
                <h1 data-aos="fade-up" data-aos-delay="100">
                    <?php echo get_theme_mod('beam_hero_title', 'Potencia tu negocio con <span class="text-gradient">IA</span>'); ?>
                </h1>
                <p data-aos="fade-up" data-aos-delay="200">
                    <?php echo get_theme_mod('beam_hero_subtitle', 'La plataforma todo-en-uno que transforma tu forma de trabajar con inteligencia artificial de última generación'); ?>
                </p>
                <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?php echo esc_url(get_theme_mod('beam_cta_url', '#')); ?>" class="btn btn-primary btn-large btn-icon">
                        <?php echo esc_html(get_theme_mod('beam_cta_text', 'Comenzar ahora')); ?>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('beam_demo_url', '#demo')); ?>" class="btn btn-secondary btn-large">
                        Ver demo
                    </a>
                </div>

                <!-- Estadísticas o badges -->
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="400" style="margin-top: 3rem; display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: 700; color: white;" data-counter="50000">0</div>
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">Usuarios activos</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: 700; color: white;" data-counter="98">0</div>
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">% Satisfacción</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: 700; color: white;" data-counter="150">0</div>
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">Países</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">
                    <?php echo get_theme_mod('beam_features_title', 'Características potentes para equipos modernos'); ?>
                </h2>
                <p class="section-subtitle">
                    <?php echo get_theme_mod('beam_features_subtitle', 'Todo lo que necesitas para llevar tu negocio al siguiente nivel'); ?>
                </p>
            </div>

            <div class="features-grid" data-stagger data-stagger-delay="100">
                <?php
                // Primero intentar obtener features personalizadas
                $features_query = new WP_Query(array(
                    'post_type' => 'feature',
                    'posts_per_page' => 6,
                ));

                $has_custom_features = $features_query->have_posts();

                if ($has_custom_features) :
                    while ($features_query->have_posts()) : $features_query->the_post();
                        ?>
                        <div class="feature-card" data-aos="fade-up">
                            <div class="feature-icon">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('thumbnail');
                                } else {
                                    echo '🚀';
                                } ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Features por defecto si no hay personalizadas
                    $default_features = array(
                        array(
                            'icon' => '⚡',
                            'title' => 'Velocidad increíble',
                            'description' => 'Respuestas en milisegundos gracias a nuestra infraestructura optimizada global'
                        ),
                        array(
                            'icon' => '🔒',
                            'title' => 'Seguridad avanzada',
                            'description' => 'Encriptación de extremo a extremo y cumplimiento total con GDPR'
                        ),
                        array(
                            'icon' => '🎯',
                            'title' => 'Precisión IA',
                            'description' => 'Modelos entrenados con millones de datos para resultados perfectos'
                        ),
                        array(
                            'icon' => '🌐',
                            'title' => 'Multi-idioma',
                            'description' => 'Soporte para más de 50 idiomas con traducción automática'
                        ),
                        array(
                            'icon' => '📊',
                            'title' => 'Analytics detallado',
                            'description' => 'Métricas en tiempo real para optimizar tu rendimiento'
                        ),
                        array(
                            'icon' => '🔄',
                            'title' => 'Integraciones',
                            'description' => 'Conecta con más de 100 herramientas que ya usas'
                        ),
                    );

                    foreach ($default_features as $index => $feature) :
                        ?>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="feature-icon">
                                <?php echo $feature['icon']; ?>
                            </div>
                            <h3><?php echo esc_html($feature['title']); ?></h3>
                            <p><?php echo esc_html($feature['description']); ?></p>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- How it Works / Proceso -->
    <section class="process-section" style="padding: 6rem 0; background: white;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Cómo funciona</h2>
                <p class="section-subtitle">Comienza en 3 simples pasos</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 3rem; margin-top: 3rem;">
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="0">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 700;">1</div>
                    <h3 style="margin-bottom: 0.5rem;">Regístrate gratis</h3>
                    <p style="color: #6b7280;">Crea tu cuenta en menos de 2 minutos sin tarjeta de crédito</p>
                </div>
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="100">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 700;">2</div>
                    <h3 style="margin-bottom: 0.5rem;">Personaliza</h3>
                    <p style="color: #6b7280;">Configura la IA según tus necesidades específicas</p>
                </div>
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 700;">3</div>
                    <h3 style="margin-bottom: 0.5rem;">¡Empieza a crear!</h3>
                    <p style="color: #6b7280;">Genera contenido de calidad en segundos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" style="padding: 6rem 0; background: #f9fafb;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">
                    <?php echo get_theme_mod('beam_testimonials_title', 'Lo que dicen nuestros clientes'); ?>
                </h2>
                <p class="section-subtitle">Miles de equipos confían en nosotros cada día</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                <?php
                $testimonials_query = new WP_Query(array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => 3,
                ));

                if ($testimonials_query->have_posts()) :
                    while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                        ?>
                        <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);" data-aos="fade-up">
                            <div style="margin-bottom: 1rem;">
                                <?php for ($i = 0; $i < 5; $i++) echo '⭐'; ?>
                            </div>
                            <div style="color: #374151; margin-bottom: 1.5rem; line-height: 1.7;">
                                <?php the_content(); ?>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div style="width: 48px; height: 48px; border-radius: 50%; overflow: hidden;">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <strong style="display: block; color: #111827;"><?php the_title(); ?></strong>
                                    <span style="font-size: 0.875rem; color: #6b7280;"><?php echo get_post_meta(get_the_ID(), 'company', true); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Testimonios por defecto
                    $default_testimonials = array(
                        array(
                            'text' => '"Increíble cómo ha transformado nuestra productividad. En solo un mes recuperamos la inversión."',
                            'author' => 'María García',
                            'company' => 'CEO, TechStart'
                        ),
                        array(
                            'text' => '"La mejor decisión que tomamos este año. El equipo está encantado con los resultados."',
                            'author' => 'Carlos Ruiz',
                            'company' => 'Director, Marketing Pro'
                        ),
                        array(
                            'text' => '"Fácil de usar, potente y con un soporte técnico excepcional. Totalmente recomendado."',
                            'author' => 'Ana López',
                            'company' => 'Founder, Creative Studio'
                        ),
                    );

                    foreach ($default_testimonials as $index => $testimonial) :
                        ?>
                        <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <div style="margin-bottom: 1rem;">⭐⭐⭐⭐⭐</div>
                            <div style="color: #374151; margin-bottom: 1.5rem; line-height: 1.7;">
                                <?php echo esc_html($testimonial['text']); ?>
                            </div>
                            <div>
                                <strong style="display: block; color: #111827;"><?php echo esc_html($testimonial['author']); ?></strong>
                                <span style="font-size: 0.875rem; color: #6b7280;"><?php echo esc_html($testimonial['company']); ?></span>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" data-aos="fade-up">
        <div class="cta-content">
            <h2 data-aos="fade-up" data-aos-delay="100">
                <?php echo get_theme_mod('beam_cta_heading', '¿Listo para comenzar?'); ?>
            </h2>
            <p data-aos="fade-up" data-aos-delay="200">
                <?php echo get_theme_mod('beam_cta_description', 'Únete a miles de empresas que ya están transformando su negocio'); ?>
            </p>
            <div data-aos="fade-up" data-aos-delay="300">
                <a href="<?php echo esc_url(get_theme_mod('beam_cta_url', '#')); ?>" class="btn btn-primary btn-large" style="background: white; color: #6366f1; box-shadow: 0 10px 15px rgba(0,0,0,0.2);">
                    <?php echo esc_html(get_theme_mod('beam_cta_text', 'Comenzar gratis')); ?>
                </a>
                <p style="margin-top: 1rem; font-size: 0.875rem; color: rgba(255,255,255,0.8);">
                    ✓ Sin tarjeta de crédito &nbsp;•&nbsp; ✓ Configuración en 2 minutos &nbsp;•&nbsp; ✓ Cancela cuando quieras
                </p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<?php
/**
 * Header del tema
 *
 * @package Beam_AI_Clone
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main-content">
        <?php _e('Saltar al contenido', 'beam-ai-clone'); ?>
    </a>

    <header id="masthead" class="site-header">

        <div class="header-container">

            <div class="site-branding">
                <?php
                if (has_custom_logo()) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $description; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    <span class="menu-label"><?php _e('Menú', 'beam-ai-clone'); ?></span>
                </button>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => 'div',
                    'container_class' => 'menu-container',
                    'fallback_cb'    => false,
                ));
                ?>

                <div class="header-cta">
                    <?php
                    $cta_text = get_theme_mod('beam_ai_cta_text', 'Comenzar ahora');
                    $cta_url = get_theme_mod('beam_ai_cta_url', '#');
                    ?>
                    <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                </div>
            </nav>

        </div>

    </header>

    <div id="content" class="site-content">

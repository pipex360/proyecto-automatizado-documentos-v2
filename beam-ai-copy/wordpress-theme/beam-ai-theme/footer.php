<?php
/**
 * Footer del tema
 *
 * @package Beam_AI_Clone
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">

        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="footer-widgets">
                <div class="container">
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <div class="container">

                <div class="footer-content">

                    <div class="footer-branding">
                        <?php
                        if (has_custom_logo()) :
                            the_custom_logo();
                        else :
                            ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>

                    <nav class="footer-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </nav>

                    <div class="site-info">
                        <p>
                            &copy; <?php echo date('Y'); ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                            <?php _e('Todos los derechos reservados.', 'beam-ai-clone'); ?>
                        </p>
                    </div>

                </div>

            </div>
        </div>

    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

/**
 * JavaScript personalizado para Beam AI Theme
 */

(function($) {
    'use strict';

    // Esperar a que el DOM esté listo
    $(document).ready(function() {

        /**
         * Menu Toggle - Hamburger
         */
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation').toggleClass('toggled');
            $('body').toggleClass('menu-open');

            // Actualizar aria-expanded
            var expanded = $(this).attr('aria-expanded') === 'true' || false;
            $(this).attr('aria-expanded', !expanded);
        });

        /**
         * Cerrar menú al hacer click fuera
         */
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length &&
                $('.main-navigation').hasClass('toggled')) {
                $('.menu-toggle').click();
            }
        });

        /**
         * Smooth scroll para enlaces ancla
         */
        $('a[href*="#"]').on('click', function(e) {
            var target = $(this).attr('href');

            // Solo para anclas en la misma página
            if (target.indexOf('#') > -1 && target.length > 1) {
                var targetElement = $(target.split('#')[1] ? '#' + target.split('#')[1] : 'body');

                if (targetElement.length) {
                    e.preventDefault();

                    $('html, body').animate({
                        scrollTop: targetElement.offset().top - 80
                    }, 800);

                    // Cerrar menú móvil si está abierto
                    if ($('.main-navigation').hasClass('toggled')) {
                        $('.menu-toggle').click();
                    }
                }
            }
        });

        /**
         * Header scroll - Añadir clase cuando se hace scroll
         */
        var header = $('#masthead');
        var scrollThreshold = 100;

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > scrollThreshold) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });

        /**
         * Lazy loading de imágenes (si no usas plugin)
         */
        if ('IntersectionObserver' in window) {
            var imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        if (image.dataset.src) {
                            image.src = image.dataset.src;
                            image.classList.remove('lazy');
                            imageObserver.unobserve(image);
                        }
                    }
                });
            });

            document.querySelectorAll('img.lazy').forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        /**
         * Animaciones al scroll (fade in)
         */
        function animateOnScroll() {
            $('.animate-on-scroll').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animated');
                }
            });
        }

        // Ejecutar al hacer scroll
        $(window).on('scroll', animateOnScroll);

        // Ejecutar al cargar la página
        animateOnScroll();

        /**
         * Formularios - Validación básica
         */
        $('form').on('submit', function(e) {
            var form = $(this);
            var isValid = true;

            // Validar campos requeridos
            form.find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });

            // Validar email
            form.find('input[type="email"]').each(function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailRegex.test(email)) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, completa todos los campos requeridos correctamente.');
            }
        });

        /**
         * Accesibilidad - Focus visible para teclado
         */
        function handleFirstTab(e) {
            if (e.keyCode === 9) {
                document.body.classList.add('user-is-tabbing');
                window.removeEventListener('keydown', handleFirstTab);
            }
        }
        window.addEventListener('keydown', handleFirstTab);

        /**
         * Debug info (solo en desarrollo)
         */
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            console.log('Beam AI Theme - Version 1.0.0');
            console.log('Theme URL:', beamAjax.themeUrl);
        }

    });

})(jQuery);

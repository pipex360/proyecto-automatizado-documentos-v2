/**
 * Animaciones y efectos modernos - Estilo beam.ai
 * Incluye scroll animations, parallax, y efectos interactivos
 */

(function($) {
    'use strict';

    // Configuración global
    const ANIMATION_CONFIG = {
        duration: 800,
        easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
        offset: 100,
        once: false
    };

    /**
     * Sistema de animaciones al scroll (AOS - Animate On Scroll)
     */
    class ScrollAnimations {
        constructor() {
            this.elements = [];
            this.init();
        }

        init() {
            // Seleccionar todos los elementos con animación
            this.elements = document.querySelectorAll('[data-aos]');

            if (this.elements.length === 0) return;

            // Observer para detectar elementos visibles
            this.observer = new IntersectionObserver(
                (entries) => this.handleIntersection(entries),
                {
                    threshold: 0.1,
                    rootMargin: `${ANIMATION_CONFIG.offset}px`
                }
            );

            // Observar cada elemento
            this.elements.forEach(el => this.observer.observe(el));
        }

        handleIntersection(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');

                    // Si es "once", dejar de observar
                    if (entry.target.dataset.aosOnce === 'true') {
                        this.observer.unobserve(entry.target);
                    }
                } else {
                    // Remover clase si no es "once"
                    if (entry.target.dataset.aosOnce !== 'true') {
                        entry.target.classList.remove('aos-animate');
                    }
                }
            });
        }
    }

    /**
     * Efecto Parallax en elementos
     */
    class ParallaxEffect {
        constructor() {
            this.elements = document.querySelectorAll('[data-parallax]');
            if (this.elements.length > 0) {
                this.init();
            }
        }

        init() {
            window.addEventListener('scroll', () => this.updateParallax());
            this.updateParallax();
        }

        updateParallax() {
            const scrollY = window.pageYOffset;

            this.elements.forEach(element => {
                const speed = parseFloat(element.dataset.parallax) || 0.5;
                const elementTop = element.offsetTop;
                const elementHeight = element.offsetHeight;
                const viewportHeight = window.innerHeight;

                // Solo aplicar parallax si el elemento está visible
                if (scrollY + viewportHeight > elementTop && scrollY < elementTop + elementHeight) {
                    const offset = (scrollY - elementTop) * speed;
                    element.style.transform = `translateY(${offset}px)`;
                }
            });
        }
    }

    /**
     * Contador animado para números
     */
    class AnimatedCounter {
        constructor() {
            this.counters = document.querySelectorAll('[data-counter]');
            if (this.counters.length > 0) {
                this.init();
            }
        }

        init() {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !entry.target.dataset.counted) {
                            this.animateCounter(entry.target);
                            entry.target.dataset.counted = 'true';
                        }
                    });
                },
                { threshold: 0.5 }
            );

            this.counters.forEach(counter => observer.observe(counter));
        }

        animateCounter(element) {
            const target = parseInt(element.dataset.counter);
            const duration = parseInt(element.dataset.duration) || 2000;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }
    }

    /**
     * Smooth scroll para enlaces ancla
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                if (href === '#' || href === '#0') return;

                const targetElement = document.querySelector(href);

                if (targetElement) {
                    e.preventDefault();

                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = targetElement.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Cerrar menú móvil si está abierto
                    $('.main-navigation').removeClass('toggled');
                    $('.menu-toggle').removeClass('active');
                }
            });
        });
    }

    /**
     * Header scroll effect
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Agregar clase "scrolled"
            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide header on scroll down, show on scroll up
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }

            lastScroll = currentScroll;
        });
    }

    /**
     * Efecto de typing/escritura animada
     */
    class TypingEffect {
        constructor(element, options = {}) {
            this.element = element;
            this.text = element.dataset.typing || element.textContent;
            this.speed = parseInt(element.dataset.typingSpeed) || 50;
            this.delay = parseInt(element.dataset.typingDelay) || 0;
            this.index = 0;

            element.textContent = '';

            if (this.delay > 0) {
                setTimeout(() => this.type(), this.delay);
            } else {
                this.type();
            }
        }

        type() {
            if (this.index < this.text.length) {
                this.element.textContent += this.text.charAt(this.index);
                this.index++;
                setTimeout(() => this.type(), this.speed);
            }
        }
    }

    /**
     * Lazy loading de imágenes mejorado
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;

                        // Cargar imagen
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                        }

                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }

                        // Agregar clase de cargado
                        img.classList.add('loaded');
                        img.classList.remove('lazy');

                        observer.unobserve(img);
                    }
                });
            });

            // Observar todas las imágenes lazy
            document.querySelectorAll('img.lazy, img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Efecto de cursor personalizado (opcional)
     */
    class CustomCursor {
        constructor() {
            this.cursor = null;
            this.init();
        }

        init() {
            // Crear cursor
            this.cursor = document.createElement('div');
            this.cursor.className = 'custom-cursor';
            document.body.appendChild(this.cursor);

            // Seguir el mouse
            document.addEventListener('mousemove', (e) => {
                this.cursor.style.left = e.clientX + 'px';
                this.cursor.style.top = e.clientY + 'px';
            });

            // Efecto hover en elementos interactivos
            document.querySelectorAll('a, button, [data-cursor-hover]').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    this.cursor.classList.add('hover');
                });

                el.addEventListener('mouseleave', () => {
                    this.cursor.classList.remove('hover');
                });
            });
        }
    }

    /**
     * Revelar elementos gradualmente
     */
    function initStaggeredReveal() {
        const groups = document.querySelectorAll('[data-stagger]');

        groups.forEach(group => {
            const children = group.children;
            const delay = parseInt(group.dataset.staggerDelay) || 100;

            Array.from(children).forEach((child, index) => {
                child.style.transitionDelay = `${index * delay}ms`;
            });
        });
    }

    /**
     * Progress bar al scroll
     */
    function initScrollProgress() {
        const progressBar = document.querySelector('.scroll-progress');
        if (!progressBar) return;

        window.addEventListener('scroll', () => {
            const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.pageYOffset / windowHeight) * 100;
            progressBar.style.width = scrolled + '%';
        });
    }

    /**
     * Inicialización al cargar el DOM
     */
    $(document).ready(function() {
        console.log('🎨 Inicializando animaciones modernas...');

        // Inicializar todos los sistemas
        new ScrollAnimations();
        new ParallaxEffect();
        new AnimatedCounter();

        initSmoothScroll();
        initHeaderScroll();
        initLazyLoading();
        initStaggeredReveal();
        initScrollProgress();

        // Typing effect en elementos marcados
        document.querySelectorAll('[data-typing]').forEach(el => {
            new TypingEffect(el);
        });

        // Custom cursor (desactivado por defecto, descomentar para activar)
        // if (window.matchMedia('(min-width: 1024px)').matches) {
        //     new CustomCursor();
        // }

        console.log('✅ Animaciones cargadas correctamente');
    });

    /**
     * Revelar elementos al hacer scroll (fallback para navegadores antiguos)
     */
    function revealOnScroll() {
        const reveals = document.querySelectorAll('[data-reveal]');

        reveals.forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 100;

            if (elementTop < windowHeight - elementVisible) {
                element.classList.add('revealed');
            }
        });
    }

    // Ejecutar al scroll si hay elementos para revelar
    if (document.querySelectorAll('[data-reveal]').length > 0) {
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Ejecutar una vez al cargar
    }

    // Exponer API global si es necesario
    window.BeamAnimations = {
        ScrollAnimations,
        ParallaxEffect,
        AnimatedCounter,
        TypingEffect,
        CustomCursor
    };

})(jQuery);

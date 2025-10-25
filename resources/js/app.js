import './bootstrap';
import Alpine from 'alpinejs';

// Initialiser Alpine.js
window.Alpine = Alpine;

// Store global pour l'état de l'application
Alpine.store('app', {
    scroll: 0,
    mobileMenuOpen: false,
    isLoading: false
});

// Composant pour les animations au scroll
Alpine.data('scrollAnimation', () => ({
    init() {
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        this.$nextTick(() => {
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                this.observer.observe(el);
            });
        });
    }
}));

// Composant pour le formulaire de contact
Alpine.data('contactForm', () => ({
    form: {
        first_name: '',
        last_name: '',
        email: '',
        subject: '',
        message: ''
    },
    isSubmitting: false,
    success: false,
    error: null,

    async submit() {
        this.isSubmitting = true;
        this.error = null;

        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(this.form)
            });

            if (response.ok) {
                this.success = true;
                this.form = { first_name: '', last_name: '', email: '', subject: '', message: '' };
                
                // Afficher un message de succès
                setTimeout(() => {
                    this.success = false;
                }, 5000);
            } else {
                this.error = 'Une erreur est survenue. Veuillez réessayer.';
            }
        } catch (error) {
            this.error = 'Une erreur est survenue. Veuillez réessayer.';
        } finally {
            this.isSubmitting = false;
        }
    }
}));

// Composant pour le slider de témoignages
Alpine.data('testimonialSlider', () => ({
    testimonials: [],
    currentIndex: 0,
    autoplay: true,
    intervalId: null,

    init() {
        const testimonialsData = this.$el.dataset.testimonials;
        console.log('Raw testimonials data from data-attribute:', testimonialsData); // Nouvelle ligne de débogage
        if (testimonialsData) {
            try {
                this.testimonials = JSON.parse(testimonialsData);
            } catch (e) {
                console.error('Error parsing testimonials data:', e);
                this.testimonials = [];
            }
        }
        
        if (this.testimonials.length > 0) {
            this.startAutoplay();
        }
    },

    startAutoplay() {
        this.stopAutoplay(); // S'assurer qu'il n'y a qu'un seul intervalle
        this.intervalId = setInterval(() => {
            this.nextSlide();
        }, 7000); // Défilement toutes les 7 secondes
    },

    stopAutoplay() {
        clearInterval(this.intervalId);
        this.intervalId = null;
    },

    nextSlide() {
        this.currentIndex = (this.currentIndex + 1) % this.testimonials.length;
    },

    goTo(index) {
        this.currentIndex = index;
        this.pause(); // Mettre en pause l'autoplay si l'utilisateur interagit
    },

    pause() {
        this.stopAutoplay();
    },

    start() {
        this.startAutoplay();
    }
}));

// Déclarer les données des témoignages globalement pour Alpine.js
// Ceci est une solution temporaire. Idéalement, les données seraient injectées proprement dans la balise x-data
// via un attribut data-testimonials="{{ $testimonials->toJson() }}" sur le conteneur du slider.
// Pour le moment, nous allons les mettre sur window pour simuler.
// Cette partie sera à ajuster en fonction de comment les données sont passées à la vue.

// Assurez-vous que les données sont disponibles via une variable JavaScript globale ou un attribut data-testimonials sur la balise x-data
// Dans HomeController, nous passons $testimonials à la vue welcome.blade.php
// Nous devons rendre ces données accessibles à Alpine.js

// Dans welcome.blade.php, le conteneur du slider pourrait ressembler à ceci :
// <div x-data="testimonialSlider" data-testimonials="{{ $testimonials->toJson() }}">
// Pour l'instant, je simule la disponibilité de window.testimonialsData

// Le code suivant devrait être dans welcome.blade.php avant l'initialisation d'Alpine, ou directement dans le contrôleur si possible
/*
<script>
    window.testimonialsData = @json($testimonials);
</script>
*/

// Pour que Alpine puisse récupérer les données, il faut les rendre accessibles globalement ou via un attribut data-testimonials.
// Je vais modifier HomeController pour injecter les données dans un script tag.

// Démarrer Alpine
Alpine.start();

// Smooth scrolling pour les liens d'ancrage
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 64; // Hauteur du header fixe
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Animation des éléments au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                
                // Pour les animations fade-in-up
                if (entry.target.classList.contains('animate-fade-in-up')) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            }
        });
    }, observerOptions);

    // Observer les éléments à animer
    document.querySelectorAll('.animate-on-scroll, .service-card, .testimonial-card').forEach(el => {
        observer.observe(el);
    });

    // Parallax effect léger pour le hero
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax-element');
                
                parallaxElements.forEach(el => {
                    const speed = el.dataset.speed || 0.5;
                    const yPos = -(scrolled * speed);
                    el.style.transform = `translateY(${yPos}px)`;
                });
                
                ticking = false;
            });
            
            ticking = true;
        }
    });

    // Lazy loading des images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-src');
                
                if (src) {
                    img.src = src;
                    img.classList.remove('img-placeholder');
                    observer.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // Preloader (optionnel)
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 300);
        }
    });

    // Animation du compteur pour les stats
    const animateCounter = (element, target, duration = 2000) => {
        let start = 0;
        const increment = target / (duration / 16);
        
        const updateCounter = () => {
            start += increment;
            if (start < target) {
                element.textContent = Math.ceil(start);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        };
        
        updateCounter();
    };

    // Observer pour les stats
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const value = parseInt(target.dataset.value);
                
                if (value) {
                    animateCounter(target, value);
                    statsObserver.unobserve(target);
                }
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-value]').forEach(stat => {
        statsObserver.observe(stat);
    });

    // Gestion du menu mobile
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });

        // Fermer le menu quand on clique sur un lien
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        });
    }

    // Effet de typing pour le titre (optionnel)
    const typingEffect = (element, text, speed = 100) => {
        let i = 0;
        element.textContent = '';
        
        const type = () => {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        };
        
        type();
    };

    // Activer l'effet typing si l'élément existe
    const typingElement = document.querySelector('[data-typing]');
    if (typingElement) {
        const text = typingElement.getAttribute('data-typing');
        typingEffect(typingElement, text);
    }

    // Gestion des formulaires avec validation
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validation basique
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                // Soumettre le formulaire
                form.submit();
            }
        });
    });

    // Toast notifications (optionnel)
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } transform translate-y-full opacity-0 transition-all duration-300 z-50`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('translate-y-full', 'opacity-0');
        }, 100);
        
        setTimeout(() => {
            toast.classList.add('translate-y-full', 'opacity-0');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    };

    // Analytics (à configurer avec votre service d'analytics)
    window.trackEvent = function(category, action, label) {
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'event_category': category,
                'event_label': label
            });
        }
    };

    // Tracking des clics sur les CTA
    document.querySelectorAll('[data-track]').forEach(element => {
        element.addEventListener('click', function() {
            const category = this.dataset.trackCategory || 'CTA';
            const action = this.dataset.trackAction || 'click';
            const label = this.dataset.trackLabel || this.textContent;
            
            window.trackEvent(category, action, label);
        });
    });
});

// Performance monitoring (optionnel)
if ('performance' in window) {
    window.addEventListener('load', () => {
        const perfData = window.performance.timing;
        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
        
        console.log(`Page load time: ${pageLoadTime}ms`);
        
        // Vous pouvez envoyer ces données à votre service d'analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'timing_complete', {
                'name': 'load',
                'value': pageLoadTime,
                'event_category': 'Page Performance'
            });
        }
    });
}

// Service Worker pour PWA (optionnel)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => console.log('SW registered:', registration))
            .catch(err => console.log('SW registration failed:', err));
    });
}

// Gestion des erreurs globales
window.addEventListener('error', function(e) {
    console.error('Global error:', e.error);
    // Vous pouvez envoyer les erreurs à un service de monitoring
});

// Optimisation des performances - Debounce function
window.debounce = function(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// Optimisation des performances - Throttle function
window.throttle = function(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
};

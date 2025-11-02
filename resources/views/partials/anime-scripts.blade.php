<!-- Anime.js CDN - Version moderne et légère -->
<script src="https://cdn.jsdelivr.net/npm/animejs@3.2.2/lib/anime.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier si Anime.js est chargé
    if (typeof anime === 'undefined') {
        console.error('Anime.js n\'est pas chargé');
        return;
    }

    // Trouver tous les containers de particules
    const particleContainers = document.querySelectorAll('.anime-particles-container');
    
    particleContainers.forEach(particlesContainer => {
        const particleCount = 25; // Nombre de particules
        const particles = [];
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'anime-particle absolute rounded-full';
            const size = anime.random(20, 40);
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.background = `radial-gradient(circle, rgba(158, 16, 171, ${0.4 + Math.random() * 0.3}), rgba(236, 72, 153, ${0.2 + Math.random() * 0.2}))`;
            particle.style.boxShadow = `0 0 ${size * 2}px rgba(158, 16, 171, 0.4)`;
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.opacity = '0';
            particle.style.filter = 'blur(8px)';
            particlesContainer.appendChild(particle);
            particles.push(particle);
        }
        
        // Animation avec timeline et stagger élégant
        const options = {
            grid: [5, 5],
            from: 'center',
        };
        
        anime.timeline({
            loop: true
        })
        .add({
            targets: particlesContainer.querySelectorAll('.anime-particle'),
            opacity: [
                { value: 0.8, duration: 1500, easing: 'easeOutQuad' },
                { value: 0.5, duration: 1500, easing: 'easeInQuad' },
                { value: 0.7, duration: 1000, easing: 'easeInOutQuad' }
            ],
            scale: [
                { value: 1.2, duration: 2000, easing: 'easeInOutSine' },
                { value: 0.8, duration: 2000, easing: 'easeInOutSine' },
                { value: 1, duration: 1500, easing: 'easeInOutSine' }
            ],
            translateX: function() {
                return anime.random(-100, 100);
            },
            translateY: function() {
                return anime.random(-80, 80);
            },
            rotate: [0, 360],
            delay: anime.stagger(300, options),
            duration: 4000,
            easing: 'easeInOutQuad'
        })
        .add({
            targets: particlesContainer.querySelectorAll('.anime-particle'),
            translateX: function() {
                return anime.random(-150, 150);
            },
            translateY: function() {
                return anime.random(-120, 120);
            },
            scale: [
                { value: 1.4, duration: 2500, easing: 'easeOutElastic(1, .8)' },
                { value: 0.7, duration: 2500, easing: 'easeInElastic(1, .8)' },
                { value: 1, duration: 2000, easing: 'easeInOutQuad' }
            ],
            rotate: [360, 720],
            delay: anime.stagger(200, options),
            duration: 5000,
            easing: 'easeInOutSine'
        }, '-=2000');
    });

    // Orbes flottantes élégantes avec trajectoires fluides
    // Trouver tous les orbes sur la page
    const orbs1 = document.querySelectorAll('.anime-orb-1');
    const orbs2 = document.querySelectorAll('.anime-orb-2');
    const orbs3 = document.querySelectorAll('.anime-orb-3');
    
    // Orbe 1 : Mouvement elliptique élégant
    orbs1.forEach((orb, index) => {
        anime({
            targets: orb,
            translateX: [
                { value: 120, duration: 4000, easing: 'easeInOutSine' },
                { value: -80, duration: 4000, easing: 'easeInOutSine' },
                { value: 100, duration: 4000, easing: 'easeInOutSine' },
                { value: 0, duration: 4000, easing: 'easeInOutSine' }
            ],
            translateY: [
                { value: -100, duration: 4000, easing: 'easeInOutSine' },
                { value: 80, duration: 4000, easing: 'easeInOutSine' },
                { value: -60, duration: 4000, easing: 'easeInOutSine' },
                { value: 0, duration: 4000, easing: 'easeInOutSine' }
            ],
            scale: [
                { value: 1.3, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.9, duration: 3000, easing: 'easeInOutQuad' },
                { value: 1.2, duration: 3000, easing: 'easeInOutQuad' },
                { value: 1, duration: 3000, easing: 'easeInOutQuad' }
            ],
            opacity: [
                { value: 0.8, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.5, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.75, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.6, duration: 3000, easing: 'easeInOutQuad' }
            ],
            rotate: [0, 360],
            loop: true,
            delay: index * 500
        });
    });

    // Orbe 2 : Trajectoire circulaire fluide
    orbs2.forEach((orb, index) => {
        anime({
            targets: orb,
            translateX: [
                { value: 150, duration: 5000, easing: 'easeInOutSine' },
                { value: -150, duration: 5000, easing: 'easeInOutSine' },
                { value: 0, duration: 5000, easing: 'easeInOutSine' }
            ],
            translateY: [
                { value: -150, duration: 5000, easing: 'easeInOutSine' },
                { value: 150, duration: 5000, easing: 'easeInOutSine' },
                { value: 0, duration: 5000, easing: 'easeInOutSine' }
            ],
            scale: [
                { value: 1.4, duration: 3500, easing: 'easeOutElastic(1, .7)' },
                { value: 0.8, duration: 3500, easing: 'easeInElastic(1, .7)' },
                { value: 1, duration: 3500, easing: 'easeInOutQuad' }
            ],
            opacity: [
                { value: 0.85, duration: 3500, easing: 'easeInOutQuad' },
                { value: 0.45, duration: 3500, easing: 'easeInOutQuad' },
                { value: 0.75, duration: 3500, easing: 'easeInOutQuad' }
            ],
            rotate: [0, 720],
            loop: true,
            delay: 2000 + (index * 500)
        });
    });

    // Orbe 3 : Mouvement en spirale élégant
    orbs3.forEach((orb, index) => {
        anime({
            targets: orb,
            translateX: [
                { value: 80, duration: 4500, easing: 'easeInOutSine' },
                { value: -100, duration: 4500, easing: 'easeInOutSine' },
                { value: 60, duration: 4500, easing: 'easeInOutSine' },
                { value: 0, duration: 4500, easing: 'easeInOutSine' }
            ],
            translateY: [
                { value: -80, duration: 4500, easing: 'easeInOutSine' },
                { value: 100, duration: 4500, easing: 'easeInOutSine' },
                { value: -60, duration: 4500, easing: 'easeInOutSine' },
                { value: 0, duration: 4500, easing: 'easeInOutSine' }
            ],
            scale: [
                { value: 1.5, duration: 3000, easing: 'easeOutElastic(1, .8)' },
                { value: 0.7, duration: 3000, easing: 'easeInElastic(1, .8)' },
                { value: 1.3, duration: 3000, easing: 'easeOutElastic(1, .8)' },
                { value: 1, duration: 3000, easing: 'easeInElastic(1, .8)' }
            ],
            opacity: [
                { value: 0.9, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.4, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.8, duration: 3000, easing: 'easeInOutQuad' },
                { value: 0.65, duration: 3000, easing: 'easeInOutQuad' }
            ],
            rotate: [0, 360],
            filter: [
                { value: 'blur(40px)', duration: 3000 },
                { value: 'blur(60px)', duration: 3000 },
                { value: 'blur(50px)', duration: 3000 },
                { value: 'blur(40px)', duration: 3000 }
            ],
            loop: true,
            delay: 3000 + (index * 500)
        });
    });
});
</script>


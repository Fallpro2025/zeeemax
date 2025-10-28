/**
 * Système d'alertes ultra-moderne pour ZEEEMAX Admin
 */

class AdminAlert {
    constructor() {
        this.container = null;
        this.init();
    }

    init() {
        // Créer le conteneur si n'existe pas
        if (!document.getElementById('admin-alert-container')) {
            this.container = document.createElement('div');
            this.container.id = 'admin-alert-container';
            this.container.className = 'fixed top-4 right-4 z-50 w-full max-w-md';
            document.body.appendChild(this.container);
        } else {
            this.container = document.getElementById('admin-alert-container');
        }
    }

    /**
     * Afficher une alerte de succès
     */
    success(message, duration = 4000) {
        this.show('success', message, duration);
    }

    /**
     * Afficher une alerte d'erreur
     */
    error(message, duration = 4000) {
        this.show('error', message, duration);
    }

    /**
     * Afficher une alerte d'information
     */
    info(message, duration = 4000) {
        this.show('info', message, duration);
    }

    /**
     * Afficher une alerte d'avertissement
     */
    warning(message, duration = 4000) {
        this.show('warning', message, duration);
    }

    /**
     * Méthode principale pour afficher l'alerte
     */
    show(type, message, duration) {
        const alert = this.createAlert(type, message);
        this.container.appendChild(alert);

        // Animation d'entrée - délai réduit pour affichage immédiat
        requestAnimationFrame(() => {
            alert.classList.add('animate-slide-in');
        });

        // Animation de sortie après duration
        setTimeout(() => {
            alert.classList.add('animate-slide-out');
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 200);
        }, duration);
    }

    /**
     * Créer l'élément d'alerte
     */
    createAlert(type, message) {
        const config = {
            success: {
                icon: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                bg: 'bg-gradient-to-r from-green-500 to-emerald-500',
                text: 'text-white',
                iconBg: 'bg-white/20'
            },
            error: {
                icon: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                bg: 'bg-gradient-to-r from-red-500 to-pink-500',
                text: 'text-white',
                iconBg: 'bg-white/20'
            },
            info: {
                icon: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                bg: 'bg-gradient-to-r from-blue-500 to-cyan-500',
                text: 'text-white',
                iconBg: 'bg-white/20'
            },
            warning: {
                icon: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                bg: 'bg-gradient-to-r from-yellow-500 to-orange-500',
                text: 'text-white',
                iconBg: 'bg-white/20'
            }
        };

        const style = config[type];
        
        const alert = document.createElement('div');
        alert.className = `mb-4 transform translate-x-full opacity-0 transition-all duration-300 ease-in-out shadow-2xl rounded-2xl overflow-hidden ${style.bg}`;
        
        alert.innerHTML = `
            <div class="flex items-start p-4 ${style.text}">
                <div class="flex-shrink-0 ${style.iconBg} rounded-full p-2 mr-3">
                    ${style.icon}
                </div>
                <div class="flex-1">
                    <p class="font-semibold">${message}</p>
                </div>
                <button onclick="this.closest('[id^=\\'admin-alert\\'] > div').classList.add('animate-slide-out'); setTimeout(() => this.closest('[id^=\\'admin-alert\\'] > div').remove(), 200);" 
                        class="ml-2 flex-shrink-0 hover:bg-white/20 rounded-lg p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="h-1 bg-white/30">
                <div class="h-full bg-white/60 animate-progress-bar"></div>
            </div>
        `;

        return alert;
    }
}

// Initialiser le système d'alertes
window.adminAlert = new AdminAlert();

// Styles CSS pour les animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes progressBar {
        from {
            width: 100%;
        }
        to {
            width: 0%;
        }
    }

    .animate-slide-in {
        animation: slideIn 0.2s ease-out forwards;
    }

    .animate-slide-out {
        animation: slideOut 0.2s ease-in forwards;
    }

    .animate-progress-bar {
        animation: progressBar 4s linear forwards;
    }
`;
document.head.appendChild(style);


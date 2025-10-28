/**
 * Système de confirmation moderne pour ZEEEMAX Admin
 */

class AdminConfirm {
    /**
     * Afficher une boîte de confirmation moderne
     */
    async confirm(message, options = {}) {
        const {
            title = 'Confirmation',
            confirmText = 'Confirmer',
            cancelText = 'Annuler',
            type = 'warning',
            confirmClass = 'bg-red-600 hover:bg-red-700',
            cancelClass = 'bg-gray-500 hover:bg-gray-600'
        } = options;

        return new Promise((resolve) => {
            // Créer le backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4';
            backdrop.style.animation = 'fadeIn 0.2s ease-out';
            
            // Créer la modal
            const modal = document.createElement('div');
            modal.className = 'bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 max-w-md w-full transform scale-95 opacity-0';
            modal.style.animation = 'modalSlideIn 0.2s ease-out forwards';
            
            const iconConfig = {
                warning: `<svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                danger: `<svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                info: `<svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                success: `<svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`
            };
            
            modal.innerHTML = `
                <div class="flex flex-col items-center text-center">
                    <div class="mb-4 animate-bounce-in">
                        ${iconConfig[type] || iconConfig.warning}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">${title}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">${message}</p>
                    <div class="flex gap-3 w-full">
                        <button class="flex-1 px-6 py-3 ${cancelClass} text-white rounded-xl font-semibold transform hover:scale-105 transition-all duration-200 shadow-lg" data-action="cancel">
                            ${cancelText}
                        </button>
                        <button class="flex-1 px-6 py-3 ${confirmClass} text-white rounded-xl font-semibold transform hover:scale-105 transition-all duration-200 shadow-lg" data-action="confirm">
                            ${confirmText}
                        </button>
                    </div>
                </div>
            `;
            
            backdrop.appendChild(modal);
            document.body.appendChild(backdrop);
            
            // Gérer les clics
            const handleAction = (action) => {
                const modalAnim = modal.style.animation;
                modal.style.animation = 'modalSlideOut 0.2s ease-in forwards';
                backdrop.style.animation = 'fadeOut 0.2s ease-in forwards';
                
                setTimeout(() => {
                    document.body.removeChild(backdrop);
                    resolve(action === 'confirm');
                }, 200);
            };
            
            modal.querySelector('[data-action="confirm"]').addEventListener('click', () => handleAction('confirm'));
            modal.querySelector('[data-action="cancel"]').addEventListener('click', () => handleAction('cancel'));
            
            // Fermer en cliquant sur le backdrop
            backdrop.addEventListener('click', (e) => {
                if (e.target === backdrop) {
                    handleAction('cancel');
                }
            });
        });
    }
}

// Styles CSS pour les animations
const confirmStyle = document.createElement('style');
confirmStyle.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    @keyframes modalSlideIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes modalSlideOut {
        from {
            transform: scale(1);
            opacity: 1;
        }
        to {
            transform: scale(0.95);
            opacity: 0;
        }
    }

    @keyframes bounceIn {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .animate-bounce-in {
        animation: bounceIn 0.3s ease-out;
    }
`;
document.head.appendChild(confirmStyle);

// Initialiser le système de confirmation
window.adminConfirm = new AdminConfirm();


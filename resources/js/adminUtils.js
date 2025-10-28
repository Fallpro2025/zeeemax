/**
 * Utilitaires Admin - ZEEEMAX
 * Fonctions communes pour l'administration
 */

// Objet global pour les utilitaires admin
window.adminUtils = {
    
    /**
     * Effectue une requête AJAX
     */
    async request(url, options = {}) {
        try {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            };
            
            const mergedOptions = { ...defaultOptions, ...options };
            
            const response = await fetch(url, mergedOptions);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Erreur de requête');
            }
            
            return data;
        } catch (error) {
            console.error('Request error:', error);
            throw error;
        }
    },
    
    /**
     * Affiche un toast notification
     */
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const colors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'warning': 'bg-yellow-500',
            'info': 'bg-blue-500'
        };
        
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${colors[type]} transform translate-y-full opacity-0 transition-all duration-300 z-50`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animation d'entrée
        setTimeout(() => {
            toast.classList.remove('translate-y-full', 'opacity-0');
        }, 100);
        
        // Animation de sortie
        setTimeout(() => {
            toast.classList.add('translate-y-full', 'opacity-0');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    },
    
    /**
     * Debounce function pour optimiser les recherches
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    /**
     * Throttle function pour limiter les appels
     */
    throttle(func, limit) {
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
    },
    
    /**
     * Confirmation avec dialogue personnalisé
     */
    confirmDialog(message, title = 'Confirmation') {
        return new Promise((resolve) => {
            const dialog = document.createElement('div');
            dialog.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
            dialog.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 max-w-md w-full mx-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">${title}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">${message}</p>
                    <div class="flex justify-end space-x-3">
                        <button class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-lg" onclick="this.closest('.fixed').remove();">
                            Annuler
                        </button>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="this.closest('.fixed').remove(); window.__confirmResult = true;">
                            Confirmer
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(dialog);
            
            dialog.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.remove();
                    resolve(false);
                }
            });
            
            dialog.querySelector('button:last-child').addEventListener('click', function() {
                resolve(true);
            });
        });
    }
};


/**
 * Recipe Enhancements JavaScript
 * Handles interactive features: serving adjuster, timers, checkboxes, etc.
 */

(function() {
    'use strict';

    // Store original ingredient quantities for scaling
    let originalServings = 4;
    let originalIngredients = [];

    /**
     * Initialize on DOM ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initServingAdjuster();
        initLazyLoading();
        initSmoothScroll();
        storeOriginalIngredients();
    });

    /**
     * Store original ingredient text for scaling
     */
    function storeOriginalIngredients() {
        const servingsInput = document.getElementById('servings-input');
        if (servingsInput) {
            originalServings = parseInt(servingsInput.value) || 4;
        }

        const ingredientItems = document.querySelectorAll('.ingredient-text');
        ingredientItems.forEach(function(item) {
            originalIngredients.push(item.textContent);
        });
    }

    /**
     * Adjust Servings - Scale ingredient quantities
     */
    window.adjustServings = function(change) {
        const servingsInput = document.getElementById('servings-input');
        if (!servingsInput) return;

        let currentServings = parseInt(servingsInput.value) || 4;
        let newServings = currentServings + change;

        // Limit servings between 1 and 20
        if (newServings < 1) newServings = 1;
        if (newServings > 20) newServings = 20;

        servingsInput.value = newServings;

        // Scale ingredient quantities
        const multiplier = newServings / originalServings;
        const ingredientItems = document.querySelectorAll('.ingredient-text');

        ingredientItems.forEach(function(item, index) {
            if (originalIngredients[index]) {
                const scaledText = scaleIngredient(originalIngredients[index], multiplier);
                item.textContent = scaledText;
            }
        });
    };

    /**
     * Scale ingredient text (find numbers and multiply)
     */
    function scaleIngredient(text, multiplier) {
        // Match fractions and decimals
        return text.replace(/(\d+\.?\d*|\d*\.\d+|½|⅓|⅔|¼|¾|⅛|⅜|⅝|⅞)/g, function(match) {
            let num = match;

            // Convert fractions to decimals
            const fractions = {
                '½': 0.5, '⅓': 0.333, '⅔': 0.667,
                '¼': 0.25, '¾': 0.75,
                '⅛': 0.125, '⅜': 0.375, '⅝': 0.625, '⅞': 0.875
            };

            if (fractions[num]) {
                num = fractions[num];
            } else {
                num = parseFloat(num);
            }

            const scaled = num * multiplier;

            // Format nicely
            if (scaled % 1 === 0) {
                return scaled.toString();
            } else if (Math.abs(scaled - 0.5) < 0.01) {
                return '½';
            } else if (Math.abs(scaled - 0.333) < 0.01) {
                return '⅓';
            } else if (Math.abs(scaled - 0.667) < 0.01) {
                return '⅔';
            } else if (Math.abs(scaled - 0.25) < 0.01) {
                return '¼';
            } else if (Math.abs(scaled - 0.75) < 0.01) {
                return '¾';
            } else {
                return scaled.toFixed(1);
            }
        });
    }

    /**
     * Initialize serving adjuster buttons
     */
    function initServingAdjuster() {
        const servingsInput = document.getElementById('servings-input');
        if (servingsInput) {
            originalServings = parseInt(servingsInput.value) || 4;
        }
    }

    /**
     * Clear Checked Ingredients
     */
    window.clearCheckedIngredients = function() {
        const checkboxes = document.querySelectorAll('.ingredient-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    };

    /**
     * Start Timer for cooking steps
     */
    window.startTimer = function(defaultMinutes, button) {
        const parentItem = button.closest('.direction-item');
        const timerDisplay = parentItem.querySelector('.timer-display');

        if (!timerDisplay) return;

        // Prompt for custom time
        const minutes = prompt('Timer duration (minutes):', defaultMinutes);
        if (!minutes || isNaN(minutes)) return;

        let totalSeconds = parseInt(minutes) * 60;

        // Show timer display
        timerDisplay.style.display = 'block';
        button.classList.add('active');

        const timerInterval = setInterval(function() {
            totalSeconds--;

            const mins = Math.floor(totalSeconds / 60);
            const secs = totalSeconds % 60;
            timerDisplay.textContent = mins + ':' + (secs < 10 ? '0' : '') + secs;

            if (totalSeconds <= 0) {
                clearInterval(timerInterval);
                timerDisplay.textContent = '⏰ Time\'s Up!';
                button.classList.remove('active');

                // Play notification sound (optional)
                if ('Notification' in window && Notification.permission === 'granted') {
                    new Notification('Timer Complete!', {
                        body: 'Your cooking timer has finished.',
                        icon: '/wp-content/themes/foodica-child/images/timer-icon.png'
                    });
                } else {
                    alert('Timer Complete!');
                }

                // Hide after 3 seconds
                setTimeout(function() {
                    timerDisplay.style.display = 'none';
                }, 3000);
            }
        }, 1000);
    };

    /**
     * Toggle Nutrition Panel
     */
    window.toggleNutrition = function() {
        const panel = document.querySelector('.nutrition-panel');
        if (!panel) return;

        if (panel.style.display === 'none' || !panel.style.display) {
            panel.style.display = 'block';
        } else {
            panel.style.display = 'none';
        }
    };

    /**
     * Lazy Loading Images with IntersectionObserver
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img.lazyload');

            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');
                        if (src) {
                            img.src = src;
                            img.classList.remove('lazyload');
                            img.classList.add('lazyloaded');
                        }
                        observer.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            const lazyImages = document.querySelectorAll('img.lazyload');
            lazyImages.forEach(function(img) {
                const src = img.getAttribute('data-src');
                if (src) {
                    img.src = src;
                }
            });
        }
    }

    /**
     * Smooth Scroll to Recipe Section
     */
    function initSmoothScroll() {
        const jumpButton = document.querySelector('.btn-jump');
        if (jumpButton) {
            jumpButton.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector('#recipe-section');
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }
    }

    /**
     * Request notification permission (optional)
     */
    if ('Notification' in window && Notification.permission === 'default') {
        // Request permission when user first interacts with timer
        document.addEventListener('click', function requestNotificationPermission() {
            if (event.target.classList.contains('timer-btn')) {
                Notification.requestPermission();
                document.removeEventListener('click', requestNotificationPermission);
            }
        });
    }

})();

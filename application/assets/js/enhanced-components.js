/**
 * Enhanced Components JavaScript
 * Synchronized with timezone modal and sidebar design system
 */

$(document).ready(function() {
    
    // ===========================================
    // COMPONENT INITIALIZATION
    // ===========================================
    
    initializeEnhancedComponents();
    
    function initializeEnhancedComponents() {
        // Initialize enhanced tables
        initializeEnhancedTables();
        
        // Initialize enhanced forms
        initializeEnhancedForms();
        
        // Initialize enhanced cards
        initializeEnhancedCards();
        
        // Initialize enhanced buttons
        initializeEnhancedButtons();
        
        // Initialize enhanced alerts
        initializeEnhancedAlerts();
        
        // Initialize loading animations
        initializeLoadingAnimations();
        
        // Initialize responsive behavior
        initializeResponsiveBehavior();
        
        console.log('Enhanced components initialized successfully');
    }
    
    // ===========================================
    // TABLE ENHANCEMENTS
    // ===========================================
    
    function initializeEnhancedTables() {
        // Wrap tables in containers if not already wrapped
        $('.table:not(.dataTable)').each(function() {
            const $table = $(this);
            if (!$table.closest('.table-container').length) {
                $table.wrap('<div class="table-container"></div>');
            }
        });
        
        // Enhanced DataTables initialization
        if ($.fn.DataTable) {
            // Apply enhanced styling to existing DataTables
            $('.dataTable').each(function() {
                const $table = $(this);
                const $wrapper = $table.closest('.dataTables_wrapper');
                
                if ($wrapper.length) {
                    enhanceDataTableWrapper($wrapper);
                }
            });
            
            // Override default DataTables options
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    search: '<i class="fas fa-search"></i>',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-5"i><"col-sm-7"p>>',
                pageLength: 25,
                responsive: true,
                autoWidth: false,
                drawCallback: function(settings) {
                    // Add animations to new rows
                    $(this.api().table().node()).find('tbody tr').addClass('fade-in-up');
                }
            });
        }
        
        // Add row hover effects
        $('.table tbody tr, .dataTable tbody tr').hover(
            function() {
                $(this).addClass('table-row-hover');
            },
            function() {
                $(this).removeClass('table-row-hover');
            }
        );
    }
    
    function enhanceDataTableWrapper($wrapper) {
        // Add enhanced classes
        $wrapper.addClass('enhanced-datatable');
        
        // Enhance search input
        const $searchInput = $wrapper.find('.dataTables_filter input');
        $searchInput.attr('placeholder', 'Search records...');
        $searchInput.addClass('enhanced-search');
        
        // Enhance pagination
        $wrapper.find('.dataTables_paginate .paginate_button').addClass('enhanced-pagination');
        
        // Add loading indicator
        if (!$wrapper.find('.table-loading').length) {
            $wrapper.prepend('<div class="table-loading" style="display: none;"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        }
    }
    
    // ===========================================
    // FORM ENHANCEMENTS
    // ===========================================
    
    function initializeEnhancedForms() {
        // Enhance form controls
        $('.form-control, .form-control-lg').each(function() {
            const $input = $(this);
            
            // Add focus/blur effects
            $input.on('focus', function() {
                $(this).closest('.form-group').addClass('form-group-focused');
            });
            
            $input.on('blur', function() {
                $(this).closest('.form-group').removeClass('form-group-focused');
            });
            
            // Add validation styling
            $input.on('invalid', function() {
                $(this).addClass('is-invalid-enhanced');
            });
            
            $input.on('input', function() {
                $(this).removeClass('is-invalid-enhanced');
            });
        });
        
        // Enhance select elements
        $('select.form-control').each(function() {
            $(this).addClass('enhanced-select');
        });
        
        // Add floating labels effect
        $('.form-group').each(function() {
            const $group = $(this);
            const $input = $group.find('.form-control, .form-control-lg');
            const $label = $group.find('label');
            
            if ($input.length && $label.length) {
                // Check if input has value
                function checkInputValue() {
                    if ($input.val() && $input.val().length > 0) {
                        $group.addClass('has-value');
                    } else {
                        $group.removeClass('has-value');
                    }
                }
                
                $input.on('input blur', checkInputValue);
                checkInputValue(); // Initial check
            }
        });
    }
    
    // ===========================================
    // CARD ENHANCEMENTS
    // ===========================================
    
    function initializeEnhancedCards() {
        // Add hover effects to cards
        $('.card').hover(
            function() {
                $(this).addClass('card-hover');
            },
            function() {
                $(this).removeClass('card-hover');
            }
        );
        
        // Enhance card headers
        $('.card-header').each(function() {
            const $header = $(this);
            
            // Add icons to headers if not present
            const $title = $header.find('h1, h2, h3, h4, h5, h6').first();
            if ($title.length && !$title.find('i').length) {
                // Add default icon based on content
                const titleText = $title.text().toLowerCase();
                let icon = 'fas fa-info-circle';
                
                if (titleText.includes('patient')) icon = 'fas fa-user';
                else if (titleText.includes('doctor')) icon = 'fas fa-user-md';
                else if (titleText.includes('appointment')) icon = 'fas fa-calendar';
                else if (titleText.includes('report')) icon = 'fas fa-chart-bar';
                else if (titleText.includes('setting')) icon = 'fas fa-cog';
                else if (titleText.includes('finance')) icon = 'fas fa-dollar-sign';
                
                $title.prepend(`<i class="${icon}"></i> `);
            }
        });
        
        // Add collapsible functionality
        $('.card[data-collapse]').each(function() {
            const $card = $(this);
            const $header = $card.find('.card-header');
            const $body = $card.find('.card-body');
            
            // Add collapse button
            if (!$header.find('.card-collapse-btn').length) {
                $header.append('<button class="btn btn-sm card-collapse-btn"><i class="fas fa-minus"></i></button>');
            }
            
            // Handle collapse
            $header.find('.card-collapse-btn').on('click', function() {
                const $btn = $(this);
                const $icon = $btn.find('i');
                
                $body.slideToggle(300);
                
                if ($icon.hasClass('fa-minus')) {
                    $icon.removeClass('fa-minus').addClass('fa-plus');
                } else {
                    $icon.removeClass('fa-plus').addClass('fa-minus');
                }
            });
        });
    }
    
    // ===========================================
    // BUTTON ENHANCEMENTS
    // ===========================================
    
    function initializeEnhancedButtons() {
        // Add ripple effect to buttons
        $('.btn').on('click', function(e) {
            const $btn = $(this);
            
            // Create ripple element
            const $ripple = $('<span class="btn-ripple"></span>');
            const btnOffset = $btn.offset();
            const x = e.pageX - btnOffset.left;
            const y = e.pageY - btnOffset.top;
            
            $ripple.css({
                left: x,
                top: y
            });
            
            $btn.append($ripple);
            
            // Remove ripple after animation
            setTimeout(() => {
                $ripple.remove();
            }, 600);
        });
        
        // Add loading state functionality
        $('.btn[data-loading-text]').on('click', function() {
            const $btn = $(this);
            const originalText = $btn.html();
            const loadingText = $btn.data('loading-text');
            
            $btn.html('<i class="fas fa-spinner fa-spin"></i> ' + loadingText);
            $btn.prop('disabled', true);
            
            // Restore after 3 seconds (or when form is submitted)
            setTimeout(() => {
                $btn.html(originalText);
                $btn.prop('disabled', false);
            }, 3000);
        });
        
        // Enhance button groups
        $('.btn-group .btn').hover(
            function() {
                $(this).closest('.btn-group').addClass('btn-group-hover');
            },
            function() {
                $(this).closest('.btn-group').removeClass('btn-group-hover');
            }
        );
    }
    
    // ===========================================
    // ALERT ENHANCEMENTS
    // ===========================================
    
    function initializeEnhancedAlerts() {
        // Auto-dismiss alerts
        $('.alert[data-auto-dismiss]').each(function() {
            const $alert = $(this);
            const delay = $alert.data('auto-dismiss') || 5000;
            
            setTimeout(() => {
                $alert.fadeOut(300, function() {
                    $(this).remove();
                });
            }, delay);
        });
        
        // Add close functionality to alerts without close button
        $('.alert:not(:has(.close))').each(function() {
            const $alert = $(this);
            $alert.append('<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        });
        
        // Enhanced alert animations
        $('.alert').each(function() {
            $(this).addClass('fade-in-up');
        });
    }
    
    // ===========================================
    // LOADING ANIMATIONS
    // ===========================================
    
    function initializeLoadingAnimations() {
        // Stagger animations for table rows
        $('.table tbody tr').each(function(index) {
            $(this).css('animation-delay', (index * 0.05) + 's');
        });
        
        // Stagger animations for cards
        $('.card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });
        
        // Add intersection observer for scroll animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, { threshold: 0.1 });
            
            // Observe elements
            document.querySelectorAll('.card, .table-container, .panel').forEach(el => {
                observer.observe(el);
            });
        }
    }
    
    // ===========================================
    // RESPONSIVE BEHAVIOR
    // ===========================================
    
    function initializeResponsiveBehavior() {
        // Handle responsive tables
        function handleResponsiveTables() {
            $('.table-container').each(function() {
                const $container = $(this);
                const $table = $container.find('table');
                
                if ($(window).width() < 768) {
                    $container.addClass('table-responsive-mobile');
                    $table.addClass('table-mobile');
                } else {
                    $container.removeClass('table-responsive-mobile');
                    $table.removeClass('table-mobile');
                }
            });
        }
        
        // Handle responsive cards
        function handleResponsiveCards() {
            $('.card').each(function() {
                const $card = $(this);
                
                if ($(window).width() < 768) {
                    $card.addClass('card-mobile');
                } else {
                    $card.removeClass('card-mobile');
                }
            });
        }
        
        // Initial call
        handleResponsiveTables();
        handleResponsiveCards();
        
        // Handle resize
        let resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                handleResponsiveTables();
                handleResponsiveCards();
            }, 250);
        });
    }
    
    // ===========================================
    // UTILITY FUNCTIONS
    // ===========================================
    
    // Show loading overlay
    window.showLoadingOverlay = function(message = 'Loading...') {
        const overlay = `
            <div class="loading-overlay">
                <div class="loading-content">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>${message}</p>
                </div>
            </div>
        `;
        $('body').append(overlay);
    };
    
    // Hide loading overlay
    window.hideLoadingOverlay = function() {
        $('.loading-overlay').fadeOut(300, function() {
            $(this).remove();
        });
    };
    
    // Show notification
    window.showNotification = function(message, type = 'info', duration = 5000) {
        const notification = `
            <div class="notification notification-${type}">
                <div class="notification-content">
                    <i class="fas fa-${getNotificationIcon(type)}"></i>
                    <span>${message}</span>
                    <button class="notification-close">&times;</button>
                </div>
            </div>
        `;
        
        const $notification = $(notification);
        $('body').append($notification);
        
        // Auto dismiss
        setTimeout(() => {
            $notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, duration);
        
        // Manual dismiss
        $notification.find('.notification-close').on('click', function() {
            $notification.fadeOut(300, function() {
                $(this).remove();
            });
        });
    };
    
    function getNotificationIcon(type) {
        switch(type) {
            case 'success': return 'check-circle';
            case 'error': return 'exclamation-circle';
            case 'warning': return 'exclamation-triangle';
            default: return 'info-circle';
        }
    }
    
    // ===========================================
    // GLOBAL EVENT HANDLERS
    // ===========================================
    
    // Handle AJAX form submissions
    $(document).on('submit', 'form[data-ajax]', function(e) {
        e.preventDefault();
        const $form = $(this);
        const url = $form.attr('action') || window.location.href;
        const method = $form.attr('method') || 'POST';
        const data = $form.serialize();
        
        showLoadingOverlay('Submitting...');
        
        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                hideLoadingOverlay();
                showNotification('Form submitted successfully!', 'success');
                
                // Trigger custom event
                $form.trigger('ajax:success', [response]);
            },
            error: function(xhr) {
                hideLoadingOverlay();
                showNotification('An error occurred. Please try again.', 'error');
                
                // Trigger custom event
                $form.trigger('ajax:error', [xhr]);
            }
        });
    });
    
    // Handle dynamic content loading
    $(document).on('click', '[data-load-content]', function(e) {
        e.preventDefault();
        const $trigger = $(this);
        const url = $trigger.data('load-content');
        const target = $trigger.data('target') || '#main-content';
        
        showLoadingOverlay('Loading content...');
        
        $.get(url)
            .done(function(data) {
                $(target).html(data);
                
                // Re-initialize components for new content
                initializeEnhancedComponents();
                
                hideLoadingOverlay();
                showNotification('Content loaded successfully!', 'success');
            })
            .fail(function() {
                hideLoadingOverlay();
                showNotification('Failed to load content.', 'error');
            });
    });
    
    // ===========================================
    // PERFORMANCE OPTIMIZATIONS
    // ===========================================
    
    // Debounce search inputs
    $(document).on('input', '.dataTables_filter input, .enhanced-search', debounce(function() {
        // Search functionality handled by DataTables
    }, 300));
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // ===========================================
    // INITIALIZATION COMPLETE
    // ===========================================
    
    console.log('Enhanced components system ready');
    
    // Trigger ready event
    $(document).trigger('enhanced-components:ready');
});

// ===========================================
// CSS INJECTION FOR DYNAMIC STYLES
// ===========================================

const additionalCSS = `
<style>
/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-content {
    text-align: center;
    color: #374151;
}

.loading-content i {
    color: #3b82f6;
    margin-bottom: 15px;
}

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    z-index: 9998;
    min-width: 300px;
    animation: slideInRight 0.3s ease;
}

.notification-content {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.notification-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: auto;
    color: #6b7280;
}

.notification-success { border-left: 4px solid #10b981; }
.notification-error { border-left: 4px solid #ef4444; }
.notification-warning { border-left: 4px solid #f59e0b; }
.notification-info { border-left: 4px solid #3b82f6; }

/* Button Ripple Effect */
.btn {
    position: relative;
    overflow: hidden;
}

.btn-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    width: 20px;
    height: 20px;
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Form Enhancements */
.form-group-focused .form-control {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
}

.is-invalid-enhanced {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
}

/* Table Enhancements */
.table-row-hover {
    background: #e0e7ff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1) !important;
}

/* Card Enhancements */
.card-hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.card-collapse-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
    color: white !important;
    padding: 5px 8px !important;
    border-radius: 6px !important;
}

/* Animation Classes */
.animate-in {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .notification {
        right: 10px;
        left: 10px;
        min-width: auto;
    }
    
    .table-responsive-mobile {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .card-mobile {
        margin-left: -15px;
        margin-right: -15px;
        border-radius: 0;
        border-left: none;
        border-right: none;
    }
}
</style>
`;

// Inject additional CSS
document.head.insertAdjacentHTML('beforeend', additionalCSS);

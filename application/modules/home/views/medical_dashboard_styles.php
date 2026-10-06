<!-- Medical Dashboard Enhanced Styles -->
<style>
    :root {
        /* Medical Color Palette */
        --medical-primary: #2563eb;
        --medical-secondary: #0ea5e9;
        --medical-accent: #06b6d4;
        --medical-success: #10b981;
        --medical-warning: #f59e0b;
        --medical-danger: #ef4444;
        --medical-info: #3b82f6;
        
        /* Healthcare Specific Colors */
        --cardiology: #dc2626;
        --emergency: #b91c1c;
        --neurology: #7c3aed;
        --orthopedic: #059669;
        --pediatric: #f97316;
        --radiology: #0891b2;
        --laboratory: #8b5cf6;
        --pharmacy: #16a34a;
        
        /* Background Gradients */
        --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-gradient: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        --medical-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        
        /* Shadows */
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        
        /* Border Radius */
        --rounded-md: 0.375rem;
        --rounded-lg: 0.5rem;
        --rounded-xl: 0.75rem;
        --rounded-2xl: 1rem;
    }

    /* Medical Dashboard Background */
    .medical-dashboard-bg {
        background: var(--bg-gradient) !important;
        min-height: 100vh;
        position: relative;
    }

    .medical-dashboard-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        z-index: 0;
    }

    .medical-dashboard-bg > * {
        position: relative;
        z-index: 1;
    }

    /* Enhanced Welcome Section */
    .welcome-text-container {
        background: var(--card-gradient);
        border-radius: var(--rounded-xl);
        padding: 2rem;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .welcome-text-container:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-2xl);
    }

    .user-image-container img {
        border: 4px solid white;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s ease;
    }

    .user-image-container img:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-xl);
    }

    .welcome-text {
        background: var(--medical-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Enhanced Stat Cards */
    .stat-card {
        background: var(--card-gradient) !important;
        border-radius: var(--rounded-xl) !important;
        box-shadow: var(--shadow-lg) !important;
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        transition: all 0.3s ease !important;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--medical-primary);
        z-index: 1;
    }

    .stat-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: var(--shadow-2xl) !important;
    }

    .stat-card.cardiology::before { background: var(--cardiology); }
    .stat-card.emergency::before { background: var(--emergency); }
    .stat-card.neurology::before { background: var(--neurology); }
    .stat-card.orthopedic::before { background: var(--orthopedic); }
    .stat-card.pediatric::before { background: var(--pediatric); }
    .stat-card.laboratory::before { background: var(--laboratory); }
    .stat-card.pharmacy::before { background: var(--pharmacy); }

    .stat-card-body {
        padding: 1.5rem !important;
        position: relative;
        z-index: 2;
    }

    .stat-number {
        font-size: 3rem !important;
        font-weight: 800 !important;
        color: #1f2937 !important;
        margin-bottom: 0.5rem !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-text {
        font-weight: 600 !important;
        color: #6b7280 !important;
        margin-bottom: 1rem !important;
    }

    /* Medical Icons Enhancement */
    .stat-icon-medical {
        width: 60px;
        height: 60px;
        border-radius: var(--rounded-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-md);
    }

    .stat-icon-medical.cardiology { background: linear-gradient(135deg, var(--cardiology), #b91c1c); }
    .stat-icon-medical.emergency { background: linear-gradient(135deg, var(--emergency), #991b1b); }
    .stat-icon-medical.neurology { background: linear-gradient(135deg, var(--neurology), #6d28d9); }
    .stat-icon-medical.orthopedic { background: linear-gradient(135deg, var(--orthopedic), #047857); }
    .stat-icon-medical.pediatric { background: linear-gradient(135deg, var(--pediatric), #ea580c); }
    .stat-icon-medical.laboratory { background: linear-gradient(135deg, var(--laboratory), #7c2d12); }
    .stat-icon-medical.pharmacy { background: linear-gradient(135deg, var(--pharmacy), #15803d); }

    /* Enhanced Charts */
    .card {
        background: var(--card-gradient) !important;
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        box-shadow: var(--shadow-lg) !important;
        border-radius: var(--rounded-xl) !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl) !important;
    }

    .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
        border-bottom: 2px solid #e5e7eb !important;
        border-radius: var(--rounded-xl) var(--rounded-xl) 0 0 !important;
        padding: 1.5rem !important;
    }

    .card-title {
        font-weight: 700 !important;
        color: #1f2937 !important;
        font-size: 1.25rem !important;
    }

    /* Critical Alerts Enhancement */
    .alert {
        border-radius: var(--rounded-xl) !important;
        border: none !important;
        box-shadow: var(--shadow-lg) !important;
        backdrop-filter: blur(10px);
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
        color: #065f46 !important;
        border-left: 4px solid var(--medical-success) !important;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
        color: #7f1d1d !important;
        border-left: 4px solid var(--medical-danger) !important;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
        color: #92400e !important;
        border-left: 4px solid var(--medical-warning) !important;
    }

    .alert-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
        color: #1e3a8a !important;
        border-left: 4px solid var(--medical-info) !important;
    }

    /* Enhanced Buttons */
    .btn {
        border-radius: var(--rounded-lg) !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        box-shadow: var(--shadow-sm) !important;
        text-transform: none !important;
    }

    .btn:hover {
        transform: translateY(-1px) !important;
        box-shadow: var(--shadow-md) !important;
    }

    .btn-primary {
        background: var(--medical-gradient) !important;
        border: none !important;
    }

    .btn-success {
        background: linear-gradient(135deg, var(--medical-success), #059669) !important;
        border: none !important;
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--medical-danger), #dc2626) !important;
        border: none !important;
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--medical-warning), #d97706) !important;
        border: none !important;
    }

    .btn-info {
        background: linear-gradient(135deg, var(--medical-info), #2563eb) !important;
        border: none !important;
    }

    /* Small Box Enhancement */
    .small-box {
        border-radius: var(--rounded-xl) !important;
        box-shadow: var(--shadow-lg) !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    .small-box:hover {
        transform: translateY(-3px) !important;
        box-shadow: var(--shadow-xl) !important;
    }

    .small-box-footer {
        background: rgba(0, 0, 0, 0.1) !important;
        border-radius: 0 0 var(--rounded-xl) var(--rounded-xl) !important;
        backdrop-filter: blur(5px);
    }

    /* Medical Status Indicators */
    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
        animation: pulse 2s infinite;
    }

    .status-active { background: var(--medical-success); }
    .status-warning { background: var(--medical-warning); }
    .status-critical { background: var(--medical-danger); }
    .status-maintenance { background: #6b7280; }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* Quick Actions Enhancement */
    .quick-action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .quick-action-card {
        background: var(--card-gradient);
        border-radius: var(--rounded-xl);
        padding: 1.5rem;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 1rem;
        box-shadow: var(--shadow-md);
        backdrop-filter: blur(10px);
    }

    .quick-action-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        border-color: var(--medical-primary);
        color: inherit;
        text-decoration: none;
    }

    .quick-action-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--rounded-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        background: var(--medical-gradient);
        box-shadow: var(--shadow-md);
    }

    /* Emergency Enhancement */
    .emergency-pulse {
        animation: emergency-pulse 1.5s infinite;
    }

    @keyframes emergency-pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
        }
    }

    /* Loading States */
    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .medical-dashboard-bg {
            padding: 0.5rem;
        }
        
        .welcome-text-container {
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2rem !important;
        }
        
        .user-image-container img {
            width: 50px !important;
            height: 50px !important;
        }
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--medical-gradient);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8, #667eea);
    }

    /* Print Styles */
    @media print {
        .medical-dashboard-bg {
            background: white !important;
        }
        
        .card, .stat-card {
            box-shadow: none !important;
            border: 1px solid #e5e7eb !important;
        }
    }
</style>

<!-- Additional Medical Dashboard JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add medical status indicators
    addMedicalStatusIndicators();
    
    // Initialize real-time updates
    initializeRealTimeUpdates();
    
    // Add emergency protocols
    initializeEmergencyProtocols();
    
    // Enhanced animations
    addEnhancedAnimations();
});

function addMedicalStatusIndicators() {
    // Add status indicators to existing cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        const specialties = ['cardiology', 'emergency', 'neurology', 'orthopedic', 'pediatric', 'laboratory', 'pharmacy'];
        if (specialties[index]) {
            card.classList.add(specialties[index]);
        }
    });
}

function initializeRealTimeUpdates() {
    // Simulate real-time data updates
    setInterval(function() {
        updateDashboardMetrics();
    }, 30000); // Update every 30 seconds
}

function updateDashboardMetrics() {
    // Simulate updating metrics with smooth animations
    const numbers = document.querySelectorAll('.stat-number');
    numbers.forEach(function(number) {
        const currentValue = parseInt(number.textContent);
        const variation = Math.floor(Math.random() * 5) - 2; // -2 to +2
        const newValue = Math.max(0, currentValue + variation);
        
        // Animate the change
        animateValue(number, currentValue, newValue, 1000);
    });
}

function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const current = Math.floor(progress * (end - start) + start);
        element.textContent = current;
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

function initializeEmergencyProtocols() {
    // Add emergency button functionality
    const emergencyBtns = document.querySelectorAll('.btn-danger, .emergency-btn');
    emergencyBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            if (this.textContent.toLowerCase().includes('emergency')) {
                e.preventDefault();
                showEmergencyDialog();
            }
        });
    });
}

function showEmergencyDialog() {
    if (confirm('🚨 EMERGENCY ALERT 🚨\n\nThis will activate emergency protocols and notify all relevant staff.\n\nAre you sure you want to proceed?')) {
        // Add emergency pulse animation
        document.body.classList.add('emergency-mode');
        
        // Show notification
        showNotification('Emergency protocols activated! All relevant staff have been notified.', 'emergency');
        
        // Remove emergency mode after 10 seconds
        setTimeout(() => {
            document.body.classList.remove('emergency-mode');
        }, 10000);
    }
}

function addEnhancedAnimations() {
    // Add intersection observer for card animations
    const cards = document.querySelectorAll('.stat-card, .card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    cards.forEach((card) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed`;
    notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        border-radius: 12px;
        box-shadow: var(--shadow-xl);
        backdrop-filter: blur(10px);
    `;
    notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-${type === 'emergency' ? 'exclamation-triangle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button type="button" class="close ml-auto" onclick="this.parentElement.parentElement.remove()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Medical Dashboard Enhancements
function initializeMedicalDashboard() {
    // Add loading states
    document.querySelectorAll('.stat-number').forEach(function(element) {
        element.classList.add('loading-skeleton');
        setTimeout(() => {
            element.classList.remove('loading-skeleton');
        }, 1000);
    });
    
    // Add hover effects for better UX
    document.querySelectorAll('.stat-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// Initialize on page load
window.addEventListener('load', initializeMedicalDashboard);
</script>

/**
 * Dashboard Real-time Updates JavaScript
 * Hospital Management System - Dashboard Module
 */

class DashboardManager {
    constructor() {
        this.refreshInterval = 300000; // 5 minutes
        this.charts = {};
        this.init();
    }

    init() {
        this.setupAutoRefresh();
        this.setupRealTimeUpdates();
        this.setupChartAnimations();
    }

    setupAutoRefresh() {
        // Auto-refresh dashboard data
        setInterval(() => {
            this.refreshDashboardData();
        }, this.refreshInterval);
    }

    setupRealTimeUpdates() {
        // Real-time updates for critical metrics
        setInterval(() => {
            this.updateRealTimeMetrics();
        }, 30000); // Update every 30 seconds
    }

    setupChartAnimations() {
        // Add smooth animations to charts
        if (typeof Chart !== 'undefined') {
            Chart.defaults.animation = {
                duration: 1000,
                easing: 'easeInOutQuart'
            };
        }
    }

    refreshDashboardData() {
        const dashboardType = this.getCurrentDashboardType();
        
        fetch('dashboard/getRealTimeMetrics', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `dashboard_type=${dashboardType}`
        })
        .then(response => response.json())
        .then(data => {
            this.updateDashboardMetrics(data);
            console.log(`${dashboardType} dashboard updated:`, data);
        })
        .catch(error => {
            console.error('Error refreshing dashboard data:', error);
        });
    }

    updateRealTimeMetrics() {
        const dashboardType = this.getCurrentDashboardType();
        
        fetch('dashboard/getChartData', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `chart_type=revenue_trend&period=30`
        })
        .then(response => response.json())
        .then(data => {
            this.updateCharts(data);
        })
        .catch(error => {
            console.error('Error updating real-time metrics:', error);
        });
    }

    getCurrentDashboardType() {
        const path = window.location.pathname;
        if (path.includes('/executive')) return 'executive';
        if (path.includes('/clinical')) return 'clinical';
        if (path.includes('/financial')) return 'financial';
        if (path.includes('/operational')) return 'operational';
        return 'executive';
    }

    updateDashboardMetrics(data) {
        // Update metric cards with new data
        Object.keys(data).forEach(key => {
            const element = document.querySelector(`[data-metric="${key}"]`);
            if (element) {
                const currentValue = element.textContent;
                const newValue = this.formatMetricValue(key, data[key]);
                
                if (currentValue !== newValue) {
                    this.animateValueChange(element, currentValue, newValue);
                }
            }
        });
    }

    updateCharts(data) {
        // Update charts with new data
        Object.keys(this.charts).forEach(chartId => {
            const chart = this.charts[chartId];
            if (chart && data[chartId]) {
                chart.data = data[chartId];
                chart.update('active');
            }
        });
    }

    formatMetricValue(key, value) {
        if (key.includes('revenue') || key.includes('amount') || key.includes('cost')) {
            return '$' + Number(value).toLocaleString();
        }
        if (key.includes('percentage') || key.includes('rate')) {
            return Number(value).toFixed(1) + '%';
        }
        return Number(value).toLocaleString();
    }

    animateValueChange(element, oldValue, newValue) {
        element.style.transition = 'all 0.3s ease';
        element.style.transform = 'scale(1.1)';
        element.style.color = '#27ae60';
        
        setTimeout(() => {
            element.textContent = newValue;
            element.style.transform = 'scale(1)';
            element.style.color = '';
        }, 150);
    }

    registerChart(chartId, chartInstance) {
        this.charts[chartId] = chartInstance;
    }

    exportDashboard(format = 'pdf') {
        const dashboardType = this.getCurrentDashboardType();
        window.open(`dashboard/exportDashboard?type=${dashboardType}&format=${format}`, '_blank');
    }

    refreshDashboard() {
        location.reload();
    }

    setupNotifications() {
        // Request notification permission
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
    }

    showNotification(title, message, type = 'info') {
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification(title, {
                body: message,
                icon: '/assets/img/notification-icon.png'
            });
        }
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl + R: Refresh dashboard
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                this.refreshDashboard();
            }
            
            // Ctrl + E: Export dashboard
            if (e.ctrlKey && e.key === 'e') {
                e.preventDefault();
                this.exportDashboard();
            }
        });
    }
}

// Initialize dashboard manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.dashboardManager = new DashboardManager();
    window.dashboardManager.setupNotifications();
    window.dashboardManager.setupKeyboardShortcuts();
});

// Utility functions for dashboard
const DashboardUtils = {
    formatCurrency: (value) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(value);
    },

    formatNumber: (value) => {
        return new Intl.NumberFormat('en-US').format(value);
    },

    formatPercentage: (value) => {
        return Number(value).toFixed(1) + '%';
    },

    getStatusColor: (status) => {
        const colors = {
            'good': '#27ae60',
            'warning': '#f39c12',
            'danger': '#e74c3c',
            'info': '#3498db'
        };
        return colors[status] || '#7f8c8d';
    },

    createStatusIndicator: (status) => {
        const color = DashboardUtils.getStatusColor(status);
        return `<span class="status-indicator" style="background-color: ${color}"></span>`;
    }
};

// Chart configuration helpers
const ChartConfigs = {
    lineChart: (data, options = {}) => {
        return {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                },
                ...options
            }
        };
    },

    doughnutChart: (data, options = {}) => {
        return {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                ...options
            }
        };
    },

    barChart: (data, options = {}) => {
        return {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                },
                ...options
            }
        };
    }
};

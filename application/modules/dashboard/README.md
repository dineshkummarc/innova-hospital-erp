# Dashboard Module

## Overview
The Dashboard Module provides comprehensive real-time dashboards for different user roles in the Hospital Management System. It includes four specialized dashboards designed for different organizational levels and responsibilities.

## Features

### 1. Executive Dashboard
- **Target Users**: C-suite executives, hospital administrators
- **Key Metrics**: 
  - Total revenue and financial performance
  - Patient volume and growth metrics
  - Bed occupancy rates
  - Department performance analysis
  - Quality metrics and patient satisfaction
  - Operational efficiency indicators

### 2. Clinical Dashboard
- **Target Users**: Doctors, nurses, clinical staff
- **Key Metrics**:
  - Current inpatients and bed status
  - Today's appointments and completion rates
  - Pending lab results and critical alerts
  - Emergency cases and priority management
  - Clinical quality metrics
  - Patient satisfaction scores

### 3. Financial Dashboard
- **Target Users**: Accountants, financial managers
- **Key Metrics**:
  - Daily and monthly revenue tracking
  - Outstanding payments and collections
  - Expense breakdown and analysis
  - Insurance claims status
  - Profitability analysis
  - Budget vs actual performance

### 4. Operational Dashboard
- **Target Users**: Nurses, receptionists, operational staff
- **Key Metrics**:
  - Appointment management and queue status
  - Staff attendance and scheduling
  - Inventory levels and alerts
  - Facility utilization
  - System alerts and notifications
  - Recent activities and workflow

## Technical Features

### Real-time Updates
- Auto-refresh every 5 minutes for executive data
- Auto-refresh every 2 minutes for clinical data
- Auto-refresh every 5 minutes for financial data
- Auto-refresh every 2 minutes for operational data
- Real-time metric updates every 30 seconds

### Interactive Charts
- Revenue trend analysis
- Patient flow visualization
- Department performance comparison
- Bed occupancy status
- Expense breakdown
- Appointment trends

### Responsive Design
- Mobile-optimized layouts
- Touch-friendly interfaces
- Adaptive chart sizing
- Print-friendly styles

### Security & Access Control
- Role-based access control
- Hospital-specific data isolation
- Secure AJAX endpoints
- Input validation and sanitization

## File Structure

```
dashboard/
├── controllers/
│   └── Dashboard.php          # Main controller
├── models/
│   └── Dashboard_model.php    # Data models
├── views/
│   ├── css/
│   │   └── dashboard.css      # Styling
│   ├── js/
│   │   └── dashboard.js       # JavaScript functionality
│   ├── executive.php          # Executive dashboard view
│   ├── clinical.php           # Clinical dashboard view
│   ├── financial.php          # Financial dashboard view
│   └── operational.php        # Operational dashboard view
└── README.md                  # This file
```

## Installation

1. Copy the dashboard module to `application/modules/dashboard/`
2. Update the menu to include dashboard links (already done in menu.php)
3. Ensure the dashboard module is added to the common modules array in hooks/required.php
4. No additional database tables required - uses existing HMS database structure

## Usage

### Accessing Dashboards
- Navigate to the "Advanced Dashboards" menu item
- Select the appropriate dashboard based on your role:
  - **Executive Dashboard**: Admin, SuperAdmin
  - **Clinical Dashboard**: Admin, SuperAdmin, Doctor, Nurse
  - **Financial Dashboard**: Admin, SuperAdmin, Accountant
  - **Operational Dashboard**: Admin, SuperAdmin, Nurse, Receptionist, Doctor

### Features Available
- **Refresh Data**: Click the refresh button to update metrics
- **Export Dashboard**: Use Ctrl+E or the export functionality
- **Real-time Updates**: Automatic data refresh based on dashboard type
- **Interactive Charts**: Click and hover for detailed information
- **Responsive Design**: Works on desktop, tablet, and mobile devices

## API Endpoints

### GET Endpoints
- `dashboard/executive` - Executive dashboard
- `dashboard/clinical` - Clinical dashboard
- `dashboard/financial` - Financial dashboard
- `dashboard/operational` - Operational dashboard

### POST Endpoints
- `dashboard/getRealTimeMetrics` - Get real-time metric data
- `dashboard/getChartData` - Get chart-specific data
- `dashboard/exportDashboard` - Export dashboard data

## Configuration

### Refresh Intervals
Modify the refresh intervals in the JavaScript files:
- Executive: 300000ms (5 minutes)
- Clinical: 120000ms (2 minutes)
- Financial: 300000ms (5 minutes)
- Operational: 120000ms (2 minutes)

### Chart Configuration
Charts are configured using Chart.js with custom styling and animations. Modify the chart configurations in the individual dashboard view files.

## Customization

### Adding New Metrics
1. Add the metric calculation to `Dashboard_model.php`
2. Update the corresponding controller method
3. Add the metric display to the appropriate dashboard view
4. Update the JavaScript for real-time updates

### Styling
- Modify `dashboard.css` for custom styling
- Update color schemes in the CSS variables
- Add new chart types in the JavaScript configuration

### Adding New Dashboards
1. Create a new controller method
2. Add corresponding model methods
3. Create a new view file
4. Update the menu navigation
5. Add role-based access control

## Dependencies

- **Chart.js 3.9.1**: For interactive charts and graphs
- **Font Awesome 6.0.0**: For icons and visual elements
- **Bootstrap**: For responsive grid system
- **jQuery**: For AJAX requests and DOM manipulation

## Browser Support

- Chrome 70+
- Firefox 65+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Considerations

- Charts are rendered client-side for better performance
- Data is cached on the server side
- AJAX requests are optimized for minimal data transfer
- Images and assets are optimized for web delivery

## Security Considerations

- All user inputs are validated and sanitized
- Role-based access control is enforced
- Hospital data isolation is maintained
- CSRF protection is implemented
- SQL injection prevention through prepared statements

## Troubleshooting

### Common Issues
1. **Charts not displaying**: Check Chart.js library loading
2. **Data not updating**: Verify AJAX endpoint responses
3. **Access denied**: Check user role permissions
4. **Styling issues**: Ensure CSS file is loaded correctly

### Debug Mode
Enable debug mode by adding `?debug=1` to the dashboard URL to see additional console logging.

## Support

For technical support or feature requests, please contact the development team or refer to the main HMS documentation.

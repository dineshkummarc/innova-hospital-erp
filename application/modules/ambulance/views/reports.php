<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-bar text-primary mr-3"></i>
                        <?php echo lang('ambulance_reports'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('reports'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url(); ?>ambulance" class="btn btn-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-chart-bar mr-2"></i>
                                <?php echo lang('ambulance_reports'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <!-- Summary Cards -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-blue">
                                        <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('total_bookings'); ?></span>
                                            <span class="info-box-number"><?php echo $total_bookings; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('total_revenue'); ?></span>
                                            <span class="info-box-number">$<?php echo number_format($total_revenue, 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('this_month'); ?></span>
                                            <span class="info-box-number"><?php echo $monthly_bookings; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('avg_response_time'); ?></span>
                                            <span class="info-box-number"><?php echo $avg_response_time; ?> min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <?php 
                            // Get filter parameters directly from URL
                            $url_date_from = $this->input->get('date_from');
                            $url_date_to = $this->input->get('date_to');
                            $url_status = $this->input->get('status');
                            ?>
                            <?php if (!empty($url_date_from) || !empty($url_date_to) || !empty($url_status)): ?>
                            <div class="row" id="active-filters-row">
                                <div class="col-md-12">
                                    <div class="alert alert-info" id="active-filters-alert">
                                        <strong>Active Filters:</strong>
                                        <?php if (!empty($url_date_from)): ?>
                                            <span class="badge badge-primary">From: <?php echo $url_date_from; ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($url_date_to)): ?>
                                            <span class="badge badge-primary">To: <?php echo $url_date_to; ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($url_status)): ?>
                                            <span class="badge badge-primary">Status: <?php echo $url_status; ?></span>
                                        <?php endif; ?>
                                        <button onclick="clearFilters()" class="btn btn-sm btn-outline-primary ml-2">
                                            <i class="fas fa-times mr-1"></i>Clear Filters
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Filter Options -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h3 class="card-title mb-0">
                                                <i class="fas fa-filter mr-2"></i>
                                                <?php echo lang('filter_reports'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="get" action="<?php echo base_url(); ?>ambulance/reports">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="date_from"><?php echo lang('date_from'); ?></label>
                                                            <input type="date" class="form-control" name="date_from" id="date_from" value="<?php echo !empty($url_date_from) ? $url_date_from : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="date_to"><?php echo lang('date_to'); ?></label>
                                                            <input type="date" class="form-control" name="date_to" id="date_to" value="<?php echo !empty($url_date_to) ? $url_date_to : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="status"><?php echo lang('status'); ?></label>
                                                            <select class="form-control" name="status" id="status">
                                                                <option value=""><?php echo lang('all_status'); ?></option>
                                                                <option value="Pending" <?php echo (!empty($url_status) && $url_status == 'Pending') ? 'selected' : ''; ?>><?php echo lang('pending'); ?></option>
                                                                <option value="In Progress" <?php echo (!empty($url_status) && $url_status == 'In Progress') ? 'selected' : ''; ?>><?php echo lang('in_progress'); ?></option>
                                                                <option value="Completed" <?php echo (!empty($url_status) && $url_status == 'Completed') ? 'selected' : ''; ?>><?php echo lang('completed'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <button type="submit" class="btn btn-primary form-control">
                                                                <i class="fa fa-filter"></i> <?php echo lang('filter'); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Charts Row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h3 class="card-title mb-0">
                                                <i class="fas fa-chart-pie mr-2"></i>
                                                <?php echo lang('bookings_by_type'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="bookingsByTypeChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-warning text-white">
                                            <h3 class="card-title mb-0">
                                                <i class="fas fa-chart-line mr-2"></i>
                                                <?php echo lang('monthly_trend'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="monthlyTrendChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detailed Reports Table -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            <h3 class="card-title mb-0">
                                                <i class="fas fa-table mr-2"></i>
                                                <?php echo lang('detailed_reports'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="reports_table" class="table table-hover datatables" width="100%">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th class="font-weight-bold text-uppercase"><?php echo lang('date'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('booking_number'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('patient_name'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('booking_type'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('revenue'); ?></th>
                                                            <th class="font-weight-bold"><?php echo lang('response_time'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($detailed_reports)): ?>
                                                            <tr class="bg-light">
                                                                <td colspan="7" class="text-center">
                                                                    <strong>Showing <?php echo count($detailed_reports); ?> booking(s)</strong>
                                                                    <?php if (!empty($filter_date_from) || !empty($filter_date_to) || !empty($filter_status)): ?>
                                                                        with applied filters
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <?php foreach ($detailed_reports as $report): ?>
                                                                <tr>
                                                                    <td><?php echo date('d/m/Y', strtotime($report->created_at)); ?></td>
                                                                    <td><?php echo $report->booking_number; ?></td>
                                                                    <td><?php echo $report->patient_name; ?></td>
                                                                    <td><?php echo $report->booking_type; ?></td>
                                                                    <td>
                                                                        <?php if ($report->status == 'Completed'): ?>
                                                                            <span class="badge badge-success"><?php echo $report->status; ?></span>
                                                                        <?php elseif ($report->status == 'In Progress'): ?>
                                                                            <span class="badge badge-warning"><?php echo $report->status; ?></span>
                                                                        <?php else: ?>
                                                                            <span class="badge badge-danger"><?php echo $report->status; ?></span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>$<?php echo number_format($report->total_fare, 2); ?></td>
                                                                    <td>
                                                                        <?php 
                                                                        $response_time = 0;
                                                                        if ($report->status == 'Completed' && $report->updated_at) {
                                                                            $response_time = round((strtotime($report->updated_at) - strtotime($report->created_at)) / 60);
                                                                        }
                                                                        echo $response_time . ' min';
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="7" class="text-center"><?php echo lang('no_data_available'); ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Export Options -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h3 class="card-title mb-0">
                                                <i class="fas fa-download mr-2"></i>
                                                <?php echo lang('export_reports'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <a href="<?php echo base_url(); ?>ambulance/exportReports?format=pdf" class="btn btn-danger" target="_blank">
                                                <i class="fa fa-file-pdf-o"></i> <?php echo lang('export_pdf'); ?>
                                            </a>
                                            <a href="<?php echo base_url(); ?>ambulance/exportReports?format=excel" class="btn btn-success" target="_blank">
                                                <i class="fa fa-file-excel-o"></i> Export Excel (CSV)
                                            </a>
                                            <a href="<?php echo base_url(); ?>ambulance/exportReports?format=csv" class="btn btn-info" target="_blank">
                                                <i class="fa fa-file-text-o"></i> <?php echo lang('export_csv'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- DataTables Export Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- DataTables Export Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<style>
    /* Ensure active filters section is always visible */
    #active-filters-row {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    #active-filters-alert {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* DataTables Export Buttons Styling */
    .dt-buttons {
        margin-bottom: 15px;
    }
    .dt-buttons .btn {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    .dt-buttons .btn i {
        margin-right: 5px;
    }
</style>
<script>
    $(document).ready(function() {
        // Check if DataTables Buttons is loaded
        if (typeof $.fn.DataTable === 'undefined') {
            console.error('DataTables is not loaded');
            return;
        }
        
        if (typeof $.fn.DataTable.Buttons === 'undefined') {
            console.error('DataTables Buttons is not loaded');
            return;
        }
        
        // Initialize DataTable first (independent of Chart.js)
        try {
            $('#reports_table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-sm btn-outline-secondary'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-sm btn-outline-success'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-sm btn-outline-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-sm btn-outline-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-sm btn-outline-primary'
                    }
                ],
                language: {
                    buttons: {
                        copy: 'Copy',
                        csv: 'CSV',
                        excel: 'Excel',
                        pdf: 'PDF',
                        print: 'Print'
                    }
                }
            });
            console.log('DataTable initialized successfully with export buttons');
        } catch (error) {
            console.error('DataTable initialization failed:', error);
        }
        
        // Check if Chart.js is loaded
        if (typeof Chart === 'undefined') {
            console.log('Chart.js not loaded, skipping chart initialization');
            return;
        }
        
        // Initialize charts after a short delay to avoid conflicts
        setTimeout(function() {
            initializeCharts();
        }, 100);
    });
    
    // Fallback DataTable initialization if libraries load asynchronously
    setTimeout(function() {
        if ($('#reports_table').length && !$.fn.DataTable.isDataTable('#reports_table')) {
            console.log('Attempting fallback DataTable initialization...');
            try {
                $('#reports_table').DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fas fa-copy"></i> Copy',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            className: 'btn btn-sm btn-outline-success'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            className: 'btn btn-sm btn-outline-success'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-sm btn-outline-danger'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            className: 'btn btn-sm btn-outline-primary'
                        }
                    ]
                });
                console.log('Fallback DataTable initialization successful');
            } catch (error) {
                console.error('Fallback DataTable initialization failed:', error);
            }
        }
    }, 2000);
    
    function initializeCharts() {
        // Bookings by Type Chart
        var canvas1 = document.getElementById('bookingsByTypeChart');
        if (!canvas1) {
            return;
        }
        var ctx1 = canvas1.getContext('2d');
        
        // Prepare bookings by type data
        var typeLabels = [];
        var typeData = [];
        var typeColors = ['#f56954', '#00a65a', '#f39c12', '#3c8dbc', '#d2d6de'];
        
        <?php if (!empty($bookings_by_type)): ?>
            <?php foreach ($bookings_by_type as $type): ?>
                typeLabels.push('<?php echo addslashes($type->booking_type); ?>');
                typeData.push(<?php echo intval($type->count); ?>);
            <?php endforeach; ?>
        <?php else: ?>
            typeLabels = ['No Data'];
            typeData = [1];
        <?php endif; ?>
        
        var bookingsByTypeChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: typeColors.slice(0, typeLabels.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Monthly Trend Chart
        var canvas2 = document.getElementById('monthlyTrendChart');
        if (!canvas2) {
            return;
        }
        var ctx2 = canvas2.getContext('2d');
        
        // Prepare monthly data
        var monthlyData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // Initialize with zeros for all 12 months
        
        <?php if (!empty($monthly_data)): ?>
            <?php foreach ($monthly_data as $month_data): ?>
                monthlyData[<?php echo intval($month_data->month) - 1; ?>] = <?php echo intval($month_data->count); ?>;
            <?php endforeach; ?>
        <?php endif; ?>
        
        var monthlyTrendChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['<?php echo lang('jan'); ?>', '<?php echo lang('feb'); ?>', '<?php echo lang('mar'); ?>', '<?php echo lang('apr'); ?>', '<?php echo lang('may'); ?>', '<?php echo lang('jun'); ?>', '<?php echo lang('jul'); ?>', '<?php echo lang('aug'); ?>', '<?php echo lang('sep'); ?>', '<?php echo lang('oct'); ?>', '<?php echo lang('nov'); ?>', '<?php echo lang('dec'); ?>'],
                datasets: [{
                    label: '<?php echo lang('bookings'); ?>',
                    data: monthlyData,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
    
    // Clear filters functionality
    function clearFilters() {
        window.location.href = '<?php echo base_url(); ?>ambulance/reports';
    }
    
    // Keep active filters section visible
    $(document).ready(function() {
        function ensureFiltersVisible() {
            var $filterRow = $('#active-filters-row');
            var $filterAlert = $('#active-filters-alert');
            
            if ($filterRow.length > 0) {
                $filterRow.show();
                $filterRow.css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
            }
            
            if ($filterAlert.length > 0) {
                $filterAlert.show();
                $filterAlert.css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
            }
        }
        
        // Check every 1 second to ensure it stays visible
        setInterval(ensureFiltersVisible, 1000);
        
        // Also check on any DOM changes
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    setTimeout(ensureFiltersVisible, 50);
                }
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
        
        // Initial check
        setTimeout(ensureFiltersVisible, 200);
    });
    
    // Fallback initialization if jQuery ready fails
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initializeCharts, 200);
        });
    } else {
        setTimeout(initializeCharts, 200);
    }
</script>

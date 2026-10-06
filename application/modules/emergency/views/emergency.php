<link href="common/extranal/css/patient/medical_history.css" rel="stylesheet">

<?php
    // Define dynamic keywords for use in JS and titles
    $emergency_keywords = array(
        'module' => lang('emergency'),
        'module_plural' => lang('emergencies'),
        'add_new' => lang('add_new'),
        'id' => lang('id'),
        'patient' => lang('patient'),
        'doctor' => lang('doctor'),
        'emergency_type' => lang('emergency_type'),
        'description' => lang('description'),
        'status' => lang('status'),
        'priority' => lang('priority'),
        'options' => lang('options'),
        'all' => lang('all'),
        'home' => lang('home'),
    );
?>

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-danger mr-3"></i>
                        <?php echo $emergency_keywords['all']; ?> <?php echo $emergency_keywords['module_plural']; ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo $emergency_keywords['home']; ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo $emergency_keywords['module']; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="emergency/addNewView" class="btn btn-danger btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo $emergency_keywords['add_new']; ?> <?php echo $emergency_keywords['module']; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <!-- Custom buttons container -->
                            <div class="custom_buttons"></div>
                            
                            <table class="table table-hover datatables" id="emergency-table" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo $emergency_keywords['id']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['patient']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['doctor']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['emergency_type']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['description']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['status']; ?></th>
                                        <th class="font-weight-bold"><?php echo $emergency_keywords['priority']; ?></th>
                                        <th class="font-weight-bold no-print"><?php echo $emergency_keywords['options']; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        "use strict";

        // Dynamic keywords for JS
        var emergencyKeywords = {
            module: <?php echo json_encode($emergency_keywords['module']); ?>,
            modulePlural: <?php echo json_encode($emergency_keywords['module_plural']); ?>,
            id: <?php echo json_encode($emergency_keywords['id']); ?>,
            patient: <?php echo json_encode($emergency_keywords['patient']); ?>,
            doctor: <?php echo json_encode($emergency_keywords['doctor']); ?>,
            emergencyType: <?php echo json_encode($emergency_keywords['emergency_type']); ?>,
            description: <?php echo json_encode($emergency_keywords['description']); ?>,
            status: <?php echo json_encode($emergency_keywords['status']); ?>,
            priority: <?php echo json_encode($emergency_keywords['priority']); ?>,
            options: <?php echo json_encode($emergency_keywords['options']); ?>,
            all: <?php echo json_encode($emergency_keywords['all']); ?>,
            addNew: <?php echo json_encode($emergency_keywords['add_new']); ?>,
            records: <?php echo json_encode(lang('records')); ?>,
            search: <?php echo json_encode(lang('search')); ?>,
            first: <?php echo json_encode(lang('first')); ?>,
            last: <?php echo json_encode(lang('last')); ?>,
            next: <?php echo json_encode(lang('next')); ?>,
            previous: <?php echo json_encode(lang('previous')); ?>,
            noRecordsFound: <?php echo json_encode(lang('no_results_found')); ?>,
            noMatchingRecordsFound: <?php echo json_encode(lang('no_matching_records_found')); ?>,
        };

        var table = $("#emergency-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: {
                url: "emergency/getEmergencyData",
                type: "POST",
            },
            scroller: {
                loadingIndicator: true,
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { 
                    extend: "copyHtml5", 
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                    className: 'btn btn-sm btn-outline-secondary'
                },
                { 
                    extend: "excelHtml5", 
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                    className: 'btn btn-sm btn-outline-success',
                    title: emergencyKeywords.modulePlural + '_Data_' + new Date().toISOString().split('T')[0]
                },
                { 
                    extend: "csvHtml5", 
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                    className: 'btn btn-sm btn-outline-info',
                    title: emergencyKeywords.modulePlural + '_Data_' + new Date().toISOString().split('T')[0]
                },
                { 
                    extend: "pdfHtml5", 
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                    className: 'btn btn-sm btn-outline-danger',
                    title: emergencyKeywords.modulePlural + '_Data_' + new Date().toISOString().split('T')[0],
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                { 
                    extend: "print", 
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                    className: 'btn btn-sm btn-outline-dark',
                    title: emergencyKeywords.modulePlural + ' ' + emergencyKeywords.records + ' - ' + new Date().toLocaleDateString()
                }
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            iDisplayLength: 25,
            order: [[0, "desc"]],
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: emergencyKeywords.search + " " + emergencyKeywords.modulePlural.toLowerCase() + " " + emergencyKeywords.records.toLowerCase() + "...",
                processing: "<?php echo lang('loading'); ?> " + emergencyKeywords.modulePlural.toLowerCase() + " " + emergencyKeywords.records.toLowerCase() + "...",
                emptyTable: emergencyKeywords.noRecordsFound,
                zeroRecords: emergencyKeywords.noMatchingRecordsFound,
                info: "Showing _START_ to _END_ of _TOTAL_ " + emergencyKeywords.modulePlural.toLowerCase() + " " + emergencyKeywords.records.toLowerCase(),
                infoEmpty: "Showing 0 to 0 of 0 " + emergencyKeywords.modulePlural.toLowerCase() + " " + emergencyKeywords.records.toLowerCase(),
                infoFiltered: "(filtered from _MAX_ total " + emergencyKeywords.modulePlural.toLowerCase() + " " + emergencyKeywords.records.toLowerCase() + ")",
                paginate: {
                    first: emergencyKeywords.first,
                    last: emergencyKeywords.last,
                    next: emergencyKeywords.next,
                    previous: emergencyKeywords.previous
                }
            },
            drawCallback: function(settings) {
                // Add loading indicator
                if (settings.json && settings.json.data) {
                    console.log('Loaded ' + settings.json.data.length + ' ' + emergencyKeywords.modulePlural.toLowerCase() + ' ' + emergencyKeywords.records.toLowerCase());
                }
            }
        });
        
        // Append buttons to custom container
        table.buttons().container().appendTo(".custom_buttons");
        
        // Add custom CSS for better styling
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .dataTables_wrapper .dataTables_length,
                .dataTables_wrapper .dataTables_filter,
                .dataTables_wrapper .dataTables_info,
                .dataTables_wrapper .dataTables_processing,
                .dataTables_wrapper .dataTables_paginate {
                    margin: 0.5rem 0;
                }
                
                .dataTables_wrapper .dataTables_paginate .paginate_button {
                    padding: 0.25rem 0.5rem;
                    margin: 0 0.125rem;
                    border: 1px solid #dee2e6;
                    border-radius: 0.25rem;
                }
                
                .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                    background: #007bff;
                    color: white;
                    border-color: #007bff;
                }
                
                .dataTables_wrapper .dataTables_processing {
                    background: rgba(255, 255, 255, 0.9);
                    border: 1px solid #ddd;
                    border-radius: 0.25rem;
                    color: #333;
                    font-weight: 500;
                }
                
                .btn-group .btn {
                    margin-right: 2px;
                }
                
                .badge {
                    font-size: 0.75rem;
                    padding: 0.25rem 0.5rem;
                }
                
                .custom_buttons {
                    margin-bottom: 1rem;
                }
            `)
            .appendTo('head');
    });
</script>

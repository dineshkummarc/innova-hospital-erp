<!--sidebar end-->
<!--main content start-->


<link href="common/extranal/css/lab/lab.css" rel="stylesheet">
<link href="common/extranal/css/description.css" rel="stylesheet">


<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-flask text-primary mr-3"></i>
                        <?php echo lang('all') . " " . lang('lab_tests'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('all') . " " . lang('lab_tests'); ?></li>
                        </ol>
                    </nav>
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
                            <div class="alert alert-info text-sm mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="mb-1"><?php echo lang('for_every_paid_diagnostic_test_there_is_a_row_in_this_table'); ?></p>
                                <p class="mb-1"><?php echo lang('if_you_change_the_status_from_not_done_to_done_it_will_appear_on_the_lab_test_lab_reports_section'); ?>.</p>
                                <p class="mb-1"><?php echo lang('there_you_can_add_report_or_insert_results_for_a_test_by_clicking_on_the_report_button'); ?>.</p>
                                <p class="mb-1"><?php echo lang('on_the_report_page_after_writing_the_report_if_you_click_save_and_ready_to_deliver_report_will_be_generated_and_will_be_be_available_on_the_lab_tests_report_delivery_section'); ?>.</p>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('status'); ?></label>
                                        <select class="form-control form-control-lg shadow-sm status">
                                            <option value="all"><?php echo lang('all'); ?></option>
                                            <option value="done"><?php echo lang('done'); ?></option>
                                            <option value="not_done"><?php echo lang('not_done'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('category'); ?></label>
                                        <select class="form-control form-control-lg shadow-sm category">
                                            <option value="all"><?php echo lang('all'); ?></option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('from'); ?></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm pay_in default-date-picker readonly" name="" id="from_date" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('to'); ?></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm pay_in default-date-picker readonly" name="" id="to_date" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('date_filter'); ?></label>
                                        <button class="btn btn-success btn-lg btn-block shadow-sm dateFilter"><?php echo lang('filter'); ?></button>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover datatables" id="editable-sample1" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('patient_id'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('invoice_no'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('invoice_date_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('from'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('test_name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('date_time_done'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('bill_status'); ?></th>
                                        <th class="font-weight-bold"><?php echo "Done By"; ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Content goes here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





<!--main content end-->
<!--footer start-->

<div class="modal fade" id="done_by_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-user-check mr-2"></i>
                    <?php echo lang('done_by_details'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Done By</label>
                    <input type="text" class="form-control form-control-lg" id="done_by">
                </div>
                <input type="hidden" class="form-control form-control-lg" id="done_by_id">
                <input type="hidden" class="form-control form-control-lg" id="done_by_status">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary done_by_btn"><?php echo lang('save_changes'); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<!-- <script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script> -->
<script src="common/extranal/js/lab/lab.js"></script>
<script src="common/extranal/js/description.js"></script>
<script>
    $(document).ready(function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searchable: true,
            deferRender: true,
            pageLength: 25,
            ajax: {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
                cache: true,
                dataSrc: function(json) {
                    return json.data;
                }
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: {
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ],
                dom: {
                    button: {
                        className: 'btn'
                    }
                }
            },
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            order: [
                [1, "desc"]
            ],
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
            stateSave: true,
            deferRender: true,
            orderClasses: false
        });

        table.buttons().container().appendTo('.custom_buttons');
    });

    $('.status').on("change", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })

    $('.category').on("change", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    })

    $(document).on("change", '.test_status', function() {
        let id = $(this).data("id");
        let status = $(this).val();
        if (status == 'not_done') {
            let data = new FormData();
            data.append('id', id);
            data.append('status', status);
            data.append('done_by', "");
            axios.post('<?php echo site_url('lab/changeTestStatus'); ?>', data)
                .then(response => {
                    let status = $('.status').val();
                    let category = $('.category').val();
                    let fromDate = $('#from_date').val();
                    let toDate = $('#to_date').val();
                    "use strict";
                    $('#editable-sample1').DataTable().destroy().clear();
                    var table = $('#editable-sample1').DataTable({
                        responsive: true,

                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },

                        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,
                        "order": [
                            [2, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            searchPlaceholder: "Search..."
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                })

            $('#done_by_modal').modal("hide");
        } else {
            $('#done_by_id').val(id)
            $('#done_by_status').val(status)
            $('#done_by').val("")
            $('#done_by_modal').modal();
        }
    })

    $(document).on("click", '.done_by_btn', function() {
        let id = $('#done_by_id').val();
        let status = $('#done_by_status').val();
        let done_by = $('#done_by').val();
        let data = new FormData();
        data.append('id', id);
        data.append('status', status);
        data.append('done_by', done_by);
        axios.post('<?php echo site_url('lab/changeTestStatus'); ?>', data)
            .then(response => {
                let status = $('.status').val();
                let category = $('.category').val();
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                "use strict";
                $('#editable-sample1').DataTable().destroy().clear();
                var table = $('#editable-sample1').DataTable({
                    responsive: true,

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                        type: 'POST',
                    },
                    scroller: {
                        loadingIndicator: true
                    },

                    dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            }
                        },
                    ],
                    aLengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    iDisplayLength: 100,
                    "order": [
                        [2, "desc"]
                    ],

                    "language": {
                        "lengthMenu": "_MENU_",
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });
                table.buttons().container().appendTo('.custom_buttons');
            })
        $('#done_by_modal').modal("hide");

    })

    $('.dateFilter').on("click", function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        $('#editable-sample1').DataTable().destroy().clear();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getTestStatusLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [2, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');

    })
</script>
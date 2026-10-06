<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-flask text-primary mr-3"></i>
                        <?php echo lang('lab_report'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="lab/testStatus"><?php echo lang('lab_tests'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('reports'); ?></li>
                        </ol>
                    </nav>
                </div>
                <!-- <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('lab_report'); ?>
                    </a>
                </div> -->
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <div class="col-md-12">
                                <div class="row mb-4 mt-2">
                                    <div class="col-md-2">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('status'); ?></label>
                                        <select class="form-control form-control-lg shadow-sm status">
                                            <option value="all"><?php echo lang('all'); ?></option>
                                            <option value="pending"><?php echo lang('pending'); ?></option>
                                            <option value="drafted"><?php echo lang('drafted'); ?></option>
                                            <option value="completed"><?php echo lang('completed'); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('category'); ?></label>
                                        <select class="form-control form-control-lg shadow-sm category">
                                            <option value="all"><?php echo lang('all'); ?></option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-uppercase font-weight-bold text-muted">From</label>
                                        <input type="text" class="form-control form-control-lg shadow-sm pay_in default-date-picker readonly" name="" id="from_date" readonly="" style="z-index: 99999;">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-uppercase font-weight-bold text-muted">To</label>
                                        <input type="text" class="form-control form-control-lg shadow-sm pay_in default-date-picker readonly" name="" id="to_date" readonly="" style="z-index: 99999;">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-uppercase font-weight-bold text-muted">Date Filter</label><br>
                                        <button class="btn btn-primary btn-lg p-2 btn-block shadow-lg py-3 dateFilter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample1" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('patient_id'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('phone'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('invoice_no'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('invoice_date_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('test_name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('bill'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('report'); ?></th>
                                        <th class="font-weight-bold"><?php echo "Updated On"; ?></th>
                                        <th class="font-weight-bold"><?php echo "Reported By"; ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
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



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<!-- <script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script> -->
<script src="common/extranal/js/lab/lab.js"></script>

<script>
    $(document).ready(function() {
        let status = $('.status').val();
        let category = $('.category').val();
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        "use strict";
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [4, "desc"]
            ],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
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
                url: "lab/getLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [4, "desc"]
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
                url: "lab/getLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [
                [4, "desc"]
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
        let data = new FormData();
        data.append('id', id);
        data.append('status', status);
        axios.post('<?php echo site_url('lab/changeReportStatus'); ?>', data)
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
                url: "lab/getLab?status=" + status + "&category=" + category + "&from=" + fromDate + '&to=' + toDate,
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
                [4, "desc"]
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
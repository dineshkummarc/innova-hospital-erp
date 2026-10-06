<link href="common/extranal/css/doctor/doctor.css" rel="stylesheet">
<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                        <?php echo lang('invoices'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('invoices'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="finance/addPaymentView" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('invoice'); ?>
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
                        <!-- <div class="card-header bg-gradient-primary py-4">
                            <h2 class="card-title mb-0 text-white display-6 font-weight-800"><?php echo lang('list_of_invoices_from_opd_ipd_and_appointments'); ?></h2>
                        </div> -->

                        <div class="card-body bg-light p-4">
                            <div class="col-md-4 mb-4">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-addon mx-2"></span>
                                    <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                            </div>

                            <table class="table table-hover datatables text-sm" id="editable-sample3" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang(''); ?> #</th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <!-- <th class="font-weight-bold"><?php echo lang('doctor'); ?></th> -->
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('total'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('vat'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('discount'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('grand_total'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('paid'); ?> <?php echo lang(''); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('due'); ?></th>
                                        <!-- <th class="font-weight-bold"><?php echo lang('remarks'); ?></th> -->
                                        <th class="font-weight-bold"><?php echo lang('from'); ?></th>
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













<!-- Include Global Modal Styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/global-modal-styles.css">

<div class="modal fade modal-enhanced" id="editPaymentModal" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Payment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- The edit payment form will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>





<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<!-- <script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script> -->
<script src="common/extranal/js/finance/payments.js"></script>
<script>
    $(document).ready(function() {

        $('#date_from').on('change', function() {
            var date_from = $(this).val();
            var date_to = $('#date_to').val();
            var date_from_split = date_from.split('-');
            var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2]
            if (date_to != '' || date_to != null) {
                var date_to_split = date_to.split('-');
                var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            }
            if (date_to != '' || date_to != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {

                    alert('Select a Valid Date. End Date should be Greater than Start Date');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({


                        responsive: true,

                        processing: true,
                        serverSide: true,
                        searchable: true,
                        bScrollCollapse: true,
                        ajax: {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: "POST",
                        },

                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: "copyHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "excelHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "csvHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "pdfHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "print",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        })
        $('#date_to').on('change', function() {
            var date_to = $(this).val();
            var date_from = $('#date_from').val();

            var date_to_split = date_to.split('-');
            var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            if (date_from != '' || date_from != null) {
                var date_from_split = date_from.split('-');
                var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2];

            }
            if (date_from != '' || date_from != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {

                    alert('Select a Valid Date. End Date should be Greater than Start Date');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({
                        responsive: true,

                        processing: true,
                        serverSide: true,
                        searchable: true,
                        bScrollCollapse: true,
                        ajax: {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: "POST",
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: "copyHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "excelHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "csvHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "pdfHtml5",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: "print",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        })
    })
</script>
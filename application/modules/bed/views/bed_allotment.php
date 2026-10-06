<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-hospital-user text-primary mr-3"></i>
                        <?php echo lang('all_admissions'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('all_admissions'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="bed/addAllotmentView" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('admission'); ?>
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
                        <div class="card-header">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('admission'); ?> <?php echo lang('status'); ?></label>
                                    <select class="form-control form-control-lg shadow-sm status" id="admissionStatus">
                                        <option value=""><?php echo lang('all'); ?></option>
                                        <option value="discharged"><?php echo lang('discharged'); ?></option>
                                        <option value="admitted_now"><?php echo lang('admitted_now'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('bed_id'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('admission_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('discharge_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('due'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant', 'Receptionist'))) { ?>
                                            <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
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








<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_admission'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="bed/addAllotment" class=" row" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('admission_time'); ?></label>
                            <div data-date="" class="input-group date form_datetime-meridian">
                                <div class="input-group-btn">
                                    <div type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></div>
                                    <div type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></div>
                                </div>
                                <input type="text" class="form-control form-control-lg" readonly="" name="a_time" id="alloted_time" value='<?php
                                                                                                                                            if (!empty($allotment->a_time)) {
                                                                                                                                                echo $allotment->a_time;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                            <select class="form-control form-control-lg m-bot15" id="room_no" name="category" value=''>
                                <option><?php echo lang('select'); ?></option>
                                <?php foreach ($room_no as $room) { ?>
                                    <option value="<?php echo $room->category; ?>" <?php
                                                                                    if (!empty($allotment->category)) {
                                                                                        if ($allotment->category == $room->category) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $room->category; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('bed_id'); ?></label>
                            <select class="form-control form-control-lg m-bot15" id="bed_id" name="bed_id" value=''>
                                <option value="select"><?php echo lang('select'); ?></option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('select_patient'); ?> <span class="text-danger">*</span></label>
                                            <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                <select class="form-control form-control-lg shadow-sm" id="pos_select" name="patient" required>
                                                    <?php if (!empty($appointment)) { ?>
                                                        <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } else {
                                                $user = $this->ion_auth->get_user_id();
                                                $patients = $this->db->get_where('patient', array('ion_user_id' => $user))->row();
                                            ?>
                                                <select class="form-control form-control-lg shadow-sm" id="pos_select" name="patient" required>
                                                    <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <!-- <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                            <select class="form-control form-control-lg shadow-sm" id="" name="patient" value=''>
                                                <?php if (!empty($allotment->patient)) { ?>
                                                    <option value="<?php echo $allotment->patient; ?>" selected>
                                                        <?php echo $this->db->get_where('patient', array('id' => $allotment->patient))->row()->name . '( Id: ' . $allotment->patient . ')'; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                        </div> -->


                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('category'); ?>:</label>

                            <span></span>
                            <input type="checkbox" name="category_status[]" value="urgent">
                            <label class="planned_class"><?php echo lang('urgent'); ?></label>
                            <input type="checkbox" name="category_status[]" value="planned">
                            <label><?php echo lang('planned'); ?></label>

                        </div>
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('reaksione'); ?>:</label>
                            <textarea name="reaksione" class='form-control'> </textarea>

                        </div>
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('transferred_from'); ?>:</label>
                            <textarea name="transferred_from" class='form-control'> </textarea>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1"> <?php echo lang('diagnoza_a_shtrimit'); ?>:</label>
                            <textarea name="diagnoza_a_shtrimit" class='form-control'> </textarea>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                            <select class="form-control form-control-lg m-bot15" id="doctors" name="doctor" value=''>

                            </select>
                        </div>
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1"> <?php echo lang('diagnosis'); ?>:</label>
                            <textarea name="diagnosis" class='form-control'> </textarea>

                        </div>
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1"> <?php echo lang('other_illnesses'); ?>:</label>
                            <textarea name="other_illnesses" class='form-control'> </textarea>

                        </div>
                        <div class="form-group col-md-12">

                            <label for="exampleInputEmail1"> <?php echo lang('anamneza'); ?>:</label>
                            <textarea name="anamneza" class='form-control'> </textarea>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('blood_group'); ?></label>
                            <select class="form-control form-control-lg m-bot15" id="blood_group" name="blood_group" value=''>
                                <?php foreach ($blood_group as $blood_group) {
                                ?>

                                    <option value="<?php echo $blood_group->id; ?>"><?php echo $blood_group->bloodgroup; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('accepting_doctor'); ?></label>
                            <select class="form-control form-control-lg m-bot15" id="accepting_doctors" name="accepting_doctor" value=''>

                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_admission'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAllotmentForm" action="bed/addAllotment" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('bed_id'); ?></label>
                        <select class="form-control form-control-lg m-bot15" name="bed_id" value=''>
                            <?php foreach ($beds as $bed) { ?>
                                <option value="<?php echo $bed->bed_id; ?>" <?php
                                                                            if (!empty($allotment->bed_id)) {
                                                                                if ($allotment->bed_id == $bed->bed_id) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>> <?php echo $bed->bed_id; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> Patient</label>
                        <select class="form-control form-control-lg m-bot15" id="patientchoose1" name="patient" value=''>

                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('alloted_time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info date-set py-3"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset py-3"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control form-control-lg" readonly="" name="a_time" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('discharge_time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="d_time" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/bed/add_allotment.js"></script>


<script>
    $(function() {
        let status = $('.status').val();
        var table = $('#editable-sample1').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "bed/getBedAllotmentList?status=" + status,
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
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2],
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
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');

        $(document).on("change", '.user_id', function() {
            let status = $('.status').val();

            $('#editable-sample1').DataTable().destroy().clear();
            var table = $('#editable-sample1').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "bed/getBedAllotmentList?status=" + status,
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
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
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
                    searchPlaceholder: "Search..."
                }
            });
            table.buttons().container().appendTo('.custom_buttons');
        })

        $('.status').on("change", function() {
            let status = $('.status').val();

            $('#editable-sample1').DataTable().destroy().clear();
            var table = $('#editable-sample1').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "bed/getBedAllotmentList?status=" + status,
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
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
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
                    searchPlaceholder: "Search..."
                }
            });
            table.buttons().container().appendTo('.custom_buttons');
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form_datetime-meridian').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>
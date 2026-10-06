<!--sidebar end-->
<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-print mr-2"></i>Label Print</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="bed/bedAllotment"><?php echo lang('all_admissions') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('ListofAllAppointments'); ?>Label Print</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Print Label For '); ?><?php echo $patient->name; ?></h3>
                            <div class="float-right  no-print">
                                <a data-toggle="modal" onclick="window.print()">
                                    <button id="" class="btn btn-warning btn-sm">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <?php for ($i = 1; $i < 7; $i++) { ?>
                                    <div class=" labelSection col-md-6">
                                        <div style="margin-bottom: 50px;">
                                            <table id="labelTable" style="float: left;">
                                                <tr>
                                                    <td>PID: <?php echo $patient->id; ?></td>
                                                    <td>Admission ID: <?php echo $bed->id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Patient: <?php echo $patient->name; ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $age = explode('-', $patient->age);
                                                    if (count($age) == 3) {
                                                    ?>
                                                        <td>Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                                                    <?php } else { ?>
                                                        <td>Age: </td>
                                                    <?php }
                                                    ?>

                                                    <td>Bed Id: <?php echo $bed->bed_display_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender: <?php echo $patient->sex; ?></td>
                                                    <td>Date: <?php echo date('d-m-Y H:i', $bed->a_timestamp); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ref By: <?php echo $this->doctor_model->getDoctorById($bed->doctor)->name; ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center; padding-top: 10px;">
                                                        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="barcodeVertical" style="float: right">
                                                <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $bed->id; ?>&print=true&orientation=vertical" />
                                            </div>

                                        </div>


                                    </div>
                                <?php } ?>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>











<!--main content end-->
<!--footer start-->



<link href="common/extranal/css/bed/bed.css" rel="stylesheet">

<style>
    body {
        print-color-adjust: exact;
    }

    hr {
        border-top: 1px solid #000 !important;
        width: 100%;
    }

    h1,
    h3,
    h2,
    h4,
    h5,
    h6 {
        margin: 0px;
    }

    p {
        margin: 3px 0px;
        font-size: .85rem;
    }

    /*                    #footer {
                            position: absolute;
                            bottom: 10px;
                            right: 20;
                            left: 20;
                        }*/

    .flex-wrapper {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        justify-content: flex-start;
    }

    #footer {
        margin-top: auto;
    }

    .table-qr-hr {
        margin-top: 10px !important;
        margin-bottom: 15px !important;
    }

    .info_text {
        font-size: 11px;
    }

    .control_label {
        font-size: 12px;
        width: 50px;
    }

    .reportBlock table {
        border: 1px solid black;
    }

    .reportBlock table td {
        border: 1px solid black;
    }

    #labelTable td {
        padding-bottom: 5px;
    }

    .labelSection {
        width: 50%;
    }

    #labelTable {
        width: 90%;
    }

    .barcodeVertical {
        width: 10%;
    }

    @media print {
        .col-md-7 {
            padding: 0px !important;
        }

        .panel {
            margin: 0px !important;
            padding: 0px !important;
        }

        .panel-body {
            padding: 0px !important;
        }

        .wrapper {
            margin: 0px !important;
            padding: 0px !important;
        }

        .flex-wrapper {
            margin-bottom: 150px;
        }

        #labelTable td {
            padding-bottom: 5px;
        }

        .labelSection {
            width: 50%;
            float: left;
            margin-bottom: 10%;
        }

        #labelTable {
            width: 90%;
        }

        .barcodeVertical {
            width: 10%;
        }
    }
</style>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="common/extranal/js/bed/bed.js"></script>
<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/lab/lab.css" rel="stylesheet">



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-print mr-2"></i><?php echo lang('label_print'); ?> (<?php echo lang('90 Degree Rotated Right'); ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('label_print'); ?></li>
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
                        <div class="card-header no-print">
                            <h3 class="card-title"><?php echo lang('invoice_id') ?># <?php echo $lab->invoice_id; ?>, <?php echo lang('lab'); ?> <?php echo lang('id') ?># <?php echo $lab->id; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <link href="common/extranal/css/lab/lab.css" rel="stylesheet">

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

                                    /*            .card {
                    border: 0px solid #5c5c47;
                    background: #fff !important;
                    height: 100%;
                    margin: 20px 5px 5px 5px;
                    border-radius: 0px !important;
                    min-height: 700px;
                }
    
                .card-body {
                    padding: 15px 15px !important; 
                }*/

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

                                    @media print {
                                        .col-md-7 {
                                            padding: 0px !important;
                                        }

                                        .card {
                                            margin: 0px !important;
                                            padding: 0px !important;
                                        }

                                        .card-body {
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
                                    }
                                </style>


                                <section class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="flex-wrapper">
                                                <div style="display: flex; max-width: 4.9in; margin-top: 65px; -webkit-transform: rotate(90deg);
-moz-transform: rotate(90deg);
-o-transform: rotate(90deg);
-ms-transform: rotate(90deg);
transform: rotate(90deg);
position: absolute;
top: 30px;
left: 0px;">
                                                    <div>
                                                        <table id="labelTable">
                                                            <tr>
                                                                <td>PID: <?php echo $patient->id; ?></td>
                                                                <td>Invoice ID: <?php echo $lab->invoice_id; ?></td>
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

                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gender: <?php echo $patient->sex; ?></td>
                                                                <td>Date: <?php echo date('d/m/Y', $lab->date) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ref By:</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">Test: <?php
                                                                                        $i = 0;
                                                                                        foreach ($labels as $label) {
                                                                                            if ($i == 0) {
                                                                                                echo $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                                                                //echo $this->finance_model->getPaymentCategoryById($label->category_id);
                                                                                            } else {
                                                                                                echo ', ' . $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                                                            }
                                                                                            $i++;
                                                                                        }
                                                                                        ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Film: <br><input type="text" style="width: 85%">
                                                                </td>
                                                                <td>
                                                                    Paper Print: <br><input type="text" style="width: 85%">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="text-align: center; padding-top: 10px;">
                                                                    <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div>
                                                        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true&orientation=vertical" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="col-md-3 no-print">
                                    <div class="" style="background: transparent !important;">
                                        <a class='btn btn-sm btn-warning mb-2' onclick="window.print()"><i class='fa fa-print'></i> <?php echo lang('print'); ?></a><br>
                                        <a class='btn btn-danger mb-2' href="<?php echo site_url('lab/printLabel?id=' . $lab->id); ?>"><i class='fa fa-undo'></i> <?php echo lang('go_back_to_the_original'); ?></a><br>
                                    </div>
                                </section>
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



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="common/extranal/js/lab/lab.js"></script>
<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/lab/lab.css" rel="stylesheet">


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-print mr-2"></i><?php echo lang('label_print') ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header no-print">
                            <h3 class="card-title"><?php echo lang('invoice_id') ?># <?php echo $lab->invoice_id; ?>, <?php echo lang('lab'); ?> <?php echo lang('id') ?># <?php echo $lab->id; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <section class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="flex-wrapper">
                                                <div style="display: flex; max-width: 4.9in; margin-top: 20px;">
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
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-3">
                    <div class="">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <section class="col-md-12 no-print">
                                    <div class="panel" style="background: transparent !important;">
                                        <a class='btn btn-warning mb-2' onclick="window.print()"><i class='fa fa-print'></i> Print</a><br>
                                        <a class='btn btn-danger mb-2' href="<?php echo site_url('lab/labLabel90?id=' . $lab->id); ?>"><i class='fa fa-undo'></i> Rotate 90 Deg</a><br>
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
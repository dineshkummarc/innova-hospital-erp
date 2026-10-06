<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-file-invoice mr-2"></i>
                        <?php echo lang('pharmacy'); ?> <?php echo lang('invoice'); ?> (<?php echo lang('invoice_id'); ?>: <?php echo $payment->id; ?>)
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('pharmacy'); ?> <?php echo lang('invoice'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 full-width-print">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <section>
                                <div class="card card-primary">

                                    <div class="card-body panel-moree" id="invoice">
                                        <div class="row invoice-list">

                                            <div class="text-center corporate-id">
                                                <h1>
                                                    <?php echo $settings->title ?>
                                                </h1>
                                                <h4>
                                                    <?php echo $settings->address ?>
                                                </h4>
                                                <h4>
                                                    Tel: <?php echo $settings->phone ?>
                                                </h4>
                                            </div>


                                            <div class="col-lg-4 col-sm-4 details">
                                                <h4> <?php echo lang('payment_to'); ?> :</h4>
                                                <p>
                                                    <?php echo $settings->title; ?> <br>
                                                    <?php echo $settings->address; ?><br>
                                                    Tel: <?php echo $settings->phone; ?>
                                                </p>
                                            </div>


                                            <?php if (!empty($payment->patient)) { ?>
                                                <div class="col-lg-4 col-sm-4 details">
                                                    <h4> <?php echo lang('bill_to'); ?> :</h4>
                                                    <p>
                                                        <?php
                                                        $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
                                                        echo $patient_info->name . ' <br>';
                                                        echo $patient_info->address . '  <br/> P:';
                                                        echo $patient_info->phone
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                            <div class="col-lg-4 col-sm-4 details float-right">
                                                <h4> <?php echo lang('invoice_info'); ?> </h4>
                                                <ul class="unstyled">
                                                    <li> <?php echo lang('invoice_number'); ?> : <strong>00<?php echo $payment->id; ?></strong></li>

                                                </ul>
                                            </div>

                                            <div class="col-lg-4 col-sm-4 details">
                                                <h4> <?php echo lang('date'); ?> </h4>
                                                <ul class="unstyled">
                                                    <li><?php echo date('m/d/Y', $payment->date); ?></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> <?php echo lang('name'); ?> </th>
                                                    <th> <?php echo lang('company'); ?> </th>
                                                    <th> <?php echo lang('unit_price'); ?></th>
                                                    <th> <?php echo lang('quantity'); ?> </th>
                                                    <th> <?php echo lang('total_per_item'); ?></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if (!empty($payment->x_ray)) { ?>
                                                    <tr>
                                                        <td><?php echo $i = 1 ?></td>
                                                        <td>X Ray</td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $payment->x_ray; ?> </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                if (!empty($payment->category_name)) {
                                                    $category_name = $payment->category_name;
                                                    $category_name1 = explode(',', $category_name);
                                                    if (empty($payment->x_ray)) {
                                                        $i = 0;
                                                    }
                                                    foreach ($category_name1 as $category_name2) {
                                                        $category_name3 = explode('*', $category_name2);
                                                        if ($category_name3[1] > 0) {
                                                ?>
                                                            <tr>
                                                                <td><?php echo $i = $i + 1; ?></td>
                                                                <td><?php
                                                                    $current_medicine = $this->db->get_where('medicine', array('id' => $category_name3[0]))->row();
                                                                    echo $current_medicine->name;
                                                                    ?>
                                                                </td>
                                                                <td class=""> <?php echo $current_medicine->company; ?> </td>
                                                                <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                                <td class=""> <?php echo $category_name3[2]; ?> </td>
                                                                <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[2]; ?> </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-6 invoice-block float-right">
                                                <ul class="unstyled amounts">
                                                    <li><strong> <?php echo lang('sub_total'); ?> <?php echo lang('amount'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></li>
                                                    <?php if (!empty($payment->discount)) { ?>
                                                        <li><strong>Discount</strong> <?php
                                                                                        if ($discount_type == 'percentage') {
                                                                                            echo '(%) : ';
                                                                                        } else {
                                                                                            echo ': ' . $settings->currency;
                                                                                        }
                                                                                        ?> <?php
                                                                                            $discount = explode('*', $payment->discount);
                                                                                            if (!empty($discount[1])) {
                                                                                                echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                                                                            } else {
                                                                                                echo $discount[0];
                                                                                            }
                                                                                            ?></li>
                                                    <?php } ?>
                                                    <?php if (!empty($payment->vat)) { ?>
                                                        <li><strong> <?php echo lang('vat'); ?> :</strong> <?php
                                                                                                            if (!empty($payment->vat)) {
                                                                                                                echo $payment->vat;
                                                                                                            } else {
                                                                                                                echo '0';
                                                                                                            }
                                                                                                            ?> % = <?php echo $settings->currency . ' ' . $payment->flat_vat; ?></li>
                                                    <?php } ?>
                                                    <li><strong> <?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></li>

                                                </ul>
                                            </div>
                                        </div>





                                    </div>

                                </div>
                            </section>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


                <div class="col-md-5 no-print">
                    <div class="">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <section>
                                <div class="card-primary">

                                    <div class="panel-moree">

                                        <div class="text-center invoice-btn clearfix">
                                            <a class="btn btn-sm btn-secondary float-left mb-2" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                                        </div>

                                        <div class="text-center invoice-btn clearfix">
                                            <a class="btn btn-sm btn-warning  float-left download mb-2" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                                        </div>

                                        <div class="text-center invoice-btn clearfix">
                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                                <a href="finance/pharmacy/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-sm btn-primary float-left mb-2"><i class="fa fa-edit"></i> <?php echo lang('edit_invoice'); ?> </a>
                                            <?php } ?>
                                        </div>
                                        <div class="text-center invoice-btn no-print float-left ">
                                            <a href="finance/pharmacy/previousInvoice?id=<?php echo $payment->id ?>" class="btn btn-sm btn-primary mr-2 previousone1"><i class="fa fa-arrow-left"></i> </a>
                                            <a href="finance/pharmacy/nextInvoice?id=<?php echo $payment->id ?>" class="btn btn-sm btn-primary  nextone1 "><i class="fa fa-arrow-right"></i> </a>

                                        </div>



                                    </div>

                                </div>
                            </section>
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
    var language = "<?php echo $this->language; ?>";
    var payment_id = "<?php echo $payment->id; ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script src="common/extranal/js/pharmacy/print_invoice.js"></script>
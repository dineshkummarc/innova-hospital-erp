<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-file-invoice mr-2"></i><?php echo lang('invoice') ?> # <?php echo $payment->id; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('invoice') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> <?php echo $settings->title ?>
                                    <small class="float-right"><?php echo lang('date') ?>: <?php
                                                                                            if (!empty($payment)) {
                                                                                                echo date('d-m-Y', $payment->date);
                                                                                            }
                                                                                            ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>

                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <?php echo lang('from') ?>
                                <address>
                                    <strong><?php echo $settings->title ?></strong><br>
                                    <?php echo $settings->address ?>
                                    <br>
                                    <?php echo lang('phone') ?>: <?php echo $settings->phone ?><br>
                                    <?php echo lang('email') ?>: <?php echo $settings->email ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <?php echo lang('to') ?>
                                <address>
                                    <strong><?php echo $patient_info->name ?></strong><br>
                                    <?php echo $patient_info->address ?><br>
                                    <?php echo lang('phone') ?>: <?php echo $patient_info->phone ?><br>
                                    <?php echo lang('email') ?>: <?php echo $patient_info->email ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b><?php echo lang('invoice') ?> #<?php echo $payment->id; ?></b><br> <br>
                                <b><?php echo lang('patient_id') ?>:</b> <?php echo $patient_info->id ?><br>
                                <b><?php echo lang('payment') ?> <?php echo lang('due') ?>:</b> <?php
                                                                                                if (!empty($payment)) {
                                                                                                    echo date('d-m-Y', $payment->date);
                                                                                                }
                                                                                                ?><br>
                                <!-- <b>Account:</b> 968-34567 -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                        <!-- <table class="table_bar">
                            <tr>
                                <td class="barcode_first_td">
                                    <div class="paragraphprint">
                                        <label class="control-label image_text">VN </label>
                                        <span class="info_text"> :
                                            <img class="image_bar" alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=<?php echo $invoice_id; ?>&print=true" />
                                        </span>
                                    </div>
                                </td>

                                <td class="barcode_third_td">
                                    <div class="paragraphprint">
                                        <label class="control-label image_text">HN </label>
                                        <span class="info_text"> :
                                            <img class="image_bar" alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=<?php echo $patient_info_id; ?>&print=true" />
                                        </span>
                                    </div>

                                </td>

                            </tr>
                        </table> -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <?php if ($payment->payment_from == 'appointment') { ?>
                                                <th class="first_th">#</th>
                                                <th class="description_th"><?php echo lang('description'); ?></th>
                                                <th class="third_th"><?php echo lang('date_time'); ?></th>
                                                <th class="second_th"><?php echo lang('doctor'); ?></th>
                                                <th class="amount_th"><?php echo lang('amount'); ?></th>
                                            <?php } elseif ($payment->payment_from == 'admitted_patient_bed_service') { ?>
                                                <th class="first_th">#</th>
                                                <th class="description_th"><?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                                                <th class="third_th"><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                                <th class="second_th"><?php echo lang('quantity'); ?></th>
                                                <th class="amount_th"><?php echo lang('amount'); ?></th>
                                            <?php } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') { ?>
                                                <th class="first_th">#</th>
                                                <th class="description_th"><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                                <th class="third_th"><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                                <th class="second_th"><?php echo lang('quantity'); ?></th>
                                                <th class="amount_th"><?php echo lang('amount'); ?></th>
                                            <?php } elseif ($payment->payment_from == 'payment') { ?>
                                                <th class="first_th">#</th>

                                                <th class="description_th"><?php echo lang('description'); ?></th>
                                                <th class="service_th"><?php echo lang('room_no'); ?></th>
                                                <th class="third_th"><?php echo lang('unit_price'); ?></th>
                                                <th class="second_th"><?php echo lang('qty'); ?></th>
                                                <th class="amount_th"><?php echo lang('amount'); ?></th>
                                            <?php } else { ?>
                                                <th class="first_th">#</th>
                                                <th class="description_th"><?php echo lang('description'); ?></th>
                                                <th class="service_th"><?php echo lang('room_no'); ?></th>

                                                <th class="third_th"><?php echo lang('unit_price'); ?></th>
                                                <th class="second_th"><?php echo lang('qty'); ?></th>
                                                <th class="amount_th"><?php echo lang('amount'); ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($payment->payment_from == 'appointment') {
                                            if (!empty($payment->category_name)) {
                                                $appointment_details = $this->db->get_where('appointment', array('id' => $payment->appointment_id))->row();
                                        ?>
                                                <tr>
                                                    <td class="first_th"><?php echo '1'; ?> </td>
                                                    <td class="description_th"><?php echo $payment->category_name; ?> </td>
                                                    <td class="third_th"><?php echo date('d-m-Y', $appointment_details->date); ?> <br><?php echo $appointment_details->time_slot; ?> </td>
                                                    <td class="second_th"> <?php echo $appointment_details->doctorname; ?> </td>
                                                    <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                ?>
                                                    <tr>
                                                        <td class="first_th"><?php echo $i; ?> </td>
                                                        <td class="description_th"><?php echo $cat_new[1]; ?> </td>
                                                        <td class="third_th"><?php echo $settings->currency; ?> <?php echo $cat_new[2]; ?> </td>
                                                        <td class="second_th"> <?php echo $cat_new[3]; ?> </td>
                                                        <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $cat_new[4]; ?> </td>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                        } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                    $service = $this->db->get_where('pservice', array('id' => $cat_new[0]))->row();
                                                ?>
                                                    <tr>
                                                        <td class="first_th"><?php echo $i; ?> </td>
                                                        <td class="description_th"> <?php echo $service->name; ?> </td>
                                                        <td class="third_th"><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                        <td class="second_th"> <?php echo '1'; ?> </td>
                                                        <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            if (!empty($payment->category_name)) {
                                                $category_name = $payment->category_name;
                                                $category_name1 = explode(',', $category_name);
                                                $i = 0;
                                                // $length = count($category_name1);

                                                foreach ($category_name1 as $category_name2) {
                                                    $i = $i + 1;
                                                    $category_name3 = explode('*', $category_name2);
                                                    //$count=count+1;
                                                    if ($category_name3[3] > 0) {
                                                    ?>

                                                        <tr>
                                                            <td class="first_th"><?php echo $i; ?> </td>

                                                            <td class="description_th"><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->category; ?> </td>
                                                            <td class="service_th"><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->description; ?> </td>
                                                            <td class="third_th"><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                            <td class="second_th"> <?php echo $category_name3[3]; ?> </td>
                                                            <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[3]; ?> </td>
                                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead"><?php echo lang('payment_methods'); ?> :</p>
                                <img src="adminlte/dist/img/credit/visa.png" alt="Visa">
                                <img src="adminlte/dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="adminlte/dist/img/credit/american-express.png" alt="American Express">
                                <img src="adminlte/dist/img/credit/paypal2.png" alt="Paypal">

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    <?php echo $payment->remarks; ?>
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead"><?php echo lang('amount'); ?> <?php echo lang('due'); ?> <?php
                                                                                                            if (!empty($payment)) {
                                                                                                                echo date('d/m/Y', $payment->date);
                                                                                                            }
                                                                                                            ?></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%"><?php echo lang('gross_amount'); ?>:</th>
                                            <td><?php echo $settings->currency . ' ' . number_format($payment->amount, 2, ".", ""); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('vat'); ?> (<?php echo   number_format($payment->vat_amount_percent, 2, ".", ""); ?>%)</th>
                                            <td>
                                                <?php echo $settings->currency; ?>
                                                <?php
                                                if (!empty($payment->vat)) {
                                                    echo number_format($payment->vat, 2, ".", "");
                                                } else {
                                                    echo '0.00';
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('discount'); ?>(<?php echo  number_format($payment->percent_discount, 2, ".", ""); ?>%)</th>
                                            <td><?php
                                                $discount = explode('*', $payment->discount);
                                                if (!empty($payment->discount)) {
                                                    echo  $settings->currency . ' ' . number_format($payment->discount, 2, ".", "");
                                                } else {
                                                    echo $settings->currency . ' ' . '0.00';
                                                }
                                                ?></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo lang('total'); ?>:</th>
                                            <td><?php echo $settings->currency; ?> <?php echo $g = number_format($payment->gross_total, 2, ".", ""); ?></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo lang('amount_received'); ?>:</th>
                                            <td><?php echo $settings->currency; ?> <?php echo $r = number_format($this->finance_model->getDepositAmountByPaymentId($payment->id), 2, ".", ""); ?></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo lang('balance_due'); ?>:</th>
                                            <td><?php echo $settings->currency; ?> <?php echo number_format($g - $r, 2, ".", ""); ?></td>
                                        </tr>




                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">

                                <button type="button" class="btn btn-success float-right depositButton" data-toggle="modal" data-id="<?php echo $payment->id ?>" data-from="<?php echo $payment->payment_from ?>"><i class="far fa-credit-card"></i> <?php echo lang('submit'); ?>
                                    <?php echo lang('payment'); ?>
                                </button>
                                <a type="button" href="finance/download?id=<?php echo $payment->id; ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> <?php echo lang('generate'); ?> PDF
                                </a>
                                <a rel="noopener" onclick="javascript:window.print();" class="btn btn-secondary float-right mr-2"><i class="fas fa-print"></i> <?php echo lang('print'); ?></a>

                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {

                                ?>
                                    <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                                        $lab_pending = array();
                                        $lab_reports_previous = $this->lab_model->getLabByInvoice($payment->id);

                                        if (!empty($lab_reports_previous)) {
                                            foreach ($lab_reports_previous as $lab) {
                                                if ($lab->test_status == 'not_done' || empty($lab->test_status)) {
                                                    $lab_pending[] = 'no';
                                                }
                                            }
                                        }
                                        if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                                    ?>
                                            <a href="finance/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-secondary editbutton float-left mr-2"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('invoice'); ?> </a>
                                    <?php }
                                    } ?>

                                <?php } ?>


                                <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) { ?>
                                    <a href="finance/payment" class="btn btn-secondary float-left mb-1"><i class="fa fa-arrow-circle-left"></i> <?php echo lang('back_to_payment_modules'); ?> </a>
                                <?php } ?>



                            </div>


                        </div>

                    </div>


                    <!-- <div class="col-md-7 no-print card card-body">
                        <form role="form" action="finance/sendInvoice" method="post" enctype="multipart/form-data">
                            <div class="radio radio_button">
                                <label>
                                    <input type="radio" name="radio" id="optionsRadios2" value="patient" checked="checked">
                                    <?php echo lang('send_invoice_to_patient'); ?>
                                </label>
                            </div>
                            <div class="radio radio_button">
                                <label>
                                    <input type="radio" name="radio" id="optionsRadios2" value="other">
                                    <?php echo lang('send_invoice_to_others'); ?>
                                </label>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $payment->id; ?>">
                            <div class="radio other">
                                <label>
                                    <?php echo lang('email'); ?> <?php echo lang('address'); ?>
                                    <input type="email" name="other_email" value="" class="form-control form-control-lg">
                                </label>

                            </div>

                            <button type="submit" name="submit" class="btn btn-success btn-sm float-left mb-1"><i class="fa fa-location-arrow"></i> <?php echo lang('send'); ?></button>

                        </form>
                    </div> -->



                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_deposit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="finance/deposit" id="deposit-form" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> &ast; </label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('invoice_no'); ?> &ast; </label>
                            <input type="text" class="form-control form-control-lg" name="invoice_no" id="invoice_no" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast; </label>
                            <input type="text" class="form-control form-control-lg" name="date" id="date" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('due'); ?> <?php echo lang('amount'); ?></label>
                            <input type="text" class="form-control form-control-lg" id="due_amount" name="due" value='' placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('deposit_amount'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="deposited_amount" id="deposited_amount" value='' placeholder="" required>
                        </div>



                        <div class="form-group col-md-12">
                            <div class="">
                                <label for="exampleInputEmail1"> <?php echo lang('deposit_type'); ?></label>
                            </div>
                            <div class="">
                                <select class="form-control form-control-lg m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                    <?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
                                        <option value=""> <?php echo lang('select'); ?> </option>
                                        <option value="Card"> <?php echo lang('card'); ?> </option>
                                    <?php } ?>


                                </select>
                            </div>

                            <?php
                            $payment_gateway = $settings->payment_gateway;
                            ?>



                            <div class="cardPayment row mt-3">

                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                    <div class="payment pad_bot">
                                        <img src="uploads/card.png" width="100%">
                                    </div>
                                </div>
                                <?php
                                if ($payment_gateway == 'PayPal') {
                                ?>

                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                        <select class="form-control form-control-lg m-bot15" name="card_type" value=''>

                                            <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                            <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                            <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                        </select>
                                    </div>
                                <?php } ?>
                                <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                        <input type="text" id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                    </div>
                                <?php } ?>
                                <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                    <div class="col-md-12 payment pad_bot mt-3">
                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                        <input type="text" class="form-control pay_in" id="card" name="card_number" value='' placeholder="">
                                    </div>



                                    <div class="col-md-8 payment pad_bot mt-3">
                                        <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                        <input type="text" class="form-control pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                    </div>
                                    <div class="col-md-4 payment pad_bot mt-3">
                                        <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                        <input type="text" class="form-control pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>



                        </div>


                        <input type="hidden" name="redirect" value="due">
                        <input type="hidden" name="id" id="id" value=''>
                        <input type="hidden" name="patient" id="patient_id" value=''>
                        <input type="hidden" name="payment_id" id="payment_id" value=''>
                        <div class="form-group cashsubmit payment right-six col-md-12">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right mr-0"> <?php echo lang('submit'); ?></button>
                        </div>
                        <div class="form-group cardsubmit right-six col-md-12 d-none">
                            <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                            <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row float-right mr-0" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                            ?>onClick="stripePay(event);" <?php }
                                                                                                                                                            ?><?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                                                                                                                                                                ?>onClick="twoCheckoutPay(event);" <?php }
                                                                                                                                                                                                    ?>> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="common/extranal/js/finance/invoice.js"></script>
<?php if (!empty($gateway->publish)) {
    $gateway_stripe = $gateway->publish;
} else {
    $gateway_stripe = '';
} ?>




<script type="text/javascript">
    var publish = "<?php echo $gateway_stripe; ?>";
</script>
<script src="common/js/moment.min.js"></script>

<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>

<script src="common/extranal/js/finance/patient_deposit.js"></script>
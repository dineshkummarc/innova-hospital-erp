<!--sidebar end-->
<!--main content start-->

<style>
    .select2-container--default .select2-selection--single {
        width: 248px !important;
    }
    
    /* View Appointment Modal Styles */
    .appointment-detail-row {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .appointment-detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }
    
    .detail-value {
        color: #666;
        word-wrap: break-word;
    }
    
    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-treated {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-requested {
        background-color: #e2e3e5;
        color: #383d41;
    }
    
    .view-btn {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>





<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-check text-primary mr-3"></i>
                        <?php echo lang('appointment'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('appointment'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_appointment'); ?>
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
                        <div class="card-header bg-white py-4">
                            <h3 class="card-title font-weight-bold"><?php echo lang('List of All Appointments'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#all"><?php echo lang('all'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pending"><?php echo lang('pending_confirmation'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#confirmed"><?php echo lang('confirmed'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#treated"><?php echo lang('treated'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cancelled"><?php echo lang('cancelled'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#requested"><?php echo lang('requested'); ?></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <table class="table table-bordered" id="editable-sample5" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div id="pending" class="tab-pane">
                                    <table class="table table-bordered" id="editable-sample1" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div id="confirmed" class="tab-pane">
                                    <table class="table table-bordered" id="editable-sample2" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div id="treated" class="tab-pane">
                                    <table class="table table-bordered" id="editable-sample3" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div id="cancelled" class="tab-pane">
                                    <table class="table table-bordered" id="editable-sample4" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div id="requested" class="tab-pane">
                                    <table class="table table-bordered" id="editable-sample6" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                                <th class="font-weight-bold"><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>










<!--main content end-->
<!--footer start-->




<!-- Include Global Modal Styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/global-modal-styles.css">

<!-- Add Appointment Modal-->
<div class="modal fade modal-enhanced" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    <?php echo lang('add_appointment'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form role="form" action="appointment/addNew" id="addAppointmentForm" method="post" class="clearfix" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="col-md-6 patient_div">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15 pos_select" id="pos_select" name="patient" value='' required>
                            </select>
                        </div>
                        <input type="hidden" name="redirectlink" value="10">
                        <div class="pos_client clearfix col-md-12 row">
                            <div class="payment pad_bot float-right patient_div col-md-6 mt-3">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_name" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6 mt-3">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_email" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6 mt-3">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_phone" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6 mt-3">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_age" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot col-md-6 mt-3">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                <select class="form-control form-control-lg" name="p_gender" value=''>
                                    <option value="Male"> <?php echo lang('male'); ?> </option>
                                    <option value="Female"> <?php echo lang('female'); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 doctor_div">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" id="adoctors" name="doctor" value='' required>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &#42;</label>
                            <input type="text" class="form-control form-control-lg col-sm-8 default-date-picker" autocomplete="off" id="date" onkeypress="return false;" name="date" id="exampleInputEmail1" value='' placeholder="" required>
                        </div>
                        <div class="col-md-6 aslots mt-3">
                            <label for="exampleInputEmail1"><?php echo lang('available_slots'); ?> </label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="time_slot" id="aslots" value=''>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('status'); ?></label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="status" value=''>
                                <option value="Pending Confirmation"> <?php echo lang('pending_confirmation'); ?> </option>
                                <option value="Confirmed"> <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated"> <?php echo lang('treated'); ?> </option>
                                <option value="Cancelled"> <?php echo lang('cancelled'); ?> </option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="col-sm-4"><?php echo lang('visit'); ?> <?php echo lang('type'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="visit_description" id="visit_description" value='' required>
                            </select>
                        </div>
                        <div class="form-group col-md-6 form_data mt-3">
                            <label for="exampleInputEmail1"><?php echo lang(''); ?> <?php echo lang('charges'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="visit_charges" id="visit_charges" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-6 form_data mt-3">
                            <label for="exampleInputEmail1"><?php echo lang('discount'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="discount" id="discount" value='0' placeholder="">
                        </div>
                        <div class="form-group col-md-6 form_data mt-3">
                            <label for="exampleInputEmail1"><?php echo lang('grand_total'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="grand_total" id="grand_total" value='0' placeholder="" readonly="">
                        </div>
                        <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                            <div class="col-md-6">
                                <label for="" class="col-sm-4"> <?php echo lang('pay_now'); ?></label>
                                <input type="checkbox" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                <br>
                                <br>
                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                    <span class="info_message"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed') ?></span>
                                <?php } ?>
                            </div>

                            <div class="payment_label col-md-6 d-none deposit_type">
                                <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                <div class="">
                                    <select class="form-control form-control-lg col-sm-8 m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                            <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                            <option value="Card"> <?php echo lang('card'); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $payment_gateway = $settings->payment_gateway;
                                ?>

                                <div class="cardPayment">
                                    <hr>
                                    <?php if ($payment_gateway != 'Paymob') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                            <div class="payment pad_bot">
                                                <img src="uploads/card.png" width="100%">
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($payment_gateway == 'PayPal') { ?>
                                        <div class="col-md-12 payment pad_bot my-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="card_type" value=''>
                                                <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') { ?>
                                        <div class="col-md-12 payment pad_bot my-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                            <input type="text" id="cardholder" class="form-control form-control-lg col-sm-8 pay_in" name="cardholder" value='' placeholder="">
                                        </div>
                                    <?php } ?>

                                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                        <div class="col-md-12 payment pad_bot my-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                            <input type="text" id="card" class="form-control form-control-lg col-sm-8 pay_in" name="card_number" value='' placeholder="">
                                        </div>

                                        <div class="col-md-12 payment pad_bot mt-3 my-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control form-control-lg col-sm-8 pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                        </div>
                                        <div class="col-md-12 payment pad_bot mt-3 my-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                            <input type="text" class="form-control form-control-lg col-sm-8 pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="btn-block">
                                <div class="">
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cashsubmit payment btn-block">
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-block float-right"> <?php echo lang('submit'); ?></button>
                                    </div>
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cardsubmit btn-block d-none">
                                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-primary btn-block float-right" <?php if ($settings->payment_gateway == 'Stripe') { ?>onClick="stripePay(event);" <?php } ?> <?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') { ?>onClick="twoCheckoutPay(event);" <?php } ?>> <?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group payment btn-block">
                                <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-block float-right mr-0"> <?php echo lang('submit'); ?></button>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->

<!-- Edit Event Modal-->
<div class="modal fade modal-enhanced" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-edit mr-2"></i>
                    <?php echo lang('edit_appointment'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6 patient_div">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15  pos_select1 patient" id="pos_select1" name="patient" value='' required>
                            </select>
                        </div>
                        <div class="pos_client1 clearfix col-md-12 row">
                            <div class="payment pad_bot float-right col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_name" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_email" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_phone" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot float-right col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                <input type="text" class="form-control form-control-lg col-sm-8 pay_in" name="p_age" value='' placeholder="">
                            </div>
                            <div class="payment pad_bot col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                <select class="form-control form-control-lg" name="p_gender" value=''>
                                    <option value="Male"> <?php echo lang('male'); ?> </option>
                                    <option value="Female"> <?php echo lang('female'); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 doctor_div1">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15 doctor" id="adoctors1" name="doctor" value='' required>
                            </select>
                        </div>
                        <input type="hidden" name="redirectlink" value="10">
                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &#42;</label>
                            <input type="text" class="form-control form-control-lg col-sm-8 default-date-picker" autocomplete="off" id="date1" required="" onkeypress="return false;" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1">Available Slots</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="time_slot" id="aslots1" value=''>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('status'); ?></label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="status" value=''>
                                <option value="Pending Confirmation"> <?php echo lang('pending_confirmation'); ?> </option>
                                <option value="Confirmed"> <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated"> <?php echo lang('treated'); ?> </option>
                                <option value="Cancelled"> <?php echo lang('cancelled'); ?> </option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="col-sm-4"><?php echo lang('visit'); ?> <?php echo lang('type'); ?> &#42;</label>
                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="visit_description" id="visit_description1" value='' required>
                            </select>
                        </div>

                        <input type="hidden" name="id" id="appointment_id" value=''>
                        <div class="form-group col-md-6 d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"><?php echo lang(''); ?> <?php echo lang('charges'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="visit_charges" id="visit_charges1" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-6 d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"><?php echo lang('discount'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="discount" id="discount1" value='0' placeholder="">
                        </div>
                        <div class="form-group col-md-6 d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"><?php echo lang('grand_total'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="grand_total" id="grand_total1" value='0' placeholder="" readonly="">
                        </div>
                        <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                            <div class="col-md-6 d-none pay_now">
                                <label for="" class="col-sm-4"> <?php echo lang('pay_now'); ?></label>
                                <input type="checkbox" id="pay_now_appointment1" name="pay_now_appointment" value="pay_now_appointment">
                                <br>
                                <br>
                                <span class="info_message"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed') ?></span>
                            </div>
                            <div class="col-md-12 d-none payment_status form-group mt-3">
                                <label for="" class="col-sm-4"> <?php echo lang('payment'); ?> <?php echo lang('status'); ?></label><br>
                                <input type="text" class="form-control form-control-lg" id="pay_now_appointment" name="payment_status_appointment" value="paid" readonly="">
                            </div>
                            <div class="payment_label col-md-12 d-none deposit_type1">
                                <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-lg m-bot15 js-example-basic-single selecttype1" id="selecttype1" name="deposit_type" value=''>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                            <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                            <option value="Card"> <?php echo lang('card'); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $payment_gateway = $settings->payment_gateway;
                                ?>

                                <div class="card1">
                                    <hr>
                                    <?php if ($payment_gateway != 'Paymob') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                            <div class="payment pad_bot">
                                                <img src="uploads/card.png" width="100%">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway == 'PayPal') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                            <select class="form-control form-control-lg col-sm-8 m-bot15" name="card_type" value=''>
                                                <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                            <input type="text" id="cardholder1" class="form-control form-control-lg col-sm-8 pay_in" name="cardholder" value='' placeholder="">
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                            <input type="text" id="card1" class="form-control form-control-lg col-sm-8 pay_in" name="card_number" value='' placeholder="">
                                        </div>

                                        <div class="col-md-8 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control form-control-lg col-sm-8 pay_in" id="expire1" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" readonly>
                                        </div>
                                        <div class="col-md-4 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                            <input type="text" class="form-control form-control-lg col-sm-8 pay_in" id="cvv1" maxlength="3" name="cvv" value='' placeholder="">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="btn-block">
                                <div class="">
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cashsubmit1 payment btn-block">
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-block float-right"> <?php echo lang('submit'); ?></button>
                                    </div>
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cardsubmit1  btn-block d-none">
                                        <button type="submit" name="pay_now" id="submit-btn1" class="btn btn-primary btn-block float-right" <?php if ($settings->payment_gateway == 'Stripe') { ?>onClick="stripePay1(event);" <?php } ?> <?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') { ?>onClick="twoCheckoutPay1(event);" <?php } ?>> <?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group paymentbtn-block">
                                <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-block float-right mr-0"> <?php echo lang('submit'); ?></button>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

















<div class="modal fade modal-enhanced" role="dialog" id="cmodal">
    <div class="modal-dialog modal-xl med_his" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-medical mr-2"></i>
                    Medical History
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='medical_history' class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Appointment Details Modal -->
<div class="modal fade modal-enhanced" id="viewAppointmentModal" role="dialog" aria-labelledby="viewAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>
                    <?php echo lang('appointment'); ?> <?php echo lang('details'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="appointmentDetails">
                    <!-- Appointment details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> <?php echo lang('close'); ?>
                </button>
                <button type="button" class="btn btn-primary" id="printAppointmentBtn">
                    <i class="fas fa-print mr-1"></i> <?php echo lang('print'); ?>
                </button>
            </div>
        </div>
    </div>
</div>





<?php if (!empty($gateway->publish)) {
    $gateway_stripe = $gateway->publish;
} else {
    $gateway_stripe = '';
} ?>



<script src="common/js/codearistos.min.js"></script>
<script src="common/js/moment.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script> -->
<script type="text/javascript">
    var publish = "<?php echo $gateway_stripe; ?>";
</script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>

<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
</script>

<script src="common/extranal/js/appointment/appointment.js"></script>
<script src="common/extranal/js/appointment/appointment_select2.js"></script>

<script type="text/javascript">
    // Function to view appointment details
    function viewAppointment(appointmentId) {
        // Show loading state
        $('#appointmentDetails').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading appointment details...</div>');
        
        // Make AJAX request to get appointment details
        $.ajax({
            url: 'appointment/getAppointmentDetails',
            type: 'POST',
            data: { appointment_id: appointmentId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayAppointmentDetails(response.data);
                } else {
                    $('#appointmentDetails').html('<div class="alert alert-danger">Error loading appointment details: ' + response.message + '</div>');
                }
            },
            error: function() {
                $('#appointmentDetails').html('<div class="alert alert-danger">Error loading appointment details. Please try again.</div>');
            }
        });
        
        // Show the modal
        $('#viewAppointmentModal').modal('show');
    }
    
    // Function to display appointment details
    function displayAppointmentDetails(data) {
        var statusClass = 'status-' + data.status.toLowerCase().replace(' ', '-');
        var html = `
            <div class="row">
                <div class="col-md-6">
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('id'); ?>:</div>
                        <div class="detail-value">${data.id}</div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('patient'); ?>:</div>
                        <div class="detail-value">${data.patient_name}</div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('doctor'); ?>:</div>
                        <div class="detail-value">${data.doctor_name}</div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('date-time'); ?>:</div>
                        <div class="detail-value">${data.date_time}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('status'); ?>:</div>
                        <div class="detail-value"><span class="status-badge ${statusClass}">${data.status}</span></div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('remarks'); ?>:</div>
                        <div class="detail-value">${data.remarks || 'N/A'}</div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('description'); ?>:</div>
                        <div class="detail-value">${data.description || 'N/A'}</div>
                    </div>
                    <div class="appointment-detail-row">
                        <div class="detail-label"><?php echo lang('amount'); ?>:</div>
                        <div class="detail-value">${data.amount || 'N/A'}</div>
                    </div>
                </div>
            </div>
        `;
        
        if (data.invoice_id) {
            html += `
                <div class="row">
                    <div class="col-md-12">
                        <div class="appointment-detail-row">
                            <div class="detail-label"><?php echo lang('invoice_id'); ?>:</div>
                            <div class="detail-value">${data.invoice_id}</div>
                        </div>
                    </div>
                </div>
            `;
        }
        
        $('#appointmentDetails').html(html);
    }
    
    // Print appointment details
    $('#printAppointmentBtn').click(function() {
        var printContent = $('#appointmentDetails').html();
        var printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Appointment Details</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .appointment-detail-row { margin-bottom: 15px; padding: 10px; border-bottom: 1px solid #eee; }
                        .detail-label { font-weight: bold; color: #333; margin-bottom: 5px; }
                        .detail-value { color: #666; }
                        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
                        .status-pending { background-color: #fff3cd; color: #856404; }
                        .status-confirmed { background-color: #d4edda; color: #155724; }
                        .status-treated { background-color: #cce5ff; color: #004085; }
                        .status-cancelled { background-color: #f8d7da; color: #721c24; }
                        .status-requested { background-color: #e2e3e5; color: #383d41; }
                    </style>
                </head>
                <body>
                    <h2>Appointment Details</h2>
                    ${printContent}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    });
</script>
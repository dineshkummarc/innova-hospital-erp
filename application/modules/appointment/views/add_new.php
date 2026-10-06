<link href="common/extranal/css/appointment/add_new.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-plus text-primary mr-3"></i>
                        <?php echo lang('new_appointment'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="appointment" class="text-primary"><?php echo lang('appointments'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('new_appointment'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-4">
                            <h2 class="card-title mb-0 text-white display-6 font-weight-800"><?php echo lang('appointment_booking_form'); ?></h2>
                        </div>
                        <div class="card-body bg-light p-4">
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('feedback'); ?>

                            <form role="form" action="appointment/addNew" id="addAppointmentForm" method="post" enctype="multipart/form-data">

                                <!-- Patient Information -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-user-circle mr-3 text-primary"></i><?php echo lang('patient_details'); ?>
                                        </h3>
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

                                    <div class="pos_client clearfix" style="display: none;">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient_name'); ?></label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="p_name" value='<?php if (!empty($payment->p_name)) {
                                                                                                                                            echo $payment->p_name;
                                                                                                                                        } ?>'>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient_email'); ?></label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="p_email" value='<?php if (!empty($payment->p_email)) {
                                                                                                                                            echo $payment->p_email;
                                                                                                                                        } ?>'>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient_phone'); ?></label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="p_phone" value='<?php if (!empty($payment->p_phone)) {
                                                                                                                                            echo $payment->p_phone;
                                                                                                                                        } ?>'>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient_age'); ?></label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="p_age" value='<?php if (!empty($payment->p_age)) {
                                                                                                                                            echo $payment->p_age;
                                                                                                                                        } ?>'>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient_gender'); ?></label>
                                                <select class="form-control form-control-lg shadow-sm" name="p_gender">
                                                    <option value="Male" <?php if (!empty($patient->sex)) {
                                                                                if ($patient->sex == 'Male') {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>><?php echo lang('male'); ?></option>
                                                    <option value="Female" <?php if (!empty($patient->sex)) {
                                                                                if ($patient->sex == 'Female') {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>><?php echo lang('female'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Appointment Details -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-success pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-calendar-check mr-3 text-success"></i><?php echo lang('appointment_details'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-6 mb-4 doctor_div"> 
                                        <div class="form-group ">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('select_doctor'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg shadow-sm" id="adoctors" name="doctor" required>
                                                <?php if (!empty($appointment)) { ?>
                                                    <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('visit_type'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg shadow-sm" name="visit_description" id="visit_description" required>
                                                <option value=""><?php echo lang('select_visit_type'); ?></option>
                                                <?php foreach ($visits as $visit) { ?>
                                                    <option value="<?php echo $visit->id; ?>"><?php echo $visit->visit_description ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('appointment_date'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg shadow-sm default-datepicker" id="date" name="date" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('available_time_slots'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" name="time_slot" id="aslots">
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- Payment Details -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-danger pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-credit-card mr-3 text-danger"></i><?php echo lang('payment_details'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-muted"><?php echo lang('visit_charges'); ?></span>
                                                <input type="number" class="form-control form-control-lg text-right w-50" name="visit_charges" id="visit_charges" readonly>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-muted"><?php echo lang('discount'); ?></span>
                                                <input type="number" class="form-control form-control-lg text-right w-50" name="discount" id="discount" value="0">
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="h5 mb-0"><?php echo lang('total_amount'); ?></span>
                                                <input type="number" class="form-control form-control-lg text-right w-50 font-weight-bold" name="grand_total" id="grand_total" readonly>
                                            </div>
                                        </div>

                                        <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                                            <?php if (!empty($appointment->payment_status) && $appointment->payment_status == 'paid') { ?>
                                                <div class="form-group mb-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('payment_status'); ?></label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm" value="Paid" readonly>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group mb-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                                        <label class="custom-control-label text-uppercase font-weight-bold text-muted" for="pay_now_appointment"><?php echo lang('pay_now'); ?></label>
                                                    </div>
                                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <small class="text-muted d-block mt-2"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed'); ?></small>
                                                    <?php } ?>
                                                </div>

                                                <div class="deposit_type d-none">
                                                    <div class="form-group mb-4">
                                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('payment_method'); ?></label>
                                                        <select class="form-control form-control-lg shadow-sm selecttype" id="selecttype" name="deposit_type">
                                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Card">Card</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="cardPayment" style="display:none;">
                                                        <?php if ($payment_gateway != 'Paymob') { ?>
                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('accepted_cards'); ?></label>
                                                                <div class="payment-cards">
                                                                    <img src="uploads/card.png" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($payment_gateway == 'PayPal') { ?>
                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('card_type'); ?></label>
                                                                <select class="form-control form-control-lg shadow-sm" name="card_type">
                                                                    <option value="Mastercard">Mastercard</option>
                                                                    <option value="Visa">Visa</option>
                                                                    <option value="American Express">American Express</option>
                                                                </select>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') { ?>
                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('cardholder_name'); ?></label>
                                                                <input type="text" class="form-control form-control-lg shadow-sm" id="cardholder" name="cardholder">
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('card_number'); ?></label>
                                                                <input type="text" class="form-control form-control-lg shadow-sm" id="card" name="card_number">
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('expiry_date'); ?></label>
                                                                <input type="text" class="form-control form-control-lg shadow-sm" id="expire" name="expire_date" placeholder="MM/YY" maxlength="7">
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('cvv'); ?></label>
                                                                <input type="text" class="form-control form-control-lg shadow-sm" id="cvv" name="cvv" maxlength="3">
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('status'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" name="status">
                                                <option value="Pending Confirmation"><?php echo lang('pending_confirmation'); ?></option>
                                                <option value="Confirmed"><?php echo lang('confirmed'); ?></option>
                                                <option value="Treated"><?php echo lang('treated'); ?></option>
                                                <option value="Cancelled"><?php echo lang('cancelled'); ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-5">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('additional_notes'); ?></label>
                                            <textarea class="form-control form-control-lg shadow-sm" name="remarks" rows="3"></textarea>
                                        </div>

                                        <input type="hidden" name="id" id="appointment_id" value='<?php if (!empty($appointment->id)) {
                                                                                                        echo $appointment->id;
                                                                                                    } ?>'>
                                        <input type="hidden" name="redirectlink" value="10">

                                        <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-lg btn-block shadow-lg text-uppercase font-weight-bold py-3">
                                            <i class="fas fa-calendar-check mr-3"></i><?php echo lang('book_appointment'); ?>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    var publish = "<?php echo $gateway->publish; ?>";
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
    var no_available_timeslots = "No time slots available";
    var currency = "<?php echo $settings->currency; ?>";
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>

<?php if (!empty($appointment->id)) { ?>
    <script src="common/extranal/js/appointment/edit_appointment.js"></script>
<?php } else { ?>
    <script src="common/extranal/js/appointment/add_new.js"></script>
<?php } ?>

<script src="common/extranal/js/appointment/appointment_select2.js"></script>
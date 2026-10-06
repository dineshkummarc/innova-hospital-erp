<link href="common/extranal/css/appointment/add_new.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-5 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-plus text-primary mr-3"></i>
                        Schedule New Appointment
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent float-sm-right p-0">
                            <li class="breadcrumb-item"><a href="home" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="appointment" class="text-primary">Appointments</a></li>
                            <li class="breadcrumb-item active font-weight-bold">New Appointment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body p-5">

                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('feedback'); ?>

                            <form role="form" action="appointment/addNew" id="addAppointmentForm" class="row" method="post" enctype="multipart/form-data">

                                <div class="col-md-6 pr-md-5">
                                    <h3 class="text-uppercase font-weight-black mb-4 pb-3 border-bottom">Patient Information</h3>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold"><?php echo lang('select_patient'); ?></label>
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

                                    <div class="pos_client clearfix" style="display: none;">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-muted font-weight-bold">Patient Name</label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="p_name" value='<?php if (!empty($payment->p_name)) {
                                                                                                                                        echo $payment->p_name;
                                                                                                                                    } ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-muted font-weight-bold">Patient Email</label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="p_email" value='<?php if (!empty($payment->p_email)) {
                                                                                                                                        echo $payment->p_email;
                                                                                                                                    } ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-muted font-weight-bold">Patient Phone</label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="p_phone" value='<?php if (!empty($payment->p_phone)) {
                                                                                                                                        echo $payment->p_phone;
                                                                                                                                    } ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-muted font-weight-bold">Patient Age</label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="p_age" value='<?php if (!empty($payment->p_age)) {
                                                                                                                                        echo $payment->p_age;
                                                                                                                                    } ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-muted font-weight-bold">Patient Gender</label>
                                            <select class="form-control form-control-lg shadow-sm" name="p_gender">
                                                <option value="Male" <?php if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        } ?>>Male</option>
                                                <option value="Female" <?php if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        } ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold"><?php echo lang('select_doctor'); ?></label>
                                        <select class="form-control form-control-lg shadow-sm" id="adoctors" name="doctor" required>
                                            <?php if (!empty($appointment)) { ?>
                                                <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold">Visit Type</label>
                                        <select class="form-control form-control-lg shadow-sm" name="visit_description" id="visit_description" required>
                                            <option value="">Select Visit Type</option>
                                            <?php foreach ($visits as $visit) { ?>
                                                <option value="<?php echo $visit->id; ?>"><?php echo $visit->visit_description ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold"><?php echo lang('appointment_date'); ?></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm default-datepicker" id="date" name="date" required readonly>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold">Available Time Slots</label>
                                        <select class="form-control form-control-lg shadow-sm" name="time_slot" id="aslots">
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6 pl-md-5">
                                    <h3 class="text-uppercase font-weight-black mb-4 pb-3 border-bottom"><?php echo lang('payment_details'); ?></h3>

                                    <div class="bg-light p-4 rounded-lg mb-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted">Visit Charges</span>
                                            <input type="number" class="form-control form-control-lg text-right w-50" name="visit_charges" id="visit_charges" readonly>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted">Discount</span>
                                            <input type="number" class="form-control form-control-lg text-right w-50" name="discount" id="discount" value="0">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="h5 mb-0">Total Amount</span>
                                            <input type="number" class="form-control form-control-lg text-right w-50 font-weight-bold" name="grand_total" id="grand_total" readonly>
                                        </div>
                                    </div>

                                    <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                                        <?php if (!empty($appointment->payment_status) && $appointment->payment_status == 'paid') { ?>
                                            <div class="form-group mb-4">
                                                <label class="text-uppercase text-muted font-weight-bold"><?php echo lang('payment_status'); ?></label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" value="Paid" readonly>
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                                    <label class="custom-control-label text-uppercase text-muted font-weight-bold" for="pay_now_appointment">Pay Now</label>
                                                </div>
                                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <small class="text-muted d-block mt-2"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed'); ?></small>
                                                <?php } ?>
                                            </div>

                                            <div class="deposit_type d-none">
                                                <div class="form-group mb-4">
                                                    <label class="text-uppercase text-muted font-weight-bold">Deposit Type</label>
                                                    <select class="form-control form-control-lg shadow-sm selecttype" id="selecttype" name="deposit_type">
                                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                            <option value="Cash"><?php echo lang('cash'); ?></option>
                                                            <option value="Card"><?php echo lang('card'); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="cardPayment" style="display:none;">
                                                    <?php if ($payment_gateway != 'Paymob') { ?>
                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold"><?php echo lang('accepted_cards'); ?></label>
                                                            <div class="payment-cards">
                                                                <img src="uploads/card.png" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($payment_gateway == 'PayPal') { ?>
                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold">Card Type</label>
                                                            <select class="form-control form-control-lg shadow-sm" name="card_type">
                                                                <option value="Mastercard">Mastercard</option>
                                                                <option value="Visa">Visa</option>
                                                                <option value="American Express">American Express</option>
                                                            </select>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') { ?>
                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold">Cardholder Name</label>
                                                            <input type="text" class="form-control form-control-lg shadow-sm" id="cardholder" name="cardholder">
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold">Card Number</label>
                                                            <input type="text" class="form-control form-control-lg shadow-sm" id="card" name="card_number">
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold">Expiry Date</label>
                                                            <input type="text" class="form-control form-control-lg shadow-sm" id="expire" name="expire_date" placeholder="MM/YY" maxlength="7">
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label class="text-uppercase text-muted font-weight-bold">CVV</label>
                                                            <input type="text" class="form-control form-control-lg shadow-sm" id="cvv" name="cvv" maxlength="3">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-muted font-weight-bold">Status</label>
                                        <select class="form-control form-control-lg shadow-sm" name="status">
                                            <option value="Pending Confirmation">Pending Confirmation</option>
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Treated">Treated</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="text-uppercase text-muted font-weight-bold">Additional Notes</label>
                                        <textarea class="form-control form-control-lg shadow-sm" name="remarks" rows="3"></textarea>
                                    </div>

                                    <input type="hidden" name="id" id="appointment_id" value='<?php if (!empty($appointment->id)) {
                                                                                                    echo $appointment->id;
                                                                                                } ?>'>
                                    <input type="hidden" name="redirectlink" value="10">

                                    <button type="submit" name="submit2" id="submit1" class="btn btn-primary btn-lg btn-block shadow-lg text-uppercase font-weight-bold py-3">
                                        Confirm Appointment
                                    </button>
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
<?php
$payment = isset($payment) ? $payment : null;
$draft = isset($draft) ? $draft : null;
$can_create_patient = $this->ion_auth->in_group(array('admin', 'superadmin', 'Accountant', 'Receptionist', 'Doctor', 'Nurse', 'Laboratorist'));
$can_create_doctor = $this->ion_auth->in_group(array('admin', 'superadmin', 'Accountant', 'Receptionist'));
$can_create_referrer = $this->ion_auth->in_group(array('admin', 'superadmin', 'Accountant', 'Receptionist'));
?>
<link href="common/css/bootstrap-reset.css" rel="stylesheet">
<link href="common/extranal/css/finance/add_payment_view.css?v=compact-2026" rel="stylesheet">

<style>
    .page-add-payment .percent_amount {
        font-size: 0.65rem !important;
        padding: 0.25rem 0.4rem !important;
    }

    .page-add-payment .percent_input {
        padding: 0.35rem 0.45rem !important;
    }
</style>

<div class="content-wrapper bg-gradient-light page-add-payment">
    <section class="content-header py-1 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="h5 font-weight-bold mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-2"></i>
                        <?php
                        if (!empty($payment->id)) {
                            echo lang('edit_invoice') . ': (' . lang('invoice_id') . '# ' . $payment->id . ')';
                        } elseif (!empty($draft->id)) {
                            echo lang('edit_draft_invoice');
                        } else {
                            echo lang('add_new_invoice');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="finance/payment"><?php echo lang('all') ?> <?php echo lang('invoices') ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($payment->id)) {
                                    echo lang('edit_invoice') . ': (' . lang('invoice_id') . ':' . $payment->id . ')';
                                } elseif (!empty($draft->id)) {
                                    echo lang('edit_draft_invoice');
                                } else {
                                    echo lang('add_new_invoice');
                                }
                                ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-1">
        <div class="container-fluid">
            <div class="row py-4">
                <form role="form" id="editPaymentForm" class="clearfix form-row" action="finance/addPayment" method="post" enctype="multipart/form-data">

                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm border-0 mb-2">
                            <div class="card-body p-2">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <!-- Patient Selection -->
                                            <div class="form-group mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="text-uppercase font-weight-bold text-muted mb-0"><?php echo lang('patient'); ?><span class="text-danger">*</span></label>
                                                    <?php if ($can_create_patient) { ?>
                                                        <button type="button" class="btn btn-xs btn-outline-primary font-weight-bold py-0 px-2" id="btn_open_patient_modal" title="Add New Patient">
                                                            <i class="fas fa-user-plus mr-1"></i>+ <?php echo lang('add_new'); ?>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                                <select class="form-control shadow-sm pos_select" id="pos_select" name="patient" value='' required="">
                                                    <?php if (!empty($payment)) {
                                                        if (empty($patients->age)) {
                                                            $dateOfBirth = $patients->birthdate;
                                                            if (empty($dateOfBirth)) {
                                                                $age[0] = '0';
                                                            } else {
                                                                $today = date("Y-m-d");
                                                                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                $age[0] = $diff->format('%y');
                                                            }
                                                        } else {
                                                            $age = explode('-', $patients->age);
                                                        }
                                                    ?>
                                                        <option value="<?php echo $patients->id; ?>" selected="selected">
                                                            <?php echo $patients->name; ?> ( <?php echo lang('id'); ?>:
                                                            <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>:
                                                            <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>:
                                                            <?php echo $age[0]; ?> ) </option>
                                                        <?php } elseif (!empty($draft->patient)) {
                                                        if ($draft->patient == 'add_new') {
                                                        ?>
                                                            <option value="<?php echo 'add_new'; ?>" selected="selected">
                                                                <?php echo lang('add_new'); ?></option>
                                                        <?php } else {
                                                            $patients = $this->patient_model->getPatientById($draft->patient);
                                                            $age = explode('-', $patients->age);
                                                        ?>
                                                            <option value="<?php echo $patients->id; ?>" selected="selected">
                                                                <?php echo $patients->name; ?> ( <?php echo lang('id'); ?>:
                                                                <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>:
                                                                <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>:
                                                                <?php echo $age[0]; ?> ) </option>
                                                        <?php  }
                                                    } else { ?>
                                                        <option value="" selected="selected"><?php echo lang('select'); ?>
                                                        </option>
                                                        <option value="<?php echo 'add_new'; ?>"><?php echo lang('add_new'); ?>
                                                        </option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                            <!-- Patient Information Fields (Simplified) -->
                                            <?php
                                            $patient_display_name = '';
                                            $patient_display_phone = '';
                                            $patient_display_age = '';
                                            $patient_display_sex = '';
                                            $patient_display_weight = '';
                                            $patient_display_address = '';

                                            if (!empty($payment) && !empty($patients)) {
                                                $patient_display_name = $patients->name;
                                                $patient_display_phone = $patients->phone;
                                                if (!empty($patients->age)) {
                                                    $age_parts = explode('-', $patients->age);
                                                    $patient_display_age = $age_parts[0];
                                                }
                                                $patient_display_sex = !empty($patients->sex) ? $patients->sex : (!empty($patients->patient_gender) ? $patients->patient_gender : '');
                                                $patient_display_weight = !empty($patients->weight) ? $patients->weight : '';
                                                $patient_display_address = !empty($patients->address) ? $patients->address : '';
                                            } elseif (!empty($draft)) {
                                                $patient_display_name = !empty($draft->patient_name) ? $draft->patient_name : '';
                                                $patient_display_phone = !empty($draft->patient_phone) ? $draft->patient_phone : '';
                                                if (!empty($draft->age)) {
                                                    $age_parts = explode('-', $draft->age);
                                                    $patient_display_age = $age_parts[0];
                                                }
                                                $patient_display_sex = !empty($draft->patient_gender) ? $draft->patient_gender : '';
                                                if (!empty($draft->patient) && $draft->patient != 'add_new') {
                                                    $dp = $this->patient_model->getPatientById($draft->patient);
                                                    if (!empty($dp)) {
                                                        $patient_display_weight = !empty($dp->weight) ? $dp->weight : '';
                                                        $patient_display_address = !empty($dp->address) ? $dp->address : '';
                                                    }
                                                }
                                            }
                                            $show_patient_card = (!empty($payment) || !empty($draft));
                                            ?>
                                            <div class="pos_client bg-light p-3 mb-3 rounded shadow-sm border" id="pos_client" style="<?php if (!$show_patient_card) { echo 'display: none;'; } ?>">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm shadow-sm" name="p_name" id="p_name" value="<?php echo html_escape($patient_display_name); ?>" placeholder="Enter patient's full name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('phone'); ?> <span class="text-danger">*</span></label>
                                                            <input type="tel" class="form-control form-control-sm shadow-sm" name="p_phone" id="p_phone" value="<?php echo html_escape($patient_display_phone); ?>" placeholder="01XXXXXXXXX">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('age'); ?></label>
                                                            <input type="number" min="0" max="150" class="form-control form-control-sm shadow-sm" name="p_age" id="p_age" value="<?php echo html_escape($patient_display_age); ?>" placeholder="Age">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('gender'); ?></label>
                                                            <select class="form-control form-control-sm shadow-sm" id="p_gender" name="p_gender">
                                                                <option value=""><?php echo lang('select_gender'); ?></option>
                                                                <option value="Male" <?php if ($patient_display_sex == 'Male') { echo 'selected'; } ?>><?php echo lang('male'); ?></option>
                                                                <option value="Female" <?php if ($patient_display_sex == 'Female') { echo 'selected'; } ?>><?php echo lang('female'); ?></option>
                                                                <option value="Other" <?php if ($patient_display_sex == 'Other') { echo 'selected'; } ?>><?php echo lang('other'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('weight'); ?> (kg)</label>
                                                            <input type="number" step="0.1" min="0" max="500" class="form-control form-control-sm shadow-sm" name="p_weight" id="p_weight" value="<?php echo html_escape($patient_display_weight); ?>" placeholder="kg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-uppercase font-weight-bold text-muted small"><?php echo lang('contact'); ?> <?php echo lang('address'); ?></label>
                                                            <input type="text" class="form-control form-control-sm shadow-sm" name="p_address" id="p_address" value="<?php echo html_escape($patient_display_address); ?>" placeholder="Contact Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pos_new_patient_actions mt-2 pt-2 border-top d-flex justify-content-between align-items-center" style="display: none;">
                                                    <span class="text-muted small"><i class="fas fa-user-plus mr-1 text-primary"></i> New Patient Details</span>
                                                    <button type="button" class="btn btn-sm btn-outline-success py-1 px-3" id="btn_save_patient_ajax">
                                                        <i class="fas fa-check mr-1"></i> Save Patient Now
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Doctor Selection -->
                                            <div class="form-group mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="text-uppercase font-weight-bold text-muted mb-0"><?php echo lang('doctor'); ?><span class="text-danger">*</span></label>
                                                    <?php if ($can_create_doctor) { ?>
                                                        <button type="button" class="btn btn-xs btn-outline-success font-weight-bold py-0 px-2" id="btn_open_doctor_modal" title="Add New Doctor">
                                                            <i class="fas fa-user-md mr-1"></i>+ <?php echo lang('add_new'); ?>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                                <select class="form-control shadow-sm add_doctor" id="add_doctor" name="doctor" value='' required>
                                                    <?php if (!empty($payment)) { ?>
                                                        <option value="<?php echo $doctors->id; ?>" selected="selected">
                                                            <?php echo $doctors->name; ?> - <?php echo $doctors->id; ?>
                                                        </option>
                                                        <?php } elseif (!empty($draft->doctor)) {
                                                        if ($draft->doctor == 'add_new') {
                                                        ?>
                                                            <option value="<?php echo 'add_new'; ?>" selected="selected">
                                                                <?php echo lang('add_new'); ?></option>
                                                        <?php    } else {
                                                            $doctor_name = $this->doctor_model->getDoctorById($draft->doctor)->name;
                                                        ?>
                                                            <option value="<?php echo $draft->doctor; ?>" selected="selected">
                                                                <?php echo $doctor_name . '(' . lang('id') . ': ' . $draft->id . ')'; ?>
                                                            </option>
                                                    <?php    }
                                                    } ?>
                                                </select>
                                            </div>

                                            <!-- Referrer Selection -->
                                            <div class="form-group mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="text-uppercase font-weight-bold text-muted mb-0"><?php echo lang('referrer'); ?> <span class="text-muted small">(<?php echo lang('optional'); ?>)</span></label>
                                                    <?php if ($can_create_referrer) { ?>
                                                        <button type="button" class="btn btn-xs btn-outline-info font-weight-bold py-0 px-2" id="btn_open_referrer_modal" title="Add New Referrer">
                                                            <i class="fas fa-hands-helping mr-1"></i>+ <?php echo lang('add_new'); ?>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                                <select class="form-control shadow-sm add_referrer js-example-basic-single" id="add_referrer" name="referrer">
                                                    <option value=""><?php echo lang('select'); ?> <?php echo lang('referrer'); ?></option>
                                                    <?php if ($can_create_referrer) { ?>
                                                        <option value="add_new">+ <?php echo lang('add_new'); ?> <?php echo lang('referrer'); ?></option>
                                                    <?php } ?>
                                                    <?php if (!empty($referrers)) {
                                                        foreach ($referrers as $ref) { ?>
                                                            <option value="<?php echo $ref->id; ?>" <?php
                                                                if (!empty($payment->referrer) && $payment->referrer == $ref->id) {
                                                                    echo 'selected="selected"';
                                                                } elseif (!empty($draft->referrer) && $draft->referrer == $ref->id) {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>>
                                                                <?php echo html_escape($ref->name); ?> (<?php echo html_escape($ref->type); ?> - <?php echo html_escape($ref->phone); ?>)
                                                            </option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <!-- Item Selection -->
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('item'); ?><span class="text-danger">*</span></label>
                                                <select name="category_name[]" class="form-control shadow-sm multi-select option_select" multiple="" id="my_multi_select3" required>
                                                    <?php
                                                    $current_group = null;
                                                    foreach ($categories as $category) {
                                                        $item_group = !empty($category->payment_category_name) ? $category->payment_category_name : 'General Tests';
                                                        if ($current_group !== $item_group) {
                                                            if ($current_group !== null) {
                                                                echo '</optgroup>';
                                                            }
                                                            $current_group = $item_group;
                                                            echo '<optgroup label="' . html_escape($current_group) . '">';
                                                        }
                                                    ?>
                                                        <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" data-d_commission="<?php echo isset($category->d_commission) ? floatval($category->d_commission) : 0; ?>" data-r_commission="<?php echo isset($category->r_commission) ? floatval($category->r_commission) : 0; ?>" value="<?php echo $category->id; ?>" <?php
                                                                                                                                                                                                                                                                    if (!empty($payment->category_name)) {
                                                                                                                                                                                                                                                                        $category_name = $payment->category_name;
                                                                                                                                                                                                                                                                        $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                        foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                            $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                            if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                    } elseif (!empty($draft->category_name)) {
                                                                                                                                                                                                                                                                        $category_name = $draft->category_name;
                                                                                                                                                                                                                                                                        $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                        foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                            $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                            if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                    ?> <?php
                                                            if (!empty($payment->category_name)) {
                                                                $category_name = $payment->category_name;
                                                                $category_name1 = explode(',', $category_name);
                                                                foreach ($category_name1 as $category_name2) {
                                                                    $category_name3 = explode('*', $category_name2);
                                                                    if ($category_name3[0] == $category->id) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                            } elseif (!empty($draft->category_name)) {
                                                                $category_name = $draft->category_name;
                                                                $category_name1 = explode(',', $category_name);
                                                                foreach ($category_name1 as $category_name2) {
                                                                    $category_name3 = explode('*', $category_name2);
                                                                    if ($category_name3[0] == $category->id) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                            }
                                                            ?>>
                                                            <?php echo $category->category . ' - ' . $settings->currency . '' . $category->c_price; ?>
                                                        </option>
                                                    <?php }
                                                    if ($current_group !== null) {
                                                        echo '</optgroup>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="mt-2">
                                                    <a target="_blank" href="finance/addPaymentCategoryView" class="text-primary">
                                                        <i class="fas fa-plus-circle mr-1"></i><?php echo lang('add_new') ?> <?php echo lang('item') ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm border-0 mb-2">
                            <div class="card-body p-2">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 qfloww">
                                                <label class="col-md-10 float-left remove1"><?php echo lang('items') ?></label>
                                                <label class="float-right col-md-2 remove"><?php echo lang('qty') ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm border-0 mb-2">
                            <div class="card-body p-2">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('sub_total'); ?></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                                                                                                                        if (!empty($payment->amount)) {
                                                                                                                                                            echo $payment->amount;
                                                                                                                                                        } elseif (!empty($draft->amount)) {
                                                                                                                                                            echo $draft->amount;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder=" " disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('discount'); ?> <?php
                                                                                                                                                if ($discount_type == 'percentage') {
                                                                                                                                                    echo ' (%)';
                                                                                                                                                }
                                                                                                                                                ?></label>
                                                </div>
                                                <div class="input-group m-bot15 col-sm-8">
                                                    <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="percent_discount" id="dis_id_percent" value='<?php
                                                                                                                                                                                                                    if (!empty($payment->percent_discount)) {
                                                                                                                                                                                                                        $percent_discount = explode('*', $payment->percent_discount);
                                                                                                                                                                                                                        echo $percent_discount[0];
                                                                                                                                                                                                                    } elseif (!empty($draft->percent_discount)) {
                                                                                                                                                                                                                        $percent_discount = explode('*', $draft->percent_discount);
                                                                                                                                                                                                                        echo $percent_discount[0];
                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                        echo $settings->discount_percent;
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>' placeholder="">
                                                    <span class="input-group-addon percent_amount">%</span>
                                                    <input type="number" class="form-control col-sm-8 pay_in percent_input" step="0.01" name="discount" id="dis_id" value='<?php
                                                                                                                                                                                            if (!empty($payment->discount)) {
                                                                                                                                                                                                $discount = explode('*', $payment->discount);
                                                                                                                                                                                                echo $discount[0];
                                                                                                                                                                                            } elseif (!empty($draft->discount)) {
                                                                                                                                                                                                $discount = explode('*', $draft->discount);
                                                                                                                                                                                                echo $discount[0];
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '0';
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>' placeholder="">
                                                    <span class="input-group-addon percent_amount"><?php echo $settings->currency; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment">
                                                <div class="d-flex">
                                                    <div class="payment_label col-sm-4">
                                                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('vat'); ?></label>
                                                    </div>
                                                    <div class="input-group col-sm-8">
                                                        <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="vat" id="vat" value='<?php
                                                                                                                                                                                                if (!empty($payment->vat_amount_percent)) {
                                                                                                                                                                                                    echo $payment->vat_amount_percent;
                                                                                                                                                                                                } elseif (!empty($draft->vat_amount_percent)) {
                                                                                                                                                                                                    echo $draft->vat_amount_percent;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo $settings->vat;
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>' placeholder="">
                                                        <span class="input-group-addon percent_amount">%</span>
                                                        <input type="number" class="form-control col-sm-8 pay_in percent_input" step="0.01" name="vat_amount" id="vat_amount" value='<?php
                                                                                                                                                                                                        if (!empty($payment->vat)) {
                                                                                                                                                                                                            echo $payment->vat;
                                                                                                                                                                                                        } elseif (!empty($draft->vat)) {
                                                                                                                                                                                                            echo $draft->vat;
                                                                                                                                                                                                        } else {
                                                                                                                                                                                                            echo '0';
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>' placeholder="">
                                                        <span class="input-group-addon percent_amount"><?php echo $settings->currency; ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('gross_total'); ?></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                                                                                                                    if (!empty($payment->gross_total)) {
                                                                                                                                                        echo $payment->gross_total;
                                                                                                                                                    } elseif (!empty($draft->gross_total)) {
                                                                                                                                                        echo $draft->gross_total;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder=" " disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('note'); ?> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="remarks" rows="2" cols="20">
                                                    <?php
                                                    if (!empty($payment->remarks)) {
                                                        echo $payment->remarks;
                                                    } elseif (!empty($draft->remarks)) {
                                                        echo $draft->remarks;
                                                    }
                                                    ?> </textarea>
                                                </div>

                                            </div>

                                            <div class="col-md-12 payment d-flex">

                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php
                                                                                                                if (empty($payment)) {
                                                                                                                    echo lang('deposited_amount');
                                                                                                                } else {
                                                                                                                    echo lang('deposit') . ' 1 <br>';
                                                                                                                    echo date('d/m/Y', $payment->date);
                                                                                                                };
                                                                                                                ?> </label>
                                                </div>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                                                                                                                                        if (!empty($payment->amount_received)) {
                                                                                                                                                                            echo $payment->amount_received;
                                                                                                                                                                        }
                                                                                                                                                                        ?>' placeholder=" " <?php
                                                                                                                                                                                            if (!empty($payment->deposit_type)) {
                                                                                                                                                                                                if ($payment->deposit_type == 'Card') {
                                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                                }
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-4">
                                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('due'); ?> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control pay_in" name="due" id="due" value='<?php

                                                                                                                                                if (!empty($payment)) {
                                                                                                                                                    $deposit = $this->finance_model->getDepositByInvoiceId($payment->id);
                                                                                                                                                    if (!empty($deposit)) {
                                                                                                                                                        foreach ($deposit as $depos) {
                                                                                                                                                            $deposits[] = $depos->deposited_amount;
                                                                                                                                                        }
                                                                                                                                                        $depos_amount = array_sum($deposits);
                                                                                                                                                    } else {
                                                                                                                                                        $depos_amount = 0;
                                                                                                                                                    }
                                                                                                                                                    echo $depos_amount;
                                                                                                                                                } elseif (!empty($draft->gross_total)) {
                                                                                                                                                    if (!empty($draft->amount_received)) {
                                                                                                                                                        echo ($draft->gross_total - $draft->amount_received);
                                                                                                                                                    } else {
                                                                                                                                                        echo $draft->gross_total;
                                                                                                                                                    }
                                                                                                                                                } else {
                                                                                                                                                    echo '0';
                                                                                                                                                }
                                                                                                                                                ?>' placeholder=" " disabled>
                                                </div>

                                            </div>

                                            <!-- Internal Commission Summary (Internal Hospital Accounting) -->
                                            <div class="col-md-12 my-2" id="internal_commission_card">
                                                <div class="card border-0 shadow-sm" style="background: #f8fafc; border-left: 4px solid #4f46e5 !important; border-radius: 6px;">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1 pb-1 border-bottom">
                                                            <span class="font-weight-bold text-dark small text-uppercase"><i class="fas fa-calculator text-primary mr-1"></i> <?php echo lang('internal_commission_summary'); ?></span>
                                                            <span class="badge badge-secondary" style="font-size: 0.65rem;"><?php echo lang('hospital_accounting'); ?></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small text-muted">
                                                            <span>Gross Amount:</span>
                                                            <span class="font-weight-bold text-dark" id="comm_gross_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small text-danger">
                                                            <span>Discount (-):</span>
                                                            <span class="font-weight-bold" id="comm_discount_display">-<?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small border-top font-weight-bold text-dark">
                                                            <span>Final Net Amount:</span>
                                                            <span id="comm_net_invoice_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small bg-white px-2 rounded border my-1 text-primary">
                                                            <span class="font-weight-bold"><i class="fas fa-bullseye mr-1"></i> Commission Base:</span>
                                                            <span class="font-weight-bold" id="comm_base_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small border-bottom text-info">
                                                            <span><?php echo lang('doctor_commission'); ?> (-):</span>
                                                            <span class="font-weight-bold" id="comm_doctor_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small border-bottom text-warning">
                                                            <span><?php echo lang('referral_commission'); ?> (-):</span>
                                                            <span class="font-weight-bold" id="comm_referral_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-1 small pt-2 font-weight-bold text-success">
                                                            <span><?php echo lang('net_hospital_revenue'); ?>:</span>
                                                            <span id="comm_net_display"><?php echo $settings->currency; ?>0.00</span>
                                                        </div>
                                                        <div class="text-muted mt-1" style="font-size: 0.68rem; font-style: italic;">
                                                            * Commissions calculated from Final Net Amount after discount.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if (empty($payment->id)) { ?>
                                                <div class="col-md-12 payment">
                                                    <div class="d-flex">
                                                        <div class="payment_label col-sm-4">
                                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('type'); ?></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                                    <!-- <option value="Insurance"> <?php echo lang('insurance'); ?> -->
                                                                    </option>
                                                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    $payment_gateway = $settings->payment_gateway;
                                                    ?>

                                                    <div class="my-3 <?php if (empty($payment) || empty($payment->deposit_type) || $payment->deposit_type != 'Insurance') { echo 'hidden'; } ?> insurance_div">
                                                        <div class="d-flex">
                                                            <div class="payment_label col-sm-4" style="">
                                                                <label class="text-uppercase font-weight-bold text-muted">
                                                                    <?php echo lang('insurance'); ?>
                                                                </label>
                                                            </div>
                                                            <div class="company_div">
                                                                <select class="form-control col-sm-8 m-bot15 js-example-basic-single" name="insurance_company" id="insurance_company" value=''>
                                                                    <option value="">Company name</option>
                                                                    <?php foreach ($insurance_companys as $insurance_company) { ?>
                                                                        <option value="<?php echo $insurance_company->id; ?>" <?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    if ($insurance_company->id == set_value('insurance_company')) {
                                                                                                                                        echo 'selected';
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                if (!empty($payment->insurance_company)) {
                                                                                                                                    if ($insurance_company->id == $payment->insurance_company) {
                                                                                                                                        echo 'selected';
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?>> <?php echo $insurance_company->name; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="">
                                                            <div class="payment_label col-sm-12" style="margin-top:10px;">
                                                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('insurance_details'); ?>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" name="insurance_details" rows="2" cols="20"><?php
                                                                                                                                                            if (!empty($payment->insurance_details)) {
                                                                                                                                                                echo $payment->insurance_details;
                                                                                                                                                            } elseif (!empty($draft->insurance_details)) {
                                                                                                                                                                echo $draft->insurance_details;
                                                                                                                                                            }
                                                                                                                                                            ?> 
                                                    </textarea>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="cardPayment" style="display: none;">

                                                        <hr>
                                                        <div class="col-md-12 payment pad_bot">
                                                            <label class="text-uppercase font-weight-bold text-muted"> <?php echo lang('accepted'); ?>
                                                                <?php echo lang('cards'); ?></label>
                                                            <div class="payment pad_bot">
                                                                <img src="uploads/card.png" width="100%">
                                                            </div>
                                                        </div>

                                                        <?php
                                                        if ($payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('card'); ?>
                                                                    <?php echo lang('type'); ?></label>
                                                                <select class="form-control col-sm-8 m-bot15" name="card_type" value=''>

                                                                    <option value="Mastercard">
                                                                        <?php echo lang('mastercard'); ?> </option>
                                                                    <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                                    <option value="American Express">
                                                                        <?php echo lang('american_express'); ?> </option>
                                                                </select>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-4">
                                                                    <?php echo lang(''); ?>
                                                                    <?php echo lang('name'); ?></label>
                                                                <input type="text" id="cardholder" class="form-control col-sm-8 pay_in" name="cardholder" value='' placeholder="">
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('card'); ?>
                                                                    <?php echo lang('number'); ?></label>
                                                                <input type="text" id="card" class="form-control col-sm-8 pay_in" name="card_number" value='' placeholder="">
                                                            </div>



                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('expire'); ?>
                                                                    <?php echo lang('date'); ?></label>
                                                                <input type="text" class="form-control col-sm-8 pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                                            </div>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('cvv'); ?>
                                                                </label>
                                                                <input type="text" class="form-control col-sm-8 pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                                            </div>

                                                    </div>

                                                <?php
                                                        }
                                                ?>

                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (!empty($payment)) {
                                                $deposits = $this->finance_model->getDepositByPaymentId($payment->id);
                                                $i = 1;
                                                foreach ($deposits as $deposit) {
                                                    if (empty($deposit->amount_received_id)) {
                                                        $i = $i + 1; ?>
                                                        <div class="col-md-12 payment">
                                                            <div class="payment_label">
                                                                <label class="col-sm-4 text-uppercase font-weight-bold text-muted"><?php echo lang('deposit'); ?>
                                                                    <?php
                                                                    echo $i . '<br>';
                                                                    echo date('d/m/Y', $deposit->date); ?>
                                                                </label>
                                                            </div>
                                                            <div class="">
                                                                <input type="text" class="form-control col-sm-8 pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>' <?php
                                                                                                                                                                                                                                            if ($deposit->deposit_type == 'Card') {
                                                                                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                                                                                            } ?>>
                                                                <input type="hidden" class="form-control col-sm-8 pay_in" name="deposit_edit_id[]" id="amount_received" value='<?php echo $deposit->id; ?>' placeholder=" ">
                                                            </div>

                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <input type="hidden" name="id" id="id_pay" value='<?php
                                                                                                if (!empty($payment->id)) {
                                                                                                    echo $payment->id;
                                                                                                }
                                                                                                ?>'>
                                            <input type="hidden" name="draft_id" id="draft_id" value='<?php
                                                                                                        if (!empty($draft->id)) {
                                                                                                            echo $draft->id;
                                                                                                        }
                                                                                                        ?>'>
                                            <div class="col-md-12">
                                                <div class="form-group cashsubmit">
                                                    <button type="submit" name="form_submit" value="save" id="submit1" class="btn btn-sm btn-primary btn-block float-left mb-1 mr-1">
                                                        <?php echo lang('save'); ?></button>
                                                </div>
                                                <div class="form-group cardsubmit d-none">
                                                    <button type="submit" name="form_submit" value="save" id="submit-btn" class="btn btn-sm btn-primary btn-block float-left mb-1 mr-1" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                                                                        ?>onClick="stripePay(event);" <?php
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                        ?>>
                                                        <?php echo lang('save'); ?></button>
                                                </div>


                                                <div class="form-group cashsubmit2">
                                                    <button type="submit" name="form_submit" value="saveandprint" id="submit2" class="btn btn-sm btn-block btn-info float-left mb-1 mr-1">
                                                        <?php echo lang('save_and_print'); ?></button>
                                                </div>
                                                <div class="form-group cardsubmit3 d-none">
                                                    <button type="submit" name="form_submit" value="saveandprint" id="submit-btn2" class="btn btn-sm btn-block btn-secondary float-left mb-1 mr-1" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                                                                                    ?>onClick="stripePay(event);" <?php
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                    ?>>
                                                        <?php echo lang('save_and_print'); ?></button>
                                                </div>
                                                <?php if (empty($payment)) { ?>
                                                    <div class="form-group">
                                                        <button type="submit" name="form_submit" value="save_as_draft" id="save_as_draft" class="btn btn-sm btn-block btn-warning float-left mb-1 mr-1">
                                                            <?php echo lang('save_as_draft'); ?></button>
                                                    </div>
                                                <?php   } ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </form>
                <?php if (!empty($draft->doctor)) {
                    if ($draft->doctor == 'add_new') {
                        $add_doctor = 'yes';
                    } else {
                        $add_doctor = 'no';
                    }
                } else {
                    $add_doctor = 'no';
                } ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Modals for Inline Master Data Creation -->
    <?php if ($can_create_patient) { $this->load->view('modal_add_patient'); } ?>
    <?php if ($can_create_doctor) { $this->load->view('modal_add_doctor'); } ?>
    <?php if ($can_create_referrer) { $this->load->view('modal_add_referrer'); } ?>

    <!-- /.content -->
</div>




<style>
    #my_multi_select3 {
        display: none;
    }
</style>




<!--sidebar end-->
<!--main content start-->

<!--main content end-->
<!--footer start-->
<?php if (!empty($gateway->publish)) {
    $gateway_stripe = $gateway->publish;
} else {
    $gateway_stripe = '';
} ?>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var discount_type = "<?php echo $discount_type; ?>";
</script>
<script type="text/javascript">
    var add_doctor = "<?php echo $add_doctor; ?>";
</script>
<script type="text/javascript">
    var currency = "<?php echo $settings->currency; ?>";
</script>
<script type="text/javascript">
    var publish = "<?php echo $gateway_stripe; ?>";
</script>
<script src="common/js/moment.min.js"></script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>
<script src="common/extranal/js/finance/add_payment_view.js"></script>
<!-- <link href="common/extranal/css/settings/settings.css" rel="stylesheet"> -->

<div class="content-wrapper bg-gradient-light">
    <!-- Content Header -->
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-cog fa-lg mr-3"></i>
                        <?php echo lang('settings'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('settings'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-white p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/update" method="post" enctype="multipart/form-data">

                                <!-- General Settings Card -->
                                <div class="card shadow-sm border-0 mb-5">
                                    <div class="card-header bg-info text-white py-3">
                                        <h3 class="card-title font-weight-bold mb-0">
                                            <i class="fas fa-wrench mr-2"></i>
                                            <?php echo lang('general_settings'); ?>
                                        </h3>
                                    </div>

                                    <div class="card-body bg-light p-4">
                                        <div class="row">
                                            <!-- System Name -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-building mr-2 text-muted"></i>
                                                        <?php echo lang('system_name'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="name"
                                                        value='<?php if (!empty($settings->system_vendor)) {
                                                                    echo $settings->system_vendor;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Title -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-heading mr-2 text-muted"></i>
                                                        <?php echo lang('title'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="title"
                                                        value='<?php if (!empty($settings->title)) {
                                                                    echo $settings->title;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-map-marker-alt mr-2 text-muted"></i>
                                                        <?php echo lang('address'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="address"
                                                        value='<?php if (!empty($settings->address)) {
                                                                    echo $settings->address;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Phone -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-phone mr-2 text-muted"></i>
                                                        <?php echo lang('phone'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="phone"
                                                        value='<?php if (!empty($settings->phone)) {
                                                                    echo $settings->phone;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Hospital Email -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-envelope mr-2 text-muted"></i>
                                                        <?php echo lang('hospital_email'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" class="form-control form-control-lg shadow-sm"
                                                        name="email"
                                                        value='<?php if (!empty($settings->email)) {
                                                                    echo $settings->email;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Currency -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-dollar-sign mr-2 text-muted"></i>
                                                        <?php echo lang('currency'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="currency"
                                                        value='<?php if (!empty($settings->currency)) {
                                                                    echo $settings->currency;
                                                                } ?>' required="">
                                                </div>
                                            </div>

                                            <!-- Footer Message -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-comment mr-2 text-muted"></i>
                                                        <?php echo lang('footer_message'); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                                        name="footer_message"
                                                        value='<?php if (!empty($settings->footer_message)) {
                                                                    echo $settings->footer_message;
                                                                } ?>' required="">
                                                </div>
                                            </div>
                                            <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>

                                            <?php } ?>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <!-- VAT -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-percent mr-2 text-muted"></i>
                                                            <?php echo lang('default'); ?> <?php echo lang('vat'); ?> (%)
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" min="0" max="100"
                                                            class="form-control form-control-lg shadow-sm"
                                                            name="vat"
                                                            value='<?php if (!empty($settings->vat)) {
                                                                        echo $settings->vat;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?>' required="">
                                                    </div>
                                                </div>

                                                <!-- Discount -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-tags mr-2 text-muted"></i>
                                                            <?php echo lang('default'); ?> <?php echo lang('discount'); ?> (%)
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" min="0" max="100"
                                                            class="form-control form-control-lg shadow-sm"
                                                            name="discount_percent"
                                                            value='<?php if (!empty($settings->discount_percent)) {
                                                                        echo $settings->discount_percent;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?>' required="">
                                                    </div>
                                                </div>

                                                <!-- Time Format -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-clock mr-2 text-muted"></i>
                                                            <?php echo lang('time_format'); ?>
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="time_format" class="form-control form-control-lg shadow-sm" required>
                                                            <option value="12" <?php if ($settings->time_format == '12') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('12_hours_am_pm'); ?></option>
                                                            <option value="24" <?php if ($settings->time_format == '24') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('24_hours'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Show Odontogram -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-tooth mr-2 text-muted"></i>
                                                            <?php echo lang('show_odontogram_in_history'); ?>
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="show_odontogram_in_history" class="form-control form-control-lg shadow-sm" required>
                                                            <option value="yes" <?php if ($settings->show_odontogram_in_history == 'yes') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('yes'); ?></option>
                                                            <option value="no" <?php if ($settings->show_odontogram_in_history == 'no') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('no'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-time mr-2 text-muted"></i>
                                                            <?php echo lang('timezone'); ?>
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="timezone" class="form-control form-control-lg shadow-sm" id="timezone" required>
                                                            <?php
                                                        foreach ($timezones as $key => $timezone) {
                                                        ?>
                                                            <option value="<?php echo $key ?>" <?php
                                                                                                if ($key == $settings->timezone) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                                ?>><?php echo $timezone; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                

                                                <!-- Footer Invoice Message -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-file-invoice mr-2 text-muted"></i>
                                                            <?php echo lang('footer_invoice_message'); ?>
                                                        </label>
                                                        <textarea name="footer_invoice_message"
                                                            class="form-control form-control-lg shadow-sm"
                                                            rows="3"><?php if (!empty($settings->footer_invoice_message)) {
                                                                            echo $settings->footer_invoice_message;
                                                                        } ?></textarea>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <!-- Logo Upload Section -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-image mr-2 text-muted"></i>
                                                        <?php echo lang('title') . ' ' . lang('logo'); ?>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="img_url_title" id="titleLogo">
                                                        <label class="custom-file-label" for="titleLogo"><?php echo lang('choose_file'); ?></label>
                                                    </div>
                                                    <?php if (!empty($settings->logo_title)) { ?>
                                                        <img src="<?php echo $settings->logo_title; ?>" class="img-thumbnail mt-2" style="height: 100px;">
                                                    <?php } ?>
                                                    <small class="form-text text-muted"><?php echo lang('recommended_size'); ?>: 200x100</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-uppercase font-weight-bold text-dark">
                                                        <i class="fas fa-image mr-2 text-muted"></i>
                                                        <?php echo $this->ion_auth->in_group(array('superadmin')) ? lang('website_logo') : lang('invoice_logo'); ?>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="img_url" id="websiteLogo">
                                                        <label class="custom-file-label" for="websiteLogo"><?php echo lang('choose_file'); ?></label>
                                                    </div>
                                                    <?php if (!empty($settings->logo)) { ?>
                                                        <img src="<?php echo $settings->logo; ?>" class="img-thumbnail mt-2" style="height: 100px;">
                                                    <?php } ?>
                                                    <small class="form-text text-muted"><?php echo lang('recommended_size'); ?>: 200x100</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>

                                    <!-- Cron Jobs Settings Card -->
                                    <div class="card shadow-sm border-0 mb-4">
                                        <div class="card-header bg-warning text-dark py-3">
                                            <h3 class="card-title font-weight-bold mb-0">
                                                <i class="fas fa-clock mr-2"></i>
                                                <?php echo lang('cron_jobs_settings'); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body bg-light p-4">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-terminal mr-2 text-muted"></i>
                                                            <?php echo lang('cron_job'); ?>
                                                        </label>
                                                        <?php
                                                        $base_url = base_url();
                                                        $base_url_explode = explode("//", $base_url);
                                                        ?>
                                                        <input type="text" class="form-control form-control-lg shadow-sm"
                                                            value='wget <?php echo $base_url_explode[1]; ?>cronjobs/appointmentRemainder -O /dev/null 2>&1' readonly>
                                                        <small class="form-text text-success">
                                                            <i class="fas fa-info-circle mr-1"></i>
                                                            <?php echo lang('please_paste_this_code_in_ccard_cronjob_add_command_field'); ?>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-uppercase font-weight-bold text-dark">
                                                            <i class="fas fa-bell mr-2 text-muted"></i>
                                                            <?php echo lang('remainder_before_appointment'); ?>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="number" min="1"
                                                                class="form-control form-control-lg shadow-sm"
                                                                name="remainder_appointment"
                                                                value='<?php if (!empty($settings->remainder_appointment)) {
                                                                            echo $settings->remainder_appointment;
                                                                        } ?>'>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><?php echo lang('hours'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <input type="hidden" name="id" value='<?php if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        } ?>'>

                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save mr-2"></i>
                                        <?php echo lang('submit'); ?>
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






<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/settings.js"></script>
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
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('invoice') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->


    <!-- /.content -->




    <?php if ($redirect == 'download') { ?>
        <!DOCTYPE html>
        <html lang="en" <?php if ($this->db->get('settings')->row()->language == 'arabic') { ?> dir="rtl" <?php } ?>>

        <head>
            <base href="<?php echo base_url(); ?>">
            <!--     <link href="common/css/bootstrap.min.css" rel="stylesheet"> 
     <link href="common/css/bootstrap-reset.css" rel="stylesheet"> -->

            <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
            <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
            <style>
                @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
            </style>
            <link href="common/assets/DataTables/datatables.css" rel="stylesheet" />

        </head>
    <?php } ?>
    <?php if ($redirect != 'download') { ?>
        <link href="common/extranal/css/finance/print_and_design_A4.css" rel="stylesheet" />
    <?php } else { ?>
        <style>
            .foot {
                right: 0;
                position: fixed;
                text-align: center;
                bottom: 0;
                margin-bottom: 10px !important;
            }

            .card {
                background: #fff !important;
                margin-top: -30px;
                height: 100%;
                border: 1px solid #000000;
                -webkit-print-color-adjust: exact;
                border-radius: 1px !important;
            }

            img {
                vertical-align: middle !important;
            }

            table {
                border: 1px solid #000000;
                width: 100%;
            }

            .information_table {
                border: none !important;

                width: 100% !important;
            }

            #invoice_word {
                padding-left: 19px !important;
            }

            .img_class_logo {
                margin-top: -10px;
                width: 120px;
                padding-left: 2px !important;
            }

            .title {
                font-weight: 900 !important;

            }

            h4 {
                margin-top: -10px !important;
                margin-left: 10px !important;
            }

            #first_td {
                width: 17% !important;
                padding-left: 40px !important;
            }

            .second_td {
                width: 34% !important;
            }

            .last_td {
                width: 49% !important;
            }

            .last_td_info {
                margin-bottom: 14px;
            }

            .image_bar {
                margin-top: 15px;
                width: 195px;
                height: 55px !important;
            }

            .col-md-6 {
                width: 49% !important;
                float: left !important;
            }

            .col-md-12 {
                width: 100% !important;
                float: left !important;

            }

            .information {
                height: 400px !important;
                border: 1px solid #000000;
            }

            .scroll {
                border: none !important;
            }

            .first_th {
                padding-left: 10px !important;
            }

            .amount_th {
                padding-left: 10px !important;
            }

            .second_th {
                padding-right: 10px !important;
            }

            .amount_in_word {
                padding-left: 7px;
                width: 28% !important;
            }

            .amount_instrong {
                font: 600 !important;
            }

            .amount_bottom {
                margin-bottom: 10px;
            }

            .font_amount {
                font-size: 10px;
            }

            .calculation_second {
                width: 22% !important;
            }

            .calculation_third {
                width: 43% !important;
            }

            .signature {
                margin-top: 10% !important;
                justify-content: space-between;
                flex-direction: column;
            }

            .table-striped th {
                border: 1px solid #eee !important;
                border-left: none !important;
                border-right: :none !important;
            }

            .table-striped .lang_payment {
                height: 20px !important;
            }

            .table-striped {
                border: 1px solid #000000 !important;
            }

            .description_info {
                background-color: #929292 !important;

            }

            .scroll th {
                height: 34px !important;
                padding-left: 0px !important;
            }

            .info_text1 {
                width: 57px;
            }

            .label_other {
                width: 133px;
                font-size: 12px;
            }

            .value_font {
                font-weight: 600;
            }

            .barcode_first_td {
                padding-left: 10px !important;
            }

            .info_rer {
                border: 1px solid #000000 !important;
            }

            .card {


                padding: 20px;
            }

            .image_text {
                margin-top: -20px !important;
            }
        </style>

    <?php } ?>

    <style>
        .site_height {
            min-height: 1500px;
        }

        @media print {
            .site_height {
                min-height: auto;
            }
        }
    </style>


    <?php if ($redirect != 'download') { ?>
        <section id="content">
            <div class="content-fluid">
                <div class="row">
                <?php }
            if ($redirect != 'download') { ?>
                    <section class="col-md-8">
                        <div class="card card-primary" id="invoice">
                            <div class="card-body invoice-all">
                            <?php } else { ?>
                                <section class="col-md-12">
                                <?php } ?>

                                <?php if ($redirect != 'download') { ?>
                                    <div id="invoice_header">
                                        <table class="info_rer">
                                            <tr class="tr_info">

                                                <td id="first_td" style="">
                                                    <img class="img_class_logo" alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="120">
                                                    <br>
                                                    <?php if ($redirect == 'download') { ?>
                                                        <div style="">
                                                        <?php } ?>
                                                        <strong id="invoice_word"><?php echo lang('invoice'); ?></strong><br>
                                                        <?php
                                                        $numlength = strlen((string)$payment->id);
                                                        $remaining = 10 - $numlength;
                                                        $invoice_id = '';
                                                        if ($remaining < 10) {
                                                            for ($i = 0; $i < $remaining; $i++) {
                                                                $invoice_id .= '0';
                                                            }
                                                            $invoice_id .= $payment->id;
                                                        } else {
                                                            $invoice_id = $payment->id;
                                                        }
                                                        ?>
                                                        <span class="invoice_id"><?php echo $invoice_id; ?></span>

                                                        <?php if ($redirect == 'download') { ?>
                                                        </div><?php } ?>
                                                </td>
                                                <td class="second_td">
                                                    <?php if ($redirect != 'download') { ?>
                                                        <div class="title_div">
                                                            <h4 class="title">
                                                                <?php echo $settings->title ?>
                                                            </h4>
                                                            <h6>
                                                                <?php echo $settings->address ?>
                                                            </h6>
                                                            <h4>
                                                                <?php echo lang("phone"); ?>: <?php echo $settings->phone ?>
                                                            </h4>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="paragraphprint col-md-12" style="padding-top:-20px;">
                                                            <p style="font-size:18px !important;margin-top: -20px; font-weight:800; ">
                                                            <h4>
                                                                <?php echo $settings->title ?>
                                                            </h4><br>
                                                            <h6 style="font-size:18px !important;margin-top: -20px; ">
                                                                <?php echo $settings->address ?>
                                                            </h6>
                                                            <h4>
                                                                <?php echo lang("phone"); ?>: <?php echo $settings->phone ?>
                                                            </h4>
                                                            </p>


                                                        </div>
                                                    <?php } ?>
                                                </td>


                                                <td class="last_td">
                                                    <?php if ($redirect != 'download') { ?>

                                                        <div class="paragraphprint col-md-12">
                                                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                                            <label class="control-label"> <?php echo lang('name'); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($patient_info)) {
                                                                    echo $patient_info->name . ' <br>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>

                                                        <div class="paragraphprint col-md-6 info_test">
                                                            <label class="control-label"><?php echo lang('age'); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($patient_info)) {
                                                                    $age = explode('-', $patient_info->age);
                                                                    echo $age[0] . ' ' . lang('y') . ' ' . $age[1] . ' ' . lang('m') . ' ' . $age[2] . ' ' . lang('d') . '<br>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div class="paragraphprint col-md-6 info_test">
                                                            <label class="control-label"><?php echo lang('gender'); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($patient_info)) {
                                                                    if ($patient_info->sex == 'Male') {
                                                                        echo lang('male');
                                                                    } else {
                                                                        echo lang('female');
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>

                                                        <div class="paragraphprint col-md-6 info_test">

                                                            <label class="control-label">HN </label>
                                                            <span class="info_text"> :
                                                                <?php

                                                                $numlength = strlen((string)$patient_info->id);
                                                                $remaining = 10 - $numlength;
                                                                $patient_info_id = '';
                                                                if ($remaining < 10) {
                                                                    for ($i = 0; $i < $remaining; $i++) {
                                                                        $patient_info_id .= '0';
                                                                    }
                                                                    $patient_info_id .= $patient_info->id;
                                                                } else {
                                                                    $patient_info_id = $patient_info->id;
                                                                }

                                                                if (!empty($patient_info)) {

                                                                    echo $patient_info_id . ' <br>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div class="paragraphprint col-md-6 info_test">
                                                            <label class="control-label"><?php echo lang("phone"); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($patient_info)) {
                                                                    echo $patient_info->phone;
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>



                                                        <div class="paragraphprint col-md-6 info_test">
                                                            <label class="control-label">VN </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($payment)) {
                                                                    echo $invoice_id;
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div class="paragraphprint col-md-6 info_test">
                                                            <label class="control-label">VN <?php echo lang("date"); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($payment)) {
                                                                    echo date('d/m/Y', $payment->date);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div class="paragraphprint col-md-12 last_td_info">
                                                            <label class="control-label"><?php echo lang("doctor"); ?> </label>
                                                            <span class="info_text"> :
                                                                <?php
                                                                if (!empty($payment->doctor)) {
                                                                    $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
                                                                    if (!empty($doc_details)) {
                                                                        echo $doc_details->name;
                                                                    } else {
                                                                        echo $payment->doctor_name . ' <br>';
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>

                                                    <?php } else { ?>
                                                        <table class="information_table">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="paragraphprint col-md-12">
                                                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                                                        <label class="control-label"> <?php echo lang('name'); ?> </label>
                                                                        <span class="info_text"> :
                                                                            <?php
                                                                            if (!empty($patient_info)) {
                                                                                echo $patient_info->name . ' <br>';
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>

                                                                    <label class="control-label"><?php echo lang('age'); ?> </label>
                                                                    <span class="info_text"> :
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            $age = explode('-', $patient_info->age);
                                                                            echo $age[0] . ' ' . lang('y') . ' ' . $age[1] . ' ' . lang('m') . ' ' . $age[2] . ' ' . lang('d') . '<br>';
                                                                        }
                                                                        ?>
                                                                    </span>

                                                                </td>
                                                                <td>

                                                                    <label class="control-label"><?php echo lang('gender'); ?> </label>
                                                                    <span class="info_text"> :
                                                                        <?php
                                                                        if (!empty($patient_info)) {
                                                                            if ($patient_info->sex == 'Male') {
                                                                                echo lang('male');
                                                                            } else {
                                                                                echo lang('female');
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="paragraphprint col-md-6 info_test">

                                                                        <label class="control-label">HN </label>
                                                                        <span class="info_text"> :
                                                                            <?php

                                                                            $numlength = strlen((string)$patient_info->id);
                                                                            $remaining = 10 - $numlength;
                                                                            $patient_info_id = '';
                                                                            if ($remaining < 10) {
                                                                                for ($i = 0; $i < $remaining; $i++) {
                                                                                    $patient_info_id .= '0';
                                                                                }
                                                                                $patient_info_id .= $patient_info->id;
                                                                            } else {
                                                                                $patient_info_id = $patient_info->id;
                                                                            }

                                                                            if (!empty($patient_info)) {

                                                                                echo $patient_info_id . ' <br>';
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>

                                                                </td>
                                                                <td>

                                                                    <div class="paragraphprint col-md-6 info_test">
                                                                        <label class="control-label"><?php echo lang("phone"); ?> </label>
                                                                        <span class="info_text"> :
                                                                            <?php
                                                                            if (!empty($patient_info)) {
                                                                                echo $patient_info->phone;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="paragraphprint col-md-6 info_test">
                                                                        <label class="control-label">VN </label>
                                                                        <span class="info_text"> :
                                                                            <?php
                                                                            if (!empty($payment)) {
                                                                                echo $invoice_id;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>

                                                                </td>
                                                                <td>

                                                                    <div class="paragraphprint col-md-6 info_test">
                                                                        <label class="control-label">VN <?php echo lang("date"); ?> </label>
                                                                        <span class="info_text"> :
                                                                            <?php
                                                                            if (!empty($payment)) {
                                                                                echo date('d/m/Y', $payment->date);
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="paragraphprint col-md-12 last_td_info">
                                                                        <label class="control-label"><?php echo lang("doctor"); ?> </label>
                                                                        <span class="info_text"> :
                                                                            <?php
                                                                            if (!empty($payment->doctor)) {
                                                                                $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
                                                                                if (!empty($doc_details)) {
                                                                                    echo $doc_details->name;
                                                                                } else {
                                                                                    echo $payment->doctor_name . ' <br>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                        </table>
                                        <table class="table_bar">
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
                                        </table>
                                    </div>
                                <?php } ?>
                                <?php if ($redirect == 'download') { ?>

                                    <body>
                                        <div class="information">
                                        <?php } ?>
                                        <table class="table_bar table_item scroll">
                                            <thead class="theadd">
                                                <tr class="description_info">

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
                                            <tbody id="info_all">
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
                                        <table class="table_bar" style="height:30px; border-buttom: 1px solid black!important">
                                            <style>
                                                .note {
                                                    margin-left: 50px !important;
                                                    font-size: 13px;
                                                    /* text-align: center; */
                                                }
                                            </style>
                                            <tr class="note">
                                                <td>&nbsp;</td>
                                                <td><?php echo lang('note'); ?> : <strong><?php echo $payment->remarks ?></strong></td>
                                            </tr>
                                        </table>
                                        <?php if ($redirect == 'download') { ?>
                                        </div>
                                    <?php } ?>
                                    <table class="table_bar">
                                        <tr>
                                            <td class="amount_in_word">
                                                <h5 class="font_amount amount_bottom"><strong class="amount_instrong"><?php echo lang('received_with_thanks'); ?> : (<?php echo $settings->currency; ?>)</strong><br>

                                                </h5>
                                                <h5 class="font_amount" style="margin-bottom: 55px;">
                                                    <?php echo AmountInWords($this->finance_model->getDepositAmountByPaymentId($payment->id)); ?>
                                                </h5>
                                                <div class="signature">

                                                    <strong>________________________<br>
                                                        <?php echo lang("cashier_signature"); ?></strong>
                                                </div>

                                            </td>
                                            <td class="calculation_second">
                                                <div class=" float-left">
                                                    <?php if ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                                                        <h4 style="font-weight: bold;border: 3px solid; border-radius: 5px; text-align: center; padding: 5px;"><?php echo lang("paid"); ?></h4>
                                                    <?php } else { ?>
                                                        <h4 style="font-weight: bold; border: 3px solid; border-radius: 5px; text-align: center; padding: 5px;"><?php echo lang('due_have'); ?></h4>
                                                    <?php } ?>
                                                    <!-- <u><?php echo lang('report_delivery_time'); ?></u><br> -->
                                                    <?php


                                                    ?>
                                                </div>
                                                <br>

                                            </td>
                                            <td class="calculation_third">
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other"><?php echo lang('gross_amount'); ?> </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php echo $settings->currency . ' ' . number_format($payment->amount, 2, ".", ""); ?>

                                                    </span>
                                                </div>
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other">(+)<?php echo lang('vat'); ?>(<?php echo   number_format($payment->vat_amount_percent, 2, ".", ""); ?>%) </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php echo $settings->currency ?> <?php
                                                                                                                if (!empty($payment->vat)) {
                                                                                                                    echo number_format($payment->vat, 2, ".", "");
                                                                                                                } else {
                                                                                                                    echo  $settings->currency . ' ' . '0.00';
                                                                                                                }
                                                                                                                ?>

                                                    </span>
                                                </div>
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other">(-)<?php echo lang('discount'); ?>(<?php echo  number_format($payment->percent_discount, 2, ".", ""); ?>%) </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php
                                                                                $discount = explode('*', $payment->discount);
                                                                                if (!empty($payment->discount)) {
                                                                                    echo  $settings->currency . ' ' . number_format($payment->discount, 2, ".", "");
                                                                                } else {
                                                                                    echo $settings->currency . ' ' . '0.00';
                                                                                }
                                                                                ?>

                                                    </span>
                                                </div>
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other"><?php echo lang('net_payable'); ?> </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php echo $settings->currency; ?> <?php echo $g = number_format($payment->gross_total, 2, ".", ""); ?>

                                                    </span>
                                                </div>
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other"><?php echo lang('amount_received'); ?> </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php echo $settings->currency; ?> <?php echo $r = number_format($this->finance_model->getDepositAmountByPaymentId($payment->id), 2, ".", ""); ?>

                                                    </span>
                                                </div>
                                                <div class="paragraphprint1 col-md-12">
                                                    <label class="label_other"><?php echo lang('balance_due'); ?> </label>
                                                    <label class="info_text1"> : </label>

                                                    <span class="value_font"> <?php echo $settings->currency; ?> <?php echo number_format($g - $r, 2, ".", ""); ?>

                                                    </span>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                    <?php $deposited_amount_payment = $this->finance_model->getDepositByInvoiceId($payment->id);
                                    if (count($deposited_amount_payment) > 1) {
                                    ?>
                                        <table class="table table table-striped">
                                            <tr>
                                                <td colspan="3" class="lang_payment" style="text-align: center;
                                            font-weight: 600;"><?php echo lang('payment_history'); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>

                                                <th><?php echo lang('amount'); ?></th>
                                                <th><?php echo lang('payment_method'); ?></th>
                                            </tr>
                                            <?php foreach ($deposited_amount_payment as $deposited) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo date('d-m-y', $deposited->date); ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $settings->currency . ' ' . $deposited->deposited_amount; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($deposited->deposit_type == 'Cash') {
                                                            echo 'Cash';
                                                        } else {
                                                            echo $deposited->gateway;
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>

                                    <?php } ?>
                                    <?php if ($redirect == 'download') { ?>
                                        <!--                            <footer class="col-md-12 invoice_footer ff">

                                <?php //echo $settings->footer_invoice_message; 
                                ?>


                            </footer>-->
                                    </body>
                                <?php } ?>




                                <?php if ($redirect != 'download') { ?>
                            </div>




                        </div>
                        <div class="col-md-12 invoice_footer ff">

                            <?php echo $settings->footer_invoice_message; ?>


                        </div>
                    <?php } ?>


                    </section>
                    <?php if ($redirect != 'download') { ?>
                        <section class="col-md-4 no-print">
                            <div class="col-md-7">

                                <?php
                                if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                                ?>
                                    <a href="finance/addPaymentView" class="float-left">
                                        <div class="btn-group">
                                            <button id="" class="btn btn-success btn-sm mb-1">
                                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_another_payment'); ?>
                                            </button>
                                        </div>
                                    </a>
                                <?php } ?>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <!-- <a href="finance/sendInvoice?id=<?php echo $payment->id; ?>" class="btn  btn-sm float-left send"> <i class="fa fa-paper-plane"></i> <?php echo lang('send_invoice'); ?> </a> -->
                                <?php } ?>


                                <div class="text-center col-md-12 row">
                                    <a class="btn btn-secondary btn-sm invoice_button float-left mb-1" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                                    <a href="finance/download?id=<?php echo $payment->id; ?>" class="btn btn-warning btn-sm float-left download mb-1"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
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
                                                <a href="finance/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-info btn-sm editbutton float-left mb-1"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('invoice'); ?> </a>
                                        <?php }
                                        } ?>

                                    <?php } ?>


                                </div>

                                <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) { ?>
                                    <a href="finance/payment" class="btn btn-info btn-sm btn-secondary float-left mb-1"><i class="fa fa-arrow-circle-left"></i> <?php echo lang('back_to_payment_modules'); ?> </a>
                                <?php } ?>




                                <div class="card_button">

                                    <div class="text-center invoice-btn no-print float-left ">
                                        <a href="finance/previousInvoice?id=<?php echo $payment->id ?>" class="btn btn-info btn-sm btn-warning previousone1 mb-1"><i class="fa fa-arrow-left"></i> </a>
                                        <a href="finance/nextInvoice?id=<?php echo $payment->id ?>" class="btn btn-info btn-sm btn-success nextone1 mb-1"><i class="fa fa-arrow-right"></i> </a>

                                    </div>

                                </div>

                            </div>
                            <div class="col-md-7" style="margin-top: 20%;">
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
                            </div>

                        </section>
                    <?php } ?>

                    <?php if ($redirect == 'download') { ?>
                        <footer class="col-md-12 invoice_footer">

                            <?php echo $settings->footer_invoice_message; ?>


                        </footer>


                    <?php }
                    if ($redirect != 'download') { ?>

                </div>
            </div>
        </section>

        </html>

    <?php }

                    function AmountInWords(float $amount)
                    {
                        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
                        // Check if there is any number after decimal
                        $amt_hundred = null;
                        $count_length = strlen($num);
                        $x = 0;
                        $string = array();
                        $change_words = array(
                            0 => 'Zero',
                            1 => 'One',
                            2 => 'Two',
                            3 => 'Three',
                            4 => 'Four',
                            5 => 'Five',
                            6 => 'Six',
                            7 => 'Seven',
                            8 => 'Eight',
                            9 => 'Nine',
                            10 => 'Ten',
                            11 => 'Eleven',
                            12 => 'Twelve',
                            13 => 'Thirteen',
                            14 => 'Fourteen',
                            15 => 'Fifteen',
                            16 => 'Sixteen',
                            17 => 'Seventeen',
                            18 => 'Eighteen',
                            19 => 'Nineteen',
                            20 => 'Twenty',
                            30 => 'Thirty',
                            40 => 'Forty',
                            50 => 'Fifty',
                            60 => 'Sixty',
                            70 => 'Seventy',
                            80 => 'Eighty',
                            90 => 'Ninety'
                        );
                        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                        while ($x < $count_length) {
                            $get_divider = ($x == 2) ? 10 : 100;
                            $amount = floor($num % $get_divider);
                            $num = floor($num / $get_divider);
                            $x += $get_divider == 10 ? 1 : 2;
                            if ($amount) {
                                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
                ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
                ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
                            } else $string[] = null;
                        }
                        $implode_to_Rupees = implode('', array_reverse($string));
                        $get_paise = ($amount_after_decimal > 0) ? "Point " . ($change_words[$amount_after_decimal / 10] . " 
            " . $change_words[$amount_after_decimal % 10]) . ' ' : '';
                        return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
                    }

                    function number_to_words($number)
                    {
                        $ones = array(
                            0 => "zero",
                            1 => "one",
                            2 => "two",
                            3 => "three",
                            4 => "four",
                            5 => "five",
                            6 => "six",
                            7 => "seven",
                            8 => "eight",
                            9 => "nine"
                        );
                        $tens = array(
                            10 => "ten",
                            11 => "eleven",
                            12 => "twelve",
                            13 => "thirteen",
                            14 => "fourteen",
                            15 => "fifteen",
                            16 => "sixteen",
                            17 => "seventeen",
                            18 => "eighteen",
                            19 => "nineteen",
                            20 => "twenty",
                            30 => "thirty",
                            40 => "forty",
                            50 => "fifty",
                            60 => "sixty",
                            70 => "seventy",
                            80 => "eighty",
                            90 => "ninety"
                        );

                        if ($number < 10) {
                            return $ones[$number];
                        } elseif ($number < 20) {
                            return $tens[$number];
                        } elseif ($number < 100) {
                            $tens_place = floor($number / 10) * 10;
                            $ones_place = $number % 10;
                            return $tens[$tens_place] . ($ones_place ? "-" . $ones[$ones_place] : "");
                        } elseif ($number < 1000) {
                            $hundreds_place = floor($number / 100);
                            $remainder = $number % 100;
                            return $ones[$hundreds_place] . " hundred" . ($remainder ? " and " . number_to_words($remainder) : "");
                        } else {
                            $thousands_place = floor($number / 1000);
                            $remainder = $number % 1000;
                            return $ones[$thousands_place] . " thousand" . ($remainder ? " " . number_to_words($remainder) : "");
                        }
                    }


    ?>












</div>













<link href="common/extranal/css/finance/print.css" rel="stylesheet" />
<?php if ($redirectlink == 'print') { ?>
    <script src="common/extranal/js/finance/printInvoice.js"></script>
<?php } ?>

<script src="common/extranal/js/finance/invoice.js"></script>
<script src="common/js/codearistos.min.js"></script>
<?php if ($redirectlink != 'download') { ?>
    <script>
        $(document).ready(function() {

            var prevRowHeight = 0;
            $("tr").each(function() {
                // console.log(prevRowHeight);
                var maxHeight = 920;
                var eachRowHeight = $(this).height();
                if ((prevRowHeight + eachRowHeight) > maxHeight) {
                    prevRowHeight = 0;
                    $(this).before('<div class="page_breaker"></div>');
                    // console.log("add page break before");
                }
                prevRowHeight = prevRowHeight + $(this).height();
            });

        });
    </script>

<?php } ?>
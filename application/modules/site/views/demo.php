<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url(); ?>">
<?php
$settings = $this->site_model->getSettingsBySiteId($this->session->userdata('site_id'));
$title = explode(' ', $settings->title);

$this->db->where('hospital_id', $this->session->userdata('site_id'));
$site_name = $this->db->get('site_settings')->row()->title;
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../../favicon.ico" />
    <title><?php echo $site_name; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- jQuery Plugins -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/magnific-popup/magnific-popup.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>">

    <link rel="stylesheet" href="<?php echo site_url('front/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/css/rs-style.css'); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen">
    <!-- CSS Stylesheet -->
    <link href="<?php echo site_url('front/site_assets/css/style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo site_url('front/site_assets/css/responsive.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link href="common/extranal/css/site/site.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">

    <!-- Flag Icons -->
    <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">

    <style>
        /* Add your custom styles here */
        #header_menu_top {
            background: linear-gradient(to right, #343a40, #212529);
            color: #fff;
            padding: 10px 0;
        }

        .topbar-texts {
            margin-bottom: 0;
            font-size: 14px;
        }

        .topbar-texts span {
            color: #ffc107;
            font-weight: bold;
        }

        .topbar-texts i {
            margin-right: 5px;
        }

        .topbar-link {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }

        .topbar-link:hover {
            text-decoration: underline;
        }

        .language-selector {
            margin-top: -20px;
        }
    </style>
</head>

<body>


    <!---------------- Start Main Navbar ---------------->


    <?php
    if ($this->language == 'arabic') {
        $flagIcon = 'sa';
    }
    if ($this->language == 'english') {
        $flagIcon = 'us';
    }
    if ($this->language == 'spanish') {
        $flagIcon = 'es';
    }
    if ($this->language == 'french') {
        $flagIcon = 'fr';
    }
    if ($this->language == 'italian') {
        $flagIcon = 'it';
    }
    if ($this->language == 'portuguese') {
        $flagIcon = 'pt';
    }
    if ($this->language == 'turkish') {
        $flagIcon = 'tr';
    }
    ?>

    <!-- Top Bar -->
    <!-- <div id="header_menu_top" class="bg-primary py-3">
        <div class="container-lg">
            <div class="row g-3">
                <div class="col-lg-8 col-md-12">
                    <div class="d-flex flex-wrap gap-4 text-white">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-home me-2 fs-5" aria-hidden="true"></i>
                            <p class="mb-0">
                                <?php echo $settings->address; ?>
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-phone me-2 fs-5" aria-hidden="true"></i>
                            <p class="mb-0">
                                <?php echo $settings->phone; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="d-flex align-items-center justify-content-lg-end gap-3">
                        <div class="dropdown">
                            <a class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="flag-icon flag-icon-<?php echo $flagIcon; ?> me-2"></i>
                                <span class="text-capitalize"><?php echo $this->language; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <?php
                                $languages = $this->db->get('language')->result();
                                foreach ($languages as $language) {
                                ?>
                                    <li>
                                        <a href="frontend/chooseLanguageForSite?lang=<?php echo $language->language; ?>"
                                            class="dropdown-item <?php if ($this->language ==  $language->language) echo 'active'; ?>">
                                            <i class="flag-icon flag-icon-<?php echo $language->flag_icon; ?> me-2"></i>
                                            <?php echo $language->language; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <a href="<?php echo site_url('auth/login') ?>" target="_blank"
                            class="btn btn-outline-light btn-sm d-flex align-items-center">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <?php echo lang('sign_in'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Main Header -->
    <div id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-4">
            <div class="container-lg">
                <a class="navbar-brand" href="site/<?php echo $this->session->userdata('site_name'); ?>#">
                    <?php
                    if (!empty($settings->logo)) {
                        if (file_exists($settings->logo)) {
                            echo '<img width="250" src=' . $settings->logo . ' alt="Logo" class="img-fluid">';
                        } else {
                            echo '<span class="h3 fw-bold mb-0">' . $title[0] . '<span class="text-primary"> ' . $title[1] . '</span></span>';
                        }
                    } else {
                        echo '<span class="h3 fw-bold mb-0">' . $title[0] . '<span class="text-primary"> ' . $title[1] . '</span></span>';
                    }
                    ?>
                </a>
                <button class="navbar-toggler border-0 p-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item mx-2">
                            <a class="nav-link fw-semibold fs-6 text-secondary hover-primary transition-all" href="site/<?php echo $this->session->userdata('site_name'); ?>#">
                                <?php echo lang('home'); ?>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link fw-semibold fs-6 text-secondary hover-primary transition-all" href="site/<?php echo $this->session->userdata('site_name'); ?>#featured_services">
                                <?php echo lang('services'); ?>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link fw-semibold fs-6 text-secondary hover-primary transition-all" href="site/<?php echo $this->session->userdata('site_name'); ?>#doctor">
                                <?php echo lang('doctors'); ?>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link fw-semibold fs-6 text-secondary hover-primary transition-all" href="site/<?php echo $this->session->userdata('site_name'); ?>#portfolio">
                                <?php echo lang('portfolio'); ?>
                            </a>
                        </li>
                        <li class="nav-item ms-3">
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary px-4 py-2 rounded-pill appointment-btn shadow-sm hover-scale fs-6 d-inline-flex align-items-center">
                                <i class="fas fa-calendar-check me-2"></i>
                                <?php echo lang('book_an_appointment'); ?>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="py-3"></div>



        <!-- Hero Slider -->
        <div class="owl-carousel headerSlider">
            <?php foreach ($slides as $slide) { ?>
                <div class="position-relative overflow-hidden">
                    <div class="container-lg py-md-6 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="text-start">
                                    <h1 class="display-1 fw-bold text-dark mb-4 lh-sm" style="font-size: 7rem; line-height: 110px !important; text-transform: uppercase;">
                                        <?php echo $slide->text1; ?>
                                    </h1>
                                    <h3 class="display-6 fw-light text-dark/10 mb-4 lh-sm animate__animated animate__fadeInUp animate__delay-1s pt-5">
                                        <?php echo $slide->text2; ?>
                                    </h3>

                                    <div class="">
                                        <a href="site#why_choose_us" class="btn btn-primary py-3 rounded-pill fs-5 shadow-lg hover:shadow-primary/50 transition-all">
                                            <i class="fas fa-calendar-check me-2"></i>
                                            <?php echo lang('get_started_now'); ?>
                                        </a>
                                        <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary py-3 rounded-pill fs-5 shadow-lg hover:shadow-primary/50 transition-all ms-3">
                                            <i class="fas fa-calendar-check me-2"></i>
                                            <?php echo lang('book_an_appointment'); ?>
                                        </button>
                                    </div>
                                    <!-- <p class="">
                                        <?php echo $slide->text3; ?>
                                    </p> -->
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative pl-5">
                                    <img src="<?php echo site_url($slide->img_url); ?>" alt="Slide" class="img-fluid rounded-4 shadow-lg p-2" style="height: 600px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="py-5"></div>


    <div class="bg-primary py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <i class="fas fa-user-md fa-3x"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Expert Doctors</h3>
                        <p class="mb-0 opacity-75">
                            Our team of highly qualified medical professionals provides exceptional care with years of experience.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <i class="fas fa-clock fa-3x"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">24/7 Support</h3>
                        <p class="mb-0 opacity-75">
                            Round-the-clock medical assistance and support available whenever you need it.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <i class="fas fa-hospital fa-3x"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Modern Facilities</h3>
                        <p class="mb-0 opacity-75">
                            State-of-the-art medical facilities and equipment for the best possible care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div id="why_choose_us" class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                    ?>
                        <div class="flashmessage col-md-12 feedback_class alert alert-info"> <?php echo $message; ?></div>
                    <?php } ?>
                </div>

                <div class="col-md-6 d-flex align-items-center mb-5 mb-lg-0">
                    <div class="appointment-content pe-lg-5">
                        <div class="mb-5">
                            <span class="text-primary text-uppercase fw-bold mb-3 d-block letter-spacing-3"><?php echo $settings->appointment_subtitle; ?></span>
                            <h2 class="display-3 fw-bold text-dark mb-4 lh-1"><?php echo $settings->appointment_title; ?></h2>
                            <p class="lead text-muted mb-0 lh-lg fs-4">
                                <?php echo $settings->appointment_description; ?>
                            </p>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg px-5 py-3 rounded-pill appointment-btn shadow-lg hover-scale fs-5">
                            <i class="fas fa-calendar-check me-2"></i>
                            <?php echo lang('book_an_appointment'); ?>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-gradient-primary text-white py-4">
                                        <h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">
                                            <i class="fas fa-calendar-plus me-2"></i>
                                            <?php echo lang('book_an_appointment'); ?>
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white modal_close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body p-5">
                                        <form action="<?php echo site_url('site/addNew'); ?>" method="post" class="appointment-form">
                                            <div class="row g-4">
                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"> <?php echo lang('patient'); ?></label>
                                                    <select class="form-select form-select-lg js-example-basic-single pos_select shadow-sm" id="pos_select" name="patient">
                                                        <option value=" "><?php echo lang('select'); ?></option>
                                                        <option class="patient_add" value="patient_id"><?php echo lang('patient_id'); ?></option>
                                                        <option class="patient_add_new" value="add_new"><?php echo lang('add_new'); ?></option>
                                                    </select>
                                                </div>

                                                <div class="pos_client_id clearfix d-none">
                                                    <div class="col-md-12">
                                                        <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg shadow-sm" name="patient_id" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="pos_client clearfix">
                                                    <div class="col-md-12">
                                                        <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                        <input type="text" class="form-control form-control-lg shadow-sm" name="p_name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                                        <input type="email" class="form-control form-control-lg shadow-sm" name="p_email">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                                        <input type="text" class="form-control form-control-lg shadow-sm" name="p_phone">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                                        <select class="form-select form-select-lg shadow-sm" name="p_gender">
                                                            <option value="Male" <?php
                                                                                    if (!empty($patient->sex)) {
                                                                                        if ($patient->sex == 'Male') {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>><?php echo lang('male'); ?></option>
                                                            <option value="Female" <?php
                                                                                    if (!empty($patient->sex)) {
                                                                                        if ($patient->sex == 'Female') {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>><?php echo lang('female'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="doctor_div col-md-12">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('doctor'); ?></label>
                                                    <select class="form-select form-select-lg shadow-sm" name="doctor" id="adoctors">
                                                        <option value=""><?php echo lang('select'); ?></option>
                                                        <?php foreach ($doctors as $doctor) { ?>
                                                            <option value="<?php echo $doctor->id; ?>" <?php
                                                                                                        if (!empty($payment->doctor)) {
                                                                                                            if ($payment->doctor == $doctor->id) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>><?php echo $doctor->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('date'); ?></label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" readonly="" id="date" name="date" value=''>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('available_slots'); ?></label>
                                                    <select class="form-select form-select-lg shadow-sm" name="time_slot" id="aslots">
                                                    </select>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                                                    <select class="form-select form-select-lg shadow-sm" name="visit_description" id="visit_description"></select>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('remarks'); ?></label>
                                                    <input type="text" class="form-control form-control-lg shadow-sm" name="remarks">
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                                                    <input type="number" class="form-control form-control-lg shadow-sm" name="visit_charges" id="visit_charges" readonly="">
                                                </div>

                                                <input type="hidden" name="discount" value='0'>
                                                <input type="hidden" name="grand_total" value='0'>
                                                <input type="hidden" name="redirectlink" value='site'>
                                                <input type="hidden" name="request" value=''>

                                                <div class="col-md-12 mt-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                                        <label class="form-check-label fw-bold text-dark h5"><?php echo lang('pay_now'); ?></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <?php
                                                    $payment_gateway = $settings1->payment_gateway;
                                                    ?>

                                                    <div class="card1 payment-section border rounded-4 p-4 mb-4 bg-light <?php echo ($payment_gateway == 'PayPal' || $payment_gateway == '2Checkout') ? '' : 'd-none'; ?>">
                                                        <h4 class="fw-bold mb-4 text-dark"><?php echo lang('payment_details'); ?></h4>

                                                        <?php if ($payment_gateway == 'PayPal') { ?>
                                                            <div class="mb-4">
                                                                <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                                                <select class="form-select form-select-lg shadow-sm" name="card_type">
                                                                    <option value="Mastercard"><?php echo lang('mastercard'); ?></option>
                                                                    <option value="Visa"><?php echo lang('visa'); ?></option>
                                                                    <option value="American Express"><?php echo lang('american_express'); ?></option>
                                                                </select>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') { ?>
                                                            <div class="mb-4">
                                                                <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                                                <input type="text" id="cardholder" class="form-control form-control-lg shadow-sm" name="cardholder">
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="mb-4">
                                                                <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                                                <input type="text" id="card" class="form-control form-control-lg shadow-sm" name="card_number">
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                                                    <input type="text" class="form-control form-control-lg shadow-sm" id="expire" data-date="" data-date-format="MM YY" placeholder="MM/YY" name="expire_date" maxlength="7">
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <label class="form-label fw-bold text-dark h5 mb-3"><?php echo lang('cvv'); ?></label>
                                                                    <input type="text" class="form-control form-control-lg shadow-sm" id="cvv" maxlength="3" name="cvv">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                                <div class="col-md-12">
                                                    <button type="submit" name="pay_now" id="submit-btn" class="btn btn-primary btn-lg w-100 rounded-pill shadow-lg hover-scale fs-4 py-3"
                                                        <?php if ($settings1->payment_gateway == 'Stripe') { ?>
                                                        onClick="stripePay(event);"
                                                        <?php } ?>
                                                        <?php if ($settings1->payment_gateway == '2Checkout' && $twocheckout->status == 'live') { ?>
                                                        onClick="twoCheckoutPay(event);"
                                                        <?php } ?>>
                                                        <?php echo lang('submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="appointment-image rounded-4 shadow-xl overflow-hidden">
                        <img src="<?php echo $settings->appointment_img_url; ?>" class="img-fluid w-100 h-100 object-fit-cover hover-scale transition" alt="Doctor" style="min-height: 600px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div id="featured" class="py-5 bg-gradient-light">
        <?php
        $gridCount = 0;
        foreach ($gridsections as $gridsection) {
            $gridCount++;
            $remainder = $gridCount % 2;
            if ($remainder == 0) {
        ?>
                <div class="featured-section bg-white py-5">
                    <div class="container">
                        <div class="row align-items-center py-5">
                            <div class="col-lg-6 pe-lg-8">
                                <div class="featured-content">
                                    <span class="text-primary text-uppercase fw-semibold tracking-wide mb-3 d-block animate-in">
                                        <?php echo $gridsection->category; ?>
                                    </span>
                                    <h2 class="display-4 fw-bold text-dark mb-4 animate-in">
                                        <?php echo $gridsection->title; ?>
                                    </h2>
                                    <p class="lead text-muted mb-5 lh-lg animate-in">
                                        <?php echo $gridsection->description; ?>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm hover-lift d-inline-flex align-items-center animate-in">
                                        Learn More
                                        <i class="fas fa-arrow-right ms-2 transition"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="featured-image animate-in">
                                    <img src="<?php echo $gridsection->img; ?>" class="img-fluid rounded-5 shadow-lg hover-lift-sm transition" alt="<?php echo $gridsection->title; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="featured-section bg-soft-blue py-5">
                    <div class="container">
                        <div class="row align-items-center py-5">
                            <div class="col-lg-6">
                                <div class="featured-image animate-in">
                                    <img src="<?php echo $gridsection->img; ?>" class="img-fluid rounded-5 shadow-lg hover-lift-sm transition" alt="<?php echo $gridsection->title; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 ps-lg-8">
                                <div class="featured-content">
                                    <span class="text-primary text-uppercase fw-semibold tracking-wide mb-3 d-block animate-in">
                                        <?php echo $gridsection->category; ?>
                                    </span>
                                    <h2 class="display-4 fw-bold text-dark mb-4 animate-in">
                                        <?php echo $gridsection->title; ?>
                                    </h2>
                                    <p class="lead text-muted mb-5 lh-lg animate-in">
                                        <?php echo $gridsection->description; ?>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm hover-lift d-inline-flex align-items-center animate-in">
                                        Learn More
                                        <i class="fas fa-arrow-right ms-2 transition"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="py-5"></div>

    <div id="featured_services" class="py-5 bg-gradient-light">
        <div class="container">
            <!-- Section Header -->
            <div class="row justify-content-center mb-8">
                <div class="col-lg-8">
                    <div class="text-center">
                        <span class="text-primary fw-semibold letter-spacing-lg text-uppercase mb-3 d-block animate-in">
                            <?php echo lang('OUR_SERVICES'); ?>
                        </span>

                        <h2 class="display-3 fw-bold text-dark mb-4 animate-in">
                            Comprehensive Healthcare Solutions
                        </h2>

                        <p class="lead text-muted mb-0 mx-auto animate-in" style="max-width: 800px; line-height: 1.8;">
                            <?php echo $settings->service_block__text_under_title; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="row g-5 justify-content-center">
                <?php foreach ($services as $service) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card h-100 p-6 bg-white rounded-5 shadow-sm hover-lift-sm transition position-relative overflow-hidden animate-in">
                            <!-- Service Icon -->
                            <div class="mb-4">
                                <div class="icon-wrapper d-inline-flex p-4 rounded-circle bg-soft-primary">
                                    <img src="<?php echo $service->img_url; ?>"
                                        class="img-fluid"
                                        alt="<?php echo $service->title; ?>"
                                        style="height: 48px; width: 48px; object-fit: contain;" />
                                </div>
                            </div>

                            <!-- Service Content -->
                            <h3 class="h4 fw-bold text-dark mb-3">
                                <?php echo $service->title; ?>
                            </h3>

                            <p class="text-muted mb-4 lh-lg">
                                <?php echo $service->description; ?>
                            </p>

                            <a href="#" class="text-primary fw-semibold text-decoration-none d-inline-flex align-items-center hover-lift">
                                Learn More
                                <i class="fas fa-arrow-right ms-2 small transition"></i>
                            </a>

                            <!-- Background Decoration -->
                            <div class="position-absolute end-0 bottom-0 opacity-10">
                                <svg width="140" height="140" viewBox="0 0 140 140" fill="none">
                                    <circle cx="140" cy="140" r="100" fill="currentColor" class="text-primary" />
                                </svg>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div id="doctor" class="py-5 bg-soft-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-7 text-center">
                    <span class="text-primary text-uppercase fw-semibold mb-3 d-block letter-spacing-sm animate-in">
                        <i class="fas fa-user-md me-2"></i>Medical Experts
                    </span>
                    <h2 class="display-4 fw-bold text-dark mb-4 animate-in"><?php echo lang('featured_doctors'); ?></h2>
                    <p class="lead text-muted mb-0 mx-auto animate-in" style="max-width: 600px;"><?php echo $settings->doctor_block__text_under_title; ?></p>
                </div>
            </div>
            <div class="row g-5 justify-content-center">
                <?php
                $count = count($featureds);
                $i = 1;
                foreach ($featureds as $featured) {
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100 rounded-5 hover-lift-sm transition overflow-hidden animate-in">
                            <div class="position-relative">
                                <img src="<?php echo $featured->img_url; ?>"
                                    class="card-img-top transition"
                                    alt="<?php echo $featured->name; ?>"
                                    style="height: 360px; object-fit: cover;" />
                                <div class="position-absolute bottom-0 start-0 w-100 bg-gradient-dark p-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="text-white mb-1 fw-bold"><?php echo $featured->name; ?></h4>
                                            <span class="text-light opacity-90 small">Specialist Doctor</span>
                                        </div>
                                        <div class="ms-auto">
                                            <button class="btn btn-sm btn-light rounded-circle shadow-sm hover-lift"
                                                data-bs-toggle="tooltip"
                                                title="Book Appointment">
                                                <i class="fas fa-calendar-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="badge bg-soft-primary text-primary me-2">
                                        <i class="fas fa-stethoscope me-1"></i>
                                        Available
                                    </div>
                                    <div class="badge bg-soft-success text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Verified
                                    </div>
                                </div>
                                <p class="text-muted mb-0 lh-lg">
                                    <?php echo $featured->description; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                    $i = $i + 1;
                }
                ?>
            </div>
        </div>
    </div>

    <div class="py-5"></div>


    <div id="gallery" class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary text-uppercase fw-bold mb-3 d-block letter-spacing-sm">Our Facility</span>
                <h2 class="display-5 fw-bold text-dark mb-4">Take a Tour of Our Hospital</h2>
                <p class="lead text-muted mx-auto mb-0" style="max-width: 700px;">Experience our state-of-the-art facilities and welcoming environment through our gallery</p>
            </div>
            <div class="row g-4">
                <?php foreach ($images as $image) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="<?php echo $image->img; ?>" class="gallery-item d-block rounded-4 overflow-hidden shadow-sm hover-scale-sm">
                            <img src="<?php echo $image->img; ?>" class="img-fluid w-100" alt="" style="height: 280px; object-fit: cover;" />
                            <div class="gallery-overlay bg-dark bg-opacity-20 d-flex align-items-center justify-content-center transition">
                                <i class="fas fa-search-plus text-white fa-2x"></i>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div id="portfolio" class="py-5 bg-gradient-light">
        <div class="container">
            <div class="portfolio-testimonials">
                <div class="text-center mb-6">
                    <span class="text-primary text-uppercase fw-bold mb-3 d-block letter-spacing-sm">
                        <i class="fas fa-heart text-danger me-2 animate-pulse"></i>Patient Stories
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-4"><?php echo lang('trusted_by_some_biggest_names'); ?></h2>
                    <p class="lead text-muted mx-auto mb-0" style="max-width: 700px;">Read what our patients say about their experience with us</p>
                </div>
                <div class="owl-carousel owl-carousel1 owl-theme" aria-label="Patient Testimonials">
                    <?php foreach ($reviews as $review) { ?>
                        <div class="px-4">
                            <div class="card border-0 shadow-sm h-100 p-5 rounded-4 bg-white hover-shadow-xl transition" style="border-left: 4px solid #0d6efd !important;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <i class="fas fa-quote-left text-primary opacity-25" style="font-size: 2.5rem;"></i>
                                    <div class="rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </div>
                                <p class="card-text text-muted mb-5 lead fs-6 lh-base" style="font-style: italic;">
                                    <?php echo $review->review; ?>
                                </p>
                                <div class="d-flex align-items-center mt-auto">
                                    <div class="position-relative">
                                        <img src="<?php echo $review->img; ?>"
                                            class="rounded-circle shadow-sm border border-3 border-primary"
                                            alt="<?php echo $review->name; ?>'s profile picture"
                                            style="width: 80px; height: 80px; object-fit: cover;" />
                                        <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow-sm">
                                            <i class="fas fa-check text-white fa-sm"></i>
                                        </div>
                                    </div>
                                    <div class="ms-4">
                                        <h5 class="mb-1 text-dark fw-bold"><?php echo $review->name; ?></h5>
                                        <p class="text-primary mb-0 small fw-medium text-uppercase letter-spacing-sm">
                                            <?php echo $review->designation; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div id="footer" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-5 justify-content-between">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-brand mb-4">
                        <img src="<?php echo $settings->logo; ?>" alt="Logo" class="img-fluid" style="max-height: 50px; filter: brightness(0) invert(1);">
                    </div>
                    <div class="mt-4">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-4 hover-scale-sm">
                            <i class="fas fa-arrow-up me-2"></i>Back to Top
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 border-start border-primary border-4 ps-3"><?php echo lang('about_us'); ?></h5>
                    <p class="text-white-50 mb-0 lh-lg">
                        <?php echo $settings->description; ?>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 border-start border-primary border-4 ps-3"><?php echo lang('STAY_CONNECTED'); ?></h5>
                    <div class="d-flex gap-3 flex-wrap">
                        <?php if (!empty($settings->facebook_id)) { ?>
                            <a href="<?php echo $settings->facebook_id; ?>" class="btn btn-outline-light rounded-circle p-2 hover-scale-sm" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty($settings->google_id)) { ?>
                            <a href="<?php echo $settings->google_id; ?>" class="btn btn-outline-light rounded-circle p-2 hover-scale-sm" aria-label="Google Plus">
                                <i class="fab fa-google"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty($settings->twitter_id)) { ?>
                            <a href="<?php echo $settings->twitter_id; ?>" class="btn btn-outline-light rounded-circle p-2 hover-scale-sm" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty($settings->youtube_id)) { ?>
                            <a href="<?php echo $settings->youtube_id; ?>" class="btn btn-outline-light rounded-circle p-2 hover-scale-sm" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 border-start border-primary border-4 ps-3"><?php echo lang('CONTACT_INFO'); ?></h5>
                    <ul class="list-unstyled footer-contact mb-0">
                        <li class="d-flex align-items-center mb-3 text-white-50 hover-text-light transition">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <span><?php echo $settings->address; ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3 text-white-50 hover-text-light transition">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="fas fa-phone-alt text-primary"></i>
                            </div>
                            <span><?php echo $settings->phone; ?></span>
                        </li>
                        <li class="d-flex align-items-center text-white-50 hover-text-light transition">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="fas fa-envelope text-primary"></i>
                            </div>
                            <span><?php echo $settings->email; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <div id="back-to-top" class="position-fixed bottom-0 end-0 mb-4 me-4 d-none">
        <button class="btn btn-primary rounded-5 p-3 shadow-lg hover-scale transition" onclick="scrollToTop()" aria-label="Back to Top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <script>
        // Show/hide back to top button based on scroll position
        window.onscroll = function() {
            var button = document.getElementById("back-to-top");
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                button.classList.remove("d-none");
            } else {
                button.classList.add("d-none");
            }
        };

        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>


    <!---------------- End Footer Area ---------------->

    <!-- Bootstrap core JavaScript  -->
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
    <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
    <script src="<?php echo site_url('front/js/wow/wow.min.js'); ?>"></script>
    <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
    <script src="<?php echo site_url('front/js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>


    <script>
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } ?>
    </script>
    <script src="common/js/moment.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script type="text/javascript">
        var publish = "<?php echo $gateway->publish; ?>";
    </script>
    <script type="text/javascript">
        var payment_gateway = "<?php echo $settings1->payment_gateway; ?>";
    </script>
    <?php if ($settings1->payment_gateway == '2Checkout') { ?>
        <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
        <script type="text/javascript">
            var publishable = "<?php echo $twocheckout->publishablekey; ?>";
        </script>
        <script type="text/javascript">
            var merchant = "<?php echo $twocheckout->merchantcode; ?>";
        </script>
    <?php } ?>
    <script type="text/javascript">
        var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
    </script>




    <?php
    $language = $this->language;
    if ($language == 'english') {
        $lang = 'en-ca';
        $langdate = 'en-CA';
    } elseif ($language == 'spanish') {
        $lang = 'es';
        $langdate = 'es';
    } elseif ($language == 'french') {
        $lang = 'fr';
        $langdate = 'fr';
    } elseif ($language == 'portuguese') {
        $lang = 'pt';
        $langdate = 'pt';
    } elseif ($language == 'arabic') {
        $lang = 'ar';
        $langdate = 'ar';
    } elseif ($language == 'italian') {
        $lang = 'it';
        $langdate = 'it';
    } elseif ($language == 'zh_cn') {
        $lang = 'zh-cn';
        $langdate = 'zh-CN';
    } elseif ($language == 'japanese') {
        $lang = 'ja';
        $langdate = 'ja';
    } elseif ($language == 'russian') {
        $lang = 'ru';
        $langdate = 'ru';
    } elseif ($language == 'turkish') {
        $lang = 'tr';
        $langdate = 'tr';
    } elseif ($language == 'indonesian') {
        $lang = 'id';
        $langdate = 'id';
    }
    ?>

    <script type="text/javascript">
        var langdate = "<?php echo $langdate; ?>";
        $(document).ready(function() {
            $('.readonly').keydown(function(e) {
                e.preventDefault();
            });

        })
    </script>

    <style>
        .flag-icon {
            font-size: 17px;
        }
    </style>

    <script src="common/assets/bootstrap-datepicker/locales/bootstrap-datepicker.<?php echo $langdate; ?>.min.js"></script>
    <script src="common/extranal/js/site/site.js"></script>


</body>

</html>
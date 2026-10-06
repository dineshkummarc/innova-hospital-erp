<!DOCTYPE html>
<html data-wf-page="666769ac176486cdb7140cfc" data-wf-site="666769ac176486cdb7140cf2">

<head>
  <base href="<?php echo base_url(); ?>">
  <?php
$settings = $this->site_model->getSettingsBySiteId($this->session->userdata('site_id'));
$title = explode(' ', $settings->title);

$this->db->where('hospital_id', $this->session->userdata('site_id'));
$site_name = $this->db->get('site_settings')->row()->title;
?>
  <meta charset="utf-8">
  <title><?php echo $site_name; ?></title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
  <link href="common/frontnew/css/bootstrap.min.css" rel="stylesheet">
  <link href="common/frontnew/css/style.css" rel="stylesheet">
  <script src="common/frontnew/js/webfont.js" type="text/javascript"></script>

  <script type="text/javascript">
    WebFont.load({
      google: {
        families: ["Merriweather:300,300italic,400,400italic,700,700italic,900,900italic", "Oswald:200,300,400,500,600,700", "Changa One:400,400italic", "Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic", "Droid Sans:400,700", "Plus Jakarta Sans:200,300,regular,500,600,700,800", "Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:latin,latin-ext"]
      }
    });
  </script>
  <script type="text/javascript">
    ! function(o, c) {
      var n = c.documentElement,
        t = " w-mod-";
      n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
    }(window, document);
  </script>
  <link href="uploads/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="uploads/favicon.png" rel="apple-touch-icon">
</head>

<body class="body">


  <div class="container-fluid pt-5" id="home">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top nav-css">
      <div class="container px-5 container-css">
        <a class="navbar-brand py-2 scroll-css" id="scrollToHome">
          <?php
          if (!empty($settings->logo)) {
            if (file_exists($settings->logo)) {
              echo '<img style="max-height: 48px; width: auto;" src=' . $settings->logo . '>';
            } else {
              echo $title[0] . '<span> ' . $title[1] . '</span>';
            }
          } else {
            echo $title[0] . '<span> ' . $title[1] . '</span>';
          }
          ?>
          
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav gap-4 align-items-center">
            <li class="nav-item">
              <a class="nav-link fw-semibold home-css" id="scrollToHome"><?php echo lang('Home'); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold home-css" id="scrollToService"><?php echo lang('Services'); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold home-css" id="scrollToDoctor"><?php echo lang('Doctors'); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold home-css" id="scrollToReview"><?php echo lang('Reviews'); ?></a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary fw-semibold px-4 py-2 text-white appointment-css" onclick="document.getElementById('appointment').scrollIntoView({behavior: 'smooth'})"><?php echo lang('Book Appointment'); ?></a>
            </li>
            <li class="nav-item">
              <a href="auth/login" class="btn btn-outline-primary fw-semibold px-4 py-2 login-css"><?php echo lang('Login'); ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>




    <!-- Hero Section -->
    <section class="position-relative overflow-hidden py-5 bg-gradient">
      <?php foreach ($slides as $slide) { ?>
        <div class="container py-5 px-5 container-css">
          <div class="row align-items-center gy-5">
            <div class="col-lg-6">
              <div class="pe-lg-4">
                <?php
                $text = $slide->title;
                $words = explode(' ', $text);
                $coloredText = '';
                $colors = ['#1a365d', '#0047AB'];
                foreach ($words as $index => $word) {
                  $color = $index < 2 ? $colors[0] : $colors[1];
                  $coloredText .= "<span style='color: $color;'>$word</span> ";
                  if ($index == 1) {
                    $coloredText .= "<br>";
                  }
                }
                ?>
                <span class="d-inline-block px-3 py-1 mb-4 rounded-pill round-pill-css"> <?php echo lang('Welcome to Doctor Care'); ?></span>
                <h1 class="display-4 fw-bold mb-4 color-text-css">
                  <?php echo $coloredText; ?>

                </h1>
                <p class="lead mb-5 text-1-css"><?php echo $slide->text1; ?></p>
                <div class="d-flex gap-3 flex-wrap">
                  <a id="scrollToAppointment1" class="btn btn-primary px-4 py-3 fw-semibold" onclick="document.getElementById('appointment').scrollIntoView({behavior: 'smooth'})"><?php echo lang('Schedule Appointment'); ?></a>
                  <a id="scrollToService1" class="btn btn-outline-primary px-4 py-3 fw-semibold" onclick="document.getElementById('service').scrollIntoView({behavior: 'smooth'})"><?php echo lang('Explore Services'); ?></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 position-relative">
              <div class="position-absolute top-50 start-50 translate-middle translate-css"></div>
              <img src="<?php echo $slide->img_url; ?>" alt="Healthcare professionals" class="img-fluid position-relative img-fluid-css">
            </div>
          </div>
        </div>
      <?php } ?>
    </section>
  </div>

  <section class="key-section-css">
    <div class="container px-5 key-container-css">
      <div class="text-center mb-5">
        <span class="d-inline-block px-3 py-1 mb-3 rounded-pill key-pill-css"> <?php echo lang('Key Features'); ?></span>
        <h2 class="display-5 fw-bold mb-4 key-display-css"> <?php echo lang('Why Patients Choose Us'); ?></h2>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm key-doctor-css">
            <div class="card-body p-4 text-center">
              <div class="rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center key-doctor-content">
                <i class="fas fa-user-md fa-2x key-user-css"></i>
              </div>
              <h3 class="h4 mb-3 key-h3-css"> <?php echo lang('Expert Doctors'); ?></h3>
              <p class="text-muted mb-0"><?php echo lang('Our team consists of highly qualified and experienced medical professionals dedicated to providing the best care possible.'); ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm key-doctor-css">
            <div class="card-body p-4 text-center">
              <div class="rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center key-doctor-content">
                <i class="fas fa-hospital fa-2x key-hospital-css"></i>
              </div>
              <h3 class="h4 mb-3 key-h3-css"> <?php echo lang('Modern Facilities'); ?></h3>
              <p class="text-muted mb-0"><?php echo lang('State-of-the-art medical equipment and facilities to ensure accurate diagnosis and effective treatment.'); ?> </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm key-doctor-css">
            <div class="card-body p-4 text-center">
              <div class="rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center key-doctor-content">
                <i class="fas fa-clock fa-2x key-user-css"></i>
              </div>
              <h3 class="h4 mb-3 key-h3-css" > <?php echo lang('24/7 Support'); ?> </h3>
              <p class="text-muted mb-0"><?php echo lang('Round-the-clock medical assistance and emergency services to support you whenever you need us.'); ?> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="meet-doctor featured-section-css" id="doctor">
    <div class="container-7 featured-container-css">
      <div class="text-center mb-5">
        <span class="d-inline-block px-3 py-1 mb-3 rounded-pill featured-pill-css"><?php echo lang('Our Doctors'); ?></span>
        <?php
        $title = $settings->doctor_block__text_under_title;
        $title_parts = explode(' ', $title);
        $first_four_words = implode(' ', array_slice($title_parts, 0, 4));
        $last_word = implode(' ', array_slice($title_parts, 4));
        ?>
        <h2 class="centered-heading display-4 fw-bold mb-4 key-h3-css" ><?php echo $first_four_words; ?><br><span class="text-span-5 key-user-css"><?php echo $last_word; ?></span></h2>
      </div>

      <div class="team-grid featured-grid-css">
        <?php foreach ($featureds as $featured) { ?>
          <div id="w-node-b4a628db-a88b-5aad-2a69-4f5a4625a395-b7140cfc" class="team-card featured-card-css">
            <img src="<?php echo $featured->img_url; ?>" loading="lazy" width="100%" alt="" class="team-member-image featured-image-css">
            <div class="div-block-7 div-block-css">
              <div class="team-member-name featured-name-css"><?php echo $featured->name; ?></div>
              <p class="paragraph-2 feature-description-css" ><?php echo $featured->description; ?></p>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </section>

  <section class="appointment appointment-section-css" id="appointment">
    <div class="container-10 appointment-container-css">
      <div class="text-center mb-5">
        <span class="text-block-19 d-inline-block px-4 py-2 mb-4 rounded-pill appointment-pill-css"><?php echo lang('SCHEDULE YOUR VISIT'); ?></span>
        <h2 class="centered-heading-2 display-3 fw-bold mb-4 schedule-text-css"><?php echo lang('Book Your'); ?> <span class="text-span-4 appointment-text-css"><?php echo lang('Appointment'); ?></span></h2>
        <p class="centered-subheading-2 mb-5 appointment-description-css"><?php echo lang('We are here to provide you with exceptional care. Schedule your visit with our expert medical team today.'); ?></p>
      </div>

      <div class="w-form">
        <style>

        </style>







<form action="<?php echo site_url('site/addNew'); ?>" method="post" class="appointment-form">
          <div class="form-row w-row">
            <div class="w-col w-col-6">
              <div class="form-column">
                <div class="position-relative">
                  <select class="form-input form-select pe-5" id="pos_select" name="patient" value='' required>
                    <option value="">Select Patient</option>
                    <option value="patient_id"><?php echo lang('patient_id'); ?></option>
                    <option value="add_new"><?php echo lang('add_new'); ?></option>
                  </select>
                  <i class="fas fa-chevron-down position-absolute form-icon-css"></i>
                </div>

                <div class="pos_client_id clearfix display-none-css" >
                  <input class="form-input" type="text" name="patient_id" placeholder="<?php echo lang('patient_id'); ?>">
                </div>
                <div class="pos_client clearfix display-none-css" >
                  <input class="form-input mb-3" type="text" name="p_name" placeholder="<?php echo lang('patient'); ?> <?php echo lang('name'); ?>">
                  <input class="form-input mb-3" type="email" name="p_email" placeholder="<?php echo lang('patient'); ?> <?php echo lang('email'); ?>">
                  <input class="form-input mb-3" type="text" name="p_phone" placeholder="<?php echo lang('patient'); ?> <?php echo lang('phone'); ?>">
                  <div class="position-relative">
                    <select class="form-input form-select pe-5" name="p_gender">
                      <option value="Male"><?php echo lang('male'); ?></option>
                      <option value="Female"><?php echo lang('female'); ?></option>
                      <option value="Others"><?php echo lang('others'); ?></option>
                    </select>
                    <i class="fas fa-chevron-down position-absolute form-icon-css"></i>
                  </div>
                </div>

                <div class="position-relative doctor_div mb-3">
                  <select class="form-input form-select pe-5" id="adoctors" name="doctor" value='' required>
                    <option value=""><?php echo lang('select_doctor'); ?></option>
                    <?php foreach ($doctors as $doctor) { ?>
                      <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?></option>
                    <?php } ?>
                  </select>
                  <i class="fas fa-chevron-down position-absolute form-icon-css"></i>
                </div>
              </div>
            </div>
            <div class="w-col w-col-6">
              <div class="form-column">
                <input class="form-input default-date-picker" name="date" id="date" placeholder="<?php echo lang('date'); ?>" type="text" required readonly>

                <div class="position-relative">
                  <select class="form-input form-select pe-5" name="time_slot" id="aslots" required>
                    <option value=""><?php echo lang('available_slots'); ?></option>
                  </select>
                  <i class="fas fa-chevron-down position-absolute form-icon-css"></i>
                </div>

                <div class="position-relative">
                  <select class="form-input form-select pe-5" name="visit_description" id="visit_description" required>
                    <option value=""><?php echo lang('visit'); ?> <?php echo lang('description'); ?></option>
                  </select>
                  <i class="fas fa-chevron-down position-absolute form-icon-css"></i>
                </div>

                <input type="number" class="form-input" name="visit_charges" id="visit_charges" placeholder=" <?php echo lang('visit'); ?> <?php echo lang('charges'); ?>" readonly>
              </div>
            </div>
          </div>

          <textarea placeholder="Additional Notes or Concerns..." name="remarks" class="form-textarea textarea-css"></textarea>





          <input type="hidden" name="discount" value='0'>
                                                <input type="hidden" name="grand_total" value='0'>
                                                <input type="hidden" name="redirectlink" value='site'>
                                                <input type="hidden" name="request" value=''>

          <div class="text-center">
            <button type="submit" class="form-submit">
              <?php echo lang('book_an_appointment'); ?>
            </button>
          </div>
        </form>












      </div>
    </div>
    <div class="csss"></div>
  </section>



  <section class="departments service-section-css" id="service">
    <div class="container px-5 service-container-css">
      <div class="text-center mb-5">
        <span class="text-block-10 d-inline-block px-3 py-1 mb-3 rounded-pill service-pill-css"> <?php echo lang('OUR SERVICES'); ?></span>
        <h1 class="centered-heading display-4 fw-bold mb-4"><span class="first-text-css"><?php echo explode(' ', $settings->service_block__text_under_title, 2)[0] . ' ' . explode(' ', $settings->service_block__text_under_title, 3)[1]; ?></span> <span class="text-span-3 key-user-css" ><?php echo explode(' ', $settings->service_block__text_under_title, 3)[2] . ' ' ?></span></h1>
      </div>

      <div class="hero-wrapper-2 row align-items-center gy-5">
        <div class="second-hero-2 col-lg-6">
          <img src="common/frontnew/images/63b3c8f019c92c261b4ddb1c_service-section.webp" loading="lazy" alt="Medical Services" class="image-10 img-fluid rounded-4 shadow-lg service-image2-css">
        </div>

        <div class="second-hero-2 col-lg-6">
          <div class="w-layout-grid grid-2 row g-4">
            <?php foreach ($services as $service) { ?>
              <div id="w-node-e49f2aee-8edd-a2f0-f048-b7320b9d5cfa-b7140cfc" class="div-block-4 col-md-6">
                <div class="p-4 h-100 rounded-4 service-round-css">
                  <img src="<?php echo $service->img_url; ?>" loading="lazy" alt="Oncology" class="image-4 mb-3 service-image-css">
                  <h3 class="text-block-3 h5 fw-bold mb-2 key-h3-css"><?php echo $service->title; ?></h3>
                  <p class="text-block-7 mb-0 service-description-css" ><?php echo $service->description; ?></p>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="numbers py-5 number-section-css">
    <div class="container py-5 px-5 container-css">
      <div class="features-wrapper row g-4 text-center">
        <div class="features-block col-md-3 col-6">
          <div class="p-4 rounded-4 number-round-css">
            <div class="features-title display-5 fw-bold mb-2 number-color-css">8566+</div>
            <div class="text-block-20 number-text-css"> <?php echo lang('Happy Patients'); ?></div>
          </div>
        </div>
        <div class="features-block col-md-3 col-6">
          <div class="p-4 rounded-4 number-round-css">
            <div class="features-title display-5 fw-bold mb-2 number-color-css" >135+</div>
            <div class="text-block-21 number-text-css" > <?php echo lang('Expert Doctors'); ?></div>
          </div>
        </div>
        <div class="features-block col-md-3 col-6">
          <div class="p-4 rounded-4 number-round-css">
            <div class="features-title display-5 fw-bold mb-2 number-color-css" >4.9</div>
            <div class="text-block-22 number-text-css"> <?php echo lang('Average Ratings'); ?></div>
          </div>
        </div>
        <div class="features-block new-border2 col-md-3 col-6">
          <div class="p-4 rounded-4 number-round-css">
            <div class="features-title display-5 fw-bold mb-2 number-color-css" >120+</div>
            <div class="text-block-23 number-text-css" > <?php echo lang('Award Winning'); ?></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonial-slider-large position-relative py-5 testimonial-section-css" id="review">
    <div class="container px-5 py-5 container-css">
      <div class="text-center mb-5">
        <span class="d-inline-block px-3 py-1 mb-3 rounded-pill testimonial-pill-css"><?php echo lang('TESTIMONIALS'); ?></span>
        <h2 class="display-4 fw-bold mb-4 key-h3-css" >
          <?php
          $title = $settings->review_title;
          $title_parts = explode(' ', $title);
          $first_two_words = implode(' ', array_slice($title_parts, 0, 2));
          $last_two_words = implode(' ', array_slice($title_parts, 2));

          ?>
          <?php echo $first_two_words; ?> <span class="key-user-css"><?php echo $last_two_words; ?></span>
        </h2>
      </div>

      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row g-4">
              <?php foreach ($reviews as $review) { ?>
                <div class="col-12">
                  <div class="testimonial-slide p-4 p-lg-5 rounded-4 review-round-css">
                    <div class="row align-items-center">
                      <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="<?php echo $review->img; ?>" loading="lazy" alt="Patient Testimonial" class="rounded-circle mx-auto d-block review-image-css">
                      </div>
                      <div class="col-lg-8">
                        <div class="testimonial-content position-relative">
                          <img src="common/images/62434fa732124a91e612aae8_quote-mark.svg" loading="lazy" alt="" class="testimonial-quote-icon review-icon-css">
                          <p class="testimonial-quote mb-4 review-quote-css"><?php echo $review->review; ?></p>
                          <div class="testimonial-info-two">
                            <h4 class="testimonial-author-name h5 fw-bold mb-1 key-h3-css"><?php echo $review->name; ?></h4>
                            <p class="text-block-9 mb-0 review-description-css"><?php echo $review->designation; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>


        </div>

        <button class="carousel-control-prev carousel-css" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon carousel-icon-css"></span>
        </button>
        <button class="carousel-control-next carousel-css" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon carousel-icon-css"></span>
        </button>

        <div class="carousel-indicators carousel-indicators-css">
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active active-css"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="active-css"></button>
        </div>
      </div>
    </div>
  </section>

  <section class="footer-dark py-5 footer-c-css">
    <div class="container px-5 container-css">
      <div class="row g-5">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <a href="#home" class="d-inline-block mb-4">
            <img src="<?php echo $settings->logo; ?>" loading="lazy" alt="Logo" class="footer-logo-css">
          </a>
          <p class="mb-4 footer-t-css"><?php echo lang('Providing exceptional healthcare services with compassion and expertise. Your health is our priority.'); ?></p>
        </div>

        <div class="col-sm-6 col-lg-2">
          <h5 class="text-white mb-4"> <?php echo lang('About us'); ?></h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-decoration-none about-css"> <?php echo lang('How it works'); ?></a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none about-css"> <?php echo lang('Pricing'); ?></a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none about-css"> <?php echo lang('Docs'); ?></a></li>
          </ul>
        </div>

        <div class="col-sm-6 col-lg-2">
          <h5 class="text-white mb-4"> <?php echo lang('Quick Links'); ?></h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#home" class="text-decoration-none about-css"> <?php echo lang('Home'); ?></a></li>
            <li class="mb-2"><a href="#service" class="text-decoration-none about-css"> <?php echo lang('Services'); ?></a></li>
            <li class="mb-2"><a href="#doctor" class="text-decoration-none about-css"> <?php echo lang('Doctors'); ?></a></li>
            <li class="mb-2"><a href="#review" class="text-decoration-none about-css"> <?php echo lang('Reviews'); ?></a></li>
          </ul>
        </div>

        <div class="col-lg-4">
          <h5 class="text-white mb-4"> <?php echo lang('Contact Info'); ?></h5>
          <ul class="list-unstyled mb-4">
            <li class="mb-2"><a href="#" class="text-decoration-none about-css"> <?php echo lang('Terms & Conditions'); ?></a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none about-css"> <?php echo lang('Privacy policy'); ?></a></li>
          </ul>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center s-icon-css">
              <img src="common/images/62434fa732124ac15112aad5_twitter small.svg" loading="lazy" alt="Twitter" class="social-css" >
            </a>
            <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center s-icon-css">
              <img src="common/images/62434fa732124a389912aad8_linkedin small.svg" loading="lazy" alt="LinkedIn" class="social-css" >
            </a>
            <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center s-icon-css">
              <img src="common/images/62434fa732124a51bf12aae9_facebook small.svg" loading="lazy" alt="Facebook" class="social-css">
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container px-5 mt-5 container-css">
      <div class="pt-4 text-center footer-css">
        <p class="mb-0 footer-des-css"><?php echo $settings->description; ?></p>
      </div>
    </div>
  </section>

  <!-- Back to Top Button -->
  <button onclick="scrollToTop()" id="backToTopBtn" class="btn btn-primary rounded-circle text-white arrow-css">
    <i class="fas fa-arrow-up"></i>
  </button>


  <!-- Bootstrap core JavaScript  -->
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/site_assets/js/main.js'); ?>"></script>
  <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
  <script src="<?php echo site_url('common/frontnew/extra/js/wow/wow.min.js'); ?>"></script>
  <script src="common/frontnew/extra/js/smoothscroll/jquery.smoothscroll.min.js"></script>
  <script src="<?php echo site_url('common/frontnew/extra/js/script.js'); ?>"></script>
  <!-- <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>


  <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>"> -->




  <link rel="stylesheet" href="common/frontnew/css/flatpickr.min.css">
  <script src="common/frontnew/js/flatpickr"></script>










  <script>
    // Get the button and menu links
    let backToTopButton = document.getElementById("backToTopBtn");
    let menuLinks = document.querySelectorAll('a[href^="#"]');

  
    if (!document.querySelector('link[href*="font-awesome"]')) {
      let fontAwesomeLink = document.createElement('link');
      fontAwesomeLink.rel = 'stylesheet';
      fontAwesomeLink.href = '<?php echo site_url('common/frontnew/css/all.min.css'); ?>';
      document.head.appendChild(fontAwesomeLink);
    }

    // When user scrolls down 50% of viewport height, show the button
    window.onscroll = function() {
      if (document.body.scrollTop > window.innerHeight / 2 ||
        document.documentElement.scrollTop > window.innerHeight / 2) {
        backToTopButton.style.display = "block";
      } else {
        backToTopButton.style.display = "none";
      }
    };

    // When user clicks the button, scroll to the top
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    // Add smooth scrolling to menu links
    menuLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  </script>

  <script src="common/frontnew/js/bootstrap.bundle.min.js"></script>
  <script>
    // Initialize Bootstrap's collapse functionality
    document.addEventListener('DOMContentLoaded', function() {
      var navbarToggler = document.querySelector('.navbar-toggler');
      var navbarCollapse = document.querySelector('.navbar-collapse');

      navbarToggler.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
      });

      // Close menu when clicking outside
      document.addEventListener('click', function(event) {
        var isClickInside = navbarToggler.contains(event.target) || navbarCollapse.contains(event.target);
        if (!isClickInside && navbarCollapse.classList.contains('show')) {
          navbarCollapse.classList.remove('show');
        }
      });

      // Close menu when clicking on a nav link (mobile)
      var navLinks = document.querySelectorAll('.nav-link, .btn');
      navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          if (window.innerWidth < 992) { // Bootstrap's lg breakpoint
            navbarCollapse.classList.remove('show');
          }
        });
      });
    });
  </script>

  <script>
    // Add click handlers for all scroll links
    document.querySelectorAll('#scrollToHome').forEach(link => {
      link.addEventListener('click', () => {
        document.getElementById('home').scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    document.getElementById('scrollToService').addEventListener('click', () => {
      document.getElementById('service').scrollIntoView({
        behavior: 'smooth'
      });
    });


    document.getElementById('scrollToDoctor').addEventListener('click', () => {
      document.getElementById('doctor').scrollIntoView({
        behavior: 'smooth'
      });
    });

    document.getElementById('scrollToReview').addEventListener('click', () => {
      document.getElementById('review').scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>



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





  <script>
    $(document).ready(function() {
      $('#pos_select').change(function() {
        var value = $(this).val();
        if (value == 'patient_id') {
          $('.pos_client').hide();
          $('.pos_client_id').show();
        } else if (value == 'add_new') {
          $('.pos_client_id').hide();
          $('.pos_client').show();
        } else {
          $('.pos_client_id').hide();
          $('.pos_client').hide();
        }
      });
    });
  </script>


  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
  </script>

  <!-- Import SweetAlert2 CSS and JS -->
  <link rel="stylesheet" href="common/frontnew/css/sweetalert2.min.css">
  <script src="common/frontnew/js/sweetalert2.all.min.js"></script>

  <?php if ($this->session->flashdata('success')) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Appointment Booked Successfully',
        timer: 5000,
        showConfirmButton: false
      });
    </script>
    <?php $this->session->unset_userdata('success'); ?>
  <?php } ?>

  <?php if ($this->session->flashdata('warning')) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?php echo $this->session->flashdata('warning'); ?>',
        timer: 5000,
        showConfirmButton: false
      });
    </script>
    <?php $this->session->unset_userdata('warning'); ?>
  <?php } ?>




  <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
  
  <script src="common/extranal/js/site/site.js"></script>


</body>

</html>
<!-- <link href="common/extranal/css/frontend/settings.css" rel="stylesheet"> -->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-cog mr-2"></i><?php echo lang('superadmin'); ?> <?php echo lang('frontend'); ?> <?php echo lang('website'); ?> <?php echo lang('settings'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('website'); ?> <?php echo lang('settings'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="frontend/update" method="post" enctype="multipart/form-data">


                                <div class="mb-3" id="accordion">
                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                                                    <?php echo lang('general_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                                                        <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                                                    if (!empty($settings->title)) {
                                                                                                                                        echo $settings->title;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="system name" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('logo'); ?></label>
                                                        <input type="file" class="form-control form-control-lg" name="img_url" value='<?php
                                                                                                                                        if (!empty($settings->invoice_logo)) {
                                                                                                                                            echo $settings->invoice_logo;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                        <span class="help-block"><?php echo lang('recommended_size'); ?>: 200x100</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &ast;</label>
                                                        <input type="text" class="form-control form-control-lg" name="address" value='<?php
                                                                                                                                        if (!empty($settings->address)) {
                                                                                                                                            echo $settings->address;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="address" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &ast;</label>
                                                        <input type="number" class="form-control form-control-lg" name="phone" value='<?php
                                                                                                                                        if (!empty($settings->phone)) {
                                                                                                                                            echo $settings->phone;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="phone" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('emergency'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="emergency" value='<?php
                                                                                                                                        if (!empty($settings->emergency)) {
                                                                                                                                            echo $settings->emergency;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('support_number'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="support" value='<?php
                                                                                                                                        if (!empty($settings->support)) {
                                                                                                                                            echo $settings->support;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('hospital_email'); ?> &ast;</label>
                                                        <input type="email" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                                        if (!empty($settings->email)) {
                                                                                                                                            echo $settings->email;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="email" required="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('currency'); ?> &ast;</label>
                                                        <input type="text" class="form-control form-control-lg" name="currency" value='<?php
                                                                                                                                        if (!empty($settings->currency)) {
                                                                                                                                            echo $settings->currency;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="currency" required="">
                                                    </div>

                                                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <input type="checkbox" class="" name="google_translation_switch_in_frontend" value='<?php
                                                                                                                                                                                    if (!empty($settings->google_translation_switch_in_frontend)) {
                                                                                                                                                                                        echo $settings->google_translation_switch_in_frontend;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo 'yes';
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>' placeholder="codec_purchase_code" <?php
                                                                                                                                                                                                                            if ($settings->google_translation_switch_in_frontend == 'yes') {
                                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            ?>> <?php echo lang('google_translation_switch_in_frontend') ?>
                                                            </label>

                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title  mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                                                    <?php echo lang('block_text_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('announcement'); ?> </label>
                                                        <input type="text" class="form-control form-control-lg" name="block_1_text_under_title" value='<?php
                                                                                                                                                        if (!empty($settings->block_1_text_under_title)) {
                                                                                                                                                            echo $settings->block_1_text_under_title;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                    </div> -->

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('review_block_text_under_title'); ?> </label>
                                                        <input type="text" class="form-control form-control-lg" name="service_block__text_under_title" value='<?php
                                                                                                                                                                if (!empty($settings->service_block__text_under_title)) {
                                                                                                                                                                    echo $settings->service_block__text_under_title;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="">
                                                    </div>

                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('package_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="doctor_block__text_under_title" value='<?php
                                                                                                                                                                if (!empty($settings->doctor_block__text_under_title)) {
                                                                                                                                                                    echo $settings->doctor_block__text_under_title;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="">
                                                    </div> -->
                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('registration_block_text'); ?> </label>
                                                        <input type="text" class="form-control form-control-lg" name="registration_block_text" value='<?php
                                                                                                                                                        if (!empty($settings->registration_block_text)) {
                                                                                                                                                            echo $settings->registration_block_text;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('contact'); ?> </label>
                                                        <input type="text" class="form-control form-control-lg" name="contact_us" value='<?php
                                                                                                                                            if (!empty($settings->contact_us)) {
                                                                                                                                                echo $settings->contact_us;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
                                                    <?php echo lang('social_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-expanded="false">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('facebook_id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="facebook_id" value='<?php
                                                                                                                                            if (!empty($settings->facebook_id)) {
                                                                                                                                                echo $settings->facebook_id;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('twitter_id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="twitter_id" value='<?php
                                                                                                                                            if (!empty($settings->twitter_id)) {
                                                                                                                                                echo $settings->twitter_id;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('twitter_username'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="twitter_username" value='<?php
                                                                                                                                                if (!empty($settings->twitter_username)) {
                                                                                                                                                    echo $settings->twitter_username;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('google_id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="google_id" value='<?php
                                                                                                                                        if (!empty($settings->google_id)) {
                                                                                                                                            echo $settings->google_id;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('youtube_id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="youtube_id" value='<?php
                                                                                                                                            if (!empty($settings->youtube_id)) {
                                                                                                                                                echo $settings->youtube_id;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('skype_id'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="skype_id" value='<?php
                                                                                                                                        if (!empty($settings->skype_id)) {
                                                                                                                                            echo $settings->skype_id;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false">
                                                    <?php echo lang('section_1_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSix" class="collapse" aria-expanded="false">
                                            <div class="card-body">

                                                <div class="form-group col-md-12">
                                                    <div class="row">

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="market_title" value='<?php
                                                                                                                                                if (!empty($settings->market_title)) {
                                                                                                                                                    echo $settings->market_title;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_1'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="market_description" value='<?php
                                                                                                                                                        if (!empty($settings->market_description)) {
                                                                                                                                                            echo $settings->market_description;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_2'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="market_button_link" value='<?php
                                                                                                                                                        if (!empty($settings->market_button_link)) {
                                                                                                                                                            echo $settings->market_button_link;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('upload_cover_image'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->market_image)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->market_image)) {
                                                                                    } else {
                                                                                        echo $settings->market_image;
                                                                                    }
                                                                                    ?>" height="100px" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="market_image" />
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false">
                                                    <?php echo lang('section_2_setting'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-expanded="false">
                                            <div class="card-body">

                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('comment_1'); ?></label>
                                                            <input type="text" class="form-control form-control-lg" name="comment_1" value='<?php
                                                                                                                                            if (!empty($settings->comment_1)) {
                                                                                                                                                echo $settings->comment_1;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('left_text'); ?></label>
                                                            <input type="text" class="form-control form-control-lg" name="verified_1" value='<?php
                                                                                                                                                if (!empty($settings->verified_1)) {
                                                                                                                                                    echo $settings->verified_1;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                 
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('comment_2'); ?></label>
                                                            <input type="text" class="form-control form-control-lg" name="comment_2" value='<?php
                                                                                                                                            if (!empty($settings->comment_2)) {
                                                                                                                                                echo $settings->comment_2;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('left_text'); ?>t</label>
                                                            <input type="text" class="form-control form-control-lg" name="verified_2" value='<?php
                                                                                                                                                if (!empty($settings->verified_2)) {
                                                                                                                                                    echo $settings->verified_2;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false">
                                                    <?php echo lang('section_1_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('header_section'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('header_title'); ?> Header Title</label>
                                                            <input type="text" class="form-control form-control-lg" name="partner_header_title" value='<?php
                                                                                                                                                        if (!empty($settings->partner_header_title)) {
                                                                                                                                                            echo $settings->partner_header_title;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('header_description'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="partner_header_description" value='<?php
                                                                                                                                                                if (!empty($settings->partner_header_description)) {
                                                                                                                                                                    echo $settings->partner_header_description;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('section_1'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_title_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_title_1)) {
                                                                                                                                                        echo $settings->section_title_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_description_1" value='<?php
                                                                                                                                                        if (!empty($settings->section_description_1)) {
                                                                                                                                                            echo $settings->section_description_1;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('section_2'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_title_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_title_2)) {
                                                                                                                                                        echo $settings->section_title_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_description_2" value='<?php
                                                                                                                                                        if (!empty($settings->section_description_2)) {
                                                                                                                                                            echo $settings->section_description_2;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <!-- <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_1'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_1)) {
                                                                                                                                                        echo $settings->section_2_text_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_2'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_2)) {
                                                                                                                                                        echo $settings->section_2_text_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_3'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_3)) {
                                                                                                                                                        echo $settings->section_2_text_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div> -->

                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('section_3'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_title_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_title_3)) {
                                                                                                                                                        echo $settings->section_title_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_description_3" value='<?php
                                                                                                                                                        if (!empty($settings->section_description_3)) {
                                                                                                                                                            echo $settings->section_description_3;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <!-- <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_1'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_1)) {
                                                                                                                                                        echo $settings->section_3_text_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_2'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_2)) {
                                                                                                                                                        echo $settings->section_3_text_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('text_3'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_3)) {
                                                                                                                                                        echo $settings->section_3_text_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div> -->
                                                        <!-- <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_3)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->partner_image_3)) {
                                                                                    } else {
                                                                                        echo $settings->partner_image_3;
                                                                                    }
                                                                                    ?>" height="100px" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="partner_image_3" />
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false">
                                                    <?php echo lang('section_2_setting'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-expanded="false">
                                            <div class="card-body">

                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('Why Choose Our Product?'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_title" value='<?php
                                                                                                                                                if (!empty($settings->team_title)) {
                                                                                                                                                    echo $settings->team_title;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_description" value='<?php
                                                                                                                                                    if (!empty($settings->team_description)) {
                                                                                                                                                        echo $settings->team_description;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h4> <label for="exampleInputEmail1"> <?php echo lang('point_section'); ?> </label></h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title1'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_button_link" value='<?php
                                                                                                                                                    if (!empty($settings->team_button_link)) {
                                                                                                                                                        echo $settings->team_button_link;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description1'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_1_text_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_1_text_1)) {
                                                                                                                                                        echo $settings->section_1_text_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title2'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_1_text_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_1_text_2)) {
                                                                                                                                                        echo $settings->section_1_text_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description2'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_1_text_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_1_text_3)) {
                                                                                                                                                        echo $settings->section_1_text_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title3'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_1)) {
                                                                                                                                                        echo $settings->section_2_text_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description3'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_2)) {
                                                                                                                                                        echo $settings->section_2_text_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title4'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_2_text_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_2_text_3)) {
                                                                                                                                                        echo $settings->section_2_text_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description4'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_1" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_1)) {
                                                                                                                                                        echo $settings->section_3_text_1;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title5'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_2" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_2)) {
                                                                                                                                                        echo $settings->section_3_text_2;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description5'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="section_3_text_3" value='<?php
                                                                                                                                                    if (!empty($settings->section_3_text_3)) {
                                                                                                                                                        echo $settings->section_3_text_3;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('title6'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_commentator_name" value='<?php
                                                                                                                                                        if (!empty($settings->team_commentator_name)) {
                                                                                                                                                            echo $settings->team_commentator_name;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('description6'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_commentator_designation" value='<?php
                                                                                                                                                                if (!empty($settings->team_commentator_designation)) {
                                                                                                                                                                    echo $settings->team_commentator_designation;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="">
                                                        </div>

                                                        <!-- <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('comment'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_comment" value='<?php
                                                                                                                                                if (!empty($settings->team_comment)) {
                                                                                                                                                    echo $settings->team_comment;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <?php echo lang('left_text'); ?> </label>
                                                            <input type="text" class="form-control form-control-lg" name="team_verified" value='<?php
                                                                                                                                                if (!empty($settings->team_verified)) {
                                                                                                                                                    echo $settings->team_verified;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                        </div> -->


                                                        <!-- <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->team_review_logo)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->team_review_logo)) {
                                                                                    } else {
                                                                                        echo $settings->team_review_logo;
                                                                                    }
                                                                                    ?>" height="100px" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="team_review_logo" />
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div> -->

                                                        <!-- <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('upload_logo'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->team_commentator_image)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->team_commentator_image)) {
                                                                                    } else {
                                                                                        echo $settings->team_commentator_image;
                                                                                    }
                                                                                    ?>" height="100px" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="team_commentator_image" />
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false">
                                                    <?php echo lang('tawk_to_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                                        <div class="form-group">
    <label class="form-label"><?php echo lang('tawk_to_status'); ?></label>
    <div class="d-flex align-items-center">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tawk_to_status" id="tawk_to_status_yes" value="yes" <?php if (!empty($settings->tawk_to_status) && $settings->tawk_to_status == 'yes') { echo 'checked'; } ?>>
            <label class="form-check-label" for="tawk_to_status_yes"><?php echo lang('enable'); ?></label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tawk_to_status" id="tawk_to_status_no" value="no" <?php if (!empty($settings->tawk_to_status) && $settings->tawk_to_status == 'no') { echo 'checked'; } ?>>
            <label class="form-check-label" for="tawk_to_status_no"><?php echo lang('disable'); ?></label>
        </div>
    </div>
</div>
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputEmail1"> <?php echo lang('tawk_Direct_Chat_Link'); ?></label> <br>
                                                            <input type="text" class="form-control form-control-lg" name="chat_js" id="exampleInputEmail1" value='<?php
                                                                                                                                                                    if (!empty($settings->chat_js)) {
                                                                                                                                                                        echo $settings->chat_js;
                                                                                                                                                                    }
                                                                                                                                                                    ?>' placeholder="<?php echo lang('tawk_Direct_Chat_Link'); ?>">
                                                            <code>
                                                                Login <a href="tawk.to">tawk.to</a> then go to Dashboard -> Add-ons -> Chat Widgets <br>
                                                                In the widgets code copy the value of s1.src and paste here
                                                            </code>
                                                        </div>

                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <div class="card">
                                        <!-- <div class="card-header clearfix">
                                            <h4 class="card-title mb-0">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFaq" aria-expanded="false">
                                                    <?php echo lang('section_3_settings'); ?>
                                                </a>
                                            </h4>
                                        </div> -->
                                        <div id="collapseFaq" class="collapse" aria-expanded="false">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h4> <label for="exampleInputEmail1"> <?php echo lang('section_1'); ?> </label></h4>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title1'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question1" value='<?php
                                                                                                                                        if (!empty($settings->question1)) {
                                                                                                                                            echo $settings->question1;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description1'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer1" value='<?php
                                                                                                                                        if (!empty($settings->answer1)) {
                                                                                                                                            echo $settings->answer1;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title2'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question2" value='<?php
                                                                                                                                        if (!empty($settings->question2)) {
                                                                                                                                            echo $settings->question2;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description2'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer2" value='<?php
                                                                                                                                        if (!empty($settings->answer2)) {
                                                                                                                                            echo $settings->answer2;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title3'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question3" value='<?php
                                                                                                                                        if (!empty($settings->question3)) {
                                                                                                                                            echo $settings->question3;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description3'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer3" value='<?php
                                                                                                                                        if (!empty($settings->answer3)) {
                                                                                                                                            echo $settings->answer3;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail <?php if (!empty($settings->comment_logo_1)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                    <img src="<?php
                                                                                if (empty($settings->comment_logo_1)) {
                                                                                } else {
                                                                                    echo $settings->comment_logo_1;
                                                                                }
                                                                                ?>" height="100px" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?> </span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                        <input type="file" class="default" name="comment_logo_1" />
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h4> <label for="exampleInputEmail1"> <?php echo lang('section_2'); ?> </label></h4>
                                                        <hr>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question4" value='<?php
                                                                                                                                        if (!empty($settings->question4)) {
                                                                                                                                            echo $settings->question4;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer4" value='<?php
                                                                                                                                        if (!empty($settings->answer4)) {
                                                                                                                                            echo $settings->answer4;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_1'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question5" value='<?php
                                                                                                                                        if (!empty($settings->question5)) {
                                                                                                                                            echo $settings->question5;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_2'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer5" value='<?php
                                                                                                                                        if (!empty($settings->answer5)) {
                                                                                                                                            echo $settings->answer5;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail <?php if (!empty($settings->comment_logo_2)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                    <img src="<?php
                                                                                if (empty($settings->comment_logo_2)) {
                                                                                } else {
                                                                                    echo $settings->comment_logo_2;
                                                                                }
                                                                                ?>" height="100px" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i><?php echo lang('select_image'); ?> </span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i><?php echo lang('change'); ?> </span>
                                                                        <input type="file" class="default" name="comment_logo_2" />
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h4> <label for="exampleInputEmail1"> <?php echo lang('section_3'); ?> </label></h4>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question6" value='<?php
                                                                                                                                        if (!empty($settings->question6)) {
                                                                                                                                            echo $settings->question6;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer6" value='<?php
                                                                                                                                        if (!empty($settings->answer6)) {
                                                                                                                                            echo $settings->answer6;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_1'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question7" value='<?php
                                                                                                                                        if (!empty($settings->question7)) {
                                                                                                                                            echo $settings->question7;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_2'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer7" value='<?php
                                                                                                                                        if (!empty($settings->answer7)) {
                                                                                                                                            echo $settings->answer7;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_1)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                    <img src="<?php
                                                                                if (empty($settings->partner_image_1)) {
                                                                                } else {
                                                                                    echo $settings->partner_image_1;
                                                                                }
                                                                                ?>" height="100px" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?> </span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                        <input type="file" class="default" name="partner_image_1" />
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h4> <label for="exampleInputEmail1"> <?php echo lang('section_4'); ?> </label></h4>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question8" value='<?php
                                                                                                                                        if (!empty($settings->question8)) {
                                                                                                                                            echo $settings->question8;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer8" value='<?php
                                                                                                                                        if (!empty($settings->answer8)) {
                                                                                                                                            echo $settings->answer8;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_1'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="question9" value='<?php
                                                                                                                                        if (!empty($settings->question9)) {
                                                                                                                                            echo $settings->question9;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"> <?php echo lang('button_link_2'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="answer9" value='<?php
                                                                                                                                        if (!empty($settings->answer9)) {
                                                                                                                                            echo $settings->answer9;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_2)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                    <img src="<?php
                                                                                if (empty($settings->partner_image_2)) {
                                                                                } else {
                                                                                    echo $settings->partner_image_2;
                                                                                }
                                                                                ?>" height="100px" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                        <input type="file" class="default" name="partner_image_2" />
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>










                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                            </form>
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

<!-- <script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/frontend/settings.js"></script> -->
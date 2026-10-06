<!--sidebar end-->
<link href="common/extranal/css/superadmin/superadmin.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-shield mr-3 text-primary"></i>
                        <?php
                        if (!empty($superadmin->id))
                            echo lang('edit_superadmin');
                        else
                            echo lang('add_superadmin');
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php
                                                                                if (!empty($superadmin->id))
                                                                                    echo lang('edit_superadmin');
                                                                                else
                                                                                    echo lang('add_superadmin');
                                                                                ?></li>
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
                        <div class="card-body bg-light p-4">
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('feedback'); ?>

                            <form role="form" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                                <!-- Personal Information -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-user-circle mr-3 text-primary"></i> <?php echo lang('superadmin'); ?> <?php echo lang('details'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('name');
                                                                                                                                    }
                                                                                                                                    if (!empty($superadmin->name)) {
                                                                                                                                        echo $superadmin->name;
                                                                                                                                    }
                                                                                                                                    ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('email'); ?> <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('email');
                                                                                                                                    }
                                                                                                                                    if (!empty($superadmin->email)) {
                                                                                                                                        echo $superadmin->email;
                                                                                                                                    }
                                                                                                                                    ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('password'); ?> <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control form-control-lg shadow-sm" name="password" placeholder="********" <?php if (empty($superadmin->email)) {
                                                                                                                                                                echo 'required';
                                                                                                                                                            } ?>>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('address'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="address" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('address');
                                                                                                                                    }
                                                                                                                                    if (!empty($superadmin->address)) {
                                                                                                                                        echo $superadmin->address;
                                                                                                                                    }
                                                                                                                                    ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('phone'); ?> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-lg shadow-sm" name="phone" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('phone');
                                                                                                                                    }
                                                                                                                                    if (!empty($superadmin->phone)) {
                                                                                                                                        echo $superadmin->phone;
                                                                                                                                    }
                                                                                                                                    ?>' required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('profile'); ?> <?php echo lang('image'); ?></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php
                                                                if (!empty($superadmin->img_url)) {
                                                                    echo $superadmin->img_url;
                                                                }
                                                                ?>" height="100px" alt="" />
                                                </div>
                                                <div class="mt-3">
                                                    <span class="btn btn-white btn-file">
                                                        <span class=""><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                        <input type="file" class="default" name="img_url" />
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('module_permission'); ?></label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="home" value="home" name="module[]" <?php
                                                                                                                                            if (!empty($superadmin->id)) {
                                                                                                                                                $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                                                                                                                $modules1 = explode(',', $modules);
                                                                                                                                                if (in_array('home', $modules1)) {
                                                                                                                                                    echo 'checked';
                                                                                                                                                }
                                                                                                                                            } else {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                            ?>>
                                                <label class="custom-control-label" for="home"><?php echo lang('dashboard'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="hospital" value="hospital" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                                                                                                                        $modules1 = explode(',', $modules);
                                                                                                                                                        if (in_array('hospital', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="hospital"><?php echo lang('hospital'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="package" value="package" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        if (in_array('package', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="package"><?php echo lang('package'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="request" value="request" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        if (in_array('request', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="request"><?php echo lang('request'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="superadmin" value="superadmin" name="module[]" <?php
                                                                                                                                                        if (!empty($superadmin->id)) {
                                                                                                                                                            if (in_array('superadmin', $modules1)) {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            }
                                                                                                                                                        } else {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                        ?>>
                                                <label class="custom-control-label" for="superadmin"><?php echo lang('superadmin'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="email" value="email" name="module[]" <?php
                                                                                                                                                if (!empty($superadmin->id)) {
                                                                                                                                                    if (in_array('email', $modules1)) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                } else {
                                                                                                                                                    echo 'checked';
                                                                                                                                                }
                                                                                                                                                ?>>
                                                <label class="custom-control-label" for="email"><?php echo lang('email'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="pgateway" value="pgateway" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        if (in_array('pgateway', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="pgateway"><?php echo lang('payment_gateway'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="slide" value="slide" name="module[]" <?php
                                                                                                                                                if (!empty($superadmin->id)) {
                                                                                                                                                    if (in_array('slide', $modules1)) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                } else {
                                                                                                                                                    echo 'checked';
                                                                                                                                                }
                                                                                                                                                ?>>
                                                <label class="custom-control-label" for="slide"><?php echo lang('slides'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="service" value="service" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        if (in_array('service', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="service"><?php echo lang('service'); ?></label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="systems" value="systems" name="module[]" <?php
                                                                                                                                                    if (!empty($superadmin->id)) {
                                                                                                                                                        if (in_array('systems', $modules1)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } else {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                <label class="custom-control-label" for="systems"><?php echo lang('report'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($superadmin->id)) {
                                                                            echo $superadmin->id;
                                                                        }
                                                                        ?>'>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                            <i class="fas fa-user-plus mr-3"></i><?php echo lang('submit'); ?>
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

<!--main content end-->
<!--footer start-->
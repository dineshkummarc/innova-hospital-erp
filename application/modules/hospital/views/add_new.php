<link href="common/extranal/css/hospital/add_new.css" rel="stylesheet">



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1>
                        <strong>
                            <i class="fas fa-hospital mr-2"></i>
                            <?php
                            if (!empty($hospital->id)) {
                                echo lang('edit_hospital');
                            } else {
                                echo lang('add_new_hospital');
                            }
                            ?>
                        </strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($hospital->id)) {
                                                                echo lang('edit_hospital');
                                                            } else {
                                                                echo lang('add_new_hospital');
                                                            }
                                                            ?></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('ListofAllAppointments'); ?>Create a new hospital</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <?php echo validation_errors(); ?>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" id="addNewHospital" action="hospital/addNewHospital" method="post" enctype="multipart/form-data">

                                <div class="form-row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                        if (!empty($hospital->name)) {
                                                                                                                            echo $hospital->name;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('email'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                        if (!empty($hospital->email)) {
                                                                                                                            echo $hospital->email;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">


                                            <label for="exampleInputEmail1"> <?php echo lang('password'); ?> </label>
                                            <input type="password" class="form-control form-control-lg" name="password" placeholder="********">

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('frontend_website_link'); ?> &ast; </label>

                                            <input type="text" class="form-control form-control-lg" autocomplete="off" name="username" data-id="<?php
                                                                                                                                                if (!empty($hospital->id)) {
                                                                                                                                                    echo $hospital->id;
                                                                                                                                                }
                                                                                                                                                ?>" id="username" value='<?php
                                                                                                                                                            if (!empty($hospital->username)) {
                                                                                                                                                                echo $hospital->username;
                                                                                                                                                            }
                                                                                                                                                            ?>' placeholder="" required="">




                                        </div>
                                        <p id="web_link" class="pl-2"></p>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="address" value='<?php
                                                                                                                            if (!empty($hospital->address)) {
                                                                                                                                echo $hospital->address;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="phone" value='<?php
                                                                                                                        if (!empty($hospital->phone)) {
                                                                                                                            echo $hospital->phone;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">
                                        </div>

                                        <?php
                                        if (!empty($hospital->id)) {
                                            $this->db->where('hospital_id', $hospital->id);
                                            $settings = $this->db->get('settings')->row();
                                        }
                                        ?>

                                        <div class="form-group">

                                            <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                                            <select class="form-control col-sm-9 m-bot15" name="language" value=''>
                                                <option value="arabic" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'arabic') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('arabic'); ?>
                                                </option>
                                                <option value="english" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'english') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('english'); ?>
                                                </option>
                                                <option value="spanish" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'spanish') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('spanish'); ?>
                                                </option>
                                                <option value="french" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'french') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('french'); ?>
                                                </option>
                                                <option value="italian" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'italian') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('italian'); ?>
                                                </option>
                                                <option value="portuguese" <?php
                                                                            if (!empty($settings->language)) {
                                                                                if ($settings->language == 'portuguese') {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo lang('portuguese'); ?>
                                                </option>
                                                <option value="turkish" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'turkish') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('turkish'); ?>
                                                </option>
                                            </select>

                                        </div>




                                    </div>
                                    <?php if (empty($hospital->id)) { ?>
                                        <div class="col-md-6">

                                            <div class="form-group package_select_div d-flex">
                                                <label for="exampleInputEmail1"> <?php echo lang('package'); ?></label>
                                                <select class="form-control col-sm-9 js-example-basic-single pos_select" id="package_select" name="package" value='' required="">
                                                    <option value=""> - - - </option>
                                                    <!-- <option value="" <?php
                                                                            if (!empty($hospital->id)) {
                                                                                if (empty($hospital->package)) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo lang('select_manually'); ?></option>-->
                                                    <?php foreach ($packages as $package) { ?>
                                                        <option value="<?php echo $package->id; ?>" <?php
                                                                                                    if (!empty($setval)) {
                                                                                                        if ($package->name == set_value('package')) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    if (!empty($hospital->package)) {
                                                                                                        if ($package->id == $hospital->package) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>> <?php echo $package->name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('limit'); ?></label>
                                                <input type="text" class="form-control form-control-lg" id="p_limit" name="" value='' placeholder="" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('limit'); ?></label>
                                                <input type="text" class="form-control form-control-lg" id="d_limit" name="" value='' placeholder="" readonly="">
                                            </div>

                                            <div class="form-group col-md-12 row" id="modules_list">
                                                <label for="exampleInputEmail1"> <?php echo lang('permited_modules'); ?> </label>
                                            </div>








                                            <div class="form-group pos_client" style="display: none;">
                                                <label for="exampleInputEmail1"> <?php echo lang('module_permission'); ?></label>
                                                <br>
                                                <input type='checkbox' value="accountant" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                $modules = $this->hospital_model->getHospitalById($hospital->id)->module;
                                                                                                                $modules1 = explode(',', $modules);
                                                                                                                if (in_array('accountant', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('accountant'); ?>

                                                <br>
                                                <input type='checkbox' value="appointment" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('appointment', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('appointment'); ?>


                                                <br>
                                                <input type='checkbox' value="lab" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('lab', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('lab_tests'); ?>
                                                <br>
                                                <input type='checkbox' value="radiology" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('radiology', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('radiology'); ?>
                                                <br>
                                                <input type='checkbox' value="bed" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('bed', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('bed'); ?>

                                                <br>
                                                <input type='checkbox' value="department" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('department', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('department'); ?>

                                                <br>
                                                <input type='checkbox' value="doctor" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('doctor', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?> required=""> <?php echo lang('doctor'); ?>

                                                <br>
                                                <input type='checkbox' value="donor" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('donor', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('donor'); ?>

                                                <br>
                                                <input type='checkbox' value="finance" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('finance', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('financial_activities'); ?>

                                                <br>
                                                <input type='checkbox' value="pharmacy" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('pharmacy', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('pharmacy'); ?>

                                                <br>
                                                <input type='checkbox' value="laboratorist" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('laboratorist', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('laboratorist'); ?>

                                                <br>
                                                <input type='checkbox' value="medicine" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('medicine', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?> required=""> <?php echo lang('medicine'); ?>

                                                <br>
                                                <input type='checkbox' value="nurse" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('nurse', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('nurse'); ?>

                                                <br>
                                                <input type='checkbox' value="patient" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('patient', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?> required=""> <?php echo lang('patient'); ?>

                                                <br>
                                                <input type='checkbox' value="pharmacist" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('pharmacist', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?> required=""> <?php echo lang('pharmacist'); ?>

                                                <br>
                                                <input type='checkbox' value="prescription" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('prescription', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('prescription'); ?>

                                                <br>
                                                <input type='checkbox' value="receptionist" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('receptionist', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('receptionist'); ?>

                                                <br>
                                                <input type='checkbox' value="report" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('report', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('report'); ?>


                                                <br>
                                                <input type='checkbox' value="notice" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('notice', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('notice'); ?>


                                                <br>
                                                <input type='checkbox' value="email" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('email', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('email'); ?>

                                                <br>
                                                <input type='checkbox' value="sms" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('sms', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('sms'); ?>
                                                <br>
                                                <input type='checkbox' value="file" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('file', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('file'); ?>
                                                <br>
                                                <input type='checkbox' value="payroll" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('payroll', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('payroll'); ?>
                                                <br>
                                                <input type='checkbox' value="attendance" name="module[]" <?php
                                                                                                            if (!empty($hospital->id)) {
                                                                                                                if (in_array('attendance', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('attendance'); ?>
                                                <br>
                                                <input type='checkbox' value="leave" name="module[]" <?php
                                                                                                        if (!empty($hospital->id)) {
                                                                                                            if (in_array('leave', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('leave'); ?>
                                                <br>
                                                <input type='checkbox' value="chat" name="module[]" <?php
                                                                                                    if (!empty($hospital->id)) {
                                                                                                        if (in_array('chat', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('chat'); ?>

                                            </div>

                                        </div>
                                        <div class="form-group col-md-6 package_duration_div d-flex">
                                            <label for="exampleInputEmail1"> <?php echo lang('package_duration'); ?></label>
                                            <select class="form-control col-sm-9 m-bot15 js-example-basic-single" id="package_duration" name="package_duration" value=''>

                                                <option value="<?php echo 'monthly'; ?>" <?php
                                                                                            if (!empty($hospital)) {
                                                                                                if ($hospital->package_duration == 'monthly') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('monthly'); ?> </option>
                                                <option value="<?php echo 'yearly'; ?>" <?php
                                                                                        if (!empty($hospital)) {
                                                                                            if ($hospital->package_duration == 'yearly') {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>><?php echo lang('yearly'); ?> </option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                                            <input type="text" class="form-control col-sm-9 price-input" name="price" value='' placeholder="">
                                        </div>

                                    <?php } ?>
                                    <div class="form-group col-md-6 d-flex">
                                        <label for="exampleInputEmail1"> <?php echo lang('country'); ?></label>
                                        <select class="form-control col-sm-9 selectpicker countrypicker m-bot15" data-live-search="true" data-flag="true" <?php if (!empty($hospital->id)) { ?>data-default="<?php echo $hospital->country; ?>" <?php } else { ?> data-default="United States" <?php } ?> name="country">
                                        </select>
                                    </div>
                                    <div class="payment_div col-md-6">
                                        <?php if (empty($hospital->id)) { ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-sm-3" class=""><?php echo lang('deposit_type'); ?></label>
                                                <select class="form-control col-sm-9 m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                                </select>
                                            </div>

                                            <?php $payment_gateway = $settings->payment_gateway; ?>
                                            <div class="cardPayment row">
                                                <?php if ($payment_gateway == 'PayPal') {
                                                ?>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                                                        <select class="form-control col-sm-9  js-example-basic-single" id="" name="card_type" value=''>

                                                            <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                            <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                            <option value="American Express"> <?php echo lang('american_express'); ?> </option>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" name="cardholder" value='' placeholder="">
                                                    </div>

                                                <?php } ?>
                                                <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" id="card" name="card_number" value='' placeholder="">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?></label>
                                                        <input type="text" class="form-control form-control-lg" id="cvv" name="cvv_number" value="" placeholder="" maxlength="3">
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            <?php } ?>
                                            </div>

                                            <div id="token"></div>
                                    </div>
                                    <?php if (empty($hospital->id)) { ?>
                                        <div class="form-group col-dm-6 trial_version_div">
                                            <input type="checkbox" name="trial_version" value="1" class="trial_version">
                                            <label class="trial_msg col-sm-3" for="exampleInputEmail1"><?php echo lang('do_you_want_trial_version'); ?></label>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($hospital->id)) {
                                                                                echo $hospital->id;
                                                                            }
                                                                            ?>'>

                                    <div class="cashsubmit col-md-12 float-right">
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right submit_button"> <?php echo lang('submit'); ?></button>
                                    </div>
                                    <div class="col-md-12 cardsubmit d-none">
                                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row float-right submit_button" <?php
                                                                                                                                                if (empty($hospital->id)) {
                                                                                                                                                    if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                                ?>onClick="stripePay(event);" <?php
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                                ?>> <?php echo lang('submit'); ?></button>
                                    </div>



                                </div>


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


<?php
if (!empty($hospital->id)) {
    $hospital_id = $hospital->id;
    $hospital_package = $hospital->package;
} else {
    $hospital_id = " ";
    $hospital_package = " ";
}
?>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var hospital_id = "<?php echo $hospital_id; ?>";
</script>
<script type="text/javascript">
    var hospital_package = "<?php echo $hospital_package; ?>";
</script>
<script type="text/javascript">
    var gateway = "<?php echo $gateway->publish; ?>";
</script>
<script type="text/javascript">
    var permited_modules = "<?php echo lang('permited_modules'); ?>";
</script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="common/extranal/js/hospital/add_new.js"></script>



<script>
    $("#username").keyup(function() {
        $("#web_link").html("");
        var val = $("#username").val();
        var id = $(this).data("id");
        $.ajax({
            url: "hospital/checkIfUsernameAvailable?username=" + val + "&id=" + id,
            method: "GET",
            data: "",
            dataType: "json"

        }).done(function(response) {
            if (response.check == 1) {
                var url = base_url + 'site/' + val;
                var final_url = '<a target="_blank" href="' + url + '">' + url + '</a>';
                $("#web_link").html(final_url);
            } else {
                $("#web_link").html("This link is not available!");
            }
        });
    });

    $("#web_link").html("");
    var val = $("#username").val();
    var id = $(this).data("id");
    $.ajax({
        url: "hospital/checkIfUsernameAvailable?username=" + val + "&id=" + id,
        method: "GET",
        data: "",
        dataType: "json"

    }).done(function(response) {
        if (response.check == 1) {
            var url = base_url + 'site/' + val;
            var final_url = '<a target="_blank" href="' + url + '">' + url + '</a>';
            $("#web_link").html(final_url);
        } else {

        }
    });
</script>
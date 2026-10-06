<!--sidebar end-->
<!--main content start-->



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-box-open mr-2"></i>
                        <?php
                        if (!empty($package->id)) {
                            echo lang('edit_package');
                        } else {
                            echo lang('add_new_package');
                        }
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($package->id)) {
                                                                echo lang('edit_package');
                                                            } else {
                                                                echo lang('add_new_package');
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
                            <h3 class="card-title"><?php echo lang('Add new package by selecting modules and inserting other information'); ?></h3>
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
                            <form role="form" action="hospital/package/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('name'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                        if (!empty($package->name)) {
                                                                                                                            echo $package->name;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('limit'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="p_limit" value='<?php
                                                                                                                            if (!empty($package->p_limit)) {
                                                                                                                                echo $package->p_limit;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('limit'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="d_limit" value='<?php
                                                                                                                            if (!empty($package->d_limit)) {
                                                                                                                                echo $package->d_limit;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('monthly_price'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="monthly_price" value='<?php
                                                                                                                                if (!empty($package->monthly_price)) {
                                                                                                                                    echo $package->monthly_price;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('yearly_price'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="yearly_price" value='<?php
                                                                                                                                if (!empty($package->yearly_price)) {
                                                                                                                                    echo $package->yearly_price;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('show_in_frontend'); ?></label>
                                            <select class="form-control form-control-lg" name="show_in_frontend">
                                                <option value="Yes" <?php
                                                                    if (!empty($package->show_in_frontend)) {
                                                                        if ($package->show_in_frontend == 'Yes') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('yes'); ?></option>
                                                <option value="No" <?php
                                                                    if (!empty($package->show_in_frontend)) {
                                                                        if ($package->show_in_frontend == 'No') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('no'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('recommended'); ?></label>
                                            <select class="form-control form-control-lg" name="recommended">
                                                <option value="Yes" <?php
                                                                    if (!empty($package->recommended)) {
                                                                        if ($package->recommended == 'Yes') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('yes'); ?></option>
                                                <option value="No" <?php
                                                                    if (!empty($package->recommended)) {
                                                                        if ($package->recommended == 'No') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('no'); ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" name="set_as_default" value="1" class="" <?php
                                                                                                            if (!empty($package->set_as_default)) {
                                                                                                                if ($package->set_as_default == 1) {
                                                                                                                    echo 'checked=""';
                                                                                                                }
                                                                                                            }
                                                                                                            ?>>
                                            <label for="exampleInputEmail1"> <?php echo lang('set_as_default'); ?></label>
                                        </div>


                                    </div>

                                    <div class="">


                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class=""> <?php echo lang('module_permission'); ?></label>
                                            <br>
                                            <input type='checkbox' value="accountant" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            $modules = $this->package_model->getPackageById($package->id)->module;
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
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('appointment', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('appointment'); ?>

                                            <br>
                                            <input type='checkbox' value="lab" name="module[]" <?php
                                                                                                if (!empty($package->id)) {
                                                                                                    if (in_array('lab', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?>> <?php echo lang('lab_tests'); ?>
                                            <br>
                                            <input type='checkbox' value="bed" name="module[]" <?php
                                                                                                if (!empty($package->id)) {
                                                                                                    if (in_array('bed', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?>> <?php echo lang('bed'); ?>

                                            <br>
                                            <input type='checkbox' value="department" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('department', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('department'); ?>

                                            <br>
                                            <input type='checkbox' value="doctor" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('doctor', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?> required=""> <?php echo lang('doctor'); ?>

                                            <br>
                                            <input type='checkbox' value="donor" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('donor', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('donor'); ?>

                                            <br>
                                            <input type='checkbox' value="finance" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('finance', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('financial_activities'); ?>

                                            <br>
                                            <input type='checkbox' value="pharmacy" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('pharmacy', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('pharmacy'); ?>

                                            <br>
                                            <input type='checkbox' value="laboratorist" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('laboratorist', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('laboratorist'); ?>

                                            <br>
                                            <input type='checkbox' value="medicine" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('medicine', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?> required=""> <?php echo lang('medicine'); ?>

                                            <br>
                                            <input type='checkbox' value="nurse" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('nurse', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('nurse'); ?>

                                            <br>
                                            <input type='checkbox' value="patient" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('patient', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?> required=""> <?php echo lang('patient'); ?>

                                            <br>
                                            <input type='checkbox' value="pharmacist" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('pharmacist', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?> required=""> <?php echo lang('pharmacist'); ?>

                                            <br>
                                            <input type='checkbox' value="prescription" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('prescription', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('prescription'); ?>

                                            <br>
                                            <input type='checkbox' value="receptionist" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('receptionist', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('receptionist'); ?>

                                            <br>
                                            <input type='checkbox' value="report" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('report', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('report'); ?>


                                            <br>
                                            <input type='checkbox' value="notice" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('notice', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('notice'); ?>


                                            <br>
                                            <input type='checkbox' value="email" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('email', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?> required=""> <?php echo lang('email'); ?>


                                            <br>
                                            <input type='checkbox' value="sms" name="module[]" <?php
                                                                                                if (!empty($package->id)) {
                                                                                                    if (in_array('sms', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?> required=""> <?php echo lang('sms'); ?>
                                            <br>
                                            <input type='checkbox' value="file" name="module[]" <?php
                                                                                                if (!empty($package->id)) {
                                                                                                    if (in_array('file', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?>> <?php echo lang('file'); ?>
                                            <br>
                                            <input type='checkbox' value="payroll" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('payroll', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('payroll'); ?>
                                            <br>
                                            <input type='checkbox' value="attendance" name="module[]" <?php
                                                                                                        if (!empty($package->id)) {
                                                                                                            if (in_array('attendance', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('attendance'); ?>
                                            <br>
                                            <input type='checkbox' value="leave" name="module[]" <?php
                                                                                                    if (!empty($package->id)) {
                                                                                                        if (in_array('leave', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('leave'); ?>
                                            <br>
                                            <input type='checkbox' value="chat" name="module[]" <?php
                                                                                                if (!empty($package->id)) {
                                                                                                    if (in_array('chat', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?>> <?php echo lang('chat'); ?>




                                        </div>


                                    </div>


                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($package->id)) {
                                                                                echo $package->id;
                                                                            }
                                                                            ?>'>
                                    <div class="form-group col-md-12">
                                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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
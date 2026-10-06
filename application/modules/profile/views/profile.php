<style type="text/css">
    .img_thumb,
    .img_class {
        height: 150px;
        width: 150px;
    }
</style>

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-cog mr-2"></i><?php echo lang('manage_profile'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('profile'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="">
                                <div class="clearfix">
                                    <?php echo validation_errors(); ?>
                                    <?php if (!$this->ion_auth->in_group(array('Patient', 'Doctor', 'superadmin', 'admin'))) {

                                        $ion_user_id = $this->ion_auth->get_user_id();
                                        $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
                                        $group_name = $this->profile_model->getGroups($group_id)->row()->name;
                                        $group_name = strtolower($group_name);
                                        $details = $this->profile_model->getUserDetails($ion_user_id, $group_name);

                                    ?>
                                        <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                                <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                            if (!empty($profile->username)) {
                                                                                                                                echo $profile->username;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('change_password'); ?></label>
                                                <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                                                <input type="text" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                            if (!empty($profile->email)) {
                                                                                                                                echo $profile->email;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" <?php
                                                                                                                                if (!empty($profile->username)) {
                                                                                                                                    echo $profile->username;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                            </div>

                                            <div class="form-group last col-md-6">
                                                <label class="control-label"><?php echo lang('profile'); ?> <?php echo lang('image'); ?> </label>
                                                <div class="">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                            <img src="<?php if (!empty($details->img_url)) {
                                                                            echo $details->img_url;
                                                                        } ?>" id="img" height="100px" alt="" />
                                                        </div>
                                                        <div>
                                                            <span class="btn btn-white btn-file">
                                                                <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                                <input type="file" class="default" name="img_url" />
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <input type="hidden" name="id" value='<?php
                                                                                    if (!empty($profile->id)) {
                                                                                        echo $profile->id;
                                                                                    }
                                                                                    ?>'>
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                            </div>
                                        </form>
                                    <?php } else { ?>

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="general_info-tab" data-toggle="tab" href="#general_info" role="tab" aria-controls="general_info" aria-selected="true"><?php echo lang('general_info'); ?></a>
                                            </li>
                                            <?php if (!$this->ion_auth->in_group(array('superadmin', 'admin'))) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="email_notification-tab" data-toggle="tab" href="#email_notification" role="tab" aria-controls="email_notification" aria-selected="false"><?php echo lang('email_confirmation_during_appointment'); ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>


                                        <div class="card pt-4">
                                            <div class="tab-content col-md-12">
                                                <div id="general_info" class="tab-pane active">
                                                    <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                                            <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                                        if (!empty($profile->username)) {
                                                                                                                                            echo $profile->username;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> <?php echo lang('change_password'); ?></label>
                                                            <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                                                            <input type="text" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                                        if (!empty($profile->email)) {
                                                                                                                                            echo $profile->email;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" <?php
                                                                                                                                            if (!empty($profile->username)) {
                                                                                                                                                echo $profile->username;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                                        </div>

                                                        <?php
                                                        if (!$this->ion_auth->in_group(array('superadmin', 'admin'))) {
                                                            $current_user_id = $this->ion_auth->user()->row()->id;
                                                            $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                                                            $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                                                            $group_name = strtolower($group_name);
                                                            $user_language = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->language;
                                                        }
                                                        ?>



                                                        <?php if (!$this->ion_auth->in_group(array('superadmin', 'admin'))) { ?>


                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>
                                                                <select class="form-control col-sm-9 js-example-basic-single" name="language">
                                                                    <option value=""> </option>
                                                                    <option value="arabic" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'arabic') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('arabic'); ?>
                                                                    </option>


                                                                    <option value="english" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'english') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('english'); ?>
                                                                    </option>

                                                                    <option value="spanish" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'spanish') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('spanish'); ?>
                                                                    </option>
                                                                    <option value="french" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'french') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('french'); ?>
                                                                    </option>
                                                                    <option value="italian" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'italian') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('italian'); ?>
                                                                    </option>
                                                                    <option value="portuguese" <?php
                                                                                                if (!empty($user_language)) {
                                                                                                    if ($user_language == 'portuguese') {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>><?php echo lang('portuguese'); ?>
                                                                    </option>

                                                                    <option value="turkish" <?php
                                                                                            if (!empty($user_language)) {
                                                                                                if ($user_language == 'turkish') {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo lang('turkish'); ?>
                                                                    </option>




                                                                </select>
                                                            </div>


                                                        <?php } ?>




                                                        <?php
                                                        $ion_user = $this->ion_auth->get_user_id();
                                                        if ($this->ion_auth->in_group(array('Patient'))) {
                                                            $img_url = $this->db->get_where('patient', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                                        }
                                                        if ($this->ion_auth->in_group(array('Doctor'))) {
                                                            $img_url = $this->db->get_where('doctor', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                                        }
                                                        if ($this->ion_auth->in_group(array('superadmin'))) {
                                                            $img_url = $this->db->get_where('superadmin', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
                                                        }
                                                        if ($this->ion_auth->in_group(array('admin'))) {
                                                            $img_url = $this->db->get_where('users', array('id' => $this->ion_auth->get_user_id()))->row();
                                                        }
                                                        ?>



                                                        <div class="form-group">
                                                            <label class="col-sm-3"><?php echo lang('image'); ?> </label>
                                                            <div class="col-sm-9">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                                        <img src="<?php if (!empty($img_url->img_url)) {
                                                                                        echo $img_url->img_url;
                                                                                    } ?>" id="img" height="100px" alt="" />
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                                            <input type="file" class="default" name="img_url" />
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>





                                                        <input type="hidden" name="id" value='<?php
                                                                                                if (!empty($profile->id)) {
                                                                                                    echo $profile->id;
                                                                                                }
                                                                                                ?>'>
                                                        <div class="form-group">
                                                            <button type="submit" name="submit" class="btn btn-info float-right m-5"><?php echo lang('submit'); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php if (!$this->ion_auth->in_group(array('superadmin', 'admin'))) { ?>
                                                    <div id="email_notification" class="tab-pane">
                                                        <table class="table table-bordered table-hover" id="editable-sample">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th><?php echo lang('email_type'); ?></th>
                                                                    <th><?php echo lang('status'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
                                                                    <tr>
                                                                        <td> <?php echo lang('appointment') ?> <?php echo lang('creation') ?></td>
                                                                        <td>
                                                                            <select name="appointment_creation" id="appointment_creation" class="form-control col-sm-9 patient_email">
                                                                                <option value="Active" <?php if (!empty($img_url->appointment_creation == 'Active')) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo lang('active'); ?></option>
                                                                                <option value="Inactive" <?php if (!empty($img_url->appointment_creation == 'Inactive')) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> <?php echo lang('appointment') ?> <?php echo lang('confirmation') ?></td>
                                                                        <td>
                                                                            <select name="appointment_confirmation" id="appointment_confirmation" class="form-control col-sm-9 patient_email">
                                                                                <option value="Active" <?php if (!empty($img_url->appointment_confirmation == 'Active')) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo lang('active'); ?></option>
                                                                                <option value="Inactive" <?php if (!empty($img_url->appointment_confirmation == 'Inactive')) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> <?php echo lang('payment') ?> <?php echo lang('confirmation') ?></td>
                                                                        <td>
                                                                            <select name="payment_confirmation" id="payment_confirmation" class="form-control col-sm-9 patient_email">
                                                                                <option value="Active" <?php if (!empty($img_url->payment_confirmation == 'Active')) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo lang('active'); ?></option>
                                                                                <option value="Inactive" <?php if (!empty($img_url->payment_confirmation == 'Inactive')) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> <?php echo lang('meeting_schedule') ?></td>
                                                                        <td>
                                                                            <select name="meeting_schedule" id="meeting_schedule" class="form-control col-sm-9 patient_email">
                                                                                <option value="Active" <?php if (!empty($img_url->meeting_schedule == 'Active')) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo lang('active'); ?></option>
                                                                                <option value="Inactive" <?php if (!empty($img_url->meeting_schedule == 'Inactive')) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <input type="hidden" value="<?php echo $img_url->id; ?>" name="patient_id" id="patient_id">
                                                                <?php } else { ?>

                                                                    <tr>
                                                                        <td> <?php echo lang('appointment') ?> <?php echo lang('confirmation') ?></td>
                                                                        <td>
                                                                            <select name="appointment_confirmation" id="doctor_appointment_confirmation" class="form-control col-sm-9 doctor_email">
                                                                                <option value="Active" <?php if (!empty($img_url->appointment_confirmation == 'Active')) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo lang('active'); ?></option>
                                                                                <option value="Inactive" <?php if (!empty($img_url->appointment_confirmation == 'Inactive')) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo lang('inactive'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <input type="hidden" value="<?php echo $img_url->id; ?>" name="doctor_id" id="doctor_id">
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="email_notification" class="tab-pane">

                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
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












<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/profile.js"></script>
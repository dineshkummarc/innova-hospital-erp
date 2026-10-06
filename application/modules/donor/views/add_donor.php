<!--sidebar end-->
<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-plus mr-2"></i><?php
                                                                                        if (!empty($donor->id))
                                                                                            echo lang('add_donor');
                                                                                        else
                                                                                            echo lang('add_new_donor');
                                                                                        ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($donor->id))
                                                                echo lang('add_donor');
                                                            else
                                                                echo lang('add_new_donor');
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title mb-0"><?php echo lang('donor') ?> <?php echo lang('registration') ?></h3>
                        </div>
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="donor/addDonor" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('name');
                                                                                                        }
                                                                                                        if (!empty($donor->name)) {
                                                                                                            echo $donor->name;
                                                                                                        }
                                                                                                        ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('blood_group'); ?></label>
                                            <select class="form-control" name="group">
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                                    if (!empty($setval) && $group->group == set_value('group')) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    if (!empty($donor->group) && $group->group == $donor->group) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    ?>><?php echo $group->group; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('age'); ?> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="age" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('age');
                                                                                                        }
                                                                                                        if (!empty($donor->age)) {
                                                                                                            echo $donor->age;
                                                                                                        }
                                                                                                        ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('sex'); ?></label>
                                            <select class="form-control" name="sex">
                                                <option value="Male" <?php
                                                                        if (!empty($setval) && set_value('sex') == 'Male') {
                                                                            echo 'selected';
                                                                        }
                                                                        if (!empty($donor->sex) && $donor->sex == 'Male') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>Male</option>
                                                <option value="Female" <?php
                                                                        if (!empty($setval) && set_value('sex') == 'Female') {
                                                                            echo 'selected';
                                                                        }
                                                                        if (!empty($donor->sex) && $donor->sex == 'Female') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo lang('last_donation_date'); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-lg default-date-picker readonly" type="text" name="ldd" value="<?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('ldd');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($donor->ldd)) {
                                                                                                                                                        echo $donor->ldd;
                                                                                                                                                    }
                                                                                                                                                    ?>" required autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('phone'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('phone');
                                                                                                        }
                                                                                                        if (!empty($donor->phone)) {
                                                                                                            echo $donor->phone;
                                                                                                        }
                                                                                                        ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('email'); ?> <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('email');
                                                                                                            }
                                                                                                            if (!empty($donor->email)) {
                                                                                                                echo $donor->email;
                                                                                                            }
                                                                                                            ?>' required>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($donor->id)) {
                                                                            echo $donor->id;
                                                                        }
                                                                        ?>'>

                                <div class="text-right mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary px-4"><?php echo lang('submit'); ?></button>
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
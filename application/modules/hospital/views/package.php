<link href="common/extranal/css/hospital/package.css" rel="stylesheet">




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-box-open mr-2"></i><?php echo lang('all_packages') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('all_packages') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the department names and related informations'); ?></h3>
                            <div class="float-right">
                                <a href="hospital/package/addNewView">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new_package'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('package'); ?> <?php echo lang('name'); ?></th>
                                        <th> <?php echo lang('patient'); ?> <?php echo lang('limit'); ?></th>
                                        <th> <?php echo lang('doctor'); ?> <?php echo lang('limit'); ?></th>
                                        <th> <?php echo lang('permitted_modules'); ?></th>
                                        <th> <?php echo lang('restricted_modules'); ?></th>
                                        <th> <?php echo lang('monthly_price'); ?></th>
                                        <th> <?php echo lang('yearly_price'); ?></th>
                                        <th class="no-print"> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                    foreach ($packages as $package) {
                                    ?>
                                        <tr class="">
                                            <td> <?php echo $package->name; ?></td>
                                            <td><?php echo $package->p_limit; ?></td>
                                            <td class="center"><?php echo $package->d_limit; ?></td>
                                            <td class="center td_style"><?php
                                                                        $modules = explode(',', $package->module);
                                                                        foreach ($modules as $key => $value) {
                                                                            echo $value . '<br>';
                                                                        }
                                                                        ?></td>
                                            <td class="center td_style">
                                                <?php
                                                $all_modules = array('accountant', 'appointment', 'lab', 'bed', 'department', 'doctor', 'donor', 'finance', 'pharmacy', 'laboratorist', 'medicine', 'nurse', 'patient', 'pharmacist', 'prescription', 'receptionist', 'report', 'sms', 'notice', 'email');
                                                $restricted_modules = array_diff($all_modules, $modules);
                                                foreach ($restricted_modules as $key1 => $value1) {
                                                    echo $value1 . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td class="center td_style">
                                                <?php
                                                echo $settings->currency . ' ' . $package->monthly_price;
                                                ?>
                                            </td>
                                            <td class="center td_style">
                                                <?php
                                                echo $settings->currency . ' ' . $package->yearly_price;
                                                ?>
                                            </td>
                                            <td class="no-print d-flex gap-1">
                                                <a type="button" class="btn btn-primary btn-sm btn_width" data-toggle="" href="hospital/package/editPackage?id=<?php echo $package->id; ?>" data-id="<?php echo $package->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm btn_width delete_button" href="hospital/package/delete?id=<?php echo $package->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
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






<!-- Add Event Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('create_new_package'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="package/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="phone" value='' placeholder="">
                    </div>

                    <div class="form-group">

                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                        <select class="form-control form-control-lg m-bot15" name="language" value=''>
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
                        </select>

                    </div>


                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"><i class="fa fa-edit"></i> <?php echo lang('edit_package'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPackageForm" action="package/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="********">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="phone" value='' placeholder="">
                    </div>

                    <div class="form-group">

                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                        <select class="form-control form-control-lg m-bot15" name="language" value=''>
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
                        </select>

                    </div>

                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/hospital/package.js"></script>
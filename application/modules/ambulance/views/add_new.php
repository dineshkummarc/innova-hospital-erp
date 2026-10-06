<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-ambulance text-primary mr-3"></i>
                        <?php echo lang('add_new'); ?> <?php echo lang('ambulance'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-ambulance mr-2"></i>
                                <?php echo lang('ambulance'); ?> <?php echo lang('information'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <form role="form" action="ambulance/addNew" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehicle_number" class="control-label"><?php echo lang('vehicle_number'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" value="<?php if (!empty($setval)) echo $vehicle_number; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="driver_name" class="control-label"><?php echo lang('driver_name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="driver_name" id="driver_name" value="<?php if (!empty($setval)) echo $driver_name; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="driver_phone" class="control-label"><?php echo lang('driver_phone'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="driver_phone" id="driver_phone" value="<?php if (!empty($setval)) echo $driver_phone; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ambulance_type" class="control-label"><?php echo lang('ambulance_type'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="ambulance_type" id="ambulance_type" required>
                                                <option value="">Select Ambulance Type</option>
                                                <option value="Basic" <?php if (!empty($setval) && $ambulance_type == 'Basic') echo 'selected'; ?>>Basic Life Support</option>
                                                <option value="Advanced" <?php if (!empty($setval) && $ambulance_type == 'Advanced') echo 'selected'; ?>>Advanced Life Support</option>
                                                <option value="Critical Care" <?php if (!empty($setval) && $ambulance_type == 'Critical Care') echo 'selected'; ?>>Critical Care</option>
                                                <option value="Neonatal" <?php if (!empty($setval) && $ambulance_type == 'Neonatal') echo 'selected'; ?>>Neonatal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="control-label"><?php echo lang('status'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">Select Status</option>
                                                <option value="Available" <?php if (!empty($setval) && $status == 'Available') echo 'selected'; ?>>Available</option>
                                                <option value="On Call" <?php if (!empty($setval) && $status == 'On Call') echo 'selected'; ?>>On Call</option>
                                                <option value="Maintenance" <?php if (!empty($setval) && $status == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fa fa-save mr-2"></i>
                                        <?php echo lang('save'); ?>
                                    </button>
                                    <a href="ambulance" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fa fa-times mr-2"></i>
                                        <?php echo lang('cancel'); ?>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

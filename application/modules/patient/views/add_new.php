<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/patient/add_new.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-plus mr-3 text-primary"></i>
                        <?php echo lang('new_patient_registration'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="patient" class="text-primary"><?php echo lang('patients'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('new_registration'); ?></li>
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
                        <div class="card-header bg-gradient-primary py-4">
                            <h2 class="card-title mb-0 text-white display-6 font-weight-800"><?php echo lang('patient_enrollment_form'); ?></h2>
                        </div>
                        <div class="card-body bg-light p-4 p-md-5">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle mr-2"></i>', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
                            <form role="form" action="patient/addNew" method="post" id="patientRegistrationForm">

                                <!-- Patient Information -->
                                <div class="row mb-4">
                                    <div class="col-12 mb-3">
                                        <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-user-circle mr-3 text-primary"></i>Patient Information
                                        </h3>
                                    </div>
                                </div>

                                <!-- Row 1: Patient Full Name * | Phone Number * -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Patient Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" value="<?php echo set_value('name'); ?>" placeholder="Enter patient's full name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control form-control-lg shadow-sm" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="01XXXXXXXXX" pattern="^(?:\+?880|880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladesh mobile number (e.g. 01XXXXXXXXX)" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Age | Gender | Weight (kg) -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Age</label>
                                            <input type="number" class="form-control form-control-lg shadow-sm" name="age" value="<?php echo set_value('age'); ?>" min="0" max="150" placeholder="Enter age">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Gender</label>
                                            <select class="form-control form-control-lg shadow-sm" name="sex">
                                                <option value="">Select Gender</option>
                                                <option value="Male" <?php if (set_value('sex') == 'Male') echo 'selected'; ?>><?php echo lang('male'); ?></option>
                                                <option value="Female" <?php if (set_value('sex') == 'Female') echo 'selected'; ?>><?php echo lang('female'); ?></option>
                                                <option value="Other" <?php if (set_value('sex') == 'Other') echo 'selected'; ?>><?php echo lang('other'); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Weight (kg)</label>
                                            <input type="number" step="any" min="0" class="form-control form-control-lg shadow-sm" name="weight" value="<?php echo set_value('weight'); ?>" placeholder="Enter weight in kg">
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Contact Address -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted">Contact Address</label>
                                            <textarea class="form-control shadow-sm" name="address" rows="3" placeholder="Enter contact address"><?php echo set_value('address'); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bottom: Register Patient Button -->
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3 font-weight-bold">
                                            <i class="fas fa-user-plus mr-3"></i>Register Patient
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
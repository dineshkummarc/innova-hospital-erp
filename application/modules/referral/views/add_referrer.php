<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-plus text-primary mr-3"></i>
                        <?php echo !empty($referrer->id) ? lang('edit') . ' ' . lang('referrer') : lang('add_new_referrer'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="referral"><?php echo lang('referrers'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo !empty($referrer->id) ? lang('edit') : lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="referral" class="btn btn-secondary btn-sm px-4 py-3">
                        <i class="fa fa-arrow-left mr-1"></i> Back to Referrers
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h4 class="card-title text-white font-weight-bold mb-0">
                                <?php echo !empty($referrer->id) ? 'Update Referrer Details' : 'New Referrer Information'; ?>
                            </h4>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="referral/addNew" method="post" enctype="multipart/form-data">

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Full Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="name" value="<?php echo !empty($referrer->name) ? html_escape($referrer->name) : set_value('name'); ?>" placeholder="Enter referrer full name" required minlength="2" maxlength="100">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Phone Number <span class="text-danger">*</span>
                                            </label>
                                            <input type="tel" class="form-control form-control-lg" name="phone" value="<?php echo !empty($referrer->phone) ? html_escape($referrer->phone) : set_value('phone'); ?>" placeholder="01XXXXXXXXX" required>
                                            <small class="text-muted">Must be a valid Bangladesh mobile number.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Email Address
                                            </label>
                                            <input type="email" class="form-control form-control-lg" name="email" value="<?php echo !empty($referrer->email) ? html_escape($referrer->email) : set_value('email'); ?>" placeholder="name@domain.com">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Referrer Type <span class="text-danger">*</span>
                                            </label>
                                            <?php 
                                            $curr_type = !empty($referrer->type) ? $referrer->type : set_value('type', 'Doctor');
                                            $types = array('Doctor', 'Hospital', 'Clinic', 'Diagnostic Center', 'Agent', 'Other');
                                            ?>
                                            <select class="form-control form-control-lg" name="type" required>
                                                <?php foreach ($types as $t) { ?>
                                                    <option value="<?php echo $t; ?>" <?php if ($curr_type == $t) echo 'selected'; ?>>
                                                        <?php echo $t; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Status <span class="text-danger">*</span>
                                            </label>
                                            <?php $curr_status = !empty($referrer->status) ? $referrer->status : set_value('status', 'Active'); ?>
                                            <select class="form-control form-control-lg" name="status" required>
                                                <option value="Active" <?php if ($curr_status == 'Active') echo 'selected'; ?>>Active</option>
                                                <option value="Inactive" <?php if ($curr_status == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark text-uppercase small">
                                                Contact Address
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="address" value="<?php echo !empty($referrer->address) ? html_escape($referrer->address) : set_value('address'); ?>" placeholder="Clinic/Chamber/Street Address">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark text-uppercase small">
                                        Additional Notes
                                    </label>
                                    <textarea class="form-control" name="notes" rows="3" placeholder="Optional internal notes or remarks..."><?php echo !empty($referrer->notes) ? html_escape($referrer->notes) : set_value('notes'); ?></textarea>
                                </div>

                                <input type="hidden" name="id" value="<?php echo !empty($referrer->id) ? $referrer->id : ''; ?>">

                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-sm">
                                    <i class="fas fa-check-circle mr-2"></i> <?php echo !empty($referrer->id) ? 'Save Changes' : 'Create Referrer'; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

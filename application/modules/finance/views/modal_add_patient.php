<!-- Modal: Add New Patient -->
<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-light py-2 px-3 border-bottom align-items-center">
                <h5 class="modal-title h6 font-weight-bold text-dark mb-0" id="patientModalLabel">
                    <i class="fas fa-user-plus text-primary mr-2"></i><?php echo lang('add_new'); ?> <?php echo lang('patient'); ?>
                </h5>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-danger d-none py-2 px-3 small font-weight-bold" id="patient_modal_error" role="alert"></div>

                <form id="formAddNewPatientModal" autocomplete="off" onsubmit="return false;">
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('patient'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_p_name" name="modal_p_name" placeholder="Enter patient's full name" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('phone'); ?> <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control form-control-sm shadow-sm" id="modal_p_phone" name="modal_p_phone" placeholder="01XXXXXXXXX" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('age'); ?>
                            </label>
                            <input type="number" min="0" max="150" class="form-control form-control-sm shadow-sm" id="modal_p_age" name="modal_p_age" placeholder="Age in years">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('gender'); ?>
                            </label>
                            <select class="form-control form-control-sm shadow-sm" id="modal_p_gender" name="modal_p_gender">
                                <option value=""><?php echo lang('select_gender'); ?></option>
                                <option value="Male"><?php echo lang('male'); ?></option>
                                <option value="Female"><?php echo lang('female'); ?></option>
                                <option value="Other"><?php echo lang('other'); ?></option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('weight'); ?> (kg)
                            </label>
                            <input type="number" step="0.1" min="0" max="500" class="form-control form-control-sm shadow-sm" id="modal_p_weight" name="modal_p_weight" placeholder="kg">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-1">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('address'); ?>
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_p_address" name="modal_p_address" placeholder="Contact Address / Village, Thana">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2 px-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="button" class="btn btn-sm btn-primary px-3 shadow-sm font-weight-bold" id="btn_modal_save_patient">
                    <i class="fas fa-check mr-1"></i><?php echo lang('save'); ?> <?php echo lang('patient'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

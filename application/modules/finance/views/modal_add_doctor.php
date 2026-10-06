<!-- Modal: Add New Doctor -->
<div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-labelledby="doctorModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-light py-2 px-3 border-bottom align-items-center">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title h6 font-weight-bold text-dark mb-0" id="doctorModalLabel">
                        <i class="fas fa-user-md text-success mr-2"></i><?php echo lang('add_new'); ?> <?php echo lang('doctor'); ?>
                    </h5>
                    <span class="badge badge-success ml-2 font-weight-normal py-1 px-2"><i class="fas fa-check-circle mr-1"></i>Active</span>
                </div>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-danger d-none py-2 px-3 small font-weight-bold" id="doctor_modal_error" role="alert"></div>

                <form id="formAddNewDoctorModal" autocomplete="off" onsubmit="return false;">
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('doctor'); ?> <?php echo lang('name'); ?> (Bangla/Primary) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_doc_name" name="modal_doc_name" placeholder="e.g. ডাঃ মোঃ আব্দুর রহিম" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                English Name (Optional)
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_doc_name_en" name="modal_doc_name_en" placeholder="e.g. Dr. Md. Abdur Rahim">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('phone'); ?> <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control form-control-sm shadow-sm" id="modal_doc_phone" name="modal_doc_phone" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                Specialty / Department
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_doc_department" name="modal_doc_department" placeholder="e.g. Medicine & Cardiology">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                Qualification & Degrees
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_doc_profile" name="modal_doc_profile" placeholder="e.g. MBBS, BCS (Health), FCPS">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                Chamber / Institution Address
                            </label>
                            <input type="text" class="form-control form-control-sm shadow-sm" id="modal_doc_address" name="modal_doc_address" placeholder="e.g. Lifecare Diagnostic Center, Room 102">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2 px-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="button" class="btn btn-sm btn-success px-3 shadow-sm font-weight-bold" id="btn_modal_save_doctor">
                    <i class="fas fa-check mr-1"></i><?php echo lang('save'); ?> <?php echo lang('doctor'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

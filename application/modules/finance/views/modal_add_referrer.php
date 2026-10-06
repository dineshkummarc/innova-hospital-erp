<!-- Modal: Add New Referrer -->
<div class="modal fade" id="referrerModal" tabindex="-1" role="dialog" aria-labelledby="referrerModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-light py-2 px-3 border-bottom align-items-center">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title h6 font-weight-bold text-dark mb-0" id="referrerModalLabel">
                        <i class="fas fa-hands-helping text-info mr-2"></i><?php echo lang('add_new'); ?> <?php echo lang('referrer'); ?>
                    </h5>
                    <span class="badge badge-info ml-2 font-weight-normal py-1 px-2"><i class="fas fa-shield-alt mr-1"></i>Active</span>
                </div>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-danger d-none py-2 px-3 small font-weight-bold" id="referrer_modal_error" role="alert"></div>

                <form id="formAddNewReferrerModal" autocomplete="off" onsubmit="return false;">
                    <div class="form-group mb-2">
                        <label class="text-uppercase font-weight-bold text-muted small mb-1">
                            <?php echo lang('referrer'); ?> Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm shadow-sm" id="modal_ref_name" name="modal_ref_name" placeholder="e.g. Dr. Jane Smith or Agent Kabir" required>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                <?php echo lang('phone'); ?> <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control form-control-sm shadow-sm" id="modal_ref_phone" name="modal_ref_phone" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="text-uppercase font-weight-bold text-muted small mb-1">
                                Referrer Category / Type
                            </label>
                            <select class="form-control form-control-sm shadow-sm" id="modal_ref_type" name="modal_ref_type">
                                <option value="Doctor" selected>Doctor</option>
                                <option value="Hospital/Clinic">Hospital/Clinic</option>
                                <option value="Agent/Broker">Agent/Broker</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Staff">Staff</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-uppercase font-weight-bold text-muted small mb-1">
                            <?php echo lang('address'); ?> (Optional)
                        </label>
                        <input type="text" class="form-control form-control-sm shadow-sm" id="modal_ref_address" name="modal_ref_address" placeholder="e.g. Khaserhat, Charbata">
                    </div>
                    <div class="form-group mb-1">
                        <label class="text-uppercase font-weight-bold text-muted small mb-1">
                            Notes / Remarks (Optional)
                        </label>
                        <textarea class="form-control form-control-sm shadow-sm" id="modal_ref_notes" name="modal_ref_notes" rows="2" placeholder="Optional notes..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2 px-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="button" class="btn btn-sm btn-info px-3 shadow-sm font-weight-bold" id="btn_modal_save_referrer">
                    <i class="fas fa-check mr-1"></i><?php echo lang('save'); ?> <?php echo lang('referrer'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

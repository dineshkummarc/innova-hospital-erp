<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-percentage text-primary mr-3"></i>
                        <?php echo lang('commission_rules'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="referral"><?php echo lang('referral_management'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('commission_rules'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="finance/addPaymentCategoryView" class="btn btn-primary btn-sm px-4 py-3 shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> <?php echo lang('create_invoice_items_lab_tests'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold mb-0 text-dark">
                                <i class="fas fa-sliders-h mr-2 text-primary"></i> Lab Test & Item Referral Commission Rates (%)
                            </h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <div class="alert alert-info border-0 shadow-sm mb-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Rate Snapshot Rule:</strong> Commission rates configured here apply to new invoices. When an invoice is generated, the item's commission rate is snapshotted permanently into the invoice record and will not be altered by future rate adjustments.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover datatables" id="editable-sample" width="100%">
                                    <thead>
                                        <tr class="bg-light text-uppercase">
                                            <th>ID</th>
                                            <th>Item / Lab Test Name</th>
                                            <th>Code</th>
                                            <th>Price (<?php echo $settings->currency; ?>)</th>
                                            <th>Doctor Commission (%)</th>
                                            <th>Referral Commission (%)</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($categories)) {
                                            foreach ($categories as $cat) { ?>
                                                <tr id="row-<?php echo $cat->id; ?>">
                                                    <td>#<?php echo $cat->id; ?></td>
                                                    <td class="font-weight-bold"><?php echo html_escape($cat->category); ?></td>
                                                    <td><code><?php echo html_escape($cat->code); ?></code></td>
                                                    <td class="font-weight-bold"><?php echo $settings->currency . ' ' . number_format($cat->c_price, 2); ?></td>
                                                    <td><span class="badge badge-secondary px-2 py-1"><?php echo floatval($cat->d_commission); ?>%</span></td>
                                                    <td>
                                                        <span class="badge badge-success px-3 py-1 font-weight-bold current-rate-badge" id="rate-badge-<?php echo $cat->id; ?>" style="font-size: 0.95rem;">
                                                            <?php echo floatval($cat->r_commission); ?>%
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary btn-sm btn-edit-rate" data-id="<?php echo $cat->id; ?>" data-name="<?php echo html_escape($cat->category); ?>" data-rate="<?php echo floatval($cat->r_commission); ?>">
                                                            <i class="fas fa-edit mr-1"></i> Edit Rate
                                                        </button>
                                                        <a href="finance/editPaymentCategory?id=<?php echo $cat->id; ?>" class="btn btn-outline-secondary btn-sm ml-1" title="Edit Full Item">
                                                            <i class="fas fa-cog"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Quick Rate Edit Modal -->
<div class="modal fade" id="modalEditRate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-percentage mr-2"></i> Update Referral Commission Rate</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditRate">
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_item_id">

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small text-uppercase">Item / Lab Test</label>
                        <input type="text" class="form-control" id="edit_item_name" readonly>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-dark small text-uppercase">
                            Referral Commission Rate (%) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" max="100" class="form-control form-control-lg font-weight-bold" id="edit_item_rate" required>
                            <div class="input-group-append">
                                <span class="input-group-text font-weight-bold">%</span>
                            </div>
                        </div>
                        <small class="text-muted">Must be between 0 and 100%. Percentage only.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4"><i class="fas fa-save mr-1"></i> Save Rate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editable-sample').DataTable({
            responsive: true,
            order: [[1, "asc"]],
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],
            pageLength: 50
        });

        $('.btn-edit-rate').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var rate = $(this).data('rate');

            $('#edit_item_id').val(id);
            $('#edit_item_name').val(name);
            $('#edit_item_rate').val(rate);
            $('#modalEditRate').modal('show');
        });

        $('#formEditRate').on('submit', function(e) {
            e.preventDefault();
            var id = $('#edit_item_id').val();
            var rate = parseFloat($('#edit_item_rate').val());

            if (isNaN(rate) || rate < 0 || rate > 100) {
                alert('Referral commission rate must be between 0 and 100%.');
                return;
            }

            $.ajax({
                url: 'referral/updateItemCommission',
                type: 'POST',
                data: { id: id, rate: rate },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === 'success') {
                        $('#rate-badge-' + id).text(rate + '%');
                        $('#modalEditRate').modal('hide');
                        if (typeof swal === 'function') {
                            swal("Success", resp.message, "success");
                        } else {
                            alert(resp.message);
                        }
                    } else {
                        alert(resp.message || 'Update failed');
                    }
                },
                error: function() {
                    alert('Server error while updating rate.');
                }
            });
        });
    });
</script>

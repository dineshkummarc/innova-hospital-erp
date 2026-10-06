<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-check-circle text-success mr-3"></i>
                        <?php echo lang('receive'); ?> <?php echo lang('purchase_order'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/purchases"><?php echo lang('purchases'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('receive'); ?> <?php echo lang('purchase'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-file-invoice mr-2"></i>
                                <?php echo lang('purchase_order'); ?>: <?php echo $purchase->purchase_order_no; ?>
                            </h4>
                            <p class="mb-0"><?php echo lang('supplier'); ?>: <?php echo $purchase->supplier_name; ?></p>
                        </div>
                        
                        <div class="card-body p-5">
                            <!-- Purchase Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong><?php echo lang('purchase_date'); ?>:</strong></td>
                                            <td><?php echo date('d M Y', strtotime($purchase->purchase_date)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('expected_delivery'); ?>:</strong></td>
                                            <td>
                                                <?php echo $purchase->expected_delivery_date ? date('d M Y', strtotime($purchase->expected_delivery_date)) : lang('not_specified'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('total_amount'); ?>:</strong></td>
                                            <td><strong><?php echo $settings->currency . number_format($purchase->net_amount, 2); ?></strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong><?php echo lang('supplier'); ?> <?php echo lang('contact'); ?>:</strong></td>
                                            <td><?php echo $purchase->contact_person; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('phone'); ?>:</strong></td>
                                            <td><?php echo $purchase->phone; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('email'); ?>:</strong></td>
                                            <td><?php echo $purchase->email; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <!-- Receive Items Form -->
                            <form role="form" action="medicine/processReceivePurchase" method="post" id="receiveForm">
                                <input type="hidden" name="purchase_id" value="<?php echo $purchase->id; ?>">
                                
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-list mr-2"></i><?php echo lang('items'); ?> <?php echo lang('to'); ?> <?php echo lang('receive'); ?>
                                </h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                                <th><?php echo lang('ordered'); ?> <?php echo lang('quantity'); ?></th>
                                                <th><?php echo lang('received'); ?> <?php echo lang('quantity'); ?></th>
                                                <th><?php echo lang('unit'); ?> <?php echo lang('cost'); ?></th>
                                                <th><?php echo lang('batch'); ?> <?php echo lang('number'); ?></th>
                                                <th><?php echo lang('manufacturing'); ?> <?php echo lang('date'); ?></th>
                                                <th><?php echo lang('expiry'); ?> <?php echo lang('date'); ?></th>
                                                <th><?php echo lang('manufacturer'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($purchase_items as $item) { ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo $item->medicine_name; ?></strong><br>
                                                        <small class="text-muted"><?php echo $item->generic; ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo $item->quantity_ordered; ?></span>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="item_id[]" value="<?php echo $item->id; ?>">
                                                        <input type="number" class="form-control" 
                                                               name="received_quantity[]" 
                                                               min="0" 
                                                               max="<?php echo $item->quantity_ordered; ?>"
                                                               value="<?php echo $item->quantity_ordered; ?>"
                                                               required="">
                                                    </td>
                                                    <td>
                                                        <strong><?php echo $settings->currency . number_format($item->unit_cost, 2); ?></strong>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" 
                                                               name="batch_number[]" 
                                                               value="<?php echo $item->batch_number; ?>"
                                                               placeholder="<?php echo lang('enter'); ?> <?php echo lang('batch'); ?> <?php echo lang('number'); ?>"
                                                               required="">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" 
                                                               name="manufacturing_date[]"
                                                               value="<?php echo $item->manufacturing_date; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" 
                                                               name="expiry_date[]" 
                                                               value="<?php echo $item->expiry_date; ?>"
                                                               required="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" 
                                                               name="manufacturer[]" 
                                                               value="<?php echo $item->manufacturer; ?>"
                                                               placeholder="<?php echo lang('manufacturer'); ?> <?php echo lang('name'); ?>">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-uppercase text-sm"><?php echo lang('delivery'); ?> <?php echo lang('date'); ?></label>
                                            <input type="date" class="form-control form-control-lg" 
                                                   name="delivery_date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-uppercase text-sm"><?php echo lang('received'); ?> <?php echo lang('by'); ?></label>
                                            <input type="text" class="form-control form-control-lg" 
                                                   name="received_by" value="<?php echo $this->session->userdata('user_name'); ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase text-sm"><?php echo lang('receiving'); ?> <?php echo lang('notes'); ?></label>
                                    <textarea class="form-control form-control-lg" name="receiving_notes" rows="3" 
                                              placeholder="<?php echo lang('any'); ?> <?php echo lang('notes'); ?> <?php echo lang('about'); ?> <?php echo lang('the'); ?> <?php echo lang('received'); ?> <?php echo lang('items'); ?> (<?php echo lang('condition'); ?>, <?php echo lang('damages'); ?>, <?php echo lang('etc'); ?>)"></textarea>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg px-5">
                                        <i class="fas fa-check mr-2"></i><?php echo lang('process'); ?> <?php echo lang('receipt'); ?>
                                    </button>
                                    <a href="medicine/purchases" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate batch numbers if empty
    const batchInputs = document.querySelectorAll('input[name="batch_number[]"]');
    batchInputs.forEach((input, index) => {
        if (!input.value) {
            const today = new Date();
            const dateStr = today.getFullYear().toString() + 
                           (today.getMonth() + 1).toString().padStart(2, '0') + 
                           today.getDate().toString().padStart(2, '0');
            input.value = 'BATCH-' + dateStr + '-' + (index + 1).toString().padStart(3, '0');
        }
    });

    // Validate expiry dates
    const expiryInputs = document.querySelectorAll('input[name="expiry_date[]"]');
    expiryInputs.forEach(input => {
        input.addEventListener('change', function() {
            const expiryDate = new Date(this.value);
            const today = new Date();
            
            if (expiryDate <= today) {
                alert('<?php echo lang('warning'); ?>: <?php echo lang('expiry'); ?> <?php echo lang('date'); ?> <?php echo lang('is'); ?> <?php echo lang('in'); ?> <?php echo lang('the'); ?> <?php echo lang('past'); ?> <?php echo lang('or'); ?> <?php echo lang('today'); ?>!');
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#28a745';
            }
        });
    });

    // Form submission validation
    document.getElementById('receiveForm').addEventListener('submit', function(e) {
        const receivedQtys = document.querySelectorAll('input[name="received_quantity[]"]');
        let totalReceived = 0;
        
        receivedQtys.forEach(input => {
            totalReceived += parseFloat(input.value) || 0;
        });
        
        if (totalReceived === 0) {
            e.preventDefault();
            alert('<?php echo lang('please'); ?> <?php echo lang('enter'); ?> <?php echo lang('at_least'); ?> <?php echo lang('one'); ?> <?php echo lang('item'); ?> <?php echo lang('to'); ?> <?php echo lang('receive'); ?>.');
            return false;
        }
        
        return confirm('<?php echo lang('are_you_sure'); ?> <?php echo lang('you'); ?> <?php echo lang('want'); ?> <?php echo lang('to'); ?> <?php echo lang('process'); ?> <?php echo lang('this'); ?> <?php echo lang('receipt'); ?>? <?php echo lang('this'); ?> <?php echo lang('action'); ?> <?php echo lang('cannot'); ?> <?php echo lang('be'); ?> <?php echo lang('undone'); ?>.');
    });
});
</script>

<!--main content end-->
<!--footer start-->

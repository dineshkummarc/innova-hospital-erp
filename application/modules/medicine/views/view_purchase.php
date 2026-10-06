<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-eye text-info mr-3"></i>
                        <?php echo lang('view'); ?> <?php echo lang('purchase_order'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/purchases"><?php echo lang('purchases'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('view'); ?> <?php echo lang('purchase'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="medicine/purchases" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left mr-2"></i><?php echo lang('back_to'); ?> <?php echo lang('purchases'); ?>
                    </a>
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
                                            <td><strong><?php echo lang('invoice_number'); ?>:</strong></td>
                                            <td><?php echo $purchase->invoice_number ? $purchase->invoice_number : lang('not_provided'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('invoice_date'); ?>:</strong></td>
                                            <td>
                                                <?php echo $purchase->invoice_date ? date('d M Y', strtotime($purchase->invoice_date)) : lang('not_provided'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('payment_terms'); ?>:</strong></td>
                                            <td><?php echo $purchase->payment_terms ? $purchase->payment_terms : lang('not_specified'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong><?php echo lang('supplier_contact'); ?>:</strong></td>
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
                                        <tr>
                                            <td><strong><?php echo lang('purchase_status'); ?>:</strong></td>
                                            <td>
                                                <?php 
                                                $status_class = '';
                                                switch($purchase->purchase_status) {
                                                    case 'pending':
                                                        $status_class = 'badge-warning';
                                                        break;
                                                    case 'ordered':
                                                        $status_class = 'badge-info';
                                                        break;
                                                    case 'received':
                                                        $status_class = 'badge-success';
                                                        break;
                                                    case 'cancelled':
                                                        $status_class = 'badge-danger';
                                                        break;
                                                    default:
                                                        $status_class = 'badge-secondary';
                                                }
                                                ?>
                                                <span class="badge <?php echo $status_class; ?>"><?php echo lang(ucfirst($purchase->purchase_status)); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo lang('payment_status'); ?>:</strong></td>
                                            <td>
                                                <?php 
                                                $payment_class = '';
                                                switch($purchase->payment_status) {
                                                    case 'pending':
                                                        $payment_class = 'badge-warning';
                                                        break;
                                                    case 'partial':
                                                        $payment_class = 'badge-info';
                                                        break;
                                                    case 'paid':
                                                        $payment_class = 'badge-success';
                                                        break;
                                                    default:
                                                        $payment_class = 'badge-secondary';
                                                }
                                                ?>
                                                <span class="badge <?php echo $payment_class; ?>"><?php echo lang(ucfirst($purchase->payment_status)); ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Financial Summary -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-calculator mr-2"></i><?php echo lang('financial_summary'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h6 class="text-muted"><?php echo lang('total_amount'); ?></h6>
                                                        <h4 class="text-primary"><?php echo $settings->currency . number_format($purchase->total_amount, 2); ?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h6 class="text-muted"><?php echo lang('tax_amount'); ?></h6>
                                                        <h4 class="text-info"><?php echo $settings->currency . number_format($purchase->tax_amount, 2); ?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h6 class="text-muted"><?php echo lang('transport_charges'); ?></h6>
                                                        <h4 class="text-warning"><?php echo $settings->currency . number_format($purchase->transport_charges, 2); ?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <h6 class="text-muted"><?php echo lang('net_amount'); ?></h6>
                                                        <h4 class="text-success"><strong><?php echo $settings->currency . number_format($purchase->net_amount, 2); ?></strong></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Purchase Items -->
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-list mr-2"></i><?php echo lang('purchase_items'); ?>
                            </h5>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th><?php echo lang('medicine_name'); ?></th>
                                            <th><?php echo lang('generic_name'); ?></th>
                                            <th><?php echo lang('category'); ?></th>
                                            <th><?php echo lang('ordered_qty'); ?></th>
                                            <th><?php echo lang('received_qty'); ?></th>
                                            <th><?php echo lang('unit_cost'); ?></th>
                                            <th><?php echo lang('total_cost'); ?></th>
                                            <th><?php echo lang('batch_number'); ?></th>
                                            <th><?php echo lang('expiry_date'); ?></th>
                                            <th><?php echo lang('status'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($purchase_items as $item) { ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo $item->medicine_name; ?></strong>
                                                </td>
                                                <td><?php echo $item->generic; ?></td>
                                                <td><?php echo $item->category; ?></td>
                                                <td>
                                                    <span class="badge badge-info"><?php echo $item->quantity_ordered; ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($item->quantity_received > 0) { ?>
                                                        <span class="badge badge-success"><?php echo $item->quantity_received; ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-warning">0</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <strong><?php echo $settings->currency . number_format($item->unit_cost, 2); ?></strong>
                                                </td>
                                                <td>
                                                    <strong><?php echo $settings->currency . number_format($item->total_cost, 2); ?></strong>
                                                </td>
                                                <td><?php echo $item->batch_number ? $item->batch_number : lang('not_assigned'); ?></td>
                                                <td>
                                                    <?php if ($item->expiry_date) { ?>
                                                        <?php echo date('d M Y', strtotime($item->expiry_date)); ?>
                                                    <?php } else { ?>
                                                        <?php echo lang('not_specified'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $item_status_class = '';
                                                    switch($item->received_status) {
                                                        case 'pending':
                                                            $item_status_class = 'badge-warning';
                                                            break;
                                                        case 'received':
                                                            $item_status_class = 'badge-success';
                                                            break;
                                                        case 'partial':
                                                            $item_status_class = 'badge-info';
                                                            break;
                                                        default:
                                                            $item_status_class = 'badge-secondary';
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $item_status_class; ?>"><?php echo lang(ucfirst($item->received_status)); ?></span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Notes Section -->
                            <?php if ($purchase->notes) { ?>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card bg-light">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-sticky-note mr-2"></i><?php echo lang('notes'); ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0"><?php echo nl2br($purchase->notes); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Action Buttons -->
                            <div class="text-center mt-4">
                                <?php if ($purchase->purchase_status == 'received') { ?>
                                    <a href="medicine/editPurchase?id=<?php echo $purchase->id; ?>" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-edit mr-2"></i><?php echo lang('edit_purchase'); ?>
                                    </a>
                                <?php } ?>
                                
                                <a href="medicine/purchases" class="btn btn-secondary btn-lg px-5 ml-3">
                                    <i class="fas fa-arrow-left mr-2"></i><?php echo lang('back_to'); ?> <?php echo lang('purchases'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--main content end-->
<!--footer start-->

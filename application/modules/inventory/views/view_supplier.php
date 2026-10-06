<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-building text-primary mr-3"></i>
                        <?php echo lang('supplier_details') ?: 'Supplier Details' ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/supplier"><?php echo lang('suppliers'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('supplier_details'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/supplier" class="btn btn-secondary btn-sm px-4 py-3">
                        <i class="fa fa-arrow-left"></i> <?php echo lang('suppliers') ?: 'Back to Suppliers'; ?>
                    </a>
                    <a href="#" onclick="editSupplier(<?php echo $supplier->id; ?>)" data-toggle="modal" data-target="#editSupplierModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-edit"></i> <?php echo lang('edit_supplier') ?: 'Edit Supplier'; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            
            <div class="row">
                <!-- Supplier Information -->
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-info-circle mr-2"></i>
                                <?php echo lang('supplier_details') ?: 'Supplier Information'; ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('supplier_name') ?: 'Supplier Name'; ?>:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->name; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('company_name') ?: 'Company Name'; ?>:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->company_name ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('contact_person') ?: 'Contact Person'; ?>:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->contact_person ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('email') ?: 'Email'; ?>:</label>
                                        <p class="form-control-plaintext">
                                            <?php if ($supplier->email) { ?>
                                                <a href="mailto:<?php echo $supplier->email; ?>"><?php echo $supplier->email; ?></a>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('phone') ?: 'Phone'; ?>:</label>
                                        <p class="form-control-plaintext">
                                            <?php if ($supplier->phone) { ?>
                                                <a href="tel:<?php echo $supplier->phone; ?>"><?php echo $supplier->phone; ?></a>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('phone') ?: 'Mobile'; ?>:</label>
                                        <p class="form-control-plaintext">
                                            <?php if ($supplier->mobile) { ?>
                                                <a href="tel:<?php echo $supplier->mobile; ?>"><?php echo $supplier->mobile; ?></a>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('address') ?: 'Address'; ?>:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->address ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">City:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->city ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">State:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->state ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">Country:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->country ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">Postal Code:</label>
                                        <p class="form-control-plaintext"><?php echo $supplier->postal_code ?: '-'; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo lang('status') ?: 'Status'; ?>:</label>
                                        <p class="form-control-plaintext">
                                            <?php if ($supplier->status == 'active') { ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php } else { ?>
                                                <span class="badge badge-secondary">Inactive</span>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if ($supplier->notes) { ?>
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Notes:</label>
                                    <p class="form-control-plaintext"><?php echo nl2br($supplier->notes); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Purchase History -->
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Recent Purchase Orders
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($purchase_history)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date') ?: 'Order Date'; ?></th>
                                                <th>Order Number</th>
                                                <th>Total Items</th>
                                                <th>Total Quantity</th>
                                                <th><?php echo lang('status') ?: 'Status'; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($purchase_history as $order) { ?>
                                                <tr>
                                                    <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                                    <td><?php echo $order->order_number; ?></td>
                                                    <td><?php echo $order->total_items; ?></td>
                                                    <td><?php echo $order->total_quantity; ?></td>
                                                    <td>
                                                        <?php
                                                        $status_class = '';
                                                        switch ($order->status) {
                                                            case 'completed':
                                                                $status_class = 'success';
                                                                break;
                                                            case 'pending':
                                                                $status_class = 'warning';
                                                                break;
                                                            case 'cancelled':
                                                                $status_class = 'danger';
                                                                break;
                                                            default:
                                                                $status_class = 'secondary';
                                                        }
                                                        ?>
                                                        <span class="badge badge-<?php echo $status_class; ?>"><?php echo ucfirst($order->status); ?></span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No purchase orders found</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Financial Information -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-dollar-sign mr-2"></i>
                                Financial Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark"><?php echo lang('current_balance') ?: 'Current Balance'; ?>:</label>
                                <p class="form-control-plaintext h4 text-success">
                                    $<?php echo number_format($supplier->current_balance, 2); ?>
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-dark"><?php echo lang('credit_limit') ?: 'Credit Limit'; ?>:</label>
                                <p class="form-control-plaintext">
                                    $<?php echo number_format($supplier->credit_limit, 2); ?>
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-dark"><?php echo lang('payment_terms') ?: 'Payment Terms'; ?>:</label>
                                <p class="form-control-plaintext"><?php echo $supplier->payment_terms ?: '-'; ?></p>
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Tax Number:</label>
                                <p class="form-control-plaintext"><?php echo $supplier->tax_number ?: '-'; ?></p>
                            </div>
                            
                            <?php if ($supplier->bank_name) { ?>
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Bank Name:</label>
                                    <p class="form-control-plaintext"><?php echo $supplier->bank_name; ?></p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Bank Account:</label>
                                    <p class="form-control-plaintext"><?php echo $supplier->bank_account ?: '-'; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Performance Summary -->
                    <?php if ($performance) { ?>
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-warning text-dark">
                                                            <h3 class="card-title mb-0">
                                <i class="fas fa-chart-line mr-2"></i>
                                Performance Summary
                            </h3>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="border rounded p-3">
                                            <h4 class="text-primary mb-1"><?php echo $performance->total_orders; ?></h4>
                                            <small class="text-muted">Total Orders</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="border rounded p-3">
                                            <h4 class="text-success mb-1">$<?php echo number_format($performance->total_amount, 0); ?></h4>
                                            <small class="text-muted">Total Amount</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="border rounded p-3">
                                            <h4 class="text-info mb-1">$<?php echo number_format($performance->average_order_value, 0); ?></h4>
                                            <small class="text-muted">Avg Order Value</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="border rounded p-3">
                                            <h4 class="text-warning mb-1"><?php echo round($performance->average_delivery_days, 1); ?></h4>
                                            <small class="text-muted">Avg Delivery Days</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if ($performance->total_orders > 0) { ?>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small>On Time Delivery</small>
                                            <small><?php echo round(($performance->on_time_deliveries / $performance->total_orders) * 100, 1); ?>%</small>
                                        </div>
                                        <div class="progress mb-2" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: <?php echo ($performance->on_time_deliveries / $performance->total_orders) * 100; ?>%"></div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between mb-1">
                                            <small>Completion Rate</small>
                                            <small><?php echo round(($performance->completed_orders / $performance->total_orders) * 100, 1); ?>%</small>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-primary" style="width: <?php echo ($performance->completed_orders / $performance->total_orders) * 100; ?>%"></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Edit Supplier Modal (if needed) -->
<!-- This would be included from the suppliers.php file or loaded separately -->

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-boxes text-primary mr-3"></i>
                        <?php echo lang('inventory_dashboard') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('inventory'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/items" class="btn btn-success btn-sm px-4 py-3">
                        <i class="fa fa-list"></i> <?php echo lang('manage_inventory_items'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_items; ?></h3>
                            <p><?php echo lang('inventory_items'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="inventory/items" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $low_stock_items; ?></h3>
                            <p><?php echo lang('low_stock_items'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <a href="inventory/low_stock" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $pending_orders; ?></h3>
                            <p><?php echo lang('pending_deliveries'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="inventory/purchase/pending_deliveries" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $overdue_deliveries; ?></h3>
                            <p><?php echo lang('overdue_deliveries'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="inventory/purchase/pending_deliveries" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Usage -->
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                <?php echo lang('recent') . ' ' . lang('usage_logs'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('item_name'); ?></th>
                                            <th><?php echo lang('quantity_used'); ?></th>
                                            <th><?php echo lang('usage_date'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recent_usage)) { ?>
                                            <?php foreach ($recent_usage as $usage) { ?>
                                                <tr>
                                                    <td><?php echo $usage->item_name; ?></td>
                                                    <td><?php echo $usage->quantity_used; ?></td>
                                                    <td><?php echo date('Y-m-d H:i', strtotime($usage->usage_date)); ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="3" class="text-center"><?php echo lang('no_data_available'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <a href="inventory/usage" class="btn btn-primary btn-sm"><?php echo lang('view_all'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expiring Items -->
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                <i class="fas fa-calendar-times mr-2"></i>
                                <?php echo lang('expiring_items'); ?> (<?php echo '30 ' . lang('days'); ?>)
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('item_name'); ?></th>
                                            <th><?php echo lang('batch_number'); ?></th>
                                            <th><?php echo lang('expiry_date'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($expiring_items)) { ?>
                                            <?php foreach ($expiring_items as $item) { ?>
                                                <tr>
                                                    <td><?php echo $item->item_name; ?></td>
                                                    <td><?php echo $item->batch_number; ?></td>
                                                    <td class="text-warning"><?php echo date('Y-m-d', strtotime($item->expiry_date)); ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="3" class="text-center"><?php echo lang('no_data_available'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                <?php echo lang('quick_access'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="inventory/items" class="btn btn-outline-primary btn-block">
                                        <i class="fas fa-list mr-2"></i>
                                        <?php echo lang('inventory_items'); ?>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="inventory/usage" class="btn btn-outline-success btn-block">
                                        <i class="fas fa-clipboard-list mr-2"></i>
                                        <?php echo lang('usage_logs'); ?>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="inventory/purchase" class="btn btn-outline-info btn-block">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        <?php echo lang('purchase_orders'); ?>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="inventory/reports" class="btn btn-outline-warning btn-block">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        <?php echo lang('inventory_reports'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
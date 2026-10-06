<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill text-danger mr-3"></i>
                        Outstanding Balances
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Outstanding Balances</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/reports" class="btn btn-secondary btn-sm px-4">
                        <i class="fa fa-arrow-left"></i> Back to Reports
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Summary Cards -->
            <div class="row mb-4">
                <?php 
                $total_outstanding = 0;
                $suppliers_with_balances = count($suppliers);
                foreach ($suppliers as $supplier) {
                    $total_outstanding += $supplier->current_balance;
                }
                ?>
                <div class="col-md-4">
                    <div class="card bg-danger text-white shadow-lg">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0"><?php echo $settings->currency; ?> <?php echo number_format($total_outstanding, 2); ?></h4>
                                    <p class="mb-0">Total Outstanding</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white shadow-lg">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0"><?php echo $suppliers_with_balances; ?></h4>
                                    <p class="mb-0">Suppliers with Balances</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white shadow-lg">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0"><?php echo $suppliers_with_balances > 0 ? number_format($total_outstanding / $suppliers_with_balances, 2) : '0.00'; ?></h4>
                                    <p class="mb-0">Average Balance</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-building fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Outstanding Balances Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-money-bill mr-2"></i>
                                Supplier Outstanding Balances
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="balancesTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">Supplier Name</th>
                                            <th class="font-weight-bold">Company</th>
                                            <th class="font-weight-bold">Contact Person</th>
                                            <th class="font-weight-bold">Phone</th>
                                            <th class="font-weight-bold">Email</th>
                                            <th class="font-weight-bold">Outstanding Amount</th>
                                            <th class="font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($suppliers)) { ?>
                                            <?php foreach ($suppliers as $supplier) { ?>
                                                <?php 
                                                $balance_class = '';
                                                if ($supplier->current_balance > 5000) {
                                                    $balance_class = 'text-danger font-weight-bold';
                                                } elseif ($supplier->current_balance > 1000) {
                                                    $balance_class = 'text-warning font-weight-bold';
                                                } else {
                                                    $balance_class = 'text-success';
                                                }
                                                ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?php echo htmlspecialchars($supplier->name); ?></td>
                                                    <td><?php echo htmlspecialchars($supplier->company_name ?: '-'); ?></td>
                                                    <td>
                                                        <?php if ($supplier->contact_person) { ?>
                                                            <i class="fas fa-user mr-1"></i>
                                                            <?php echo htmlspecialchars($supplier->contact_person); ?>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($supplier->phone) { ?>
                                                            <a href="tel:<?php echo $supplier->phone; ?>" class="text-success">
                                                                <i class="fas fa-phone mr-1"></i>
                                                                <?php echo htmlspecialchars($supplier->phone); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($supplier->email) { ?>
                                                            <a href="mailto:<?php echo $supplier->email; ?>" class="text-primary">
                                                                <i class="fas fa-envelope mr-1"></i>
                                                                <?php echo htmlspecialchars($supplier->email); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="<?php echo $balance_class; ?>">
                                                        <?php echo $settings->currency; ?> <?php echo number_format($supplier->current_balance, 2); ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="inventory/supplier/view/<?php echo $supplier->id; ?>" class="btn btn-sm btn-info" title="View Supplier">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <?php if ($supplier->email) { ?>
                                                                <a href="mailto:<?php echo $supplier->email; ?>?subject=Payment Reminder" class="btn btn-sm btn-warning" title="Send Payment Reminder">
                                                                    <i class="fas fa-paper-plane"></i>
                                                                </a>
                                                            <?php } ?>
                                                            <?php if ($supplier->phone) { ?>
                                                                <a href="tel:<?php echo $supplier->phone; ?>" class="btn btn-sm btn-success" title="Call Supplier">
                                                                    <i class="fas fa-phone"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-5">
                                                    <i class="fas fa-check-circle fa-4x mb-3 text-success"></i>
                                                    <br>
                                                    <h5>All Balances Cleared</h5>
                                                    <p>No outstanding balances found. All suppliers have been paid.</p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php if (!empty($suppliers)) { ?>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th colspan="5" class="text-right">Total Outstanding:</th>
                                                <th class="text-danger"><?php echo $settings->currency; ?> <?php echo number_format($total_outstanding, 2); ?></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Tracking Information -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-lightbulb mr-2"></i>
                                Payment Tracking Enhancement
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Current System:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success mr-2"></i> Purchase orders are tracked</li>
                                        <li><i class="fas fa-check text-success mr-2"></i> Items receipt is recorded</li>
                                        <li><i class="fas fa-check text-success mr-2"></i> Order completion is marked</li>
                                        <li><i class="fas fa-times text-danger mr-2"></i> Payment status is not tracked separately</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">To Enable Outstanding Balances:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-plus text-primary mr-2"></i> Add payment_status field to purchase_orders</li>
                                        <li><i class="fas fa-plus text-primary mr-2"></i> Create supplier_payments table</li>
                                        <li><i class="fas fa-plus text-primary mr-2"></i> Track partial payments</li>
                                        <li><i class="fas fa-plus text-primary mr-2"></i> Generate payment reminders</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#balancesTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 3, "desc" ]],
        "searching": false,
        "paging": false
    }).buttons().container().appendTo('#balancesTable_wrapper .col-md-6:eq(0)');
});
</script>
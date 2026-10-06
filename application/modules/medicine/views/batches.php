<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-boxes text-primary mr-3"></i>
                        <?php echo lang('medicine'); ?> <?php echo lang('batches'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('batches'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="medicine/expiringMedicines" class="btn btn-warning btn-lg mr-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i><?php echo lang('expiring'); ?> <?php echo lang('medicines'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all'); ?> <?php echo lang('medicine'); ?> <?php echo lang('batches'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample1">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('generic'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('batch'); ?> <?php echo lang('number'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('supplier'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('manufacturing'); ?> <?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('expiry'); ?> <?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('current'); ?> <?php echo lang('stock'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('unit'); ?> <?php echo lang('cost'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('selling'); ?> <?php echo lang('price'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('status'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('days'); ?> <?php echo lang('to'); ?> <?php echo lang('expiry'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($batches as $batch) { 
                                        $expiry_date = new DateTime($batch->expiry_date);
                                        $today = new DateTime();
                                        $days_to_expiry = $today->diff($expiry_date)->days;
                                        $is_expired = $expiry_date < $today;
                                        
                                        if ($is_expired) {
                                            $days_to_expiry = -$days_to_expiry;
                                        }
                                    ?>
                                        <tr class="<?php 
                                            if ($is_expired) {
                                                echo 'table-danger';
                                            } elseif ($days_to_expiry <= 30) {
                                                echo 'table-warning';
                                            } elseif ($days_to_expiry <= 90) {
                                                echo 'table-info';
                                            }
                                        ?>">
                                            <td class="font-weight-bold"><?php echo $batch->medicine_name; ?></td>
                                            <td><?php echo $batch->generic; ?></td>
                                            <td>
                                                <span class="badge badge-primary"><?php echo $batch->batch_number; ?></span>
                                            </td>
                                            <td><?php echo $batch->supplier_name; ?></td>
                                            <td>
                                                <?php echo $batch->manufacturing_date ? date('d M Y', strtotime($batch->manufacturing_date)) : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y', strtotime($batch->expiry_date)); ?>
                                            </td>
                                            <td>
                                                <?php if ($batch->current_stock <= 0) { ?>
                                                    <span class="text-danger font-weight-bold"><?php echo lang('out_of_stock'); ?></span>
                                                <?php } else { ?>
                                                    <span class="font-weight-bold"><?php echo $batch->current_stock; ?></span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $settings->currency . number_format($batch->unit_cost, 2); ?></td>
                                            <td><?php echo $settings->currency . number_format($batch->selling_price, 2); ?></td>
                                            <td>
                                                <?php 
                                                if ($is_expired) {
                                                    echo '<span class="badge badge-danger">' . lang('expired') . '</span>';
                                                } elseif ($batch->current_stock <= 0) {
                                                    echo '<span class="badge badge-dark">' . lang('out_of_stock') . '</span>';
                                                } elseif ($days_to_expiry <= 30) {
                                                    echo '<span class="badge badge-warning">' . lang('expiring_soon') . '</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">' . lang('active') . '</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if ($is_expired) {
                                                    echo '<span class="text-danger font-weight-bold">' . lang('expired') . ' ' . abs($days_to_expiry) . ' ' . lang('days') . ' ' . lang('ago') . '</span>';
                                                } elseif ($days_to_expiry <= 0) {
                                                    echo '<span class="text-danger font-weight-bold">' . lang('expires') . ' ' . lang('today') . '</span>';
                                                } elseif ($days_to_expiry <= 30) {
                                                    echo '<span class="text-warning font-weight-bold">' . $days_to_expiry . ' ' . lang('days') . '</span>';
                                                } else {
                                                    echo '<span class="text-success">' . $days_to_expiry . ' ' . lang('days') . '</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--main content end-->
<!--footer start-->

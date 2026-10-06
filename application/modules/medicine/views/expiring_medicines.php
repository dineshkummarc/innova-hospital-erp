<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-warning mr-3"></i>
                        <?php echo lang('expiring'); ?> <?php echo lang('medicines'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/batches"><?php echo lang('batches'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('expiring'); ?> <?php echo lang('medicines'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="medicine/batches" class="btn btn-secondary btn-lg">
                        <i class="fas fa-boxes mr-2"></i><?php echo lang('all'); ?> <?php echo lang('batches'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title"><?php echo lang('expired'); ?></h6>
                                    <h3 class="mb-0">
                                        <?php 
                                        $expired_count = 0;
                                        foreach ($expiring_medicines as $medicine) {
                                            if (strtotime($medicine->expiry_date) < time()) {
                                                $expired_count++;
                                            }
                                        }
                                        echo $expired_count;
                                        ?>
                                    </h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title"><?php echo lang('expiring'); ?> <?php echo lang('in'); ?> 30 <?php echo lang('days'); ?></h6>
                                    <h3 class="mb-0">
                                        <?php 
                                        $expiring_30_count = 0;
                                        foreach ($expiring_medicines as $medicine) {
                                            $days_diff = (strtotime($medicine->expiry_date) - time()) / (60 * 60 * 24);
                                            if ($days_diff > 0 && $days_diff <= 30) {
                                                $expiring_30_count++;
                                            }
                                        }
                                        echo $expiring_30_count;
                                        ?>
                                    </h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title"><?php echo lang('expiring'); ?> <?php echo lang('in'); ?> 90 <?php echo lang('days'); ?></h6>
                                    <h3 class="mb-0">
                                        <?php 
                                        $expiring_90_count = 0;
                                        foreach ($expiring_medicines as $medicine) {
                                            $days_diff = (strtotime($medicine->expiry_date) - time()) / (60 * 60 * 24);
                                            if ($days_diff > 30 && $days_diff <= 90) {
                                                $expiring_90_count++;
                                            }
                                        }
                                        echo $expiring_90_count;
                                        ?>
                                    </h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title"><?php echo lang('total'); ?> <?php echo lang('value'); ?> <?php echo lang('at'); ?> <?php echo lang('risk'); ?></h6>
                                    <h3 class="mb-0">
                                        <?php 
                                        $total_value = 0;
                                        foreach ($expiring_medicines as $medicine) {
                                            $total_value += $medicine->current_stock * $medicine->unit_cost;
                                        }
                                        echo $settings->currency . number_format($total_value, 2);
                                        ?>
                                    </h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-dollar-sign fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('medicines'); ?> <?php echo lang('expiring'); ?> <?php echo lang('within'); ?> 90 <?php echo lang('days'); ?></h3>
                            <div class="card-tools">
                                <span class="badge badge-info">
                                    <?php echo lang('total'); ?>: <?php echo count($expiring_medicines); ?> <?php echo lang('batches'); ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="expiringMedicinesTable">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('generic'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('batch'); ?> <?php echo lang('number'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('supplier'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('expiry'); ?> <?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('current'); ?> <?php echo lang('stock'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('unit'); ?> <?php echo lang('cost'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('total'); ?> <?php echo lang('value'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('days'); ?> <?php echo lang('to'); ?> <?php echo lang('expiry'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($expiring_medicines as $medicine) { 
                                        $expiry_date = new DateTime($medicine->expiry_date);
                                        $today = new DateTime();
                                        $days_to_expiry = $today->diff($expiry_date)->days;
                                        $is_expired = $expiry_date < $today;
                                        
                                        if ($is_expired) {
                                            $days_to_expiry = -$days_to_expiry;
                                        }
                                        
                                        $total_value = $medicine->current_stock * $medicine->unit_cost;
                                    ?>
                                        <tr class="<?php 
                                            if ($is_expired) {
                                                echo 'table-danger';
                                            } elseif ($days_to_expiry <= 30) {
                                                echo 'table-warning';
                                            } else {
                                                echo 'table-info';
                                            }
                                        ?>">
                                            <td class="font-weight-bold"><?php echo $medicine->medicine_name; ?></td>
                                            <td><?php echo $medicine->generic; ?></td>
                                            <td>
                                                <span class="badge badge-secondary"><?php echo $medicine->batch_number; ?></span>
                                            </td>
                                            <td><?php echo $medicine->supplier_name; ?></td>
                                            <td>
                                                <span class="font-weight-bold">
                                                    <?php echo date('d M Y', strtotime($medicine->expiry_date)); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold"><?php echo $medicine->current_stock; ?></span>
                                            </td>
                                            <td><?php echo $settings->currency . number_format($medicine->unit_cost, 2); ?></td>
                                            <td>
                                                <span class="font-weight-bold text-primary">
                                                    <?php echo $settings->currency . number_format($total_value, 2); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php 
                                                if ($is_expired) {
                                                    echo '<span class="badge badge-danger">' . lang('expired') . ' ' . abs($days_to_expiry) . ' ' . lang('days') . ' ' . lang('ago') . '</span>';
                                                } elseif ($days_to_expiry <= 0) {
                                                    echo '<span class="badge badge-danger">' . lang('expires') . ' ' . lang('today') . '</span>';
                                                } elseif ($days_to_expiry <= 7) {
                                                    echo '<span class="badge badge-danger">' . $days_to_expiry . ' ' . lang('days') . '</span>';
                                                } elseif ($days_to_expiry <= 30) {
                                                    echo '<span class="badge badge-warning">' . $days_to_expiry . ' ' . lang('days') . '</span>';
                                                } else {
                                                    echo '<span class="badge badge-info">' . $days_to_expiry . ' ' . lang('days') . '</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if ($is_expired) {
                                                    echo '<span class="badge badge-danger">' . lang('expired') . '</span>';
                                                } elseif ($days_to_expiry <= 7) {
                                                    echo '<span class="badge badge-danger">' . lang('critical') . '</span>';
                                                } elseif ($days_to_expiry <= 30) {
                                                    echo '<span class="badge badge-warning">' . lang('warning') . '</span>';
                                                } else {
                                                    echo '<span class="badge badge-info">' . lang('watch') . '</span>';
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

<script>
$(document).ready(function() {
    $('#expiringMedicinesTable').DataTable({
        "order": [[ 8, "asc" ]], // Sort by days to expiry (ascending)
        "pageLength": 25,
        "responsive": true,
        "columnDefs": [
            {
                "targets": [8], // Days to expiry column
                "type": "num"
            }
        ]
    });
});
</script>

<!--main content end-->
<!--footer start-->

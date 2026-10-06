<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<link href="common/extranal/css/finance/daily.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                        <?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('expense_report'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('expense_report'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <?php
                    $currently_processing_year = date('Y', $first_minute);
                    $next_year = $currently_processing_year + 1;
                    $previous_year = $currently_processing_year - 1;
                    ?>
                    <a href="finance/monthlyExpense?year=<?php echo $previous_year; ?>" class="btn btn-warning btn-sm px-4 py-3 mr-2">
                        <i class="fa fa-arrow-left"></i> <?php echo lang('previous_year'); ?>
                    </a>
                    <a href="finance/monthlyExpense?year=<?php echo $next_year; ?>" class="btn btn-success btn-sm px-4 py-3 mr-2">
                        <i class="fa fa-arrow-right"></i> <?php echo lang('next_year'); ?>
                    </a>
                    <a class="btn btn-secondary btn-sm px-4 py-3" onclick="javascript:window.print();">
                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('expense_report'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample1">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $time = mktime(12, 0, 0, $month, 1, $year);
                                        if (!empty($all_expenses[date('m-Y', $time)])) {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = $all_expenses[date('m-Y', $time)];
                                            }
                                        } else {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = 0;
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo lang($month_name); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($amount, 2, '.', ','); ?></td>
                                            <?php $total_amount[] = $amount; ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($total_amount)) {
                                        $total_amount = array_sum($total_amount);
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>

                                    <tr class="total_amount">
                                        <td class="font-weight-bold"><?php echo lang('total'); ?></td>
                                        <td class="font-weight-bold"><?php echo $this->currency; ?><?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                    </tr>
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

</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>

</body>

</html>
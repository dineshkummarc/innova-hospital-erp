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
                        <i class="fas fa-chart-line text-primary mr-3"></i>
                        <?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
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
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <div class="row">
                                <section class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0"><i class="fas fa-calendar-week mr-2"></i><?php echo lang('this_week'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-success"><i class="fas fa-arrow-up mr-2"></i><?php echo lang('income'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_week_total_income, 2, '.', ','); ?></h4>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-danger"><i class="fas fa-arrow-down mr-2"></i><?php echo lang('expense'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_week_total_expense, 2, '.', ','); ?></h4>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold"><?php echo lang('net_profit'); ?></span>
                                                <h3 class="text-primary"><?php echo $this->currency; ?><?php echo number_format(($this_week_total_income - $this_week_total_expense), 2, '.', ','); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-success">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i><?php echo lang('this_month'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-success"><i class="fas fa-arrow-up mr-2"></i><?php echo lang('income'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_month_total_income, 2, '.', ','); ?></h4>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-danger"><i class="fas fa-arrow-down mr-2"></i><?php echo lang('expense'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_month_total_expense, 2, '.', ','); ?></h4>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold"><?php echo lang('net_profit'); ?></span>
                                                <h3 class="text-success"><?php echo $this->currency; ?><?php echo number_format(($this_month_total_income - $this_month_total_expense), 2, '.', ','); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-info">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="fas fa-calendar-minus mr-2"></i><?php echo lang('last_30_days'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-success"><i class="fas fa-arrow-up mr-2"></i><?php echo lang('income'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_last_30_total_income, 2, '.', ','); ?></h4>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-danger"><i class="fas fa-arrow-down mr-2"></i><?php echo lang('expense'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($this_last_30_total_expense, 2, '.', ','); ?></h4>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold"><?php echo lang('net_profit'); ?></span>
                                                <h3 class="text-info"><?php echo $this->currency; ?><?php echo number_format(($this_last_30_total_income - $this_last_30_total_expense), 2, '.', ','); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-warning">
                                        <div class="card-header bg-warning text-white">
                                            <h5 class="mb-0"><i class="fas fa-chart-pie mr-2"></i><?php echo lang('total'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-success"><i class="fas fa-arrow-up mr-2"></i><?php echo lang('income'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($total_income, 2, '.', ','); ?></h4>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-danger"><i class="fas fa-arrow-down mr-2"></i><?php echo lang('expense'); ?></span>
                                                <h4><?php echo $this->currency; ?><?php echo number_format($total_expense, 2, '.', ','); ?></h4>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold"><?php echo lang('net_profit'); ?></span>
                                                <h3 class="text-warning"><?php echo $this->currency; ?><?php echo number_format(($total_income - $total_expense), 2, '.', ','); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!--main content end-->

<style>
    .panel-heading {
        margin-bottom: 20px;
    }
</style>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>
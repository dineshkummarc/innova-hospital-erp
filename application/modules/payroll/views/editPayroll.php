<link href="common/extranal/css/payroll/editPayroll.css" rel="stylesheet">




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-check-alt mr-2"></i><?php echo lang('payroll'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="payroll"><?php echo lang('payroll') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('edit') ?> <?php echo lang('payroll') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the payroll details'); ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="payroll/updatePayroll">
                                <div class="row payroll_div">
                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('name'); ?></label>
                                        <input type="text" class="form-control form-control-lg" value="<?php echo $user->username; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('paid_on'); ?></label>
                                        <input type="text" class="form-control  single_date_picker" name="paid_on" value="<?php echo $result->paid_on != null ? $result->paid_on : ''; ?>">
                                    </div>
                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('status'); ?></label>
                                        <select class="form-control ca_select2" name="status">
                                            <option value="Generated" <?php if ($result->status == 'Generated') { ?> selected <?php } ?>><?php echo lang('generated'); ?></option>
                                            <option value="Paid" <?php if ($result->status == 'Paid') { ?> selected <?php } ?>><?php echo lang('paid'); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('expense'); ?></label>
                                        <input type="number" class="form-control form-control-lg" placeholder="Enter Expense Amount" name="expense" value="<?php echo $result->expense != null ? $result->expense : ''; ?>">
                                    </div>



                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('earning'); ?></label>
                                        <div id="earning_div">
                                            <?php for ($i = 0; $i < count($earning); $i++) { ?>
                                                <div id="earning-<?php echo $i; ?>">
                                                    <input name="earningName[]" class="form-control mb-1" value="<?php echo $earning[$i]['name']; ?>" <?php if ($i == 0) { ?>readonly<?php } ?>>
                                                    <div class="mb-1 number_div">
                                                        <input type="number" placeholder="Enter Amount" name="earningValue[]" class="form-control form-control-lg" value="<?php echo $earning[$i]['value']; ?>">
                                                        <?php if ($i > 0) { ?>
                                                            <button class="btn btn-danger earning_remove" data-id='<?php echo $id; ?>'><i class="fas fa-minus"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <button type="button" class="btn btn-success addEarning mb-1"><?php echo lang('add') . " " . lang('earning') ?></button>
                                        <input type="hidden" id="earningCount" value="<?php count($earning); ?>">
                                    </div>

                                    <div class="col-md-6 payroll_details">
                                        <label><?php echo lang('deduction'); ?></label>
                                        <div id="deduction_div">
                                            <?php for ($i = 0; $i < count($deduction); $i++) { ?>
                                                <div id="deduction-<?php echo $id; ?>">
                                                    <input name="deductionName[]" placeholder="Enter Deduction Title" class="form-control mb-1" value="<?php echo $deduction[$i]['name']; ?>">
                                                    <div class="mb-1 number_div">
                                                        <input type="number" placeholder="Enter Amount" name="deductionValue[]" class="form-control form-control-lg" value="<?php echo $deduction[$i]['value']; ?>">
                                                        <button type="button" class="btn btn-danger deduction_remove" data-id='<?php echo $id; ?>'><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <button type="button" class="btn btn-success addDeduction mb-1"><?php echo lang('add') . " " . lang('deduction') ?></button>
                                        <input type="hidden" id="deductionCount" value="<?php count($deduction); ?>">
                                    </div>
                                    <input type='hidden' name="id" value="<?php echo $result->id; ?>">
                                    <div class='col-md-12 text-right'>
                                        <button type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>








<!--main content end-->
<!--footer start-->







<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/payroll/editpayroll.js"></script>
<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>
                        <?php echo lang('pharmacy'); ?> <?php echo lang('today_expense'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('pharmacy'); ?> <?php echo lang('today_expense'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('All te todays pharmacy expense'); ?></h3>
                            <div class="float-right">
                                <a href="finance/pharmacy/addExpenseView"">
                                    <button id="" class=" btn btn-success btn-sm">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('category'); ?> </th>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <th> <?php echo lang('options'); ?> </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($expenses as $expense) { ?>
                                        <tr class="">
                                            <td><?php echo $expense->category; ?></td>
                                            <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                            <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>
                                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                                <td>
                                                    <a class="btn btn-info btn-xs editbutton width_auto" href="finance/pharmacy/editExpense?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>
                                                    <a class="btn btn-info btn-xs delete_button width_auto" href="finance/pharmacy/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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

<script src="common/extranal/js/finance/today_expense.js"></script>
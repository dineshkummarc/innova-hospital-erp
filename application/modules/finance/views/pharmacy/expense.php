<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-alt text-primary mr-3"></i>
                        <?php echo lang('expenses') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('expenses') ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold"><?php echo lang('All the pharmacy expenses'); ?></h3>
                            <div class="float-right">
                                <a href="finance/pharmacy/addExpenseView">
                                    <button id="" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover" id="editable-sample">
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
                                                    <a class="btn btn-info btn-sm editbutton" href="finance/pharmacy/editExpense?id=<?php echo $expense->id; ?>">
                                                        <i class="fa fa-edit"></i> <?php echo lang('edit'); ?>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="finance/pharmacy/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                                    </a>
                                                </td>
                                            <?php } ?>
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






<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/pharmacy/expense.js"></script>
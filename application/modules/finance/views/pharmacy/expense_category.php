<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-list-alt text-primary mr-3"></i>
                        <?php echo lang('expense_categories') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('expense_categories') ?></li>
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
                            <h3 class="card-title font-weight-bold"><?php echo lang('All the pharmacy expense categories'); ?></h3>
                            <div class="float-right">
                                <a href="finance/pharmacy/addExpenseCategoryView">
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
                                        <th><?php echo lang('category'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) { ?>
                                        <tr class="">
                                            <td><?php echo $category->category; ?></td>
                                            <td> <?php echo $category->description; ?></td>
                                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                                <td class="no-print">
                                                    <a class="btn btn-info btn-sm editbutton mr-1" title="<?php echo lang('edit'); ?>" href="finance/pharmacy/editExpenseCategory?id=<?php echo $category->id; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" href="finance/pharmacy/deleteExpenseCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash"></i>
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
<script src="common/extranal/js/finance/expense_category.js"></script>
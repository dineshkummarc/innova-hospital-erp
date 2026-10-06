<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-plus-circle text-primary mr-3"></i>
                        <?php
                        if (!empty($category->id))
                            echo lang('pharmacy') . ' ' . lang('edit_expense_category');
                        else
                            echo lang('pharmacy') . ' ' . lang('add_expense_category');
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="finance/pharmacy/home"><?php echo lang('pharmacy'); ?></a></li>
                            <li class="breadcrumb-item"><a href="finance/pharmacy/expense"><?php echo lang('expense'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($category->id))
                                    echo lang('pharmacy') . ' ' . lang('edit_expense_category');
                                else
                                    echo lang('pharmacy') . ' ' . lang('add_expense_category');
                                ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-800">Add expense category for pharmacy</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-4">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/pharmacy/addExpenseCategory" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="category" value='<?php
                                                                                                                                if (!empty($category->category)) {
                                                                                                                                    echo $category->category;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="description" value='<?php
                                                                                                                                if (!empty($category->description)) {
                                                                                                                                    echo $category->description;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($category->id)) {
                                                                            echo $category->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                    <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                                </button>
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
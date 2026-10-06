<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                        <?php
                        if (!empty($category->id)) {
                            echo lang('edit_expense_category');
                        } else {
                            echo lang('add_expense_category');
                        }
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="finance/expenseCategory" class="text-primary"><?php echo lang('expense_categories'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold">
                                <?php
                                if (!empty($category->id)) {
                                    echo lang('edit_expense_category');
                                } else {
                                    echo lang('add_expense_category');
                                }
                                ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">

                        <div class="card-body bg-light p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/addExpenseCategory" method="post" enctype="multipart/form-data">

                                <div class="form-group mb-4">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="category" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('category');
                                                                                                                                }
                                                                                                                                if (!empty($category->category)) {
                                                                                                                                    echo $category->category;
                                                                                                                                }
                                                                                                                                ?>' required="">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="description" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('description');
                                                                                                                                }
                                                                                                                                if (!empty($category->description)) {
                                                                                                                                    echo $category->description;
                                                                                                                                }
                                                                                                                                ?>' required="">
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($category->id)) {
                                                                            echo $category->id;
                                                                        }
                                                                        ?>'>

                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!--main content end-->
<!--footer start-->
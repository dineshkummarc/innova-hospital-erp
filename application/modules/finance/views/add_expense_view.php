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
                        if (!empty($expense->id)) {
                            echo lang('edit_expense');
                        } else {
                            echo lang('add_expense');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="finance/expense"><?php echo lang('expense'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($expense->id)) {
                                    echo lang('edit_expense');
                                } else {
                                    echo lang('add_expense');
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
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/addExpense" method="post" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg select2" name="category" required="">
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->category; ?>" <?php
                                                                                                if (!empty($setval)) {
                                                                                                    if ($category->category == set_value('category')) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                if (!empty($expense->category)) {
                                                                                                    if ($category->category == $expense->category) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>> <?php echo $category->category; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('amount'); ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?php echo $settings->currency; ?></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="amount" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('amount');
                                                                                                                                    }
                                                                                                                                    if (!empty($expense->amount)) {
                                                                                                                                        echo $expense->amount;
                                                                                                                                    }
                                                                                                                                    ?>' required="">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('remarks'); ?></label>
                                    <textarea class="form-control form-control-lg" name="note" rows="3"><?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('note');
                                                                                                        }
                                                                                                        if (!empty($expense->note)) {
                                                                                                            echo $expense->note;
                                                                                                        }
                                                                                                        ?></textarea>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($expense->id)) {
                                                                            echo $expense->id;
                                                                        }
                                                                        ?>'>

                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
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
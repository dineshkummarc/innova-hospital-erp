<!--sidebar end-->
<!--main content start-->

<!-- <link href="common/extranal/css/medicine/add_new_medicine_view.css" rel="stylesheet"> -->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-pills text-primary mr-3"></i>
                        <?php
                        if (!empty($medicine->id)) {
                            echo lang('edit') . ' ' . lang('medicine');
                        } else {
                            echo lang('add') . ' ' . lang('new') . ' ' . lang('medicine');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($medicine->id)) {
                                    echo lang('edit') . ' ' . lang('medicine');
                                } else {
                                    echo lang('add') . ' ' . lang('medicine');
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
                        <div class="card-body p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                        if (!empty($medicine->name)) {
                                                                                                                            echo $medicine->name;
                                                                                                                        }
                                                                                                                        ?>' required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg select2" name="category" required="">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                                                                        if (!empty($medicine->category)) {
                                                                                                            if ($category->category == $medicine->category) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>> <?php echo $category->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('purchase'); ?> <?php echo lang('price'); ?> <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control form-control-lg" name="price" value='<?php
                                                                                                                                        if (!empty($medicine->price)) {
                                                                                                                                            echo $medicine->price;
                                                                                                                                        }
                                                                                                                                        ?>' required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('selling'); ?> <?php echo lang('price'); ?> <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control form-control-lg" name="s_price" value='<?php
                                                                                                                                            if (!empty($medicine->s_price)) {
                                                                                                                                                echo $medicine->s_price;
                                                                                                                                            }
                                                                                                                                            ?>' required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('store'); ?> <?php echo lang('box'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="box" value='<?php
                                                                                                                        if (!empty($medicine->box)) {
                                                                                                                            echo $medicine->box;
                                                                                                                        }
                                                                                                                        ?>'>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <strong><?php echo lang('note'); ?>:</strong> <?php echo lang('quantity_will_be_calculated'); ?> (<?php echo lang('total_purchases'); ?> - <?php echo lang('total_sales'); ?>)
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('generic'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" name="generic" value='<?php
                                                                                                                            if (!empty($medicine->generic)) {
                                                                                                                                echo $medicine->generic;
                                                                                                                            }
                                                                                                                            ?>' required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('company'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="company" value='<?php
                                                                                                                            if (!empty($medicine->company)) {
                                                                                                                                echo $medicine->company;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('effects'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="effects" value='<?php
                                                                                                                            if (!empty($medicine->effects)) {
                                                                                                                                echo $medicine->effects;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($medicine->id)) {
                                                                            echo $medicine->id;
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
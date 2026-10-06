<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-pills text-primary mr-3"></i>
                        <?php
                        if (!empty($medicine->id)) {
                            echo lang('edit_medicine_category');
                        } else {
                            echo lang('add_medicine_category');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/medicineCategory"><?php echo lang('medicine_category'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($medicine->id)) {
                                    echo lang('edit_medicine_category');
                                } else {
                                    echo lang('add_medicine_category');
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
                            <form role="form" action="medicine/addNewCategory" method="post" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="category" value='<?php
                                                                                                                    if (!empty($medicine->category)) {
                                                                                                                        echo $medicine->category;
                                                                                                                    }
                                                                                                                    ?>' required="">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-lg" name="description" rows="3"><?php
                                                                                                                if (!empty($medicine->description)) {
                                                                                                                    echo $medicine->description;
                                                                                                                }
                                                                                                                ?></textarea>
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
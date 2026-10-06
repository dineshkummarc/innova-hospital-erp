<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-2"></i><?php
                                                                                            if (!empty($category->id)) {
                                                                                                echo lang('edit_payment_categories');
                                                                                            } else {
                                                                                                echo lang('add_payment_category');
                                                                                            }
                                                                                            ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($category->id)) {
                                                                echo lang('edit_payment_categories');
                                                            } else {
                                                                echo lang('add_payment_category');
                                                            }
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/addCategory" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast; </label>
                                    <input type="text" class="form-control form-control-lg" name="category" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('category');
                                                                                                                    }
                                                                                                                    if (!empty($category->category)) {
                                                                                                                        echo $category->category;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast; </label>
                                    <input type="text" class="form-control form-control-lg" name="description" value='<?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('description');
                                                                                                                        }
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
                                <div class="form-group cl-md-12">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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
<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-concierge-bell mr-2"></i>
                        <?php
                        if (!empty($pservice->id))
                            echo lang('edit_pservice');
                        else
                            echo lang('add_pservice');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('pservice') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" action="pservice/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($pservice->name)) {
                                                                                                                                            echo $pservice->name;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                                    <input type="text" class="form-control form-control-lg" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($pservice->code)) {
                                                                                                                                            echo $pservice->code;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                                    <input type="text" class="form-control form-control-lg" name="alpha_code" id="exampleInputEmail1" value='<?php
                                                                                                                                                if (!empty($pservice->alpha_code)) {
                                                                                                                                                    echo $pservice->alpha_code;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                                    <input type="text" class="form-control form-control-lg" min="0" name="price" id="exampleInputEmail1" value='<?php
                                                                                                                                                if (!empty($pservice->price)) {
                                                                                                                                                    echo $pservice->price;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="" required="">
                                </div>


                                <div class="form-group">

                                    <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='' <?php
                                                                                                                    if (!empty($pservice->active)) {
                                                                                                                        if ($pservice->active == "1") {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                                    <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                                </div>





                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($pservice->id)) {
                                                                            echo $pservice->id;
                                                                        }
                                                                        ?>'>


                                <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
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
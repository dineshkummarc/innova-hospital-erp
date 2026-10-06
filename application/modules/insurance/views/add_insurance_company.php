<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><strong><i class="fas fa-building"></i> <?php
                                                                if (!empty($insurance_company->id))
                                                                    echo lang('edit_insurance_company');
                                                                else
                                                                    echo lang('add_insurance_company');
                                                                ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($insurance_company->id))
                                                                echo lang('edit_insurance_company');
                                                            else
                                                                echo lang('add_insurance_company');
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
                            <form role="form" action="insurance/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('company'); ?> <?php echo lang('name'); ?> &#42;</label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('name');
                                                                                                                                        }
                                                                                                                                        if (!empty($insurance_company->name)) {
                                                                                                                                            echo $insurance_company->name;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast; </label>
                                    <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="" rows="10" cols="20"><?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('description');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($insurance_company->description)) {
                                                                                                                                                        echo $insurance_company->description;
                                                                                                                                                    }
                                                                                                                                                    ?></textarea>

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($insurance_company->id)) {
                                                                            echo $insurance_company->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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




<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/accountant.js"></script>
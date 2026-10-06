<!--sidebar end-->
<!--main content start-->


<link href="common/extranal/css/notice/add_new.css" rel="stylesheet">
<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-clipboard-list text-primary mr-3"></i>
                        <?php
                        if (!empty($notice->id))
                            echo lang('edit_notice');
                        else
                            echo lang('add_notice');
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="notice"><?php echo lang('notice'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($notice->id))
                                    echo lang('edit_notice');
                                else
                                    echo lang('add_notice');
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
                            <?php echo $this->session->flashdata('feedback'); ?>

                            <form role="form" action="notice/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('title'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                                if (!empty($notice->name)) {
                                                                                                                    echo $notice->name;
                                                                                                                }
                                                                                                                ?>' required="">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('notice'); ?> <?php echo lang('for'); ?></label>
                                    <select class="form-control form-control-lg select2" name="type">
                                        <option value="patient" <?php
                                                                if (!empty($notice->type)) {
                                                                    if ($notice->type == 'patient') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('patient'); ?></option>
                                        <option value="staff" <?php
                                                                if (!empty($notice->type)) {
                                                                    if ($notice->type == 'staff') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('staff'); ?></option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="ckeditor form-control editor" id="editor" name="description" rows="5" required=""></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase text-sm"><?php echo lang('date'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg default-date-picker" name="date" onkeypress="return false;" required="">
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($notice->id)) {
                                                                            echo $notice->id;
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



<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/notice/add_new.css" rel="stylesheet">
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($notice->id))
                    echo lang('edit_notice');
                else
                    echo lang('add_notice');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="notice/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                                <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                            if (!empty($notice->name)) {
                                                                                                                echo $notice->name;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> Notice For</label>
                                <select class="form-control form-control-lg m-bot15" name="type" value=''>
                                    <option value="patient" <?php
                                                            if (!empty($notice->type)) {
                                                                if ($notice->type == 'patient') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo lang('patient'); ?></option>
                                    <option value="staff" <?php
                                                            if (!empty($notice->type)) {
                                                                if ($notice->type == 'staff') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo lang('staff'); ?></option>

                                </select>
                            </div>


                            <div class="form-group col-md-12 des">
                                <label class="control-label col-md-3"><?php echo lang('description'); ?> &ast;</label>
                                <div class="col-md-12 des">
                                    <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10" required=""> </textarea>
                                </div>
                            </div>



                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                                <input type="text" class="form-control form-control-lg default-date-picker" name="date" onkeypress="return false;" value='' placeholder="" required="">
                            </div>




                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($notice->id)) {
                                                                        echo $notice->id;
                                                                    }
                                                                    ?>'>


                            <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                        </form>

                    </div>
                </div>

            </div>
        </section>
    </section>
    <!-- page end-->
</section>
<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/notice.js"></script>
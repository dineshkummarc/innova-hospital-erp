<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($featured->id))
                    echo  lang('edit_featured');
                else
                    echo  lang('add_featured');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="featured/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                    echo set_value('name');
                                                                                                                                                }
                                                                                                                                                if (!empty($featured->name)) {
                                                                                                                                                    echo $featured->name;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('profile'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="profile" id="exampleInputEmail1" value='<?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('profile');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($featured->profile)) {
                                                                                                                                                        echo $featured->profile;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast; </label>
                                            <input type="text" class="form-control form-control-lg" name="description" id="exampleInputEmail1" value='<?php
                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                            echo set_value('description');
                                                                                                                                                        }
                                                                                                                                                        if (!empty($featured->description)) {
                                                                                                                                                            echo $featured->description;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($featured->id)) {
                                                                                    echo $featured->id;
                                                                                }
                                                                                ?>'>
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
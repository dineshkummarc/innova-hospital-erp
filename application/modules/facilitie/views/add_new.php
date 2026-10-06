<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($facilitie->id))
                    echo lang('edit_facilitie');
                else
                    echo lang('add_facilitie');
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
                        <form role="form" action="facilitie/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                                <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('title');
                                                                                                            }
                                                                                                            if (!empty($facilitie->title)) {
                                                                                                                echo $facilitie->title;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                                <select class="form-control form-control-lg m-bot15 col-sm-9" name="align" value=''>
                                    <option value="Right" <?php
                                                            if (!empty($setval)) {
                                                                if (set_value('align') == 'Right') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            if (!empty($facilitie->align)) {
                                                                if ($facilitie->align == 'Right') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>> <?php echo lang('Right'); ?> </option>
                                    <option value="Left" <?php
                                                            if (!empty($setval)) {
                                                                if (set_value('align') == 'Left') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            if (!empty($facilitie->align)) {
                                                                if ($facilitie->align == 'Left') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>> <?php echo lang('Left'); ?> </option>
                                </select>
                            </div>

                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($facilitie->id)) {
                                                                        echo $facilitie->id;
                                                                    }
                                                                    ?>'>
                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
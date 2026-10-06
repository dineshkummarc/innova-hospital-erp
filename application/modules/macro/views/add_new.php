<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($macro->id))
                    echo lang('edit_macro');
                else
                    echo lang('add_macro');
                ?>
            </header>
            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="macro/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">


                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control form-control-lg" name="short_name" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('short_name');
                                                                                                                                }
                                                                                                                                if (!empty($macro->short_name)) {
                                                                                                                                    echo $macro->short_name;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                                            <input type="text" class="form-control form-control-lg" name="description" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('description');
                                                                                                                                }
                                                                                                                                if (!empty($macro->description)) {
                                                                                                                                    echo $macro->description;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                        </div>


                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($macro->id)) {
                                                                                    echo $macro->id;
                                                                                }
                                                                                ?>'>


                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
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

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/macro.js"></script>
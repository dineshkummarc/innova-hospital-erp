<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="card">
            <div class="card-header">
                <?php
                if (!empty($accountant->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_doctor_visit');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_doctor_visit');
                ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="adv-table editable-table">
                            <div class="clearfix">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <?php echo validation_errors(); ?>
                                                    <?php echo $this->session->flashdata('feedback'); ?>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <form role="form" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label for="adoctors" class="col-sm-3 col-form-label"><?php echo lang('doctor'); ?></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control form-control-lg" id="adoctors" name="doctor" required="">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="visit_description" class="col-sm-3 col-form-label"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-lg" name="visit_description" id="visit_description" value='<?php
                                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                                            echo set_value('visit_description');
                                                                                                                                                                        }
                                                                                                                                                                        if (!empty($doctorvisit->visit_description)) {
                                                                                                                                                                            echo $doctorvisit->visit_description;
                                                                                                                                                                        }
                                                                                                                                                                        ?>' placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="visit_charges" class="col-sm-3 col-form-label"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-lg" name="visit_charges" id="visit_charges" value='<?php
                                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                                    echo set_value('visit_charges');
                                                                                                                                                                }
                                                                                                                                                                if (!empty($doctorvisit->visit_charges)) {
                                                                                                                                                                    echo $doctorvisit->visit_charges;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3 col-form-label"><?php echo lang('status'); ?></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control form-control-lg" name="status">
                                                            <option value="active"><?php echo lang('active'); ?></option>
                                                            <option value="disable"><?php echo lang('in_active'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3">
                                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>
<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-md text-primary mr-3"></i>
                        <?php echo lang('doctor_visit'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('doctor_visit'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                            <i class="fa fa-plus"></i> <?php echo lang('add_doctor_visit'); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Comprehensive List of Visit Types and Associated Charges for Each Doctor'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase">#</th>
                                        <th class="font-weight-bold"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>







<!--main content end-->
<!--footer start-->


<!-- Add Doctor Visit Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('add_doctor_visit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="adoctors"><?php echo lang('doctor'); ?> &#42;</label>
                        <select class="form-control select2" id="adoctors" name="doctor" required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visit_description"><?php echo lang('visit'); ?> <?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="visit_description" id="visit_description" required="">
                    </div>
                    <div class="form-group">
                        <label for="visit_charges"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?> &#42;</label>
                        <input type="number" min="1" class="form-control" name="visit_charges" id="visit_charges" placeholder="<?php echo $settings->currency; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="status"><?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control select2" name="status" id="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Doctor Visit Modal -->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('edit_doctor_visit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorvisitForm" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="adoctors1"><?php echo lang('doctor'); ?> &#42;</label>
                        <select class="form-control select2" id="adoctors1" name="doctor" required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visit_description_edit"><?php echo lang('visit'); ?> <?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="visit_description" id="visit_description_edit" required="">
                    </div>
                    <div class="form-group">
                        <label for="visit_charges_edit"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?> &#42;</label>
                        <input type="number" min="1" class="form-control" name="visit_charges" id="visit_charges_edit" placeholder="<?php echo $settings->currency; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="status_edit"><?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control select2" name="status" id="status_edit">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>
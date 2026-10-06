<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                        <?php echo lang('leave'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('leave'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('leave'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-light">
                            <h3 class="card-title font-weight-bold"><?php echo lang('All the leave names and related informations'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang('employee'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('leave_date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('leave_status'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('leave_type'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('leave_reason'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('duration'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
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










<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_leave'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="leave/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('choose_staff'); ?> &ast;</label>
                            <select name="staff" class="form-control form-control-lg" id="add_leave_staff" required=""></select>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('leave_type'); ?> &ast;</label>
                        <select name="leave_type" class="ca_select2 form-control" id="ca_select2" required="">
                            <?php foreach ($leave_types as $leaveType) { ?>
                                <option value="<?php echo $leaveType->name; ?>"><?php echo $leaveType->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('select_duration'); ?> &ast;</label>
                        <div class="check_div">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio1" value="single" checked>
                                <label class="form-check-label" for="inlineRadio1"><?php echo lang('single'); ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio2" value="multiple">
                                <label class="form-check-label" for="inlineRadio2"><?php echo lang('multiple'); ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input leave_duration" type="radio" name="duration" id="inlineRadio3" value="halfday">
                                <label class="form-check-label" for="inlineRadio3"><?php echo lang('halfday'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group singleDate">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                        <input type="text" class="form-control single_date_picker" name="date" value='' placeholder="" autocomplete="off">
                    </div>

                    <div class="form-group multiDate">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control " name="date2" id="multi_date_picker" placeholder="" readonly="" multiple="">
                    </div>

                    <div class="col-md-6"></div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('reason_for_leave'); ?> &ast;</label>
                        <textarea class="form-control reason" name="reason" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?> &ast;</label>
                        <select name="status" class="ca_select2 form-control" required>
                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <option value="approved"><?php echo lang('approved'); ?></option>
                            <?php } ?>
                            <option value="pending"><?php echo lang('pending'); ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_leave'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editLeaveForm" class="clearfix" action="leave/updateLeave" method="post" enctype="multipart/form-data">
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('choose_staff'); ?> &ast;</label>
                            <select name="staff" class="form-control form-control-lg" id="edit_leave_staff" required=""></select>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('leave_type'); ?> &ast;</label>
                        <select name="leave_type" class="ca_select2 form-control" id="edit_Leave_select2" required="">
                            <?php foreach ($leave_types as $leaveType) { ?>
                                <option value="<?php echo $leaveType->name; ?>"><?php echo $leaveType->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('select_duration'); ?> &ast;</label>
                        <div class="check_div">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input edit_leave_duration" type="radio" name="duration" id="single" value="single">
                                <label class="form-check-label" for="inlineRadio1"><?php echo lang('single'); ?></label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input edit_leave_duration" type="radio" name="duration" id="halfday" value="halfday">
                                <label class="form-check-label" for="inlineRadio3"><?php echo lang('halfday'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group singleDate">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                        <input type="text" class="form-control single_date_picker readonly" name="date" id="editDate" value='' placeholder="">
                    </div>

                    <div class="form-group multiDate">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control " name="date2" id="edit_multi_date_picker" placeholder="" readonly="" multiple="">
                    </div>

                    <div class="col-md-6"></div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('reason_for_leave'); ?> &ast;</label>
                        <textarea class="form-control reason" name="reason" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?> &ast;</label>
                        <select name="status" id="editLeaveStatus" class="ca_select2 form-control" required <?php if (!$this->ion_auth->in_group(array('admin'))) { ?>disabled<?php } ?>>
                            <option value="approved"><?php echo lang('approved'); ?></option>
                            <option value="pending"><?php echo lang('pending'); ?></option>
                        </select>
                    </div>
                    <input type="hidden" name="id" id="editLeaveId">
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->



<div class="modal fade" id="infoModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-6">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_url">
                                    <img src="" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_class"></div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('department'); ?></label>
                        <div class="departmentClass"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('profile'); ?></label>
                        <div class="profileClass"></div>
                    </div>


                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var select_staff = "<?php echo lang('select_staff'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/leave/leave.js"></script>
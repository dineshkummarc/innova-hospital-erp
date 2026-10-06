<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                        <?php echo lang('holiday'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="schedule/timeSchedule"><?php echo lang('schedule'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('holiday'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('holiday'); ?>
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
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase">#</th>
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($holidays as $holiday) {
                                        $i = $i + 1;
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo date('d-m-Y', $holiday->date); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm editbutton" data-toggle="modal" data-id="<?php echo $holiday->id; ?>">
                                                    <i class="fa fa-edit"></i> <?php echo lang('edit'); ?>
                                                </button>
                                                <a class="btn btn-danger btn-sm delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctorr; ?>&redirect=schedule/holidays?doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Holiday Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-gradient-primary">
                <h2 class="modal-title text-white font-weight-800"><?php echo lang('add'); ?> <?php echo lang('holiday'); ?></h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" action="schedule/addHoliday" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('date'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" name="date" autocomplete="off" required="">
                    </div>

                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                        <i class="fas fa-calendar-plus mr-3"></i><?php echo lang('submit'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Holiday Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-gradient-primary">
                <h2 class="modal-title text-white font-weight-800"><?php echo lang('edit'); ?> <?php echo lang('holiday'); ?></h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('date'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" name="date" autocomplete="off" required="">
                    </div>

                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                        <i class="fas fa-calendar-check mr-3"></i><?php echo lang('submit'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/schedule/holidays.js"></script>
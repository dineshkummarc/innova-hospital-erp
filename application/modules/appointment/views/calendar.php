<!--sidebar end-->
<!--main content start-->


<link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                        <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="appointment"><?php echo lang('appointment'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_appointment'); ?>
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
                            <aside>
                                <section class="panel">
                                    <div class="panel-body">
                                        <div id="calendar" class="has-toolbar calendar_view"></div>
                                    </div>
                                </section>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>











<!--main content end-->
<!--footer start-->
<div class="modal fade" role="dialog" id="cmodal">
    <div class="modal-dialog modal-xl med_his" role="document">
        <div class="modal-content">

            <div id='medical_history' class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
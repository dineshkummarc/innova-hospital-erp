<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-md text-primary mr-3"></i>
                        <?php echo lang('doctors_commission') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                            <li class="breadcrumb-item active"><?php echo lang('doctors_commission'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-800"><?php echo lang('Doctor commisions generated from finance payment'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <div class="row mb-4">
                                <div class="col-md-7">
                                    <form role="form" action="finance/doctorsCommission" method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                                    <input type="text" class="form-control form-control-lg shadow-sm dpd1" name="date_from" value="<?php
                                                                                                                                                    if (!empty($from)) {
                                                                                                                                                        echo $from;
                                                                                                                                                    }
                                                                                                                                                    ?>" placeholder="<?php echo lang('date_from'); ?>" required autocomplete="off">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control form-control-lg shadow-sm dpd2" name="date_to" value="<?php
                                                                                                                                                    if (!empty($to)) {
                                                                                                                                                        echo $to;
                                                                                                                                                    }
                                                                                                                                                    ?>" placeholder="<?php echo lang('date_to'); ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" name="submit" class="btn btn-primary btn-lg px-4"><?php echo lang('submit'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php if (!empty($from) && !empty($to)): ?>
                                <div class="alert alert-info mb-4">
                                    From <?php echo $from; ?> To <?php echo $to; ?>
                                </div>
                            <?php endif; ?>

                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('doctor_id'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('doctor'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('commission'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('total'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $doctor_intotal[] = array();
                                    foreach ($doctors as $doctor) { ?>
                                        <tr>
                                            <td><?php echo $doctor->id; ?></td>
                                            <td><?php echo $doctor->name; ?></td>
                                            <td><?php echo $settings->currency; ?>
                                                <?php
                                                foreach ($payments as $payment) {
                                                    if ($payment->doctor == $doctor->id) {
                                                        $doctor_amount[] = $payment->doctor_amount;
                                                    }
                                                }
                                                if (!empty($doctor_amount)) {
                                                    $doctor_total = array_sum($doctor_amount);
                                                    $doctor_intotal[] = $doctor_total;
                                                    echo $doctor_total;
                                                } else {
                                                    $doctor_total = 0;
                                                    $doctor_intotal[] = 0;
                                                    echo $doctor_total;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $settings->currency; ?>
                                                <?php
                                                $doctor_gross = $doctor_total;
                                                if (!empty($doctor_gross)) {
                                                    echo $doctor_gross;
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="finance/docComDetails?id=<?php echo $doctor->id; ?>">
                                                    <i class="fa fa-file-text"></i> <?php echo lang('details'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $doctor_amount = NULL; ?>
                                        <?php $doctor_gross = NULL; ?>
                                    <?php } ?>
                                    <tr class="font-weight-bold">
                                        <td colspan="2"></td>
                                        <td class="text-right"><?php echo lang('total') . ' ' . lang('commission'); ?>:</td>
                                        <td><?php echo $settings->currency . ' ' . array_sum($doctor_intotal); ?></td>
                                        <td></td>
                                    </tr>
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
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<!-- <script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script> -->
<script src="common/extranal/js/finance/doctor_commission.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dpd1, .dpd2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>
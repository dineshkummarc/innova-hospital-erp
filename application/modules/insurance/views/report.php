<link href="common/extranal/css/hospital/report_subscription.css" rel="stylesheet">
<?php
touch('common/js/countrypicker.js');
?>


<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-medical-alt text-primary mr-3"></i>
                        <?php echo lang('insurance_report') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('insurance_report'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-bold"><?php echo lang('filter_by'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <form role="form" action="finance/insuranceReport" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control form-control-lg shadow-sm dpd1" name="date_from" value="<?php if (!empty($from)) {
                                                                                                                                            echo $from;
                                                                                                                                        } ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                        <input type="text" class="form-control form-control-lg shadow-sm dpd2" name="date_to" value="<?php if (!empty($to)) {
                                                                                                                                            echo $to;
                                                                                                                                        } ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('insurance_company'); ?></label>
                                    <select class="form-control form-control-lg shadow-sm" id="company_select" name="company" value='' required="">
                                        <option value="all" <?php if ($company_select == 'all') {
                                                                echo 'selected';
                                                            } ?>><?php echo lang('all'); ?></option>
                                        <?php foreach ($insurance_companys as $company) { ?>
                                            <option value="<?php echo $company->id; ?>" <?php if ($company->id == $company_select) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $company->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                    <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-bold"><?php echo lang('insurance_report'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample1" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('invoice_id'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('company'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('bill'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('insurance'); ?> <?php echo lang('amount'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('patient'); ?> <?php echo lang('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($deposits as $deposit) {
                                        $total[] = $deposit->deposited_amount;
                                    ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', $deposit->date); ?></td>
                                            <td><?php echo $deposit->payment_id; ?></td>
                                            <td><?php echo $this->patient_model->getPatientById($deposit->patient)->name; ?></td>
                                            <td><?php
                                                $company_details = $this->db->get_where('insurance_company', array('id' => $deposit->insurance_company))->row();
                                                echo $company_details->name;
                                                ?></td>
                                            <td><?php echo $settings->currency . ' ' . $gross =  $this->finance_model->getPaymentById($deposit->payment_id)->gross_total; ?></td>
                                            <td><?php echo $settings->currency . ' ' . $deposit->deposited_amount; ?></td>
                                            <td><?php echo $settings->currency . ' ' . $gross - $deposit->deposited_amount; ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-success">
                            <h3 class="card-title text-white font-weight-bold"><?php echo lang('total'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <div class="text-center">
                                <h4 class="font-weight-bold text-muted mb-2"><?php echo lang('total'); ?> <?php echo lang('insurance'); ?> <?php echo lang('amount'); ?></h4>
                                <h2 class="display-4 font-weight-bold text-success">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($total)) {
                                        echo number_format(array_sum($total), 2);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/hospital/report_subscription.js"></script>

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
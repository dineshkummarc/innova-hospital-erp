<div class="content-wrapper bg-gradient-light">
    <!-- Content Header -->
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave fa-lg mr-3"></i>
                        <?php echo lang('payment_gateways') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('payment_gateways') ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Payment Gateways List -->
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white py-3">
                            <h3 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-list mr-2"></i>
                                <?php echo lang('All the Payment gateway names and related informations'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="editable-sample">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3">#</th>
                                            <th class="py-3"><?php echo lang('name'); ?></th>
                                            <th class="py-3"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($pgateways as $pgateway) {
                                            $i = $i + 1;
                                        ?>
                                            <tr>
                                                <td class="py-3"><?php echo $i; ?></td>
                                                <td class="py-3"><?php
                                                                    if (!empty($pgateway->name)) {
                                                                        echo $pgateway->name;
                                                                    }
                                                                    ?></td>
                                                <td class="py-3">
                                                    <a class="btn btn-info btn-sm" href="pgateway/settings?id=<?php echo $pgateway->id; ?>">
                                                        <i class="fas fa-cog mr-1"></i> <?php echo lang('manage'); ?>
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

                <!-- Payment Gateway Selection -->
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white py-3">
                            <h3 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-check-circle mr-2"></i>
                                <?php echo lang('select'); ?> <?php echo lang('payment_gateway'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <form role="form" id="editAppointmentForm" action="settings/selectPaymentGateway" method="post" enctype="multipart/form-data">
                                <?php foreach ($pgateways as $pgateway) { ?>
                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" readonly="" name="payment_gateway"
                                                id="customRadio<?php echo $pgateway->id; ?>"
                                                value='<?php echo $pgateway->name; ?>'
                                                <?php
                                                if (!empty($pgateway->name)) {
                                                    if ($settings->payment_gateway == $pgateway->name) {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>>
                                            <label class="custom-control-label h5" for="customRadio<?php echo $pgateway->id; ?>">
                                                <?php echo $pgateway->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value="<?php echo $settings->id; ?>">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block mt-4">
                                    <i class="fas fa-check mr-2"></i>
                                    <?php echo lang('submit'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>






<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/pgateway.js"></script>
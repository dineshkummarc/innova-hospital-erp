<link href="common/extranal/css/hospital/hospital.css" rel="stylesheet">
<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-hospital text-primary mr-3"></i>
                        <?php echo lang('all_hospitals') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('all_hospitals') ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="hospital/addNewView" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('create_new_hospital'); ?>
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
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('title'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('email'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('address'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('phone'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('country'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('next_renewal_date'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('package'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('status'); ?></th>
                                        <th class="font-weight-bold text-uppercase  no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hospitals as $hospital) { ?>
                                        <tr>
                                            <td><span class="font-weight-bold text-primary"><?php echo $hospital->name; ?></span></td>
                                            <td><span class="text-muted"><i class="fa fa-envelope mr-1"></i><?php echo $hospital->email; ?></span></td>
                                            <td><small class="text-muted"><i class="fa fa-map-marker-alt mr-1"></i><?php echo $hospital->address; ?></small></td>
                                            <td><span class="text-muted"><i class="fa fa-phone mr-1"></i><?php echo $hospital->phone; ?></span></td>
                                            <td><span class="badge badge-light"><?php echo !empty($hospital->country) ? $hospital->country : ' '; ?></span></td>
                                            <td>
                                                <?php
                                                $hospital_payment_details = $this->db->get_where('hospital_payment', array('hospital_user_id' => $hospital->id))->row();
                                                if (!empty($hospital_payment_details)) {
                                                    echo '<span class="badge badge-info">' . $hospital_payment_details->next_due_date . '</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="packageChange">
                                                <?php
                                                if (!empty($hospital->package)) {
                                                    echo '<span class="badge badge-primary">' . $this->package_model->getPackageById($hospital->package)->name . '</span>';
                                                }
                                                ?>
                                                <br>
                                                <?php if ($hospital_payment_details->next_due_date_stamp < time()) { ?>
                                                    <button type="button" data-payment-id="<?php echo $hospital->id; ?>" data-is-free="0" class="btn btn-warning btn-sm mt-2 selectPackage">
                                                        <i class="fa fa-sync-alt mr-1"></i><?php echo lang('renew'); ?>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="button" data-payment-id="<?php echo $hospital->id; ?>" data-is-free="0" class="btn btn-info btn-sm mt-2 selectPackage">
                                                        <i class="fa fa-exchange-alt mr-1"></i><?php echo lang('change'); ?>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                                if ($status == '1') { ?>
                                                    <span class="badge badge-success"><i class="fa fa-check-circle mr-1"></i><?php echo lang('active'); ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger"><i class="fa fa-times-circle mr-1"></i><?php echo lang('disabled'); ?></span>
                                                <?php } ?>
                                            </td>
                                            <td class="no-print">
                                                <div class="btn-group">
                                                    <?php if ($status == '1') { ?>
                                                        <a href="hospital/deactivate?hospital_id=<?php echo $hospital->ion_user_id; ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure you want to disable this hospital?');">
                                                            <i class="fa fa-ban mr-1"></i><?php echo lang('disable'); ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="hospital/activate?hospital_id=<?php echo $hospital->ion_user_id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to enable this hospital?');">
                                                            <i class="fa fa-check mr-1"></i><?php echo lang('enable'); ?>
                                                        </a>
                                                    <?php } ?>
                                                    <a href="hospital/editHospital?id=<?php echo $hospital->id; ?>" class="btn btn-info btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="hospital/delete?id=<?php echo $hospital->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
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

<!-- Add Event Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('create_new_hospital'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="hospital/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="phone" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>
                        <select class="form-control form-control-lg m-bot15" name="language" value=''>
                            <option value="english" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'english') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('english'); ?>
                            </option>
                            <option value="spanish" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'spanish') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('spanish'); ?>
                            </option>
                            <option value="french" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'french') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('french'); ?>
                            </option>
                            <option value="italian" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'italian') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('italian'); ?>
                            </option>
                            <option value="portuguese" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'portuguese') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('portuguese'); ?>
                            </option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-edit"></i> <?php echo lang('edit_hospital'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editHospitalForm" action="hospital/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="phone" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>
                        <select class="form-control form-control-lg m-bot15" name="language" value=''>
                            <option value="english" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'english') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('english'); ?>
                            </option>
                            <option value="spanish" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'spanish') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('spanish'); ?>
                            </option>
                            <option value="french" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'french') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('french'); ?>
                            </option>
                            <option value="italian" <?php
                                                    if (!empty($settings->language)) {
                                                        if ($settings->language == 'italian') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('italian'); ?>
                            </option>
                            <option value="portuguese" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'portuguese') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('portuguese'); ?>
                            </option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal4" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_deposit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editChangeForm" action="settings/changePlanPayment" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6 package_select_div">
                            <label for="exampleInputEmail1"> <?php echo lang('package'); ?></label>
                            <select class="form-control form-control-lg m-bot15 js-example-basic-single" id="package_select" name="package" value='' required>
                                <option><?php echo lang('select'); ?></option>
                                <?php foreach ($packages as $package) { ?>
                                    <option value="<?php echo $package->id; ?>"><?php echo $package->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 package_duration_div">
                            <label for="exampleInputEmail1"> <?php echo lang('package_duration'); ?></label>
                            <select class="form-control form-control-lg m-bot15 js-example-basic-single" id="package_duration" name="package_type" value=''>
                                <option value="<?php echo 'monthly'; ?>"><?php echo lang('monthly'); ?> </option>
                                <option value="<?php echo 'yearly'; ?>"><?php echo lang('yearly'); ?> </option>
                            </select>
                        </div>
                        <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('price'); ?></label>
                            <input type="text" class="form-control pay_in package_price price-input" name="package_price" value='' placeholder="" readonly="">
                        </div>
                        <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('next_due_date'); ?> </label>
                            <input type="text" class="form-control pay_in next_due_date" name="next_due_date" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="">
                                <label for="exampleInputEmail1"> <?php echo lang('deposit_type'); ?></label>
                            </div>
                            <div class="">
                                <select class="form-control form-control-lg m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="cardPayment">
                            <?php
                            $payment_gateway = $settings1->payment_gateway;
                            if ($payment_gateway == 'PayPal') {
                            ?>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                                    <select class="form-control form-control-lg m-bot15 js-example-basic-single" name="card_type" value=''>
                                        <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                        <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                        <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control form-control-lg" name="cardholder" value='' placeholder="">
                                </div>
                            <?php } ?>
                            <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control form-control-lg" id="card" name="card_number" value='' placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control form-control-lg" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" required="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?></label>
                                    <input type="text" class="form-control form-control-lg" id="cvv" name="cvv_number" value="" placeholder="" maxlength="3" required="">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div id="token"></div>
                        <input type="hidden" name="from" value='hospital'>
                        <input type="hidden" name="hospital_id" id="hospital_id" value=''>
                        <input type="hidden" name="id" id="package_id" value=''>
                        <div class="cashsubmit panel col-md-12 float-right">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right submit_button"> <?php echo lang('submit'); ?></button>
                        </div>
                        <div class="panel col-md-12 cardsubmit d-none">
                            <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row float-right submit_button" <?php
                                                                                                                                    if ($settings1->payment_gateway == 'Stripe') {
                                                                                                                                    ?>onClick="stripePay(event);" <?php }
                                                                                                                                                                    ?>> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var gateway = "<?php echo $gateway->publish; ?>";
</script>
<script src="common/extranal/js/hospital/hospital.js"></script>
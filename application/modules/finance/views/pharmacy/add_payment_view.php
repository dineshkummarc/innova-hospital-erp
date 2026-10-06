<!--sidebar end-->
<!--main content start-->

<!-- <link href="common/css/style.css" rel="stylesheet">  -->

<!-- <link href="common/css/bootstrap-reset.css" rel="stylesheet"> -->

<link href="common/extranal/css/pharmacy/add_payment_view.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-cash-register text-primary mr-3"></i>
                        <?php
                        if (!empty($payment->id)) {
                            echo lang('edit_payment') . ' (' . lang('invoice_id') . ': ' . $payment->id . ')';
                        } else {
                            echo lang('pharmacy') . ' ' . lang('poss');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('pharmacy'); ?></li>
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
                        <div class="card-body bg-light p-4">
                            <form role="form" class="clearfix pos form1" id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 row">
                                        <?php if (!empty($payment->id)) { ?>
                                            <div class="col-md-8 payment pad_bot d-flex">
                                                <div class="col-md-3 payment_label">
                                                    <label for="exampleInputEmail1"> <?php echo lang('invoice_id'); ?> :</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo '00' . $payment->id; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 payment">
                                            <div class="form-group last d-flex">
                                                <div class="col-sm-3 payment_label row">
                                                    <label for="exampleInputEmail1"> <?php echo lang('select_item'); ?></label>
                                                </div>
                                                <div class="col-sm-9 row category_div">
                                                    <?php if (empty($payment->id)) { ?>
                                                        <select name="category_name[]" class="multi-select1" id="my_multi_select4">

                                                        </select>
                                                    <?php } else { ?>
                                                        <select name="category_name[]" class="multi-select1" multiple="multiple" id="my_multi_select4">
                                                            <?php
                                                            if (!empty($payment)) {
                                                                $category_name = $payment->category_name;
                                                                $category_name1 = explode(',', $category_name);
                                                                foreach ($category_name1 as $category_name2) {
                                                                    $category_name3 = explode('*', $category_name2);
                                                                    $medicine = $this->medicine_model->getMedicineById($category_name3[0]);
                                                            ?>
                                                                    <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company . '*' . $medicine->box; ?>" data-qtity="<?php echo $category_name3[2]; ?>" selected="selected">
                                                                        <?php echo $medicine->name; ?>
                                                                    </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 qfloww">
                                        <p class="title"><?php echo lang('selected_items'); ?></p>
                                    </div>
                                    <div class="col-md-4 right-six">
                                        <div class="col-md-12 payment right-six d-flex">
                                            <div class="col-md-3 payment_label">
                                                <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="subtotal" id="subtotal" value='<?php
                                                                                                                                                        if (!empty($payment->amount)) {
                                                                                                                                                            echo $payment->amount;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder=" " disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12 payment right-six d-flex">
                                            <div class="col-md-3 payment_label">
                                                <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                                                                                                if ($discount_type == 'percentage') {
                                                                                                                    echo ' (%)';
                                                                                                                }
                                                                                                                ?> </label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="discount" id="dis_id" value='<?php
                                                                                                                                                        if (!empty($payment->discount)) {
                                                                                                                                                            $discount = explode('*', $payment->discount);
                                                                                                                                                            echo $discount[0];
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="<?php echo lang('discount'); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12 payment right-six d-flex">
                                            <div class="col-md-3 payment_label">
                                                <label for="exampleInputEmail1"> <?php echo lang('total'); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-lg shadow-sm" name="grsss" id="gross" value='<?php
                                                                                                                                                    if (!empty($payment->gross_total)) {
                                                                                                                                                        echo $payment->gross_total;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder=" " disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12 payment right-six mb-2">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6 float-right">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                                        <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($payment->id)) {
                                                                                    echo $payment->id;
                                                                                }
                                                                                ?>'>
                                        <div class="row">
                                        </div>
                                        <div class="form-group">
                                        </div>

                                    </div>
                                </div>
                            </form>
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
    var discount_type = "<?php echo $discount_type; ?>";
</script>
<script type="text/javascript">
    var medicine = "<?php echo lang('medicine'); ?>";
</script>
<script src="common/extranal/js/pharmacy/add_payment_view.js"></script>
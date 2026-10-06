<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-truck text-primary mr-3"></i>
                        <?php
                        if (!empty($supplier->id)) {
                            echo lang('edit') . ' ' . lang('supplier');
                        } else {
                            echo lang('add') . ' ' . lang('new') . ' ' . lang('supplier');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/suppliers"><?php echo lang('suppliers'); ?></a></li>
                            <li class="breadcrumb-item active">
                                <?php
                                if (!empty($supplier->id)) {
                                    echo lang('edit') . ' ' . lang('supplier');
                                } else {
                                    echo lang('add') . ' ' . lang('supplier');
                                }
                                ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="medicine/addNewSupplier" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('basic') . ' ' . lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('supplier') . ' ' . lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                        if (!empty($supplier->name)) {
                                                                                                                            echo $supplier->name;
                                                                                                                        }
                                                                                                                        ?>' required="">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('company') . ' ' . lang('name'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="company_name" value='<?php
                                                                                                                                if (!empty($supplier->company_name)) {
                                                                                                                                    echo $supplier->company_name;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('contact') . ' ' . lang('person'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="contact_person" value='<?php
                                                                                                                                    if (!empty($supplier->contact_person)) {
                                                                                                                                        echo $supplier->contact_person;
                                                                                                                                    }
                                                                                                                                    ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('email'); ?></label>
                                            <input type="email" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                            if (!empty($supplier->email)) {
                                                                                                                                echo $supplier->email;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="phone" value='<?php
                                                                                                                            if (!empty($supplier->phone)) {
                                                                                                                                echo $supplier->phone;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('mobile'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="mobile" value='<?php
                                                                                                                            if (!empty($supplier->mobile)) {
                                                                                                                                echo $supplier->mobile;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>
                                    </div>

                                    <!-- Address Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-map-marker-alt mr-2"></i><?php echo lang('address') . ' ' . lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('address'); ?></label>
                                            <textarea class="form-control form-control-lg" name="address" rows="3"><?php
                                                                                                                    if (!empty($supplier->address)) {
                                                                                                                        echo $supplier->address;
                                                                                                                    }
                                                                                                                    ?></textarea>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('city'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="city" value='<?php
                                                                                                                        if (!empty($supplier->city)) {
                                                                                                                            echo $supplier->city;
                                                                                                                        }
                                                                                                                        ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('state'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="state" value='<?php
                                                                                                                            if (!empty($supplier->state)) {
                                                                                                                                echo $supplier->state;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('country'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="country" value='<?php
                                                                                                                            if (!empty($supplier->country)) {
                                                                                                                                echo $supplier->country;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('postal_code'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="postal_code" value='<?php
                                                                                                                                if (!empty($supplier->postal_code)) {
                                                                                                                                    echo $supplier->postal_code;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>
                                    </div>

                                    <!-- Financial Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-dollar-sign mr-2"></i><?php echo lang('financial') . ' ' . lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('tax') . ' ' . lang('number'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="tax_number" value='<?php
                                                                                                                                if (!empty($supplier->tax_number)) {
                                                                                                                                    echo $supplier->tax_number;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('gst') . ' ' . lang('number'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="gst_number" value='<?php
                                                                                                                                if (!empty($supplier->gst_number)) {
                                                                                                                                    echo $supplier->gst_number;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('bank') . ' ' . lang('name'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="bank_name" value='<?php
                                                                                                                                if (!empty($supplier->bank_name)) {
                                                                                                                                    echo $supplier->bank_name;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('bank') . ' ' . lang('account'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="bank_account" value='<?php
                                                                                                                                if (!empty($supplier->bank_account)) {
                                                                                                                                    echo $supplier->bank_account;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('credit') . ' ' . lang('limit'); ?></label>
                                            <input type="number" step="0.01" class="form-control form-control-lg" name="credit_limit" value='<?php
                                                                                                                                                if (!empty($supplier->credit_limit)) {
                                                                                                                                                    echo $supplier->credit_limit;
                                                                                                                                                }
                                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('payment') . ' ' . lang('terms'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="payment_terms" value='<?php
                                                                                                                                    if (!empty($supplier->payment_terms)) {
                                                                                                                                        echo $supplier->payment_terms;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="<?php echo lang('e.g.') . ', ' . lang('net') . ' 30 ' . lang('days'); ?>">
                                        </div>
                                    </div>

                                    <!-- License Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-certificate mr-2"></i><?php echo lang('license') . ' ' . lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('license') . ' ' . lang('number'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="license_number" value='<?php
                                                                                                                                    if (!empty($supplier->license_number)) {
                                                                                                                                        echo $supplier->license_number;
                                                                                                                                    }
                                                                                                                                    ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('drug') . ' ' . lang('license'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="drug_license" value='<?php
                                                                                                                                if (!empty($supplier->drug_license)) {
                                                                                                                                    echo $supplier->drug_license;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('status'); ?></label>
                                            <select class="form-control form-control-lg" name="status">
                                                <option value="active" <?php echo (!empty($supplier->status) && $supplier->status == 'active') ? 'selected' : ''; ?>><?php echo lang('active'); ?></option>
                                                <option value="inactive" <?php echo (!empty($supplier->status) && $supplier->status == 'inactive') ? 'selected' : ''; ?>><?php echo lang('inactive'); ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control form-control-lg" name="notes" rows="4"><?php
                                                                                                                if (!empty($supplier->notes)) {
                                                                                                                    echo $supplier->notes;
                                                                                                                }
                                                                                                                ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($supplier->id)) {
                                                                            echo $supplier->id;
                                                                        }
                                                                        ?>'>

                                <div class="text-center mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save mr-2"></i><?php echo lang('save') . ' ' . lang('supplier'); ?>
                                    </button>
                                    <a href="medicine/suppliers" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                                    </a>
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

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-plus-circle text-primary mr-3"></i>
                        <?php echo lang('add_supplier') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/supplier"><?php echo lang('suppliers'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/supplier" class="btn btn-secondary btn-sm px-4 py-3">
                        <i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('add_supplier'); ?></h3>
                        </div>
                        <div class="card-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            
                            <form action="inventory/supplier/add" method="post">
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('basic_information'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="name"><?php echo lang('supplier_name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="company_name"><?php echo lang('company_name'); ?></label>
                                            <input type="text" class="form-control" name="company_name" id="company_name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="contact_person"><?php echo lang('contact_person'); ?></label>
                                            <input type="text" class="form-control" name="contact_person" id="contact_person">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email"><?php echo lang('email'); ?></label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="phone"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="phone">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="mobile"><?php echo lang('mobile'); ?></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile">
                                        </div>
                                    </div>
                                    
                                    <!-- Address Information -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-map-marker-alt mr-2"></i><?php echo lang('address_information'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="address"><?php echo lang('address'); ?></label>
                                            <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="city"><?php echo lang('city'); ?></label>
                                            <input type="text" class="form-control" name="city" id="city">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="state"><?php echo lang('state'); ?></label>
                                            <input type="text" class="form-control" name="state" id="state">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="country"><?php echo lang('country'); ?></label>
                                            <input type="text" class="form-control" name="country" id="country">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="postal_code"><?php echo lang('postal_code'); ?></label>
                                            <input type="text" class="form-control" name="postal_code" id="postal_code">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Financial Information -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-money-bill mr-2"></i><?php echo lang('financial_information'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="tax_number"><?php echo lang('tax_number'); ?></label>
                                            <input type="text" class="form-control" name="tax_number" id="tax_number">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="bank_name"><?php echo lang('bank_name'); ?></label>
                                            <input type="text" class="form-control" name="bank_name" id="bank_name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="bank_account"><?php echo lang('bank_account'); ?></label>
                                            <input type="text" class="form-control" name="bank_account" id="bank_account">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="payment_terms"><?php echo lang('payment_terms'); ?></label>
                                            <select class="form-control" name="payment_terms" id="payment_terms">
                                                <option value="">Select Payment Terms</option>
                                                <option value="Net 30">Net 30 Days</option>
                                                <option value="Net 15">Net 15 Days</option>
                                                <option value="Net 7">Net 7 Days</option>
                                                <option value="COD">Cash on Delivery</option>
                                                <option value="Advance">Advance Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Additional Information -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-cog mr-2"></i><?php echo lang('additional_information'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="credit_limit"><?php echo lang('credit_limit'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="form-control" name="credit_limit" id="credit_limit" step="0.01" min="0" value="0">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="status"><?php echo lang('status'); ?></label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="notes"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control" name="notes" id="notes" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" name="submit" class="btn btn-success btn-lg px-5">
                                                <i class="fas fa-save mr-2"></i>
                                                <?php echo lang('save'); ?>
                                            </button>
                                            <a href="inventory/supplier" class="btn btn-secondary btn-lg px-5 ml-3">
                                                <i class="fas fa-times mr-2"></i>
                                                <?php echo lang('cancel'); ?>
                                            </a>
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
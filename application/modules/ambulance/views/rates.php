<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-dollar-sign text-primary mr-3"></i>
                        <?php echo lang('ambulance_rates'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('rates'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url(); ?>ambulance" class="btn btn-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-dollar-sign mr-2"></i>
                                <?php echo lang('ambulance_rates'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <?php if ($this->session->flashdata('feedback')): ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('feedback_error')): ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('feedback_error'); ?>
                                </div>
                            <?php endif; ?>
                            <form role="form" action="<?php echo base_url(); ?>ambulance/updateRates" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-info text-white">
                                                <h3 class="card-title mb-0">
                                                    <i class="fas fa-ambulance mr-2"></i>
                                                    <?php echo lang('emergency_rates'); ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="emergency_base_rate"><?php echo lang('base_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][base_rate]" id="emergency_base_rate" 
                                                           value="<?php echo isset($rates['Emergency']['base_rate']) ? $rates['Emergency']['base_rate'] : '50.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emergency_per_km"><?php echo lang('per_km_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][per_km]" id="emergency_per_km" 
                                                           value="<?php echo isset($rates['Emergency']['per_km']) ? $rates['Emergency']['per_km'] : '2.50'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emergency_waiting_hour"><?php echo lang('waiting_per_hour'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][waiting_rate]" id="emergency_waiting_hour" 
                                                           value="<?php echo isset($rates['Emergency']['waiting_rate']) ? $rates['Emergency']['waiting_rate'] : '25.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emergency_minimum_charge"><?php echo lang('minimum_charge'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][minimum_charge]" id="emergency_minimum_charge" 
                                                           value="<?php echo isset($rates['Emergency']['minimum_charge']) ? $rates['Emergency']['minimum_charge'] : '50.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-success text-white">
                                                <h3 class="card-title mb-0">
                                                    <i class="fas fa-exchange-alt mr-2"></i>
                                                    <?php echo lang('transfer_rates'); ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="transfer_base_rate"><?php echo lang('base_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Transfer][base_rate]" id="transfer_base_rate" 
                                                           value="<?php echo isset($rates['Transfer']['base_rate']) ? $rates['Transfer']['base_rate'] : '40.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transfer_per_km"><?php echo lang('per_km_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Transfer][per_km]" id="transfer_per_km" 
                                                           value="<?php echo isset($rates['Transfer']['per_km']) ? $rates['Transfer']['per_km'] : '2.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transfer_waiting_hour"><?php echo lang('waiting_per_hour'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Transfer][waiting_rate]" id="transfer_waiting_hour" 
                                                           value="<?php echo isset($rates['Transfer']['waiting_rate']) ? $rates['Transfer']['waiting_rate'] : '20.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transfer_minimum_charge"><?php echo lang('minimum_charge'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Transfer][minimum_charge]" id="transfer_minimum_charge" 
                                                           value="<?php echo isset($rates['Transfer']['minimum_charge']) ? $rates['Transfer']['minimum_charge'] : '40.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-warning text-white">
                                                <h3 class="card-title mb-0">
                                                    <i class="fas fa-user-check mr-2"></i>
                                                    <?php echo lang('discharge_rates'); ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="discharge_base_rate"><?php echo lang('base_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Discharge][base_rate]" id="discharge_base_rate" 
                                                           value="<?php echo isset($rates['Discharge']['base_rate']) ? $rates['Discharge']['base_rate'] : '35.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discharge_per_km"><?php echo lang('per_km_rate'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Discharge][per_km]" id="discharge_per_km" 
                                                           value="<?php echo isset($rates['Discharge']['per_km']) ? $rates['Discharge']['per_km'] : '1.80'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discharge_waiting_hour"><?php echo lang('waiting_per_hour'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Discharge][waiting_rate]" id="discharge_waiting_hour" 
                                                           value="<?php echo isset($rates['Discharge']['waiting_rate']) ? $rates['Discharge']['waiting_rate'] : '15.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discharge_minimum_charge"><?php echo lang('minimum_charge'); ?> (<?php echo $currency ?? '$'; ?>)</label>
                                                    <input type="number" class="form-control" name="rates[Discharge][minimum_charge]" id="discharge_minimum_charge" 
                                                           value="<?php echo isset($rates['Discharge']['minimum_charge']) ? $rates['Discharge']['minimum_charge'] : '35.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-danger text-white">
                                                <h3 class="card-title mb-0">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    <?php echo lang('additional_charges'); ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="night_charge"><?php echo lang('night_charge'); ?> (%)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][night_charge]" id="night_charge" 
                                                           value="<?php echo isset($rates['Emergency']['night_charge']) ? $rates['Emergency']['night_charge'] : '25.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="weekend_charge"><?php echo lang('weekend_charge'); ?> (%)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][weekend_charge]" id="weekend_charge" 
                                                           value="<?php echo isset($rates['Emergency']['weekend_charge']) ? $rates['Emergency']['weekend_charge'] : '15.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="holiday_charge"><?php echo lang('holiday_charge'); ?> (%)</label>
                                                    <input type="number" class="form-control" name="rates[Emergency][holiday_charge]" id="holiday_charge" 
                                                           value="<?php echo isset($rates['Emergency']['holiday_charge']) ? $rates['Emergency']['holiday_charge'] : '50.00'; ?>" 
                                                           step="0.01" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">
                                                <h3 class="card-title mb-0">
                                                    <i class="fas fa-calculator mr-2"></i>
                                                    <?php echo lang('rate_calculation_info'); ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="card bg-info text-white mb-3 permanent-element" id="calculation-formula-card" style="position: static !important; display: block !important; visibility: visible !important; opacity: 1 !important;" data-permanent="true">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-2"><i class="fas fa-info-circle mr-2"></i><?php echo lang('calculation_formula'); ?></h5>
                                                        <p class="card-text mb-0"><?php echo lang('total_fare_formula'); ?>: <strong><?php echo lang('base_rate'); ?> + (<?php echo lang('distance'); ?> × <?php echo lang('per_km_rate'); ?>) + (<?php echo lang('waiting_hours'); ?> × <?php echo lang('waiting_per_hour'); ?>) + <?php echo lang('additional_charges'); ?></strong></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="test_distance"><?php echo lang('test_distance'); ?> (km)</label>
                                                            <input type="number" class="form-control" id="test_distance" value="10" step="0.1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="test_waiting"><?php echo lang('test_waiting'); ?> (hours)</label>
                                                            <input type="number" class="form-control" id="test_waiting" value="1" step="0.1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="test_type"><?php echo lang('test_type'); ?></label>
                                                            <select class="form-control" id="test_type">
                                                                <option value="Emergency"><?php echo lang('emergency'); ?></option>
                                                                <option value="Transfer"><?php echo lang('transfer'); ?></option>
                                                                <option value="Discharge"><?php echo lang('discharge'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-info" onclick="calculateTestFare()">
                                                            <i class="fa fa-calculator"></i> <?php echo lang('calculate_test_fare'); ?>
                                                        </button>
                                                        <span id="test_result" class="text-success" style="margin-left: 10px; font-weight: bold;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fa fa-save mr-2"></i>
                                        <?php echo lang('update_rates'); ?>
                                    </button>
                                    <a href="<?php echo base_url(); ?>ambulance" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fa fa-arrow-left mr-2"></i>
                                        <?php echo lang('back_to_ambulance'); ?>
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

<style>
/* Force permanent visibility for calculation formula */
.permanent-element,
#calculation-formula-card {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: static !important;
    transform: none !important;
    transition: none !important;
    animation: none !important;
}

/* Prevent any hide classes from affecting permanent elements */
.permanent-element.hide,
.permanent-element.hidden,
.permanent-element.d-none,
#calculation-formula-card.hide,
#calculation-formula-card.hidden,
#calculation-formula-card.d-none {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Override Bootstrap alert fade classes */
.permanent-element.fade,
.permanent-element.fade.show,
#calculation-formula-card.fade,
#calculation-formula-card.fade.show {
    opacity: 1 !important;
    display: block !important;
}
</style>

<script>
    function calculateTestFare() {
        var distance = parseFloat($('#test_distance').val()) || 0;
        var waiting = parseFloat($('#test_waiting').val()) || 0;
        var type = $('#test_type').val();
        
        var baseRate = 0;
        var perKm = 0;
        var waitingRate = 0;
        
        if (type === 'Emergency') {
            baseRate = parseFloat($('#emergency_base_rate').val()) || 0;
            perKm = parseFloat($('#emergency_per_km').val()) || 0;
            waitingRate = parseFloat($('#emergency_waiting_hour').val()) || 0;
        } else if (type === 'Transfer') {
            baseRate = parseFloat($('#transfer_base_rate').val()) || 0;
            perKm = parseFloat($('#transfer_per_km').val()) || 0;
            waitingRate = parseFloat($('#transfer_waiting_hour').val()) || 0;
        } else if (type === 'Discharge') {
            baseRate = parseFloat($('#discharge_base_rate').val()) || 0;
            perKm = parseFloat($('#discharge_per_km').val()) || 0;
            waitingRate = parseFloat($('#discharge_waiting_hour').val()) || 0;
        }
        
        var totalFare = baseRate + (distance * perKm) + (waiting * waitingRate);
        
        $('#test_result').text('<?php echo lang('estimated_fare'); ?>: <?php echo $currency ?? '$'; ?>' + totalFare.toFixed(2));
    }
    
    $(document).ready(function() {
        // Multiple protection layers for the calculation formula section
        
        // 1. Prevent any Bootstrap alert dismissal events
        $('[data-permanent="true"]').off('closed.bs.alert close.bs.alert');
        $('[data-permanent="true"]').on('closed.bs.alert close.bs.alert', function(e) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
        
        // 2. Prevent any hide/fadeOut calls
        $('[data-permanent="true"]').off('hide fadeOut');
        $('[data-permanent="true"]').on('hide fadeOut', function(e) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
        
        // 3. Override any CSS transitions that might hide the element
        $('[data-permanent="true"]').css({
            'transition': 'none !important',
            'animation': 'none !important',
            'transform': 'none !important',
            'opacity': '1 !important',
            'display': 'block !important',
            'visibility': 'visible !important'
        });
        
        // 4. Continuous monitoring and restoration
        setInterval(function() {
            var $element = $('#calculation-formula-card');
            if (!$element.is(':visible') || $element.css('display') === 'none' || $element.css('visibility') === 'hidden') {
                $element.show().css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
                console.log('Restored calculation formula visibility');
            }
        }, 500);
        
        // 5. Prevent any DOM manipulation that might remove the element
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    var $element = $('#calculation-formula-card');
                    if ($element.length === 0) {
                        // Element was removed, restore it (this is extreme protection)
                        console.warn('Calculation formula card was removed from DOM');
                    }
                }
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
        
        // Auto-calculate when inputs change
        $('#test_distance, #test_waiting, #test_type').on('change keyup', function() {
            calculateTestFare();
        });
        
        // Initial calculation
        calculateTestFare();
    });
</script>

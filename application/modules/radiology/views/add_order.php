<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-plus"></i> New Radiology Order
            <small>Create a new radiology order</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li><a href="radiology/orders">Orders</a></li>
            <li class="active">New Order</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" action="radiology/addOrder" method="post" id="orderForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Patient Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="patient_id">Patient *</label>
                                <select class="form-control select2" id="patient_id" name="patient_id" required>
                                    <option value="">Select Patient</option>
                                    <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo $patient->id; ?>" data-name="<?php echo $patient->name; ?>" data-phone="<?php echo $patient->phone; ?>" data-address="<?php echo $patient->address; ?>" data-age="<?php echo $patient->age; ?>" data-gender="<?php echo $patient->sex; ?>">
                                        <?php echo $patient->name . ' (' . $patient->id . ')'; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="patient_name">Patient Name *</label>
                                <input type="text" class="form-control" id="patient_name" name="patient_name" required readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_phone">Phone</label>
                                        <input type="text" class="form-control" id="patient_phone" name="patient_phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_age">Age</label>
                                        <input type="number" class="form-control" id="patient_age" name="patient_age">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="patient_gender">Gender</label>
                                <select class="form-control" id="patient_gender" name="patient_gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="patient_address">Address</label>
                                <textarea class="form-control" id="patient_address" name="patient_address" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Order Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="doctor_id">Doctor *</label>
                                <select class="form-control select2" id="doctor_id" name="doctor_id" required>
                                    <option value="">Select Doctor</option>
                                    <?php foreach ($doctors as $doctor): ?>
                                    <option value="<?php echo $doctor->id; ?>" data-name="<?php echo $doctor->name; ?>">
                                        <?php echo $doctor->name; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="doctor_name">Doctor Name *</label>
                                <input type="text" class="form-control" id="doctor_name" name="doctor_name" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="order_date">Order Date *</label>
                                <input type="datetime-local" class="form-control" id="order_date" name="order_date" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="appointment_date">Appointment Date</label>
                                <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date">
                            </div>
                            <div class="form-group">
                                <label for="urgency">Urgency</label>
                                <select class="form-control" id="urgency" name="urgency">
                                    <option value="routine">Routine</option>
                                    <option value="urgent">Urgent</option>
                                    <option value="stat">STAT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Clinical Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="clinical_history">Clinical History</label>
                                <textarea class="form-control" id="clinical_history" name="clinical_history" rows="3" placeholder="Enter patient's clinical history"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="clinical_notes">Clinical Notes</label>
                                <textarea class="form-control" id="clinical_notes" name="clinical_notes" rows="3" placeholder="Enter additional clinical notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Radiology Tests</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="testsTable">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="testsTableBody">
                                        <tr id="noTestsRow">
                                            <td colspan="6" class="text-center">No tests selected</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="test_search">Add Test</label>
                                <select class="form-control select2" id="test_search" name="test_search">
                                    <option value="">Select Test to Add</option>
                                    <?php foreach ($tests as $test): ?>
                                    <option value="<?php echo $test->id; ?>" data-name="<?php echo $test->name; ?>" data-category="<?php echo $test->category_name; ?>" data-price="<?php echo $test->price; ?>">
                                        <?php echo $test->name . ' - ' . $test->category_name . ' ($' . number_format($test->price, 2) . ')'; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total Amount: $<span id="totalAmount">0.00</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Order
                        </button>
                        <a href="radiology/orders" class="btn btn-default">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();
    
    // Patient selection handler
    $('#patient_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#patient_name').val(selectedOption.data('name'));
        $('#patient_phone').val(selectedOption.data('phone'));
        $('#patient_address').val(selectedOption.data('address'));
        $('#patient_age').val(selectedOption.data('age'));
        $('#patient_gender').val(selectedOption.data('gender'));
    });
    
    // Doctor selection handler
    $('#doctor_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#doctor_name').val(selectedOption.data('name'));
    });
    
    // Test selection handler
    $('#test_search').change(function() {
        var selectedOption = $(this).find('option:selected');
        if (selectedOption.val()) {
            addTestToTable(selectedOption.val(), selectedOption.data('name'), selectedOption.data('category'), selectedOption.data('price'));
            $(this).val('').trigger('change');
        }
    });
    
    function addTestToTable(testId, testName, category, price) {
        // Check if test already exists
        var existingRow = $('#testsTableBody tr[data-test-id="' + testId + '"]');
        if (existingRow.length > 0) {
            alert('This test is already added to the order.');
            return;
        }
        
        // Remove "no tests" row if it exists
        $('#noTestsRow').remove();
        
        // Add new test row
        var newRow = '<tr data-test-id="' + testId + '">' +
            '<td>' + testName + '<input type="hidden" name="test_ids[]" value="' + testId + '"></td>' +
            '<td>' + category + '</td>' +
            '<td>$' + parseFloat(price).toFixed(2) + '</td>' +
            '<td><input type="number" name="quantities[]" value="1" min="1" class="form-control quantity-input" style="width: 80px;"></td>' +
            '<td class="subtotal">$' + parseFloat(price).toFixed(2) + '</td>' +
            '<td><button type="button" class="btn btn-danger btn-xs remove-test"><i class="fas fa-trash"></i></button></td>' +
            '</tr>';
        
        $('#testsTableBody').append(newRow);
        updateTotal();
    }
    
    // Remove test handler
    $(document).on('click', '.remove-test', function() {
        $(this).closest('tr').remove();
        if ($('#testsTableBody tr').length === 0) {
            $('#testsTableBody').append('<tr id="noTestsRow"><td colspan="6" class="text-center">No tests selected</td></tr>');
        }
        updateTotal();
    });
    
    // Quantity change handler
    $(document).on('change', '.quantity-input', function() {
        var row = $(this).closest('tr');
        var price = parseFloat(row.find('td:eq(2)').text().replace('$', ''));
        var quantity = parseInt($(this).val());
        var subtotal = price * quantity;
        
        row.find('.subtotal').text('$' + subtotal.toFixed(2));
        updateTotal();
    });
    
    function updateTotal() {
        var total = 0;
        $('.subtotal').each(function() {
            total += parseFloat($(this).text().replace('$', ''));
        });
        $('#totalAmount').text(total.toFixed(2));
    }
    
    // Form validation
    $('#orderForm').submit(function(e) {
        if ($('#testsTableBody tr[data-test-id]').length === 0) {
            e.preventDefault();
            alert('Please add at least one test to the order.');
            return false;
        }
    });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-plus"></i> Add Radiology Test
            <small>Create a new radiology test</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li><a href="radiology/tests">Tests</a></li>
            <li class="active">Add Test</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Test Information</h3>
                    </div>
                    <form role="form" action="radiology/addTest" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Test Name *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter test name" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category *</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter test description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price ($) *</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" placeholder="0.00" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duration (minutes) *</label>
                                        <input type="number" class="form-control" id="duration" name="duration" min="1" placeholder="30" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="preparation_instructions">Preparation Instructions</label>
                                <textarea class="form-control" id="preparation_instructions" name="preparation_instructions" rows="3" placeholder="Enter preparation instructions for patients"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="normal_values">Normal Values</label>
                                <textarea class="form-control" id="normal_values" name="normal_values" rows="3" placeholder="Enter normal values or reference ranges"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Test
                            </button>
                            <a href="radiology/tests" class="btn btn-default">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Help</h3>
                    </div>
                    <div class="box-body">
                        <p><strong>Test Name:</strong> Enter a descriptive name for the radiology test.</p>
                        <p><strong>Category:</strong> Select the appropriate category for this test.</p>
                        <p><strong>Price:</strong> Set the cost for this test in dollars.</p>
                        <p><strong>Duration:</strong> Estimated time required to complete the test.</p>
                        <p><strong>Preparation Instructions:</strong> Special instructions for patients before the test.</p>
                        <p><strong>Normal Values:</strong> Reference ranges or normal findings for this test.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

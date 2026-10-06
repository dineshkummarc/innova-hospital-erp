<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-plus"></i> Add Radiology Category
            <small>Create a new radiology category</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li><a href="radiology/categories">Categories</a></li>
            <li class="active">Add Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category Information</h3>
                    </div>
                    <form role="form" action="radiology/addCategory" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Category Name *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter category description"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Category
                            </button>
                            <a href="radiology/categories" class="btn btn-default">
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
                        <p><strong>Category Name:</strong> Enter a descriptive name for the radiology category (e.g., X-Ray, CT Scan, MRI).</p>
                        <p><strong>Description:</strong> Provide additional details about what types of tests belong to this category.</p>
                        <p><em>Categories help organize radiology tests and make them easier to find and manage.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

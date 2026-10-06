<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-edit"></i> Edit Radiology Category
            <small>Update category information</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li><a href="radiology/categories">Categories</a></li>
            <li class="active">Edit Category</li>
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
                    <form role="form" action="radiology/editCategory/<?php echo $category->id; ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Category Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $category->name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter category description"><?php echo $category->description; ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Category
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
                        <h3 class="box-title">Category Details</h3>
                    </div>
                    <div class="box-body">
                        <p><strong>Created:</strong> <?php echo date('M d, Y H:i', strtotime($category->created_at)); ?></p>
                        <p><strong>Last Updated:</strong> <?php echo date('M d, Y H:i', strtotime($category->updated_at)); ?></p>
                        <hr>
                        <p><em>Changes to category names will be reflected in all associated tests.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-tags"></i> Radiology Categories
            <small>Manage radiology test categories</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Radiology Categories</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/addCategory" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Category
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="categoriesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?php echo $category->id; ?></td>
                                        <td><?php echo $category->name; ?></td>
                                        <td><?php echo $category->description; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($category->created_at)); ?></td>
                                        <td>
                                            <a href="radiology/editCategory/<?php echo $category->id; ?>" class="btn btn-info btn-xs">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="radiology/deleteCategory/<?php echo $category->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#categoriesTable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 25,
        "order": [[0, "desc"]]
    });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-flask"></i> Radiology Tests
            <small>Manage radiology tests and procedures</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li class="active">Tests</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Radiology Tests</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/addTest" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Test
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="testsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tests as $test): ?>
                                    <tr>
                                        <td><?php echo $test->id; ?></td>
                                        <td><?php echo $test->name; ?></td>
                                        <td><?php echo $test->category_name; ?></td>
                                        <td>$<?php echo number_format($test->price, 2); ?></td>
                                        <td><?php echo $test->duration; ?> min</td>
                                        <td>
                                            <span class="label label-<?php echo $test->status == 'active' ? 'success' : 'danger'; ?>">
                                                <?php echo ucfirst($test->status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="radiology/editTest/<?php echo $test->id; ?>" class="btn btn-info btn-xs">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="radiology/deleteTest/<?php echo $test->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this test?')">
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
    $('#testsTable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 25,
        "order": [[0, "desc"]]
    });
});
</script>

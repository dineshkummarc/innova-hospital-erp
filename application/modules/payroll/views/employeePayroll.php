<link href="common/extranal/css/payroll/employeePayroll.css" rel="stylesheet">


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-check-alt mr-2"></i><?php echo lang('payroll') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('payroll') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Salary Invoices'); ?></h3>
                        </div>
                        <!-- /.card-header -->


                        <div class="col-md-12">
                            <div class="row employee_div p-2">
                                <div class="col-md-6">
                                    <label><?php echo lang('year'); ?></label>
                                    <select class="form-control ca_select2" id="payroll_year">
                                        <?php foreach ($years as $year) {
                                        ?>
                                            <option value="<?php echo $year; ?>" <?php if ($year == date('Y')) { ?>selected<?php } ?>><?php echo $year; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="payroll_table">
                                <table class="table table-striped table-hover table-bordered w-100" id="salary-sample">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('month'); ?></th>
                                            <th><?php echo lang('salary'); ?></th>
                                            <th><?php echo lang('paid_on'); ?></th>
                                            <th><?php echo lang('status'); ?></th>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($employees); $i++) { ?>
                                            <tr>
                                                <td><?php echo $employees[$i][0]; ?></td>
                                                <td><?php echo $employees[$i][1]; ?></td>
                                                <td><?php echo $employees[$i][2]; ?></td>
                                                <td><?php echo $employees[$i][3]; ?></td>
                                                <td><?php echo $employees[$i][4]; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>



<!--main content end-->
<!--footer start-->






<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('salary'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="salaryForm" action="payroll/addEditSalary" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('salary'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="salary" value='' placeholder="Enter Salary Amount" required>
                    </div>

                    <input type="hidden" name="staff">

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->






<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/payroll/employeePayroll.js"></script>
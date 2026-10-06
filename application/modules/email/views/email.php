<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i> <?php echo lang('sent_messages') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('sent_messages') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Content Header (Page header) -->

    <!--main content start-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the sent emails'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th class="first_th"><button type="button" id="toggle" class="btn btn-success" value="Select" onClick="do_this()">Select</button></th>
                                        <th>#</th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th><?php echo lang('message'); ?></th>
                                        <th><?php echo lang('recipient'); ?></th>
                                        <th><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($sents as $sent) {
                                        $i = $i + 1;
                                    ?>
                                        <tr class="">
                                            <td><input type="checkbox" name="id[]" value="<?php echo $sent->id; ?>" /></td>
                                            <td><?php echo $i; ?></td>
                                            <td class="date_email"><?php echo date('h:i:s a m/d/y', $sent->date); ?></td>
                                            <td><?php
                                                if (!empty($sent->message)) {
                                                    echo $sent->message;
                                                }
                                                ?></td>
                                            <td><?php
                                                if (!empty($sent->reciepient)) {
                                                    echo $sent->reciepient;
                                                }
                                                ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="email/delete?id=<?php echo $sent->id; ?>" <?php echo lang('delete'); ?> onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/email/email.js"></script>
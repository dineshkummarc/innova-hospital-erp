<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-truck text-primary mr-3"></i>
                        <?php echo lang('medicine'); ?> <?php echo lang('suppliers'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('suppliers'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="medicine/addSupplierView" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus mr-2"></i><?php echo lang('add'); ?> <?php echo lang('new'); ?> <?php echo lang('supplier'); ?>
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
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all'); ?> <?php echo lang('medicine'); ?> <?php echo lang('suppliers'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample1">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('id'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('supplier'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('company'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('contact'); ?> <?php echo lang('person'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('phone'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('email'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('city'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('credit'); ?> <?php echo lang('limit'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('status'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($suppliers as $supplier) { ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td class="font-weight-bold"><?php echo $supplier->name; ?></td>
                                            <td><?php echo $supplier->company_name; ?></td>
                                            <td><?php echo $supplier->contact_person; ?></td>
                                            <td><?php echo $supplier->phone; ?></td>
                                            <td><?php echo $supplier->email; ?></td>
                                            <td><?php echo $supplier->city; ?></td>
                                            <td><?php echo $settings->currency . number_format($supplier->credit_limit, 2); ?></td>
                                            <td>
                                                <?php if ($supplier->status == 'active') { ?>
                                                    <span class="badge badge-success"><?php echo lang('active'); ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger"><?php echo lang('inactive'); ?></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="medicine/editSupplier?id=<?php echo $supplier->id; ?>" 
                                                       class="btn btn-primary btn-sm" 
                                                       title="<?php echo lang('edit'); ?> <?php echo lang('supplier'); ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="medicine/deleteSupplier?id=<?php echo $supplier->id; ?>" 
                                                       class="btn btn-danger btn-sm ml-1" 
                                                       onclick="return confirm('<?php echo lang('are_you_sure_you_want_to_delete_this') . ' ' . lang('supplier'); ?>?');"
                                                       title="<?php echo lang('delete'); ?> <?php echo lang('supplier'); ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--main content end-->
<!--footer start-->

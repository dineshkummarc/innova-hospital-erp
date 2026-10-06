<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-friends text-primary mr-3"></i>
                        <?php echo lang('referrers'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="referral"><?php echo lang('referral_management'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('referrers'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <?php if ($this->ion_auth->in_group(array('admin', 'superadmin', 'Accountant'))) { ?>
                        <a href="referral/addNewView" class="btn btn-primary btn-sm px-4 py-3 shadow-sm">
                            <i class="fa fa-plus-circle mr-1"></i> <?php echo lang('add_new_referrer'); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold mb-0 text-dark">
                                <i class="fas fa-list mr-2 text-primary"></i> All Registered Referrers
                            </h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <div class="table-responsive">
                                <table class="table table-hover datatables" id="editable-sample" width="100%">
                                    <thead>
                                        <tr class="bg-light text-uppercase">
                                            <th>ID</th>
                                            <th><?php echo lang('name'); ?></th>
                                            <th><?php echo lang('phone'); ?></th>
                                            <th><?php echo lang('email'); ?></th>
                                            <th><?php echo lang('referrer_type'); ?></th>
                                            <th><?php echo lang('status'); ?></th>
                                            <th><?php echo lang('available_balance'); ?></th>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($referrers)) {
                                            foreach ($referrers as $referrer) { 
                                                $wallet = $this->referral_model->getWalletByReferrerId($referrer->id);
                                                $avail = !empty($wallet) ? floatval($wallet->available_balance) : 0.00;
                                            ?>
                                                <tr>
                                                    <td>#<?php echo $referrer->id; ?></td>
                                                    <td class="font-weight-bold">
                                                        <?php echo html_escape($referrer->name); ?>
                                                        <?php if (!empty($referrer->address)) { ?>
                                                            <br><small class="text-muted"><i class="fas fa-map-marker-alt"></i> <?php echo html_escape($referrer->address); ?></small>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo html_escape($referrer->phone); ?></td>
                                                    <td><?php echo !empty($referrer->email) ? html_escape($referrer->email) : '<span class="text-muted">-</span>'; ?></td>
                                                    <td>
                                                        <span class="badge badge-info px-2 py-1"><?php echo html_escape($referrer->type); ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if ($referrer->status == 'Active') { ?>
                                                            <span class="badge badge-success px-2 py-1"><?php echo lang('active'); ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-secondary px-2 py-1"><?php echo lang('in_active'); ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency . ' ' . number_format($avail, 2); ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-outline-info btn-sm mr-1" title="Statement" href="referral/statement?referrer_id=<?php echo $referrer->id; ?>">
                                                            <i class="fas fa-file-invoice"></i> Statement
                                                        </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin', 'superadmin', 'Accountant'))) { ?>
                                                            <a class="btn btn-outline-primary btn-sm mr-1" title="<?php echo lang('edit'); ?>" href="referral/editReferrer?id=<?php echo $referrer->id; ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
                                                            <a class="btn btn-outline-danger btn-sm" title="<?php echo lang('delete'); ?>" href="referral/delete?id=<?php echo $referrer->id; ?>" onclick="return confirm('Are you sure you want to deactivate/delete this referrer?');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editable-sample').DataTable({
            responsive: true,
            order: [[0, "desc"]],
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],
            pageLength: 25
        });
    });
</script>

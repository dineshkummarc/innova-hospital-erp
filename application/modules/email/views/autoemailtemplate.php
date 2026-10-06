<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-envelope text-primary mr-3"></i>
                        <?php echo lang('autoemailtemplate') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('autoemailtemplate'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold"><?php echo lang('Auto generated email templates'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample1" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold">#</th>
                                        <th class="font-weight-bold"><?php echo lang('category'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('message'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>






<!-- Edit sms temp Modal-->
<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('edit'); ?> <?php echo lang('auto'); ?> <?php echo lang('template'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-5">
                <?php echo validation_errors(); ?>
                <form role="form" id="emailtemp" name="myform" action="email/addNewAutoEmailTemplate" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label class="text-uppercase text-sm"><?php echo lang('category'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="category" value='' placeholder="" readonly required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-uppercase text-sm"><?php echo lang('message'); ?> <?php echo lang('template'); ?></label>
                        <div id="divbuttontag" class="mb-3"></div>
                        <textarea class="form-control form-control-lg" name="message" id="editor1" rows="10"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-uppercase text-sm"><?php echo lang('status'); ?></label>
                        <select class="form-control form-control-lg select2" id="status" name="status">
                        </select>
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="type" value='email'>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/email/auto_email_template.js"></script>
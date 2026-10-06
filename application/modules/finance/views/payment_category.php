  <link href="common/extranal/css/finance/payment_category.css" rel="stylesheet">



  <div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
      <section class="content-header py-4 bg-white shadow-sm">
          <div class="container-fluid">
              <div class="row align-items-center">
                  <div class="col-sm-6">
                      <h1 class="display-4 font-weight-black mb-0">
                          <i class="fas fa-procedures text-primary mr-3"></i>
                          <?php echo lang('invoice_items_lab_tests') ?>
                      </h1>
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb bg-transparent mb-0">
                              <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                              <li class="breadcrumb-item active"><?php echo lang('payment_procedures'); ?></li>
                          </ol>
                      </nav>
                  </div>
                  <div class="col-sm-6 text-right">
                      <a href="finance/addPaymentCategoryView" class="btn btn-primary btn-sm px-4 py-3">
                          <i class="fa fa-plus"></i> <?php echo lang('create_invoice_items_lab_tests'); ?>
                      </a>
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
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <h3 class="card-title font-weight-bold mb-0"><?php echo lang('All the invoice items / lab tests name and related informations'); ?></h3>
                                  </div>
                                  <div class="col-md-4">
                                      <select class="form-control category js-example-basic-single">
                                          <option value="all"><?php echo lang('select'); ?> <?php echo lang('category'); ?></option>
                                          <option value="all"><?php echo lang('all'); ?></option>
                                          <?php foreach ($paycategories as $paycategory) { ?>
                                              <option value="<?php echo $paycategory->id; ?>">
                                                  <?php echo $paycategory->category; ?>
                                              </option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>

                          <div class="card-body bg-light p-4">
                              <table class="table table-hover datatables" id="editable-sample" width="100%">
                                  <thead>
                                      <tr class="bg-light">
                                          <th class="font-weight-bold text-uppercase"><?php echo lang('name'); ?></th>
                                          <th class="font-weight-bold"><?php echo lang('code'); ?></th>
                                          <th class="font-weight-bold"><?php echo lang('service_point'); ?></th>
                                          <th class="font-weight-bold"><?php echo lang(''); ?> <?php echo lang('price'); ?> ( <?php echo $settings->currency; ?> )</th>
                                          <th class="font-weight-bold"><?php echo lang('doctors_commission'); ?> (%)</th>
                                          <th class="font-weight-bold"><?php echo lang('referral_commission'); ?> (%)</th>
                                          <th class="font-weight-bold"><?php echo lang('type'); ?></th>
                                          <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                              <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                          <?php } ?>
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















  <!--main content end-->
  <!--footer start-->
  <!-- Add Patient Modal-->
  <style>
      .ck-editor__editable:not(.ck-editor__nested-editable) {
          min-height: 400px !important;
      }
  </style>
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title font-weight-bold"> <?php echo lang('add_template'); ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body row">
                  <form role="form" id="addTemplate" action="finance/addPaymentProccedureTemplate" class="clearfix" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                          <label class="control-label"><?php echo lang('template'); ?></label>
                          <textarea class="form-control ckeditor" id="editor1" name="report" value="" rows="50" cols="20"></textarea>
                      </div>

                      <input type="hidden" name="id">

                      <section class="col-md-12">
                          <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                      </section>
                  </form>

              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> 
  <!-- Add Patient Modal-->

  <script src="common/js/codearistos.min.js"></script>
  <script type="text/javascript">
      var language = "<?php echo $this->language; ?>";
  </script>
  <script src="common/assets/tinymce/tinymce.min.js"></script>
  <script src="common/extranal/js/finance/payment_category.js"></script>
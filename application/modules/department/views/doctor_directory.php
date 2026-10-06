<!--main content start-->



<div class="content-wrapper bg-light">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row my-2 pl-1">
        <div class="col-sm-6">
          <h1 class="font-weight-bold"><i class="fas fa-user-md mr-2"></i><?php echo $department->name; ?> <?php echo lang('doctor_directory'); ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Department</li>
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
              <h3 class="card-title"><?php echo lang('All the doctors details of'); ?> <?php echo $department->name; ?> <?php echo lang('department'); ?></h3>
              <div class="float-right">
                <a href="department">
                  <button id="" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-circle-left"></i> <?php echo lang('back'); ?>
                  </button>
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover" id="editable-sample">
                <thead>
                  <tr>
                    <th><?php echo lang('doctor'); ?> <?php echo lang('id'); ?></th>
                    <th><?php echo lang('name'); ?></th>
                    <th><?php echo lang('email'); ?></th>
                    <th><?php echo lang('phone'); ?></th>
                    <th><?php echo lang('department'); ?></th>
                    <th><?php echo lang('profile'); ?></th>
                    <th class="no-print"><?php echo lang('options'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Table body -->
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
<!--footer start-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><?php echo lang('edit_doctor'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editDoctorForm" action="doctor/addNew" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nameInput"><?php echo lang('name'); ?></label>
              <input type="text" class="form-control form-control-lg" name="name" placeholder="">
            </div>
            <div class="form-group col-md-6">
              <label for="emailInput"><?php echo lang('email'); ?></label>
              <input type="email" class="form-control form-control-lg" name="email" placeholder="">
            </div>
            <div class="form-group col-md-6">
              <label for="passwordInput"><?php echo lang('password'); ?></label>
              <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
            </div>
            <div class="form-group col-md-6">
              <label for="addressInput"><?php echo lang('address'); ?></label>
              <input type="text" class="form-control form-control-lg" name="address" placeholder="">
            </div>
            <div class="form-group col-md-6">
              <label for="phoneInput"><?php echo lang('phone'); ?></label>
              <input type="tel" class="form-control form-control-lg" name="phone" placeholder="">
            </div>
            <div class="form-group col-md-6">
              <label for="departmentSelect"><?php echo lang('department'); ?></label>
              <select class="form-control form-control-lg" name="department">
                <?php foreach ($departments as $department) { ?>
                  <option value="<?php echo $department->id; ?>" <?php if (!empty($doctor->department) && $department->name == $doctor->department) {
                                                                    echo 'selected';
                                                                  } ?>>
                    <?php echo $department->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="profileInput"><?php echo lang('profile'); ?></label>
              <input type="text" class="form-control form-control-lg" name="profile" placeholder="">
            </div>
            <div class="form-group col-md-6">
              <label for="imageUpload">Image Upload</label>
              <input type="file" class="form-control-file" name="img_url">
            </div>
          </div>
          <input type="hidden" name="id">
          <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Event Modal-->
<div class="modal fade" id="infoModal" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="infoModalLabel"><?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="infoForm" action="doctor/addNew" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="file-upload">
                <img src="" id="img1" alt="" class="img-thumbnail">
              </div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('name'); ?></label>
              <div class="nameClass"></div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('email'); ?></label>
              <div class="emailClass"></div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('address'); ?></label>
              <div class="addressClass"></div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('phone'); ?></label>
              <div class="phoneClass"></div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('department'); ?></label>
              <div class="departmentClass"></div>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo lang('profile'); ?></label>
              <div class="profileClass"></div>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
  var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
  var department = "<?php echo $department->id; ?>";
</script>
<script src="common/extranal/js/doctor/doctor_directory.js"></script>
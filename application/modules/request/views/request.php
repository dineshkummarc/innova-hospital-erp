 <link href="common/extranal/css/request/request.css" rel="stylesheet">



 <div class="content-wrapper bg-light">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row my-2 pl-1">
                 <div class="col-sm-6">
                     <h1><i class="fas fa-hospital"></i> <strong><?php echo lang('hospital_registration_from_website'); ?></strong></h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                         <li class="breadcrumb-item active"> <?php echo lang('hospital_registration_from_website'); ?></li>
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
                             <h3 class="card-title"><?php echo lang('List of All Appointments'); ?>All the hospitals registration request made from fronend website</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table class="table table-bordered table-hover" id="editable-sample">
                                 <thead>
                                     <tr>
                                         <th> <?php echo lang('title'); ?></th>
                                         <th> <?php echo lang('email'); ?></th>
                                         <th> <?php echo lang('address'); ?></th>
                                         <th> <?php echo lang('phone'); ?></th>
                                         <th> <?php echo lang('package'); ?></th>
                                         <th> <?php echo lang('status'); ?></th>
                                         <th class="no-print"> <?php echo lang('options'); ?></th>
                                     </tr>
                                 </thead>
                                 <tbody>



                                     <?php
                                        foreach ($requests as $request) {
                                        ?>
                                         <tr class="">
                                             <td> <?php echo $request->name; ?></td>
                                             <td><?php echo $request->email; ?></td>
                                             <td class="center"><?php echo $request->address; ?></td>
                                             <td><?php echo $request->phone; ?></td>
                                             <td>
                                                 <?php
                                                    if (!empty($request->package)) {
                                                        echo $this->package_model->getPackageById($request->package)->name;
                                                    }
                                                    ?>
                                             </td>
                                             <td> <?php echo $request->status; ?></td>
                                             <td class="no-print d-flex gap-1">
                                                 <?php
                                                    $status = $this->db->get_where('request', array('id' => $request->id))->row()->status;
                                                    if ($status == 'Pending') {
                                                    ?>
                                                     <a href="request/approve?id=<?php echo $request->id; ?>" type="button" class="btn btn-info btn-xs status" data-toggle="modal" data-id="<?php echo $request->id; ?>"><?php echo lang('approve'); ?></a>

                                                 <?php }
                                                    ?>
                                                 <?php if ($status != 'Approved') { ?>
                                                     <a class="btn btn-info btn-xs btn_width delete_button" href="request/delete?id=<?php echo $request->id; ?>" onclick="return confirm('Are you sure you want to decline this request?');"><i class="fa fa-trash"></i> <?php echo lang('decline'); ?></a>
                                                 <?php } ?>
                                             </td>
                                         </tr>
                                     <?php
                                        }
                                        ?>
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





 <script src="common/js/codearistos.min.js"></script>

 <script type="text/javascript">
     var language = "<?php echo $this->language; ?>";
 </script>
 <script src="common/extranal/js/request/request.js"></script>
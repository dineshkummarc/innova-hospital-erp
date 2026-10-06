<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="fw-bold"><i class="fas fa-language mr-2"></i><strong><?php echo lang('select'); ?> <?php echo lang('default'); ?> <?php echo lang('language'); ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('select'); ?> <?php echo lang('language'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="card shadow-sm">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" class="clearfix" id="editSaleForm" action="settings/changeLanguage" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <?php
                                        $d_languages = $this->db->get('language')->result();
                                        foreach ($d_languages as $d_language) {
                                            $isSelected = (!empty($settings->language) && $settings->language == $d_language->language);
                                        ?>
                                            <div class="col-md-6 mb-3">
                                                <div class="language-card border rounded position-relative"
                                                    onclick="selectLanguage(this, <?php echo $d_language->id; ?>)">
                                                    <input type="radio" name="language" id="lang_<?php echo $d_language->id; ?>"
                                                        value="<?php echo $d_language->language; ?>"
                                                        <?php echo $isSelected ? 'checked' : ''; ?> class="language-input d-none">
                                                    <label for="lang_<?php echo $d_language->id; ?>" class="d-flex align-items-center p-3 mb-0 cursor-pointer">
                                                        <div class="language-icon">
                                                            <i class="flag-icon flag-icon-<?php echo $d_language->flag_icon ?? 'us'; ?> h2 mb-0"></i>
                                                        </div>
                                                        <div class="language-details ml-3">
                                                            <h5 class="mb-1"><?php echo $d_language->language; ?></h5>
                                                            <small class="text-muted status-text"><?php echo $isSelected ? 'Currently Active' : 'Click to Select'; ?></small>
                                                        </div>
                                                        <div class="position-absolute check-icon" style="top:10px; right:10px; <?php echo !$isSelected ? 'display:none;' : ''; ?>">
                                                            <i class="fas fa-check-circle text-primary"></i>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <input type="hidden" name="language_settings" value='language_settings'>
                                    <input type="hidden" name="id" value='<?php echo !empty($settings->id) ? $settings->id : ''; ?>'>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-check mr-2"></i><?php echo lang('submit'); ?>
                                    </button>
                                </div>
                            </form>

                            <script>
                                function selectLanguage(card, id) {
                                    // Remove check icon and update status from all cards
                                    document.querySelectorAll('.language-card').forEach(c => {
                                        c.querySelector('.check-icon').style.display = 'none';
                                        c.querySelector('.status-text').textContent = 'Click to Select';
                                    });

                                    // Add check icon and update status for selected card
                                    card.querySelector('.check-icon').style.display = 'block';
                                    card.querySelector('.status-text').textContent = 'Currently Active';

                                    // Select the radio input
                                    document.getElementById('lang_' + id).checked = true;
                                }
                            </script>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                    <div class="col-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title"> <?php echo lang('edit'); ?> <?php echo lang('language'); ?> </h3>
                                <button class="btn btn-success float-right" data-toggle="modal" href="#myModal">
                                    <i class="fas fa-plus mr-2"></i><?php echo lang('add_new'); ?>
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo lang('name'); ?></th>
                                                <th><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($languages as $language) { ?>
                                                <tr>
                                                    <td><?php echo '1'; ?></td>
                                                    <td>
                                                        <i class="flag-icon flag-icon-<?php echo $language->flag_icon ?? 'us'; ?> mr-2"></i>
                                                        <?php echo $language->language; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary editbutton" data-id="<?php echo $language->id; ?>">
                                                            <i class="fas fa-edit mr-1"></i> <?php echo lang('edit'); ?>
                                                        </a>
                                                        <a class="btn btn-sm btn-info" href="settings/languageEdit?id=<?php echo $language->language; ?>">
                                                            <i class="fas fa-cog mr-1"></i> <?php echo lang('manage'); ?>
                                                        </a>
                                                    </td>
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
                <?php } ?>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>



<!-- Add Language Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('language'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="settings/addLanguage" class="clearfix form-row" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('language'); ?> </label>
                            <input type="text" class="form-control form-control-lg" name="language" value='' required="">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('flag_icon'); ?> </label>

                            <select name="flag_icon" class="form-control form-control-lg">
                                <option value="sa"><i class="flag-icon flag-icon-sa mr-2"></i> Arabic</option> <!-- Saudi Arabian flag -->
                                <option value="bd"><i class="flag-icon flag-icon-bd mr-2"></i> Bengali</option> <!-- Bangladeshi flag -->
                                <option value="cs"><i class="flag-icon flag-icon-cz mr-2"></i> Czech</option> <!-- Czech Republic flag -->
                                <option value="da"><i class="flag-icon flag-icon-dk mr-2"></i> Danish</option> <!-- Danish flag -->
                                <option value="de"><i class="flag-icon flag-icon-de mr-2"></i> German</option> <!-- German flag -->
                                <option value="el"><i class="flag-icon flag-icon-gr mr-2"></i> Greek</option> <!-- Greek flag -->
                                <option value="us"><i class="flag-icon flag-icon-gb mr-2"></i> English</option> <!-- British flag -->
                                <option value="es"><i class="flag-icon flag-icon-es mr-2"></i> Spanish</option> <!-- Spanish flag -->
                                <option value="fi"><i class="flag-icon flag-icon-fi mr-2"></i> Finnish</option> <!-- Finnish flag -->
                                <option value="fr"><i class="flag-icon flag-icon-fr mr-2"></i> French</option> <!-- French flag -->
                                <option value="he"><i class="flag-icon flag-icon-il mr-2"></i> Hebrew</option> <!-- Israeli flag -->
                                <option value="in"><i class="flag-icon flag-icon-in mr-2"></i> Hindi</option> <!-- Indian flag -->
                                <option value="hu"><i class="flag-icon flag-icon-hu mr-2"></i> Hungarian</option> <!-- Hungarian flag -->
                                <option value="id"><i class="flag-icon flag-icon-id mr-2"></i> Indonesian</option> <!-- Indonesian flag -->
                                <option value="it"><i class="flag-icon flag-icon-it mr-2"></i> Italian</option> <!-- Italian flag -->
                                <option value="ja"><i class="flag-icon flag-icon-jp mr-2"></i> Japanese</option> <!-- Japanese flag -->
                                <option value="ko"><i class="flag-icon flag-icon-kr mr-2"></i> Korean</option> <!-- South Korean flag -->
                                <option value="ms"><i class="flag-icon flag-icon-my mr-2"></i> Malay</option> <!-- Malaysian flag -->
                                <option value="nl"><i class="flag-icon flag-icon-nl mr-2"></i> Dutch</option> <!-- Dutch flag -->
                                <option value="no"><i class="flag-icon flag-icon-no mr-2"></i> Norwegian</option> <!-- Norwegian flag -->
                                <option value="pl"><i class="flag-icon flag-icon-pl mr-2"></i> Polish</option> <!-- Polish flag -->
                                <option value="pt"><i class="flag-icon flag-icon-pt mr-2"></i> Portuguese</option> <!-- Portuguese flag -->
                                <option value="ro"><i class="flag-icon flag-icon-ro mr-2"></i> Romanian</option> <!-- Romanian flag -->
                                <option value="ru"><i class="flag-icon flag-icon-ru mr-2"></i> Russian</option> <!-- Russian flag -->
                                <option value="sv"><i class="flag-icon flag-icon-se mr-2"></i> Swedish</option> <!-- Swedish flag -->
                                <option value="th"><i class="flag-icon flag-icon-th mr-2"></i> Thai</option> <!-- Thai flag -->
                                <option value="tr"><i class="flag-icon flag-icon-tr mr-2"></i> Turkish</option> <!-- Turkish flag -->
                                <option value="vi"><i class="flag-icon flag-icon-vn mr-2"></i> Vietnamese</option> <!-- Vietnamese flag -->
                                <option value="zh"><i class="flag-icon flag-icon-cn mr-2"></i> Chinese</option> <!-- Chinese flag -->
                            </select>

                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>
                            <input type="text" class="form-control form-control-lg" name="description" value='' placeholder="" required="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('status'); ?> </label>
                            <select class="form-control form-control-lg" name="status" value='' required="">
                                <option value="1"><?php echo lang('active'); ?></option>
                                <option value="0"><?php echo lang('inactive'); ?></option>
                            </select>
                        </div>


                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->


<!-- Edit Language Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('language'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="settings/addLanguage" id="editLanguageForm" class="clearfix form-row" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('language'); ?> </label>
                            <input type="text" class="form-control form-control-lg" name="language" value='' required="" readonly>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('flag_icon'); ?> </label>

                            <select name="flag_icon" class="form-control form-control-lg">
                                <option value="sa"><i class="flag-icon flag-icon-sa mr-2"></i> Arabic</option> <!-- Saudi Arabian flag -->
                                <option value="bd"><i class="flag-icon flag-icon-bd mr-2"></i> Bengali</option> <!-- Bangladeshi flag -->
                                <option value="cs"><i class="flag-icon flag-icon-cz mr-2"></i> Czech</option> <!-- Czech Republic flag -->
                                <option value="da"><i class="flag-icon flag-icon-dk mr-2"></i> Danish</option> <!-- Danish flag -->
                                <option value="de"><i class="flag-icon flag-icon-de mr-2"></i> German</option> <!-- German flag -->
                                <option value="el"><i class="flag-icon flag-icon-gr mr-2"></i> Greek</option> <!-- Greek flag -->
                                <option value="us"><i class="flag-icon flag-icon-gb mr-2"></i> English</option> <!-- British flag -->
                                <option value="es"><i class="flag-icon flag-icon-es mr-2"></i> Spanish</option> <!-- Spanish flag -->
                                <option value="fi"><i class="flag-icon flag-icon-fi mr-2"></i> Finnish</option> <!-- Finnish flag -->
                                <option value="fr"><i class="flag-icon flag-icon-fr mr-2"></i> French</option> <!-- French flag -->
                                <option value="he"><i class="flag-icon flag-icon-il mr-2"></i> Hebrew</option> <!-- Israeli flag -->
                                <option value="in"><i class="flag-icon flag-icon-in mr-2"></i> Hindi</option> <!-- Indian flag -->
                                <option value="hu"><i class="flag-icon flag-icon-hu mr-2"></i> Hungarian</option> <!-- Hungarian flag -->
                                <option value="id"><i class="flag-icon flag-icon-id mr-2"></i> Indonesian</option> <!-- Indonesian flag -->
                                <option value="it"><i class="flag-icon flag-icon-it mr-2"></i> Italian</option> <!-- Italian flag -->
                                <option value="ja"><i class="flag-icon flag-icon-jp mr-2"></i> Japanese</option> <!-- Japanese flag -->
                                <option value="ko"><i class="flag-icon flag-icon-kr mr-2"></i> Korean</option> <!-- South Korean flag -->
                                <option value="ms"><i class="flag-icon flag-icon-my mr-2"></i> Malay</option> <!-- Malaysian flag -->
                                <option value="nl"><i class="flag-icon flag-icon-nl mr-2"></i> Dutch</option> <!-- Dutch flag -->
                                <option value="no"><i class="flag-icon flag-icon-no mr-2"></i> Norwegian</option> <!-- Norwegian flag -->
                                <option value="pl"><i class="flag-icon flag-icon-pl mr-2"></i> Polish</option> <!-- Polish flag -->
                                <option value="pt"><i class="flag-icon flag-icon-pt mr-2"></i> Portuguese</option> <!-- Portuguese flag -->
                                <option value="ro"><i class="flag-icon flag-icon-ro mr-2"></i> Romanian</option> <!-- Romanian flag -->
                                <option value="ru"><i class="flag-icon flag-icon-ru mr-2"></i> Russian</option> <!-- Russian flag -->
                                <option value="sv"><i class="flag-icon flag-icon-se mr-2"></i> Swedish</option> <!-- Swedish flag -->
                                <option value="th"><i class="flag-icon flag-icon-th mr-2"></i> Thai</option> <!-- Thai flag -->
                                <option value="tr"><i class="flag-icon flag-icon-tr mr-2"></i> Turkish</option> <!-- Turkish flag -->
                                <option value="vi"><i class="flag-icon flag-icon-vn mr-2"></i> Vietnamese</option> <!-- Vietnamese flag -->
                                <option value="zh"><i class="flag-icon flag-icon-cn mr-2"></i> Chinese</option> <!-- Chinese flag -->
                            </select>

                        </div>






                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>
                            <input type="text" class="form-control form-control-lg" name="description" value='' placeholder="" required="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('status'); ?> </label>
                            <select class="form-control form-control-lg" name="status" value='' required="">
                                <option value="1"><?php echo lang('active'); ?></option>
                                <option value="0"><?php echo lang('inactive'); ?></option>
                            </select>
                        </div>

                        <input type="hidden" name="id" value="">


                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->





<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/language.js"></script>

<script>
    $(document).ready(function() {
        $(".table").on("click", ".editbutton", function() {
            $("#loader").show();
            "use strict";
            var iid = $(this).attr("data-id");
            $("#editLanguageForm").trigger("reset");

            $.ajax({
                url: "settings/editLanguageJason?id=" + iid,
                method: "GET",
                data: "",
                dataType: "json",
                success: function(response) {
                    "use strict";
                    $("#editLanguageForm")
                        .find('[name="id"]')
                        .val(response.language.id)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="language"]')
                        .val(response.language.language)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="flag_icon"]')
                        .val(response.language.flag_icon)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="description"]')
                        .val(response.language.description)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="status"]')
                        .val(response.language.status)
                        .end();

                    $("#loader").hide();

                    $("#myModal2").modal("show");


                },
            });
        });
    });
</script>
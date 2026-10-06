"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        $("#loader").show();
        var iid = $(this).attr('data-id');
        $('#editMedicineForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'medicine/editMedicineByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end();
                $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end();
                $('#editMedicineForm').find('[name="box"]').val(response.medicine.box).end();
                $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end();
                $('#editMedicineForm').find('[name="s_price"]').val(response.medicine.s_price).end();
                $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end();
                $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end();
                $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end();
                $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end();
            },
            complete: function () {
                $("#loader").hide();
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".load", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editMedicineForm1').trigger("reset");
        $('#myModal3').modal('show');


        $('#editMedicineForm1').find('[name="id"]').val(iid).end();
    });
});

$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample1').DataTable({
        responsive: true,

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "medicine/getMedicineList",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            { extend: 'copyHtml5', exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], } },
            { extend: 'excelHtml5', exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], } },
            { extend: 'csvHtml5', exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], } },
            { extend: 'pdfHtml5', exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], } },
            { extend: 'print', exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], } },
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 100,
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        },
    });
    table.buttons().container().appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

// Medicine Delete Safety Check
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".delete_button", function (e) {
        e.preventDefault();
        var deleteUrl = $(this).attr('href');
        var medicineId = deleteUrl.split('id=')[1];
        
        // Show loading
        $("#safetyCheckContent").html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br>Checking for related records...</div>');
        $('#deleteSafetyModal').modal('show');
        
        // Check for related records
        $.ajax({
            url: 'medicine/checkDeleteSafety?id=' + medicineId,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                var content = '';
                var confirmBtn = $('#confirmDeleteBtn');
                
                if (response.can_delete) {
                    // Safe to delete
                    content = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle fa-2x mb-3"></i>
                            <h5 class="text-success">${response.medicine_name}</h5>
                            <p class="mb-0">No related records found. This medicine can be safely deleted.</p>
                        </div>
                    `;
                    confirmBtn.show();
                } else {
                    // Cannot delete - show related records
                    content = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                            <h5 class="text-danger">${response.medicine_name}</h5>
                            <p class="mb-3">Cannot delete this medicine because it has related records:</p>
                            <ul class="list-unstyled">
                    `;
                    
                    if (response.related_records.purchase_items) {
                        content += `<li><i class="fas fa-shopping-cart text-primary"></i> <strong>Purchase Records:</strong> ${response.related_records.purchase_items} items</li>`;
                    }
                    if (response.related_records.batches) {
                        content += `<li><i class="fas fa-boxes text-info"></i> <strong>Batch Records:</strong> ${response.related_records.batches} batches</li>`;
                    }
                    if (response.related_records.sales) {
                        content += `<li><i class="fas fa-cash-register text-success"></i> <strong>Sales Records:</strong> ${response.related_records.sales} sales</li>`;
                    }
                    if (response.related_records.prescriptions) {
                        content += `<li><i class="fas fa-prescription-bottle-alt text-warning"></i> <strong>Prescription Records:</strong> ${response.related_records.prescriptions} prescriptions</li>`;
                    }
                    
                    content += `
                            </ul>
                            <p class="mt-3 mb-0"><strong>Please delete related records first before deleting this medicine.</strong></p>
                        </div>
                    `;
                    confirmBtn.hide();
                }
                
                $("#safetyCheckContent").html(content);
            },
            error: function () {
                $("#safetyCheckContent").html('<div class="alert alert-danger">Error checking for related records. Please try again.</div>');
                $('#confirmDeleteBtn').hide();
            }
        });
    });
    
    // Handle confirm delete
    $('#confirmDeleteBtn').on('click', function () {
        var deleteUrl = $('.delete_button').attr('href');
        window.location.href = deleteUrl;
    });
});



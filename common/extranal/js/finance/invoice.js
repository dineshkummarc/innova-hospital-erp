   "use strict";
$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function() {
    "use strict";

    $('.other').hide();
    $(".radio_button").on("change", "input[type=radio][name=radio]", function() {
        if (this.value === 'other') {
            $('.other').show();
        } else {
            $('.other').hide();
        }
    });

});
$(document).ready(function() {
    "use strict";

    $('.single_patient').hide();
    $('input[type=radio][name=radio]').change(function() {
        if (this.value === 'single_patient') {
            $('.single_patient').show();
        } else {
            $('.single_patient').hide();
        }
    });

});

"use strict";
$(document).ready(function () {
  "use strict";
  $(".depositButton").click(function(){
  // $(".body").on("click", ".depositButton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    var from = $(this).attr("data-from");
    $("#due_amount").val("");
    $("#payment_id").val("");
    $("#patient_id").val("");
    $("#name").val("");
    $("#invoice_no").val("");
    $("#date").val("");
    $("#editDepositform").trigger("reset");
    $("#myModal").modal("show");
    $.ajax({
      url: "finance/getDepositByInvoiceIdForDeposit?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var d = new Date();
        var strDate =
          d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();  
        $("#due_amount").val(response.response);
        if (from == 'appointment') {
          $("#deposited_amount").val(response.response);
          $('#deposited_amount').attr('readonly', true);
        }
        $("#payment_id").val(iid);
        $("#patient_id").val(response.patient.id);
        $("#name").val(response.patient.name);
        $("#invoice_no").val(iid);
        $("#date").val(strDate);
      },
    });
  });
});
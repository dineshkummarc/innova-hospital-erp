 "use strict";
$(".download_button").on("click", "#download", function () {
    "use strict";
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addHTML($('#prescription'), function () {
        "use strict";
        pdf.save('prescription_id_' + id_pres + '.pdf');
    });
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

$(document).ready(function () {
    "use strict";

    $('.single_pharmacist').hide();
    $('input[type=radio][name=radio]').change(function () {
        if (this.value === 'single_pharmacist') {
            $('.single_pharmacist').show();
        } else {
            $('.single_pharmacist').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";
    $("#pharmacistchoose").select2({
        placeholder: select_pharmacist,
        allowClear: true,
        ajax: {
            url: 'email/getPharmacistInfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
});


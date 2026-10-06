"use strict";
if (top.location != location) {
  top.location.href = document.location.href;
}
$(function () {

  if (typeof $.fn.datepicker !== 'undefined') {
    window.prettyPrint && prettyPrint();
    var curLangDate = typeof langdate !== 'undefined' ? langdate : 'en-CA';
    $(".default-date-picker").datepicker({
      format: "mm-dd-yyyy",
      language: curLangDate
    });
    $(".dpYears").datepicker();
    $(".dpMonths").datepicker();

    var startDate = new Date(2012, 1, 20);
    var endDate = new Date(2012, 1, 25);
    $(".dp4")
      .datepicker()
      .on("changeDate", function (ev) {
        if (ev.date.valueOf() > endDate.valueOf()) {
          $(".alert")
            .show()
            .find("strong")
            .text("The start date can not be greater then the end date");
        } else {
          $(".alert").hide();
          startDate = new Date(ev.date);
          $("#startDate").text($(".dp4").data("date"));
        }
        $(".dp4").datepicker("hide");
      });
    $(".dp5")
      .datepicker()
      .on("changeDate", function (ev) {
        if (ev.date.valueOf() < startDate.valueOf()) {
          $(".alert")
            .show()
            .find("strong")
            .text("The end date can not be less then the start date");
        } else {
          $(".alert").hide();
          endDate = new Date(ev.date);
          $(".endDate").text($(".dp5").data("date"));
        }
        $(".dp5").datepicker("hide");
      });

    // disabling dates
    var nowTemp = new Date();
    var now = new Date(
      nowTemp.getFullYear(),
      nowTemp.getMonth(),
      nowTemp.getDate(),
      0,
      0,
      0,
      0
    );

    var checkin = $(".dpd1")
      .datepicker({
        language: curLangDate,
        onRender: function (date) {
          return date.valueOf() < now.valueOf() ? "disabled" : "";
        },
      })
      .on("changeDate", function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
          var newDate = new Date(ev.date);
          newDate.setDate(newDate.getDate() + 1);
          checkout.setValue(newDate);
        }
        checkin.hide();
        $(".dpd2")[0].focus();
      })
      .data("datepicker");

    var checkout = $(".dpd2")
      .datepicker({
        language: curLangDate,
        onRender: function (date) {
          return date.valueOf() <= checkin.date.valueOf() ? "disabled" : "";
        },
      })
      .on("changeDate", function (ev) {
        checkout.hide();
      })
      .data("datepicker");
  }
});

$(function () {
  // datetimepicker safe initialization
  if (typeof $.fn.datetimepicker !== 'undefined') {
    $(".form_datetime").datetimepicker({ format: "yyyy-mm-dd hh:ii" });

    $(".form_datetime-component").datetimepicker({
      format: "dd MM yyyy - hh:ii",
    });

    $(".form_datetime-adv").datetimepicker({
      format: "dd MM yyyy - hh:ii",
      autoclose: true,
      todayBtn: true,
      startDate: "2013-02-14 10:00",
      minuteStep: 10,
    });

    $(".form_datetime-meridian").datetimepicker({
      format: "dd MM yyyy - HH:ii P",
      showMeridian: true,
      autoclose: true,
      todayBtn: true,
    });
  }

  // timepicker safe initialization
  if (typeof $.fn.timepicker !== 'undefined') {
    $(".timepicker-default").timepicker({
      defaultTime: 'current',
      showMeridian: false,
    });

    $(".timepicker-24").timepicker({
      autoclose: true,
      minuteStep: 1,
      showSeconds: true,
      showMeridian: false,
    });
  }

  // colorpicker safe initialization
  if (typeof $.fn.colorpicker !== 'undefined') {
    $(".colorpicker-default").colorpicker({
      format: "hex",
    });
    $(".colorpicker-rgba").colorpicker();
  }

  // multiselect safe initialization
  if (typeof $.fn.multiSelect !== 'undefined') {
    $("#my_multi_select1").multiSelect();
    $("#my_multi_select2").multiSelect({
      selectableOptgroup: true,
    });

    if (typeof $.fn.quicksearch !== 'undefined') {
      $("#my_multi_select3").multiSelect({
        selectableHeader:
          "<input type='text' class='form-control search-input col-md-12' autocomplete='off' placeholder='search...'>",
        selectionHeader:
          "<input type='text' class='form-control search-input col-md-12' autocomplete='off' placeholder='search...'>",
        afterInit: function (ms) {
          var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString =
              "#" +
              that.$container.attr("id") +
              " .ms-elem-selectable:not(.ms-selected)",
            selectionSearchString =
              "#" + that.$container.attr("id") + " .ms-elem-selection.ms-selected";

          that.qs1 = $selectableSearch
            .quicksearch(selectableSearchString)
            .on("keydown", function (e) {
              if (e.which === 40) {
                that.$selectableUl.focus();
                return false;
              }
            });

          that.qs2 = $selectionSearch
            .quicksearch(selectionSearchString)
            .on("keydown", function (e) {
              if (e.which == 40) {
                that.$selectionUl.focus();
                return false;
              }
            });
        },
        afterSelect: function () {
          this.qs1 && this.qs1.cache();
          this.qs2 && this.qs2.cache();
        },
        afterDeselect: function () {
          this.qs1 && this.qs1.cache();
          this.qs2 && this.qs2.cache();
        },
      });
    }
  }

  // wysihtml5 safe initialization
  if (typeof $.fn.wysihtml5 !== 'undefined') {
    $(".wysihtml5").wysihtml5();
  }
});

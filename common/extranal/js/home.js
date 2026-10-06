// "use strict";
// if (superadmin_login == 'no') {
//     google.charts.load("current", { packages: ["corechart"] });

//     function drawChartupdate() {
//         "use strict";
//         var months = [January, February, March, April, May, June,
//             July, August, September, October, November, December];

//         var d = new Date();

//         var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();


//         var data = google.visualization.arrayToDataTable([
//             ['Task', 'Hours per Day'],
//             [income_lang, payment_this],
//             [expense_lang, expense_this],
//         ]);

//         var options = {
//             title: selectedMonthName,
//             is3D: true
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
//         chart.draw(data, options);
//     }
//     google.charts.setOnLoadCallback(drawChartupdate);
//     google.charts.load("current", { packages: ["corechart"] });

//     function drawChart() {
//         "use strict";
//         var months = [January, February, March, April, May, June,
//             July, August, September, October, November, December];

//         var d = new Date();
//         var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();

//         var data = google.visualization.arrayToDataTable([
//             ['Task', 'Num of Appointment'],
//             [treated_lang, appointment_treated],
//             [cancelled_lang, appointment_cancelled],
//         ]);

//         var options = {
//             title: selectedMonthName + appointment_lang,
//             is3D: true
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
//         chart.draw(data, options);
//     }


//     google.charts.setOnLoadCallback(drawChart);


//     google.charts.load('current', { 'packages': ['corechart'] });
//     google.charts.setOnLoadCallback(drawVisualization);

//     function drawVisualization() {
//         "use strict";
//         var data = google.visualization.arrayToDataTable([
//             ['Month', income_lang, expense_lang],
//             [jan, this_year['january'], this_year_expenses['january']],
//             [feb, this_year['february'], this_year_expenses['february']],
//             [mar, this_year['march'], this_year_expenses['march']],
//             [apr, this_year['april'], this_year_expenses['april']],
//             [may, this_year['may'], this_year_expenses['may']],
//             [june, this_year['june'], this_year_expenses['june']],
//             [july, this_year['july'], this_year_expenses['july']],
//             [aug, this_year['august'], this_year_expenses['august']],
//             [sep, this_year['september'], this_year_expenses['september']],
//             [oct, this_year['october'], this_year_expenses['october']],
//             [nov, this_year['november'], this_year_expenses['november']],
//             [dec, this_year['december'], this_year_expenses['december']]
//         ]);

//         var options = {
//             title: new Date().getFullYear() + " " + per_month_income_expense,
//             vAxis: { title: currency },
//             hAxis: { title: months_lang },
//             seriesType: 'bars',
//             series: { 5: { type: 'line' } }
//         };

//         var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
//         chart.draw(data, options);
//     }
// } else {
//     google.charts.load('current', { 'packages': ['corechart'] });
//     google.charts.setOnLoadCallback(drawVisualization);

//     function drawVisualization() {
//         // Some raw data (not necessarily accurate)
//         var data = google.visualization.arrayToDataTable([
//             ['Month', income_lang],
//             [jan, this_year['january']],
//             [feb, this_year['february']],
//             [mar, this_year['march']],
//             [apr, this_year['april']],
//             [may, this_year['may']],
//             [june, this_year['june']],
//             [july, this_year['july']],
//             [aug, this_year['august']],
//             [sep, this_year['september']],
//             [oct, this_year['october']],
//             [nov, this_year['november']],
//             [dec, this_year['december']]
//         ]);

//         var options = {
//             title: new Date().getFullYear() + " " + per_month_income_expense,
//             vAxis: { title: currency },
//             hAxis: { title: months_lang },
//             seriesType: 'bars',
//             series: { 5: { type: 'line' } }
//         };

//         var chart = new google.visualization.ComboChart(document.getElementById('chart_div_superadmin'));
//         chart.draw(data, options);
//     }

//     google.charts.load("current", { packages: ["corechart"] });
//     google.charts.setOnLoadCallback(drawChart);
//     function drawChart() {

//         var months = [January, February, March, April, May, June,
//             July, August, September, October, November, December];

//         var d = new Date();
//         var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();
//         //        if (superadmin_month_payment == 0) {
//         //            superadmin_month_payment = 0;
//         //        } else {
//         //            superadmin_month_payment = superadmin_month_payment;
//         //        }
//         //        if (superadmin_year_payment == 0) {
//         //            superadmin_year_payment = 0;
//         //        } else {
//         //            superadmin_year_payment = superadmin_year_payment;
//         //        }
//         var data = google.visualization.arrayToDataTable([
//             ['Task', 'Hours per Day'],
//             [monthly_subscription_lang, superadmin_month_payment],
//             [yearly_subscription_lang, superadmin_year_payment],
//         ]);

//         var options = {
//             title: selectedMonthName,
//             is3D: true,
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_superadmin'));
//         chart.draw(data, options);
//     }

// }




"use strict";
if (superadmin_login == 'no') {
    google.charts.load("current", { packages: ["corechart"] });

    function drawChartupdate() {
        "use strict";
        var months = [January, February, March, April, May, June,
            July, August, September, October, November, December];

        var d = new Date();

        var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();


        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            [income_lang, payment_this],
            [expense_lang, expense_this],
        ]);

        var options = {
            title: selectedMonthName,
            is3D: true,
            colors: ['#007BFF', '#36454F', '#ec8f6e'] // Setting colors
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChartupdate);
    google.charts.load("current", { packages: ["corechart"] });

    function drawChart() {
        "use strict";
        var months = [January, February, March, April, May, June,
            July, August, September, October, November, December];

        var d = new Date();
        var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Num of Appointment'],
            [treated_lang, appointment_treated],
            [cancelled_lang, appointment_cancelled],
        ]);

        var options = {
            title: selectedMonthName + appointment_lang,
            is3D: true,
            colors: ['#007BFF', '#36454F', '#ec8f6e'] // Setting colors
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }


    google.charts.setOnLoadCallback(drawChart);


    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        "use strict";
        var data = google.visualization.arrayToDataTable([
            ['Month', '', ''],
            [jan, this_year['january'], this_year_expenses['january']],
            [feb, this_year['february'], this_year_expenses['february']],
            [mar, this_year['march'], this_year_expenses['march']],
            [apr, this_year['april'], this_year_expenses['april']],
            [may, this_year['may'], this_year_expenses['may']],
            [june, this_year['june'], this_year_expenses['june']],
            [july, this_year['july'], this_year_expenses['july']],
            [aug, this_year['august'], this_year_expenses['august']],
            [sep, this_year['september'], this_year_expenses['september']],
            [oct, this_year['october'], this_year_expenses['october']],
            [nov, this_year['november'], this_year_expenses['november']],
            [dec, this_year['december'], this_year_expenses['december']]
        ]);

        var options = {
            title: new Date().getFullYear() + " " + income + " / " + expense,
            // vAxis: { title: currency },
            // hAxis: { title: months_lang },
            seriesType: 'line',
            // series: {
            //     0: { type: 'line', color: '#FF0000' }, // First series (income) will be displayed as a line with red color
            //     1: { type: 'area', color: '#00FF00' }, // Second series (expense) will be displayed as an area chart with green color
            // },
            colors: ['#007BFF', '#36454F', '#ec8f6e'], // Setting colors
            chartArea: {
                left: 40,   // Decrease left padding
                right: 20,  // Decrease right padding // Decrease bottom padding
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
} else {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', income_lang],
            [jan, this_year['january']],
            [feb, this_year['february']],
            [mar, this_year['march']],
            [apr, this_year['april']],
            [may, this_year['may']],
            [june, this_year['june']],
            [july, this_year['july']],
            [aug, this_year['august']],
            [sep, this_year['september']],
            [oct, this_year['october']],
            [nov, this_year['november']],
            [dec, this_year['december']]
        ]);

        var options = {
            title: new Date().getFullYear() + " " + income + " / " + expense,
            vAxis: { title: currency },
            hAxis: { title: months_lang },
            seriesType: 'bars',
            series: { 5: { type: 'line' } },
            colors: ['#007BFF', '#36454F', '#ec8f6e'] // Setting colors
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div_superadmin'));
        chart.draw(data, options);
    }

    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var months = [January, February, March, April, May, June,
            July, August, September, October, November, December];

        var d = new Date();
        var selectedMonthName = months[d.getMonth()] + ', ' + d.getFullYear();
        //        if (superadmin_month_payment == 0) {
        //            superadmin_month_payment = 0;
        //        } else {
        //            superadmin_month_payment = superadmin_month_payment;
        //        }
        //        if (superadmin_year_payment == 0) {
        //            superadmin_year_payment = 0;
        //        } else {
        //            superadmin_year_payment = superadmin_year_payment;
        //        }
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            [monthly_subscription_lang, superadmin_month_payment],
            [yearly_subscription_lang, superadmin_year_payment],
        ]);

        var options = {
            title: selectedMonthName,
            is3D: true,
            colors: ['#007BFF', '#36454F', '#ec8f6e'] // Setting colors
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_superadmin'));
        chart.draw(data, options);
    }

}


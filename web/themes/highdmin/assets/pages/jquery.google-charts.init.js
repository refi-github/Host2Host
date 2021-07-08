/**
 * Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
 * Author: Coderthemes
 * Module/App: Google Chart
 */

! function($) {
    "use strict";

    var GoogleChart = function() {
        this.$body = $("body")
    };

    //creates line graph
    GoogleChart.prototype.createLineChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 340,
            curveType: 'function',
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 300
            },
            pointSize: 4,
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 14
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 12,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 14
                }
            },
            lineWidth: 3,
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var line_chart = new google.visualization.LineChart(selector);
        line_chart.draw(google_chart_data, options);
        return line_chart;
    },

    //creates Column graph
    GoogleChart.prototype.createColumnChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 300,
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 200
            },
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 12,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var column_chart = new google.visualization.ColumnChart(selector);
        column_chart.draw(google_chart_data, options);
        return column_chart;
    },

    //creates pie chart
    GoogleChart.prototype.createPieChart = function(selector, data, colors, is3D, issliced) {
        var options = {
            fontName: 'Roboto',
            fontSize: 13,
            height: 300,
            chartArea: {
                left: 50,
                width: '90%',
                height: '90%'
            },
            colors: colors
        };

        if(is3D) {
            options['is3D'] = true;
        }

        if(issliced) {
            options['is3D'] = true;
            options['pieSliceText'] = 'label';
            options['slices'] = {
                2: {offset: 0.15},
                5: {offset: 0.1}
            };
        }

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var pie_chart = new google.visualization.PieChart(selector);
        pie_chart.draw(google_chart_data, options);
        return pie_chart;
    },

    //init
    GoogleChart.prototype.init = function (str) {
        var $this = this;

        //creating line chart
        var monthlyStatistics = $('#monthly-statistics').val();
        var common_data = JSON.parse(monthlyStatistics);
        console.log(common_data);
        $this.createLineChart($('#line-chart')[0], common_data, 'Total', ['#03A9F4', '#FFEB3B', '#E91E63', '#00E676']);

        //creating before buyback chart
        var before_buyback_data = [
            ['Mitra', "OD < 30 Days", "OD > 30 - 90 Days", "OD > 90 Days"],
            ['01', 6000, 1000, 0],
            ['02', 8000, 971, 0],
            ['03', 6000, 1900, 1600],
            ['04', 6000, 1300, 60],
            ['05', 26000, 4200, 1600],
            ['06', 6000, 1000, 0],
            ['07', 8000, 971, 0],
            ['08', 6000, 1900, 1600],
            ['09', 6000, 1300, 60],
            ['10', 26000, 4200, 1600],
            ['11', 6000, 1000, 0],
            ['12', 8000, 971, 0],
        ];
        if ($('#before-buyback-chart').length > 0) {
            $this.createColumnChart($('#before-buyback-chart')[0], before_buyback_data, '', ['#1a237e','#448aff', '#b71c1c']);
        }

        //creating after buyback chart
        var after_buyback_data = [
            ['Mitra', "OD < 30 Days", "OD 30 - 90 Days", "OD > 90 Days"],
            ['Cashwagon', 6000, 1000, 0],
            ['Uangme', 8000, 971, 0],
            ['Reli Robo PDS', 6000, 1900, 0],
            ['Shopintar', 6000, 1300, 0],
            ['Total', 26000, 4200, 0],
        ];
        if ($('#after-buyback-chart').length > 0) {
            $this.createColumnChart($('#after-buyback-chart')[0], after_buyback_data, '', ['#1a237e','#448aff', '#b71c1c']);
        }

        //creating Application chart
        var application_success = parseInt($('#application-success').val());
        var application_pending = parseInt($('#application-pending').val());
        var application_rejected = parseInt($('#application-rejected').val());
        var application_postponed = parseInt($('#application-postponed').val());
        var application_data = [
            ['Task', 'Hours per Day'],
            ['Approved', application_success],
            ['Pending', application_pending],
            ['Rejected', application_rejected],
            ['Postponed', application_postponed],
        ];
        if ($('#application-chart').length > 0) {
            $this.createPieChart($('#application-chart')[0], application_data, ['#00bfa5','#fbc02d','#e57373', '#546e7a'], false, false);
        }


        //creating Aging chart
        var aging_not_due = parseInt($('#aging-not-due').val());
        var aging_1_30 = parseInt($('#aging-1-30').val());
        var aging_31_60 = parseInt($('#aging-31-60').val());
        var aging_61_90 = parseInt($('#aging-61-90').val());
        var aging_90 = parseInt($('#aging-90').val());
        var aging_data = [
            ['Task', 'Hours per Day'],
            ['Not Due', aging_not_due],
            ['OD 1 - 30 days', aging_1_30],
            ['OD 31 - 60 days', aging_31_60],
            ['OD 61 - 90 days', aging_61_90],
            ['OD > 90 days', aging_90],
        ];
        if ($('#aging-chart').length > 0) {
            $this.createPieChart($('#aging-chart')[0], aging_data, ['#00bfa5','#fbc02d','#e57373', '#546e7a', '#00acc1'], false, false);
        }

    },
    //init GoogleChart
    $.GoogleChart = new GoogleChart, $.GoogleChart.Constructor = GoogleChart
}(window.jQuery),

//initializing GoogleChart
function($) {
    "use strict";
    //loading visualization lib - don't forget to include this
    google.load("visualization", "1", {packages:["corechart"]});
    //after finished load, calling init method
    google.setOnLoadCallback(function() {$.GoogleChart.init();});
}(window.jQuery);

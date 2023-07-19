
let dashboardPostData = {
    start_date: moment().subtract(30, 'd').format('YYYY-MM-DD 00:00:00'),
    end_date: moment().format('YYYY-MM-DD 23:59:59')
};
(new DpzDashboard()).getSummary();
(new DpzDashboard()).loadPayInAndOutChart();


function DpzDashboard() {

    this.getSummary = () => {
        DpzHelper.blockUi("#counttileszone");
        DpzClient.post("/api/dashboard/summary")
            .then((response) => {
                $("#totalBalance").text(DpzHelper.amountParse(response.data.TOTAL_BALANCE));
                $("#availableBalance").text(DpzHelper.amountParse(response.data.REMAINING_BALANCE));
                $("#totalWithdrawal").text(DpzHelper.amountParse(response.data.TOTAL_WITHDRAWAL));
                $("#settledBalance").text(DpzHelper.amountParse(response.data.SETTLED_BALANCE));
                $("#unsettledBalance").text(DpzHelper.amountParse(response.data.UNSETTLED_BALANCE));
                $("#totalLoadBalance").text(DpzHelper.amountParse(response.data.LOAD_BALANCE));
                $("#todayTransaction").text(response.data.TODAY_SUCCESS_TXN);
                $("#todayTransactionAmount").text(DpzHelper.amountParse(response.data.TODAY_SUCCESS_TXN_AMOUNT));
                $("#todayPayout").text(response.data.TODAY_PAYOUT);
                $("#todayPayoutAmount").text(DpzHelper.amountParse(response.data.TODAY_PAYOUT_AMOUNT));
                $("#pendingPayout").text(response.data.PENDING_PAYOUT);
                $("#pendingPayoutAmountC").text(DpzHelper.amountParse(response.data.PENDING_PAYOUT_AMOUNT));
                DpzHelper.unblockUi("#counttileszone");
            })
            .catch((error) => {
                $("#totalBalance").text(DpzHelper.amountParse(0));
                $("#availableBalance").text(DpzHelper.amountParse(0));
                $("#totalWithdrawal").text(DpzHelper.amountParse(0));
                $("#settledBalance").text(DpzHelper.amountParse(0));
                $("#unsettledBalance").text(DpzHelper.amountParse(0));
                $("#totalLoadBalance").text(DpzHelper.amountParse(0));
                $("#todayTransaction").text(0);
                $("#todayTransactionAmount").text(DpzHelper.amountParse(0));
                $("#todayPayout").text(0);
                $("#todayPayoutAmount").text(DpzHelper.amountParse(0));
                $("#pendingPayout").text(0);
                $("#pendingPayoutAmountC").text(DpzHelper.amountParse(0));
                DpzHelper.unblockUi("#counttileszone");
            })
    };

    this.loadPayInAndOutChart = () => {
        DpzClient.post("/api/dashboard/chart/summary", dashboardPostData)
            .then((response) => {
                console.log(response);
                loadChart(response.data);
                $("#chart_last_update").text(response.data.last_update);
            })
            .catch((error) => {
                console.log(error)
                this.setEmptyChart();
            });
    };

    this.setEmptyChart = () => {
        const htmlData = `<div class="text-center pt-5 pb-5">
                                    <img src="/custom/img/404.svg" class="record-not-found">
                                    <div class="mt-2">
                                        <span>No data to display.</span>
                                    </div>
                                </div>`;
        $("#pay-in-out-chart").html(htmlData);
    };

}

$('#txnDatePicker').daterangepicker({
    "autoApply": true,
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "autoUpdateInput": false,
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
        "monthNames": [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],
        "firstDay": 1
    },
    "linkedCalendars": false,
    "showCustomRangeLabel": false,
    "startDate": moment().subtract(30, 'd'),
    "endDate": moment(),
    "maxDate": moment(),
    "maxSpan": {
        "days": 30
    },
}, function(start, end, label) {
    dashboardPostData.end_date = end.format('YYYY-MM-DD 23:59:59');
    dashboardPostData.start_date = start.format('YYYY-MM-DD 00:00:00');
    (new DpzDashboard()).loadPayInAndOutChart();
});
let chart = null;
function loadChart(data) {

    if(chart) {
        chart.destroy();
    }
    let options = {
        series: [{
            name: "Payin",
            data: data.chartInSeriesAmount,
        },{
            name: "Payout",
            data: data.chartOutSeriesAmount
        }],
        chart: {
            fontFamily: "'Overpass', sans-serif",
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false,
            style: {
                fontSize: '12px',
                fontWeight: 'bold',
            },
            background: {
                enabled: true,
                foreColor: '#5e5da9',
                borderRadius: 2,
                padding: 4,
                opacity: 0.9,
                borderWidth: 1,
                borderColor: '#fff'
            },
        },
        stroke: {
            show: true,
            curve: 'straight',
            lineCap: 'butt',
            colors: [  '#5e5da9', 'rgb(0, 227, 150)'],
            width: 2,
            dashArray: 0,
        },
        grid: {
            show: false,
            position: 'back',
            row: {
                colors: ['transparent', 'transparent'],
                opacity: 0.1
            },
        },
        tooltip: {
            enabled: true,
            style: {
                fontSize: '12px',
            },
            y: {
                formatter: undefined,
                title: {
                    formatter: (seriesName) => seriesName,
                },
            },
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: data.chartCategories,
            tickPlacement: 'on'
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    // return  "₹" + DpzHelper.abbreviateNumber(value, DpzHelper.abbreviateNumber(parseInt(value),0));
                    return  "₹" + value;
                }
            },
        },
        legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'center',
            floating: false,
            fontSize: '14px',
        }
    };


    chart = new ApexCharts(document.querySelector("#pay-in-out-chart"), options);
    chart.render();
}



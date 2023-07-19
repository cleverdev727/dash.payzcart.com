let reportPostData = {
    filter_data: {
        type: null,
        status: null,
        start_date: moment().subtract(7, 'd').format('YYYY-MM-DD'),
        end_date: moment().format('YYYY-MM-DD')
    },
    page_no: 1,
    limit: 10
};

let reportPaginateData = {
    link_limit: 2,
    from: 2,
    to: 2,
    total: null,
    is_last: null,
    current_item_count: null,
    current_page: null,
    last_page: null,
};
(new DzpReport()).getReports();
DzpDatePickerService.init();
function DzpReport() {
    this.addReport = (pd) => {
        DpzHelper.blockUi("#reportGenerateForm");
        DpzClient.post("/api/add/report", pd)
            .then((response) => {
                DpzHelper.successSnack(response.message);
                $("#reportGenerateForm")[0].reset();
                (new DzpReport()).getReports();
                DpzHelper.unblockUi("#reportGenerateForm");
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                DpzHelper.unblockUi("#reportGenerateForm");
            });
    }

    this.downloadReport = (pd) => {
        DpzHelper.blockUi("#reportDataZone");
        DpzClient.post("/api/report/download", pd)
            .then((response) => {
                DpzHelper.successSnack(response.message);
                window.open(response.data.report_url);
                DpzHelper.unblockUi("#reportDataZone");
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                DpzHelper.unblockUi("#reportDataZone");
            });
    }

    this.getReports = () => {
        DpzHelper.blockUi("#reportDataZone");
        DpzClient.post("/api/get/report", reportPostData)
            .then((response) => {
                reportPaginateData.total              = response.total_item;
                reportPaginateData.is_last            = response.is_last;
                reportPaginateData.current_item_count = response.current_item_count;
                reportPaginateData.current_page       = response.current_page;
                reportPaginateData.last_page          = response.last_page;
                this.setHtmlData(response.data.data);
                DpzHelper.unblockUi("#reportDataZone");
            })
            .catch((error) => {
                console.log(error)
                this.setEmptyHtml();
                DpzHelper.unblockUi("#reportDataZone");
            });
    }

    this.setHtmlData = (responseData) => {
        let htmlData = "";
        (responseData).forEach((item, index) => {
            htmlData += `<tr>
                            <td>
                                <span class="font-weight-bold d-block cursor-pointer mb-1">${item.report_id}</span>
                            </td>
                            <td>
                                <span class="d-block">${item.report_type}</span>
                            </td>
                            <td>
                                <span class="d-block">From: ${item.filter_start_date}</span>
                                <span class="d-block">To: ${item.filter_end_date}</span>
                            </td>
                            <td>
                                <span class="d-block">${DpzHelper.getTransactionStatus(item.report_status_f)}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.record ? item.record : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.expiry_date_f ? item.expiry_date_f : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.report_date}</span>
                            </td>
                            <td>
                                ${this.getReportActionButton(item.report_status_f, item.report_id)}
                            </td>
                        </tr>`;
        });
        $("#reportData").html(htmlData);
        setPaginateButton("report-logs-page-change-event", reportPaginateData, reportPostData);
        $(".downloadReport").on("click", (e) => {
            const pd = {
                report_id: e.target.attributes["data-report"].value
            };
            this.downloadReport(pd)
        })
    }

    this.setEmptyHtml = () => {
        const htmlData = `<td colspan="7">
                                <div class="text-center pt-5 pb-5">
                                    <img src="/custom/img/404.svg" class="record-not-found">
                                    <div class="mt-2">
                                        <span>Record does not exist.</span>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
        $("#reportData").html(htmlData);
        $("#pagination").html("");
    }

    this.getReportActionButton = (status, reportId) => {
        let button = "";
        if(status === "Success") {
            button += `<button class="btn btn-primary downloadReport" data-report="${reportId}">Download</button>`;
        }
        return button;
    }
}

$("#reportGenerateForm").submit(() => {
    const reportGenerateFormData = DpzHelper.serializeObject($("#reportGenerateForm"));
    const payload = {
        report_type: reportGenerateFormData.txtReportType,
        status: reportGenerateFormData.txtReportTypeStatus,
    };
    if(!reportGenerateFormData.txnDatePicker) {
        DpzHelper.errorSnack("Invalid Date");
        return;
    }
    let splitDate  = reportGenerateFormData.txnDatePicker.split(/-/);

    payload.start_date = moment(splitDate[0], 'DD/MM/YYYY').format('YYYY-MM-DD 00:00:00');
    payload.end_date = moment(splitDate[1], 'DD/MM/YYYY').format('YYYY-MM-DD 23:59:59');
    (new DzpReport()).addReport(payload);
});


$("#txtReportType").on("change", (e) => {
    const reportTypeStatusList = {
        TRANSACTION: ["Success", "Failed", "Initialized", "Processing", "Pending", "Expired"],
        PAYOUT: ["Success", "Failed", "Initialized", "Cancelled", "Pending"],
        REFUND: []
    }
    const reportTypeStatus = reportTypeStatusList[e.target.value];
    if(reportTypeStatus) {
        let options = `<option value="All">All</option>`;
        reportTypeStatus.forEach((item, index) => {
            options += `<option value="${item}">${item}</option>`;
        });
        $("#txtReportTypeStatus").html(options);
    }
})

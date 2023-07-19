let refundPostData = {
    filter_data: {
        refund_id: null,
        transaction_id: null,
        refund_amount: null,
        status: null,
        start_date: moment().subtract(7, 'd').format('YYYY-MM-DD'),
        end_date: moment().format('YYYY-MM-DD')
    },
    page_no: 1,
    limit: 10
};

let refundPaginateData = {
    link_limit: 2,
    from: 2,
    to: 2,
    total: null,
    is_last: null,
    current_item_count: null,
    current_page: null,
    last_page: null,
};

(new DzpRefund()).getRefunds();
DzpDatePickerService.init();
function DzpRefund() {

    this.getRefunds = () => {
        DpzHelper.blockUi("#refundDataZone");
        DpzClient.post("/api/refund", refundPostData)
            .then((response) => {
                refundPaginateData.total              = response.total_item;
                refundPaginateData.is_last            = response.is_last;
                refundPaginateData.current_item_count = response.current_item_count;
                refundPaginateData.current_page       = response.current_page;
                refundPaginateData.last_page          = response.last_page;
                this.setHtmlData(response.data);
                DpzHelper.unblockUi("#refundDataZone");
            })
            .catch((error) => {
                this.setEmptyHtml();
                DpzHelper.unblockUi("#refundDataZone");
            });
    }

    this.getRefundDetails = (pd) => {
        DpzClient.post("/api/refund/detail", pd)
            .then((response) => {
                $("#refundDetails").html(atob(response.data));
                DpzHelper.unblockUi("#refundDetails")
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                $("#refundDetailsModal").modal("hide");
                DpzHelper.unblockUi("#refundDetails")
            });
    }

    this.resendWebhook = (pd) => {
        DpzHelper.blockUi("#refundDataZone");
        DpzClient.post("/api/refund/resend/webhook", pd)
            .then((response) => {
                DpzHelper.unblockUi("#refundDataZone");
                DpzHelper.successSnack(response.message);
                (new DzpRefund()).getRefunds();
            })
            .catch((error) => {
                DpzHelper.unblockUi("#refundDataZone");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

    this.setHtmlData = (responseData) => {
        let htmlData = "";
        (responseData).forEach((item, index) => {
            htmlData += `<tr>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.refund_date_ind}</span>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1">${item.refund_id}</span>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1">${item.transaction_id}</span>
                            </td>
                            <td>
                                <span class="d-block">${DpzHelper.getTransactionStatus(item.refund_status)}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">₹${item.refund_amount}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.refund_type ? item.refund_type : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.bank_rrn ? item.bank_rrn : '-'}</span>
                            </td>
                            <td>
                                ${this.getRefundActionButton(item.is_webhook_call, item.refund_status, item.refund_id)}
                            </td>
                        </tr>`;
        });
        $("#refundData").html(htmlData);
        setPaginateButton("refund-logs-page-change-event", refundPaginateData, refundPostData);
        $(".txn-details").on("click", (e) => {
            const pd = {
                refund_id: e.target.attributes["data-refund"].value
            };
            $("#refundDetails").html(blankRefundDetail);
            $("#refundDetailsModal").modal();
            DpzHelper.blockUi("#refundDetails");
            this.getRefundDetails(pd)
        })
        $(".resendWebhook").on("click", (e) => {
            const pd = {
                refund_id: e.target.attributes["data-refund"].value
            };
            this.resendWebhook(pd)
        })
    }

    this.setEmptyHtml = () => {
        const htmlData = `<td colspan="10">
                                <div class="text-center pt-5 pb-5">
                                    <img src="/custom/img/404.svg" class="record-not-found">
                                    <div class="mt-2">
                                        <span>Record does not exist.</span>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
        $("#refundData").html(htmlData);
        $("#pagination").html("");
    }

    this.getRefundActionButton = (is_webhook_call, payout_status, payout_id) => {
        let button = "";
        if(
            is_webhook_call > 0 &&
            (
                payout_status === "Success" ||
                payout_status === "Failed"
            )
        ) {
            button += `<button class="btn btn-primary resendWebhook" data-refund="${payout_id}">Resend Webhook</button>`;
        }
        return button;
    }

}

EventListener.dispatch.on("refund-logs-page-change-event", (event, callback) => {
    refundPostData.page_no = callback.page_number;
    (new DzpRefund()).getRefunds();
});

$("#txnFilterForm").submit(() => {
    refundPostData = {
        filter_data: {
            refund_id: null,
            transaction_id: null,
            refund_amount: null,
            status: null,
            start_date: moment().subtract(7, 'd').format('YYYY-MM-DD'),
            end_date: moment().format('YYYY-MM-DD')
        },
        page_no: 1,
        limit: 10
    };
    const txnFilterFormData = DpzHelper.serializeObject($("#txnFilterForm"));
    refundPostData.filter_data[txnFilterFormData.txtFilterKey] = txnFilterFormData.txtFilterValue;
    refundPostData.filter_data.status = txnFilterFormData.txtStatus;
    refundPostData.limit = txnFilterFormData.txtLimit;

    let splitDate  = txnFilterFormData.txnDatePicker.split(/-/);
    refundPostData.filter_data.start_date = moment(splitDate[0], 'DD/MM/YYYY').format('YYYY-MM-DD 00:00:00');
    refundPostData.filter_data.end_date = moment(splitDate[1], 'DD/MM/YYYY').format('YYYY-MM-DD 23:59:59');

    (new DzpRefund()).getRefunds();
});

function clearFilter() {
    refundPostData = {
        filter_data: {
            refund_id: null,
            transaction_id: null,
            refund_amount: null,
            status: null,
            start_date: moment().subtract(7, 'd').format('YYYY-MM-DD'),
            end_date: moment().format('YYYY-MM-DD')
        },
        page_no: 1,
        limit: 10
    };
    DzpDatePickerService.init();
    (new DzpRefund()).getRefunds();
}


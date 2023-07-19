let transactionPostData = {
    filter_data: {
        transaction_id: null,
        order_id: null,
        customer_email: null,
        customer_mobile: null,
        payment_amount: null,
        status: 'All',
        bank_rrn: null,
        udf1: null,
        udf2: null,
        udf3: null,
        udf4: null,
        udf5: null,
        start_date: null,
        end_date: null
    },
    page_no: 1,
    limit: 50
};

let transactionPaginateData = {
    link_limit: 2,
    from: 2,
    to: 2,
    total: null,
    is_last: null,
    current_item_count: null,
    current_page: null,
    last_page: null,
};

(new DzpTransaction()).getTransactions();
DzpDatePickerServiceForInOut.init();
function DzpTransaction() {

    this.getTransactions = () => {
        DpzHelper.blockUi("#txnDataZone");
        DpzClient.post("/api/payin", transactionPostData)
            .then((response) => {
                transactionPaginateData.total              = response.total_item;
                transactionPaginateData.is_last            = response.is_last;
                transactionPaginateData.current_item_count = response.current_item_count;
                transactionPaginateData.current_page       = response.current_page;
                transactionPaginateData.last_page          = response.last_page;
                this.setHtmlData(response.data);
                this.setTxnSummaryHtml(response.summary);
                DpzHelper.unblockUi("#txnDataZone");
            })
            .catch((error) => {
                this.setEmptyHtml();
                DpzHelper.unblockUi("#txnDataZone");
            });
    }

    this.getTransactionDetail = (pd) => {
        DpzClient.post("/api/payin/detail", pd)
            .then((response) => {
                $("#transactionDetailData").html(atob(response.data));
                DpzHelper.unblockUi("#transactionDetailData")
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                $("#transactionDetail").modal("hide");
                DpzHelper.unblockUi("#transactionDetailData")
            });
    }

    this.actionReconTransaction = (pd) => {
        DpzHelper.blockUi("#transactionReconDataModal")
        DpzClient.post("/api/transaction/recon/action", pd)
            .then((response) => {
                DpzHelper.successSnack(response.message);
                DpzHelper.unblockUi("#transactionReconDataModal");
                $("#transactionReconDataModal").modal("hide");
                (new DzpTransaction()).getTransactions();
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                DpzHelper.unblockUi("#transactionReconDataModal")
            });
    }

    this.viewBankStatus = (pd) => {
        DpzHelper.blockUi("#txnDataZone")
        DpzClient.post("/api/view/payin/status", pd)
            .then((response) => {
                $("#transactionReconData").html(atob(response.data));
                $("#transactionReconDataModal").modal();
                DpzHelper.unblockUi("#txnDataZone")
                $(".actionPayin").on("click", (e) => {
                    const transactionId = e.target.attributes["data-transaction"].value;
                    const transactionAction = e.target.attributes["data-action"].value;
                    const payload = {
                        transaction_id: transactionId,
                        action: transactionAction
                    }
                    this.actionReconTransaction(payload);
                });
            })
            .catch((error) => {
                console.log(error)
                DpzHelper.errorSnack(error.responseJSON.message);
                DpzHelper.unblockUi("#txnDataZone")
            });
    }

    this.refundTransaction = (pd) => {
        DpzHelper.blockUi("#txnDataZone");
        DpzClient.post("/api/payin/refund", pd)
            .then((response) => {
                DpzHelper.unblockUi("#txnDataZone");
                DpzHelper.successSnack(response.message);
                (new DzpTransaction()).getTransactions();
            })
            .catch((error) => {
                DpzHelper.unblockUi("#txnDataZone");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

    this.resendWebhook = (pd) => {
        DpzHelper.blockUi("#txnDataZone");
        DpzClient.post("/api/payin/resend/webhook", pd)
            .then((response) => {
                DpzHelper.unblockUi("#txnDataZone");
                DpzHelper.successSnack(response.message);
                (new DzpTransaction()).getTransactions();
            })
            .catch((error) => {
                DpzHelper.unblockUi("#txnDataZone");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

    this.setHtmlData = (responseData) => {
        let htmlData = "";
        (responseData).forEach((item, index) => {
            htmlData += `<tr>
                            <td>
                                <div class="dropdown">
                                    <i class="mdi mdi-apps cursor-pointer" id="${item.transaction_id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="${item.transaction_id}">
                                        <h6 class="dropdown-header">${item.transaction_id}</h6>
                                        <div class="dropdown-divider"></div>
                                        ${this.getTransactionsActionButton(item.is_webhook_call, item.payment_status, item.transaction_id)}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">TXN#: ${item.transaction_id}</span>
                                <span class="d-block font-weight-bold mb-1">ORD#: ${item.merchant_order_id}</span>
                                <span class="d-block font-weight-bold mb-1">UTR#: ${item.bank_rrn ? item.bank_rrn : '-'}</span>
                                <span class="d-block mb-1 font-weight-bold ">DATE: ${item.transaction_date_ind}</span>
                                <span class="d-block mb-1 font-weight-bold ">PG: ${item.pg_name ?item.pg_name :'-'}</span>
                            </td>
                             <td>
                                <span class="d-block font-weight-bold mb-1">Cust#: ${item.customer_id}</span>
                                <span class="d-block font-weight-bold mb-1">Email: ${item.customer_email ? item.customer_email : "-"}</span>
                                <span class="d-block font-weight-bold mb-1">Phone: ${item.customer_mobile ? item.customer_mobile : "-"}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold ">${DpzHelper.getTransactionStatus(item.payment_status)}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">Payment: ₹${item.payment_amount}</span>
                                <span class="d-block font-weight-bold mb-1">PG Fees: -₹${item.pg_fees}</span>
                                <span class="d-block font-weight-bold mb-1">Assoc Fees: .-₹${item.associate_fees}</span>
                                <span class="d-block font-weight-bold mb-1">Settled: .-₹${item.payable_amount}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.payment_method ? item.payment_method : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.pg_res_msg ? item.pg_res_msg : '-'}</span>
                            </td>
                        </tr>`;
        });
        $("#transactionData").html(htmlData);
        setPaginateButton("transaction-logs-page-change-event", transactionPaginateData, transactionPostData);
        $(".txn-details").on("click", (e) => {
            const pd = {
                transaction_id: e.target.attributes["data-transaction"].value
            };
            $("#transactionDetailData").html(blankTransactionDetailModal);
            $("#transactionDetail").modal();
            DpzHelper.blockUi("#transactionDetailData");
            this.getTransactionDetail(pd)
        })
        $(".refundTransaction").on("click", (e) => {
            const pd = {
                transaction_id: e.target.attributes["data-transaction"].value
            };
            this.refundTransaction(pd)
        })
        $(".resendWebhook").on("click", (e) => {
            const pd = {
                transaction_id: e.target.attributes["data-transaction"].value
            };
            this.resendWebhook(pd)
        })
        $(".viewBankStatus").on("click", (e) => {
            const pd = {
                transaction_id: e.target.attributes["data-transaction"].value
            };
            this.viewBankStatus(pd)
        })
    }

    this.setEmptyHtml = () => {
        const htmlData = `<td colspan="11">
                                <div class="text-center pt-5 pb-5">
                                    <img src="/custom/img/404.svg" class="record-not-found">
                                    <div class="mt-2">
                                        <span>Record does not exist.</span>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
        $("#transactionData").html(htmlData);
        $("#pagination").html("");
    }

    this.setTxnSummaryHtml = (data) => {
        if(data) {
            $.each(data, (index, item) => {
                $("#__"+index).text(parseFloat(item).toFixed(2));
            })
        }
    }

    this.getTransactionsActionButton = (is_webhook_call, payment_status, transaction_id) => {
        let button = "";
        if(
            is_webhook_call > 0 &&
            (
                payment_status === "Success" ||
                payment_status === "Failed" ||
                payment_status === "Full Refund" ||
                payment_status === "Partial Refund"
            )
        ) {
            button += `<button class="dropdown-item resendWebhook" data-transaction="${transaction_id}">Resend Webhook</button>`;
        }
        if(
            payment_status === "Failed" ||
            payment_status === "Pending"
        ) {
            button += `<button class="dropdown-item viewBankStatus" data-transaction="${transaction_id}">View Bank Status</button>`;
        }
        if(button.length < 1) {
            button = "<p>There is no action allowed</p>";
        }
        return button;
    }

}

EventListener.dispatch.on("transaction-logs-page-change-event", (event, callback) => {
    transactionPostData.page_no = callback.page_number;
    (new DzpTransaction()).getTransactions()
});

$("#txnFilterForm").submit(() => {
    transactionPostData.filter_data = {
        transaction_id: null,
        order_id: null,
        customer_email: null,
        customer_id: null,
        customer_mobile: null,
        payment_amount: null,
        status: null,
        bank_rrn: null,
        udf1: null,
        udf2: null,
        udf3: null,
        udf4: null,
        udf5: null,
        start_date: null,
        end_date: null
    };
    transactionPostData.page_no = 1;
    transactionPostData.limit = 50;
    const txnFilterFormData = DpzHelper.serializeObject($("#txnFilterForm"));
    transactionPostData.filter_data[txnFilterFormData.txtFilterKey] = txnFilterFormData.txtFilterValue;
    transactionPostData.filter_data.status = txnFilterFormData.txtStatus;
    transactionPostData.limit = txnFilterFormData.txtLimit;


    if(txnFilterFormData.txnDatePicker.length > 0) {
        let splitDate  = txnFilterFormData.txnDatePicker.split(/-/);
        transactionPostData.filter_data.start_date = moment(splitDate[0], 'DD/MM/YYYY').format('YYYY-MM-DD 00:00:00');
        transactionPostData.filter_data.end_date = moment(splitDate[1], 'DD/MM/YYYY').format('YYYY-MM-DD 23:59:59');
    }


    (new DzpTransaction()).getTransactions()
});

function clearFilter() {
    transactionPostData = {
        filter_data: {
            transaction_id: null,
            order_id: null,
            customer_email: null,
            customer_id: null,
            customer_mobile: null,
            payment_amount: null,
            status: null,
            bank_rrn: null,
            udf1: null,
            udf2: null,
            udf3: null,
            udf4: null,
            udf5: null,
            start_date: null,
            end_date: null
        },
        page_no: 1,
        limit: 50
    };
    $("#txnFilterForm")[0].reset();
    DzpDatePickerService.init();
    (new DzpTransaction()).getTransactions()
}

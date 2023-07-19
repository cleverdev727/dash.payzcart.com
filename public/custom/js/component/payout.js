let payoutPostData = {
    filter_data: {
        payout_id: null,
        ref_id: null,
        customer_email: null,
        mobile_no: null,
        payout_amount: null,
        status: null,
        account_no: null,
        ifsc_code: null,
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

let payoutPaginateData = {
    link_limit: 2,
    from: 2,
    to: 2,
    total: null,
    is_last: null,
    current_item_count: null,
    current_page: null,
    last_page: null,
};

(new DzpPayout()).getPayouts();
DzpDatePickerServiceForInOut.init();
function DzpPayout() {

    this.getPayouts = () => {
        DpzHelper.blockUi("#payoutDataZone");
        DpzClient.post("/api/payout", payoutPostData)
            .then((response) => {
                payoutPaginateData.total              = response.total_item;
                payoutPaginateData.is_last            = response.is_last;
                payoutPaginateData.current_item_count = response.current_item_count;
                payoutPaginateData.current_page       = response.current_page;
                payoutPaginateData.last_page          = response.last_page;
                this.setHtmlData(response.data);
                this.setPayoutSummaryHtml(response.summary);
                DpzHelper.unblockUi("#payoutDataZone");
            })
            .catch((error) => {
                this.setEmptyHtml();
                DpzHelper.unblockUi("#payoutDataZone");
            });
    }

    this.getPayoutDetails = (pd) => {
        DpzClient.post("/api/payout/detail", pd)
            .then((response) => {
                $("#payoutDetails").html(atob(response.data));
                DpzHelper.unblockUi("#payoutDetails")
            })
            .catch((error) => {
                DpzHelper.errorSnack(error.responseJSON.message);
                $("#payoutDetailsModal").modal("hide");
                DpzHelper.unblockUi("#payoutDetails")
            });
    }

    this.resendWebhook = (pd) => {
        DpzHelper.blockUi("#payoutDataZone");
        DpzClient.post("/api/payout/resend/webhook", pd)
            .then((response) => {
                DpzHelper.unblockUi("#payoutDataZone");
                DpzHelper.successSnack(response.message);
                (new DzpPayout()).getPayouts();
            })
            .catch((error) => {
                DpzHelper.unblockUi("#payoutDataZone");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

    this.approvedPayoutRequest = (pd) => {
        const jc = $.confirm({
            icon: 'fa fa-question-circle-o',
            theme: 'supervan',
            title: "Payout Approve",
            content: "Are you sure approve payout request?",
            animation: 'scale',
            type: 'orange',
            buttons: {
                Yes: {
                    text: 'Yes',
                    action: function (Yes) {
                        jc.showLoading();
                        DpzClient.post("/api/payout/request/approve", pd)
                            .then((response) => {
                                jc.hideLoading();
                                DpzHelper.successSnack(response.message);
                                (new DzpPayout()).getPayouts();
                                jc.close();
                            })
                            .catch((error) => {
                                jc.hideLoading();
                                jc.close();
                                if(error.responseJSON.data) {
                                    if(error.responseJSON.data.is_gauth_enable) {
                                        DpzGAuthService.init((otp, blockElement, modalElement) => {
                                            DpzHelper.blockUi(blockElement);
                                            pd.g_auth_otp = otp;
                                            DpzClient.post("/api/payout/request/approve", pd)
                                                .then(res => {
                                                    DpzHelper.successSnack(res.message);
                                                    DpzHelper.unblockUi(blockElement);
                                                    $(modalElement).modal("hide");
                                                })
                                                .catch(err => {
                                                    DpzHelper.unblockUi(blockElement);
                                                    DpzHelper.errorSnack(err.responseJSON.message);
                                                })
                                        })
                                    } else {
                                        DpzHelper.errorSnack(error.responseJSON.message);
                                    }
                                } else {
                                    DpzHelper.errorSnack(error.responseJSON.message);
                                }
                            });
                    }
                },
                No: {
                    text: 'No',
                    action: function (No) {

                    }
                },
            }
        });
    }

    this.cancelPayoutRequest = (pd) => {

        const jc = $.confirm({
            icon: 'fa fa-question-circle-o',
            theme: 'supervan',
            title: "Payout Cancel",
            content: "Are you sure cancel payout request?",
            animation: 'scale',
            type: 'orange',
            buttons: {
                Yes: {
                    text: 'Yes',
                    action: function (Yes) {
                        jc.showLoading();
                        DpzClient.post("/api/payout/request/cancel", pd)
                            .then((response) => {
                                jc.hideLoading();
                                DpzHelper.successSnack(response.message);
                                (new DzpPayout()).getPayouts();
                                jc.close();
                            })
                            .catch((error) => {
                                jc.hideLoading();
                                DpzHelper.errorSnack(error.responseJSON.message);
                                jc.close();
                            });
                    }
                },
                No: {
                    text: 'No',
                    action: function (No) {

                    }
                },
            }
        });

    }

    this.createSinglePayoutRequest = (pd) => {
        DpzHelper.blockUi("#singlePayoutForm");
        DpzClient.post("/api/payout/single/request", pd)
            .then((response) => {
                DpzHelper.unblockUi("#singlePayoutForm");
                DpzHelper.successSnack(response.message);
                (new DzpPayout()).getPayouts();
                $("#singlePayoutModal").modal("hide");
            })
            .catch((error) => {
                DpzHelper.unblockUi("#singlePayoutForm");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

    this.setHtmlData = (responseData) => {
        let htmlData = "";
        (responseData).forEach((item, index) => {
            htmlData += `<tr>
                            <td>
                                <div class="dropdown">
                                    <i class="mdi mdi-apps cursor-pointer" id="${item.payout_date_ind}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                                    <div class="dropdown-menu" aria-labelledby="${item.payout_id}">
                                        <h6 class="dropdown-header">${item.payout_id}</h6>
                                        <div class="dropdown-divider"></div>
                                        ${this.getPayoutActionButton(item.is_webhook_called, item.payout_status, item.payout_id, item.is_approved)}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1" data-payout="${item.payout_id}"> Payout#: ${item.payout_id}</span>
                                <span class="font-weight-bold d-block mb-1" data-payout="${item.ref_id}">Order#: ${item.ref_id}</span>
                                <span class="d-block font-weight-bold mb-1">UTR: ${item.bank_rrn ? item.bank_rrn : '-'}</span>
                                <span class="d-block font-weight-bold mb-1"> Date: ${item.payout_date_ind} </span>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1"> Name: ${item.account_holder_name}</span>
                                <span class="font-weight-bold d-block mb-1"> A/C: ${item.bank_account ? item.bank_account : '-'}</span>
                                <span class="font-weight-bold d-block mb-1"> IFSC: ${item.ifsc_code ? item.ifsc_code : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block">${DpzHelper.getTransactionStatus(item.payout_status)}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">Payout: ₹${item.payout_amount}</span>
                                <span class="d-block font-weight-bold mb-1">Assoc. Fees: ₹ ${item.associate_fees ? item.associate_fees : 0}</span>
                                <span class="d-block font-weight-bold mb-1">PG Fees: ₹ ${item.payout_fees}</span>
                                <span class="d-block font-weight-bold mb-1">Total: ₹ ${item.total_amount ? item.total_amount : 0}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.payout_type ? item.payout_type : '-'}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.pg_response_msg ? item.pg_response_msg : '-'}</span>
                            </td>
                        </tr>`;
        });
        $("#payoutData").html(htmlData);
        setPaginateButton("payout-logs-page-change-event", payoutPaginateData, payoutPostData);
        $(".txn-details").on("click", (e) => {
            const pd = {
                payout_id: e.target.attributes["data-payout"].value
            };
            $("#payoutDetails").html(blankPayoutDetail);
            $("#payoutDetailsModal").modal();
            DpzHelper.blockUi("#payoutDetails");
            this.getPayoutDetails(pd)
        })
        $(".resendWebhook").on("click", (e) => {
            const pd = {
                payout_id: e.target.attributes["data-payout"].value
            };
            this.resendWebhook(pd)
        })
        $(".cancelPayout").on("click", (e) => {
            const pd = {
                payout_id: e.target.attributes["data-payout"].value
            };
            this.cancelPayoutRequest(pd)
        })
        $(".approvePayout").on("click", (e) => {
            const pd = {
                payout_id: e.target.attributes["data-payout"].value
            };
            this.approvedPayoutRequest(pd)
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
        $("#payoutData").html(htmlData);
        $("#pagination").html("");
    }



    this.setPayoutSummaryHtml = (data) => {
        if(data) {
            $.each(data, (index, item) => {
                $("#__"+index).text(parseFloat(item).toFixed(2));
            })
        }
    }
    this.getPayoutActionButton = (is_webhook_call, payout_status, payout_id, is_approved) => {
        let button = "";
        if(
            is_webhook_call > 0 &&
            (
                payout_status === "Success" ||
                payout_status === "Failed"
            )
        ) {
            button += `<button class="dropdown-item resendWebhook" data-payout="${payout_id}">Resend Webhook</button>`;
        }

        if(payout_status === "Initialized" && !is_approved) {
            button += `<button class="dropdown-item approvePayout mr-1" data-payout="${payout_id}">Approve Payout</button>`;
            button += `<button class="dropdown-item cancelPayout" id="payout_cancel_${payout_id}" data-payout="${payout_id}">Cancel Payout</button>`;
        }
        if(button.length < 1) {
            button = "<p>There is no action allowed</p>";
        }
        return button;
    }

}


EventListener.dispatch.on("payout-logs-page-change-event", (event, callback) => {
    payoutPostData.page_no = callback.page_number;
    (new DzpPayout()).getPayouts()
});

$("#txnFilterForm").submit(() => {
    payoutPostData.filter_data = {
        payout_id: null,
        ref_id: null,
        customer_email: null,
        mobile_no: null,
        payout_amount: null,
        status: null,
        account_no: null,
        ifsc_code: null,
        bank_rrn: null,
        udf1: null,
        udf2: null,
        udf3: null,
        udf4: null,
        udf5: null,
        start_date: null,
        end_date: null
    };
    payoutPostData.page_no = 1;
    payoutPostData.limit = 10;
    const txnFilterFormData = DpzHelper.serializeObject($("#txnFilterForm"));
    payoutPostData.filter_data[txnFilterFormData.txtFilterKey] = txnFilterFormData.txtFilterValue;
    payoutPostData.filter_data.status = txnFilterFormData.txtStatus;

    payoutPostData.limit = txnFilterFormData.txtLimit;

    if(txnFilterFormData.txnDatePicker) {
        let splitDate  = txnFilterFormData.txnDatePicker.split(/-/);
        payoutPostData.filter_data.start_date = moment(splitDate[0], 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        payoutPostData.filter_data.end_date = moment(splitDate[1], 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
    }

    (new DzpPayout()).getPayouts()
});

function clearFilter() {
    payoutPostData = {
        filter_data: {
            payout_id: null,
            ref_id: null,
            customer_email: null,
            mobile_no: null,
            payout_amount: null,
            status: null,
            account_no: null,
            ifsc_code: null,
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
    DzpDatePickerService.init();
    (new DzpPayout()).getPayouts()
}

$(".s-payout-input").on("change", (e) => {
    $(".payout-type-box").removeClass("active");
    $(e.target.offsetParent).addClass("active");
    const payoutType = e.target.value;
    const vpaAreaElement = $("#vpaDetail");
    const bankAreaElement = $("#bankAccountDetail");
    if(payoutType === "UPI") {
        $("#accountNumber").val("");
        $("#ifscCode").val("");
        vpaAreaElement.show();
        bankAreaElement.hide();
    } else if(payoutType === "PAYTM"){
        $("#accountNumber").val("");
        $("#ifscCode").val("");
        $("#vpa").val("");
        vpaAreaElement.hide();
        bankAreaElement.hide();
    } else {
        $("#vpa").val("");
        vpaAreaElement.hide();
        bankAreaElement.show();
    }
});

$("#singlePayoutModal").on("hidden.bs.modal", () => {
    $("#singlePayoutForm")[0].reset();
    $(".s-payout-input[value=IMPS]").prop("checked", true);
    $(".payout-type-box").removeClass("active");
    $(".payout-type-box:first-child").addClass("active");
    $("#vpa").val("");
    $("#vpaDetail").hide();
    $("#bankAccountDetail").show();
});

$("#singlePayoutForm").submit(() => {
    const singlePayoutFOrmData = DpzHelper.serializeObject($("#singlePayoutForm"));
    const payload = {
        payout_type: singlePayoutFOrmData.payout_type,
        payout_amount: singlePayoutFOrmData.payout_amount,
        payout_ref_id: singlePayoutFOrmData.payout_ref_id,
        customer_name: singlePayoutFOrmData.customer_name,
        account_number: singlePayoutFOrmData.account_number,
        ifsc_code: singlePayoutFOrmData.ifsc_code
    };
    (new DzpPayout()).createSinglePayoutRequest(payload);
});

let statementPostData = {
    filter_data: {
        start_date: null,
        end_date: null
    },
    page_no: 1,
    limit: 10
};

let statementPaginateData = {
    link_limit: 2,
    from: 2,
    to: 2,
    total: null,
    is_last: null,
    current_item_count: null,
    current_page: null,
    last_page: null,
};

(new DzpStatement()).getStatement();
DzpDatePickerService.init();
function DzpStatement() {

    this.getStatement = () => {
        DpzHelper.blockUi("#statementDataZone");
        DpzClient.post("/api/statement", statementPostData)
            .then((response) => {
                statementPaginateData.total              = response.total_item;
                statementPaginateData.is_last            = response.is_last;
                statementPaginateData.current_item_count = response.current_item_count;
                statementPaginateData.current_page       = response.current_page;
                statementPaginateData.last_page          = response.last_page;
                this.setHtmlData(response.data);
                DpzHelper.unblockUi("#statementDataZone");
            })
            .catch((error) => {
                console.log(error)
                this.setEmptyHtml();
                DpzHelper.unblockUi("#statementDataZone");
            });
    }

    this.setHtmlData = (responseData) => {
        let htmlData = "";
        (responseData).forEach((item, index) => {
            htmlData += `<tr>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.pay_date}</span>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1">₹${item.payin}</span>
                            </td>
                            <td>
                                <span class="font-weight-bold d-block mb-1">₹${item.payout}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">₹${item.refund}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">₹${item.un_settled}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">₹${item.open_balance}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">₹${item.closing_balance}</span>
                            </td>
                            <td>
                                <span class="d-block font-weight-bold mb-1">${item.update_date_ind ? item.update_date_ind : '-'}</span>
                            </td>
                        </tr>`;
        });
        $("#statementData").html(htmlData);
        setPaginateButton("statement-logs-page-change-event", statementPaginateData, statementPostData);
    }

    this.setEmptyHtml = () => {
        const htmlData = `<td colspan="8">
                                <div class="text-center pt-5 pb-5">
                                    <img src="/custom/img/404.svg" class="record-not-found">
                                    <div class="mt-2">
                                        <span>Record does not exist.</span>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
        $("#statementData").html(htmlData);
        $("#pagination").html("");
    }


}

EventListener.dispatch.on("statement-logs-page-change-event", (event, callback) => {
    statementPostData.page_no = callback.page_number;
    (new DzpStatement()).getStatement();
});

$("#txnFilterForm").submit(() => {
    statementPostData = {
        filter_data: {
            start_date: null,
            end_date: null
        },
        page_no: 1,
        limit: 10
    };
    const txnFilterFormData = DpzHelper.serializeObject($("#txnFilterForm"));
    statementPostData.limit = txnFilterFormData.txtLimit;

    if(txnFilterFormData.txnDatePicker) {
        let splitDate  = txnFilterFormData.txnDatePicker.split(/-/);
        statementPostData.filter_data.start_date = moment(splitDate[0], 'DD/MM/YYYY').format('YYYY-MM-DD');
        statementPostData.filter_data.end_date = moment(splitDate[1], 'DD/MM/YYYY').format('YYYY-MM-DD');
    }
    (new DzpStatement()).getStatement();
});

function clearFilter() {
    statementPostData = {
        filter_data: {
            start_date: null,
            end_date: null
        },
        page_no: 1,
        limit: 10
    };
    DzpDatePickerService.init();
    (new DzpStatement()).getStatement();
}


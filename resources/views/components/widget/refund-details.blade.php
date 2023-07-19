<div class="modal-header">
    <h5 class="modal-title">{{$data->refund_id}}
        <span class="d-block text-muted font-weight-bold"><small>{{$data->refund_date_ind}}</small></span>
    </h5>
    <button type="button" class="close" data-dismiss="modal">
        <span class="svg-icon svg-icon-muted svg-icon-2hx">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#5e5da9">
                <rect opacity="0.2" x="2" y="2" width="20" height="20" rx="10" fill="#5e5da9"/>
                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="#5e5da9"/>
                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="#5e5da9"/>
            </svg>
        </span>
    </button>
</div>
<div class="modal-body" id="transactionDetailData">
    <div>
        <div class="d-flex justify-content-between align-items-baseline mb-2 border-bottom py-3">
            <h6 class="card-title mb-0">
                Refund Details
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tr>
                    <td class="font-weight-bold border-0">Refund ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->refund_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Transaction ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->transaction_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Status</td>
                    <td class="border-0">:</td>
                    <td class="border-0">
                        <span class="d-block mb-1">
                            @if(strcmp($data->refund_status, "Failed") === 0)
                                <span class="badge badge-danger">{{$data->refund_status ?? "-"}}</span>
                            @elseif(strcmp($data->refund_status, "Success") === 0)
                                <span class="badge badge-success">{{$data->refund_status ?? "-"}}</span>
                            @elseif(strcmp($data->refund_status, "Processing") === 0)
                                <span class="badge badge-warning">{{$data->refund_status ?? "-"}}</span>
                            @elseif(strcmp($data->refund_status, "Pending") === 0)
                                <span class="badge badge-outlineprimary">{{$data->refund_status ?? "-"}}</span>
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Amount</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->refund_amount ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Type</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->refund_type ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">UTR</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->bank_rrn ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Reason</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->refund_reason ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Expected Credit Date</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->user_credit_expected_date ?? "-"}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

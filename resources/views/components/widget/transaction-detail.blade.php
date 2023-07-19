
<div class="modal-header">
    <h5 class="modal-title">{{$data->transaction_id}}
        <span class="d-block text-muted font-weight-bold"><small>{{$data->transaction_date_ind ?? '-'}} (IST)</small></span>
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
<div class="modal-body">
    <div>
        <div class="d-flex justify-content-between align-items-baseline mb-2 border-bottom py-3">
            <h6 class="card-title mb-0">
                Transaction Details
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tr>
                    <td class="font-weight-bold border-0">Transaction ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->transaction_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Order ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->merchant_order_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Status</td>
                    <td class="border-0">:</td>
                    <td class="border-0">
                        <span class="d-block mb-1">
                            @if(strcmp($data->payment_status, "Failed") === 0)
                                <span class="badge badge-danger">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Success") === 0)
                                <span class="badge badge-success">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Processing") === 0)
                                <span class="badge badge-warning">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Pending") === 0)
                                <span class="badge badge-outlineprimary">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Initialized") === 0)
                                <span class="badge badge-primary">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Full Refund") === 0)
                                <span class="badge badge-info">{{$data->payment_status ?? "-"}}</span>
                            @elseif(strcmp($data->payment_status, "Partial Refund") === 0)
                                <span class="badge badge-info">{{$data->payment_status ?? "-"}}</span>
                            @endif
                        </span>
                        @if(strcmp($data->payment_status, "Failed") === 0)
                            <span class="d-block">{{$data->pg_res_msg ?? "-"}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Amount</td>
                    <td class="border-0">:</td>
                    <td class="border-0">
                        <span class="d-block">&#8377;{{$data->payment_amount ?? "-"}}</span>
                        <span class="d-block">Fees: &#8377;{{$data->pg_fees ?? "-"}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Method</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->payment_method ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">UTR</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->bank_rrn ?? "-"}}</td>
                </tr>
                @if($refundAmount > 0)
                    <tr>
                        <td class="font-weight-bold border-0">Refund Amount</td>
                        <td class="border-0">:</td>
                        <td class="border-0">&#8377;{{$refundAmount}}
                            {{--                    <button class="btn btn-link">View Refund Details</button>--}}
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-baseline mt-3 border-bottom py-3">
        <h6 class="card-title mb-0">Customer Details</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <tr>
                <td class="font-weight-bold border-0">Customer Name</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->customer_name ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">Customer Email</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->customer_email ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">Customer Mobile</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->customer_mobile ?? "-"}}</td>
            </tr>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-baseline mt-3 border-bottom py-3">
        <h6 class="card-title mb-0">Other Details</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <tr>
                <td class="font-weight-bold border-0">UDF1</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->udf1 ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">UDF2</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->udf2 ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">UDF3</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->udf3 ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">UDF4</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->udf4 ?? "-"}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold border-0">UDF5</td>
                <td class="border-0">:</td>
                <td class="border-0">{{$data->udf5 ?? "-"}}</td>
            </tr>
        </table>

    </div>
</div>


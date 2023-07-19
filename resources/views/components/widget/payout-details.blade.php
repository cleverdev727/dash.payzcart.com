<div class="modal-header">
    <h5 class="modal-title">{{$data->payout_id}}
        <span class="d-block text-muted font-weight-bold"><small>{{$data->payout_date_ind}}</small></span>
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
                Payout Details
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tr>
                    <td class="font-weight-bold border-0">Payout ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->payout_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Ref. ID</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->ref_id ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Status</td>
                    <td class="border-0">:</td>
                    <td class="border-0">
                        <span class="d-block mb-1">
                            @if(strcmp($data->payout_status, "Failed") === 0)
                                <span class="badge badge-danger">{{$data->payout_status ?? "-"}}</span>
                            @elseif(strcmp($data->payout_status, "Success") === 0)
                                <span class="badge badge-success">{{$data->payout_status ?? "-"}}</span>
                            @elseif(strcmp($data->payout_status, "Processing") === 0)
                                <span class="badge badge-warning">{{$data->payout_status ?? "-"}}</span>
                            @elseif(strcmp($data->payout_status, "Pending") === 0)
                                <span class="badge badge-outlineprimary">{{$data->payout_status ?? "-"}}</span>
                            @elseif(strcmp($data->payout_status, "Initialized") === 0)
                                <span class="badge badge-primary">{{$data->payout_status ?? "-"}}</span>
                            @endif
                        </span>
                        @if(strcmp($data->payout_status, "Failed") === 0)
                            <span class="d-block">{{$data->pg_response_msg ?? "-"}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Amount</td>
                    <td class="border-0">:</td>
                    <td class="border-0">
                        <span class="d-block">&#8377;{{$data->payout_amount ?? "-"}}</span>
                        <span class="d-block">Fees: &#8377;{{$data->payout_fees ?? "-"}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Payout Type</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->payout_type ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">Approved at</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->payout_approved_date_ind ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold border-0">UTR</td>
                    <td class="border-0">:</td>
                    <td class="border-0">{{$data->bank_rrn ?? "-"}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-baseline mt-3 border-bottom py-3">
        <h6 class="card-title mb-0">Customer Details</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <tr>
                <td class="font-weight-bold border-0">Account</td>
                <td class="border-0">:</td>
                <td class="border-0">
                    @if(isset($data->bank_name) && !empty($data->bank_name))
                        <span class="d-block"><strong>Bank:</strong>{{$data->bank_name ?? "-"}}</span>
                    @endif
                    @if(isset($data->bank_account) && !empty($data->bank_account))
                            <span class="d-block"><strong>A/C:</strong>{{$data->bank_account ?? "-"}}</span>
                    @endif
                    @if(isset($data->ifsc_code) && !empty($data->ifsc_code))
                            <span class="d-block"><strong>IFSC:</strong>{{$data->ifsc_code ?? "-"}}</span>
                    @endif
                    @if(isset($data->vpa_address) && !empty($data->vpa_address))
                            <span class="d-block"><strong>UPI:</strong>{{$data->vpa_address ?? "-"}}</span>
                    @endif
                </td>
            </tr>
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

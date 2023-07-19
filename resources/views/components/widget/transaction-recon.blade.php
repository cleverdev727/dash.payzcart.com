<div class="modal-header">
    <h5 class="modal-title">
        Bank Payment Status
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
    <div class="table-responsive">
        <h5 class="mb-2">PayzCart</h5>
        <table class="table table-hover mb-3 table-bordered">
            <tbody>
            <tr>
                <th class="text-uppercase">Transaction id</th>
                <td>{{$data->transaction_details->transaction_id ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">status</th>
                <td>{{$data->transaction_details->payment_status ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">Payout Amount</th>
                <td>{{$data->transaction_details->payment_amount ?? ""}}</td>
            </tr>
            </tbody>
        </table>

        <h5 class="mb-2">Bank</h5>
        <table class="table table-hover mb-0 table-bordered">
            <tbody>
            <tr>
                <th class="text-uppercase">payment Status</th>
                <td>{{$data->pg_status_res->paymentStatus ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">pg Ref Number</th>
                <td>{{$data->pg_status_res->pgRefNumber ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">bank RRN</th>
                <td>{{$data->pg_status_res->bankRRN ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">amount</th>
                <td>{{$data->pg_status_res->amount ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">transaction Id</th>
                <td>{{$data->pg_status_res->transactionId ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">payment Date</th>
                <td>{{$data->pg_status_res->paymentDate ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">pgRes Code</th>
                <td>{{$data->pg_status_res->pgResCode ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">pg Res Message</th>
                <td>{{$data->pg_status_res->pgResMessage ?? ""}}</td>
            </tr>
            <tr>
                <th class="text-uppercase">paymentMethod</th>
                <td>{{$data->pg_status_res->paymentMethod ?? ""}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@if($data->is_mismatch)
<div class="modal-footer">
    <button class="btn btn-sm btn-primary actionPayin" data-action="accept" data-transaction="{{$data->transaction_details->transaction_id ?? ""}}">Accept</button>
    <button class="btn btn-sm btn-danger actionPayin" data-action="refund" data-transaction="{{$data->transaction_details->transaction_id ?? ""}}">Refund</button>
</div>
@endif


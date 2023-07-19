@extends('layout.master')

@section('title', 'Payouts')

@section('customStyle')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Payouts</h6>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->isDashboardPayoutEnable)
                        <button class="btn btn-primary" data-toggle="modal" data-target="#singlePayoutModal" data-backdrop="static">Single Payout</button>
                    @endif
                @endif
            </div>

            <div class="mb-4">
                <form action="javascript:void(0)" id="txnFilterForm">
                    <div class="row mt-4">
                        <div class="col-auto">
                            <div class="form-group">
                                <div class="d-flex ">
                                    <select name="txtFilterKey" id="txtFilterData" class="form-control border-right-0 bg-primary text-white">
                                        <option value="payout_id">Payout Id</option>
                                        <option value="ref_id">Reference Id</option>
                                        <option value="bank_rrn">Bank RRN</option>
                                        <option value="account_no">Account Number</option>
                                        <option value="ifsc_code">IFSC</option>
                                        <option value="customer_email">Customer Email</option>
                                        <option value="mobile_no">Customer Mobile</option>
                                        <option value="payout_amount">Amount</option>
                                        <option value="udf1">UDF 1</option>
                                        <option value="udf2">UDF 2</option>
                                        <option value="udf3">UDF 3</option>
                                        <option value="udf4">UDF 4</option>
                                        <option value="udf5">UDF 5</option>
                                    </select>
                                    <input type="text" name="txtFilterValue" class="form-control" placeholder="Enter Search Value" autocomplete="off">
                                </div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <select name="txtStatus" id="txtStatus" class="form-control">
                                    <option value="All">All</option>
                                    <option value="Success">Success</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txnDatePicker" name="txnDatePicker" data-dzp-picker="custom" placeholder="Select Date" autocomplete="off">
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <select name="txtLimit" id="txtLimit" class="form-control">
                                    <option value="50" selected>50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <label class="control-label"></label>
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <button class="btn btn-default" type="reset" onclick="clearFilter()">Clear</button>
                        </div><!-- Col -->
                    </div>

                </form>
            </div>

            <div class="pt-3 mb-5">

            <div class="row flex-grow mt-3" id="countData">
                <div class="col-md-3 grid-margin stretch-card" style="box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">
                                    Total Payout
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h6 class="mb-2 dz-responsive-text" id="__total_payout">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">
                                    PAYOUT AMOUNT
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h6 class="mb-2 dz-responsive-text">₹ <span id="__payout_amount">0</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">
                                    Total Payout Amount
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h6 class="mb-2 dz-responsive-text">₹ <span id="__total_payout_amount">0</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">
                                    Total Payout Fees
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h6 class="mb-2 dz-responsive-text">₹ <span id="__total_payout_fees">0</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="table-responsive" id="payoutDataZone">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th class="pt-0 pl-0"></th>
                        <th class="pt-0 pl-0">Payout#</th>
                        <th class="pt-0 pl-0">Customer</th>
                        <th class="pt-0 pl-0">Status</th>
                        <th class="pt-0 pl-0">Amount</th>
                        <th class="pt-0 pl-0">Type</th>
                        <th class="pt-0 pl-0">Bank Response</th>
                    </tr>
                    </thead>
                    <tbody id="payoutData">
                    </tbody>
                </table>
                <div id="pagination">

                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" role="dialog"  id="payoutDetailsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="payoutDetails">

            </div>
        </div>
    </div>

    @include("components.widget.single-payout-widget")

@endsection

@section('customJs')
    <script src="{{URL::asset('custom/js/component/widget.js')}}"></script>
    <script src="{{URL::asset('custom/js/component/payout.js?v=3')}}"></script>
@endsection

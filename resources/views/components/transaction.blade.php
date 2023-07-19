@extends('layout.master')

@section('title', 'Transactions')

@section('customStyle')
    <link rel="stylesheet" href="{{URL::asset('custom/plugin/footable/css/footable.bootstrap.css')}}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Payin</h6>
            </div>

            <div class="mb-4">
                <form action="javascript:void(0)" id="txnFilterForm">
                    <div class="row mt-4">
                        <div class="col-auto">
                            <div class="form-group">
                                <div class="d-flex ">
                                    <select name="txtFilterKey" id="txtFilterData" class="form-control border-right-0 bg-primary text-white">
                                        <option value="transaction_id">Transaction Id</option>
                                        <option value="order_id">Order Id</option>
                                        <option value="bank_rrn">Bank RRN</option>
                                        <option value="customer_email">Customer Email</option>
                                        <option value="customer_id">Customer Id</option>
                                        <option value="mobile_no">Customer Mobile</option>
                                        <option value="payment_amount">Amount</option>
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
                                    <option value="All" selected>All</option>
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
                            <button class="btn btn-default" type="button" onclick="clearFilter()">Clear</button>
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
                                        Total Transaction
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12">
                                        <h6 class="mb-2 dz-responsive-text" id="__total_txn">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card"  style="box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h6 class="card-title mb-0">
                                        Total Payment Amount
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12">
                                        <h6 class="mb-2 dz-responsive-text">₹ <span id="__total_payment_amount">0</span></h6>
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
                                        Total Payable Amount
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12">
                                        <h6 class="mb-2 dz-responsive-text">₹ <span id="__total_payable_amount">0</span></h6>
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
                                        Total Fees
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12">
                                        <h6 class="mb-2 dz-responsive-text">₹ <span id="__total_pg_fees">0</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="txnDataZone">
                <table class="table table-hover mb-0" data-show-toggle="false">
                    <thead>
                    <tr>
                        <th class="pt-0 pl-0">@</th>
                        <th class="pt-0 pl-0">Transactions</th>
                        <th class="pt-0 pl-0">Customer</th>
                        <th class="pt-0 pl-0">Status</th>
                        <th class="pt-0 pl-0">Amount</th>
                        <th class="pt-0 pl-0">Method</th>
                        <th class="pt-0 pl-0">Bank Response</th>
                    </tr>
                    </thead>
                    <tbody id="transactionData">

                    </tbody>
                </table>
                <div id="pagination">

                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" role="dialog"  id="transactionDetail">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="transactionDetailData">
                <div class="modal-header"></div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog"  id="transactionReconDataModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="transactionReconData">

            </div>
        </div>
    </div>

@endsection

@section('customJs')
    <script src="{{URL::asset('custom/js/component/widget.js')}}"></script>
     <script src="{{URL::asset('custom/js/component/transaction.js?v=6')}}"></script>
 @endsection

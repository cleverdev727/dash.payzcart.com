@extends('layout.master')

@section('title', 'Refunds')

@section('customStyle')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Refunds</h6>
            </div>

            <div class="mb-4">
                <form action="javascript:void(0)" id="txnFilterForm">
                    <div class="row mt-4">
                        <div class="col-auto">
                            <div class="form-group">
                                <div class="d-flex ">
                                    <select name="txtFilterKey" id="txtFilterData" class="form-control border-right-0 bg-primary text-white">
                                        <option value="refund_id">Refund Id</option>
                                        <option value="transaction_id">Transaction Id</option>
                                        <option value="refund_amount">Amount</option>
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
                                    <option value="Processing">Processing</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txnDatePicker" name="txnDatePicker" data-dzp-picker="custom" placeholder="Select Date" autocomplete="off">
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <select name="txtLimit" id="txtLimit" class="form-control">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
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

            <div class="table-responsive" id="refundDataZone">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th class="pt-0 pl-0">Date</th>
                        <th class="pt-0 pl-0">Refund#</th>
                        <th class="pt-0 pl-0">TXN#</th>
                        <th class="pt-0 pl-0">Status</th>
                        <th class="pt-0 pl-0">Amount</th>
                        <th class="pt-0 pl-0">Type</th>
                        <th class="pt-0 pl-0">Bank Reference id</th>
                        <th class="pt-0 pl-0">Action</th>
                    </tr>
                    </thead>
                    <tbody id="refundData">

                    </tbody>
                </table>
                <div id="pagination">

                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" role="dialog"  id="refundDetailsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="refundDetails">

            </div>
        </div>
    </div>

@endsection

@section('customJs')

    <script src="{{URL::asset('custom/js/component/widget.js')}}"></script>
    <script src="{{URL::asset('custom/js/component/refund.js?v=3')}}"></script>
@endsection

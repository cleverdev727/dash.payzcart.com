@extends('layout.master')

@section('title', 'Reports')

@section('customStyle')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Report</h6>
            </div>
            <div class="mb-4">
                <form action="javascript:void(0)" id="reportGenerateForm">
                    <div class="row mt-4">
                        <div class="col-auto">
                            <div class="form-group">
                                <select name="txtReportType" id="txtReportType" class="form-control">
                                    <option value="PAYIN">Payin</option>
                                    <option value="REFUND">Refund</option>
                                    <option value="PAYOUT">Payout</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <select name="txtReportTypeStatus" id="txtReportTypeStatus" class="form-control">
                                    <option value="All">All</option>
                                    <option value="Success">Success</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Initialized">Initialized</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Expired">Expired</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txnDatePicker" name="txnDatePicker" data-dzp-picker="custom" placeholder="Select Date" autocomplete="off">
                            </div>
                        </div><!-- Col -->
                        <div class="col-auto">
                            <label class="control-label"></label>
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </div><!-- Col -->
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="card mt-5">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-3">Generated Report</h6>
            </div>


            <div class="table-responsive" id="reportDataZone">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th class="pt-0">Batch#</th>
                        <th class="pt-0">Report Type</th>
                        <th class="pt-0">Date</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">No. of Record</th>
                        <th class="pt-0">Expire At</th>
                        <th class="pt-0">Report Date</th>
                        <th class="pt-0">Action</th>
                    </tr>
                    </thead>
                    <tbody id="reportData">
                    </tbody>
                </table>
                <div id="pagination">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script src="{{URL::asset('custom/js/component/widget.js')}}"></script>
    <script src="{{URL::asset('custom/js/component/report.js?v=5')}}"></script>
@endsection

@extends('layout.master')

@section('title', 'Statements')

@section('customStyle')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Statements</h6>
            </div>

            <div class="mb-4">
                <form action="javascript:void(0)" id="txnFilterForm">
                    <div class="row mt-4">
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

            <div class="table-responsive" id="statementDataZone">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th class="pt-0 pl-0">date</th>
                        <th class="pt-0 pl-0">payin</th>
                        <th class="pt-0 pl-0">payout</th>
                        <th class="pt-0 pl-0">refund</th>
                        <th class="pt-0 pl-0">un settled</th>
                        <th class="pt-0 pl-0">open balance</th>
                        <th class="pt-0 pl-0">closing balance</th>
                        <th class="pt-0 pl-0">last update</th>
                    </tr>
                    </thead>
                    <tbody id="statementData">

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
    <script src="{{URL::asset('custom/js/component/statement.js?v=3')}}"></script>
@endsection

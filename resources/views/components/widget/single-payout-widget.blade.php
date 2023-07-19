<div class="modal fade " role="dialog"  id="singlePayoutModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header border-0 bg-primary s-payout-header">
                <h5 class="text-white modal-title" id="exampleModalCenterTitle">Single Payout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#5e5da9">
                                <rect opacity="0.9" x="2" y="2" width="20" height="20" rx="10" fill="#fff"/>
                                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="#5e5da9"/>
                                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="#5e5da9"/>
                            </svg>
                        </span>
                </button>
            </div>
            <form action="javascript:void(0)" id="singlePayoutForm"  autocomplete="off">
                <div class="modal-body">
                    <h6 class="mb-2 mt-2">Payout Type</h6>
                    <div class="payout-area">
                        <div class="payout-type-box active">
                            <label for="payoutIMPS" class="s-payout-label">
                                <span class="s-payout-label-title">IMPS</span>
                                <span class="s-payout-checked">
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>
                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="#5e5da9"/>
                                            </svg>
                                        </span>
                                    </span>
                            </label>
                            <input type="radio" value="IMPS" name="payout_type" class="s-payout-input" id="payoutIMPS" checked>
                        </div>
                        <div class="payout-type-box">
                            <label for="payoutNEFT" class="s-payout-label">
                                <span class="s-payout-label-title">NEFT</span>
                                <span class="s-payout-checked">
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>
                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="#5e5da9"/>
                                            </svg>
                                        </span>
                                    </span>
                            </label>
                            <input type="radio" value="NEFT" name="payout_type" class="s-payout-input" id="payoutNEFT">
                        </div>
                        <div class="payout-type-box">
                            <label for="payoutRTGS" class="s-payout-label">
                                <span class="s-payout-label-title">RTGS</span>
                                <span class="s-payout-checked">
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>
                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="#5e5da9"/>
                                            </svg>
                                        </span>
                                    </span>
                            </label>
                            <input type="radio" value="RTGS" name="payout_type" class="s-payout-input" id="payoutRTGS">
                        </div>
{{--                        <div class="payout-type-box">--}}
{{--                            <label for="payoutUPI" class="s-payout-label">--}}
{{--                                <span class="s-payout-label-title">UPI</span>--}}
{{--                                <span class="s-payout-checked">--}}
{{--                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>--}}
{{--                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="#5e5da9"/>--}}
{{--                                            </svg>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                            </label>--}}
{{--                            <input type="radio" value="UPI" name="payout_type" class="s-payout-input" id="payoutUPI">--}}
{{--                        </div>--}}
                    </div>

                    <div id="PayoutDetail" class="mb-3">
                        <h6 class="mb-2">Payout Details</h6>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="payoutRefId">Reference ID:</label>
                                <input type="text" name="payout_ref_id" class="form-control s-payout-form-input" id="payoutRefId">
                            </div>
                        </div>
                    </div>

{{--                    <div id="customerDetail" class="mb-3">--}}
{{--                        <h6 class="mb-2">Customer Details</h6>--}}
{{--                        <div class="row">--}}
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="customerName">Customer Name</label>--}}
{{--                                <input type="text" name="customer_name" class="form-control s-payout-form-input" id="customerName">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="customerEmail">Customer Email</label>--}}
{{--                                <input type="text" name="customer_email" class="form-control s-payout-form-input" id="customerEmail">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="customerMobile">Customer Mobile</label>--}}
{{--                                <input type="text" name="customer_mobile" class="form-control s-payout-form-input" id="customerMobile">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div id="bankAccountDetail">
                        <h6 class="mb-2">Bank Account Details</h6>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="customerName">Account Holder</label>
                                <input type="text" name="customer_name" class="form-control s-payout-form-input" id="customerName">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="accountNumber">Account Number</label>
                                <input type="text" name="account_number" class="form-control s-payout-form-input" id="accountNumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ifscCode">IFSC Code</label>
                                <input type="text" name="ifsc_code" class="form-control s-payout-form-input" id="ifscCode">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="payoutAmount">Amount</label>
                                <input type="text" name="payout_amount" class="form-control s-payout-form-input" id="payoutAmount">
                            </div>
                        </div>
                    </div>

                    <div id="vpaDetail" style="display: none">
                        <h6 class="mb-2">VPA Details</h6>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="vpa">UPI ID:</label>
                                <input type="text" name="vpa" class="form-control s-payout-form-input" id="vpa">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary btn-cmodal">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

@extends('layout.master')

@section('title', 'Settings')

@section('customStyle')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Change Password</h6>
                    </div>
                    <div class="mb-4">
                        <form class="forms-sample" id="changeMerchantForm">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Old Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control w-50" placeholder="Old Password" name="txtOldPassword">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control w-50" placeholder="New Password" name="txtNewPassword">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm New Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control w-50" placeholder="Confirm New Password" name="txtConfirmPassword">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="gAuthSection">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">User's Information </h6>
                    </div>
                    <div class="alert alert-info" role="alert" style="color: black">
                        <div class="ml-2">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <p class="pt-3 {{\App\Classes\DashboardUtils::isKeePays() ? 'text-white' : ''}}"><strong>User Name: </strong>{{\Illuminate\Support\Facades\Auth::user()->fullName}}</p>
                                <p class="pt-3 tx-11 {{\App\Classes\DashboardUtils::isKeePays() ? 'text-white' : ''}}"><strong>MID: </strong>{{\Illuminate\Support\Facades\Auth::user()->merchantId}}</p>
                                <p class="pt-3 tx-11 {{\App\Classes\DashboardUtils::isKeePays() ? 'text-white' : ''}}"><strong>Status: </strong>{{\Illuminate\Support\Facades\Auth::user()->accountStatus}}</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if(\Illuminate\Support\Facades\Auth::user()->isPayoutEnable)
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="txnConfiguration">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Payout Configuration</h6>
                    </div>
                    <div class="mb-4">
                        <form class="forms-sample" id="UpdateConfiguration">
                            <div class="form-group">
                                <label class="control-label">Payout Delayed Time</label>
                                <select class="form-control w-20" id="PayoutDelayedTime" name="payout_delayed_time">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"  id="AutoApprovedPayout">
                                    <label class="custom-control-label" for="AutoApprovedPayout">Auto Approved Payout</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row">

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Webhook</h6>
                    </div>
                    <div class="mb-4">
                        <form class="forms-sample" id="payoutWebhookForm">
                            <div class="form-group">
                                <label>Payin Webhook</label>
                                <input type="text" class="form-control w-50" placeholder="Payment Webhook" name="payment_webhook" id="paymentWebhook">
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->isPayoutEnable)
                            <div class="form-group">
                                <label>Payout Webhook</label>
                                <input type="text" class="form-control w-50" placeholder="Payout Webhook" name="payout_webhook" id="payoutWebhook">
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="gAuthSection">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Google Authenticator : <span class="badge badge-success" id="gauthStatusBadge">Activated</span></h6>
                    </div>
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Secure Your Account</h4>
                        <p>
                            Two-factor authentication adds an extra layer of security to your account. To log in, in addition you'll need to provide a 6 digit code
                        </p>
                        <hr>
                        <button class="btn btn-primary btnEnableGAuth" type="button">Enable</button>
                        <button class="btn btn-danger btnDisableGAuth" type="button">Disable</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enableGAuthenticatorModal" tabindex="-1" aria-labelledby="enableGAuthenticatorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enableGAuthenticatorModalLabel">Enable Google Authenticator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <form action="javascript:void(0)" id="enableGAuthenticatorForm">
                    <div class="modal-body text-center">
                        <img src="" class="wd-100 wd-sm-150" alt="..." id="enableGAuthenticatorQr">
                        <div class="form-group mt-3">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Enter OTP"
                                   name="g_auth_otp"
                                   id="g_auth_otp"
                                   pattern="^[0-9]{1,6}$"
                                   maxlength="6"
                                   minlength="6"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enable</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection

@section('customJs')
    <script src="{{URL::asset('custom/js/component/setting.js?v=3')}}"></script>
@endsection

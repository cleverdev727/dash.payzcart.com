<?php

use App\Classes\DashboardUtils;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::check()) {
        return redirect("/dashboard");
    }
    return view('components.auth.login');
})->name("login");

Route::get('/login', function () {
    if(\Illuminate\Support\Facades\Auth::check()) {
        return redirect("/dashboard");
    }
    return view('components.auth.login');
})->name("login");
Route::get('/dashboard', function () { return view('components.dashboard.dashboard'); })->middleware("auth");
Route::get('/payin', function () { return view('components.transaction'); })->middleware("auth");
Route::get('/payouts', function () { return view('components.payout'); })->middleware("auth");
Route::get('/refunds', function () { return view('components.refund'); })->middleware("auth");
Route::get('/settings', function () { return view('components.setting'); })->middleware("auth");
Route::get('/reports', function () { return view('components.reports.reports'); })->middleware("auth");
//Route::get('/statement', function () { return view('components.statement.statement'); })->middleware("auth");
Route::get('/logout', function () {
    DashboardUtils::LogDB("AUTHENTICATION", "Dashboard Logout Success");
    \Illuminate\Support\Facades\Auth::logout();
    return redirect("login");
})->middleware("auth");

Route::prefix('/api')->group(function () {
    Route::post('/merchant/auth', [\App\Http\Controllers\MerchantController::class, "merchantAuthenticate"]);
    Route::post('/merchant/re-auth', [\App\Http\Controllers\MerchantController::class, "merchantReAuthenticate"]);
});

Route::prefix('/api')->middleware("auth")->group(function () {
    Route::post('/dashboard/summary', [\App\Http\Controllers\DashboardController::class, "getDashboardSummary"]);
    Route::post('/dashboard/chart/summary', [\App\Http\Controllers\DashboardController::class, "getChartData"]);
    Route::post('/payin', [\App\Http\Controllers\TransactionController::class, "getTransaction"]);
    Route::post('/payin/refund', [\App\Http\Controllers\TransactionController::class, "refundTransaction"]);
    Route::post('/payin/resend/webhook', [\App\Http\Controllers\TransactionController::class, "resendTransactionWebhook"]);
    Route::post('/payin/detail', [\App\Http\Controllers\TransactionController::class, "getTransactionDetails"]);
    Route::post('/payout', [\App\Http\Controllers\PayoutController::class, "getPayout"]);
    Route::post('/payout/single/request', [\App\Http\Controllers\PayoutController::class, "createPayoutRequest"]);
    Route::post('/payout/request/approve', [\App\Http\Controllers\PayoutController::class, "approvedPayoutRequest"]);
    Route::post('/payout/request/cancel', [\App\Http\Controllers\PayoutController::class, "cancelPayoutRequest"]);
    Route::post('/payout/resend/webhook', [\App\Http\Controllers\PayoutController::class, "resendPayoutWebhook"]);
    Route::post('/payout/detail', [\App\Http\Controllers\PayoutController::class, "getPayoutDetails"]);
    Route::post('/refund', [\App\Http\Controllers\RefundController::class, "getRefund"]);
//    Route::post('/statement', [\App\Http\Controllers\StatementController::class, "getStatement"]);
    Route::post('/refund/detail', [\App\Http\Controllers\RefundController::class, "getRefundDetail"]);
    Route::post('/refund/resend/webhook', [\App\Http\Controllers\RefundController::class, "resendRefundWebhook"]);

    Route::post('/add/report', [\App\Http\Controllers\ReportController::class, "addReport"]);
    Route::post('/get/report', [\App\Http\Controllers\ReportController::class, "getReports"]);
    Route::post('/report/download', [\App\Http\Controllers\ReportController::class, "downloadReport"]);

    Route::post('/setting/change-password', [\App\Http\Controllers\MerchantController::class, "merchantChangePassword"]);
    Route::post('/setting/detail', [\App\Http\Controllers\MerchantController::class, "getSettingDetail"]);
    Route::post('/setting/update/configuration', [\App\Http\Controllers\MerchantController::class, "updateConfiguration"]);
    Route::post('/setting/update/webhook', [\App\Http\Controllers\MerchantController::class, "updateWebhook"]);
    Route::post('/setting/gauth/enable', [\App\Http\Controllers\MerchantController::class, "enableGAuth"]);
    Route::post('/setting/gauth/disable', [\App\Http\Controllers\MerchantController::class, "disableGAuth"]);
    Route::post('/setting/gauth/enable/verify', [\App\Http\Controllers\MerchantController::class, "verifyToEnableGAuth"]);
});

Route::prefix('/api')->middleware("auth")->group(function () {
    Route::post('/view/payin/status', [\App\Http\Controllers\ReconController::class, "transactionRecon"]);
    Route::post('/transaction/recon/action', [\App\Http\Controllers\ReconController::class, "transactionReconAction"]);
});

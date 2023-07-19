$(document).ready(function (){
    (new DzpSetting()).getSettingDetail();
});
$("#changeMerchantForm").on("submit", (e) => {
    e.preventDefault()
    const changeMerchantFormData = DpzHelper.serializeObject($("#changeMerchantForm"));
    const postData = {
        old_password: changeMerchantFormData.txtOldPassword,
        new_password: changeMerchantFormData.txtNewPassword,
        confirm_password: changeMerchantFormData.txtConfirmPassword,
    };
    (new DzpSetting()).reAuthenticateMerchant(postData);
    $("#changeMerchantForm").trigger("reset");
});

$("#UpdateConfiguration").on("submit", (e) => {
    e.preventDefault()
    const UpdateConfigurationFormData = DpzHelper.serializeObject($("#UpdateConfiguration"));
    const postData = {
        payout_delayed_time: UpdateConfigurationFormData.payout_delayed_time,
        auto_approved_payout: null,
    };
    if($("#AutoApprovedPayout").prop("checked")){
        postData.auto_approved_payout = 1;
    }else {
        postData.auto_approved_payout = 0;
    }
    (new DzpSetting()).UpdateConfiguration(postData);

});

$("#payoutWebhookForm").on("submit", (e) => {
    e.preventDefault()
    const payoutWebhookFormData = DpzHelper.serializeObject($("#payoutWebhookForm"));
    const postData = {
        payment_webhook: payoutWebhookFormData.payment_webhook,
        payout_webhook: payoutWebhookFormData.payout_webhook,
    };
    (new DzpSetting()).UpdateWebhook(postData);
});

function DzpSetting() {
    this.reAuthenticateMerchant = (data) => {
        DpzHelper.blockUi("#changeMerchantForm");
        DpzClient.post("/api/setting/change-password", data)
            .then((response) => {
                DpzHelper.unblockUi("#changeMerchantForm");
                DpzHelper.successSnack(response.message);
            })
            .catch((error) => {
                DpzHelper.unblockUi("#changeMerchantForm");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
    this.getSettingDetail = () => {
        DpzHelper.blockUi("#txnConfiguration");
        DpzHelper.blockUi("#payoutWebhookForm");
        DpzClient.post("/api/setting/detail")
            .then((response) => {
                let item = response.data;
                if (response.status === true){
                    // PAYOUT CONFIGURATION
                    $('#PayoutDelayedTime').find('option[value='+item.payout_delayed_time+']').attr("selected",true);
                    if (item.is_auto_approved_payout){
                        $('#AutoApprovedPayout').prop('checked', true)
                    }else {
                        $('#AutoApprovedPayout').prop('checked', false)
                    }

                    if(item.is_gauth_enabled) {
                        $("#gauthStatusBadge").show();
                        $(".btnDisableGAuth").show();
                        $(".btnEnableGAuth").hide();
                    } else {
                        $(".btnDisableGAuth").hide();
                        $("#gauthStatusBadge").hide();
                        $(".btnEnableGAuth").show();
                    }
                    // WEBHOOK
                    $("#paymentWebhook").val(item.webhook_url)
                    $("#payoutWebhook").val(item.payout_webhook_url)
                }
                DpzHelper.unblockUi("#txnConfiguration");
                DpzHelper.unblockUi("#payoutWebhookForm");
            })
            .catch((error) => {
                // this.setEmptyHtml();
                DpzHelper.unblockUi("#txnConfiguration");
            });
    }
    this.UpdateConfiguration = (data) => {
        DpzHelper.blockUi("#txnConfiguration");
        DpzClient.post("/api/setting/update/configuration", data)
            .then((response) => {
                DpzHelper.unblockUi("#txnConfiguration");
                DpzHelper.successSnack(response.message);
                this.getSettingDetail()
            })
            .catch((error) => {
                DpzHelper.unblockUi("#txnConfiguration");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
    this.UpdateWebhook = (data) => {
        DpzHelper.blockUi("#payoutWebhookForm");
        DpzClient.post("/api/setting/update/webhook", data)
            .then((response) => {
                DpzHelper.unblockUi("#payoutWebhookForm");
                DpzHelper.successSnack(response.message);
                this.getSettingDetail()
            })
            .catch((error) => {
                DpzHelper.unblockUi("#payoutWebhookForm");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
    this.EnableGAuth = () => {
        DpzHelper.blockUi("#gAuthSection");
        DpzClient.post("/api/setting/gauth/enable", "")
            .then((response) => {
                DpzHelper.unblockUi("#gAuthSection");
                DpzHelper.successSnack(response.message);
                $("#enableGAuthenticatorQr").prop("src", response.data.qr_code);
                $("#enableGAuthenticatorModal").modal("show");
            })
            .catch((error) => {
                DpzHelper.unblockUi("#gAuthSection");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
    this.VerifyGAuth = (data) => {
        DpzHelper.blockUi("#enableGAuthenticatorForm");
        DpzClient.post("/api/setting/gauth/enable/verify", data)
            .then((response) => {
                DpzHelper.unblockUi("#enableGAuthenticatorForm");
                DpzHelper.successSnack(response.message);
                $("#enableGAuthenticatorModal").modal("hide");
                this.getSettingDetail()
            })
            .catch((error) => {
                DpzHelper.unblockUi("#enableGAuthenticatorForm");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
    this.DisableGAuth = (data, blockElement, modalElement) => {
        DpzHelper.blockUi(blockElement);
        DpzClient.post("/api/setting/gauth/disable", data)
            .then((response) => {
                DpzHelper.unblockUi(blockElement);
                DpzHelper.successSnack(response.message);
                $(modalElement).modal("hide");
                this.getSettingDetail()
            })
            .catch((error) => {
                DpzHelper.unblockUi(blockElement);
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }
}

$(".btnEnableGAuth").click(() => {
    (new DzpSetting()).EnableGAuth()
});

$(".btnDisableGAuth").click(() => {
    DpzGAuthService.init((otp, blockElement, modalElement) => {
        (new DzpSetting()).DisableGAuth(
            {g_auth_otp: otp},
            blockElement,
            modalElement
        );
    });
});

$('#enableGAuthenticatorModal').on('hidden.bs.modal', function (e) {
    $("#enableGAuthenticatorQr").prop("src", "");
    $("#enableGAuthenticatorForm")[0].reset();
})

$("#enableGAuthenticatorForm").submit(() => {
    const fd = DpzHelper.serializeObject($("#enableGAuthenticatorForm"));
    (new DzpSetting()).VerifyGAuth(fd)
});

let _isAllowedChangePassword = false;
$("#authenticateMerchantForm").on("submit", () => {
    const authenticateMerchantFormData = DpzHelper.serializeObject($("#authenticateMerchantForm"));
    const postData = {
        username: authenticateMerchantFormData.txtUsername,
        password: authenticateMerchantFormData.txtPassword,
        new_password: authenticateMerchantFormData.txtNewPassword,
    };
    if(_isAllowedChangePassword) {
        (new DzpAuthenticate()).reAuthenticateMerchant(postData);
    } else {
        (new DzpAuthenticate()).authenticateMerchant(postData);
    }
});

function DzpAuthenticate() {

    this.authenticateMerchant = (data) => {
        DpzHelper.blockUi("#authenticateMerchantForm");
        DpzClient.post("/api/merchant/auth", data)
            .then((response) => {
                if(response.is_allowed_change_password) {
                    _isAllowedChangePassword = true;
                    $("#newPasswordField").show();
                    DpzHelper.unblockUi("#authenticateMerchantForm");
                } else {
                    DpzHelper.successSnack(response.message);
                    window.location.href = "/dashboard";
                    DpzHelper.unblockUi("#authenticateMerchantForm");
                }
            })
            .catch((error) => {
                DpzHelper.unblockUi("#authenticateMerchantForm");
                DpzHelper.errorSnack(error.responseJSON.message +' ' +'<i class="text-white pl-2 feather icon-alert-triangle"></i>');
            });
    }

    this.reAuthenticateMerchant = (data) => {
        DpzHelper.blockUi("#authenticateMerchantForm");
        DpzClient.post("/api/merchant/re-auth", data)
            .then((response) => {
                DpzHelper.unblockUi("#authenticateMerchantForm");
                DpzHelper.successSnack(response.message);
                window.location.href = "/dashboard";
            })
            .catch((error) => {
                DpzHelper.unblockUi("#authenticateMerchantForm");
                DpzHelper.errorSnack(error.responseJSON.message);
            });
    }

}

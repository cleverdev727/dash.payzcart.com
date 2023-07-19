const DpzClient = {

    post(url, postData = []) {
        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'post',
                data: postData,
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },

    get(url, jsonData = []) {

        if(jsonData.length > 0) {
            url += '?' +
                Object.keys(jsonData).map(function(key) {
                    return encodeURIComponent(key) + '=' +
                        encodeURIComponent(jsonData[key]);
                }).join('&');
        }

        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'get'
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },

    csrf() {
        return $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
}

const DpzHelper = {
    serializeObject: (data) => {
        let o = {};
        let a = data.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },
    successSnack: (data) => {
        Snackbar.show({
            showAction: false,
            text: data,
            duration: 3000,
            customClass: 'customeSnackSuccess',
            pos: 'top-center'
        });
    },
    errorSnack: (data) => {
        Snackbar.show({
            showAction: false,
            text: data,
            duration: 3000,
            customClass: 'customeSnackFailed',
            pos: 'top-center'
        });
    },
    blockUi: (bloclEl) => {
        if(Array.isArray(bloclEl)) {
            console.log(bloclEl)
            bloclEl.forEach((item) => {
                console.log(item)
                $(item).block({
                    message: '<div class="ft-refresh-cw font-medium-2"><i class="mdi mdi-clock-fast fa-spin"></i> <span style="font-size: 12px;font-weight: 600;">Please Wait...</span></div>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            });
        } else {
            $(bloclEl).block({
                message: '<div class="ft-refresh-cw font-medium-2"><i class="fa fa-circle-o-notch fa-spin"></i> <span style="font-size: 12px;font-weight: 600;">Please Wait...</span></div>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        }

    },
    unblockUi: (bloclEl) => {
        if(Array.isArray(bloclEl)) {
            bloclEl.forEach((item) => {
                $(item).unblock();
            });
        } else {
            $(bloclEl).unblock();
        }
    },
    getTransactionStatus(status) {
        let txnStatus = {
            "Success": "badge badge-success",
            "Failed": "badge badge-danger",
            "Initialized": "badge badge-primary",
            "Full Refund": "badge badge-info",
            "Partial Refund": "badge badge-info",
            "Processing": "badge badge-warning",
            "Cancelled": "badge badge-danger",
            "Not Attempted": "badge badge-warning",
            "Pending": "badge badge-primary-inverse",
            "Expired": "badge badge-danger-inverse",
        };
        return `<span class="${txnStatus[status]}">${status}</span>`;
    },
    amountParse(amount) {
        return amount.toLocaleString('en-US',
            {style: 'currency', currency: 'INR'}
        );

    },
    abbreviateNumber(num, fixed) {
        if (num === null) { return null; } // terminate early
        if (num === 0) { return '0'; } // terminate early
        fixed = (!fixed || fixed < 0) ? 0 : fixed; // number of decimal places to show
        var b = (num).toPrecision(2).split("e"), // get power
            k = b.length === 1 ? 0 : Math.floor(Math.min(b[1].slice(1), 14) / 3), // floor at decimals, ceiling at trillions
            c = k < 1 ? num.toFixed(0 + fixed) : (num / Math.pow(10, k * 3) ).toFixed(1 + fixed), // divide by power
            d = c < 0 ? c : Math.abs(c), // enforce -0 is 0
            e = d + ['', 'K', 'M', 'B', 'T'][k]; // append power
        return e;
    }
};

function EventBus() {
    this.dispatch = $({});
}

EventBus.prototype = {
    emitter: function(c) {
        this.dispatch.trigger(c.e, c.c);
    }
};
const EventListener = new EventBus();

EventListener.dispatch.on("sampleEvent", (e, c) => {
    console.log(c.a);
});
// Sample Event Emit:: EventListener.emitter({e: "sampleEvent", c: {a: "sample"}});

const getRandomClass = () => {
    const classList = [
        'bg-success',
        'bg-gradient-dark',
        'bg-gradient-success',
        'bg-danger',
        'bg-gradient-danger',
        'bg-primary',
        'bg-gradient-primary',
        'bg-info',
        'bg-gradient-info',
        'bg-secondary',
        'bg-dribbble',
        'bg-facebook',
    ];
    return classList[Math.floor(Math.random() * classList.length)];
}

const truncate = (text, length, clamp) => {
    clamp = clamp || '...';
    let node = document.createElement('div');
    node.innerHTML = text;
    let content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
}

const manualPad = (d) => {
    return (d < 10) ? '0' + d.toString() : d.toString();
}

DzpDatePickerService = {
    init: () => {
        let findDatePickerElement = document.querySelectorAll('input[data-dzp-picker="custom"]');
        findDatePickerElement.forEach((item, index) => {
            $(item).daterangepicker({
                "autoApply": true,
                "autoUpdateInput": false,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                },
                "linkedCalendars": false,
                "showCustomRangeLabel": false,
                "startDate": moment().subtract(7, 'd'),
                "endDate": moment(),
                "maxDate": moment(),
                "maxSpan": {
                    "days": 30
                },
            }, function(start, end, label) {
                $("#txnDatePicker").val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            });
        });
    }
};

DzpDatePickerServiceForInOut = {
    init: () => {
        let findDatePickerElement = document.querySelectorAll('input[data-dzp-picker="custom"]');
        findDatePickerElement.forEach((item, index) => {
            $(item).daterangepicker({
                "autoApply": true,
                "autoUpdateInput": false,
                "timePicker": false,
                "timePicker24Hour": true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                },
                "linkedCalendars": false,
                "showCustomRangeLabel": false,
                "startDate": moment().subtract(7, 'd'),
                "endDate": moment(),
                "maxDate": moment(),
                "maxSpan": {
                    "days": 30
                },
            }, function(start, end, label) {
                $("#txnDatePicker").val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            });
        });
    }
}

const DpzGAuthService = {
    init: (callback) => {
        $("#GAuthenticatorOtpModal").modal("show");
        $('#GAuthenticatorOtpForm').off('submit');
        $("#GAuthenticatorOtpForm").submit(() => {
            let fd = DpzHelper.serializeObject($("#GAuthenticatorOtpForm"));
            const gAuthOtp = fd.otp.join('');
            callback(gAuthOtp, $("#GAuthenticatorOtpForm"), $("#GAuthenticatorOtpModal"));
        });
    },
    digitValidate: (ele) => {
        ele.value = ele.value.replace(/[^0-9]/g,'');
    },
    tabChange: (val) => {
        let ele = document.querySelectorAll('.otp');
        if(ele[val-1].value !== ''){
            if(ele[val]) ele[val].focus()
        }else if(ele[val-1].value === ''){
            if(ele[val-2]) ele[val-2].focus()
        }
    },
};

moment.tz.setDefault("Asia/Kolkata");

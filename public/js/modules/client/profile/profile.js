/**
 * ****************************************************************************
 * profile.js
 *
 * Description		:	Methods and events for page create/edit user
 * Created at		:	15/11/2022
 * Created by		:	SangVT - thanhsang0139@gmail.com
 * package		    :	Client
 * ****************************************************************************
 */

$(document).ready(function () {
    ProfileModule.Init();
    ProfileModule.InitEvents();
});

/**
 * Module contains handling for page create/edit user
 * @author SangVT - 15/11/2022 - create
 * @param
 * @return { Function } ProfileModule.Init() - Initialize values
 * @return { Function } ProfileModule.InitEvents() - Initiating events
 */
var ProfileModule = (function () {
    /**
     * Objects associated with items on the screen
     */
    var obj = {
        'firstName': { 'type': 'text', 'attr': {  'maxlength': 50 } },
        'lastName': { 'type': 'text', 'attr': {  'maxlength': 50 } },
        'birthday': { 'type': 'text', 'attr': { 'class': 'for-select2', 'maxlength': 10 } },
        'gender': { 'type': 'select', 'attr': { 'class': 'for-select2' } },
        'phone': { 'type': 'text', 'attr': { 'class': 'only-number', 'maxlength': 10 } },
        'address_detail': { 'type': 'text', 'attr': { 'maxlength': 100 } },
        'province_id': { 'type': 'select', 'attr': { 'class': 'for-select2' } },
        'district_id': { 'type': 'select', 'attr': { 'class': 'for-select2' } },
        'address_commune_id': { 'type': 'select', 'attr': { 'class': 'for-select2' } },
        'username': { 'type': 'text', 'attr': { 'class': 'required alphabet', 'maxlength': 100 } },
        'job': { 'type': 'text', 'attr': { 'maxlength': 100 } },
        'company': { 'type': 'text', 'attr': { 'maxlength': 100 } },
        'height': { 'type': 'text', 'attr': { 'class': 'only-number', 'maxlength': 100 } },
        'weight': { 'type': 'text', 'attr': { 'class': 'only-number', 'maxlength': 100 } },
    };

    /**
     * Initialize system values
     *
     * @author SangVT - 15/10/2022 - create
     * @param
     * @return
     */
    var Init = function () {
        try {
            Common.InitItem(obj);
            $('#username').focus();
        }
        catch (e) {
            console.log('Init: ' + e.message);
        }
    };

    /**
     * Initiating events in the page
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return
     */
    var InitEvents = function () {
        try {
            //Check change input
            $('#username, #firstName, #lastName, #gender, #birthday, #phone, #address_detail, #address_commune_id, #job, #company, #height, #weight').on('change', function () {
                document.getElementById("btn-change").setAttribute("style","");
            });
            // Check used username
            $('#username').on('change', function () {
                CheckInput($('#username'));
            });
            // Validate username when input username
            $('#username').on('change', function () {
                ValidateUserNameRequired($('#username'));
            });
            // Validate username when input username
            $('#username').on('keyup', function () {
                ValidateUsername();
            });
            // Get districts when province_id change
            $('#province_id').on('change', function () {
                GetDistricts();
            });
            // Get communes when district_id change
            $('#district_id').on('change', function () {
                GetCommunes();
            });
            $('#btn-change').on('click', function () {
                error = false;
                SaveUser();
            });
            // Enter press event
            document.onkeypress = function (event) {
                // If the button being pressed is enter and is not showing a signup failure message, then submit the signup information
                if ((event.which === 13 || event.keyCode === 13) && !error && $(event.target).attr('id') !== 'popup_ok') {
                    SaveUser();
                }
            };
        }
        catch (e) {
            console.log('InitEvents: ' + e.message);
        }
    };

    /**
     * Validate username follow rule or not
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return {boolean} true if data valid, false if data not valid
     */
    var ValidateUsername = function () {
        try {
            var userRule = /^[a-zA-Z]+$/;
            if ($('#username').val().match(userRule)) {
                $('#username').RemoveError();
                return true;
            }
            else {
                $('#username').ItemError(_msg[MSG_NO.USERNAME_WRONG_FORMAT].content);
                return false;
            }
        }
        catch (e) {
            console.log('ValidateUsername: ' + e.message);
            return false;
        }
    };


    /**
     * Check first Name required
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return {boolean} true if data valid, false if data not valid
     */
     var ValidateUserNameRequired = function ($input) {
        try {
            if (!StringModule.IsNullOrEmpty($input.val())) {
                $('#username').RemoveError();
                return true;
            } else {
                $('#username').ItemError(_msg[MSG_NO.REQUIRED].content);
                return false;
            }
        }
        catch (e) {
            console.log('ValidateUserNameRequired: ' + e.message);
            return false;
        }
    };

    /**
     * Check data input have in DB or not
     *
     * @author SangVT - 15/11/2022 - create
     * @param {object} $input input in screen have data need to check
     * @param {number} type type of data need to check
     * @return {boolean} false if not used
     */
    var CheckInput = function ($input) {
        try {
            if (StringModule.IsNullOrEmpty($input.val())) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: urls.checkInput,
                global: false,
                dataType: 'json',
                data: {
                    user_id: $('#id').val(),
                    value: $input.val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.code !== 200) {
                        $input.ItemError(_msg[res.msgNo].content);
                    }
                },
                error: function (res) {
                    var object = res.responseJSON.errors.data;
                    var ob = object[Object.keys(object)[0]];
                    if(ob){
                        Notification.Alert(ob[0]);
                    }else{
                        Notification.Alert(MSG_NO.SERVER_ERROR);
                    }
                }
            });
        }
        catch (e) {
            console.log('CheckInput: ' + e.message);
            return false;
        }
    };

    /**
     * Get districts when province_id change
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return
     */
    var GetDistricts = function () {
        try {
            const provinceId = $('#province_id').val();
            $.ajax({
                type: 'GET',
                url: `${urls.getDistricts}/${provinceId}`,
                success: function (res) {
                    $('#district_id, #address_commune_id').empty();
                    $('#district_id, #address_commune_id').append(`<option value=''></option>`);
                    let districts = res.data;
                    for (let i = 0; i < districts.length; i++) {
                        $('#district_id').append(`<option value='${districts[i].id}'>${districts[i].name}</option>`);
                    }
                    $('#district_id, #address_commune_id').select({
                        minimumResultsForSearch: -1,
                        width: '100%'
                    });
                },
                error: function () {
                    Notification.Alert(MSG_NO.SERVER_ERROR, function () {
                        $('#province_id').focus();
                    });
                },
            });
        } catch (e) {
            console.log('GetDistricts: ' + e.message);
        }
    };

    /**
     * Get communes when district_id change
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return
     */
    var GetCommunes = function () {
        try {
            let districtId = $('#district_id').val();
            $.ajax({
                type: 'GET',
                url: `${urls.getCommunes}/${districtId}`,
                success: function (res) {
                    $('#address_commune_id').empty();
                    $('#address_commune_id').append(`<option value=''></option>`);
                    let communes = res.data;
                    for (let i = 0; i < communes.length; i++) {
                        $('#address_commune_id').append(`<option value='${communes[i].id}'>${communes[i].name}</option>`);
                    }
                    $('#address_commune_id').select({
                        minimumResultsForSearch: -1,
                        width: '100%'
                    });
                },
                error: function () {
                    Notification.Alert(MSG_NO.SERVER_ERROR, function () {
                        $('#district_id').focus();
                    });
                },
            });
        } catch (e) {
            console.log('GetCommunes: ' + e.message);
        }
    };

    /**
     * Insert or update data of a user
     *
     * @author SangVT - 15/11/2022 - create
     * @param
     * @return
     */
    var SaveUser = function () {
        try {
            var validate = ValidateModule.Validate(obj);
            var validate1 = ValidateUsername();
            var validate2 = ValidateUserNameRequired($('#username'));
            if (validate && validate1 && validate2) {
                var data = Common.GetData(obj);
                // Submit to the server
                $.ajax({
                    type: 'POST',
                    url: urls.editUser,
                    dataType: 'json',
                    data: data,
                    success: CheckChangeSuccess,
                    error: function (res) {
                        var object = res.responseJSON.errors.data;
                        var ob = object[Object.keys(object)[0]];
                        if (ob) {
                            Notification.Alert(ob[0]);
                        }
                    }
                });
            }
            else {
                ValidateModule.FocusFirstError();
            }
        } catch (e) {
            console.log("SaveUser: " + e.message);
        }
    };

    /**
     * Handle on successful signup. Save the cookie token and navigate to the page after signup.
     *
     * @author SangVT - 15/11/2022 - create
     * @param { Object } res The json object contains the results returned from the server
     * @return
     */
     var CheckChangeSuccess = function (res) {
        try {
            if (res.code === 200) {
                error = true;
                Notification.Alert(res.msgNo, function () {
                    error = false;
                    window.location = res.data;
                });
            }
            else if (res.code === 422) {
                // fill error from server to view
                ValidateModule.FillError(res.errors.data);
                ValidateModule.FocusFirstError();
            }
            else {
                // show popup error signup
                error = true;
                Notification.Alert(res.msgNo, function () {
                    error = false;
                });
            }
        }
        catch (e) {
            console.log('CheckhangeSuccess: ' + e.message);
        }
    };

    return {
        Init: Init,
        InitEvents: InitEvents
    };
})();


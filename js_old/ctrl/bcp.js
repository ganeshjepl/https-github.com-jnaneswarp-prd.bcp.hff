var country;
var state;
var city;
var language;


function load() {
    $.blockUI({css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#fff',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            'z-index': 9999,
            color: '#000'
        }});

    //  setTimeout($.unblockUI, 5000); 
}

function  deleteUser(id) {
    var x = confirm("Are you sure you want to delete?");
    if (x) {
        $.ajax({
            type: "POST",
            url: site_url + "api/web/v1/ctrl/User/deleteUser",
            data: {"id": id},
            success: function (json) {

                if (json['status'] == true) {
                    $("#sucess_msg").show()
                    $("#sucess_msg").html(json['response']['messages']).fadeOut('5000');
                    $("#user" + id).hide();
                } else {
                    $("#error_msg").show()
                    $("#error_msg").html(json['response']['messages']).fadeOut('5000');
                }
            }
        });
    }
}
function  editBcp(id) {
    $('#bcpModal').modal('show');
    $('#bcpEditid').val(id);
    $('.rmv').removeClass('adminred');
    $('.error-msg-box').text('');
    $.ajax({
        type: "GET",
        url: site_url + "api/web/v1/ctrl/User/getBcp",
        data: {"bcpEditid": id},
        success: function (json) {




            $('#countryid').val(json['response']['userData'][0]['country_name']);
            $('#country').val(json['response']['userData'][0]['countryid']);
            $('#username').val(json['response']['userData'][0]['username']);
            $('#email').val(json['response']['userData'][0]['email']);
            $('#fname').val(json['response']['userData'][0]['firstName']);
            $('#lname').val(json['response']['userData'][0]['lastName']);
            $("input:radio[value=" + json['response']['userData'][0]['gender'] + "]").attr('checked', 'checked');
            $('#stateid').val(json['response']['userData'][0]['state_name']);
            $('#cityid').val(json['response']['userData'][0]['city_name']);
            $('#district').val(json['response']['userData'][0]['district']);
            $('#village').val(json['response']['userData'][0]['village']);
            $('#contact').val(json['response']['userData'][0]['mobile']);
            $('#altcontact').val(json['response']['userData'][0]['mobile']);
            $('#pincode').val(json['response']['userData'][0]['pincode']);
            $('#signupdate').val(json['response']['userData'][0]['signupdate']);
            $('#language').val(json['response']['userData'][0]['language_name']);

            if (json['response']['userData'][0]['profile_picture'] != '') {
                var imgurl = json['response']['userData'][0]['profile_picture'];
                $('#imagePreview').attr('src', imgurl);
            } else {
                var imgurl = imgs + "profile.jpg"
                $('#imagePreview').attr('src', imgurl);

            }
            country = json['response']['userData'][0]['countryid'];
            state = json['response']['userData'][0]['stateid'];
            city = json['response']['userData'][0]['cityid'];
            language = json['response']['userData'][0]['languageId'];


            $('#contactnumber').val(json['response']['userData'][0]['contact_number']);


            $('#lineModalLabel').html('Edit BCP');
            $('#squarespaceModal').modal('show');
        }
    });


}

$('#imageUpload').change(function () {
    readImgUrlAndPreview(this);
    function readImgUrlAndPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            }
        }
        ;
        reader.readAsDataURL(input.files[0]);
    }
});

var app = angular.module('Hff', []);
app.controller('country', function ($scope, $http) {
    $scope.countries = [300];
    $scope.countrysearch = function () {
        var len = $('#countryid').val();
        if (len.length >= 2)
            search();
    };
    function search() {
        $scope.RandomValue = angular.element('#countryid').val();
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

        $http({
            method: "post",
            url: site_url + 'api/web/v1/Country/searchCountry',
            data: $.param({
                name: $scope.RandomValue
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).then(function (response, status) {
            //  alert(response)

            $scope.country = JSON.stringify(response.data);
            var array = JSON.parse($scope.country);
            var len = Object.keys(array.response.countryData).length;
            var i = 0;
            $scope.countries.length = 0;
            while (i < len) {
                if(array.response.countryData[i]!==""){
                    $scope.countries.push(array.response.countryData[i]);
                }
                
                i++;
            }
        }, function myError(response) {
            $scope.err = response.statusText;

        });


    }
    ;
});

app.controller('state', function ($scope, $http) {
    $scope.statesearch = function () {
        var len = $('#stateid').val();
        if (len.length >= 2)
            searchstate();
    };
    function searchstate() {
        // var countryid = angular.element('#country').val();
        // alert($("#country_sugg option").attr('data-id'));
        $scope.RandomValue = angular.element('#stateid').val();
        var val = $('#countryid').val();

        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');

        //alert(countryid)
        if (countryid === undefined || countryid === null) {
            if (country !== null) {
                countryid = country;
            }else{
                countryid = 0;
            }
        }

        $scope.states = [];
        $scope.states = [100];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/State/statesByCountry',
            data: $.param({
                name: $scope.RandomValue,
                id: countryid
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).then(function (response, status) {
            var state_res = response.data;
            var len = Object.keys(state_res.response.stateData).length;
            ///console.log(len);
            var i = 0;
            while (i <= len) {
                ///console.log(state_res.response.stateData[i]);
                if(state_res.response.stateData[i]!==""){
                    $scope.states.push(state_res.response.stateData[i]);
                }
                i++;
            }
            //console.log($scope.states);

        }, function myError(response) {
            $scope.err = response.statusText;

        });

    }
    ;
});
app.controller('city', function ($scope, $http) {
    $scope.citysearch = function () {
        var len = $('#cityid').val();
        if (len.length >= 2)
            searchcity();
    };
    function searchcity() {


        var val = $('#stateid').val();
        var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
        }).data('id');

        if (stateid === undefined || stateid === null) {
            if (state !== null) {
                stateid = state;
            }else{
                stateid = 0;
            }
        }
            
        $scope.RandomValue = angular.element('#cityid').val();

        $scope.cities = [];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/City/citiesByState',
            data: $.param({
                name: $scope.RandomValue,
                id: stateid
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {

            var city_res = response.data;

            var len = Object.keys(city_res.response.cityData).length;
            var i = 0;
            while (i <= len) {
                if(city_res.response.cityData[i]!==""){
                    $scope.cities.push(city_res.response.cityData[i]);
                }
                
                i++;
            }

        }, function myError(response) {
            $scope.err = response.statusText;


        });


    }
    ;
});

app.controller('language', function ($scope, $http) {

    $scope.searchlang = function () {
        var lan = angular.element('#language').val();
        $scope.languages = [300];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/Language/searchLanguage',
            data: $.param({
                name: lan,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {

            var lang_res = response.data;

            var len = Object.keys(lang_res.response.languageData).length;
            var i = 0;
            while (i <= len) {
                if(lang_res.response.languageData[i]!==""){
                    $scope.languages.push(lang_res.response.languageData[i]);
                }
                
                i++;
            }

        }, function myError(response) {
            $scope.err = response.statusText;

        });

    };
});


$(document).ready(function () {

    $("#username").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#usernameerr').text("Please Enter User Name!");
        }
        else {
            $(this).removeClass('adminred');
            $('#usernameerr').text("");
        }
    });


    $("#fname").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#fnameerr').text("Please Enter First name!");
        }
        else {
            $(this).removeClass('adminred');
            $('#fnameerr').text("");
        }
    });
    $("#lname").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#lnameerr').text("Please Enter Last name!");
        }
        else {
            $(this).removeClass('adminred');
            $('#lnameerr').text("");
        }
    });
    $("#contact").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#contacterr').text("Please Enter Contact number!");
        }
        else {
            $(this).removeClass('adminred');
            $('#contacterr').text("");
        }
    });


    $("#signupdate").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#signupdateerr').text("Please Select SignUp date!");
        }
        else {
            $(this).removeClass('adminred');
            $('#signupdateerr').text("");
        }
    });

    $("#language").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#languageerr').text("Please Select Language!");
        }
        else {
            $(this).removeClass('adminred');
            $('#languageerr').text("");
        }
    });

    $('INPUT[type="file"]').change(function () {
        if ($("#imageUpload").val() !== '')
        {
            var ext = $('#imageUpload').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                $("#profileimgerr").text("Invalid,Should be an Image!");
                valid = false;
            }
            else {
                $("#imageUpload").removeClass('adminred');
                $('#profileimgerr').text("");
            }
        }
    });

    $("#countryid").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#countryerr').text("Please Select Country!");
        }
        else {
            $(this).removeClass('adminred');
            $('#countryerr').text("");
        }
    });
    $("#stateid").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#stateerr').text("Please Select State!");
        }
        else {
            $(this).removeClass('adminred');
            $('#stateerr').text("");
        }
    });
    $("#cityid").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#cityerr').text("Please Select City!");
        }
        else {
            $(this).removeClass('adminred');
            $('#cityerr').text("");
        }
    });

    $('#editbcp_form').on('submit', function (e) {

        e.preventDefault();

        var valid = true;
        var reg_username = /^[a-zA-Z0-9@]+$/;
        var reg_letters = /^[a-zA-Z\s]+$/;
        var reg_email = /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
        var reg_mobile = /^(([0|\+[0-9]{1,5})?([7-9][0-9]{9})|(\d{3}-)*\d{8})$/;
        var reg_pin = /^(?=.*[0-9])[^-\s]([a-zA-Z0-9 ]+(-[a-zA-Z0-9]+)?){1,14}$/;
        var alphanumeric = /^[a-zA-Z0-9@\s]+$/;


        if ($("#username").val() === '') {
            $("#username").addClass('adminred');
            $('#usernameerr').text("Please Enter User Name!");
            valid = false;
        }
        else if (!$("#username").val().match(reg_username)) {
            $("#username").addClass('adminred');
            $('#usernameerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#username").removeClass('adminred');
            $('#usernameerr').text("");
        }

        if ($("#email").val() !== '') {
            if (!$("#email").val().match(reg_email)) {
                $("#email").addClass('adminred');
                $('#emailerr').text("Please Enter Valid Email!");
                valid = false;
            }
            else {
                $("#email").removeClass('adminred');
                $('#emailerr').text("");
            }
        }
        if ($("#fname").val() === '') {
            $("#fname").addClass('adminred');
            $('#fnameerr').text("Please Enter First Name!");
            valid = false;
        }
        else if (!$("#fname").val().match(reg_letters)) {
            $("#fname").addClass('adminred');
            $('#fnameerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#fname").removeClass('adminred');
            $('#fnameerr').text("");
        }

        if ($("#lname").val() === '') {
            $("#lname").addClass('adminred');
            $('#lnameerr').text("Please Enter Last Name!");
            valid = false;
        }
        else if (!$("#lname").val().match(reg_letters)) {
            $("#lname").addClass('adminred');
            $('#lnameerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#lname").removeClass('adminred');
            $('#lnameerr').text("");
        }
        if ($('input:radio:checked').length === 0) {
            $('#gendererr').text("Please Select Gender!");
            valid = false;
        }
        else {
            $('#gendererr').text("");
            // $('input:radio:checked').val()
        }

        if ($("#contact").val() === '') {
            $("#contact").addClass('adminred');
            $('#contacterr').text("Please Enter Contact number!");
            valid = false;
        }
        else if (!$("#contact").val().match(reg_mobile)) {
            $("#contact").addClass('adminred');
            $('#contacterr').text("Please Enter Valid Contact Number!");
            valid = false;
        }
        else {
            $("#contact").removeClass('adminred');
            $('#contacterr').text("");
        }

        if ($("#altcontact").val() !== '') {
            if (!$("#altcontact").val().match(reg_mobile)) {
                $("#altcontact").addClass('adminred');
                $('#altcontacterr').text("Please Enter Numbers only!");
                valid = false;
            }
            else {
                $("#altcontact").removeClass('adminred');
                $('#altcontacterr').text("");
            }
        }

        if ($("#signupdate").val() === '') {
            $("#signupdate").addClass('adminred');
            $('#signupdateerr').text("Please Select Signup date!");
            valid = false;
        }
        else {
            $("#signupdate").removeClass('adminred');
            $('#signupdateerr').text("");
        }

        if ($("#countryid").val() === '') {
            $("#countryid").addClass('adminred');
            $('#countryerr').text("Please Select Country!");
            valid = false;
        }
        else if (!$("#countryid").val().match(reg_letters)) {
            $("#countryid").addClass('adminred');
            $('#countryerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#countryid").removeClass('adminred');
            $('#countryerr').text("");
        }
        
                
        if ($("#stateid").val() === '') {
            $("#stateid").addClass('adminred');
            $('#stateerr').text("Please Select State!");
            valid = false;
        }
        else if (!$("#stateid").val().match(reg_letters)) {
            $("#stateid").addClass('adminred');
            $('#stateerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#stateid").removeClass('adminred');
            $('#stateerr').text("");
        }
                     
        if ($("#cityid").val() === '') {
            $("#cityid").addClass('adminred');
            $('#cityerr').text("Please Select City!");
            valid = false;
        }
        else if (!$("#cityid").val().match(reg_letters)) {
            $("#cityid").addClass('adminred');
            $('#cityerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#cityid").removeClass('adminred');
            $('#cityerr').text("");
        }
                
        if ($("#district").val() !== '') {
            if (!$("#district").val().match(reg_letters)) {
                $("#district").addClass('adminred');
                $('#districterr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#district").removeClass('adminred');
                $('#districterr').text("");
            }
        }

        if ($("#village").val() !== '') {
            if (!$("#village").val().match(reg_letters)) {
                $("#village").addClass('adminred');
                $('#villageerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#village").removeClass('adminred');
                $('#villageerr').text("");
            }
        }

        if ($("#pincode").val() !== '') {
            if (!$("#pincode").val().match(reg_pin)) {
                $("#pincode").addClass('adminred');
                $('#pincodeerr').text("Please Enter Valid Pincode!");
                valid = false;
            }
            else {
                $("#pincode").removeClass('adminred');
                $('#pincodeerr').text("");
            }
        }

        if ($("#language").val() === '') {
            $("#language").addClass('adminred');
            $('#languageerr').text("Please Select Language!");
            valid = false;
        }
        else if (!$("#language").val().match(reg_letters)) {
            $("#language").addClass('adminred');
            $('#languageerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#language").removeClass('adminred');
            $('#languageerr').text("");
        }


        if ($("#imageUpload").val() !== '')
        {
            var ext = $('#imageUpload').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                $("#profileimgerr").text("Invalid,Should be an Image!");
                valid = false;
            }
            else {
                $("#imageUpload").removeClass('adminred');
                $('#profileimgerr').text("");
            }

        }

        if (valid === true) {
            var val = $('#countryid').val();            
            var countryid = $('#country_sugg option').filter(function () {
                return this.value === val;
            }).data('id');

            if (countryid === undefined || countryid === null) {
                if (country !== null) {
                    countryid = country;
                }else{
                    countryid = 0;
                }
            }

            var val = $('#stateid').val();            
            var stateid = $('#state_sugg option').filter(function () {
                return this.value === val;
            }).data('id');
            
            if (stateid === undefined || stateid === null) {
                if (state !== null) {
                    stateid = state;
                }else{
                    stateid = 0;
                }
            }
                        
            var val = $('#cityid').val();
            var cityid = $('#city_sugg option').filter(function () {
                return this.value === val;
            }).data('id');
            
            if (cityid === undefined || cityid === null) {
                if (city !== null) {
                    cityid = city;
                }else{
                    cityid = 0;
                }
            }
                               
            //alert(cityid)
            
            var val = $('#language').val();
            var langid = $('#lang_sugg option').filter(function () {
                return this.value === val;
            }).data('id');
            
            if (langid === undefined || langid === null) {
                if (language !== null) {
                    langid = language;
                }else{
                    langid = 0;
                }
            }
                       
            var role = 'bcp';

            var formdata = new FormData();

            formdata.append('username', $('#username').val());
            formdata.append('password', $('#password').val());
            formdata.append('email', $('#email').val());
            formdata.append('first_name', $('#fname').val());
            formdata.append('last_name', $('#lname').val());
            formdata.append('gender', $('input:radio:checked').val());
            formdata.append('signupdate', $('#signupdate').val());
            formdata.append('countryid', countryid);
            formdata.append('stateid', stateid);
            formdata.append('cityid', cityid);
            formdata.append('district', $('#district').val());
            formdata.append('village', $('#village').val());
            formdata.append('pincode', $('#pincode').val());
            formdata.append('mobile', $('#contact').val());
            formdata.append('alternate_contact_number', $('#altcontact').val());
            formdata.append('language_id', langid);
            formdata.append('profilePicture', $('#imageUpload')[0].files[0]);
            formdata.append('role', role);
            formdata.append('id', $('#bcpEditid').val());
            
            $.ajax({
                type: "POST",
                url: site_url + 'api/web/v1/ctrl/User/editBcp',
                contentType: false,
                data: formdata,
                processData: false,
                beforeSend: function () {
                    $('#bcpsubmit').attr('disabled', true);
                    load();
                },
                success: function (json) {
                    setTimeout($.unblockUI, 0001);
                    //console.log(json);
                    $('#bcpsubmit').attr('disabled', false);
                    if (json['status']) {
                        $('#bcp_sucess').html(json['response']['messages']).delay(3500).fadeOut(3000);
                        //$('#squarespaceModal').modal('hide');

                        window.location.reload();
                    }
                    else {
                        $("#profileimgerr").text(json['response']['messages']['profilePicture']);
                        $('#usernameerr').text(json['response']['messages']['username']);
                        $('#fnameerr').html(json['response']['messages']['first_name']);
                        $('#lnameerr').html(json['response']['messages']['last_name']);
                        $('#signupdateerr').html(json['response']['messages']['signupdate']);
                        $('gender').html(json['response']['messages']['gender']);
                        $('contacterr').html(json['response']['messages']['mobile']);
                    }

                }

            });


        }

    });

});

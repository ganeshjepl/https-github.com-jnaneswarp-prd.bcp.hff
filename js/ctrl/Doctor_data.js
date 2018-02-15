var country, state, city, language;

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
function adddoctor() {
    $("#doctorsubmit")[0].reset();
    $('#uname').show();
    $('#pass').show();
    $('#mail').removeClass('col-md-12');
    $('#mail').addClass('col-md-6');
    $('.error-msg-box').text('');
    $('.rmv').removeClass('adminred');
    var imgurl = imgs + "profile.jpg"
    $('#imagePreview').attr('src', imgurl);
    var imgurl = imgs + "profile.jpg"
    $('#signimagePreview').attr('src', imgurl);
    $('.multiselect-selected-text').html('None selected ');
}

$(document).ready(function () {

    $("#username").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#usernameerr').text("Please Enter User Name!");
        }
        else {
            $.ajax({
                type: "GET",
                url: site_url + "api/web/v1/ctrl/Doctor/checkUsername",
                data: {"username": $.trim($(this).val())},
                success: function (json) {

                    if (json['status'] == true) {
                        $('#usernameerr').text('');
                        $('#username').removeClass('adminred');
                        //$(this).removeClass('adminred');
                        $('#submit').attr('disabled', false);

                    } else {
                        $('#submit').attr('disabled', true);
                        $('#usernameerr').text(json['response']['messages']);
                    }
                }
            });

        }
    });

    $("#email").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#emailerr').text("Please Enter Email!");
        }
        else {
            $(this).removeClass('adminred');
            $('#emailerr').text("");
        }
    });

    $("#password").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#passworderr').text("Please Enter Password!");
        }
        else {
            $(this).removeClass('adminred');
            $('#passworderr').text("");
        }
    });

    $("#confpassword").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#confpassworderr').text("Please Enter Confirm Password!");
        }
        else {
            if ($("#password").val() != $("#confpassword").val()) {
                $('#confpassworderr').text("Please Enter Password and Confirm Password equql");
                $('#submit').attr('disabled', true);
            } else {
                $(this).removeClass('adminred');
                $('#confpassworderr').text("");
                $('#submit').attr('disabled', false);
            }
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
    $('input:radio').change(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#gendererr').text("Please Select Gender!");
        }
        else {
            $(this).removeClass('adminred');
            $('#gendererr').text("");
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


    $('#imageUpload').change(function () {
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
    $('#signimageUpload').change(function () {
        if ($("#signimageUpload").val() !== '')
        {
            var ext = $('#signimageUpload').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                $("#signimgerr").text("Invalid,Should be an Image!");
                valid = false;
            }
            else {
                $("#signimageUpload").removeClass('adminred');
                $('#signimgerr').text("");
            }

        }


    });

    /*
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
     */

    $("#doctorsubmit").submit(function (event) {
        event.preventDefault();
        var valid = true;
        var reg_letters_nospace = /^[a-zA-Z0-9@]+$/;
        var reg_letters = /^[a-zA-Z\s]+$/;
        var reg_email = /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
        //var reg_mobile = /^(\+91|\+91|0)?\d{10}$/;
        var reg_mobile = /^(([0|\+[0-9]{1,5})?([7-9][0-9]{9})|(\d{3}-)*\d{8})$/;
        var reg_pin = /^(?=.*[0-9])[^-\s]([a-zA-Z0-9 ]+(-[a-zA-Z0-9]+)?){1,14}$/;

        if ($("#doctorid").val() === '') {
            if ($("#username").val() === '') {
                $("#username").addClass('adminred');
                $('#usernameerr').text("Please Enter User Name!");
                valid = false;

            }
            else if (!$("#username").val().match(reg_letters_nospace)) {
                $("#username").addClass('adminred');
                $('#usernameerr').text("Please Enter Alphabets only and no Spaces!");
                valid = false;
            }
            else {
                $("#username").removeClass('adminred');
                $('#usernameerr').text("");
            }
            if ($("#password").val() === '') {
                $("#password").addClass('adminred');
                $('#passworderr').text("Please Enter Password!");
                valid = false;
            }
            else {
                $("#password").removeClass('adminred');
                $('#passworderr').text("");
            }

            if ($("#confpassword").val() === '') {
                $("#confpassword").addClass('adminred');
                $('#confpassworderr').text("Please Confirm Password!");
                valid = false;
            }
            else if (!$("#confpassword").val().match($("#password").val())) {
                $("#confpassword").addClass('adminred');
                $('#confpassworderr').text("Password and Confirm Password should match!");
                valid = false;
            }
            else {
                $("#confpassword").removeClass('adminred');
                $('#confpassworderr').text("");
            }

        }
        if ($("#email").val() === '') {
            $("#email").addClass('adminred');
            $('#emailerr').text("Please Enter Email!");
            valid = false;
        }
        else if (!$("#email").val().match(reg_email)) {
            $("#email").addClass('adminred');
            $('#emailerr').text("Please Enter Valid Email!");
            valid = false;
        }
        else {
            $("#email").removeClass('adminred');
            $('#emailerr').text("");
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
            $('#contacterr').text("Please Enter Numbers only!");
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
            $('#signupdateerr').text("Please Select date!");
            valid = false;
        }
        else {
            $("#signupdate").removeClass('adminred');
            $('#signupdateerr').text("");
        }
        /*
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
         */
        if ($("#countryid").val() !== '') {
            if (!$("#countryid").val().match(reg_letters)) {
                $("#countryid").addClass('adminred');
                $('#countryerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#countryid").removeClass('adminred');
                $('#countryerr').text("");
            }
        }


        if ($("#stateid").val() !== '') {
            if (!$("#stateid").val().match(reg_letters)) {
                $("#stateid").addClass('adminred');
                $('#stateerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#stateid").removeClass('adminred');
                $('#stateerr').text("");
            }
        }

        if ($("#cityid").val() !== '') {
            if (!$("#cityid").val().match(reg_letters)) {
                $("#cityid").addClass('adminred');
                $('#cityerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#cityid").removeClass('adminred');
                $('#cityerr').text("");
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

        if ($("#language").val() !== '') {
            if (!$("#language").val().match(reg_letters)) {
                $("#language").addClass('adminred');
                $('#languageerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#language").removeClass('adminred');
                $('#languageerr').text("");
            }
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

        if ($("#signimageUpload").val() !== '')
        {
            var ext = $('#signimageUpload').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                $("#signimgerr").text("Invalid,Should be an Image!");
                valid = false;
            }
            else {
                $("#signimageUpload").removeClass('adminred');
                $('#signimgerr').text("");
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

            var role = 'doctor';
            var values = [];
            $.each($("input[type='checkbox']:checked"), function () {
                values.push($(this).val());
            });
            // var values=$('#bcpassign').val();

            var formdata = new FormData();
            var profile_picture = $("#imageUpload")[0].files[0];

            formdata.append('profile_picture', profile_picture);
            var signimageUpload = $("#signimageUpload")[0].files[0];
            //formdata.append('signaturePicture', signimageUpload);
            formdata.append('signimageUpload', signimageUpload);

            formdata.append('password', $('#password').val());
            formdata.append('email', $('#email').val());
            formdata.append('first_name', $('#fname').val());
            formdata.append('last_name', $('#lname').val());
            formdata.append('gender', $('input:radio:checked').val());
            formdata.append('signupdate', $('#signupdate').val());
            formdata.append('countryid', countryid);
            formdata.append('stateid', stateid);
            formdata.append('cityid', cityid);
            formdata.append('pincode', $('#pincode').val());
            formdata.append('mobile', $('#contact').val());
            formdata.append('alternate_contact_number', $('#altcontact').val());
            formdata.append('language_id', langid);
            formdata.append('bcp_id', values);
            formdata.append('role', role);

            if ($("#doctorid").val() === '') {
                formdata.append('username', $('#username').val());
                ajaxurl = site_url + 'api/web/v1/ctrl/Doctor/insertDoctor';
            } else {
                formdata.append('doctorid', $('#doctorid').val());
                ajaxurl = site_url + 'api/web/v1/ctrl/Doctor/updateDoctor';
            }

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                contentType: false,
                data: formdata,
                processData: false,
                beforeSend: function () {
                    $('#doctorsubmit').attr('disabled', true);
                    load();

                },
                success: function (json) {
                    //$('#doctorsubmit').attr('disabled',false);
                    setTimeout($.unblockUI, 0000);

                    if (json['status'] == true) {

                        $('#doctor_sucess').html(json['response']['messages']).delay(2500).fadeOut('3000', function () {

                            $('#doctorsubmit').attr('disabled', false);
                            window.location.reload();
                        });
                    } else if (json['status'] === false) {
                        setTimeout($.unblockUI, 0000);

                        $('#doctor_error').html(json['response']['messages']);

                        $("#signimgerr").text(json['signature_picture']);
                        $("#profileimgerr").text(json['profile_picture']);
                        $('#usernameerr').text(json['username']);
                        $('#emailerr').html(json['email']);
                        $('#passworderr').html(json['password']);
                        $('#fnameerr').html(json['first_name']);
                        $('#lnameerr').html(json['last_name']);
                        $('#signupdateerr').html(json['signupdate']);
                        $('gender').html(json['gender']);
                    }

                }

            });
        }
    });
});

var app = angular.module('Hff', []);
app.controller('medicine', function ($scope, $http) {
    $scope.countries = [300];
    $scope.search = function () {
        $scope.RandomValue = angular.element('#medicine').val();
        $http({
            method: "get",
            url: site_url + 'api/mobile/v1/Country/searchCountry?name=' + $scope.RandomValue
        }).then(function (response, status) {

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

    };
});
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

});

app.controller('state', function ($scope, $http) {
    $scope.statesearch = function () {
        var len = $('#stateid').val();
        if (len.length >= 2)
            statesearch();
    };
    function statesearch() {

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
        
        $scope.RandomValue = angular.element('#stateid').val();
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
            var i = 0;
            while (i <= len) {
                if(state_res.response.stateData[i] !==""){
                    ///alert(i)
                    $scope.states.push(state_res.response.stateData[i]);
                }
                i++;                
            }
            

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



function deleteDoctor(id) {
    var x = confirm("Are you sure you want to delete?");
    if (x) {
        $.ajax({
            type: "POST",
            url: site_url + "api/web/v1/ctrl/Doctor/deleteDoctor",
            data: {"id": id},
            success: function (json) {


                if (json['status'] == true) {
                    $("#sucess_msg").show();

                    $("#sucess_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function () {
                    });
                    $("#doctordelete" + id).hide();


                } else {
                    $("#error_msg").show();
                    $("#error_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function () {
                    });

                }
            }
        });
    }

}
angular.module('inputChange', [])
        .controller('TextInputController', ['$scope', function ($scope) {
                var inputMin = 3;
                $scope.someVal = '';
                $scope.result = '';
                $scope.textChanged = function () {
                    if ($scope.someVal.length >= inputMin)
                        executeSomething()
                    else
                        $scope.result = '';
                };

                function executeSomething() {
                    $scope.result = $scope.someVal;
                }
                ;
            }]);
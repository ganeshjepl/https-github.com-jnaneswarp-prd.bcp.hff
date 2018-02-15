
function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function getDOB(age) {
    var today = new Date();
    var date = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();
    var dobyear = year - age;
    var dob = dobyear + '-' + month + '-' + date;
    return dob;
}
function modalload() {
    document.getElementById('id01').style.display = 'block';
}

$(document).ready(function (event) {
    $("#country").keypress(function () {
        $("#state").val = "";
        $("#city").val = "";
    });
    var reg_age = /^(0?[0-9]{1,2}|1[0-0][0-9]|110)$/;
    $("#age").keyup(function () {

        $("#datepickerdob").val("");
        var ag = $("#age").val();
        $("#datepickerdob").val("");
        if ($("#age").val().match(reg_age)) {
            $("#datepickerdob").val(getDOB(ag));
            $(this).removeClass("validred");
            //$("#datepickerdob").addClass("validgreen");
            $("#doberr").text("");
            $(this).removeClass("validred");
            //$("#age").addClass("validgreen");
            $("#ageerr").text("");
        }
        else {
            $("#datepickerdob").css("border-color", "#ccc");
            $("#ageerr").text("Age limit is 110");
        }
    });

    $("#salute").change(function () {
        if ($("#salute").val() === 'mr') {
            $('#radio1').prop('checked', true);
            //$('#radio2').attr('checked',false);
        }
        else if ($("#salute").val() === 'mrs' || $("#salute").val() === 'miss') {
            $('#radio2').prop('checked', true);
            //$('#radio1').attr('checked',false);
        }

    });

    $('input[name=item]').change(function () {
        if ($("#radio1").is(":checked")) {
            $("#salute").val("mr");
        }
        else {
            $("#salute").val("miss");
        }
    });

    $("#typeofid").change(function () {
        if ($('#typeofid').val() !== "") {
            $("#idno").prop('disabled', false);
        }
        else if ($('#typeofid').val() === "") {

            $("#idno").removeClass("validred");
            $("#idnoerr").text("");
            $("#idno").prop('disabled', true);
        }
    });

    $("#idno").keypress(function () {

        if ($("#typeofid") === 'adhaar') {
            var $this = $(this);
            if ((($this.val().length + 1) % 5) === 0) {
                $this.val($this.val() + " ");
            }
            $("#idno").removeClass("validred");
            $("#idno").addClass("validgreen");
            $("#idnoerr").text("");
        }
    });

    //event.preventDefault();
    $("#datepicker").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#dateerr").text("Please select date!");
            $("#req_regdate").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $("#datepicker").addClass("validgreen");
            $("#dateerr").text("");
            $("#req_regdate").text("");
        }
    });

    $("#salute").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#saluteerr").text("Please select salutation!");
            $("#req_salute").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#saluteerr").text("");
            $("#req_salute").text("");

        }
    });

    $("#fname").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            ;
            $("#fnameerr").text("Please enter First name!");
            $("#req_fname").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#fnameerr").text("");
            $("#req_fname").text("");

        }

    });

    $("#lname").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#lnameerr").text("Please enter Last name!");
            $("#req_lname").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#lnameerr").text("");
            $("#req_lname").text("");

        }
    });
    $("#guardianname").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#gnameerr").text("");
        }
    });
    $("#relation").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#relationerr").text("");
        }
    });
    $("#datepickerdob").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#doberr").text("");
        }
    });
    $("#age").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#ageerr").text("");
        }
    });
    $("#marital").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#maritalerr").text("Please select Marital Status!");
            $("#req_marital").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#maritalerr").text("");
            $("#req_salute").text("");

        }
    });

    $("#caste").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#casteerr").text("");
        }
        else {
            $("#caste").removeClass("validred");
        }
    });
    $("#religion").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#religionerr").text("");
        }
    });
    $("#education").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#educationerr").text("");
        }
    });
    $("#occupation").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#occupationerr").text("");
        }
    });
    $("#image").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#imageerr").text("");
        }
    });
    // alert($(this).val());

    $("#hno").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#hnoerr").text("Please enter House No!");
            $("#req_hno").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#hnoerr").text("");
            $("#req_hno").text("");

        }
    });

    $("#street").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#streeterr").text("Please enter Street!");
            $("#req_street").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#streeterr").text("");
            $("#req_street").text("");

        }
    });

    $("#area").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#areaerr").text("Please enter Area!");
            $("#req_area").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#areaerr").text("");
            $("#req_area").text("");

        }
    });

    $("#village").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#villageerr").text("");
        }
    });

    $("#country").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#countryerr").text("Please select country!");
            $("#req_country").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#countryerr").text("");
            $("#req_country").text("");

        }
    });

    $("#state").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#stateerr").text("Please select state!");
            $("#req_state").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#stateerr").text("");
            $("#req_state").text("");

        }
    });

    $("#city").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#cityerr").text("Please select City!");
            $("#req_city").text("*");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#cityerr").text("");
            $("#req_city").text("");

        }
    });
    $("#pincode").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#pincode").removeClass("validred");
            $("#pincodeerr").text("");
        }
        else {
            $("#pincode").removeClass("validred");
            $("#pincodeerr").text("");
        }
    });
    $("#contact").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#contacterr").text("");
        }
    });
    $("#altcontact").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#altcontacterr").text("");
        }
    });
    $("#emergname").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#emergnameerr").text("");
        }
    });
    $("#emergrelation").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#emergrelationerr").text("");
        }
    });
    $("#emergcontact").focusout(function () {
        if ($(this).val() === '') {
            $(this).css("border-color", "#ccc");
            $("#emergcontacterr").text("");
        }
    });

    $("#idno").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass("validred");
            $("#idnoerr").text("Please enter ID No!");
        }
        else
        {
            $(this).removeClass("validred");
            $(this).addClass("validgreen");
            $("#idnoerr").text("");

        }
    });
    //});


    $("#form").submit(function (event) {
        // event.preventDefault();
        var reg_letters = /^[a-zA-Z]+$/;
        var reg_hno = /^[- . , _ \/ ]*[0-9a-z][- . , _\/0-9a-z]*$/;
        var reg_block = /^[- \/ ]*[0-9a-zA-Z][- . , _\/0-9a-zA-Z]*$/;
        var reg_street = /^[- . , : _ \/ ]*[0-9a-zA-Z][- . , : _\/0-9a-zA-Z]*$/i;
        var reg_pin = /^(?=.*[0-9])[^-\s]([a-zA-Z0-9 ]+(-[a-zA-Z0-9]+)?){1,14}$/;
        var reg_mobile = /^[7 8 9]\d{9}$/;
        var reg_adhaar = /^\d{4}\s\d{4}\s\d{4}$/;
        var reg_letterspace = /^[a-zA-Z ]*$/;
        var valid = true;


        if ($("#datepicker").val() === '')
        {
            $("#datepicker").addClass("validred");
            ;
            $("#dateerr").text("Please select date!");
            $("#req_regdate").text("*");
            $("#country").focus();
            $("#datepicker").change(function () {
                $("#datepicker").removeClass("validred");
                $("#datepicker").addClass("validgreen");
                $("#dateerr").text("");
                $("#req_regdate").text("");
            });
            valid = false;

        }
        if ($("#salute").val() === '')
        {
            $("#salute").addClass("validred");
            $("#saluteerr").text("Please select salutation!");
            $("#req_salute").text("*");
            $("#salute").focus();
            $("#salute").change(function () {
                $(this).removeClass("validred");
                $("#salute").addClass("validgreen");
                $("#saluteerr").text("");
                $("#req_salute").text("");
            });
            valid = false;

        }

        if ($("#fname").val() === '')
        {
            $("#fname").addClass("validred");
            $("#fnameerr").text("Please enter First name!");
            $("#req_fname").text("*");
            $("#fname").focus();
            $("#fname").keypress(function () {
                $(this).removeClass("validred");
                $("#fname").addClass("validgreen");
                $("#fnameerr").text("");
                $("#req_fname").text("");
            });
            valid = false;
        }

        else if (!$("#fname").val().match(reg_letters) || $("#fname").val().length === 0)
        {
            $("#fname").addClass("validred");
            $("#fnameerr").text("Please enter only Alphabets no spaces!");
            $("#req_fname").text("*");
            $("#fname").focus();
            $("#fname").keypress(function () {
                $(this).removeClass("validred");
                $("#fname").addClass("validgreen");
                $("#fnameerr").text("");
                $("#req_fname").text("");
            });
            valid = false;
        }

        if ($("#mname").val() !== '')
        {
            if (!$("#mname").val().match(reg_letters)) {
                valid = false;
                $("#mname").addClass("validred");
                $("#mnameerr").text("Please enter Alphabets!");
                $("#mname").focusout(function () {
                    $(this).removeClass("validred");
                    $("#mnameerr").text("");
                });
                $("#mname").keypress(function () {
                    $(this).removeClass("validred");
                    $("#mname").addClass("validgreen");
                    $("#mnameerr").text("");
                });

            }

        }
        if ($("#lname").val() === '')
        {
            $("#lname").addClass("validred");
            $("#lnameerr").text("Please enter Last name!");
            $("#req_lname").text("*");
            $("#lname").focus();
            $("#lname").keypress(function () {
                $(this).removeClass("validred");
                $("#lname").addClass("validgreen");
                $("#lnameerr").text("");
                $("#req_lname").text("");
            });
            valid = false;

        }
        else if (!$("#lname").val().match(reg_letters) || $("#lname").val().length === 0)
        {
            $("#lname").addClass("validred");
            $("#lnameerr").text("Please enter only Alphabets!");
            $("#req_lname").text("*");
            $("#lname").focus();
            $("#lname").keypress(function () {
                $(this).removeClass("validred");
                $("#lname").addClass("validgreen");
                $("#lnameerr").text("");
                $("#req_lname").text("");
            });
            valid = false;

        }
        if ($("#guardianname").val() !== '')
        {
            if (!$("#guardianname").val().match(reg_letters))
            {
                $("#guardianname").addClass("validred");
                $("#gnameerr").text("Please enter only Alphabets!");
                $("#guardianname").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#guardianname").keypress(function () {
                    $(this).removeClass("validred");
                    $("#guardianname").addClass("validgreen");
                    $("#gnameerr").text("");
                    $("#relation").css("border-color", "#ccc");
                    //$("#relation option:Relation'").prop('selected',true);
                    //$('#relation').html('<option value="">Relation</option>');
                    $("#relationerr").text("");
                });
                valid = false;
                //alert("mname is"+valid);

            } else {
                if ($("#relation").val() === '')
                {
                    $("#relation").addClass("validred");
                    $("#relationerr").text("Please select Relation!");
                    $("#relation").change(function () {
                        $(this).removeClass("validred");
                        $("#relation").addClass("validgreen");
                        $("#relationerr").text("");
                    });
                    valid = false;
                }
            }
        }
        else {
            $('#relation').val("");
            $("#relationerr").text("");
            $("#relation").removeClass("validred");
            //$("#relation").addClass("validgreen");
            $("#relationerr").text("");
        }

        if ($("#datepickerdob").val() === '')
        {
            $("#age").val("");

        }
        else {
            $("#datepickerdob").removeClass("validred");
            $("#age").addClass("validgreen");
            $("#ageerr").text("");

        }


        if ($("#marital").val() === '')
        {
            $("#marital").addClass("validred");
            $("#maritalerr").text("Please select Marital Status!");
            $("#req_marital").text("*");
            $("#marital").focus();
            $("#marital").change(function () {
                $(this).removeClass("validred");
                $("#marital").addClass("validgreen");
                $("#maritalerr").text("");
                $("#req_marital").text("");
            });
            valid = false;

        }

        if ($("#caste").val() !== '')
        {
            if (!$("#caste").val().match(reg_letters) || $("#caste").val().length === 0)
            {
                $("#caste").addClass("validred");
                $("#casteerr").text("Please enter only Alphabets!");
                $("#caste").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#caste").keypress(function () {
                    $(this).removeClass("validred");
                    $("#caste").addClass("validgreen");
                    $("#casteerr").text("");
                });
                valid = false;
            }
        }

        if ($("#religion").val() !== '')
        {
            if (!$("#religion").val().match(reg_letters) || $("#religion").val().length === 0)
            {
                $("#religion").addClass("validred");
                $("#religionerr").text("Please enter only Alphabets!");
                $("#religion").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#religion").keypress(function () {
                    $(this).removeClass("validred");
                    $("#religion").addClass("validgreen");
                    $("#religionerr").text("");
                });
                valid = false;
            }
        }

        if ($("#occupation").val() !== '')
        {
            if (!$("#occupation").val().match(reg_letters) || $("#occupation").val().length === 0)
            {
                $("#occupation").addClass("validred");
                $("#occupationerr").text("Please enter only Alphabets!");
                $("#occupation").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#occupation").keypress(function () {
                    $(this).removeClass("validred");
                    $("#occupation").addClass("validgreen");
                    $("#occupationerr").text("");
                });
                valid = false;
            }
        }
        if ($("#hno").val() === '')
        {
            $("#hno").addClass("validred");
            $("#hnoerr").text("Please enter House no!");
            $("#req_hno").text("*");
            $("#hno").focus();
            $("#hno").keypress(function () {
                $(this).removeClass("validred");
                $("#hno").addClass("validgreen");
                $("#hnoerr").text("");
                $("#req_hno").text("");
            });
            valid = false;
        }
        else if (!$("#hno").val().match(reg_hno) || $("#hno").val().length === 0)
        {
            $("#hno").addClass("validred");
            $("#hnoerr").text("Only numbers,alphabets,'-' '. ,' are allowed!");
            $("#req_hno").text("*");
            $("#hno").focus();
            $("#hno").keypress(function () {
                $(this).removeClass("validred");
                $("#hno").addClass("validgreen");
                $("#hnoerr").text("");
                $("#req_hno").text("");
            });
            valid = false;
        }
        if ($("#block").val() !== '')
        {
            if (!$("#block").val().match(reg_block)) {
                $("#block").addClass("validred");
                $("#blockerr").text("Please enter only Numbers and Alphabets!");
                $("#block").focusout(function () {
                    $(this).removeClass("validred");
                    $("#blockerr").text("");
                });
                $("#block").keypress(function () {
                    $(this).removeClass("validred");
                    $("#block").addClass("validgreen");
                    $("#blockerr").text("");
                });
                valid = false;
            }
        }

        if ($("#street").val() === '')
        {
            $("#street").addClass("validred");
            $("#streeterr").text("Please enter Street!");
            $("#req_street").text("*");
            $("#street").focus();
            $("#street").keypress(function () {
                $(this).removeClass("validred");
                $("#street").addClass("validgreen");
                $("#streeterr").text("");
                $("#req_street").text("");
            });
            valid = false;
        }
        else if (!$("#street").val().match(reg_street) || $("#street").val().length === 0)
        {
            $("#street").addClass("validred");
            $("#streeterr").text("Only Numbers,Alphabets '.' ':' '_' are Allowed!");
            $("#req_street").text("*");
            $("#street").focus();
            $("#street").keypress(function () {
                $(this).removeClass("validred");
                $("#street").addClass("validgreen");
                $("#streeterr").text("");
                $("#req_street").text("");
            });
            valid = false;
        }
        if ($("#area").val() === '')
        {
            $("#area").addClass("validred");
            $("#areaerr").text("Please enter Area!");
            $("#req_area").text("*");
            $("#area").focus();
            $("#area").keypress(function () {
                $(this).removeClass("validred");
                $("#area").addClass("validgreen");
                $("#areaerr").text("");
                $("#req_area").text("");
            });
            valid = false;
        }
        else if (!$("#area").val().match(reg_letters) || $("#area").val().length === 0)
        {
            $("#area").addClass("validred");
            $("#areaerr").text("Please enter only Alphabets!");
            $("#req_area").text("*");
            $("#area").focus();
            $("#area").keypress(function () {
                $(this).removeClass("validred");
                $("#area").addClass("validgreen");
                $("#areaerr").text("");
                $("#req_area").text("");
            });
            valid = false;
        }
        if ($("#village").val() !== '')
        {
            if (!$("#village").val().match(reg_letters) || $("#village").val().length === 0)
            {
                $("#village").addClass("validred");
                $("#villageerr").text("Please enter only Alphabets!");
                $("#village").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#village").keypress(function () {
                    $(this).removeClass("validred");
                    $("#village").addClass("validgreen");
                    $("#villageerr").text("");
                });
                valid = false;
            }
        }
        if ($("#country").val() === '')
        {
            $("#country").addClass("validred");
            $("#countryerr").text("Please select Country!");
            $("#req_country").text("*");
            $("#country").focus();
            $("#country").change(function () {
                $(this).removeClass("validred");
                $("#country").addClass("validgreen");
                $("#countryerr").text("");
                $("#state").text("");
                $("#city").text("");
            });
            valid = false;
        }
        else if (!$("#country").val().match(reg_letterspace) || $("#country").val().length === 0)
        {
            $("#country").addClass("validred");
            $("#countryerr").text("Please enter only Alphabets!");
            $("#req_country").text("*");
            $("#country").focus();
            $("#country").keypress(function () {
                $(this).removeClass("validred");
                $("#country").addClass("validgreen");
                $("#countryerr").text("");
                $("#req_country").text("");
            });
            valid = false;
        }
        if ($("#state").val() === '')
        {
            $("#state").addClass("validred");
            $("#stateerr").text("Please select State!");
            $("#req_state").text("*");
            $("#state").focus();
            $("#state").change(function () {
                $(this).removeClass("validred");
                $("#state").addClass("validgreen");
                $("#stateerr").text("");
                $("#req_state").text("*");
            });
            valid = false;
        }
        else if (!$("#state").val().match(reg_letterspace) || $("#state").val().length === 0)
        {
            $("#state").addClass("validred");
            $("#stateerr").text("Please enter only Alphabets!");
            $("#req_state").text("*");
            $("#state").focus();
            $("#state").keypress(function () {
                $(this).removeClass("validred");
                $("#state").addClass("validgreen");
                $("#stateerr").text("");
                $("#req_state").text("");
            });
            valid = false;
        }
        if ($("#city").val() === '')
        {
            $("#city").addClass("validred");
            $("#cityerr").text("Please select City!");
            $("#req_city").text("*");
            $("#city").focus();
            $("#city").change(function () {
                $(this).removeClass("validred");
                $("#city").addClass("validgreen");
                $("#cityerr").text("");
                $("#req_city").text("");
            });
            valid = false;
        }
        else if (!$("#city").val().match(reg_letters) || $("#city").val().length === 0)
        {
            $("#city").addClass("validred");
            $("#cityerr").text("Please enter only Alphabets!");
            $("#req_city").text("*");
            $("#city").focus();
            $("#city").keypress(function () {
                $(this).removeClass("validred");
                $("#city").addClass("validgreen");
                $("#cityerr").text("");
                $("#req_city").text("");
            });
            valid = false;
        }
        if ($("#pincode").val() !== '')
        {
            if (!$("#pincode").val().match(reg_pin) || $("#pincode").val().length === 0)
            {
                $("#pincode").addClass("validred");
                $("#pincodeerr").text("Should not begin or end with space.Allows only numbers alphabets,'-' and atleast 1 number!");
                $("#pincode").keypress(function () {
                    $(this).removeClass("validred");
                    $("#pincode").addClass("validgreen");
                    $("#pincodeerr").text("");
                });
                valid = false;
            }
            else {
                $("#pincode").removeClass("validred");
                $("#pincode").addClass("validgreen");
                $("#pincodeerr").text("");
            }
        }
        else {
            // $("#pincode").css("border-color", "#ccc");
            $("#pincode").removeClass("validred");
            $("#pincodeerr").text("");
        }
        if ($("#contact").val() !== '')
        {
            if (!$("#contact").val().match(reg_mobile) || $("#contact").val().length === 0)
            {
                $("#contact").addClass("validred");
                $("#contacterr").text("Please enter only 10 digit Contact number starting with 7 8 9!");
                $("#contact").change(function () {
                    $(this).removeClass("validred");
                    $("#contact").addClass("validgreen");
                    $("#contacterr").text("");
                });
                valid = false;
            }
        }
        if ($("#altcontact").val() !== '')
        {
            if (!$("#altcontact").val().match(reg_mobile) || $("#altcontact").val().length === 0)
            {
                $("#altcontact").addClass("validred");
                $("#altcontacterr").text("Please enter only 10 digit Contact number starting with 7 8 9!");
                $("#altcontact").change(function () {
                    $(this).removeClass("validred");
                    $("#altcontact").addClass("validgreen");
                    $("#altcontacterr").text("");
                });
                valid = false;
            }
        }
        else {
            $(this).removeClass("validred");
            $("#altcontacterr").text("");
        }
        if ($("#typeofid").val() === 'adhaar')
        {
            if (!$("#idno").val().match(reg_adhaar) || $("#idno").val().length === 0)
            {
                $("#idno").addClass("validred");
                $("#idnoerr").text("Please enter only 12 digit Adhaar number!");
                $("#idno").keypress(function () {
                    var $this = $(this);
                    if ((($this.val().length + 1) % 5) === 0) {
                        $this.val($this.val() + " ");
                    }
                    $("#idno").removeClass("validred");
                    $("#idno").addClass("validgreen");
                    $("#idnoerr").text("");
                });
                valid = false;
            }
        }
        else if ($("#typeofid").val() === 'pan') {

            var reg_pan = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (!$("#idno").val().match(reg_pan)) {
                $("#idnoerr").text("Please enter valid Pan number");
                $("#idno").addClass("validred");
            }
            else {
                $("#idnoerr").text("");
                $("#idno").removeClass("validred");
            }

        }
        else if ($("#typeofid").val() === 'voterid') {

            var reg_voter = /^([a-zA-Z]{3})(\d{7})$/;
            if (!$("#idno").val().match(reg_voter)) {
                $("#idnoerr").text("Please enter valid Voter ID");
                $("#idno").addClass("validred");
            }
            else {
                $("#idnoerr").text("");
                $("#idno").removeClass("validred");
            }

        }

        else {
            $("#idno").css("border-color", "#ccc");
            $("#idnoerr").text("");
        }
        if ($("#emergname").val() !== '')
        {
            if (!$("#emergname").val().match(reg_letters) || $("#emergname").val().length === 0)
            {
                $("#emergname").addClass("validred");
                $("#emergnameerr").text("Please enter only Alphabets!");
                $("#emergname").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#emergname").keypress(function () {
                    $(this).removeClass("validred");
                    $("#emergname").addClass("validgreen");
                    $("#emergnameerr").text("");
                });
                valid = false;
            }

        }
        if ($("#emergcontact").val() !== '')
        {
            if (!$("#emergcontact").val().match(reg_mobile) || $("#emergcontact").val().length === 0)
            {
                $("#emergcontact").addClass("validred");
                $("#emergcontacterr").text("Please enter only 10 digit Contact number starting with 7 8 9!");
                $("#emergcontact").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#emergcontact").keypress(function () {
                    $(this).removeClass("validred");
                    $("#emergcontact").addClass("validgreen");
                    $("#emergcontacterr").text("");
                });
                valid = false;
            }
        }
        else {
            $("#emergcontact").removeClass("validred");
            $("#emergcontacterr").text("");
        }
        if ($("#emergrelation").val() !== '') {
            if (!$("#emergrelation").val().match(reg_letters) || $("#emergrelation").val().length === 0)
            {
                $("#emergrelation").addClass("validred");
                $("#emergrelationerr").text("Please enter only Alphabets!");
                $("#emergrelation").focusout(function () {
                    $(this).removeClass("validred");
                });
                $("#emergrelation").keypress(function () {
                    $(this).removeClass("validred");
                    $("#emergrelation").addClass("validgreen");
                    $("#emergrelationerr").text("");
                });
                valid = false;
            }
        }
//        if ($("#image").val() !== '')
//        {
            if ($("#image").val() !== '')
            {
                var ext = $('#image').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                    $("#imageerr").text("Invalid,Should be an Image!");
                    valid = false;
                }

            }

        
        event.preventDefault();

        var val = $('#country').val();
        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');

        if (countryid === undefined) {
            var gt = $("#count").data('data-id');
            countryid = gt;
            //alert(countryid);
        }

        var val = $('#state').val();
        var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        // alert(stateid);

        if (stateid === undefined) {
            var stategt = $("#stategt").data('data-ids');
            stateid = stategt;
            //alert(stateid);
        }

        var val = $('#city').val();
        var cityid = $('#city_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        // alert(cityid);
        if (cityid === undefined) {
            var citygt = $("#citygt").data('data-idss');
            cityid = citygt;
            // alert(cityid);
        }

        var formData = new FormData();
        formData.append('patientDetails[profilePicture]', $('#image')[0].files[0]);
        formData.append('patientDetails[registrationDate]', $('#datepicker').val());
        formData.append('patientDetails[title]', $('#salute').val());
        formData.append('patientDetails[firstName]', $('#fname').val());
        formData.append('patientDetails[middleName]', $('#mname').val());
        formData.append('patientDetails[lastName]', $('#lname').val());
        formData.append('patientDetails[guardianName]', $('#guardianname').val());
        formData.append('patientDetails[guardianRelation]', $('#relation').val());
        formData.append('patientDetails[dateofBirth]', $('#datepickerdob').val());
        formData.append('patientDetails[age]', $('#age').val());
        formData.append('patientDetails[gender]', $('input[name=item]:checked').val());
        formData.append('patientDetails[maritalStatus]', $('#marital').val());
        formData.append('patientDetails[caste]', $('#caste').val());
        formData.append('patientDetails[religion]', $('#religion').val());
        formData.append('patientDetails[education]', $('#education').val());
        formData.append('patientDetails[occupation]', $('#occupation').val());
        formData.append('patientDetails[houseNo]', $('#hno').val());
        formData.append('patientDetails[block]', $('#block').val());
        formData.append('patientDetails[streetName]', $('#street').val());
        formData.append('patientDetails[area]', $('#area').val());
        formData.append('patientDetails[villageName]', $('#village').val());
        formData.append('patientDetails[countryId]', countryid);
        formData.append('patientDetails[stateId]', stateid);
        formData.append('patientDetails[cityId]', cityid);
        formData.append('patientDetails[pincode]', $('#pincode').val());
        formData.append('patientDetails[contactNumber]', $('#contact').val());
        formData.append('patientDetails[alternateContactNumber]', $('#altcontact').val());
        formData.append('patientDetails[idProofType]', $('#typeofid').val());
        formData.append('patientDetails[idProofNo]', $('#idno').val());
        formData.append('patientDetails[emergencyContactName]', $('#emergname').val());
        formData.append('patientDetails[emergencyContactRelation]', $('#emergrelation').val());
        formData.append('patientDetails[emergencyContactNumber]', $('#emergcontact').val());


        if (valid === true) {
            $.ajax({
                url: site_url + 'api/mobile/v1/Patient/patientRegistration',
                type: 'POST',
                contentType: false,
                data: formData,
                processData: false,
                accept: {
                    javascript: 'application/javascript'
                },
                beforeSend: function () {
                    $.blockUI({css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }});
                },
                success: function (data) {
                    $.unblockUI();
                    $("#submit").attr("disabled", true);
                    console.log(data.response);
                    $("#mrnumber").text(data.response.data.medicalRegistrationCode);
                    $("#data").text(data.response.messages);
                    modalload();

                },
                error: function (xhr, status, error) {
                    console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);
                    var err = JSON.parse(xhr.responseText);
                    console.log(err.response.messages);
                    $("#dateerr").text(err.response.messages.registrationDate);
                    $("#saluteerr").text(err.response.messages.title);
                    $("#fnameerr").text(err.response.messages.firstName);
                    $("#mnameerr").text(err.response.messages.middleName);
                    $("#lnameerr").text(err.response.messages.lastName);
                    $("#gnameerr").text(err.response.messages.guardianName);
                    $("#doberr").text(err.response.messages.dateofBirth);
                    $("#casteerr").text(err.response.messages.caste);
                    $("#religionerr").text(err.response.messages.religion);
                    $("#educationerr").text(err.response.messages.education);
                    $("#occupationerr").text(err.response.messages.occupation);
                    $("#blockerr").text(err.response.messages.block);
                    $("#hnoerr").text(err.response.messages.houseNo);
                    $("#streeterr").text(err.response.messages.streetName);
                    $("#areaerr").text(err.response.messages.area);
                    $("#countryerr").text(err.response.messages.countryId);
                    $("#stateerr").text(err.response.messages.stateId);
                    $("#cityerr").text(err.response.messages.cityId);
                    $("#pincodeerr").text(err.response.messages.cityId);
                    $("#contacterr").text(err.response.messages.contactNumber);
                    $("#altcontacterr").text(err.response.messages.alternateContactNumber);
                    $("#emergnameerr").text(err.response.messages.emergencyContactName);
                    $("#emergrelationerr").text(err.response.messages.emergencyContactRelation);
                    $("#emergcontacterr").text(err.response.messages.emergencyContactNumber);

                }

                 
             
                 
              
            });
        }


    });
});


var app = angular.module('Hff', []);
app.controller('country', function ($scope, $http) {
    $scope.countries = [300];
    $scope.search = function () {
        $scope.RandomValue = angular.element('#country').val();
        $http({
            method: "get",
            url: site_url + 'api/mobile/v1/Country/searchCountry?name=' + $scope.RandomValue
        }).then(function (response, status) {

            $scope.country = JSON.stringify(response.data);
            var array = JSON.parse($scope.country);
//     var arr = jQuery.makeArray(array.response.countryData);
            var len = Object.keys(array.response.countryData).length;
            var i = 0;
            $scope.countries.length = 0;
            while (i < len) {
                $scope.countries.push(array.response.countryData[i]);
                i++;

            }
        }, function myError(response) {
            $scope.err = response.statusText;

        });

    };
});

app.controller('state', function ($scope, $http) {
    $scope.searchstate = function () {
        // var countryid = angular.element('#country').val();
        //alert($("#country_sugg option").attr('data-id'));
        var val = $('#country').val();
        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        if (countryid === undefined) {
            var gt = $("#count").data('data-id');
            countryid = gt;
        }
        $scope.states = [100];


        $http({
            method: "get",
            url: site_url + 'api/mobile/v1/States/statesByCountry?id=' + countryid
        }).then(function (response) {

            var state_res = response.data;
            var len = Object.keys(state_res.response.stateData).length;
            var i = 0;
            while (i <= len) {
                $scope.states.push(state_res.response.stateData[i]);

                i++;

            }

        }, function myError(response) {
            $scope.err = response.statusText;

        });
    };
});

app.controller('city', function ($scope, $http) {
    $scope.searchcity = function () {

        var val = $('#state').val();
        var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
        }).data('id');

        if (stateid === undefined) {
            var stategt = $("#stategt").data('data-ids');
            stateid = stategt;
        }

        //alert(stateid);
        $scope.cities = [];

        $http({
            method: "get",
            url: site_url + "api/mobile/v1/Cities/citiesByState?id=" + stateid
        }).then(function (response) {
            var city_res = response.data;

            var len = Object.keys(city_res.response.cityData).length;
            var i = 0;
            while (i <= len) {
                $scope.cities.push(city_res.response.cityData[i]);
                i++;

            }


        }, function myError(response) {
            $scope.err = response.statusText;


        });


    };
});

 $(function() {
    
    $( "#datepicker" ).datepicker({  maxDate: new Date(), dateFormat: 'yy-m-dd',
        onSelect: function(datetext){
            var d = new Date(); // for now
            var h = d.getHours();
            h = (h < 10) ? ("0" + h) : h ;

            var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

            var s = d.getSeconds();
            s = (s < 10) ? ("0" + s) : s ;

          datetext = datetext + " " + h + ":" + m + ":" + s;
           $('#datepicker').val(datetext);
           
        }
    });
     
    $('#datepickerdob').datepicker({
    onSelect: function(value) {
        var today = new Date(), 
            dob = new Date(value), 
            age = new Date(today - dob).getFullYear() - 1970;
        
        $('#age').val(age);
        $("#age").css("border-color", "#2eb82e");
        $("#ageerr").text("");
        $("#datepickerdob").css("border-color", "#2eb82e");
        $("#doberr").text("");
    },
    maxDate: '+0d',
    dateFormat:'yy-mm-dd',
    yearRange: '-100:+1',
    changeMonth: true,
    changeYear: true
});
var dob = new Date(dob);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
$('#age').html(age+' years old');

var d = new Date(); // for now
            var yy=d.getFullYear();
            var mm=d.getMonth()+1;
            var dd=d.getDate();
            var h = d.getHours();
            h = (h < 10) ? ("0" + h) : h ;

            var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

            var s = d.getSeconds();
            s = (s < 10) ? ("0" + s) : s ;

         var datetext = yy+"-"+mm+"-"+dd+ " " + h + ":" + m + ":" + s;
        
             $('#datepicker').val(datetext);
         });
 
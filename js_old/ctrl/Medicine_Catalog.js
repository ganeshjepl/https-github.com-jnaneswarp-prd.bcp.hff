function addMedicine() {
    $("#medicinesubmit")[0].reset();
    $('#exdate').addClass('col-md-6');
    $('#exdate').removeClass('col-md-12');
    $('#qnt').show();
    $('.error-msg-box').text('');
    $('.rmv').removeClass('adminred');
}

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

$(document).ready(function () {

    $("#name").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#nameerr').text("Please Enter Medicine Name!");
        }
        else {
            $(this).removeClass('adminred');
            $('#nameerr').text("");
        }
    });

    $("#expiry_date").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#expiry_dateerr').text("Please Select Expiry Date!");
        }
        else {
            $(this).removeClass('adminred');
            $('#expiry_dateerr').text("");
        }
    });

    $("#quantity").focusout(function () {
        if ($(this).val() === '') {
            $(this).addClass('adminred');
            $('#quantityerr').text("Please Enter Quantity!");
        }
        else {
            $(this).removeClass('adminred');
            $('#quantityerr').text("");
        }
    });

    $("#medicinesubmit").submit(function (event) {
        event.preventDefault();
        var valid = true;
        var alphanumeric = /^[a-zA-Z0-9\s]+$/;
        var reg_letters = /^[a-zA-Z\s]+$/;
        var reg_numbers = /^[0-9]*$/;
        var reg_alphanumeric = /^[a-zA-Z0-9 ]*$/;
        var comma_string = /^[a-zA-Z, ]+$/;


        if ($("#name").val() === '') {
            $("#name").addClass('adminred');
            $('#nameerr').text("Please Enter Medicine Name!");
            valid = false;
        }
        else if (!$("#name").val().match(reg_letters)) {
            $("#name").addClass('adminred');
            $('#nameerr').text("Please Enter Alphabets only!");
            valid = false;
        }
        else {
            $("#name").removeClass('adminred');
            $('#nameerr').text("");
        }

        if ($("#brand").val() !== '') {
            if (!$("#brand").val().match(comma_string)) {
                $("#brand").addClass('adminred');
                $('#branderr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#brand").removeClass('adminred');
                $('#branderr').text("");
            }
        }

        if ($("#generic_name").val() !== '') {
            if (!$("#generic_name").val().match(reg_letters)) {
                $("#generic_name").addClass('adminred');
                $('#generic_nameerr').text("Please Enter Alphabets only!");
                valid = false;
            }
            else {
                $("#generic_name").removeClass('adminred');
                $('#generic_nameerr').text("");
            }
        }
        if ($("#dosage").val() !== '') {
            if (!$("#dosage").val().match(reg_alphanumeric)) {
                $("#dosage").addClass('adminred');
                $('#dosageerr').text("Please Enter Alphabets and Numbers only!");
                valid = false;
            }
            else {
                $("#dosage").removeClass('adminred');
                $('#dosageerr').text("");
            }
        }

        if ($("#batch_number").val() !== '') {
            if (!$("#batch_number").val().match(reg_alphanumeric)) {
                $("#batch_number").addClass('adminred');
                $('#batch_numbererr').text("Please Enter Alphabets and Numbers only!");
                valid = false;
            }
            else {
                $("#batch_number").removeClass('adminred');
                $('#batch_numbererr').text("");
            }
        }
        if ($("#expiry_date").val() === '') {
            $("#expiry_date").addClass('adminred');
            $('#expiry_dateerr').text("Please Select Expiry Date!");
            valid = false;
        }
        else {
            $("#expiry_date").removeClass('adminred');
            $('#expiry_dateerr').text("");
        }

        if ($("#indications").val() !== '') {

            if (!$("#indications").val().match(reg_alphanumeric)) {
                $("#indications").addClass('adminred');
                $('#indicationserr').text("Please Enter Alphabets and Numbers only!");
                valid = false;
            }
            else {
                $("#indications").removeClass('adminred');
                $('#indicationserr').text("");
            }
        }

        if ($("#quantity").val() === '') {
            $("#quantity").addClass('adminred');
            $('#quantityerr').text("Please Enter Quantity!");
            valid = false;
        }
        else if (!$("#quantity").val().match(reg_numbers)) {
            $("#quantity").addClass('adminred');
            $('#quantityerr').text("Please Enter Numbers only!");
            valid = false;
        }
        else {
            $("#quantity").removeClass('adminred');
            $('#quantityerr').text("");
        }


        if (valid === true) {
            var ajaxurl;

            var formData = new FormData();
            formData.append('id', $("#medicineid").val()),
                    formData.append('name', $("#name").val()),
                    formData.append('brand', $("#brand").val()),
                    formData.append('generic_name', $("#generic_name").val()),
                    formData.append('dosage', $("#dosage").val()),
                    formData.append('batch_number', $("#batch_number").val()),
                    formData.append('expiry_date', $("#expiry_date").val()),
                    formData.append('indications', $("#indications").val()),
                    formData.append('quantity', $("#quantity").val())

            if ($("#medicineid").val() === '') {

                ajaxurl = site_url + 'api/web/v1/ctrl/MedicineCatalog/insertMedicineCatalog';
            } else {
                ajaxurl = site_url + 'api/web/v1/ctrl/MedicineCatalog/updateMedicineCatalog';
            }

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                contentType: false,
                data: formData,
                processData: false,
                beforeSend: function () {
                    $('#medicinesubmit').attr('disabled', true);
                    load();
                },
                success: function (response) {
                    setTimeout($.unblockUI, 0000);
                    //var res = JSON.parse(response);
                    if (response['status']) {
                        $('#medicinesubmit').attr('disabled', false);
                        $('#medicine_sucess').html(response['response']['messages']).delay(3500).fadeOut(3000);
                        //$('#squarespaceModal').modal('hide');
                        window.location.reload();
                        
                    } else if (response['status'] === '') {
                        $('#medicine_error').html(response['response']['messages']);
                        $('#squarespaceModal').modal('hide');
                    }
                    else {
                        $('#nameerr').text(response['response']['messages']['name']);
                        $('#quantityerr').text(response['response']['messages']['quantity']);
                        $('#expiry_dateerr').text(response['response']['messages']['expiry_date']);
                    }
                },
                error: function (xhr, status, error) {
                    // alert(xhr.responseText);
                    setTimeout($.unblockUI, 0000);
                    var data=xhr.responseText;
                    var res=JSON.parse(data);
                    $('#nameerr').text(res['response']['messages']['name']);
                    $('#quantityerr').text(res['response']['messages']['quantity']);
                    $('#expiry_dateerr').text(res['response']['messages']['expiry_date']);
                   }

            });
        }
    });

});

function editmedicine(id) {
    // alert($("#"+id+"_1").val());
    //console.log($('#id').val($("#"+id+"_1").text()));
    $('#lineModalLabel').html('Edit Medicine Catalog');
    $('#qnt').hide();
    $('#exdate').removeClass('col-md-6');
    $('#exdate').addClass('col-md-12');
    $('.error-msg-box').text('');
    $('.rmv').removeClass('adminred');
    $('#squarespaceModal').modal('show');
            $.ajax({
            url: site_url + 'api/web/v1/ctrl/medicineCatalog/getMedicine',
            type: 'get',
            contentType: false,
            data: {"medicineid":id}, 
            success: function (response) {
                $("#medicineid").val(response['response']['medicineCatalog'][0]['id'])
                $('#name').val(response['response']['medicineCatalog'][0]['name']);
                $('#brand').val(response['response']['medicineCatalog'][0]['brand']);
                $('#generic_name').val(response['response']['medicineCatalog'][0]['generic_name']);
                $('#dosage').val(response['response']['medicineCatalog'][0]['dosage']);
                $('#batch_number').val(response['response']['medicineCatalog'][0]['batch_number']);
                $('#expiry_date').val(response['response']['medicineCatalog'][0]['expiry_date']);
                $('#quantity').val(response['response']['medicineCatalog'][0]['quantity']);
                $('#indications').val(response['response']['medicineCatalog'][0]['indications']);

            
        }
        
});
}

function deletemedicine(id, event) {
    //event.preventDefault();
    var formData = new FormData();
    formData.append('id', id);

    var x = confirm("Are you sure you want to delete?");
    if (x) {
        $.ajax({
            url: site_url + 'api/web/v1/ctrl/medicineCatalog/deleteMedicineCatalog',
            type: 'POST',
            contentType: false,
            data: formData,
            processData: false,
            success: function (json) {

                //var json = JSON.parse(response);

                if (json['status'] == true) {
                    $("#sucess_msg").show();
                    $("#sucess_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function () {
                    });
                    $("#medicine" + id).hide();
                } else {
                    $("#error_msg").show();
                    $("#error_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function () {
                    });
                }

            },
            error: function (xhr, status, error) {
                // alert(xhr.responseText);
                console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);
            }

        });
    }

}
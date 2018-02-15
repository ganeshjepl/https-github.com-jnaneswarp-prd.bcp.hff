/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    ///console.log(site_url);
    
    $flag = 1;
    var err;
    $("#login").submit(function (event) {
        event.preventDefault();
        $("#username").focusout(function () {
            if ($(this).val() === '') {
                $(this).css("border-color", "#b30000");
                $("#usernameerr").text("Enter Username!");
                $('#servererr').text('');

            }
            else
            {
                $(this).css("border-color", "#2eb82e");
                $("#usernameerr").text("");

            }
        });
        $("#password").focusout(function () {
            if ($(this).val() === '') {
                $(this).css("border-color", "#b30000");
                $("#passworderr").text("Enter Password!");
            }
            else
            {
                $(this).css("border-color", "#2eb82e");
                $("#passworderr").text("");
            }
        });
    });


    $("#login").submit(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        if ($("#username").val() === '')
        {
            $("#username").css("border-color", "#b30000");
            $("#usernameerr").text("Enter Username!");
            $("#username").keypress(function () {
                $("#username").css("border-color", "#2eb82e");
                $("#usernameerr").text("");
            });
        }
        if ($("#password").val() === '')
        {
            $("#password").css("border-color", "#b30000");
            $("#passworderr").text("Enter Password!");
            $("#password").keypress(function () {
                $("#password").css("border-color", "#2eb82e");
                $("#passworderr").text("");
            });
        }



        var login = new Object();
        login.username = username;
        login.password = password;
        login.language = "";
        login.userrole = "bcp";

        var details = JSON.stringify(login);


        $.ajax({
            url: site_url + 'api/mobile/v1/User/login',
            type: 'POST',
            contentType: 'application/json; charset=utf-8 ',
            dataType: 'json',
            data: details,
            success: function (data) {
                window.location.href = " " + site_url + "user/dashboard";
            },
            error: function (xhr, status, error) {
                // alert(xhr.responseText);
                console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);
                err = JSON.parse(xhr.responseText);
                //alert(err.response.messages);
                $('#servererr').text(err.response.messages[0]);

            }

        });



    });
});
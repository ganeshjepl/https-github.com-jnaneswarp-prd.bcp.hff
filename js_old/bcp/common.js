function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function checkValue(id1, id2) {


    if (document.getElementById(id1).checked)
    {
        document.getElementById(id2).innerHTML = "Yes".bold();
    }
    else
    {
        document.getElementById(id2).innerHTML = "No".bold();
    }
}


/*var today = new Date().toISOString().split('T')[0];
 document.getElementsByid("somedate")[0].setAttribute('min', today);
 
 
 
 var input = document.getElementById("dateField");
 var today = new Date();
 var day = today.getDate();
 // Set month to string to add leading 0
 var mon = new String(today.getMonth()+1); //January is 0!
 var yr = today.getFullYear();
 
 if(mon.length < 2) { mon = "0" + mon; }
 
 var date = new String( yr + '-' + mon + '-' + day );
 
 //input.disabled = false; 
 //input.setAttribute('min', date);
 
 */
function tolanding() {
    alert('Form Successfully Submitted');
    window.location.replace("bcp_landing_screen.html");
    //window.open("https://cricket.yahoo.com/")
}


$(document).ready(function () {
    console.log("ready!");

    $('multiselect-ui').multiselect({
        includeSelectAllOption: true

    });
});




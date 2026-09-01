document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".header").classList.toggle("mobile");
    document.querySelector("body").classList.toggle("hidden");
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 1) {
        $('.header').addClass("sticky");
    }
    else {
        $('.header').removeClass("sticky");
    }
});

var today = new Date();
var applyDateInput = document.getElementById("dateTime");
applyDateInput.value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);


// Initialize Signature Pad
var canvas = document.getElementById('signatureCanvas');
var signaturePad = new SignaturePad(canvas);

$(".clearButton").click(function () {
    signaturePad.clear();
    document.getElementById('inducteeSignature').value = "";
});
jQuery(document).ready(function() {
    $("form[name='preStartMeeting']").validate({
        rules: {
            project: { required: true, maxlength: 250 },
            dateTime: { required: true,},
            meeting_conducted_by: { required: true, maxlength: 250 },
            meeting_representative: { required: true, maxlength: 250 },
            discussion: { required: true, maxlength: 500 },
            corrective_action: { required: true, maxlength: 250 },
            corrective_action_by: { required: true, maxlength: 250 },
            corrective_sign_date: { required: true},
            worker_name: { required: true, maxlength: 250 },
            worker_signature: { required: true},
        },
        messages: {
            project: { required: "This is required", maxlength: "valid only 250 characters."},
            dateTime: { required: "This is required"},
            meeting_conducted_by: { required: "This is required", maxlength: "valid only 250 characters." },
            meeting_representative: { required: "This is required", maxlength: "valid only 250 characters." },
            discussion: { required: "This is required", maxlength: "valid only 500 characters."},
            corrective_action: { required: "This is required", maxlength: "valid only 250 characters." },
            corrective_action_by: { required: "This is required", maxlength: "valid only 250 characters." },
            corrective_sign_date: { required: "This is required" },
            worker_name: { required: "This is required", maxlength: "valid only 250 characters."},
            worker_signature: { required: "This is required"},
        }
    });
});


$(".form1 .signatureSection").click(function () {
    var signatureErr = true;
    if (signaturePad.isEmpty()) {
        signatureErr = true
        $("#signaturebox").html("<div class='error' id='sig-error'> signature is required</div>");
        document.getElementById('inducteeSignature').value = "";
        return;
        //return false;
    } else if (!signaturePad.isEmpty()) {
        signatureErr = false;
        var inducteeSignature = signaturePad.toDataURL();
        $('#sig-error').html("<div></div>");
        document.getElementById('inducteeSignature').value = inducteeSignature;
    }
});


$(".submit").click(function () {
    //form.submit();
});

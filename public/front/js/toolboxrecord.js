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
var applyDateInput = document.getElementById("attendance_date");
applyDateInput.value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);


// Initialize Signature Pad
var canvas = document.getElementById('signatureCanvas');
var signaturePad = new SignaturePad(canvas);

$(".clearButton").click(function () {
    signaturePad.clear();
    document.getElementById('worker_signature').value = "";
});

$(document).ready(function() {
    $("#msform").submit(function(e) {
       

        var signatureErr = true;
        var workerNameErr = true;
        var attendanceDateErr = true;

        var checkWorkerName = document.forms["tooltalkrecord"]["worker_name"].value;
        if (!checkWorkerName) {
            workerNameErr = true;
            $("#workerNameErr").html("<div class='error' id='inductee-error'> Worker Name is required</div>");
        } else {
            workerNameErr = false;
            $('#inductee-error').html("<div></div>");
        }

        var attendanceDateErr = document.forms["tooltalkrecord"]["attendance_date"].value;
        if (attendanceDateErr == "") {
            attendanceDateErr = true;
            $("#attendance_date").html("<div class='error' id='apply-error'> Apply Date is required</div>");
        } else {
            attendanceDateErr = false;
            $('#apply-error').html("<div></div>");
        }

        if (signaturePad.isEmpty()) {
            signatureErr = true;
            $("#signaturebox").html("<div class='error' id='sig-error'>Worker Signature is required</div>");
            document.getElementById('worker_signature').value = "";
        } else {
            signatureErr = false;
            var workersignature = signaturePad.toDataURL();
            $('#sig-error').html("<div></div>");
            document.getElementById('worker_signature').value = workersignature;
        }

        if (workerNameErr === false && attendanceDateErr === false && signatureErr === false) {
           //   var form = $("#msform");
           console.log("workerNameErr")
           //$('#msform')[0].submit();
        }else{
            e.preventDefault();
        }
    });
});


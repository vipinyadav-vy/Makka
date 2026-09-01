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
var revisionDateInput = document.getElementById("revision_date");
revisionDateInput.value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);


// Initialize Signature Pad
var canvas = document.getElementById('signatureCanvas');
var signaturePad = new SignaturePad(canvas);

$(".clearButton").click(function () {
  signaturePad.clear();
  document.getElementById('inducteeSignature').value = "";
});

jQuery(document).ready(function() {

   $("form[name='inspectiontestplan']").validate({
        rules: {
      project: { required: true },
      itp_refrence_no: { required: true, maxlength: 250 },
      revision_no: { required: true, maxlength: 250 },
      revision_date: { required: true },
      work_scope: { required: true, maxlength: 250 },
      work_area: { required: true, maxlength: 250 },
      level: { required: true, maxlength: 250 },
      subcontracttor_name: { required: true, maxlength: 250 },
      representative: { required: true, maxlength: 250 },
      phone_no: { required: true, minlength: 10, maxlength: 10, digits: true },
      
      qualification: { required: true, maxlength: 250 },
      citizen: { required: true, maxlength: 250 },
      employerName: { required: true, maxlength: 250 },
      abnNumber: { required: true, maxlength: 250 },
      employerrepresentative: { required: true, maxlength: 250 },
      employerPhone: { required: true, minlength: 10, maxlength: 10, digits: true },
      siteManagement: { required: true },
      siteHours: { required: true },
      siteSafety: { required: true },
      minimumPpe: { required: true },
      whsManagementPlan: { required: true },
      healthSafetyRepresentatives: { required: true },
      workerDuties: { required: true },
      firstAid: { required: true },
      emergencyResponse: { required: true },
      emergencyEvacuation: { required: true },
      trafficManagement: { required: true },
      exclusiveZones: { required: true },
      mobilePlant: { required: true },
      scaffoldSafety: { required: true },
      siteAmenities: { required: true },
      siteAccess: { required: true },
      dailySign: { required: true },
      siteNoticeboard: { required: true },
      siteNoSmoking: { required: true },
      siteDrug: { required: true },
      siteViolence: { required: true },
      hazardIncidentReport: { required: true },
      stopWorkPolicy: { required: true },
      swmsSafety: { required: true },
      housekeepingPolicy: { required: true },
      electricSafety: { required: true },
      nonCompliance: { required: true },
      safeWorkMethodConfirmation: { required: true },
      skillsConfirmation: { required: true },
      englishConfirmation: { required: true },
    },
    messages: {
      project: { required: "This is required" },
      itp_refrence_no: { required: "This is required", maxlength: "valid only 250 characters." },
      revision_no: { required: "This is required", maxlength: "valid only 250 characters." },
      revision_date: { required: "This is required" },
      work_scope: { required: "This is required", maxlength: "valid only 250 characters." },
      work_area: { required: "This is required", maxlength: "valid only 250 characters." },
      level: { required: "This is required" },
      subcontracttor_name: { required: "This is required", maxlength: "valid only 250 characters." },
      representative: { required: "This is required", maxlength: "valid only 250 characters." },
      phone_no: {
        required: "Phone number is requied",
        minlength: "Please enter 10 digit mobile number",
        maxlength: "Please enter 10 digit mobile number",
        digits: "Only numbers are allowed in this field"
      },
      qualification: { required: "This is required", maxlength: "valid only 250 characters." },
      citizen: { required: "This is required", maxlength: "valid only 250 characters." },
      employerName: { required: "This is required", maxlength: "valid only 250 characters." },
      abnNumber: { required: "This is required", maxlength: "valid only 250 characters." },
      employerrepresentative: { required: "This is required", maxlength: "valid only 250 characters." },
      employerPhone: {
        required: "Phone number is requied",
        minlength: "Please enter 10 digit mobile number",
        maxlength: "Please enter 10 digit mobile number",
        digits: "Only numbers are allowed in this field"
      },
      siteManagement: { required: "This is required" },
      siteHours: { required: "This is required" },
      siteSafety: { required: "This is required" },
      minimumPpe: { required: "This is required" },
      whsManagementPlan: { required: "This is required" },
      healthSafetyRepresentatives: { required: "This is required" },
      workerDuties: { required: "This is required" },
      firstAid: { required: "This is required" },
      emergencyResponse: { required: "This is required" },
      emergencyEvacuation: { required: "This is required" },
      trafficManagement: { required: "This is required" },
      exclusiveZones: { required: "This is required" },
      mobilePlant: { required: "This is required" },
      scaffoldSafety: { required: "This is required" },
      siteAmenities: { required: "This is required" },
      siteAccess: { required: "This is required" },
      dailySign: { required: "This is required" },
      siteNoticeboard: { required: "This is required" },
      siteNoSmoking: { required: "This is required" },
      siteDrug: { required: "This is required" },
      siteViolence: { required: "This is required" },
      hazardIncidentReport: { required: "This is required" },
      stopWorkPolicy: { required: "This is required" },
      swmsSafety: { required: "This is required" },
      housekeepingPolicy: { required: "This is required" },
      electricSafety: { required: "This is required" },
      nonCompliance: { required: "This is required" },
      safeWorkMethodConfirmation: { required: "This is required" },
      skillsConfirmation: { required: "This is required" },
      englishConfirmation: { required: "This is required" },
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


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$(".submit").click(function () {
  form.submit();
});

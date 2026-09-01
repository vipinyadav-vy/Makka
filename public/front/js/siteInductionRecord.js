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

$('#identityType').on('change', function () {
  var identityType = this.value
  if (identityType == 'Others') {
    $("#otherIdentity").html('<input type="text" name="otherIdentityType"  maxlength="250" required placeholder="Enter Other Identity"></input>');
  } else {
    $("#otherIdentity").html("");
  }
});

$('input[name="citizen"]').on("click", function () {
  var citizen = $('input[name = "citizen"]:checked').val();
  if (citizen == 0) {
    $("#otherCitizen").html('<input type="text" name="workType"  maxlength="250" required></input>');
  } else {
    $("#otherCitizen").html("");
  }
});

var today = new Date();
var applyDateInput = document.getElementById("applyDate");
applyDateInput.value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches



// Initialize Signature Pad
var canvas = document.getElementById('signatureCanvas');
var signaturePad = new SignaturePad(canvas);

$(".clearButton").click(function () {
  signaturePad.clear();
  document.getElementById('inducteeSignature').value = "";
});

$(".form1 .next").click(function () {

  var form = $("#msform");
  form.validate({
    rules: {
      project: { required: true, maxlength: 250 },
      inductionNumber: { required: true, maxlength: 250 },
      workerName: { required: true, maxlength: 250 },
      workerAddress: { required: true, maxlength: 250 },
      phone_no: { required: true, minlength: 10, maxlength: 10, digits: true },
      identityType: { required: true, maxlength: 250 },
      identityNo: { required: true, maxlength: 250 },
      imageDocument: { required: true },
      inductionCardNo: { required: true, maxlength: 250 },
      occupation: { required: true, maxlength: 250 },
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
      project: { required: "This is required", maxlength: "valid only 250 characters.", },
      inductionNumber: { required: "This is required", maxlength: "valid only 250 characters." },
      workerName: { required: "This is required", maxlength: "valid only 250 characters." },
      workerAddress: { required: "This is required", maxlength: "valid only 500 characters." },
      phone_no: {
        required: "Phone number is requied",
        minlength: "Please enter 10 digit mobile number",
        maxlength: "Please enter 10 digit mobile number",
        digits: "Only numbers are allowed in this field"
      },

      identityType: { required: "This is required", maxlength: "valid only 250 characters." },
      identityNo: { required: "This is required", maxlength: "valid only 250 characters." },
      imageDocument: { required: "This is required" },
      inductionCardNo: { required: "This is required", maxlength: "valid only 250 characters." },
      occupation: { required: "This is required", maxlength: "valid only 250 characters." },
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
  if (form.valid() === true) {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = now * 50 + "%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({ transform: "scale(" + scale + ")" });
          next_fs.css({ left: left, opacity: opacity });
        },
        duration: 100,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeOutQuint"
      }
    );
  }
});




$(".form1 .previous").click(function () {
  if (animating) return false;
  animating = true;

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

  //de-activate current step on progressbar
  $("#progressbar li")
    .eq($("fieldset").index(current_fs))
    .removeClass("active");

  //show the previous fieldset
  previous_fs.show();
  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale previous_fs from 80% to 100%
        scale = 0.8 + (1 - now) * 0.2;
        //2. take current_fs to the right(50%) - from 0%
        left = (1 - now) * 50 + "%";
        //3. increase opacity of previous_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({ left: left });
        previous_fs.css({
          transform: "scale(" + scale + ")",
          opacity: opacity
        });
      },
      duration: 100,
      complete: function () {
        current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easing: "easeOutQuint"
    }
  );
});






$(".form1 .signatureSection").click(function () {

  var inducteeNameErr = true;
  var applyDateErr = true;
  var signatureErr = true;
  var checkInducteeName = document.forms["msform"]["inducteeName"].value;
  if (checkInducteeName == "") {
    inducteeNameErr = true;
    $("#inducteeNameErr").html("<div class='error' id='inductee-error'> Inductee Name is required</div>");
  } else {
    inducteeNameErr = false;
    $('#inductee-error').html("<div></div>");
  }

  var checkapplyDate = document.forms["msform"]["applyDate"].value;
  if (checkapplyDate == "") {
    applyDateErr = true
    $("#applyDateErr").html("<div class='error' id='apply-error'> Apply Date is required</div>");

  }
  else {
    applyDateErr = false;
    $('#apply-error').html("<div></div>");
  }
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
  if (inducteeNameErr === false && applyDateErr === false && signatureErr === false) {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = now * 50 + "%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({ transform: "scale(" + scale + ")" });
          next_fs.css({ left: left, opacity: opacity });
        },
        duration: 100,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeOutQuint"
      }
    );
  }

  $(".viewProject").html($('#project option:selected').text());
  $(".viewinductionNumber").html(document.forms["msform"]["inductionNumber"].value);
  $(".viewWorkerName").html(document.forms["msform"]["workerName"].value);
  $(".viewWorkerAddress").html(document.forms["msform"]["workerAddress"].value);
  $(".viewphone_no").html(document.forms["msform"]["phone_no"].value);
  var identityType = document.forms["msform"]["identityType"].value
  if (identityType == "Others") {
    $(".viewidentityType").html(document.forms["msform"]["otherIdentityType"].value);

  } else {
    $(".viewidentityType").html(document.forms["msform"]["identityType"].value);
  }
  $(".viewidentityNo").html(document.forms["msform"]["identityNo"].value);
  $(".viewinductionCardNo").html(document.forms["msform"]["inductionCardNo"].value);
  $(".viewoccupation").html(document.forms["msform"]["occupation"].value);
  $(".viewqualification").html(document.forms["msform"]["qualification"].value);
  var citizen = document.forms["msform"]["citizen"].value
  $(".viewCitizen").html(citizen && citizen == 1 ? "Yes" : "No | " + document.forms["msform"]["workType"].value);
  $(".viewemployerName").html(document.forms["msform"]["employerName"].value);
  $(".viewabnNumber").html(document.forms["msform"]["abnNumber"].value);
  $(".viewemployerrepresentative").html(document.forms["msform"]["employerrepresentative"].value);
  $(".viewemployerPhone").html(document.forms["msform"]["employerPhone"].value);
  var viewsiteManagement = document.forms["msform"]["siteManagement"].value
  $(".viewsiteManagement").html(viewsiteManagement && viewsiteManagement == 1 ? "Yes" : "No");

  var viewsiteHours = document.forms["msform"]["siteHours"].value
  $(".viewsiteHours").html(viewsiteHours && viewsiteHours == 1 ? "Yes" : "No");
  var viewsiteSafety = document.forms["msform"]["siteSafety"].value
  $(".viewsiteSafety").html(viewsiteSafety && viewsiteSafety == 1 ? "Yes" : "No");
  var viewminimumPpe = document.forms["msform"]["minimumPpe"].value
  $(".viewminimumPpe").html(viewminimumPpe && viewminimumPpe == 1 ? "Yes" : "No");
  var viewwhsManagementPlan = document.forms["msform"]["whsManagementPlan"].value
  $(".viewwhsManagementPlan").html(viewwhsManagementPlan && viewwhsManagementPlan == 1 ? "Yes" : "No");
  var viewhealthSafetyRepresentatives = document.forms["msform"]["healthSafetyRepresentatives"].value
  $(".viewhealthSafetyRepresentatives").html(viewhealthSafetyRepresentatives && viewhealthSafetyRepresentatives == 1 ? "Yes" : "No");

  var viewworkerDuties = document.forms["msform"]["workerDuties"].value
  $(".viewworkerDuties").html(viewworkerDuties && viewworkerDuties == 1 ? "Yes" : "No");
  var viewfirstAid = document.forms["msform"]["firstAid"].value
  $(".viewfirstAid").html(viewfirstAid && viewfirstAid == 1 ? "Yes" : "No");
  var viewemergencyResponse = document.forms["msform"]["emergencyResponse"].value
  $(".viewemergencyResponse").html(viewemergencyResponse && viewemergencyResponse == 1 ? "Yes" : "No");
  var viewemergencyEvacuation = document.forms["msform"]["emergencyEvacuation"].value
  $(".viewemergencyEvacuation").html(viewemergencyEvacuation && viewemergencyEvacuation == 1 ? "Yes" : "No");
  var viewtrafficManagement = document.forms["msform"]["trafficManagement"].value
  $(".viewtrafficManagement").html(viewtrafficManagement && viewtrafficManagement == 1 ? "Yes" : "No");


  var viewexclusiveZones = document.forms["msform"]["exclusiveZones"].value
  $(".viewexclusiveZones").html(viewexclusiveZones && viewexclusiveZones == 1 ? "Yes" : "No");
  var viewmobilePlant = document.forms["msform"]["mobilePlant"].value
  $(".viewmobilePlant").html(viewmobilePlant && viewmobilePlant == 1 ? "Yes" : "No");
  var viewscaffoldSafety = document.forms["msform"]["scaffoldSafety"].value
  $(".viewscaffoldSafety").html(viewscaffoldSafety && viewscaffoldSafety == 1 ? "Yes" : "No");
  var viewsiteAmenities = document.forms["msform"]["siteAmenities"].value
  $(".viewsiteAmenities").html(viewsiteAmenities && viewsiteAmenities == 1 ? "Yes" : "No");
  var viewsiteAccess = document.forms["msform"]["siteAccess"].value
  $(".viewsiteAccess").html(viewsiteAccess && viewsiteAccess == 1 ? "Yes" : "No");

  var viewdailySign = document.forms["msform"]["dailySign"].value
  $(".viewdailySign").html(viewdailySign && viewdailySign == 1 ? "Yes" : "No");
  var viewsiteNoticeboard = document.forms["msform"]["siteNoticeboard"].value
  $(".viewsiteNoticeboard").html(viewsiteNoticeboard && viewsiteNoticeboard == 1 ? "Yes" : "No");
  var viewsiteNoSmoking = document.forms["msform"]["siteNoSmoking"].value
  $(".viewsiteNoSmoking").html(viewsiteNoSmoking && viewsiteNoSmoking == 1 ? "Yes" : "No");
  var viewsiteDrug = document.forms["msform"]["siteDrug"].value
  $(".viewsiteDrug").html(viewsiteDrug && viewsiteDrug == 1 ? "Yes" : "No");
  var viewsiteViolence = document.forms["msform"]["siteViolence"].value
  $(".viewsiteViolence").html(viewsiteViolence && viewsiteViolence == 1 ? "Yes" : "No");

  var viewhazardIncidentReport = document.forms["msform"]["hazardIncidentReport"].value
  $(".viewhazardIncidentReport").html(viewhazardIncidentReport && viewhazardIncidentReport == 1 ? "Yes" : "No");
  var viewstopWorkPolicy = document.forms["msform"]["stopWorkPolicy"].value
  $(".viewstopWorkPolicy").html(viewstopWorkPolicy && viewstopWorkPolicy == 1 ? "Yes" : "No");
  var viewswmsSafety = document.forms["msform"]["swmsSafety"].value
  $(".viewswmsSafety").html(viewswmsSafety && viewswmsSafety == 1 ? "Yes" : "No");
  var viewhousekeepingPolicy = document.forms["msform"]["housekeepingPolicy"].value
  $(".viewhousekeepingPolicy").html(viewhousekeepingPolicy && viewhousekeepingPolicy == 1 ? "Yes" : "No");
  var viewelectricSafety = document.forms["msform"]["electricSafety"].value
  $(".viewelectricSafety").html(viewelectricSafety && viewelectricSafety == 1 ? "Yes" : "No");

  var viewnonCompliance = document.forms["msform"]["nonCompliance"].value
  $(".viewnonCompliance").html(viewnonCompliance && viewnonCompliance == 1 ? "Yes" : "No");
  var viewsafeWorkMethodConfirmation = document.forms["msform"]["safeWorkMethodConfirmation"].value
  $(".viewsafeWorkMethodConfirmation").html(viewsafeWorkMethodConfirmation && viewsafeWorkMethodConfirmation == 1 ? "Yes" : "No");
  var viewskillsConfirmation = document.forms["msform"]["skillsConfirmation"].value
  $(".viewskillsConfirmation").html(viewskillsConfirmation && viewskillsConfirmation == 1 ? "Yes" : "No");
  var viewenglishConfirmation = document.forms["msform"]["englishConfirmation"].value
  $(".viewenglishConfirmation").html(viewenglishConfirmation && viewenglishConfirmation == 1 ? "Yes" : "No");


  var viewinducteeSignature = document.forms["msform"]["inducteeSignature"].value
  $(".viewinducteeSignature").html('<img src="' + viewinducteeSignature + '" />');

  $(".viewInducteeName").html(document.forms["msform"]["inducteeName"].value);
  $(".viewapplyDate").html(document.forms["msform"]["applyDate"].value);

});



function readURL(input) {
    getBase64(input.files[0]);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result).width(150).height(200);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function getBase64(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
    $('#identityDocument').val(reader.result);
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
}

$(".submit").click(function () {
  form.submit();
});

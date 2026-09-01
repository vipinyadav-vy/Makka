
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


// Initialize Signature Pad
var canvas = document.getElementById('signatureCanvas');
var signaturePad = new SignaturePad(canvas);

$(".clearButton").click(function () {
    signaturePad.clear();
    document.getElementById('manager_signature').value = "";
});

jQuery(document).ready(function() {
    $("form[name='preStartChecklistSave']").validate({
            rules: {
              name: "required",
              abn_can:"required",
              address: "required",
              phone_no:"required",
              email: "required",
              website:"required",
              product: "required",
              representative:"required",
              representative_name: "required",
              representative_phone:"required",
              representative_email: "required",
              insurance_policy:"required",
              compensation_policy: "required",
              qualifications:"required",
              risk_injury: "required",
              necessary_emergency:"required",
              reporting_requirements: "required",
              specific_emergency_plan: "required",
              records_plant_equipment:"required",
              plant_working_condition: "required",
              plant_brought_site:"required",
              hazardous_chemicals: "required",
              exposure_standards:"required",
              containers_labelled: "required",
              electrical_equipment:"required",
              testing_records: "required",
              workers_brought_site:"required",
              training_competency: "required",
              workers_white_card:"required",
              workers_risk_licences: "required",
              workers_training_evidence:"required",
              general_comment: "required",
              manager_name:"required",
              manager_date:"required",
            },
            messages: {
              name: "This field is required",
              abn_can:"This field is required",
              address: "This field is required",
              phone_no:"This field is required",
              email: "This field is required",
              website:"This field is required",
              product: "This field is required",
              representative:"This field is required",
              representative_name: "This field is required",
              representative_phone:"This field is required",
              representative_email: "This field is required",
              insurance_policy:"This field is required",
              compensation_policy: "This field is required",
              qualifications:"This field is required",
              risk_injury: "This field is required",
              necessary_emergency:"This field is required",
              reporting_requirements: "This field is required",
              specific_emergency_plan: "This field is required",
              records_plant_equipment:"This field is required",
              plant_working_condition: "This field is required",
              plant_brought_site:"This field is required",
              hazardous_chemicals: "This field is required", 
              exposure_standards:"This field is required",
              containers_labelled: "This field is required",
              electrical_equipment:"This field is required",
              testing_records: "This field is required",
              workers_brought_site:"This field is required",
              training_competency: "This field is required",
              workers_white_card:"This field is required",
              workers_risk_licences: "This field is required",
              workers_training_evidence:"This field is required",
              general_comment: "This field is required",
              manager_name:"This field is required",
              manager_date:"This field is required",
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "insurance_policy") {
                    error.insertBefore("#secq-Quality_Assurance");
                } else if (element.attr("name") == "compensation_policy") {
                    error.insertBefore("#eighthq-worker_competency");
                }else if (element.attr("name") == "qualifications") {
                    error.insertBefore("#tenthq-organisation_docs");
                }else if (element.attr("name") == "risk_injury") {
                    error.insertBefore("#twelvethq-been_fined");
                }else if (element.attr("name") == "necessary_emergency") {
                    error.insertBefore("#fifth-necessary_resources");
                }else if (element.attr("name") == "reporting_requirements") {
                    error.insertBefore("#sixth-reporting_requirements");
                }else if (element.attr("name") == "specific_emergency_plan") {
                    error.insertBefore("#thirteenthq-under_investigation");
                }else if (element.attr("name") == "records_plant_equipment") {
                    error.insertBefore("#fourteenthq-criminal_offence");
                }else if (element.attr("name") == "plant_working_condition") {
                    error.insertBefore("#fifteenthq-necessary_resources");
                }else if (element.attr("name") == "plant_brought_site") {
                    error.insertBefore("#sixteenthq-mgt_procedures");
                }else if (element.attr("name") == "hazardous_chemicals") {
                    error.insertBefore("#eleventhq-inspection_processes");
                }else if (element.attr("name") == "exposure_standards") {
                    error.insertBefore("#seventhq-workforce");
                }else if (element.attr("name") == "containers_labelled") {
                    error.insertBefore("#thirteenthq-inspection_processes");
                }else if (element.attr("name") == "electrical_equipment") {
                    error.insertBefore("#fourteenthq-inspection_processes");
                }else if (element.attr("name") == "testing_records") {
                    error.insertBefore("#fifteenthq-returns_policy");
                }else if (element.attr("name") == "workers_brought_site") {
                    error.insertBefore("#sixteenthq-inspection_processes");
                }else if (element.attr("name") == "training_competency") {
                    error.insertBefore("#seventeenthq-trade_references");
                }else if (element.attr("name") == "workers_white_card") {
                    error.insertBefore("#eighteenth-workers_white_card");
                }else if (element.attr("name") == "workers_risk_licences") {
                    error.insertBefore("#ninteenth-workers_risk_licences");
                }else if (element.attr("name") == "workers_training_evidence") {
                    error.insertBefore("#twenty-workers_training_evidence");
                }
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var supplierSignature = signaturePad.toDataURL(); 
                document.getElementById('manager_signature').value = supplierSignature;
                form.submit();
            }
        });
    
});



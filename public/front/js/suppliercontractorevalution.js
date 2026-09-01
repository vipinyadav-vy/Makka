
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
    document.getElementById('supplier_signature').value = "";
});

jQuery(document).ready(function() {
    $("form[name='suppliercontractorevalution']").validate({
            rules: {
              name: "required",
              abn_can:"required",
              address: "required",
              phone_no:"required",
              email: "required",
              website:"required",
              product: "required",
              inspected_by:"required",
              representative_name: "required",
              representative_phone:"required",
              representative_email: "required",
              certified_quality:"required",
              quality_assurance: "required",
              whsmp_risk_assessments:"required",
              quality_whs_environmental: "required",
              elected_employee_health_safety:"required",
              quality_safety_environmental_responsibilities: "required",
              personnel_inducted:"required",
              verify_worker_competency: "required",
              safety_meetings_regularly_conducted:"required",
              organisation_insurances_licences_qualifications: "required",
              personnel_licences_qualifications:"required",
              prosecuted_issue: "required",
              under_investigation_environmental_laws:"required",
              company_officers_criminal_offence: "required",
              company_necessary_resources:"required",
              procedures_systems: "required",
              staff_qualified_administering_first_aid:"required",
              materials_return_credit_policy: "required",
              organisation_inspection:"required",
              trade_references: "required",
              general_comment: "required",
              supplier_name:"required",
              supplier_position:"required",
              supplier_date:"required",
              evaluation_description: "required",
              organisation_approved:"required",
              organisation_reason: "required",
              organisation_name: "required",
              organisation_position:"required",
              organisation_date:"required",
            },
            messages: {
              name: "This field is required",
              abn_can:"This field is required",
              address: "This field is required",
              phone_no:"This field is required",
              email: "This field is required",
              website:"This field is required",
              product: "This field is required",
              inspected_by:"This field is required",
              representative_name: "This field is required",
              representative_phone:"This field is required",
              representative_email: "This field is required",
              certified_quality:"This field is required",
              quality_assurance: "This field is required",
              whsmp_risk_assessments:"This field is required",
              quality_whs_environmental: "This field is required",
              elected_employee_health_safety:"This field is required",
              quality_safety_environmental_responsibilities: "This field is required",
              personnel_inducted:"This field is required",
              verify_worker_competency: "This field is required",
              safety_meetings_regularly_conducted:"This field is required",
              organisation_insurances_licences_qualifications: "This field is required",
              personnel_licences_qualifications:"This field is required",
              prosecuted_issue: "This field is required",
              under_investigation_environmental_laws:"This field is required",
              company_officers_criminal_offence: "This field is required",
              company_necessary_resources:"This field is required",
              procedures_systems: "This field is required",
              staff_qualified_administering_first_aid:"This field is required",
              materials_return_credit_policy: "This field is required",
              organisation_inspection:"This field is required",
              trade_references:"This field is required",
              general_comment: "This field is required",
              supplier_name:"This field is required",
              supplier_position:"This field is required",
              supplier_date:"This field is required",
              evaluation_description: "This field is required",
              organisation_approved:"This field is required",
              organisation_reason:"This field is required",
              organisation_name: "This field is required",
              organisation_position:"This field is required",
              organisation_date:"This field is required",
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "certified_quality") {
                    error.insertBefore("#firstq-certified_quality");
                } else if (element.attr("name") == "quality_assurance") {
                    error.insertBefore("#secq-Quality_Assurance");
                }else if (element.attr("name") == "whsmp_risk_assessments") {
                    error.insertBefore("#thirdq-company_operations");
                }else if (element.attr("name") == "quality_whs_environmental") {
                    error.insertBefore("#forthq-documented_Quality");
                }else if (element.attr("name") == "elected_employee_health_safety") {
                    error.insertBefore("#fifthq-elected_employee");
                }else if (element.attr("name") == "quality_safety_environmental_responsibilities") {
                    error.insertBefore("#sixthq-safety_roles");
                }else if (element.attr("name") == "personnel_inducted") {
                    error.insertBefore("#seventhq-inducted_trained");
                }else if (element.attr("name") == "verify_worker_competency") {
                    error.insertBefore("#eighthq-worker_competency");
                }else if (element.attr("name") == "safety_meetings_regularly_conducted") {
                    error.insertBefore("#ninethq-safety_meetings");
                }else if (element.attr("name") == "organisation_insurances_licences_qualifications") {
                    error.insertBefore("#tenthq-organisation_docs");
                }else if (element.attr("name") == "personnel_licences_qualifications") {
                    error.insertBefore("#eleventhq-safety_meetings");
                }else if (element.attr("name") == "prosecuted_issue") {
                    error.insertBefore("#twelvethq-been_fined");
                }else if (element.attr("name") == "under_investigation_environmental_laws") {
                    error.insertBefore("#thirteenthq-under_investigation");
                }else if (element.attr("name") == "company_officers_criminal_offence") {
                    error.insertBefore("#fourteenthq-criminal_offence");
                }else if (element.attr("name") == "company_necessary_resources") {
                    error.insertBefore("#fifteenthq-necessary_resources");
                }else if (element.attr("name") == "procedures_systems") {
                    error.insertBefore("#sixteenthq-mgt_procedures");
                }else if (element.attr("name") == "staff_qualified_administering_first_aid") {
                    error.insertBefore("#seventhq-workforce");
                }else if (element.attr("name") == "materials_return_credit_policy") {
                    error.insertBefore("#eighteenthq-returns_policy");
                }else if (element.attr("name") == "organisation_inspection") {
                    error.insertBefore("#ninteenthq-inspection_processes");
                }else if (element.attr("name") == "trade_references") {
                    error.insertBefore("#twentythq-trade_references");
                }
                else {
                    error.insertAfter(element);
                }
            },
           
            submitHandler: function (form) {
                
                var supplierSignature = signaturePad.toDataURL(); 
                document.getElementById('supplier_signature').value = supplierSignature;
                
                form.submit();
            }
        });
    
});



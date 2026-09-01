
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
              project: "required",
              contractor:"required",
              work_scope: "required",
              swms_particulars:"required",
              swms_date: "required",
              name_address_abn:"required",
              signed_date_by_senior_management: "required",
              managing_swms_implementation:"required",
              Includes_description: "required",
              step_by_step_work_method:"required",
              hazards_associated: "required",
              assesses_risk_associated:"required",
              appropriate_safety_environmental: "required",
              hierarchy_control:"required",
              records_consulted: "required",
              identifies_training:"required",
              identifies_plant_tools_equipment: "required",
              inspection_maintenance:"required",
              regulatory_permits: "required",
              swms_outline:"required",
              hazardous_chemical: "required",
              hazardous_substance:"required",
              corrective_action: "required",
              inspection_methods:"required",
              communicating_method: "required",
              identifies_safety:"required",
              emergency_information: "required",
              inspection_testing:"required",
              swms_address: "required",
              trained_names:"required",
              signatures_carrying: "required",
              hazards_risks_controls: "required",
              electrical:"required",
              noise:"required",
              radiation:"required",
              confined_space: "required",
              laboratory:"required",
              hazardous_chemicals_fumes: "required",
              biological: "required",
              cranes:"required",
              excavation:"required",
              
              overhead_power_lines: "required",
              work_height:"required",
              work_roofs: "required",
              slip_trip:"required",
              hot_works: "required",
              traffic_vehicles:"required",
              mobile_plant: "required",
              striking_struck:"required",
              lone_work: "required",
              shutdowns:"required",
              hazardous_manual_tasks: "required",
              fatigue:"required",
              fire_explosion: "required",
              gas_installation: "required",
              asbestos:"required",
              lead:"required",
              
            },
            messages: {
              project: "This field is required",
              contractor:"This field is required",
              work_scope: "This field is required",
              swms_particulars:"This field is required",
              swms_date: "This field is required",
              name_address_abn:"This field is required",
              signed_date_by_senior_management: "This field is required",
              managing_swms_implementation:"This field is required",
              Includes_description: "This field is required",
              step_by_step_work_method:"This field is required",
              hazards_associated: "This field is required",
              assesses_risk_associated:"This field is required",
              appropriate_safety_environmental: "This field is required",
              hierarchy_control:"This field is required",
              records_consulted: "This field is required",
              identifies_training:"This field is required",
              identifies_plant_tools_equipment: "This field is required",
              inspection_maintenance:"This field is required",
              regulatory_permits: "This field is required",
              swms_outline:"This field is required",
              hazardous_chemical: "This field is required",
              hazardous_substance:"This field is required",
              corrective_action: "This field is required",
              inspection_methods:"This field is required",
              communicating_method: "This field is required",
              identifies_safety:"This field is required",
              emergency_information: "This field is required",
              inspection_testing:"This field is required",
              swms_address: "This field is required",
              trained_names:"This field is required",
              signatures_carrying:"This field is required",
              hazards_risks_controls: "This field is required",
              electrical:"This field is required",
              noise:"This field is required",
              radiation:"This field is required",
              confined_space: "This field is required",
              laboratory:"This field is required",
              hazardous_chemicals_fumes:"This field is required",
              biological: "This field is required",
              cranes:"This field is required",
              excavation:"This field is required",
              
              overhead_power_lines: "This field is required",
              work_height:"This field is required",
              work_roofs: "This field is required",
              slip_trip:"This field is required",
              hot_works: "This field is required",
              traffic_vehicles:"This field is required",
              mobile_plant: "This field is required",
              striking_struck:"This field is required",
              lone_work: "This field is required",
              shutdowns:"This field is required",
              hazardous_manual_tasks: "This field is required",
              fatigue:"This field is required",
              fire_explosion:"This field is required",
              gas_installation: "This field is required",
              asbestos:"This field is required",
              lead:"This field is required",
              

            },
           
            submitHandler: function (form) {
                
                var supplierSignature = signaturePad.toDataURL(); 
                document.getElementById('supplier_signature').value = supplierSignature;
                
                form.submit();
            }
        });
    
});



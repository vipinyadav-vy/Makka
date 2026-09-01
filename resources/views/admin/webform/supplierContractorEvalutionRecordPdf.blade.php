<!DOCTYPE html>
<html>
   <head>
      <title>Supplier & Contractor Evaluation</title>
   </head>
   <body>
      <style>
         table {
            border-collapse: collapse; /* Merge borders for a cleaner look */
            width: 100%;
         }
        .half-column td {
            border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 50%; /* Set both columns to equal width */

         }
        .half-column th {
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 50%; /* Set both columns to equal width */

         }
        .third-one .title{
             border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 80%; /* Set both columns to equal width */
        }
        .third-one .title-desc{
             border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 20%; /* Set both columns to equal width */

        }
        .headlines{
          color: #fff;
          padding: 10px;
        }
        .bootomNone{
            border-bottom: 0px !important;
        }
      </style>
      <table class="half-column bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
         <tr>
            <th>
                <img style="width:200px;" src="{{ public_path('front/images/logo.png') }}"/>
                </th>
            <th >
               <h2>Supplier & Contractor Evaluation</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Name:</td>
            <td>@if($data->name){{ $data->name }} @endif</td>
         </tr>
         <tr> 
            <td> ABN / CAN:</td>
            <td> @if($data->abn_can) {{ $data->abn_can }} @endif</td>
         </tr>
         <tr> 
            <td> Address:</td>
            <td> @if($data->address) {{ $data->address }} @endif</td>
         </tr>
         <tr> 
            <td> Phone:</td>
            <td> @if($data->phone_no) {{ $data->phone_no }} @endif</td>
         </tr>
         <tr> 
            <td> Email:</td>
            <td> @if($data->email) {{ $data->email }} @endif</td>
         </tr>
         <tr> 
            <td> Website:</td>
            <td> @if($data->website) {{ $data->website }} @endif</td>
         </tr>
         <tr> 
            <td> Product / Service / Work:</td>
            <td> @if($data->product) {{ $data->product }} @endif</td>
         </tr>
         <tr> 
            <td> Inspected by:</td> 
            <td> @if($data->inspected_by) {{ $data->inspected_by }} @endif</td>
         </tr>
         <tr> 
            <td> Representative Name:</td>
            <td> @if($data->representative_name) {{ $data->representative_name }} @endif</td>
         </tr>
         <tr> 
            <td> Representative Phone:</td>
            <td> @if($data->representative_phone) {{ $data->representative_phone }} @endif</td>
         </tr>
         <tr> 
            <td> Representative Email:</td>
            <td> @if($data->representative_email) {{ $data->representative_email }} @endif</td>
         </tr>
         
           </table>
        <table class="third-one bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
        
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Evaluation Criteria</span></td>
         </tr>
        <tr>
            <td class="title"> Does your company have a certified quality, safety or environmental management system? If Yes please attach copies of certificates and management system index.</td>
            <td class="title-desc"> @if($data->certified_quality == 0){{ 'No' }} @elseif($data->certified_quality == 1){{ 'YES' }}@elseif($data->certified_quality == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
          
         <tr>
            <td class="title"> Is there a published Quality Assurance; Safety; Environmental Policy? If Yes, please attach copies of relevant policies.</td>
            <td class="title-desc"> @if($data->quality_assurance == 0){{ 'No' }} @elseif($data->quality_assurance == 1){{ 'YES' }}@elseif($data->quality_assurance == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Is there a documented WHSMP, risk assessments, SWMS, ITP and an EMP for company operations?</td>
            <td class="title-desc"> @if($data->whsmp_risk_assessments == 0){{ 'No' }} @elseif($data->whsmp_risk_assessments == 1){{ 'YES' }}@elseif($data->whsmp_risk_assessments == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are there documented Quality, WHS and Environmental management procedures that are known to all employees?</td>
            <td class="title-desc"> @if($data->quality_whs_environmental == 0){{ 'No' }} @elseif($data->quality_whs_environmental == 1){{ 'YES' }}@elseif($data->quality_whs_environmental == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are there elected employee Health and Safety Representatives?</td>
            <td class="title-desc"> @if($data->elected_employee_health_safety == 0){{ 'No' }} @elseif($data->elected_employee_health_safety == 1){{ 'YES' }}@elseif($data->elected_employee_health_safety == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Have quality, safety and environmental roles, responsibilities and authorities been defined?</td>
            <td class="title-desc"> @if($data->quality_safety_environmental_responsibilities == 0){{ 'No' }} @elseif($data->quality_safety_environmental_responsibilities == 1){{ 'YES' }}@elseif($data->quality_safety_environmental_responsibilities == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are all personnel inducted and trained for their work activities?</td>
            <td class="title-desc"> @if($data->personnel_inducted == 0){{ 'No' }} @elseif($data->personnel_inducted == 1){{ 'YES' }}@elseif($data->personnel_inducted == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does your company verify worker competency? If so, how?</td>
            <td class="title-desc"> @if($data->verify_worker_competency == 0){{ 'No' }} @elseif($data->verify_worker_competency == 1){{ 'YES' }}@elseif($data->verify_worker_competency == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are safety meetings regularly conducted and documented?</td>
            <td class="title-desc"> @if($data->safety_meetings_regularly_conducted == 0){{ 'No' }} @elseif($data->safety_meetings_regularly_conducted == 1){{ 'YES' }}@elseif($data->safety_meetings_regularly_conducted == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does the organisation have appropriate insurances, licences and qualifications? Provide copies.</td>
            <td class="title-desc"> @if($data->organisation_insurances_licences_qualifications == 0){{ 'No' }} @elseif($data->organisation_insurances_licences_qualifications == 1){{ 'YES' }}@elseif($data->organisation_insurances_licences_qualifications == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Do your personnel have the required licences, training, qualifications and/ or competencies to perform the work?</td>
            <td class="title-desc"> @if($data->personnel_licences_qualifications == 0){{ 'No' }} @elseif($data->personnel_licences_qualifications == 1){{ 'YES' }}@elseif($data->personnel_licences_qualifications == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Has your organisation previously been fined, prosecuted, issued with a prohibition or improvement notice by the applicable Safety or environmental regulator? If ‘Yes’, please provide details.</td>
            <td class="title-desc"> @if($data->prosecuted_issue == 0){{ 'No' }} @elseif($data->prosecuted_issue == 1){{ 'YES' }}@elseif($data->prosecuted_issue == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Is your company currently under investigation for a breach of safety and/or environmental laws? if yes, specify.</td>
            <td class="title-desc"> @if($data->under_investigation_environmental_laws == 0){{ 'No' }} @elseif($data->under_investigation_environmental_laws == 1){{ 'YES' }}@elseif($data->under_investigation_environmental_laws == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Have any of your company officers previously been charged or convicted of a criminal offence? If Yes, please specify.</td>
            <td class="title-desc"> @if($data->company_officers_criminal_offence == 0){{ 'No' }} @elseif($data->company_officers_criminal_offence == 1){{ 'YES' }}@elseif($data->company_officers_criminal_offence == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does the company have the necessary resources to fulfill potential work requirements?</td>
            <td class="title-desc"> @if($data->company_necessary_resources == 0){{ 'No' }} @elseif($data->company_necessary_resources == 1){{ 'YES' }}@elseif($data->company_necessary_resources == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does the company have procedures / systems in place for the management and supervision of their workers and/or contractors? If Yes, please specify and provide examples.</td>
            <td class="title-desc"> @if($data->procedures_systems == 0){{ 'No' }} @elseif($data->procedures_systems == 1){{ 'YES' }}@elseif($data->procedures_systems == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are any of your staff qualified in administering First Aid? If ‘Yes’, what % of your workforce?</td>
            <td class="title-desc"> @if($data->staff_qualified_administering_first_aid == 0){{ 'No' }} @elseif($data->staff_qualified_administering_first_aid == 1){{ 'YES' }}@elseif($data->staff_qualified_administering_first_aid == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> If supplying materials, products, plant or equipment do you have a returns and/or credit policy? If ‘Yes’, please provide a copy.</td>
            <td class="title-desc"> @if($data->materials_return_credit_policy == 0){{ 'No' }} @elseif($data->materials_return_credit_policy == 1){{ 'YES' }}@elseif($data->materials_return_credit_policy == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does your organisation use Inspection and Test Processes to ensure materials and/or workmanship meet specified requirements?</td>
            <td class="title-desc"> @if($data->organisation_inspection == 0){{ 'No' }} @elseif($data->organisation_inspection == 1){{ 'YES' }}@elseif($data->organisation_inspection == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Provide details of three trade references that we may contact to get more information about your company</td>
            <td class="title-desc"> @if($data->trade_references == 0){{ 'No' }} @elseif($data->trade_references == 1){{ 'YES' }}@elseif($data->trade_references == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         </table>
         
         <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="3" style="padding-left: 0; background-color:gray;"><span class="headlines">GENERAL / ADDITIONAL COMMENTS & NOTATIONS</span></td>
         </tr>
         <tr>
             <td colspan="3">
                 <p>@if($data->general_comment){{ $data->general_comment }} @endif</p>
             </td>
         </tr>
</table>
        
      <table class="half-column bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">SIGN-OFF</span>
            <p class="headlines">By signing here below I hereby acknowledge that the answers I have provided on behalf of the supplier / contractororganisation are true, accurate and correct</p>
            </td>
         </tr>
         <tr>
            <td>Name:</td>
            <td>@if($data->supplier_name){{ $data->supplier_name }} @endif</td>
         </tr>
         <tr> 
            <td> Position:</td>
            <td> @if($data->supplier_position) {{ $data->supplier_position }} @endif</td>
         </tr>
         <tr> 
            <td> Signature:</td>
            <td><img style="width:200px;" src="{{ url($data->supplier_signature) }}" /></td>
         </tr>
         <tr> 
            <td> Date:</td>
            <td> @if($data->supplier_date) {{ $data->supplier_date }} @endif</td>
         </tr>
           </table>
           
           <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="3" style="padding-left: 0; background-color:gray;"><span class="headlines">EVALUATION & RECOMMENDATIONS</span></td>
         </tr>
         <tr>
             <td colspan="3">
                 <p>@if($data->evaluation_description){{ $data->evaluation_description }} @endif</p>
             </td>
         </tr>
</table>
           
      <table class="half-column bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">ORGANISATION SIGN-OFF</span>
            </td>
         </tr>
         <tr>
            <td>Approved / Rejected:</td>
            <td>@if($data->organisation_approved){{ $data->organisation_approved }} @endif</td>
         </tr>
         <tr> 
            <td> Reasons:</td>
            <td> @if($data->organisation_reason) {{ $data->organisation_reason }} @endif</td>
         </tr>
         <tr> 
            <td> Name:</td>
            <td> @if($data->organisation_name) {{ $data->organisation_name }} @endif</td>
         </tr>
         <tr> 
            <td> Position:</td>
            <td> @if($data->organisation_position) {{ $data->organisation_position }} @endif</td>
         </tr>
         <tr> 
            <td> Date:</td>
            <td> @if($data->organisation_date) {{ $data->organisation_date }} @endif</td>
         </tr>
           </table>
      
   </body>
</html>
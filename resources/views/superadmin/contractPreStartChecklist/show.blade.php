<!DOCTYPE html>
<html>
   <head>
      <title>Contractor Pre-Start CheckList</title>
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
            <td> Representative:</td> 
            <td> @if($data->representative) {{ $data->representative }} @endif</td>
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
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Insurance</span></td>
         </tr>
        <tr>
            <td class="title"> Current public liability insurance policy (copies required).</td>
            <td class="title-desc"> @if($data->insurance_policy == 0){{ 'No' }} @elseif($data->insurance_policy == 1){{ 'YES' }}@elseif($data->insurance_policy == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Current workers compensation policy (copies required)</td>
            <td class="title-desc"> @if($data->compensation_policy == 0){{ 'No' }} @elseif($data->compensation_policy == 1){{ 'YES' }}@elseif($data->compensation_policy == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Licences / Qualifications</span></td>
         </tr>
         <tr>
            <td class="title"> Are licences/qualifications required for the tasks being undertaken? E.g. Contractor Licence, induction card, high risk work licence (e.g. forklift), first aid (copies required)</td>
            <td class="title-desc"> @if($data->qualifications == 0){{ 'No' }} @elseif($data->qualifications == 1){{ 'YES' }}@elseif($data->qualifications == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Risks Assessments / SWMS / SOPs</span></td>
         </tr>
         <tr>
            <td class="title"> Is the work being undertaken medium to high risk where there is a risk of a severe or permanent injury? (if yes, evidence of risk assessments and/or safe procedures such as a safe operating procedure (SOP) or a safe work method statement (SWMS) must be provided)</td>
            <td class="title-desc"> @if($data->risk_injury == 0){{ 'No' }} @elseif($data->risk_injury == 1){{ 'YES' }}@elseif($data->risk_injury == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Has contractor provided all necessary emergency contact details?</td>
            <td class="title-desc"> @if($data->necessary_emergency == 0){{ 'No' }} @elseif($data->necessary_emergency == 1){{ 'YES' }}@elseif($data->necessary_emergency == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Has the reporting requirements: incidents, inductions, hazard, risk management, communication and consultation processes been explained?</td>
            <td class="title-desc"> @if($data->reporting_requirements == 0){{ 'No' }} @elseif($data->reporting_requirements == 1){{ 'YES' }}@elseif($data->reporting_requirements == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Does the task require a specific emergency plan? eg. working in remote or isolated areas, working with harnesses, rescue from heights plan (copies required)</td>
            <td class="title-desc"> @if($data->specific_emergency_plan == 0){{ 'No' }} @elseif($data->specific_emergency_plan == 1){{ 'YES' }}@elseif($data->specific_emergency_plan == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Plant & Equipment</span></td>
         </tr>
         <tr>
            <td class="title"> Provided all registration, insurances, maintenance and service records for plant and equipment.</td>
            <td class="title-desc"> @if($data->records_plant_equipment == 0){{ 'No' }} @elseif($data->records_plant_equipment == 1){{ 'YES' }}@elseif($data->records_plant_equipment == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Is all plant / equipment in good working condition? eg. plant includes machinery, equipment and tools</td>
            <td class="title-desc"> @if($data->plant_working_condition == 0){{ 'No' }} @elseif($data->plant_working_condition == 1){{ 'YES' }}@elseif($data->plant_working_condition == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Is there a maintenance register of the plant being brought to site? (copies required).</td>
            <td class="title-desc"> @if($data->plant_brought_site == 0){{ 'No' }} @elseif($data->plant_brought_site == 1){{ 'YES' }}@elseif($data->plant_brought_site == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Hazardous substances </span></td>
         </tr>
         <tr>
            <td class="title"> Will the task involve the use of hazardous chemicals/substances?</td>
            <td class="title-desc"> @if($data->hazardous_chemicals == 0){{ 'No' }} @elseif($data->hazardous_chemicals == 1){{ 'YES' }}@elseif($data->hazardous_chemicals == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Will exposure standards be met? Please provide details</td>
            <td class="title-desc"> @if($data->exposure_standards == 0){{ 'No' }} @elseif($data->exposure_standards == 1){{ 'YES' }}@elseif($data->exposure_standards == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are containers clearly labelled and relevant safety data sheets (SDS) available?</td>
            <td class="title-desc"> @if($data->containers_labelled == 0){{ 'No' }} @elseif($data->containers_labelled == 1){{ 'YES' }}@elseif($data->containers_labelled == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Electrical </span></td>
         </tr>
         <tr>
            <td class="title"> Will electrical equipment be brought to site?</td>
            <td class="title-desc"> @if($data->electrical_equipment == 0){{ 'No' }} @elseif($data->electrical_equipment == 1){{ 'YES' }}@elseif($data->electrical_equipment == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are copies of testing records available?(copies required)</td>
            <td class="title-desc"> @if($data->testing_records == 0){{ 'No' }} @elseif($data->testing_records == 1){{ 'YES' }}@elseif($data->testing_records == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Worker Training / Competency </span></td>
         </tr>
         <tr>
            <td class="title"> Will other workers be brought to site?</td>
            <td class="title-desc"> @if($data->workers_brought_site == 0){{ 'No' }} @elseif($data->workers_brought_site == 1){{ 'YES' }}@elseif($data->workers_brought_site == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Are training and competency records related to the tasks being undertaken available? (copies required)</td>
            <td class="title-desc"> @if($data->training_competency == 0){{ 'No' }} @elseif($data->training_competency == 1){{ 'YES' }}@elseif($data->training_competency == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Worker white cards provided?</td>
            <td class="title-desc"> @if($data->workers_white_card == 0){{ 'No' }} @elseif($data->workers_white_card == 1){{ 'YES' }}@elseif($data->workers_white_card == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Worker high risk work licences provided</td>
            <td class="title-desc"> @if($data->workers_risk_licences == 0){{ 'No' }} @elseif($data->workers_risk_licences == 1){{ 'YES' }}@elseif($data->workers_risk_licences == 2){{ 'Not Applicable' }}@endif </td>
         </tr>
         <tr>
            <td class="title"> Worker – other licences, VOC, training evidence provided</td>
            <td class="title-desc"> @if($data->workers_training_evidence == 0){{ 'No' }} @elseif($data->workers_training_evidence == 1){{ 'YES' }}@elseif($data->workers_training_evidence == 2){{ 'Not Applicable' }}@endif </td>
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
           <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
         <tr>
             <td colspan="3" style="padding-left: 0; background-color:gray;">
                 <span class="headlines">SIGN-OFF</span>
            <p class="headlines">To be signed by the person responsible for reviewing and confirming all of the above.</p>
             </td>
         </tr>
  <tr>
    <th style=" background-color:gray; color:#fff;">Manager Name</th>  
    <th style="padding-left: 0; background-color:gray; color:#fff;">Manager Date</th>
    <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>
  </tr>
  <tr>
    <td>@if($data->manager_name) {{ $data->manager_name }} @endif </td>
    <td>@if($data->manager_date) {{ $data->manager_date }} @endif</td>
    <td>@if($data->manager_signature) <img style="width:200px;" src="{{ url($data->manager_signature) }}" /> @endif</td>
  </tr>
 
</table>
          
      
   </body>
</html>
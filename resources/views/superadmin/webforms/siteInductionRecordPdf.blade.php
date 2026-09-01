<!DOCTYPE html>
<html>
   <head>
      <title>Site Induction Record</title>
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
               <h2>Site Induction Record</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Project / Site:</td>
            <td>@if($data->projectname) {{ $data->projectname }} @endif</td>
         </tr>
         <tr> 
            <td> Site Induction Number:</td>
            <td> @if($data->inductionNumber) {{ $data->inductionNumber }} @endif</td>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Inductee details</span></td>
         </tr>
         <tr>
            <td> Name of worker inducted:</td>
            <td> @if($data->workerName) {{ $data->workerName }} @endif </td>
         </tr>
         <tr>
            <td> Address:</td>
            <td> @if($data->workerAddress) {{ $data->workerAddress }} @endif </td>
         </tr>
         <tr>
            <td> Contact No.:</td>
            <td> @if($data->phone_no) {{ $data->phone_no }} @endif </td>
         </tr>
        
         
         <tr>
            <td>Identification Type:</td>
            <td> @if($data->identityType) {{ $data->identityType }} @endif  </td>
         </tr>
         <tr>
            <td>Identification No.:</td>
            <td> @if($data->identityNo) {{ $data->identityNo }} @endif  </td>
         </tr>
         <tr>
            <td>Identification Document Attachement:</td>
            <td>@if($data->identityDocument) {{ 'Attachment First' }} @endif </td>
         </tr>
         <tr>
            <td> General Construction Induction Card No.:</td>
            <td> @if($data->inductionCardNo) {{ $data->inductionCardNo }} @endif </td>
         </tr>
         <tr>
            <td> Trade / Occupation:</td>
            <td> @if($data->occupation) {{ $data->occupation }} @endif </td>
         </tr>
         <tr>
            <td> Qualifications / Tickets / tdcences:</td>
            <td> @if($data->qualification) {{ $data->qualification }} @endif </td>
         </tr>
         <tr>
            <td> Are you an Austratdan Citizen / Resident:</td>
            <td>  {{ $data->citizen == 1 ? 'YES' : 'NO | ' . $data->workType }} </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Employer details</span></td>
         </tr>
         <tr>
            <td> Who is your employer</td>
            <td> @if($data->employerName) {{ $data->employerName }} @endif </td>
         </tr>
         <tr>
            <td> What is your ABN</td>
            <td> @if($data->abnNumber) {{ $data->abnNumber }} @endif </td>
         </tr>
         <tr>
            <td> Employer Representative:</td>
            <td> @if($data->employerrepresentative) {{ $data->employerrepresentative }} @endif </td>
         </tr>
         <tr>
            <td class="bootomNone"> Contact No.:</td>
            <td class="bootomNone"> @if($data->employerPhone) {{ $data->employerPhone }} @endif </td>
         </tr>
           </table>
        <table class="third-one bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
        
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Induction Agenda Items</span></td>
            <!--<td class="title-desc" style="padding-right: 0; background-color:gray;"></td>-->
         </tr>
        <tr>
            <td class="title"> Site management personnel – informed of site managers, supervisors, representatives</td>
            <td class="title-desc"> @if($data->siteManagement) {{ $data->siteManagement == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
          
         <tr>
            <td class="title"> Site hours of operation and security requirements</td>
            <td class="title-desc"> @if($data->siteHours) {{ $data->siteHours == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site safety rules – taken through site safety rules</td>
            <td class="title-desc"> @if($data->siteSafety) {{ $data->siteSafety == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Minimum PPE required for the site – Hard hat, high-vis clothing, safety boots</td>
            <td class="title-desc"> @if($data->minimumPpe) {{ $data->minimumPpe == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> WHS Management Plan – show a copy explain that it is available on site to be viewed if requested</td>
            <td class="title-desc"> @if($data->whsManagementPlan) {{ $data->whsManagementPlan == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Health & Safety Representatives / Committees – informed of who they are (if apptdcable)</td>
            <td class="title-desc"> @if($data->healthSafetyRepresentatives) {{ $data->healthSafetyRepresentatives == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Worker duties – explained each worker has a legal duty to:</td>
            <td class="title-desc"> @if($data->workerDuties) {{ $data->workerDuties == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> First Aid – informed who First Aid officers are + location of first aid equipment / facitdties</td>
            <td class="title-desc"> @if($data->firstAid) {{ $data->firstAid == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Emergency response – informed who emergency wardens are + firefighting equipment and locations on the site</td>
            <td class="title-desc"> @if($data->emergencyResponse) {{ $data->emergencyResponse == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Emergency evacuation procedures – explained</td>
            <td class="title-desc"> @if($data->emergencyEvacuation) {{ $data->emergencyEvacuation == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Traffic management – informed of any designated parking areas + flow of traffic / trucks / mobile plant in and out of the site</td>
            <td class="title-desc"> @if($data->trafficManagement) {{ $data->trafficManagement == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Exclusion zones – informed of the requirements to follow any designated exclusion zones and not to enter those zones unless they are authorised to do so.</td>
            <td class="title-desc"> @if($data->exclusiveZones) {{ $data->exclusiveZones == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Mobile plant – beware of mobile plant on the site (e.g. forktdfts, excavators, cranes) and stay out their way at all times.</td>
            <td class="title-desc"> @if($data->mobilePlant) {{ $data->mobilePlant == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Scaffold safety - informed of the requirements not to tamper with scaffold under any circumstances (e.g. do not remove any scaffold parts) + follow safe working loads of the scaffold.</td>
            <td class="title-desc"> @if($data->scaffoldSafety) {{ $data->scaffoldSafety == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site amenities – e.g. toilet, drinking water facitdties, lunchroom (if apptdcable)</td>
            <td class="title-desc"> @if($data->siteAmenities) {{ $data->siteAmenities == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site access and exit points – informed of location</td>
            <td class="title-desc"> @if($data->siteAccess) {{ $data->siteAccess == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Daily sign-in / out register – informed of requirements to sign in & out each day using apptdcable register + its location</td>
            <td class="title-desc"> @if($data->dailySign) {{ $data->dailySign == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site noticeboard – informed of location of site noticeboard and workers responsibitdty to review it daily for important updates about the site</td>
            <td class="title-desc"> @if($data->siteNoticeboard) {{ $data->siteNoticeboard == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site no smoking potdcy – explained that no smoking is permitted whilst on the site</td>
            <td class="title-desc"> @if($data->siteNoSmoking) {{ $data->siteNoSmoking == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site drug and alcohol potdcy – explained that no worker is allowed to be working on the site if they are under the influence of drugs or alcohol</td>
            <td class="title-desc"> @if($data->siteDrug) {{ $data->siteDrug == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Site violence, bullying and harassment potdcy – explained that any violence, bullying or harassment is not allowed and will not be tolerated on the site</td>
            <td class="title-desc"> @if($data->siteViolence) {{ $data->siteViolence == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Hazard + incident reporting process – explained of that workers must report all hazards incidents, injuries to site management personnel immediately.</td>
            <td class="title-desc"> @if($data->hazardIncidentReport) {{ $data->hazardIncidentReport == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Stop Work Potdcy – explained that workers are to stop work immediately if they feel unsafe and report it to site management representative.</td>
            <td class="title-desc"> @if($data->stopWorkPolicy) {{ $data->stopWorkPolicy == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Induction to SWMS, safety procedures / instructions relevant to work / job – worker informed that they must be inducted on their employer’s SWMS + any other apptdcable safety procedures BEFORE they start work on the site</td>
            <td class="title-desc"> @if($data->swmsSafety) {{ $data->swmsSafety == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Housekeeping – workers to maintain a clean work site (clean up after themselves daily)</td>
            <td class="title-desc"> @if($data->housekeepingPolicy) {{ $data->housekeepingPolicy == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Electrical safety – all electrical equipment / tools to be tested & tagged (every 3 months) + be connected to RCD when being used on site + electrical leads to be elevated on stands</td>
            <td class="title-desc"> @if($data->electricSafety) {{ $data->electricSafety == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> Non-compliance with any site requirements / rules – informed that if found to be breaching any of the site rules or requirements may face disciplinary action including being banned from site.</td>
            <td class="title-desc"> @if($data->nonCompliance) {{ $data->nonCompliance == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Confirmation by inductee</span></td>
            <!--<td class="title-desc" style="padding-right: 0; background-color:gray;"></td>-->
         </tr>
         <tr>
            <td class="title"> I confirm that I have received, and been inducted into, the Safe Work Method Statements and any other applicable safe work procedures / instructions provided to me, by my employer.</td>
            <td class="title-desc"> @if($data->safeWorkMethodConfirmation) {{ $data->safeWorkMethodConfirmation == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title"> I confirm that I have the necessary skills, training, qualifications and/or experience to carry out the work/ job on the site.</td>
            <td class="title-desc"> @if($data->skillsConfirmation) {{ $data->skillsConfirmation == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         <tr>
            <td class="title bootomNone"> I confirm that I am able to speak, read and write English OR I have had the site induction translated / explained to me in a language that I can understand.</td>
            <td class="title-desc bootomNone"> @if($data->englishConfirmation) {{ $data->englishConfirmation == 1 ? 'YES' : 'NO' }} @endif </td>
         </tr>
         </table>
        
      
      <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="3" style="padding-left: 0; background-color:gray;"><span class="headlines">Declaration by inductee</span></td>
         </tr>
         <tr>
             <td colspan="3">
                 <p>I acknowledge that I have been advised on all of the above listed items and understand the points discussed. I hereby agree to follow the site policies, procedures, rules, and special conditions outlined during the site induction or that are in place from time to time. I accept that compliance to safe work practices is a condition of my continued access to the site and also a requirement under the health and safety legislation. I will also comply with any reasonable instruction given to me by site management or their representatives.</p>
             </td>
         </tr>

         <tr>
            <!-- <td>Identification Document Attachement:</td> -->
            <td colspan="3" style="text-align:center;">@if($data->identityDocument) <img style="width:50%;" src="{{ url($data->identityDocument) }}" /> @endif </td>
         </tr>

  <tr>
    <th style="padding-left: 0; background-color:gray; color:#fff;" >Apply Date</th>
    <th style="padding-left: 0; background-color:gray; color:#fff;">Inductee’s Name</th>  
    <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>
  </tr>
  <tr>
    <td>@if($data->applyDate) {{ $data->applyDate }} @endif</td>
    <td>@if($data->inducteeName) {{ $data->inducteeName }} @endif </td>
    <td>@if($data->inducteeSignature) <img style="width:200px;" src="{{ url($data->inducteeSignature) }}" /> @endif</td>
  </tr>
 
</table>
      
   </body>
</html>
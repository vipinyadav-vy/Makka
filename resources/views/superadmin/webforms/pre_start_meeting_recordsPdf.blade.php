<!DOCTYPE html>
<html>
   <head>
      <title>Pre Start Meeting</title>
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
               <h2>Pre-Start Meeting Record</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Project</td>
            <td>@if($preMeetingrecord->projectname) {{ $preMeetingrecord->projectname }} @endif</td>
         </tr>
         <tr> 
            <td> Date :</td>
            <td> @if($preMeetingrecord->pre_meeting_date) {{ $preMeetingrecord->pre_meeting_date }} @endif</td>
         </tr>
         <tr>
            <td> Conducted by:</td>
            <td> @if($preMeetingrecord->conducted_by) {{ $preMeetingrecord->conducted_by }} @endif </td>
         </tr>
         <tr>
            <td>Conducted by Sign:</td>
            <td>@if($preMeetingrecord->conducted_by_signature) <img style="width:200px;" src="{{ url($preMeetingrecord->conducted_by_signature) }}" /> @endif</td>
         </tr>
         <tr>
            <td> Representative:</td>
            <td> @if($preMeetingrecord->representative) {{ $preMeetingrecord->representative }} @endif </td>
         </tr>
         <tr>
            <td> Representative Sign:</td>
            <td>@if($preMeetingrecord->representative_signature) <img style="width:200px;" src="{{ url($preMeetingrecord->representative_signature) }}" /> @endif</td>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Discussion</span></td>
         </tr>
         <tr>
            <td colspan="2"> @if($preMeetingrecord->discussion) {{ $preMeetingrecord->discussion }} @endif </td>
         </tr>
         </table>

         <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="2" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Topics to be addressed:</span></td>
         </tr>
           
            <?php foreach ($preMeetingTopics as $key => $value) { ?>
                
            <tr>
                <td colspan="2">{{ $value->topics }}</td>
            </tr>
            <?php } ?>
        </table>

        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="4" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Corrective Action (where applicable)</span></td>
         </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;" >Corrective Action</th>
               <th style="padding-left: 0; background-color:gray; color:#fff;">Action by</th>  
               <th style="padding-left: 0; background-color:gray; color:#fff;">Sign off</th>
               <th style="padding-left: 0; background-color:gray; color:#fff;">Date</th>
            </tr>
            <?php foreach($preMeetingCorrective as $key => $value){ ?> 
            <tr>
                <td>{{ $value->corrective_action }}</td>
                <td> {{ $value->action_by }}</td>
                <td> {{ $value->action_sign_off }}</td>
                <td> {{ $value->action_date }}</td>
            </tr>
            <?php } ?>
        </table>

        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="2" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Attendance</span></td>
         </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;"> Name</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>  
            </tr>
            <?php foreach ($preMeetingAttendance as $key => $value) { ?> 
            <tr>
                <td>{{ $value->name }}</td>
                <td><img style="width:200px;" src="{{ url($value->signature) }}" /></td>
            </tr>
            <?php } ?>
        </table>

   </body>
</html>
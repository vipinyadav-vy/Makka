<!DOCTYPE html>
<html>
   <head>
      <title>Tool Box Talk Record</title>
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
               <h2>ToolBox Talk Record</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Site / Project / Location</td>
            <td>@if($tollboxtalkrecord->projectname) {{ $tollboxtalkrecord->projectname }} @endif</td>
         </tr>
         <tr> 
            <td> Date :</td>
            <td> @if($tollboxtalkrecord->tollbox_talk_record_date) {{ $tollboxtalkrecord->tollbox_talk_record_date }} @endif</td>
         </tr>
         <tr>
            <td> Conducted by:</td>
            <td> @if($tollboxtalkrecord->conducted_by) {{ $tollboxtalkrecord->conducted_by }} @endif </td>
         </tr>
         <tr>
            <td> Site Topic:</td>
            <td> @if($tollboxtalkrecord->site_topic) {{ $tollboxtalkrecord->site_topic }} @endif </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Discussion</span></td>
         </tr>
         <tr>
            <td colspan="2"> @if($tollboxtalkrecord->discussion) {{ $tollboxtalkrecord->discussion }} @endif </td>
         </tr>
         </table>

         <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="2" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Action</span></td>
         </tr>
           
            <?php foreach ($tollboxtalkrecordAction as $key => $value) { ?>

                <tr>
                <th colspan="2" style="padding-left: 0; background-color:gray; color:#fff;" >Description</th>
            </tr>
            <tr>
                <td colspan="2">{{ $value->actionDescription }}</td>
            </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;">Responsible</th>  
                <th style="padding-left: 0; background-color:gray; color:#fff;">Due Date</th>
            </tr>
            <tr>
                <td>{{ $value->actionResponsible }}</td>
                <td>{{ $value->actionDueDate }}</td>
            </tr>
            <?php } ?>
        </table>

        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="3" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Attendance & Sign-Off</span></td>
         </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;" >Worker Name</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>  
                <th style="padding-left: 0; background-color:gray; color:#fff;">Date</th>
            </tr>
            <?php foreach ($tollboxtalkrecordAttendance as $key => $value) { ?> 
            <tr>
                <td>{{ $value->worker_name }}</td>
                <td><img style="width:200px;" src="{{ url($value->worker_signature) }}" /></td>
                <td> {{ $value->signature_date }}</td>
            </tr>
            <?php } ?>
        </table>

   </body>
</html>
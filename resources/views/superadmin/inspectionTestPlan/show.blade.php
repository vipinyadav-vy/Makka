<!DOCTYPE html>
<html>
   <head>
      <title>Inspection Test Plan</title>
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
               <h2>Inspection Test Plan</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Project</td>
            <td>@if($inspectionrecord->projectname) {{ $inspectionrecord->projectname }} @endif</td>
         </tr>
         <tr> 
            <td> ITP Reference No. :</td>
            <td> @if($inspectionrecord->itp_refrence_no) {{ $inspectionrecord->itp_refrence_no }} @endif</td>
         </tr>
         <tr>
            <td> Revision No.:</td>
            <td> @if($inspectionrecord->revision_no) {{ $inspectionrecord->revision_no }} @endif </td>
         </tr>
         <tr>
            <td>Revision Date:</td>
            <td>@if($inspectionrecord->revision_date) {{ $inspectionrecord->revision_date }} @endif</td>
         </tr>
         <tr>
            <td> Scope of Works:</td>
            <td> @if($inspectionrecord->work_scope) {{ $inspectionrecord->work_scope }} @endif </td>
         </tr>
         <tr>
            <td> Work Area:</td>
            <td>@if($inspectionrecord->work_area) {{ $inspectionrecord->work_area }} @endif</td>
         </tr>
         <tr>
            <td>Level:</td>
            <td>@if($inspectionrecord->level) {{ $inspectionrecord->level }} @endif</td>
         </tr>
         </table>

         

        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="3" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">TRADE DETAILS</span></td>
         </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;" >Subcontractor Name</th>
               <th style="padding-left: 0; background-color:gray; color:#fff;">Representative</th>  
               <th style="padding-left: 0; background-color:gray; color:#fff;">Trade Contact No.</th>
            </tr>
            <?php foreach ($inspectionTrade as $key => $value) { ?> 
            <tr>
                <td>{{ $value->subcontractor_name }}</td>
                <td> {{ $value->representative }}</td>
                <td> {{ $value->trade_phone }}</td>
            </tr>
            <?php } ?>
        </table>
        
        
        <table class="half-column bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="2" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">INSPECTION AND TESTING</span></td>
         </tr>
         <tr>
            <td>Item No.</td>
            <td>@if($inspectionrecord->item_no) {{ $inspectionrecord->item_no }} @endif</td>
         </tr>
         <tr> 
            <td> Quality standard or characteristic to be verified:</td>
            <td> @if($inspectionrecord->quality_standard) {{ $inspectionrecord->quality_standard }} @endif</td>
         </tr>
         <tr>
            <td> Stage / frequency:</td>
            <td> @if($inspectionrecord->stage) {{ $inspectionrecord->stage }} @endif </td>
         </tr>
         <tr>
            <td>Method (refer to key):</td>
            <td>@if($inspectionrecord->method) {{ $inspectionrecord->method }} @endif</td>
         </tr>
         <tr>
            <td> Date completed:</td>
            <td> @if($inspectionrecord->completed_date) {{ $inspectionrecord->completed_date }} @endif </td>
         </tr>
         <tr>
            <td> Record / evidence (attach to this ITP for future reference)</td>
            <td>@if($inspectionrecord->record) {{ $inspectionrecord->record }} @endif</td>
         </tr>
         <tr>
            <td>Subcontractor sign-off</td>
            <td>@if($inspectionrecord->subcontractor_sign_off) {{ $inspectionrecord->subcontractor_sign_off }} @endif</td>
         </tr>
         <tr>
            <td>PC sign-off</td>
            <td>@if($inspectionrecord->pc_sign_off) {{ $inspectionrecord->pc_sign_off }} @endif</td>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Discussion</span></td>
         </tr>
         <tr>
            <td colspan="2"> @if($inspectionrecord->discussion) {{ $inspectionrecord->discussion }} @endif </td>
         </tr>
         </table>
        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
            <tr>
                <td colspan="3" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Area Completion PC Representative</span></td>
            </tr>
            <tr>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Name</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Date</th>  
            </tr>
            <?php foreach ($inspectionRepresentative as $key => $value) {
                if($value->representativeType == 1){ ?> 
                <tr>
                    <td>{{ $value->representative }}</td>
                    <td><img style="width:200px;" src="{{ url($value->signature) }}" /></td>
                    <td>{{ $value->area_completion_date }}</td>
                </tr>
                <?php } } ?>
        </table>
        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
            <tr>
                <td colspan="3" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Area Completion Subcontractor Representative</span></td>
            </tr>
            <tr>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Name</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Signature</th>
                <th style="padding-left: 0; background-color:gray; color:#fff;">Date</th>  
            </tr>
            <?php foreach ($inspectionRepresentative as $key => $value) { 
                if($value->representativeType == 2){ ?> 
                <tr>
                    <td>{{ $value->representative }}</td>
                    <td><img style="width:200px;" src="{{ url($value->signature) }}" /></td>
                    <td>{{ $value->area_completion_date }}</td>
                </tr>
                <?php } } ?>
        </table>

   </body>
</html>
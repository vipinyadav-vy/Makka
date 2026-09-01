<!DOCTYPE html>
<html>
   <head>
      <title>Supplier & Contractor Car</title>
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
               <h2>SUPPLIER & CONTRACTOR CAR</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Project details</span></td>
         </tr>
         <tr>
            <td>Project / Job refrence</td>
            <td>@if($supContCarRecord->projectname) {{ $supContCarRecord->projectname }} @endif</td>
         </tr>
         <tr>
            <td>Location</td>
            <td> @if($supContCarRecord->location) {{ $supContCarRecord->location }} @endif </td>
         </tr>
         <tr>
            <td>Supplier / Contractor</td>
            <td> @if($supContCarRecord->supplier) {{ $supContCarRecord->supplier }} @endif </td>
         </tr>
         <tr>
            <td>Issued By</td>
            <td> @if($supContCarRecord->issued_by) {{ $supContCarRecord->issued_by }} @endif </td>
         </tr>
         <tr> 
            <td> Date :</td>
            <td> @if($supContCarRecord->supply_contractor_car_date) {{ $supContCarRecord->supply_contractor_car_date }} @endif</td>
         </tr>
         
        
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Satisfactory / Unsatisfactory</span></td>
         </tr>
         <tr>
            <td colspan="2"> @if($supContCarRecord->satisfactory) {{ $supContCarRecord->satisfactory }} @endif </td>
         </tr>
         </table>

         

        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
          <tr>
            <td colspan="4" style="text-align:center; padding-left: 0;"><span style="font-size:24px; color:black;" class="headlines">Corrective Action (where applicable)</span></td>
         </tr>
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;" >Problem</th>
               <th style="padding-left: 0; background-color:gray; color:#fff;">Action</th>  
               <th style="padding-left: 0; background-color:gray; color:#fff;">Due Date</th>
               <th style="padding-left: 0; background-color:gray; color:#fff;">Closed Date</th>
            </tr>
            <?php foreach($supContCarProblemRecord as $key => $value){ ?>  
            <tr>
                <td>{{ $value->problem }}</td>
                <td> {{ $value->action }}</td>
                <td> {{ $value->due_date }}</td>
                <td> {{ $value->close_date }}</td>
            </tr>
            <?php } ?>
        </table>
        <table class="half-column" width="100%" style="border-spacing: 0; border:1px solid #000;">
            <tr>
            <th style="padding-left: 0; background-color:gray; color:#fff;"> Corrective action verified</th>
            <th style="padding-left: 0; background-color:gray; color:#fff;"> Name</th>
            <th style="padding-left: 0; background-color:gray; color:#fff;"> Position</th>
            <th style="padding-left: 0; background-color:gray; color:#fff;"> Date</th>
            </tr>
            <?php foreach ($supContCarCorrective as $key => $value) { ?> 
            <tr>
                <td>{{ $value->corrective_action }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->position }}</td>
                <td>{{ $value->date }}</td>
            </tr>
            <?php } ?>
        </table>

   </body>
</html>
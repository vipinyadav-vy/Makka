@extends('layouts.admin')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="card">
    <div class="card-header">
      Contractor Pre-Start Checklist
    </div>
       <div class="card-body" >
        <table class="table table-bordered table table-bordered table-striped table-hover">
             <thead class="thead-dark">
                <tr class="text-center">
                <th>Document</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>
            
            @if($data->insurance_policy == 1)
              <tr> 
             <td>
                 Current public liability insurance policy (copies required).
             </td>
               <td>
                   <?php 
                $attacheddata = explode(",", $data->insurance_policy_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank">
                    <?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?>
                    </a>
            <?php } ?>

                
               </td>
              </tr>
              @endif
              
              @if($data->compensation_policy == 1)
              <tr> 
             <td>
                 Current workers compensation policy (copies required)
             </td>
             <td>
                   <?php 
                $attacheddata = explode(",", $data->compensation_policy_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank">
                    <?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?>
                    </a>
            <?php } ?>
               </td>
              </tr>
              @endif
              
               @if($data->qualifications == 1)
              <tr> 
                 <td>
                     Are licences/qualifications required for the tasks being undertaken? E.g. Contractor Licence, induction card, high risk work licence (e.g. forklift), first aid (copies required)
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->qualifications_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                  
              </tr>
              @endif
              
              @if($data->risk_injury == 1)
              <tr> 
                 <td>
                     Is the work being undertaken medium to high risk where there is a risk of a severe or permanent injury? (if yes, evidence of risk assessments and/or safe procedures such as a safe operating procedure (SOP) or a safe work method statement (SWMS) must be provided)
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->risk_injury_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->specific_emergency_plan == 1)
              <tr> 
                 <td>
                     Does the task require a specific emergency plan? eg. working in remote or isolated areas, working with harnesses, rescue from heights plan (copies required)
                 </td>
                 
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->specific_emergency_plan_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->records_plant_equipment == 1)
              <tr> 
                 <td>
                     Provided all registration, insurances, maintenance and service records for plant and equipment.
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->records_plant_equipment_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->plant_brought_site == 1)
              <tr> 
                 <td>
                     Is there a maintenance register of the plant being brought to site? (copies required).
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->plant_brought_site_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->exposure_standards == 1)
              <tr> 
                 <td>
                     Will exposure standards be met? Please provide details
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->exposure_standards_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->testing_records == 1)
              <tr> 
                 <td>
                     Are copies of testing records available?(copies required)
                 </td>
                  <td>
                   <?php 
                $attacheddata = explode(",", $data->testing_records_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->training_competency == 1)
              <tr> 
                 <td>
                     Are training and competency records related to the tasks being undertaken available? (copies required)
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->training_competency_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/preStartChecklist/'.$attachedval) }}" title="View Attachment" download target="_blank"><?php
                    $last10Characters = substr($attachedval, -40);
                    echo $last10Characters; ?></a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
             
          </tbody>
            </table> 
             </div>
    </div>
@endsection
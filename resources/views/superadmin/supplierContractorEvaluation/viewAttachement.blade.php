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
      Supplier & Contractor Evaluation Attachement
    </div>
       <div class="card-body" >
        <table class="table table-bordered table table-bordered table-striped table-hover">
             <thead class="thead-dark">
                <tr class="text-center">
                <th>Evaluation Criteria</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>
            
            @if($data->certified_quality == 1)
              <tr> 
             <td>
                 Does your company have a certified quality, safety or environmental management system? If Yes please attach copies of certificates and management system index.
             </td>
               <td>
                   <?php 
                $attacheddata = explode(",", $data->certified_quality_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">
                    <?php
                    $last10Characters = substr($attachedval, -40);
                    
                    echo $last10Characters; ?>
                    
                    </a>
            <?php } ?>

                
               </td>
              </tr>
              @endif
              
              @if($data->quality_assurance == 1)
              <tr> 
             <td>
                 Is there a published Quality Assurance; Safety; Environmental Policy? If Yes, please attach copies of relevant policies.
             </td>
             <td>
                   <?php 
                $attacheddata = explode(",", $data->quality_assurance_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
              </tr>
              @endif
              
               @if($data->verify_worker_competency == 1)
              <tr> 
                 <td>
                     Does your company verify worker competency? If so, how?
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->verify_worker_competency_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                  
              </tr>
              @endif
              
              @if($data->organisation_insurances_licences_qualifications == 1)
              <tr> 
                 <td>
                     Does the organisation have appropriate insurances, licences and qualifications? Provide copies.
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->insurances_licences_qualifications_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->prosecuted_issue == 1)
              <tr> 
                 <td>
                     Has your organisation previously been fined, prosecuted, issued with a prohibition or improvement notice by the applicable Safety or environmental regulator? If ‘Yes’, please provide details.
                 </td>
                 
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->prosecuted_issue_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->under_investigation_environmental_laws == 1)
              <tr> 
                 <td>
                     Is your company currently under investigation for a breach of safety and/or environmental laws? if yes, specify
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->under_investigation_environmental_laws_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->company_officers_criminal_offence == 1)
              <tr> 
                 <td>
                     Have any of your company officers previously been charged or convicted of a criminal offence? If Yes, please specify.
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->company_officers_criminal_offence_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->procedures_systems == 1)
              <tr> 
                 <td>
                     Does the company have procedures / systems in place for the management and supervision of their workers and/or contractors? If Yes, please specify and provide examples.
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->procedures_systems_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
               @if($data->staff_qualified_administering_first_aid == 1)
              <tr> 
                 <td>
                     Are any of your staff qualified in administering First Aid? If ‘Yes’, what % of your workforce?
                 </td>
                  <td>
                   <?php 
                $attacheddata = explode(",", $data->staff_qualified_administering_first_aid_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->materials_return_credit_policy == 1)
              <tr> 
                 <td>
                     If supplying materials, products, plant or equipment do you have a returns and/or credit policy? If ‘Yes’, please provide a copy.
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->materials_return_credit_policy_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
              @if($data->trade_references == 1)
              <tr> 
                 <td>
                     Provide details of three trade references that we may contact to get more information about your company
                 </td>
                 <td>
                   <?php 
                $attacheddata = explode(",", $data->trade_references_doc);
                foreach($attacheddata as $attachedval) { ?>
                <a class="btn btn-sm btn-success my-1" href="{{ url('public/suppliercontractorevalution/'.$attachedval) }}" title="View Attachment" download target="_blank">View Attachment</a>
            <?php } ?>
               </td>
                   
              </tr>
              @endif
              
          <tr>
          </tbody>
            </table> 
             </div>
    </div>
@endsection
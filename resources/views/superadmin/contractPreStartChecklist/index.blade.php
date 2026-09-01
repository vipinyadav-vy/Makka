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
<div class="row m-3">
   <form class="form-inline" method="GET">
   <div class="col-md-2">
      <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" >
   </div>
   <div class="col-md-2">
      <input type="date" class="form-control" name="to_date" id="to_date" autocomplete="off">
   </div>
   <div class="col-md-2">
      <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Filter</button>
      <a href="{{url('superadmin/contractPreStartChecklist')}}" class="btn btn-success filter">Reset Filter</a>
   </div>
</form>
</div>
<div class="card-header">
<div class="container">
   <div class="card-body resultData" >
<table  class="table table-bordered data-table table table-bordered table-striped table-hover  datatable ">
         <thead class="thead-dark">
            <tr class="text-center">
            <th>S. No</th>
               <th>Name</th>
               <th>ABN/CAN</th>
               <th>Phone</th>
               <th>Email</th> 
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($data as $row)
        <?php $i++; ?>
          <tr> 
           <td>{{ $i ;}}</td>
           <td>{{ $row->name }}</td>
           <td>{{ $row->abn_can }}</td>
           <td>{{ $row->phone_no }}</td>
            <td>{{ $row->email }}</td>
           <td>
            <span class="view-resend-action">
                <a class="btn btn-sm btn-success my-1" href="{{ route('contractPreStartChecklistAttach', $row->id) }}" title="View Attachement" target="_blank">View Attachement</a>
            </span>
            <span class="view-resend-action">
                <a class="btn btn-sm btn-success my-1" href="{{ route('contractPreStartChecklist.show', $row->id) }}" title="View Pdf" target="_blank">View PDF</a>
                </span>
           </td>
          </tr>
      @endforeach
      <tr>
       <td colspan="6" align="center">
        {!! $data->links() !!}
       </td>
      </tr>
      </tbody>
        </table> 
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
         </div>
</div>
@endsection
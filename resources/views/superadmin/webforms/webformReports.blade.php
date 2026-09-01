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
  Site Induction Report
</div>
<div class="row m-3">
   <form class="form-inline" method="GET">
   <div class="col-md-2">
      <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>" >
   </div>
   <div class="col-md-2">
      <input type="date" class="form-control" name="to_date" id="to_date" autocomplete="off" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
   </div>
   <div class="col-md-2">
      <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Filter</button>
      <a href="{{ route('webformReports') }}" class="btn btn-success filter">Reset Filter</a>
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
               <th>Project</th>
               <th>Worker Name</th>
               <th>Date</th>
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
       <td>{{ $row->projectname }}</td>
       <td>{{ $row->workerName }}</td>
       <td>{{ $row->applyDate }}</td>
       <td>
       <span class="view-resend-action"><form name="accountManager" method="POST" action="{{route('resendMail')}}" enctype="multipart/form-data" autocomplete="off">
           @csrf
           <input type="hidden" name="siteInductionReportId" value="{{ $row->id}}" />
           <input type="hidden" class="formId" name="formId" value="{{ $row->webFormId}}"/>
        <button class="btn btn-sm  btn-success my-1" type="submit">Resend</button>
       </form></span>
       <span class="view-resend-action"><a class="btn btn-sm btn-success my-1" href="{{ route('webformReportsPdf', ['id' => $row->id]) }}" title="View Pdf" target="_blank">View PDF</a></span>
       </td>
       
      </tr>
      @endforeach
      <tr>
       <td colspan="5" align="center">
        {!! $data->links() !!}
       </td>
      </tr>
      </tbody>
        </table> 
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
         </div>
</div>
@endsection
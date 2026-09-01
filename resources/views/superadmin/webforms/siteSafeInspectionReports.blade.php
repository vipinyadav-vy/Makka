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
  Site Safe Inspection Report
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
      <a href="{{ route('siteSafetInspectionReports') }}" class="btn btn-success filter">Reset Filter</a>
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
               <th>Location</th>
               <th>Area inspected</th>
               <th>Inspected by</th>
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
       <td>{{ $row->location }}</td>
       <td>{{ $row->area_inspected }}</td>
       <td>{{ $row->inspected_by }}</td>
       <td>{{ $row->date }}</td>
       <td>
      <span class="view-resend-action">
          <form name="accountManager" method="POST" action="{{route('siteSafeInspectionResendMail')}}" enctype="multipart/form-data" autocomplete="off">
           @csrf
           <input type="hidden" name="siteSafeInspectionReportId" value="{{ $row->id}}" />
           <input type="hidden" class="formId" name="formId" value="{{ $row->webFormId}}"/>
        <button class="btn btn-sm  btn-success my-1" type="submit">Resend</button>
       </form></span>
       <span class="view-resend-action">
         <a class="btn btn-sm btn-success my-1" href="{{ route('siteSafeInspectionReportsPdf', ['id' => $row->id]) }}" title="View Pdf" target="_blank">View PDF</a></span>
                    
       </td>
      
      </tr>
      @endforeach
      <tr>
       <td colspan="7" align="center">
        {!! $data->links() !!}
       </td>
      </tr>


      </tbody>
        </table>

    
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        
         </div>
</div>



<script>
// $(document).ready(function(){
//  function fetch_data(page, from_date, to_date) {
//     $.ajax({
//         url: "{{ route('siteSafetInspectionReports-site_Safe_inspection_fetch_data') }}?page=" + page + "&from_date=" + from_date + "&to_date=" + to_date,
//         success: function (data) {
//             $('.resultData').html('');
//             $('.resultData').html(data);
//         }
//     });
// }

//   $(document).on("change","#form_filter",function(){
//    var page = 1;
//    //var query = $('#serach').val();
//    var from_date = $('#from_date').val();
//    var to_date = $('#to_date').val();

//   fetch_data(page, from_date, to_date);
//   });



//    $("#filters").click(function() {
//       var page = 1;
// //var query = $('#serach').val();
// var from_date = $('#from_date').val();
// var to_date = $('#to_date').val();

//   fetch_data(page, from_date, to_date);
//  });



//  $(document).on('click', '.pagination a', function(event){
//   event.preventDefault();
//   var page = $(this).attr('href').split('page=')[1];
//   $('#hidden_page').val(page);
//   //var query = $('#serach').val();
//   var from_date = $('#from_date').val();
//   var to_date = $('#to_date').val();

//   $('li').removeClass('active');
//         $(this).parent().addClass('active');
//   fetch_data(page, from_date, to_date);
//  });

// });
</script>

@endsection
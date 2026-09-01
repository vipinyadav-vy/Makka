

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
       <td>{{ $row->project }}</td>
       <td>{{ $row->workerName }}</td>
       <td>{{ $row->applyDate }}</td>
       <td>
       <form name="accountManager" method="POST" action="{{route('resendMail')}}" enctype="multipart/form-data" autocomplete="off">
           @csrf
           <input type="hidden" name="siteInductionReportId" value="{{ $row->id}}" />
           <input type="hidden" class="formId" name="formId" value="{{ $row->webFormId}}"/>
        <button class="btn btn-sm  btn-success my-1" type="submit">Resend</button>
       </form>
       <a class="btn btn-sm btn-success my-1" href="{{ route('webformReportsPdf', ['id' => $row->id]) }}" title="View Pdf" target="_blank">View PDF</a>
                    
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
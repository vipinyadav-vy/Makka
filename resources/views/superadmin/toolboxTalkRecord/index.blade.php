@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       ToolBox Talk Records List
       <a class="btn btn-primary float-right"  href="{{ route('toolBoxTalkRecords.create') }}">
        Add Record
      </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">Project</th>
                    <th scope="col">Date</th>
                    <th scope="col">Conducted By</th>
                    <th scope="col">Site Topic</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tooltalkRecords) > 0)
                @php $i = 0; @endphp
                @foreach($tooltalkRecords as $tooltalkRecordsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $tooltalkRecordsval->projectname }}</td>
                    <td>{{ $tooltalkRecordsval->tollbox_talk_record_date }}</td>
                    <td>{{ $tooltalkRecordsval->conducted_by }}</td>
                    <td>{{ $tooltalkRecordsval->site_topic }}</td>
                    <td>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('toolBoxTalkAttendance', $tooltalkRecordsval->id) }}" title="Edit">Share</a>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('toolBoxTalkRecords.show', $tooltalkRecordsval->id) }}" title="Edit">View</a></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td style="text-align: center;" colspan="6">No Record Found</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $tooltalkRecords->links() !!}
        </div>
    </div>
</div>

@endsection
    
    



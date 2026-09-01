@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Pre Start Meeting Records List
       <a class="btn btn-primary float-right"  href="{{ route('preStartMeetings.create') }}">
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
                    <th scope="col">Representative</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($preMeetingRecords) > 0)
                @php $i = 0; @endphp
                @foreach($preMeetingRecords as $preMeetingRecordsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $preMeetingRecordsval->projectname }}</td>
                    <td>{{ $preMeetingRecordsval->pre_meeting_date }}</td>
                    <td>{{ $preMeetingRecordsval->conducted_by }}</td>
                    <td>{{ $preMeetingRecordsval->representative }}</td>
                    <td>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('preStartMeeting', $preMeetingRecordsval->id) }}" title="Edit">Share</a>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('preStartMeetings.show', $preMeetingRecordsval->id) }}" title="Edit">View</a></td>
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
            {!! $preMeetingRecords->links() !!}
        </div>
    </div>
</div>

@endsection
    
    



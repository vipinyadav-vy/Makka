@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Inspection Test Plan List
       <a class="btn btn-primary float-right"  href="{{ route('inspectionTestPlan.create') }}">
        Add Record
      </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">Project</th>
                    <th scope="col">ITP Reference No.</th>
                    <th scope="col">Revision No.</th>
                    <th scope="col">Scope of works</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($inscpectionRecords) > 0)
                @php $i = 0; @endphp
                @foreach($inscpectionRecords as $inscpectionRecordsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th> 
                    <td>{{ $inscpectionRecordsval->projectname }}</td>
                    <td>{{ $inscpectionRecordsval->itp_refrence_no }}</td>
                    <td>{{ $inscpectionRecordsval->revision_no }}</td>
                    <td>{{ $inscpectionRecordsval->work_scope }}</td>
                    <td>
                        <a class="btn btn-sm btn-success my-1" target="_blank" href="{{ route('inspectionTestPlan', ['id' => $inscpectionRecordsval->id, 'type' => 'PC']) }}" title="Share">Share With PC Representative</a>
                        <a class="btn btn-sm btn-success my-1" target="_blank" href="{{ route('inspectionTestPlan', ['id' => $inscpectionRecordsval->id, 'type' => 'SC']) }}" title="Share">Share With SubContractor</a>
                        <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('inspectionTestPlan.show', $inscpectionRecordsval->id) }}" title="Edit">View</a>
                    </td>
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
            {!! $inscpectionRecords->links() !!}
        </div>
    </div>
</div>

@endsection
    
    



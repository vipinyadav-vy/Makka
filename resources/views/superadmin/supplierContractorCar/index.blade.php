@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Supplier & Contractor Car
       <a class="btn btn-primary float-right"  href="{{ route('supplierContractorCar.create') }}">
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
                    <th scope="col">Issued By</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($supContCarRecords) > 0)
                @php $i = 0; @endphp
                @foreach($supContCarRecords as $supContCarRecordsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $supContCarRecordsval->projectname }}</td>
                    <td>{{ $supContCarRecordsval->supply_contractor_car_date }}</td>
                    <td>{{ $supContCarRecordsval->issued_by }}</td>
                    <td>{{ $supContCarRecordsval->supplier }}</td>
                    <td>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('supplierContractorCar', $supContCarRecordsval->id) }}" title="Edit">Share</a>
                    <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('supplierContractorCar.show', $supContCarRecordsval->id) }}" title="Edit">View</a></td>
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
            {!! $supContCarRecords->links() !!}
        </div>
    </div>
</div>

@endsection
    
    



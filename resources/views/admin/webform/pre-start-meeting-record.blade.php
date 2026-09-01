@extends('admin.layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    Pre Start Meeting Record
    </div>
    <!-- <div class="rowd m-3">
        <form class="form-inline" method="GET">
            <div class="col-md-2">
                <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" >
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="to_date" id="to_date" autocomplete="off">
            </div>
            <div class="col-md-2">
                <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Filter</button>
                <a href="{{ route('webformReport') }}" class="btn btn-success filter">Reset Filter</a>
            </div>
        </form>
    </div> -->
    <div class="card-header">
        <div class="card-body" >   
            <table  class="table table-bordered data-table table table-bordered table-striped table-hover  datatable ">
                <thead class="thead-dark">
                <tr style="text-align:center;">
                <th scope="col">S. No</th>
                    <th scope="col">Project</th>
                    <th scope="col">Date</th>
                    <th scope="col">Conducted By</th>
                    <th scope="col">Representative</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                
                <tbody>
                @if(count($data) > 0)
                    @php
                    $i = 0;
                    @endphp
                    @foreach($data as $row)
                    <?php $i++; ?>
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $row->projectname }}</td>
                        <td>{{ $row->pre_meeting_date }}</td>
                        <td>{{ $row->conducted_by }}</td>
                        <td>{{ $row->representative }}</td> 
                        <td>
                            <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('preStartMeeting', $row->id) }}" title="Share">Share</a>
                            <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('view-pre-start-meeting', $row->id) }}" title="View">View</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td style="text-align: center;" colspan="6">No Record Found</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="5" align="center">
                            {!! $data->links() !!}
                        </td>
                    </tr>
                </tbody>
            </table>         
        </div>
    </div>
</div>

@endsection

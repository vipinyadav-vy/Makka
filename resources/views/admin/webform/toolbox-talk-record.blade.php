@extends('admin.layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
   Tool Box Record
    </div>
    <div class="rowd m-3">
        <form class="form-inline" method="GET">
            <div class="col-md-2">
            <input type="hidden" name="pId" value="<?php if(!empty($_GET['pId'])){ echo $_GET['pId']; } ?>" >

                <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" value="<?php if(!empty($_GET['from_date'])){ echo $_GET['from_date']; } ?>" >
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="to_date" id="to_date" autocomplete="off" value="<?php if(!empty($_GET['to_date'])){ echo $_GET['to_date']; } ?>">
            </div>
            <div class="col-md-2">
                <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Filter</button>
                <a href="{{ route('webformReport') }}" class="btn btn-success filter">Reset Filter</a>
            </div>
        </form>
    </div>
    <div class="card-header">
        <div class="card-body" >   
            <table  class="table table-bordered data-table table table-bordered table-striped table-hover  datatable ">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">S. No</th>
                    <th scope="col">Project</th>
                    <th scope="col">Date</th>
                    <th scope="col">Conducted By</th>
                    <th scope="col">Site Topic</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($data as $row)
                    <?php $i++; ?>
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $row->projectname }}</td>
                        <td>{{ $row->tollbox_talk_record_date }}</td>
                        <td>{{ $row->conducted_by }}</td>
                        <td>{{ $row->site_topic }}</td>
                        <td>
                        <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('toolBoxTalkAttendance', $row->id) }}" title="Share">Share</a>
                        <a class="btn btn-sm  btn-success my-1" target="_blank" href="{{ route('view-tool-box-record', $row->id) }}" title="View">View</a></td>
                    </tr>
                    @endforeach
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

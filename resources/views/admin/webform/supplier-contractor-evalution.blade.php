@extends('admin.layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    Supplier & Contractor Evaluation
    </div>
    <div class="rowd m-3">
        <form class="form-inline" method="GET">
            <div class="col-md-2">
                <input type="hidden" name="pId" value="{{ request('pId') }}" >
                <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="to_date" id="to_date" autocomplete="off" value="{{ request('to_date') }}">
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
                                <!--<form name="accountManager" method="POST" action="{{route('siteInductionResendMail')}}" enctype="multipart/form-data" autocomplete="off">-->
                                <!--    @csrf-->
                                <!--    <input type="hidden" name="siteInductionReportId" value="{{ $row->id}}" />-->
                                <!--    <input type="hidden" class="formId" name="formId" value="{{ $row->webFormId}}"/>-->
                                <!--    <button class="btn btn-sm  btn-success my-1" type="submit">Resend</button>-->
                                <!--</form>-->
                                <a class="btn btn-sm btn-success my-1" href="{{ route('view-supplier-contractor-evalution', ['id' => $row->id]) }}" title="View Pdf" target="_blank">View PDF</a>
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
        </div>
    </div>
</div>

@endsection

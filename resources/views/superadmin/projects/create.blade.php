@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-white">
                    <div class="card-header">
                        <h3 class="card-title">Create Project</h3>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form method="POST" action="{{route('projects.store')}}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-row form-set">
                                <div class="form-group col-12">
                                    <label for="projectName">Project</label>
                                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="projectName" autocomplete="off" placeholder="Enter Project Name" required>
                                </div>
                            </div>
                            <div class="form-row"><div class="form-group col-12"><hr></div></div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <h5 class="card-title font-weight-bold">Link Webforms for Project</h5>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                @foreach($webforms as $webformval)
                                <div class="form-group col-4 pl-4">
                                    <div class="form-check icheck-primary form-check-inline">
                                        <input name="webforms[]" class="form-check-input project-checkbox" type="checkbox" id="webforms_{{ $webformval->id }}" value="{{ $webformval->id }}">
                                        <label class="form-check-label pl-2" for="webforms_{{ $webformval->id }}">{{ $webformval->title }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

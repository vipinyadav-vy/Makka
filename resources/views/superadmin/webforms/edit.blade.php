@extends('layouts.admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-white">
                        <div class="card-header">
                            <h3 class="card-title">Edit Web Form</h3>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right text-white">Back</a>
                        </div>
                        <form name="webform" method="POST" action="{{ route('webforms.update', [$webForm->id]) }}"
                            enctype="multipart/form-data" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="conatiner">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                               
                                                <div class="col-md-6">
                                                    <label for="exampleInputName1">Form Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        id="title" value="{{ $webForm->title }}"
                                                        autocomplete="off" placeholder="Form Title" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputName1">Status</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="">Select Status</option>
                                                        <option {{ $webForm->status == 1 ? 'selected' : '' }} value="1"> Active</option>
                                                        <option {{ $webForm->status == 0 ? 'selected' : '' }} value="0"> InActive</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="toMail">To E-mail</label>
                                                    <input type="email" class="form-control" name="toMail" id="toMail"
                                                        value="{{ $webForm->toMail }}" autocomplete="off"
                                                        placeholder="To Mail" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ccMail">CC Mail</label>
                                                    <input type="email" class="form-control" name="ccMail" id="ccMail"
                                                        value="{{ $webForm->ccMail }}" autocomplete="off"
                                                        placeholder="CC Mail">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="usersubmit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    
<script>
$(function() {
  $("form[name='webform']").validate({
    rules: {
        title: "required",
        toMail: {
            required: true,
            email: true
        },
    },
    messages: {
        title: "Please enter Form Title",
        toMail: "Please enter a valid email address",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection

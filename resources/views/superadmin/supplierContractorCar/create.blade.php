@extends('layouts.admin')
@section('content')
<style>
    .signPad{ border: 1px solid #cccccc; }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-white">
                    <div class="card-header">
                        <h3 class="card-title">Create Supplier Contractor Car</h3>
                        <a href="{{ route('supplierContractorCar.index') }}"
                            class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form name="supplierContractorCar" method="POST" action="{{route('supplierContractorCar.store')}}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="conatiner">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="project">Project / Job refrence</label>
                                                <select name="project" id="project" class="form-control" required>
                                                    <option value="">Select Project</option>
                                                    @foreach($projects as $projectsval)
                                                    <option value="{{ $projectsval->id }}">{{ $projectsval->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="location">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    id="location" value="{{old('location')}}" autocomplete="off"
                                                    placeholder="Location" required>
                                            </div>
                                             <div class="col-md-6">
                                                <label for="supplier">Supplier / Contractor</label>
                                                <input type="text" class="form-control" name="supplier"
                                                    id="supplier" value="{{old('supplier')}}" autocomplete="off"
                                                    placeholder="Supplier / Contractor" required>
                                            </div>
                                             <div class="col-md-6">
                                                <label for="issued_by">Issued by</label>
                                                <input type="text" class="form-control" name="issued_by"
                                                    id="issued_by" value="{{old('issued_by')}}" autocomplete="off"
                                                    placeholder="Issued By" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="supply_contractor_car_date">Date</label>
                                                <input type="date" class="form-control" name="supply_contractor_car_date"
                                                    id="supply_contractor_car_date" value="{{old('supply_contractor_car_date')}}"
                                                    autocomplete="off" placeholder="Date" required>
                                            </div>
                                           
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h2 style="text-align:center">Overall outcome of corrective action: </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="satisfactory">Satisfactory / Unsatisfactory</label>
                                                <textarea rows="5" name="satisfactory" placeholder="Satisfactory / Unsatisfactory"
                                                    class="form-control" id="satisfactory" value="{{old('satisfactory')}}"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="row targetDiv" id="div0">
                                            <div class="col-md-12">
                                                <div id="group1" class="fvrduplicate">
                                                    <div class="row entry">
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Problem</label>
                                                                <input type="text" name="problem[]"
                                                                    placeholder="Problem" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Action</label>
                                                                <input class="form-control" name="action[]"
                                                                    type="text" placeholder="Action" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Due Date</label>
                                                                <input class="form-control" name="due_date[]"
                                                                    type="date" placeholder="Due Date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-2">
                                                            <div class="form-group">
                                                                <label>Closed Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="close_date[]" placeholder="Closed Date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-1">
                                                            <div class="form-group">
                                                                <label>&nbsp;</label>
                                                                <button type="button"
                                                                    class="btn btn-success btn-sm btn-add">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="usersubmit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
   
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            var controlForm = $(this).closest('.fvrduplicate'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fa fa-minus" aria-hidden="true"></i>');
        }).on('click', '.btn-remove', function (e) {
            $(this).closest('.entry').remove();
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("form[name='supplierContractorCar']").validate({
            rules: {
                project: "required",
                location: "required",
                supplier: "required",
                issued_by: "required",
                supply_contractor_car_date:"required",
                problem: "required",
                action: "required",
                due_date: "required",
                close_date: "required",
            },
            // Specify validation error messages
            messages: {
                project: "Please select Project",
                location: "Please enter Location",
                supplier: "Please enter Supplier / Contractor ",
                issued_by: "Please enter Issued By",
                supply_contractor_car_date: "Please enter Date",
                problem: "Please enter Problem",
                action: "Please enter Action",
                due_date: "Please enter Due Date",
                close_date: "Please enter Close Date",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
@endsection
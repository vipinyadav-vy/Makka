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
                        <h3 class="card-title">Create Inspection Test Plan</h3>
                        <a href="{{ route('inspectionTestPlan.index') }}"
                            class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form name="preStartMeeting" method="POST" action="{{route('inspectionTestPlan.store')}}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="conatiner">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="project">Site / Project / Location</label>
                                                <select name="project" id="project" class="form-control" required>
                                                    <option value="">Select Project</option>
                                                    @foreach($projects as $projectsval)
                                                    <option value="{{ $projectsval->id }}">{{ $projectsval->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="itp_refrence_no">ITP Reference No.</label>
                                                <input type="text" class="form-control" name="itp_refrence_no"
                                                    id="itp_refrence_no" value="{{old('itp_refrence_no')}}" autocomplete="off"
                                                    placeholder="ITP Reference No" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="revision_no">Revision No.</label>
                                                <input type="text" class="form-control" name="revision_no"
                                                    id="revision_no" value="{{old('revision_no')}}" autocomplete="off"
                                                    placeholder="Revision No" required>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="revision_date">Revision Date</label>
                                                <input type="date" class="form-control" name="revision_date"
                                                    id="revision_date" value="{{old('revision_date')}}"
                                                    autocomplete="off" placeholder="Date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="work_scope">Scope of Works</label>
                                                <input type="text" class="form-control" name="work_scope"
                                                    id="work_scope" value="{{old('work_scope')}}" autocomplete="off"
                                                    placeholder="Scope of Works" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="work_area">Work Area</label>
                                                <input type="text" class="form-control" name="work_area"
                                                    id="work_area" value="{{old('work_area')}}" autocomplete="off"
                                                    placeholder="Work Area" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="level">Level:</label>
                                                <input type="text" class="form-control" name="level"
                                                    id="level" value="{{old('level')}}" autocomplete="off"
                                                    placeholder="Level" required>
                                            </div>
                                            
                                        </div>
                                        <hr>
                                        
                                        
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h2 style="text-align:center">TRADE DETAILS</h2>
                                                    <p>List details of subcontractors involved in this ITP</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row targetDiv" id="div0">
                                            <div class="col-md-12">
                                                <div id="group1" class="fvrduplicate">
                                                    <div class="row entry">
                                                        <div class="col-xs-12 col-md-4">
                                                            <div class="form-group">
                                                                <label>Subcontractor Name</label>
                                                                <input type="text" name="subcontractor_name[]"
                                                                    placeholder="Subcontractor Name" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <div class="form-group">
                                                                <label>Representative</label>
                                                                <input class="form-control" name="representative[]"
                                                                    type="text" placeholder="Representative" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Contact No.</label>
                                                                <input class="form-control" name="trade_phone[]"
                                                                    type="text" placeholder="Contact No." required>
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
                                        
                                        <hr>
                                        
                                        <!--<div class="row">-->
                                        <!--    <div class="col-md-12">-->
                                        <!--        <div class="card-header">-->
                                        <!--            <h2 style="text-align:center">AREA COMPLETION </h2>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<hr>-->
                                        <!--<div class="row">-->
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="pc_representative">PC Representative</label>-->
                                        <!--        <input type="text" class="form-control" name="pc_representative"-->
                                        <!--            id="pc_representative" value="{{old('pc_representative')}}"-->
                                        <!--            autocomplete="off" placeholder="PC Representative" required>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="pc_representative_signature">Signature</label>-->
                                        <!--        <div class="form-group">-->
                                        <!--            <canvas width="350" height="100" class="signPad" id="pcrepresentativeSign"></canvas>-->
                                        <!--            <div id="pcrepresentativeSignBox"></div>-->
                                        <!--            <button type="button" id="pcrepresentativeclear"-->
                                        <!--                class="pcrepresentativeclear">Clear</button>-->
                                        <!--            <input type="hidden" id="pc_representative_signature"-->
                                        <!--                name="pc_representative_signature">-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="pc_representative_date">Date</label>-->
                                        <!--        <input type="date" class="form-control" name="pc_representative_date"-->
                                        <!--            id="pc_representative_date" value="{{old('pc_representative_date')}}"-->
                                        <!--            autocomplete="off" placeholder="Date" required>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div class="row">-->
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="subcontractor_representative">Subcontractor Representative:</label>-->
                                        <!--        <input type="text" class="form-control" name="subcontractor_representative"-->
                                        <!--            id="subcontractor_representative" value="{{old('subcontractor_representative')}}"-->
                                        <!--            autocomplete="off" placeholder="Subcontractor Representative" required>-->
                                        <!--    </div>-->
                                            
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="conducted_by_signature">Conducted By Sign</label>-->
                                        <!--        <div class="form-group">-->
                                        <!--            <canvas width="350" height="100" class="signPad" id="conductedByCanvas"></canvas>-->
                                        <!--            <div id="signaturebox"></div>-->
                                        <!--            <button type="button" id="clearButton"-->
                                        <!--                class="clearButton">Clear</button>-->
                                        <!--            <input type="hidden" id="conducted_by_signature" name="conducted_by_signature">-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-md-4">-->
                                        <!--        <label for="revision_date">Date</label>-->
                                        <!--        <input type="date" class="form-control" name="revision_date"-->
                                        <!--            id="revision_date" value="{{old('revision_date')}}"-->
                                        <!--            autocomplete="off" placeholder="Date" required>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h2 style="text-align:center;">INSPECTION AND TESTING</h2> 
                                                    <p>List details of subcontractors involved in this ITP</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="item_no">Item No.</label>
                                                <input type="text" class="form-control" name="item_no"
                                                    id="item_no" value="{{old('item_no')}}" autocomplete="off"
                                                    placeholder="Item No" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="quality_standard">Quality standard or characteristic to be verified</label>
                                                <input type="text" class="form-control" name="quality_standard"
                                                    id="quality_standard" value="{{old('quality_standard')}}" autocomplete="off"
                                                    placeholder="Quality standard" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="stage">Stage / frequency</label>
                                                <input type="text" class="form-control" name="stage"
                                                    id="stage" value="{{old('stage')}}" autocomplete="off"
                                                    placeholder="Stage" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="method">Method (refer to key)</label>
                                                <input type="text" class="form-control" name="method"
                                                    id="method" value="{{old('method')}}" autocomplete="off"
                                                    placeholder="Method (refer to key)" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="completed_date">Date completed</label>
                                                <input type="date" class="form-control" name="completed_date"
                                                    id="completed_date" value="{{old('completed_date')}}" autocomplete="off"
                                                    placeholder="Date completed" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="font-size:14px;" for="stage">Record / evidence (attach to this ITP for future reference)</label>
                                                <input type="text" class="form-control" name="record"
                                                    id="record" value="{{old('record')}}" autocomplete="off"
                                                    placeholder="Record" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="project">Subcontractor sign-off</label>
                                                <input type="text" class="form-control" name="subcontractor_sign_off" 
                                                    id="subcontractor_sign_off" value="{{old('subcontractor_sign_off')}}" autocomplete="off"
                                                    placeholder="Subcontractor sign-off" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pc_sign_off">PC sign-off</label>
                                                <input type="text" class="form-control" name="pc_sign_off"
                                                    id="pc_sign_off" value="{{old('pc_sign_off')}}" autocomplete="off"
                                                    placeholder="PC sign-off" required> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="discussion">Discussion / Comments</label>
                                                <textarea rows="5" name="discussion" placeholder="Discussion."
                                                    class="form-control" id="discussion" value="{{old('discussion')}}"
                                                    required></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js"></script>
<script type="text/javascript">
    $(function () {
            var canvas = document.getElementById('conductedByCanvas');
            var signaturePad = new SignaturePad(canvas);
        $(".clearButton").click(function () {
            signaturePad.clear();
            document.getElementById('conducted_by_signature').value = "";
        });
            var representativeCanvas = document.getElementById('pcrepresentativeSign');
            var representativesignPad = new SignaturePad(representativeCanvas);
        $(".pcrepresentativeclear").click(function () {
           
            representativesignPad.clear();
            document.getElementById('representative_signature').value = "";
        });

        $("form[name='preStartMeeting']").validate({
            rules: {
                project: "required",
                itp_refrence_no: "required",
                revision_no: "required",
                revision_date: "required",
                work_scope: "required",
                work_area: "required",
                level: "required",
                item_no: "required",
                quality_standard: "required",
                stage: "required",
                method: "required",
                completed_date: "required",
                record: "required",
                subcontractor_sign_off: "required",
                pc_sign_off: "required",
                discussion: "required",
            },
            // Specify validation error messages
            messages: {
                project: "Please select Project",
                itp_refrence_no: "Please enter ITP Refrence No",
                revision_no: "Please enter Revision No",
                revision_date: "Please enter Revision Date",
                work_scope: "Please enter Work Scope",
                work_area: "Please enter Work Area",
                level: "Please enter level",
                item_no: "Please enter Item no",
                quality_standard: "Please enter Quality Standard",
                stage: "Please enter Stage",
                method: "Please enter Method",
                completed_date: "Please enter Completed Date",
                record: "Please enter Record",
                subcontractor_sign_off: "Please enter Subcontractor Sign Off",
                pc_sign_off: "Please enter Pc Sign Off",
                discussion: "Please enter Discussion",

            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var conductedBySignature = signaturePad.toDataURL(); 
                document.getElementById('conducted_by_signature').value = conductedBySignature;
                console.log('Value of conducted_by_signature:', document.getElementById('conducted_by_signature').value);

                var representativeBySignature = representativesignPad.toDataURL();
                document.getElementById('representative_signature').value = representativeBySignature;

                form.submit();
            }
        });
    });
</script>
@endsection
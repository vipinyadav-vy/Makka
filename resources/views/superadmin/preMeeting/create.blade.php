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
                        <h3 class="card-title">Create Pre Start Meeting</h3>
                        <a href="{{ route('preStartMeetings.index') }}"
                            class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form name="preStartMeeting" method="POST" action="{{route('preStartMeetings.store')}}"
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
                                                <label for="pre_meeting_date">Date</label>
                                                <input type="date" class="form-control" name="pre_meeting_date"
                                                    id="pre_meeting_date" value="{{old('pre_meeting_date')}}"
                                                    autocomplete="off" placeholder="Date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="conducted_by">Meeting Conducted by</label>
                                                <input type="text" class="form-control" name="conducted_by"
                                                    id="conducted_by" value="{{old('conducted_by')}}" autocomplete="off"
                                                    placeholder="Conducted By" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="conducted_by_signature">Conducted By Sign</label>
                                                <div class="form-group">
                                                    <canvas width="400" height="100" class="signPad" id="conductedByCanvas"></canvas>
                                                    <div id="signaturebox"></div>
                                                    <button type="button" id="clearButton"
                                                        class="clearButton">Clear</button>
                                                    <input type="hidden" id="conducted_by_signature" name="conducted_by_signature">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="representative">Representative</label>
                                                <input type="text" class="form-control" name="representative"
                                                    id="representative" value="{{old('representative')}}"
                                                    autocomplete="off" placeholder="Representative" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="representative_signature">Signed</label>
                                                <div class="form-group">
                                                    <canvas width="400" height="100" class="signPad" id="representativeSignCanvas"></canvas>
                                                    <div id="representativeSignBox"></div>
                                                    <button type="button" id="representativeclear"
                                                        class="representativeclear">Clear</button>
                                                    <input type="hidden" id="representative_signature"
                                                        name="representative_signature">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h2 style="text-align:center">Topics to be addressed: </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row targetDiv" id="div1">
                                            <div class="col-md-12">
                                                <div id="group2" class="fvrduplicate">
                                                    <div class="row entry">
                                                        <!-- Field Start -->
                                                        <div class="col-xs-12 col-md-11">
                                                            <div class="form-group">
                                                                <label>Topics</label>
                                                                <input class="form-control" name="topics[]" type="text"
                                                                    placeholder="Topics" required>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="discussion">Discussion / Comments</label>
                                                <textarea rows="5" name="discussion" placeholder="Discussion."
                                                    class="form-control" id="discussion" value="{{old('discussion')}}"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h2 style="text-align:center">Corrective Action (where applicable)
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row targetDiv" id="div0">
                                            <div class="col-md-12">
                                                <div id="group1" class="fvrduplicate">
                                                    <div class="row entry">
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Corrective Action</label>
                                                                <input type="text" name="corrective_action[]"
                                                                    placeholder="Corrective Action" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Action by</label>
                                                                <input class="form-control" name="action_by[]"
                                                                    type="text" placeholder="Action by" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <label>Sign off</label>
                                                                <input class="form-control" name="action_sign_off[]"
                                                                    type="text" placeholder="Sign off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-2">
                                                            <div class="form-group">
                                                                <label>Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="action_date[]" placeholder="Date" required>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js"></script>
<script type="text/javascript">
    $(function () {
            var canvas = document.getElementById('conductedByCanvas');
            var signaturePad = new SignaturePad(canvas);
        $(".clearButton").click(function () {
            signaturePad.clear();
            document.getElementById('conducted_by_signature').value = "";
        });
            var representativeCanvas = document.getElementById('representativeSignCanvas');
            var representativesignPad = new SignaturePad(representativeCanvas);
        $(".representativeclear").click(function () {
           
            representativesignPad.clear();
            document.getElementById('representative_signature').value = "";
        });

        $("form[name='preStartMeeting']").validate({
            rules: {
                project: "required",
                pre_meeting_date: "required",
                conducted_by: "required",
                representative: "required",
                topics: "required",
                discussion: "required",
                corrective_action: "required",
                action_by: "required",
                action_sign_off: "required",
                action_date: "required",
            },
            // Specify validation error messages
            messages: {
                project: "Please select Project",
                pre_meeting_date: "Please enter Pre Meeting Date",
                conducted_by: "Please enter conducted by",
                representative: "Please enter Representative",
                topics: "Please enter Topics",
                discussion: "Please enter discussion",
                corrective_action: "Please enter Corrective Action",
                action_by: "Please enter Action By",
                action_sign_off: "Please enter Sign Off",
                action_date: "Please enter Action Date",
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
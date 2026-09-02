@extends('front.layouts.app')

@section('content')
<style>
    .signPad {
        border: 1px solid #cccccc;
    }
</style>
<div class="multi-form-sections pre-start-meeting">

<h1 class="fs-title" style="text-align:center">Inspection Test Plan</h1>

<div class="container">
      @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        <li>Some Required field are missing</li>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
</div>
      <form name="inspectionTestPlan" id="msform" class="multistep-forms form1" method="POST" action="{{route('inspectionTestPlanStore')}}" enctype="multipart/form-data">
      @csrf
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Project</label>
                      <input value="{{ $inspectionrecord->projectname }}" readonly >
                        <input type="hidden" name="inspection_id" value="{{ $inspectionrecord->id }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>ITP Reference No.</label>
                      <input value="{{ $inspectionrecord->itp_refrence_no }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Revision No.</label>
                      <input value="{{ $inspectionrecord->revision_no }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Revision Date</label>
                      <input type="date" value="{{ $inspectionrecord->revision_date }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Work Scope</label>
                      <input value="{{ $inspectionrecord->work_scope }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Work Area </label>
                      <input value="{{ $inspectionrecord->work_area }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Level </label>
                      <input value="{{ $inspectionrecord->level }}" readonly>
                    </div>
                </div>
            </div>
        
        <table>
          <tr>
            <th colspan="3" class="main-th">TRADE DETAILS</th>
          </tr>
          <tr>
            <th>Subcontractor Name</th>
            <th>Representative</th>
            <th>Trade Contact No.</th>
         
          <?php foreach ($inspectionTrade as $key => $value) { ?> 
          
          <tr>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->subcontractor_name }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->representative }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->trade_phone }}" readonly >
              </div>
            </td>
           
          </tr>
          
          <?php } ?>
        </table>


<div class="row">
    
    <h2>INSPECTION AND TESTING</h2>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Item No.</label>
                      <input value="{{ $inspectionrecord->item_no }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Quality standard or characteristic to be verified</label>
                      <input value="{{ $inspectionrecord->quality_standard }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Stage / frequency</label>
                      <input value="{{ $inspectionrecord->stage }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Method (refer to key)</label>
                      <input value="{{ $inspectionrecord->method }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Date completed</label>
                      <input value="{{ $inspectionrecord->completed_date }}" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Record / evidence (attach to this ITP for future reference) </label>
                      <input value="{{ $inspectionrecord->record }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Subcontractor sign-off </label>
                      <input value="{{ $inspectionrecord->subcontractor_sign_off }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>PC sign-off </label>
                      <input value="{{ $inspectionrecord->pc_sign_off }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Discussion / Comment</label>
                        <textarea class="form-control" rows="4" readonly>{{ $inspectionrecord->discussion }}</textarea>
                    </div>
                </div>
            </div>
            
            
            
            
            <table>
          <tr>
            <th colspan="3" class="main-th">Area Completion</th>
          </tr>
          <tr>
              <?php $type = request('type') === 'SC' ? 'SC' : 'PC'; 
              if ($type && $type == 'SC') { ?>
            <th>Subcontractor Representative</th>
            <?php }else{ ?>
            <th>PC Representative</th>
            <?php } ?>
            <th>Signature</th>
            <th>Date</th>
          </tr>
          <?php foreach ($inspectionRepresentative as $key => $value) {
                
                if($value->representativeType == 1 && $type && $type == 'PC'){ ?> 
                <tr>
                    <td>{{ $value->representative }}</td>
                    <td><img style="width:200px;" src="{{ url($value->signature) }}" /></td>
                    <td>{{ $value->area_completion_date }}</td>
                </tr>
                <?php } 
                 if($value->representativeType == 2 && $type && $type == 'SC'){ ?>
                <tr>
                    <td>{{ $value->representative }}</td>
                    <td><img style="width:200px;" src="{{ url($value->signature) }}" /></td>
                    <td>{{ $value->area_completion_date }}</td>
                </tr>
                <?php }
                } ?>
        </table>
            
        <table>
          <tr>
            <td>
              <div class="form-group">
                <input type="hidden" name="type" value="{{ $type }}" readonly required>
                <input type="text" name="representative" maxlength="250" required>
              </div>
            </td>
            <td>
            <div class="form-group">
                <canvas width="400" height="100" class="signPad" id="signatureCanvas"></canvas>
                <div id="representativeSignBox"></div>
                <button type="button" id="clearButton"
                    class="clearButton">Clear</button>
                <input type="hidden" id="signature" name="signature">
            </div>
            </td>
            <td>
              <div class="form-group">
              <input type="date" name="area_completion_date" required>
              </div>
            </td>
          </tr>
        </table>
        <input type="submit" name="submit" class="submit action-button" value="Submit" />
        </form>
      </fieldset>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js"></script>

    <script type="text/javascript">
    $(function () {
            var canvas = document.getElementById('signatureCanvas');
            var signaturePad = new SignaturePad(canvas);
        $(".clearButton").click(function () {
            signaturePad.clear();
            document.getElementById('signature').value = "";
        });
        $("form[name='inspectionTestPlan']").validate({
            rules: {
              representative: "required",
              area_completion_date:"required",
            },
            // Specify validation error messages
            messages: {
              representative: "Please enter Representative",
              area_completion_date:"Please enter Area Completion Date"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var workerSignature = signaturePad.toDataURL(); 
                document.getElementById('signature').value = workerSignature;
                form.submit();
            }
        });
    });
</script>


    @endsection

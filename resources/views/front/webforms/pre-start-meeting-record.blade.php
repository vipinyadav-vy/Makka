@extends('front.layouts.app')

@section('content')
<style>
    .signPad {
        border: 1px solid #cccccc;
    }
</style>
<div class="multi-form-sections pre-start-meeting">

<h1 class="fs-title" style="text-align:center">Pre-start Meeting Record</h1>

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
      <form name="preStartMeeting" id="msform" class="multistep-forms form1" method="POST" action="{{route('preStartMeetingStore')}}" enctype="multipart/form-data">
      @csrf  
        <fieldset>
        <div class="form-group">
          <label>Project</label>
          <input value="{{ $preMeetingrecord->projectname }}" readonly >
            <input type="hidden" name="preMeetingId" value="{{ $preMeetingrecord->id }}" readonly>
        </div>
        <div class="form-group">
          <label>Date & time:</label>
          <input type="date" value="{{ $preMeetingrecord->pre_meeting_date }}" readonly>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label>Meeting conducted by:</label>
                  <input value="{{ $preMeetingrecord->conducted_by }}" readonly >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Signed:</label>
                    @if($preMeetingrecord->conducted_by_signature) <img style="width:200px;" src="{{ url($preMeetingrecord->conducted_by_signature) }}" /> @endif
                </div>
            </div>
       
            <div class="col-md-6">
        <div class="form-group">
          <label>Representative:</label>
          <input value="{{ $preMeetingrecord->representative }}" readonly>
        </div>
        </div>
            <div class="col-md-6">
        <div class="form-group">
          <label>Signed:</label>
          @if($preMeetingrecord->representative_signature) <img style="width:200px;" src="{{ url($preMeetingrecord->representative_signature) }}" /> @endif
        </div>
        </div>
         </div>
        <table>
          <tr>
            <th colspan="2" class="main-th">Topics to be addressed</th>
          </tr>
          
          <?php
          $i = 0;
          foreach ($preMeetingTopics as $key => $value) {
          $i++;
          ?>
          <tr>
            <td width="10%">{{ $i; }}</td>
            <td width="90%">{{ $value->topics }}</td>
          </tr>
          
           <?php } ?>
          
        </table>
        <table>
          <tr>
            <th colspan="1" class="main-th">Discussion / Comments:</th>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <textarea class="form-control" rows="4" readonly>{{ $preMeetingrecord->discussion }}</textarea>
              </div>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <th colspan="4" class="main-th">Corrective Action (where applicable)</th>
          </tr>
          <tr>
            <th rowspan="2">Corrective Action</th>
            <th rowspan="2">Action by</th>
            <th colspan="2">Action Complete</th>
          <tr>
            <th>Sign off</th>
            <th>Date</th>
          </tr>
          <?php foreach ($preMeetingCorrective as $key => $value) { ?> 
          
          <tr>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->corrective_action }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->action_by }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->action_sign_off }}" readonly >
              </div>
            </td>
            <td>
              <input type="date" value="{{ $value->action_date }}" readonly>
            </td>
          </tr>
          
          <?php } ?>
        </table>


        <table>
          <tr>
            <th colspan="2" class="main-th">Attendance</th>
          </tr>
          <tr>
            <th>Name</th>
            <th>Signature</th>
          </tr>
          <tr>
            <td>
              <div class="form-group">
              <input type="text" name="name" maxlength="250" required>
              </div>
            </td>
            <td>

            <div class="form-group">
                <canvas width="400" height="100" class="signPad" id="signatureCanvas"></canvas>
                <div id="representativeSignBox"></div>
                <button type="button" id="clearButton"
                    class="clearButton">Clear</button>
                <input type="hidden" id="signature"
                    name="signature">
            </div>
            </td>
          </tr>
         
        </table>
        <input type="submit" name="submit" class="submit action-button" value="Submit" />
      </fieldset>
      
        
         </form>
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
        $("form[name='preStartMeeting']").validate({
            rules: {
              name: "required",
            },
            // Specify validation error messages
            messages: {
              name: "Please enter Name",
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

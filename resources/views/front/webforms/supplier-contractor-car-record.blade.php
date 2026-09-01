@extends('front.layouts.app')

@section('content')
<style>
    .signPad {
        border: 1px solid #cccccc;
    }
</style>
<div class="multi-form-sections pre-start-meeting">

<h1 class="fs-title" style="text-align:center">Supplier & Contractor Car</h1>

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
      <form name="supplierContractorCar" id="msform" class="multistep-forms form1" method="POST" action="{{route('supplierContractorCarStore')}}" enctype="multipart/form-data">
      @csrf  
        <fieldset>
            <div class="row">
                <div class="col-md-6">
        <div class="form-group">
          <label>Project / Job refrence</label>
          <input value="{{ $supContracrCarRecord->projectname }}" readonly >
            <input type="hidden" name="supplierContractorCarId" value="{{ $supContracrCarRecord->id }}" readonly>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label>Location</label>
          <input value="{{ $supContracrCarRecord->location }}" readonly>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label>Supplier / Contractor</label>
          <input value="{{ $supContracrCarRecord->supplier }}" readonly>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label>Issued by</label>
          <input value="{{ $supContracrCarRecord->issued_by }}" readonly>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label>Date</label>
          <input type="date" value="{{ $supContracrCarRecord->supply_contractor_car_date }}" readonly>
        </div>
        </div>
         </div>
        <table>
          <tr>
            <th colspan="1" class="main-th">Satisfactory / Unsatisfactory</th>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <textarea class="form-control" rows="4" readonly>{{ $supContracrCarRecord->satisfactory }}</textarea>
              </div>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <th>Problem</th>
            <th>Action</th>
            <th>Due Date</th>
            <th>Closed Date</th>
            
          <?php foreach ($supContractorProblem as $key => $value) { ?> 
          
          <tr>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->problem }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->action }}" readonly >
              </div>
            </td>
            <td>
              <div class="form-group">
              <input type="text" value="{{ $value->due_date }}" readonly >
              </div>
            </td>
            <td>
              <input type="date" value="{{ $value->close_date }}" readonly>
            </td>
          </tr>
          
          <?php } ?>
        </table>


        <table>
          <tr>
            <th>Corrective action verified</th>
            <th>Name</th>
            <th>Position</th>
            <th>Date</th>

          </tr>
          <tr>
            <td>
              <div class="form-group">
              <input type="text" name="corrective_action" maxlength="250" required>
              </div>
            </td>
            <td>
<div class="form-group">
              <input type="text" name="name" maxlength="250" required>
              </div>
            <!--<div class="form-group">-->
            <!--    <canvas width="400" height="100" class="signPad" id="signatureCanvas"></canvas>-->
            <!--    <div id="representativeSignBox"></div>-->
            <!--    <button type="button" id="clearButton"-->
            <!--        class="clearButton">Clear</button>-->
            <!--    <input type="hidden" id="signature"-->
            <!--        name="signature">-->
            <!--</div>-->
            </td>
            
            <td>
                <div class="form-group">
                    <input type="text" name="position" maxlength="250" required>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="date" name="date" maxlength="250" required>
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
        $("form[name='supplierContractorCar']").validate({
            rules: {
                corrective_action: "required",
                name: "required",
                position: "required",
                date: "required",
            },
            messages: {
                corrective_action: "Please enter Corrective Action",
                name: "Please enter Name",
                position: "Please enter Position",
                date: "Please enter date",
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>


    @endsection

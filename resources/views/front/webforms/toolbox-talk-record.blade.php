@extends('front.layouts.app')

@section('content')
<style>
	.actionBorder td{border: 1px solid #dedede;}
	</style>
<div class="multi-form-sections">

<h1 class="fs-title" style="text-align:center">Toolbox Talk Details</h1>

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
      <form name="tooltalkrecord" id="msform" class="multistep-forms form1" method="POST" action="{{route('toolBoxTalkAttendanceStore')}}" enctype="multipart/form-data">
      @csrf  
        <fieldset>
          <div class="form-group">
            <label>Site / Project / Location:</label>
            <input type="text" value="{{ $tollboxtalkrecord->projectname }}" readonly >
            <input type="hidden" name="toolboxRecordId" value="{{ $tollboxtalkrecord->id }}" readonly>

          </div>
		  <div class="row">
                              <div class="col-md-6">
          <div class="form-group">
			
            <label>Date & time:</label>
            <input type="text" name="dateTime" id="dateTime" value="{{ $tollboxtalkrecord->tollbox_talk_record_date }}" readonly>
          </div>
		  </div>
		  <div class="col-md-6">
		  <div class="form-group">
            <label>Conducted by:</label>
			<input type="text" value="{{ $tollboxtalkrecord->conducted_by }}" readonly >
          </div>
</div>
</div>
		  <div class="form-group">
            <label>Site / Topic:</label>
			<input type="text" value="{{ $tollboxtalkrecord->site_topic }}" readonly >

          </div>
		  <div class="form-group">
            <label>Items Discussed:</label>
            <textarea class="form-control" rows="4">{{ $tollboxtalkrecord->discussion }}</textarea>
          </div>
		  <hr>
		  <h2 class="fs-title">Actions</h2>
		  <hr>
		  <table>
			  <tr>
				<th class="main-th">No.</th>
				<th style="text-align:center;" class="main-th">Description</th>
				<th style="text-align:center;" class="main-th">Responsible</th>
				<th style="text-align:center;" class="main-th">Due Date</th>
			  </tr>
			  
			  <?php
			  $i = 0;
			  foreach ($tollboxtalkrecordAction as $key => $value) { $i++; ?>
			  <tr class="actionBorder">
			  <td>{{ $i }}</td>
				<td style="width:50%">{{ $value->actionDescription }}</td>
				<td style="width:30%">{{ $value->actionResponsible }}</td>
				<td style="width:20%">{{ $value->actionDueDate }}</td>
			  </tr>
			  <?php } ?>	  
			
			  
			</table>
			<hr>
			<h2 class="fs-title">Attendance & Sign-Off</h2>
			<hr>
		  <table style="width:100%";>
			  <tr>
				<th style="text-align:center;" class="main-th">Worker Name</th>
				<th style="text-align:center;" class="main-th">Signature</th>
				<th style="text-align:center;" class="main-th">Date</th>
			  </tr>
			 <tr>
				<td>
					<div class="form-group">
						<input type="text" id="worker_name" name="worker_name">
						<div id="workerNameErr"></div>
					</div>
				</td>
				<td>
					<div>
					<canvas width="400" height="100" id="signatureCanvas"></canvas>
					<div id="signaturebox"></div>
                <button type="button" id="clearButton" class="clearButton">Clear</button>
				<input type="hidden" id="worker_signature" name="worker_signature">
					</div>
				</td>
				<td>
					 <div class="form-group">
						<input type="date" id="attendance_date" name="attendance_date">
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
    <script src="{{asset('public/front/js/toolboxrecord.js')}}"></script>

    @endsection

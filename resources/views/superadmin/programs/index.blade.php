@extends('layouts.admin')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="card">
    <div class="card-header">
       Programs
       <a class="btn btn-primary float-right"  href="{{ route('programs.create') }}">
        Add
      </a>
    </div>
    <div class="card-body">

    <div class="row mt-4 mb-4">
    <form method="get" action="{{route('fetch_program')}}" enctype="multipart/form-data" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
            <select name="project" id="project" class="form-control" required>
                <option value="">Select Project</option>
                @foreach($projects as $projectsval)
                    <option <?php if(!empty($_GET['project']) && $projectsval->id == $_GET['project'] ){ echo "selected"; } ?> value="{{ $projectsval->id }}">{{ $projectsval->name }}</option>
                @endforeach
            </select>
        </div>
    <div class="col-md-2">
    <input type="date" class="form-control" name="program_date" id="program_date" value="@if(!empty($_GET['program_date'])){{ $_GET['program_date'] }}@endif" autocomplete="off" required>
    </div>
    <div class="col-md-2">
        <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Search</button>
        <a href="{{ route('programs.index') }}" class="btn btn-success filter">Reset</a>
    </div>
</div>

</form>
</div>

<hr>
    
        <div class="row">

        @isset($programData)
        <form method="post" action="{{ route('programUpdate', [$programData->id]) }}" enctype="multipart/form-data" autocomplete="off">
        @else
            <form name="programs" method="post" action="{{route('programs.store')}}" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden"  name="project" value="@if(!empty($_GET['project'])){{ $_GET['project'] }}@endif" required>
            <input type="hidden"  name="program_date" value="@if(!empty($_GET['program_date'])){{ $_GET['program_date'] }}@endif" required>
            @endif
        @csrf
        @if(!empty($_GET['project']))
            <div class="form-group col-md-12">
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="note">Notes</label>
                                 <textarea rows="5" name="note" placeholder="Note" class="form-control" id="note"  required>@isset($programData){{ $programData->note }}@endif</textarea>
                              </div>
                           </div>
                           <hr> 
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                     <h2 style="text-align:center">Task </h2>
                                    </div>
                                </div>
                           </div>
                           <hr> 
                            <div class="row">
                                <div class="col-md-12">
                                        @isset($programTaskData)
                                        @foreach($programTaskData as $programTaskDataval)
                                        <div class="row">
                                            <div class="col-xs-12 col-md-11">
                                                <div class="form-group">
                                                    <label>Task</label>
                                                    <input type="hidden" name="existTaskId[]" value="{{$programTaskDataval->id }}">
                                                    <textarea name="existTask[]" placeholder="Task" class="form-control">{{ $programTaskDataval->task }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-1">
                                            <div class="form-group">
                                                <button data-id="{{ $programTaskDataval->id }}" type="button" class="deleteTask btn btn-danger btn-sm btn-add">
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    
                                </div>
                            </div>


                           <hr> 
                            <div class="row targetDiv" id="div0">
                                <div class="col-md-12">
                                    <div id="group1" class="fvrduplicate">
                                        <div class="row entry">
                                            <div class="col-xs-12 col-md-11">
                                                <div class="form-group">
                                                    <label>Task</label>
                                                    <textarea name="task[]" placeholder="Task" class="form-control" <?php if (!isset($programData) && empty($programData->note)) { echo "required"; } ?> ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="button" class="btn btn-success btn-sm btn-add">
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
                   
@else

<p style="text-align:center;">No Record Found</p>
     @endif
    </div>
</form>
</div>


<script>
$(function() {
  $("form[name='programs']").validate({
    rules: {
        note:"required",
        task:"required",
    },
    messages: {
        note: "Please enter Note",
        task: "Please enter Task",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
}); 
</script>

<script type="text/javascript">


 $(function() {
    $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();
        var controlForm = $(this).closest('.fvrduplicate'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('textarea').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus" aria-hidden="true"></i>');
    }).on('click', '.btn-remove', function(e) {
        $(this).closest('.entry').remove();
        return false;
    });
});




    $(".deleteTask").on('click',function(){
        var id = $(this).attr("data-id");
        var myurl = " {{ url('superadmin/programTaskDelete/') }}"+"/"+id;
        var $this = $(this);
        if(confirm('Are you sure to remove this record ?'))
        {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
            });
            $.ajax({
               url: myurl, 
               type: 'DELETE', 
               error: function() {
                toastr['error']("Something went wrong try again.");
               },
               success: function(data) {
                toastr['success']("Data has been deleted successfully");
                $this.parent().parent().parent().remove();
               }
            });
        }
    });


</script>
@endsection
    
    



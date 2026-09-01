@extends('admin.layouts.admin')
@section('content')
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card card-white">
            <div class="card-header">
               <h3 class="card-title">Create Programs</h3>
               <a href="{{ route('user_programs.index') }}" class="btn btn-secondary float-right text-white">Back</a>
            </div>
            <form name="toolBoxTalkRecord" method="POST" action="{{route('user_programs.store')}}" enctype="multipart/form-data" autocomplete="off">
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
                                        <option value="{{ $projectsval->id }}">{{ $projectsval->name }}</option>
                                        @endforeach
                                    </select>
                              </div>
                              <div class="col-md-6">
                                 <label for="program_date">Date</label>
                                 <input type="date" class="form-control" name="program_date" id="program_date" value="{{old('program_date')}}" autocomplete="off" placeholder="Date" required>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="note">Notes</label>
                                 <textarea rows="5" name="note" placeholder="Note" class="form-control" id="note" value="{{old('note')}}"  required></textarea>
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
                            <div class="row targetDiv" id="div0">
                                <div class="col-md-12">
                                    <div id="group1" class="fvrduplicate">
                                        <div class="row entry">
                                            <div class="col-xs-12 col-md-11">
                                                <div class="form-group">
                                                    <label>Task</label>
                                                    <textarea name="task[]" placeholder="Task" class="form-control"  required></textarea>
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
            </form>
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script>
$(function() {
  $("form[name='toolBoxTalkRecord']").validate({
    rules: {
        project: "required",
        program_date:"required",
        note:"required",
        task:"required",
    },
    messages: {
        project: "Please select Project",
        program_date: "Please enter Program Date",
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
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus" aria-hidden="true"></i>');
    }).on('click', '.btn-remove', function(e) {
        $(this).closest('.entry').remove();
        return false;
    });
});
</script>
@endsection

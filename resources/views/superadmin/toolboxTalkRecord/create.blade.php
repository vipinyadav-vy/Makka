@extends('layouts.admin')
@section('content')
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card card-white">
            <div class="card-header">
               <h3 class="card-title">Create ToolBox Record</h3>
               <a href="{{ route('toolBoxTalkRecords.index') }}" class="btn btn-secondary float-right text-white">Back</a>
            </div>
            <form name="toolBoxTalkRecord" method="POST" action="{{route('toolBoxTalkRecords.store')}}" enctype="multipart/form-data" autocomplete="off">
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
                                 <label for="tollbox_talk_record_date">Date</label>
                                 <input type="date" class="form-control" name="tollbox_talk_record_date" id="tollbox_talk_record_date" value="{{old('tollbox_talk_record_date')}}" autocomplete="off" placeholder="Date" required>
                              </div>
                              <div class="col-md-6">
                                 <label for="conducted_by">Conducted by</label>
                                 <input type="text" class="form-control" name="conducted_by" id="conducted_by" value="{{old('conducted_by')}}" autocomplete="off" placeholder="Conducted By" required>
                              </div>
                              <div class="col-md-6">
                                 <label for="site_topic">Site / Topic</label>
                                 <input type="text" class="form-control" name="site_topic" id="site_topic" value="{{old('site_topic')}}" autocomplete="off" placeholder="Site / Topic" required>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="discussion">Items Discussed</label>
                                 <textarea rows="5" name="discussion" placeholder="Discussion." class="form-control" id="discussion" value="{{old('discussion')}}"  required></textarea>
                              </div>
                           </div>
                           <hr> 
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                     <h2 style="text-align:center">Actions </h2>
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
                                                    <label>Description</label>
                                                    <textarea name="actionDescription[]" placeholder="Description" class="form-control"  required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Responsible</label>
                                                    <input class="form-control form-control-sm" name="actionResponsible[]" type="text" placeholder="Responsible" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-group">
                                                    <label>Due Date</label>
                                                    <input type="date" class="form-control form-control-sm" name="actionDueDate[]" placeholder="Due Date" required>
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
        tollbox_talk_record_date:"required",
        conducted_by:"required",
        site_topic:"required",
        discussion:"required",
        actionDescription:"required",
        actionResponsible:"required",
        actionDueDate:"required",

    },
    // Specify validation error messages
    messages: {
        project: "Please select Project",
        tollbox_talk_record_date: "Please enter Tollbox Talk Record Date",
        conducted_by: "Please enter conducted by",
        site_topic: "Please enter site topic",
        discussion: "Please enter discussion",
        actionDescription: "Please enter Description",
        actionResponsible: "Please enter Responsible",
        actionDueDate: "Please enter Due Date",
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
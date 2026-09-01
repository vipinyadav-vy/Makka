@extends('layouts.admin')
@section('content')





<?php
//$url = "https://api.openweathermap.org/data/2.5/weather?lat=-33.749550&lon=150.923160&dt=1643803200&appid=12df6bce0fab58b129db073908350f16";
$api_key = "12df6bce0fab58b129db073908350f16";
$latitude = -33.749550;
$longitude = 150.923160;
$date = "2024-02-03";
$timestamp = strtotime($date);

$url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&dt={$timestamp}&appid={$api_key}";

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER ,true);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result,true);

?>
<style>
    
    .weathercard {
    background-image: url("https://i.imgur.com/dpqZJV5.jpg");
    background-size: cover;
    width: 450px;
    height: 300px;
    border-radius: 20px;
    box-shadow: 0px 8px 16px 4px #9E9E9E;
}

.time-font {
    font-size: 50px;
}

.sm-font {
    font-size: 18px;
}

.med-font {
    font-size: 28px;
}

.large-font {
    font-size: 60px;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card">
    <div class="card-header"> Diary </div>
    <div class="card-body diaries-task-card">
        <form method="get" action="{{route('fetch_diary_program')}}" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-md-6">
                    <select name="project" id="project" class="form-control" required>
                        <option value="">Select Project</option>
                        @foreach($projects as $projectsval)
                            <option <?php if (!empty($_GET["project"]) && $projectsval->id == $_GET["project"]) { echo "selected";} ?> value="{{ $projectsval->id }}">{{ $projectsval->name }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="col-md-2">
                    <input type="date" class="form-control" name="program_date" id="program_date" value="@if(!empty($_GET['program_date'])){{ $_GET['program_date'] }}@endif" autocomplete="off" required>
                </div>
                <div class="col-md-2">
                    <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Search</button>
                    <a href="{{ route('diaries.index') }}" class="btn btn-success filter">Reset</a>
                </div>
            </div>
        </form>
        <hr>
        

        @if (isset($_GET['project']) && !empty($_GET['project']))

            @isset($diaryData)
            <form method="post" action="{{ route('diaryUpdate', [$diaryData->id]) }}" enctype="multipart/form-data" autocomplete="off">
                 @else
                    <form class="asdasd" method="post" action="{{route('diaries.store')}}" enctype="multipart/form-data" autocomplete="off">
                @endif 
                @csrf
                    <input type="hidden"  name="project_id" value="{{ $_GET['project'] }}" required>
                    <input type="hidden"  name="program_diary_date" value="{{ $_GET['program_date'] }}" required>
                    @isset($programData)
                    <input type="hidden"  name="program_id" value="{{ $programData->id }}" required>
                    @endif
                    <div class="form-group col-md-12">
                    @isset($programData)
                        <div class="row">
                            <div class="col-md-12">
                                <label for="note">Notes</label>
                                <textarea rows="5" class="form-control" id="note" readonly >{{ $programData->note }}</textarea>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h2 style="text-align:center">Work Hours Details </h2>
                                </div>
                            </div>
                        </div>
                       
                        @isset($diaryEmployeRec)
                        <hr>
                        
                            @foreach($diaryEmployeRec as $diaryEmployeRecVal)
                            <div class="row entry">
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Employe Name</label>
                                                <input type="hidden" name="existEmpId[]" value="{{$diaryEmployeRecVal->id }}">
                                                <input type="text" name="existEmpName[]" placeholder="Employe Name" class="form-control" value="{{$diaryEmployeRecVal->empName }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Employee Type</label>
                                                <select name="existEmpType[]" id="project" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option <?php if($diaryEmployeRecVal->empType == 1){echo "selected"; } ?> value="1">Employee</option>
                                                <option <?php if($diaryEmployeRecVal->empType == 2){echo "selected"; } ?> value="2">Contractor</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label>No. Of Hours</label>
                                                <input type="number" class="form-control employeHrs" name="existEmpHours[]" value="{{$diaryEmployeRecVal->empHours }}" placeholder="No. Of Hours" required onkeyup="getAmount()">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-1">
                                            <div class="form-group">
                                                <button data-id="{{ $diaryEmployeRecVal->id }}" type="button" class="deleteEmp btn btn-danger btn-sm btn-add">
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </div>
                            @endforeach
                            
                        @endif

                        <hr> 
                        <div class="row targetDiv" id="div0">
                            <div class="col-md-12">
                                <div id="group1" class="fvrduplicate">
                                    <div class="row entry">
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Employe Name</label>
                                                <input type="text" name="empName[]" placeholder="Employe Name" class="form-control" <?php if (count($diaryEmployeRec) < 1 ){ echo "required"; } ?> >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Employee Type</label>
                                                <select name="empType[]" id="project" class="form-control" <?php if (count($diaryEmployeRec) < 1 ){ echo "required"; } ?> >
                                                <option value="">Select Type</option>
                                                <option value="1">Employee</option>
                                                <option value="2">Contractor</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label>No. Of Hours</label>
                                                <input type="number" class="form-control employeHrs" name="empHours[]" placeholder="No. Of Hours" onkeyup="getAmount()" <?php if (count($diaryEmployeRec) < 1 ){ echo "required"; } ?>>
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
                        <hr> 
                        <div class="row">
                            <div class="col-md-12">
                                <label for="note">Total Hours</label>
                                <input type="tex" class="form-control" id="totalHrs" name="empTotalHrs" value=" @isset($diaryData){{ $diaryData->empTotalHrs }}@endif" readonly>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h2 style="text-align:center">Bins </h2>
                                </div>
                            </div>
                        </div>
                        <hr> 
                        <div class="row entry">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>How many bins Removed</label>
                                    <select class="form-control" name="bins_removed">
                                    <option <?php if($diaryData && $diaryData->bins_removed == 0 ){ echo "selected"; } ?>>0</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 1 ){ echo "selected"; } ?>>1</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 2 ){ echo "selected"; } ?>>2</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 3 ){ echo "selected"; } ?>>3</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 4 ){ echo "selected"; } ?>>4</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 5 ){ echo "selected"; } ?>>5</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 6 ){ echo "selected"; } ?>>6</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 7 ){ echo "selected"; } ?>>7</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 8 ){ echo "selected"; } ?>>8</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 9 ){ echo "selected"; } ?>>9</option>
                                    <option <?php if($diaryData && $diaryData->bins_removed == 10 ){ echo "selected"; } ?>>10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>How many bins Delivered</label>
                                    <select class="form-control" name="bins_delivered">
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 0 ){ echo "selected"; } ?> >0</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 1 ){ echo "selected"; } ?>>1</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 2 ){ echo "selected"; } ?>>2</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 3 ){ echo "selected"; } ?>>3</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 4 ){ echo "selected"; } ?>>4</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 5 ){ echo "selected"; } ?>>5</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 6 ){ echo "selected"; } ?>>6</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 7 ){ echo "selected"; } ?>>7</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 8 ){ echo "selected"; } ?>>8</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 9 ){ echo "selected"; } ?>>9</option>
                                    <option <?php if($diaryData && $diaryData->bins_delivered == 10 ){ echo "selected"; } ?>>10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="note">Bins Description</label>
                                <textarea rows="5" class="form-control" name="bins_description" required> @isset($diaryData){{ $diaryData->bins_description }}@endif</textarea>
                            </div>
                        </div>
                            
                        
                        <hr> 
                        @isset($programData)
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
                                <div class="row entry">
                                    @isset($programTaskData)
                                    <?php $i = 0; ?>
                                    @foreach($programTaskData as $programTaskDataval)
                                    <?php $i++; ?>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label>Task</label>
                                            <textarea readonly class="form-control" readonly>{{ $programTaskDataval->task }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <div class="form-group task_status">
                                            <label>
                                                <input type="hidden" name="taskId[]" value="{{ $programTaskDataval->id }}" >
                                                <input type="radio" <?php if ($programTaskDataval->task_status ==1) { echo "checked";} ?> name="task_status{{ $programTaskDataval->id }}" value="1">Completed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <div class="form-group task_status">
                                            <label>
                                                <input type="radio" <?php if (
                                                    $programTaskDataval->task_status == 0 ) {echo "checked";} ?> name="task_status{{ $programTaskDataval->id }}" value="0">Not Completed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <div class="form-group task_status">
                                            <label>
                                                <input type="radio" <?php if (
                                                    $programTaskDataval->task_status == 2 ) { echo "checked";} ?> name="task_status{{ $programTaskDataval->id }}" value="2">Not Applicable
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <label for="note">Comments</label>
                                <textarea rows="5" class="form-control" name="comments" required> @isset($diaryData){{ $diaryData->comments }}@endif</textarea>
                            </div>
                        </div>


                        @isset($diaryImageRec)
                        <hr>
                        <div class="row uploaded-images">
                            @foreach($diaryImageRec as $diaryImageRecVal)
                                <div class="col-md-3">
                                    <span data-id="{{ $diaryImageRecVal->id }}" id="removeImg" class="removeimg deleteimage">X</span>
                                <img class="uploaded-img" src="{{ asset($diaryImageRecVal->images) }}">
                                </div>
                            @endforeach
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <label for="note">Upload Photo</label>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="usersubmit" class="btn btn-primary">Submit</button>
                    </div>
                    
                    <div class="container-fluid px-1 px-md-4 mx-auto">
   <div class="row ">
       
                            <div class="col-md-12">
                                <label for="note">Weather</label>
                                <input type="text" class="form-control" >
                            </div>
                        
       
       </div>
       </div>
                    
                    
                    
<!--        <div class="container-fluid px-1 px-md-4 mx-auto">-->
<!--    <div class="row d-flex justify-content-center px-3">-->
<!--        <div class="card weathercard">-->
<!--            <h2 class="ml-auto mr-4 mt-3 mb-0 brand-text"><?php echo $result['name']; ?></h2>-->
<!--            <p class="ml-auto mr-4 mb-0 med-font brand-text"><?php echo $result['weather'][0]['main']; ?></p>-->
<!--            <h1 class="ml-auto mr-4 large-font brand-text"><?php echo round($result['main']['temp']-273.15); ?>&#176;</h1>-->
<!--            <p class="time-font mb-0 ml-4 mt-auto brand-text"><?php echo date('H:m', $result['dt'] ); ?> <span class="sm-font"></span></p>-->
<!--            <p class="ml-4 mb-4 brand-text"><?php echo date('d, M Y', $result['dt'] ); ?></p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
                </form>
            
        @else
            <p style="text-align:center;">No Record Found.</p>
        @endif
    </div>
</div>
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


<script type="text/javascript">
    $(".deleteEmp").on('click',function(){
        var id = $(this).attr("data-id");
        var myurl = " {{ url('superadmin/diaryEmpDelete/') }}"+"/"+id;
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
    $(".deleteimage").on('click',function(){
        var id = $(this).attr("data-id"); 
        var myurl = " {{ url('superadmin/diaryImageDelete/') }}"+"/"+id;
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
                $this.parent().remove();
               }
            });
        }
    });


    function getAmount(){

        var total_hrs = 0;
  $('.employeHrs').each(function(){
    total_hrs += +$(this).val();
    $('#totalHrs').val(total_hrs);
  })
}
</script>


@endsection
    
    



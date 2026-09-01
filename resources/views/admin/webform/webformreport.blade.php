@extends('admin.layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    Web Form Report
    </div>
    <div class="rowd m-3">
        <form class="form-inline" method="GET">
            <div class="col-md-3">
                <select style="width: 100% !important;" name="project" id="project" class="form-control" required>
                    <option value="">Select Project</option>
                    <?php 
                    if($userProject){
                        foreach ($userProject as $key => $userProjectVal) { ?>
                           <option <?php if(!empty($_GET['pId']) && $_GET['pId'] == $userProjectVal->id ){ echo "selected"; } ?> value="{{ route('webformReport') }}?pId={{ $userProjectVal->id }}" value="<?php echo $userProjectVal->id; ?>"><?php echo $userProjectVal->name; ?></option>
                    <?php    }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <select style="width: 100% !important;" name="webform" id="webform" class="form-control" required>
                    <option value="">Select WebForm</option>
                    <?php 
                    if($userWebforms){
                        foreach ($userWebforms as $key => $userWebformsVal) { ?>
                           <option value="{{ route('webform') }}/{{  $userWebformsVal->slug }}?pId=<?php echo $_GET['pId']; ?>"><?php echo $userWebformsVal->title; ?></option>
                    <?php    }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <!-- <button id="filters" class="btn btn-success filter topmra" style="margin-left: -11px;">Filter</button> -->
                <a href="{{ route('webformReport') }}" class="btn btn-success filter">Reset Filter</a>
            </div>
        </form>
    </div>
    <div class="card-header">
        <div class="card-body" >   
                 <p style="text-align:center;">Please Select Project to see the result </p>
        </div>
    </div>
</div>

<script>
        // Use jQuery to detect the change in the select element
        $(document).ready(function() {
            $("#webform").change(function() {
                var selectedOption = $(this).val();
                if (selectedOption) {
                    window.location.href = selectedOption;
                }
            });

            $("#project").change(function() {
                var selectedOption = $(this).val();
                if (selectedOption) {
                    window.location.href = selectedOption;
                }
            });

        });
    </script>

@endsection

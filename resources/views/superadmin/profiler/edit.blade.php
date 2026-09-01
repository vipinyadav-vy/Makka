@extends('layouts.admin')
@section('content')
<div class="text-red-500">
    @if(session('success'))
        {{ session('success') }}
    @endif
    @if(session('failed'))
        {{ session('failed') }}
    @endif
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>
                    </div>
                    <form method="POST" action="{{ route('update_profile_super', [$user_edit->id]) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" name="user_name" value="{{ $user_edit->user_name }}" class="form-control" id="user_name" placeholder="Enter Name" fdprocessedid="w2e5v">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail Address</label>
                                <input type="email" name="email" value="{{ $user_edit->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail" fdprocessedid="w2e5v" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputcontact_no1">Mobile No</label>
                                <input id="txtNumber" type="text" class="form-control" name="mobile"  value="{{ $user_edit->mobile }}"  maxlength="10" />
                                <span id="errorMsg" style="display:none;">Enter Correct Phone Number</span>
                            </div>
                           
                        </div>
                        <div class="card card-secondary">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submits" fdprocessedid="geih9a">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form method="POST" action="{{ route('change_password_profile_super', [$user_edit->id]) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label for="old_password">Old Password</label>
                                <input class="form-control @error('old_password') is-invalid @enderror" type="password" id="old_password" name="old_password" required>
                                @error('old_password')
                                    <span class="text-red-500 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="form-group mb-0">
                                <label for="new_password">New Password</label>
                                <input class="form-control @error('new_password') is-invalid @enderror" type="password" id="new_password" name="new_password" required>
                                @error('new_password')
                                    <span class="text-red-500 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                           
                        </div>
                        <div class="card card-secondary">
                            <div class="card-footer update-mt-80"  style="margin-bottom: 100px";>
                                <button type="submit" class="btn btn-primary" name="submits" fdprocessedid="geih9a">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $("#txtNumber").blur(function() {
        var inputvalues = $(this).val(); 
         if(inputvalues.length > 10 || inputvalues.length < 10){
            $('#errorMsg').show();
        }else{
         $('#errorMsg').hide();
        }
    });
});
    // $("#txtNumber" ).keyup(function() {
    //      var value = $('#txtNumber').val();
    //   if(value.length > 10 || value.length < 10 ){
    //       $('#errorMsg').show();
    //   }else if(value.length = 10 ){
    //       $('#errorMsg').hide();
    //   }
    //   else{
    //      $('#errorMsg').hide();
    //   }
    //  });
 </script>
@endsection

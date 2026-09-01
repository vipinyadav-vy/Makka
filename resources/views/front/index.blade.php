@extends('front.layouts.app')
@section('content')
<section class="multisteps-form-section">
      <div class="container">
        @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
                @endif
                
        <div class="row">
          <div class="col-lg-12">
            <div class="multi-form-part">
              <div class="multi-form-main-box-part">
                 <div class="multi-form-img-part" style="text-align: center;">
                  <img src="{{asset('public/front/images/logo-makkas.jpg')}} ">
                </div> 
                <div class="multi-form-main-btn-part">

                @if(count($webForm) > 0)
                  @foreach($webForm as $webFormData)
                    <a href="{{ url('/webforms/'). '/' . $webFormData->slug }}" class="form-one">{{ $webFormData->title }}</a>
                  @endforeach
                @endif

                  <!-- <a href="{{url('/webforms/test2')}}" class="form-two"> Form 2 </a> -->
                  <!--<a href="login.html"> Form 3 </a>-->
                  <!-- <a href="{{url('/webforms/test3')}}"> Form 4 </a>  -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    




@endsection

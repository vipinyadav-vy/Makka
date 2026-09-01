@extends('layouts.admin')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
         </div>
        
      </div>
   </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3 col-6">
            <a href="{{url('superadmin/users')}}">
               <div class="small-box bg-info">
                  <div class="inner">
                     <h3>{{ $usersCount }}</h3>
                     <p>Users</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-person-add background_color_dashboard"></i>
                  </div>
            <a href="{{url('superadmin/users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </a>
         </div>
         <div class="col-lg-3 col-6">
            <a href="{{url('superadmin/projects')}}">
               <div class="small-box bg-warning">
                  <div class="inner">
                     <h3>{{ $projectsCount }}</h3>
                     <p>Projects</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-project-diagram background_color_dashboard"></i>
                  </div>
            <a href="{{url('superadmin/projects')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </a>
         </div>
         
        <div class="col-lg-3 col-6">
             <a href="{{url('superadmin/webforms')}}">
            <div class="small-box bg-success">
               <div class="inner">
                  <h3>{{ $webformCount }}</h3>
                  <p>Forms</p>
               </div>
               <div class="icon">
                  <i class="fa fa-question-circle background_color_dashboard"></i>
               </div>
               <a href="{{url('superadmin/webforms')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </a>
         </div> 
         <!--<div class="col-lg-3 col-6">-->
         <!--    <a href="{{url('superadmin/webformReports')}}">-->
         <!--   <div class="small-box bg-danger">-->
         <!--      <div class="inner">-->
         <!--         <h3>5</h3>-->
         <!--         <p>Form Reports</p>-->
         <!--      </div>-->
         <!--      <div class="icon">-->
         <!--         <i class="ion ion-pie-graph background_color_dashboard"></i>-->
         <!--      </div>-->
         <!--      <a href="{{url('superadmin/webformReports')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
         <!--   </div>-->
         <!--   </a>-->
         <!--</div> -->
      </div>
   </div>
</section>
@endsection
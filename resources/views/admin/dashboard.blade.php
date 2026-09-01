@extends('admin.layouts.admin')
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
@php
$adminRole = auth()->user()->role;

@endphp

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <a href="{{url('admin/user_projects')}}">
                <div class="small-box bg-warning">
                    <div class="inner pt-2 ml-5">
                        <h3>{{$projectsCount}}</h3>
                        <p>Projects</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-project-diagram background_color_dashboard"></i>
                    </div>
                    <a href="{{url('admin/user_projects')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
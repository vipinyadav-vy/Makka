<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php 
    $user = Auth::user();
    @endphp
    <a href="{{url('admin/profiler')}}" class="brand-link">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        {{-- <img src="{{asset('public/assets/img/test.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">
           User Admin
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard-admin')}}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/user_projects')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/user_programs')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>
                            Programs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/user_diaries')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>
                            Diaries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/webformReport')}}" class="nav-link ">
                        <i class="fa fa-bug nav-icon"></i>
                        <p>
                        WebForm Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                
            </ul>
        </nav>
    </div>
</aside>
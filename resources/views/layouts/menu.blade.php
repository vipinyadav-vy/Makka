<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('superadmin/usereditprofiler')}}" class="brand-link">
    {{-- <img src="{{asset('public/assets/img/test.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <span class="brand-text font-weight-light">Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('superadmin/home')}}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('superadmin/users')}} " class="nav-link ">
                      <i class="fas fa-user nav-icon"></i>
                      <p> Users <i class="right fas fa-angle-left"></i></p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('superadmin/projects')}}" class="nav-link ">
                        <i class="nav-icon  fas fa-project-diagram"></i>
                        <p>Projects <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('superadmin/webforms')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>Forms <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('superadmin/programs')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>Programs <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('superadmin/diaries')}}" class="nav-link ">
                        <i class="nav-icon  fa fa-file-text-o"></i>
                        <p>Diaries <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
               
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-bug nav-icon"></i>
                        <p>WebForm Reports  <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('superadmin/webformReports')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Induction Record </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/siteSafetInspectionReports')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Safety Inspection </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/toolBoxTalkRecords')}}" class="nav-link"> 
                                <i class="far fa-circle nav-icon"></i>
                                <p>Toolbox Talk Record </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/preStartMeetings')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pre Start Meeting </p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{url('superadmin/inspectionTestPlan')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inspection Test Plan </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/supplierContractorEvaluation')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier & Contractor Evaluation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/supplierContractorCar')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier & Contractor Car</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('superadmin/contractPreStartChecklist')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pre-Start Checklist</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

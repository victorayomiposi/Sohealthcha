<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SOHEALTCHA</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->fullname }}</a>
            </div>
        </div>



        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="fas fa-home"></i>
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Site Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.site.config') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Settings</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.payment.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payment.assign') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assign Payments</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Site Administrators
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add_user') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_user') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="accessButton" href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permision</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Departments
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add_department') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add_programme') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Programme</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_department') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cutoffmark_depart') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cut Off Mark</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Applicants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('view_applicant') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Applicant</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('olevel_status') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>O*level Status</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applicantcourse') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Of Course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('resultupload') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Result Upload</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('resultview') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Result</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('exportdetails') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Export Candidate</p>
                            </a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('exortpassort') }}" class="nav-link">-->
                        <!--        <i class="far fa-circle nav-icon"></i>-->
                        <!--        <p>Export Passort</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Admissions
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admission_upload') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Admission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admission_view') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admitted Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admission_lock') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lock Admission</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            AGENT CONFIG.....
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add_agent') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Agent</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_agent') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Agent</p>
                            </a>
                        </li>


                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Entrance Examination
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('exam_date') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Date</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('exam_allocate') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Allocation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_allocate') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Allocation</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manual Pin Generate
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add_pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Candidate Pin</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('course_pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Course Pin</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admission_pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admission Pin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Online Pin Generate
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('online.candidate.pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Candidate Pin</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('online.course.pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Course Pin</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('online.admission.pin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admission Pin</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pin Renew</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Blog Configuration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Department Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('depart_blog_add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('depart_blog') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departbloger') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Content</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('deptblogview') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Content</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Course Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('course_blog_add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('course_blog') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Blog</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Event Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('event_blog') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_event') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Blog</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
            </ul>
            </li>
            </ul>
        </nav>
    </div>
</aside>

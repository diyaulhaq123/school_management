<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo">
            <span class="logo-sm">
                <img src="{{ asset('images/'.$setting->logo) }}?v={{ time() }}" alt="logo" class="rounded-circle" width="100">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('images/'.$setting->logo) }}?v={{ time() }}" alt="logo" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover; ">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu Management</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                @can('home-student')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts1" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-group-line"></i> <span>Student</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts1">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('student.index') }}" class="nav-link">Student List</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end student Menu -->
                @endcan

                @can('home-children')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('children.index', auth()->user()->id) }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri ri-user-fill"></i> <span>Children</span>
                    </a>
                </li> <!-- end library Menu -->
                @endcan


                @can('home-application')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts1a" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-user-add-line"></i> <span>Applications</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts1a">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Application Lists</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Admissions</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end student Menu -->
                @endcan

                @can('home-accounts')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-shield-user-fill"></i> <span>Accounts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index','guardian') }}" class="nav-link">Guardians List</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index','teacher') }}" class="nav-link">Teachers</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index','eo') }}" class="nav-link">Exam Officers</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index','accountant') }}" class="nav-link">Accountant</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index','principal') }}" class="nav-link">Principal</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end accounts Menu -->
                @endcan

                @canany(['home-class-allocation','home-subject-allocation'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts3" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-group-fill"></i> <span>Academics/Allocations</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('class-allocations.index') }}" class="nav-link">Class Allocation</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subject-allocations.index') }}" class="nav-link">Subject Allocation</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Academics Menu -->
                @endcanany


                @can('home-payment')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts4" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-bank-card-line"></i> <span>Payment</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('payments.index') }}" class="nav-link">Payment</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end payments Menu -->
                @endcan

                @can('home-library')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-open-line"></i> <span>Library</span>
                    </a>
                </li> <!-- end library Menu -->
                @endcan


                @can('home-classes')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('classes.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-read-line"></i> <span>Classes</span>
                    </a>
                </li> <!-- end classes Menu -->
                @endcan

                @can('home-subject')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('subject.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-3-fill"></i> <span>Subject</span>
                    </a>
                </li> <!-- end subjects Menu -->
                @endcan

                @can('home-routine')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-timer-fill"></i> <span>Routine</span>
                    </a>
                </li> <!-- end routine Menu -->
                @endcan


                @can('home-attendance')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-calendar-check-line"></i> <span>Attendance</span>
                    </a>
                </li> <!-- end attendance Menu -->
                @endcan

                @can('home-result-activation')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('result.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-read-line"></i> <span>Result Activation</span>
                    </a>
                </li> <!-- end results Menu -->
                @endcan

                @can('home-payment-activation')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('payment_activation.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-check-line"></i> <span>Payment Activation</span>
                    </a>
                </li> <!-- end results Menu -->
                @endcan


                @can('home-student-result')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('view.result.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-edit-line"></i> <span>View Result</span>
                    </a>
                </li> <!-- end results Menu -->
                @endcan

                {{-- @can('home-subject-registration')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('subject-registration.index') }}" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-fill"></i> <span>Subject Registration</span>
                    </a>
                </li> <!-- end subject registration Menu -->
                @endcan --}}

                @canany(['home-scores','home-exams'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts4" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-booklet-fill"></i> <span>Exams</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">View Exams</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('uploaded.scores.index') }}" class="nav-link">Scores</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end exams Menu -->
                @endcanany

                @can('home-notice')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-calendar-check-line"></i> <span>Notice</span>
                    </a>
                </li> <!-- end notice Menu -->
                @endcan

                @can('home-transportation')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-bus-fill"></i> <span>Transport</span>
                    </a>
                </li> <!-- end transport Menu -->
                @endcan


                @can('home-settings')
                <li class="menu-title"><i class="ri-settings-2-line"></i> <span>Settings</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages6" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-lock-2-line"></i> <span>Roles And Permissions</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages6">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">Permissions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manage.permissions.index') }}" class="nav-link">Manage Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('home-settings')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages5" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-settings-5-fill"></i> <span>Settings</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('portal_settings.index') }}" class="nav-link">Portal Settings</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('settings.index') }}" class="nav-link">System Settings</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('sessions.index') }}" class="nav-link">Sessions</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('terms.index') }}" class="nav-link">Terms</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('payment_type.index') }}" class="nav-link">Payment Type</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-question-fill"></i> <span>Support</span>
                    </a>
                </li> <!-- end notice Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

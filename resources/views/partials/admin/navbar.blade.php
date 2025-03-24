<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/mentor-logo.png') }}" alt="{{ config('app.name', 'LeadGo') }}"
                class="navbar-brand-img" style="height: 50px;">
            <span style="color: #cf6219; font-weight:700;">Mentor Matchr</span>
        </a>

        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                @if (\Auth::user()->type != 'Owner')
                    <li class="nav-item" style="font-weight: 400;">{{ Auth::user()->org_name }}</li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}
                    </a>
                </li>


                @if (\Auth::user()->can('Management'))
                    <!-- Management SECTION -->
                    <li
                        class="nav-item {{ Request::route()->getName() == 'management.user' || Request::route()->getName() == 'management.revShare' || Request::route()->getName() == 'management.companyAssign' || Request::route()->getName() == 'management.company' || Request::route()->getName() == 'management.currency' || Request::route()->getName() == 'management.operator' || Request::route()->getName() == 'users' ? 'active' : 'collapsed' }}">
                        @can('Management')
                            <a class="nav-link collapsed" href="#navbar-getting-started-management" data-toggle="collapse"
                                role="button"
                                aria-expanded="{ (Request::route()->getName() == 'management.user') ? 'true' : 'false' }}"
                                aria-controls="navbar-getting-started-management">
                                <i class="fas fa-users"></i>{{ __('Management') }}
                                <i class="fas fa-sort-up"></i>
                            </a>
                        @endcan
                        <div class="collapse 
                        {{ in_array(Request::route()->getName(), [
                            'management.user',
                            'management.revShare',
                            'management.companyAssign',
                            'management.company',
                            'management.currency',
                            'management.operator',
                            'project.management',
                            'users',
                            'students.index',
                            'students.create',
                            'students.edit',
                            'tutors.index',
                            'tutors.create',
                            'tutors.edit',
                            'courses.index',
                            'courses.create',
                            'courses.edit',
                            'class_schedules.index',
                            'class_schedules.create',
                            'class_schedules.edit',
                            'enrollments.index',
                            'enrollments.create',
                            'enrollments.edit',
                            'payments.index',
                            'payments.create',
                            'payments.edit',
                            'messages.index',
                            'messages.create',
                            'messages.edit',
                            'attendances.index',
                            'attendances.create',
                            'attendances.edit',
                            'exams.index',
                            'exams.create',
                            'exams.edit',
                            'grades.index',
                            'grades.create',
                            'grades.edit',
                            'reports.index',
                            'reports.create',
                            'reports.edit',
                            'student-tutors.index',
                            'student-tutors.create',
                            'student-tutors.edit',
                        ])
                            ? 'show'
                            : '' }}"
                            id="navbar-getting-started-management">
                            <ul class="nav flex-column submenu-ul">

                                @if (Gate::check('Manage Users') ||
                                        Gate::check('Manage Clients') ||
                                        Gate::check('Manage Roles') ||
                                        Gate::check('Manage Permissions'))
                                    @if (\Auth::user()->type == 'Business Owner' || \Auth::user()->type == 'Administrator' || \Auth::user()->type == 'Owner')
                                        @can('Manage Users')
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'users' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ route('users') }}">
                                                    <i class="fas fa-user"></i>
                                                    {{ __('Users') }}
                                                </a>
                                            </li>
                                            {{-- {{dd(Request::route()->getName())}} --}}
                                            <li
                                                class="nav-item  {{ in_array(Request::route()->getName(),['students.index','students.create']) ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('students') }}">
                                                    <i class="fas fa-book-reader"></i>
                                                    {{ __('Students') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'tutors.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('tutors') }}">
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                    {{ __('Tutors') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'student-tutors.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('student-tutors') }}">
                                                    <i class="fas fa-user-graduate"></i>
                                                    {{ __('Student-Tutors') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'courses.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('courses') }}">
                                                    <i class="fas fa-book-open"></i>
                                                    {{ __('Course') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'class_schedules.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('class_schedules') }}">
                                                    <i class="fas fa-chalkboard"></i>
                                                    {{ __('Class') }}
                                                </a>
                                            </li>
                                            
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'enrollments.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('enrollments') }}">
                                                    <i class="fas fa-user-plus"></i>
                                                    {{ __('Enrollment') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'attendances.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('attendances') }}">
                                                    <i class="fas fa-calendar-check"></i>
                                                    {{ __('Attendance') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'exams.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('exams') }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    {{ __('Exam') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'grades.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('grades') }}">
                                                    <i class="fas fa-chart-line"></i>
                                                    {{ __('Grade') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'payments.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('payments') }}">
                                                    <i class="fas fa-credit-card"></i>
                                                    {{ __('Payment') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'messages.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('messages') }}">
                                                    <i class="fas fa-envelope"></i>
                                                    {{ __('Message') }}
                                                </a>
                                            </li>
                                            <li
                                                class="nav-item  {{ Request::route()->getName() == 'reports.index' ? 'active' : '' }}">
                                                <a class="nav-link" href="{{ url('reports') }}">
                                                    <i class="fas fa-file-alt"></i>
                                                    {{ __('Reports') }}
                                                </a>
                                            </li>
                                        @endcan
                                    @endif
                                @endif


                            </ul>
                        </div>
                    </li>
                @endif





                @if (\Auth::user()->type == 'Owner')
                    @can('Manage Roles')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::route()->getName() == 'roles.index' ? 'active' : '' }}"
                                href="{{ route('roles.index') }}">
                                <i class="fas fa-user-cog"></i>{{ __('Roles') }}
                            </a>
                        </li>
                    @endcan
                @endif

                {{-- @can('System Settings')
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'settings') ? 'active' : '' }}" href="{{route('settings')}}">
                                <i class="fas fa-cogs"></i>{{__('System Settings')}}
                            </a>
                        </li>
                        @endcan --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link dropdown-item"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

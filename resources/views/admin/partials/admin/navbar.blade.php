<?php
use App\Models\User;
use App\Models\DashboardMenu;

$user = \Auth::user();
if ($user->type == 'Admin') {
    $arrCount['sidebar_menus'] = DashboardMenu::where('staff_id', $user->staff_id)->first();
    $arrCount['sidebar_menus'] = isset($arrCount['sidebar_menus']['sidebar_menus']) ? json_decode($arrCount['sidebar_menus']['sidebar_menus'], true) : [];

}
?>
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a style="background-color: #fff;margin: 0px 10px;border-radius: 10px;" class="navbar-brand"
            href="{{route('admin.dashboard')}}">
            <img src="{{ asset('admin/logo/logo-full.png') }}" alt="{{ config('app.name', 'LeadGo') }}"
                class="navbar-brand-img">
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
                @if((\Auth::user()->type != 'Owner'))
                    <li class="nav-item" style="font-weight: 400;">
                        {{ Auth::user()->org_name }}
                    </li>
                @endif
                <select id="blocked-element" class="year-filter year-filter-design" name="year">
                    @for($i = 2020; $i <= date('Y') + 1; $i++)

                        <option value={{ $i }} @if(session('year2') == $i || (!session()->has('year2') && date('Y') == $i)) {{ 'selected' }} @endif>{{$i}}
                        </option>
                    @endfor
                </select>
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                        class="nav-link {{ (Request::route()->getName() == 'home') ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>{{__('Dashboard')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}"
                        class="nav-link {{ (Request::route()->getName() == 'home') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>{{__('Users')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.departments.index')}}">
                        <i class="fas fa-book"></i>{{__('Department')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.mpms.index')}}">
                        <i class="fas fa-book"></i>{{__('MPMS Form')}}
                    </a>
                </li>

                @if(Gate::check('Manage Users') || Gate::check('Manage Clients') || Gate::check('Manage Roles') || Gate::check('Manage Permissions'))
                    @if((\Auth::user()->type == 'Owner'))
                        @can('Manage Users')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}"
                                    href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-users"></i>{{__('Users')}}
                                </a>
                            </li>
                        @endcan
                        @can('Manage Users')
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-book"></i>{{__('Department')}}
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('admin.dashboard')}}">
                                <i class="fas fa-users"></i>{{__('Assign Duties')}}
                            </a>
                        </li>
                        @can('Manage Roles')
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'roles.index') ? 'active' : '' }}"
                                    href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-user-cog"></i>{{__('Roles')}}
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item">
                            <a class="nav-link " href="{{route('admin.departments.index')}}">
                                <i class="fas fa-book"></i>{{__('MPMS Form')}}
                            </a>
                        </li>

                        @can('System Settings')
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'settings') ? 'active' : '' }}"
                                    href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-cogs"></i>{{__('System Settings')}}
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <i class="fas fa-info"></i>{{__('FAQ')}}
                            </a>
                        </li>
                    @endif
                    @if((\Auth::user()->type == 'Admin'))
                        @if(in_array("1", $arrCount['sidebar_menus']))
                            @can('Manage Users')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}"
                                        href="{{route('admin.dashboard')}}">
                                        <i class="fas fa-users"></i>{{__('Users')}}
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @if(in_array("2", $arrCount['sidebar_menus']))
                            @can('Manage Users')
                                <li class="nav-item">
                                    <a class="nav-link " href="{{route('admin.dashboard')}}">
                                        <i class="fas fa-book"></i>{{__('Department')}}
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @if(in_array("3", $arrCount['sidebar_menus']))
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-users"></i>{{__('Assign Duties')}}
                                </a>
                            </li>
                        @endif
                        @if(in_array("4", $arrCount['sidebar_menus']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.dashboard')}}">
                                    <i class="fas fa-info"></i>{{__('FAQ')}}
                                </a>
                            </li>
                        @endif
                    @endif
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>
    </div>
</div>
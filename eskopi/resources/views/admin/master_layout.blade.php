@php
    $header_admin = Auth::guard('admin')->user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mode" content="{{ env('PROJECT_MODE') ?? 'LIVE' }}">
    <!-- Custom Meta -->
    @yield('custom_meta')

    @yield('title')
    <link rel="icon" href="">
    @include('admin.partials.styles')
    @stack('css')
    @yield('vite')
    
    <style>
        table.dataTable tr.active-row {
            background-color: #add8e6 !important; /* Light blue color */
        }
        
        .correct-answer {
            position: relative;
            display: inline-block;
            background-color: #d4edda;
            padding: 5px 15px;
            border-radius: 10px;
            margin: 0;
            text-align: center;
        }
        
        .question-text {
            font-size: 1.10rem;
            font-weight: bold;
        }
        
        #soalTable td:first-child,
        #soalTable th:first-child {
            width: 5% !important;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="mr-2 form-inline">
                    <ul class="mr-3 navbar-nav d-flex align-items-center">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </div>
                <div class="mr-auto search-box position-relative"></div>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if ($header_admin->image)
                                <img alt="image" src="{{ asset($header_admin->image) }}"
                                    class="mr-1 rounded-circle">
                            @else
                                <img alt="image" src="" class="mr-1 rounded-circle">
                            @endif    
                            <div class="d-sm-none d-lg-inline-block">{{ $header_admin->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.settings') }}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> {{ __('Settings') }}
                            </a>
                            <a href="{{ route('admin.edit-profile') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                            <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center text-danger"
                                onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>
        
            @include('admin.sidebar')           
            @yield('admin-content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 Kementerian Investasi / BKPM
                </div>
                <div class="footer-right">
                    <span></span>
                </div>
            </footer>

        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}

    @include('admin.partials.modal')
    @include('admin.partials.javascripts')

    @stack('js')

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('./assets/css/theme.css') }}" />
    <title>@yield('title')</title>
    @stack('style')

</head>

<body class=" bg-surface">
    <main>
        <!--start the project-->
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <aside id="application-sidebar-brand"
                class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300">
                <!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
                <div class="p-4">
                    <a href="/" class="text-nowrap">
                        <h3 style="text-align:center " class="font-bold text-[20px]">Desa Sondakan</h3>
                    </a>
                </div>
                <div class="scroll-sidebar" data-simplebar="">
                    <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
                        <ul id="sidebarnav" class="text-gray-600 text-sm">
                            @if (Auth::user()->role == 'user')
                                @include('dashboard.users.navbar')
                            @elseif (Auth::user()->role == 'admin')
                                @include('dashboard.admin.navbar')
                            @endif

                        </ul>

                    </nav>

                </div>
                <div class="m-4  relative grid">
                    <a href="{{ route('logout') }}" class="text-base font-semibold hover:bg-blue-700 btn">LOGOUT</a>
                </div>
                <!-- </aside> -->
            </aside>
            <div class=" w-full page-wrapper xl:px-6 px-0">

                <!-- Main Content -->
                <main class="h-full  max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <!--  Header Start -->
                        <header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">


                            <!-- ========== HEADER ========== -->

                            <nav class=" w-ful flex items-center justify-between" aria-label="Global">
                                <ul class="icon-nav flex items-center gap-4">
                                    <li class="relative xl:hidden">
                                        <a class="text-xl  icon-hover cursor-pointer text-heading" id="headerCollapse"
                                            data-hs-overlay="#application-sidebar-brand"
                                            aria-controls="application-sidebar-brand" aria-label="Toggle navigation"
                                            href="javascript:void(0)">
                                            <i class="ti ti-menu-2 relative z-1"></i>
                                        </a>
                                    </li>

                                    <li class="relative">

                                    </li>
                                </ul>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                                        <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                            <img class="object-cover w-9 h-9 rounded-full"
                                                src="{{ 'storage/' . Auth::user()->profile }}" alt=""
                                                aria-hidden="true">
                                        </a>
                                        <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max  w-[200px] hidden z-[12]"
                                            aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <div class="card-body p-0 py-2">
                                                <a href="{{ route('profile') }}"
                                                    class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-user  text-xl "></i>
                                                    <p class="text-sm ">My Profile</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </nav>

                            <!-- ========== END HEADER ========== -->
                        </header>
                        <!--  Header End -->
                        @yield('content')
                        <footer>
                            <p class="text-base text-gray-400 font-normal p-3 text-center">
                                Design and Developed by <a href="https://www.wrappixel.com/" target="_blank"
                                    class="text-blue-600 underline hover:text-blue-700">wrappixel.com</a>
                            </p>
                        </footer>
                    </div>


                </main>
                <!-- Main Content End -->

            </div>
        </div>
        <!--end of project-->
    </main>



    <script src="{{ asset('./assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('./assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('./assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('./assets/libs/@preline/dropdown/index.js') }}"></script>
    <script src="{{ asset('./assets/libs/@preline/overlay/index.js') }}"></script>
    <script src="{{ asset('./assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('./assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('./assets/js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
    @stack('scripts')
</body>

</html>

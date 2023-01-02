<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sign and Infra Graphics | Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    {{-- <link href="{{asset('admin/css/font-awesome/all.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    {{-- <link href="{{asset('admin/css/bootstrap-icons.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('admin/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body>
    {{-- container-xxl --}}
    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar bg-dark pe-2 pb-3">
            <nav class="navbar navbar-light">
                <a href="{{route('admin.home')}}" class="navbar-brand mx-4 mb-3 navbar-logo">
                    <img src="{{ asset('admin/img/logo.png') }}">
                </a>
                <div class="navbar-nav w-100">
                    <a href="{{route('admin.home')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-th me-2"></i>Category Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.category.index') }}" class="dropdown-item"> All Categories</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Service Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.service.index') }}" class="dropdown-item">All Services</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Employee Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.employee.index') }}" class="dropdown-item">All Employees</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Customer Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.customer.index') }}" class="dropdown-item">All Customers</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Enquiries Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.enquiry.index') }}" class="dropdown-item"><i class="fa fa-arrow-right me-2"></i>All Enquiries</a>
                            <a href="{{ route('admin.enquiry.report') }}" class="dropdown-item"><i class="fa fa-arrow-right me-2"></i>All Reports</a>
                        </div>
                    </div>
                    <a href="{{ route('admin.invoice.index') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Invoice Management</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content bg-light">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-dark navbar-light sticky-top px-4 py-0">
                <a href="{{route('admin.home')}}" class="navbar-brand d-flex d-lg-none me-4">
                   <img src="{{ asset('admin/img/only_logo.png') }}" alt="" width="100%">
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex text-light">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex text-light">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                            
                            <span class="d-none d-lg-inline-flex text-light">{{ Auth::guard('admin')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item text-dark">My Profile</a>
                            <a href="#" class="dropdown-item text-dark">Settings</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item text-dark">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            @yield('content')

            <!-- Footer Start -->
            {{-- <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-dark btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://monakanote.net/demo/js/printthis/js/printThis.js"></script>
    @yield('script')
</body>

</html>
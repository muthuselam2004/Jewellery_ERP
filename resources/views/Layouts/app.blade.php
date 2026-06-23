<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Jewellery Management')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Style.css') }}">


    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/ionicons/dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/mohithg-switchery/dist/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet"
        href="{{ asset('node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/owl.carousel/dist/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/owl.carousel/dist/assets/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/theme.min.css') }}">

    <!-- Modernizr -->
    <script src="{{ asset('src/js/vendor/modernizr-2.8.3.min.js') }}"></script>



</head>

<body>
    <div class="wrapper">

        {{-- HEADER --}}
        @include('layouts.header')

        <div class="page-wrap">

            {{-- SIDEBAR --}}
            @include('layouts.sidebar')

            {{-- MAIN CONTENT --}}
            <div class="main-content">
                @yield('content')
            </div>

        </div>

        {{-- FOOTER --}}
        @include('layouts.Footer')

        {{-- Toast Notification --}}
        <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 50px; right: 50px; z-index: 9999;">
            <div id="successToast" class="toast" role="alert" data-delay="5000"
                style="min-width:300px;max-width:400px;">
                <div class="toast-header bg-success text-white">
                    <strong class="mr-auto">Success</strong>
                    <small>Just now</small>
                    <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="progress" style="height:6px;">
                    <div class="progress-bar" style="width:100%"></div>
                </div>
                <div class="toast-body">{{ session('success') }}</div>
            </div>
        </div>

    </div>

    <!-- Vendor JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <script>
        window.jQuery || document.write('<script src="{{ asset("src/js/vendor/jquery-3.3.1.min.js") }}"><\/script>');
    </script>
    <script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('node_modules/screenfull/dist/screenfull.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('node_modules/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('node_modules/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('node_modules/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('node_modules/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('node_modules/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('node_modules/moment/moment.js') }}"></script>
    <script
        src="{{ asset('node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('node_modules/d3/dist/d3.min.js') }}"></script>
    <script src="{{ asset('node_modules/c3/c3.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('dist/js/theme.min.js') }}"></script>
    <!-- <script src="{{ asset('js/datatables.js') }}"></script> -->
    <!-- <script src="{{ asset('js/tables.js') }}"></script> -->
    <script src="{{ asset('js/widgets.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/form-advanced.js') }}"></script>
    <script src="{{ asset('js/Page_Script/Master.js') }}"></script>
    <script src="{{ asset('js/Page_Script/Transaction.js') }}"></script>
    <!-- <script src="{{ asset('js/Page_Script/Allocation.js') }}"></script>
    <script src="{{ asset('js/Page_Script/Follow.js') }}"></script>
    <script src="{{ asset('js/Page_Script/Event.js') }}"></script>
    <script src="{{ asset('js/Page_Script/Payment.js') }}"></script> -->

    <script>
        const APP_URL = "{{ url('/') }}";
    </script>

    <script>
        $(function () {
            // Initialize select2
            if ($('.select2').length) {
                $('.select2').select2();
            }

            // Toast notification
            @if(session('success'))
                const toastEl = $('#successToast');
                toastEl.toast('show');
                const progressBar = toastEl.find('.progress-bar');
                progressBar.css({
                    transition: 'width 5s linear',
                    width: '0%'
                });
                toastEl.on('hidden.bs.toast', function () {
                    progressBar.css({
                        width: '100%',
                        transition: 'none'
                    });
                });
            @endif
        });
    </script>

    @stack('styles')
    @stack('scripts')
</body>

</html>
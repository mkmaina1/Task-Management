<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('layouts.partials') <!-- Include all-in-one navbar/sidebar/footer -->

    <!-- Main Content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                {{-- ✅ Flash Message Alerts --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 flash-message" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2 flash-message" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-info alert-dismissible fade show mt-2 flash-message" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Page-specific content --}}
                @yield('content')

            </div>
        </section>
    </div>
</div>

<!-- Footer -->
<footer class="main-footer text-center">
    <strong>&copy; {{ date('Y') }} TaskNova.</strong> All rights reserved.
</footer>

<!-- JS -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<!-- ✅ Flash message auto-hide script -->
<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.flash-message');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
</script>
</body>
</html>

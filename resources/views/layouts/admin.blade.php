<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home Page')</title>

    @section('css')
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    @show
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">

</head>

<body>

<div id="wrapper">
    @include ('admin.partials.left-sidebar')

    <div id="page-wrapper" class="gray-bg">
        @include('admin.partials.navbar-header')

        @include('admin.partials._flash')

        <div id="app">
            @yield('content')
        </div>

        @include('admin.partials.footer')

    </div>
    @include('admin.partials.right-sidebar')
</div>

@section('script')
    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@show

</body>
</html>

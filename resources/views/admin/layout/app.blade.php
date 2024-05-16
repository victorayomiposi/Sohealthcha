<!DOCTYPE html>
<html lang="en">
@include('admin.layout.head')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="100" width="100">
        </div>
        @include('admin.layout.navbar')
        @include('admin.layout.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('admin.layout.footer')
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('admin.layout.script')
</body>

</html>

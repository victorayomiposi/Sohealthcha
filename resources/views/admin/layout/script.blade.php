<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
<script>
    @if (session('success'))
        Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
        );
    @elseif (session('error'))
        Swal.fire(
            'Error!',
            '{{ session('error') }}',
            'error'
        );
    @endif
</script>

<script>
    // Get the current year
    const currentYear = new Date().getFullYear();

    const yearElement = document.getElementById("year");
    yearElement.textContent = currentYear;
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
@if (session('errors'))
    <script>
        toastr.options.timeOut = 10000;
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    </script>
@endif
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@yield('adminscripts')
<script>
    document.getElementById("accessButton").addEventListener("click", function() {
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You have no permission to access this page.',
            confirmButtonText: 'OK'
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm_delete').click(function(event) {
        var editUrl = $(this).attr('href');
        event.preventDefault();

        Swal.fire({
                title: 'Warning!',
                text: 'Are you sure you want to delete this record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });
    });

    $('.show_confirm_logout').click(function(event) {
        var editUrl = $(this).attr('href');
        event.preventDefault();

        Swal.fire({
                title: 'Warning!',
                text: 'Are you sure you want to leave this page?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirm!',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });
    });

    $('.show_confirm_logout').click(function(event) {
        var editUrl = $(this).attr('href');
        event.preventDefault();

        Swal.fire({
                title: 'Warning!',
                text: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });
    });

    $('.show_confirm_edit').click(function(event) {
        var editUrl = $(this).attr('href');
        event.preventDefault();

        Swal.fire({
                title: 'Edit Record!',
                text: 'Are you sure you want to edit this record?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });
    });


    $('.show_confirm_permission').click(function(event) {
        event.preventDefault();
        var editUrl = $(this).attr('href');

        Swal.fire({
                title: 'Edit Permission!',
                text: 'Are you sure you want to edit this permission?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });

    });

    $('.show_no_permission').click(function(event) {
        event.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'No Permission',
            text: 'You do not have permission to access this action.',
            confirmButtonText: 'OK'
        });

    });


    $('.show_confirm_viewlog').click(function(event) {
        event.preventDefault();
        var editUrl = $(this).attr('href');

        Swal.fire({
                title: 'View Activity Log!',
                text: 'Are you sure you want to view activity log?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, view it!',
                cancelButtonText: 'Cancel'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = editUrl;
                }
            });

    });


    $('.show_confirm_release_result').click(function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Release Cas!',
            text: 'Are you sure you want to release the Cas? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, release it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('confirm_release_result').submit();
            }
        });

    });
</script>

@stack('script')
<!--   Core JS Files   -->
    <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/fullcalendar.min.js')}}"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('/assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/threejs.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/orbit-controls.js') }}"></script>

    @yield('scripts');

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../../assets/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>

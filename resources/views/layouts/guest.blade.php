<!DOCTYPE html>
<html lang="en">
    @include('students/layouts/head')
<body onload="display_ct()">
    <div id="overlay"></div>
    <div id="overlay-transparant"></div>

    @include('students/layouts/header')

    @include('students/layouts/breadcrumb')
    
    @include('students/modal/clockin')
    @include('students/modal/add_activity')
    @include('students/modal/weekly_report')
    @include('students/modal/monthly_report')
    @include('students/modal/submit_assignment')
    @include('students/modal/view_assignment')
    @include('students/modal/final_report')
    @include('students/modal/report_detail')
    @include('students/modal/report_detail_weekly')
    @include('students/modal/assignment_notes')
    @include('students/modal/create_assignment')
    @include('students/modal/alumni')
    @include('students/modal/preview_image')

    {{ $slot }}

    @include('students/layouts/footer')

    @include('students/layouts/navbar')
    
    @include('students/layouts/scripts')

    @push('scripts')
</body>
</html>